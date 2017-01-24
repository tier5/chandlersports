<?php
/*
Plugin Name: WooCommerce Flip Product Image
Plugin URI: 
Version: 1.3
Author: Fialovy
Author URI: http://fialovy.com/
Description: Flip Product Image is a plugin that makes your product images flip!
*/

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


	if ( ! class_exists( 'flv_woo_flip_img' ) ) {

		class flv_woo_flip_img {

			public function __construct() {
				 $this->plugin_url = plugin_dir_url( __FILE__ );
				 $currentFile = __FILE__;$currentFolder = dirname($currentFile);
				 
				if(is_admin()){  include $currentFolder . '/flv_flip_admin.php' ;}
				
				add_action( 'init', array( $this, 'initiate' ) );
				
				add_action('admin_menu' , array($this, 'flv_create_pages'));
				add_action('admin_init', array($this, 'flv_handle_admin_init'));
				
				add_action( 'wp_enqueue_scripts', array( $this, 'flv_woo_scripts' ) );	
				add_action( 'admin_enqueue_scripts', array( $this,'flv_wp_admin_style' ));													// Enqueue the styles
				add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
				add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
					 add_action('wp_head', array($this, 'flv_header'));
 
  }
public function flv_header() {
		$flv_flip_options = get_option( 'flv_woo_flip_admin_settings' ); 
		
		echo'<script>
		window.flv_hover_in="'. $flv_flip_options['flv_woo_flip_hover_in'].'";
		window.flv_hover_out="'. $flv_flip_options['flv_woo_flip_hover_out'].'";
		</script>';
			}

	public function initiate() {
		// Setup localization
		load_plugin_textdomain( "fialovy", false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		
		
	}

	/*-----------------------------------------------------------------------------------*/
	/* Class Functions */
	/*-----------------------------------------------------------------------------------*/
	
	// Setup styles
	function flv_woo_scripts() {
		if ( apply_filters( 'woocommerce_product_image_flipper_styles', true ) ) {
		wp_enqueue_style( 'flv_animate', $this->plugin_url.'assets/css/animate.css' );
		wp_enqueue_style( 'flv_styles', $this->plugin_url.'assets/css/style.css' );
		}
		wp_enqueue_script( 'flv_script', $this->plugin_url.'assets/js/script.js' ,'','',true);
	}
	function flv_wp_admin_style(){
		wp_enqueue_style( 'flv-admin-style', $this->plugin_url.'assets/css/admin.css');
		wp_enqueue_script( 'flv-admin-script', $this->plugin_url. 'assets/js/admin.js','','',true);
	}
	// Add flv-has-gallery class to products that have a gallery
	function product_has_gallery( $classes ) {
		global $product;
	
		$post_type = get_post_type( get_the_ID() );
	
		if ( ! is_admin() ) {
			if ( $post_type == 'product' ) {
		
			$attachment_ids = $product->get_gallery_attachment_ids();
	
			if ( $attachment_ids ) {
				$classes[] = 'flv-has-gallery';
			}
		}
		}
	
		return $classes;
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/* Frontend Functions */
	/*-----------------------------------------------------------------------------------*/
	
	// Display the second thumbnails
	function woocommerce_template_loop_second_product_thumbnail() {
		global $product, $woocommerce;
	
	$attachment_ids = $product->get_gallery_attachment_ids();
	
	$flv_id= get_post_meta($product->id, 'woo_flip_img', true);  
	
	if(!$flv_id){	if ( $attachment_ids ) {	$flv_id = $attachment_ids['0'];} }
	if($flv_id)	{	echo wp_get_attachment_image( $flv_id,  "medium", '', $attr = array( 'class' => 'flv_second_img attachment-shop-catalog' ) );}
		
	}



public static  function flv_create_pages(){
   	    $page_title = __('Settings', 'fialovy');
		$menu_title = __('Woo Flip', 'fialovy');
		$capability = 'manage_options';
		$function =  array( 'flv_woo_flip_img', 'flv_enable_settings');
		$parent_slug='options-general.php';
		add_submenu_page($parent_slug, $page_title, $menu_title, $capability, basename(__FILE__), $function);

}


public static  function flv_enable_settings(){
   	 ?>
	<div class="wrap flv_wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2 class="flv_title"><?php _e('WooCommerce Flip Product Image Settings', 'fialovy'); ?></h2>

		<form method="post" action="options.php" class="flv-custom-port-table">
	<table class="form-table wp-list-table widefat fixed posts">
		<thead>
		 <th style="width:15%" class="manage-column " id="options" scope="col"><?php _e('Option name','fialovy');?></th>
        <th style="width:85%" class="manage-column " id="value" scope="col"><?php _e('Value','fialovy');?></th>
        </thead>
        
        <?php settings_fields('flv_woo_flip_admin_settings'); ?>
		<?php do_settings_sections('flv_woo_flip_admin_settings'); ?>
    </table>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php _e('Save Changes', 'fialovy'); ?>" />
		</p>
	</form>
	</div>

<?php }


public static  function flv_handle_admin_init(){

	register_setting( 'flv_woo_flip_admin_settings', 'flv_woo_flip_admin_settings', array('flv_woo_flip_img', 'settings_validate'));
	add_settings_section('flv_woo_flip_settings', '', array('flv_woo_flip_img', 'flv_section_settings' ),'flv_woo_flip_admin_settings');
	
	add_settings_field( 'flv_woo_flip_hover_in','', array('flv_woo_flip_img', 'flv_section_woo_flip_hover_in' ),'flv_woo_flip_admin_settings', 'flv_woo_flip_settings');
	add_settings_field( 'flv_woo_flip_hover_out','', array('flv_woo_flip_img', 'flv_section_woo_flip_hover_out' ),'flv_woo_flip_admin_settings', 'flv_woo_flip_settings');
	
	add_settings_field( 'flv_woo_flip_space',  '', array('flv_woo_flip_img', 'flv_section_space' ),'flv_woo_flip_admin_settings', 'flv_woo_flip_settings');
}
   
   
public static function settings_validate($input) {			return $input;		}
public static  function flv_section_settings() 	{}
public static function flv_section_space() 	{ ?>	 <tr class="flv_important_space"><th scope="row"></th><td></td></tr><?php		}

public static function flv_section_woo_flip_hover_in() 	{
$options = get_option( 'flv_woo_flip_admin_settings' );    
$selected1 = isset( $options['flv_woo_flip_hover_in'] ) ? esc_attr( $options['flv_woo_flip_hover_in'] ) : 'fadeInDown'; ?>

	 <tr> <th scope="row"><?php _e('Hover IN animation','fialovy');?>:</th> <td><select name="flv_woo_flip_admin_settings[flv_woo_flip_hover_in]">
        <optgroup label="Attention Seekers">
          <option <?php echo selected( $selected1, "bounce" ,false); ?> value="bounce">bounce</option>
          <option <?php echo selected( $selected1, "flash" ,false); ?> value="flash">flash</option>
          <option <?php echo selected( $selected1, "pulse" ,false); ?> value="pulse">pulse</option>
          <option <?php echo selected( $selected1, "rubberBand" ,false); ?> value="rubberBand">rubberBand</option>
          <option <?php echo selected( $selected1, "shake" ,false); ?> value="shake">shake</option>
          <option <?php echo selected( $selected1, "swing" ,false); ?> value="swing">swing</option>
          <option <?php echo selected( $selected1, "tada" ,false); ?> value="tada">tada</option>
          <option <?php echo selected( $selected1, "wobble" ,false); ?> value="wobble">wobble</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option <?php echo selected( $selected1, "bounceIn" ,false); ?> value="bounceIn">bounceIn</option>
          <option <?php echo selected( $selected1, "bounceInDown" ,false); ?> value="bounceInDown">bounceInDown</option>
          <option <?php echo selected( $selected1, "bounceInLeft" ,false); ?> value="bounceInLeft">bounceInLeft</option>
          <option <?php echo selected( $selected1, "bounceInRight" ,false); ?> value="bounceInRight">bounceInRight</option>
          <option <?php echo selected( $selected1, "bounceInUp" ,false); ?> value="bounceInUp">bounceInUp</option>
        </optgroup>

        <optgroup label="Bouncing Exits">
          <option <?php echo selected( $selected1, "bounceOut" ,false); ?> value="bounceOut">bounceOut</option>
          <option <?php echo selected( $selected1, "bounceOutDown" ,false); ?> value="bounceOutDown">bounceOutDown</option>
          <option <?php echo selected( $selected1, "bounceOutLeft" ,false); ?> value="bounceOutLeft">bounceOutLeft</option>
          <option <?php echo selected( $selected1, "bounceOutRight" ,false); ?> value="bounceOutRight">bounceOutRight</option>
          <option <?php echo selected( $selected1, "bounceOutUp" ,false); ?> value="bounceOutUp">bounceOutUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option <?php echo selected( $selected1, "fadeIn" ,false); ?> value="fadeIn">fadeIn</option>
          <option <?php echo selected( $selected1, "fadeInDown" ,false); ?> value="fadeInDown">fadeInDown</option>
          <option <?php echo selected( $selected1, "fadeInDownBig" ,false); ?> value="fadeInDownBig">fadeInDownBig</option>
          <option <?php echo selected( $selected1, "fadeInLeft" ,false); ?> value="fadeInLeft">fadeInLeft</option>
          <option <?php echo selected( $selected1, "fadeInLeftBig" ,false); ?> value="fadeInLeftBig">fadeInLeftBig</option>
          <option <?php echo selected( $selected1, "fadeInRight" ,false); ?> value="fadeInRight">fadeInRight</option>
          <option <?php echo selected( $selected1, "fadeInRightBig" ,false); ?> value="fadeInRightBig">fadeInRightBig</option>
          <option <?php echo selected( $selected1, "fadeInUp" ,false); ?> value="fadeInUp">fadeInUp</option>
          <option <?php echo selected( $selected1, "fadeInUpBig" ,false); ?> value="fadeInUpBig">fadeInUpBig</option>
        </optgroup>

        <optgroup label="Fading Exits">
          <option <?php echo selected( $selected1, "fadeOut" ,false); ?> value="fadeOut">fadeOut</option>
          <option <?php echo selected( $selected1, "fadeOutDown" ,false); ?> value="fadeOutDown">fadeOutDown</option>
          <option <?php echo selected( $selected1, "fadeOutDownBig" ,false); ?> value="fadeOutDownBig">fadeOutDownBig</option>
          <option <?php echo selected( $selected1, "fadeOutLeft" ,false); ?> value="fadeOutLeft">fadeOutLeft</option>
          <option <?php echo selected( $selected1, "fadeOutLeftBig" ,false); ?> value="fadeOutLeftBig">fadeOutLeftBig</option>
          <option <?php echo selected( $selected1, "fadeOutRight" ,false); ?> value="fadeOutRight">fadeOutRight</option>
          <option <?php echo selected( $selected1, "fadeOutRightBig" ,false); ?> value="fadeOutRightBig">fadeOutRightBig</option>
          <option <?php echo selected( $selected1, "fadeOutUp" ,false); ?> value="fadeOutUp">fadeOutUp</option>
          <option <?php echo selected( $selected1, "fadeOutUpBig" ,false); ?> value="fadeOutUpBig">fadeOutUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option <?php echo selected( $selected1, "flip" ,false); ?> value="flip">flip</option>
          <option <?php echo selected( $selected1, "flipInX" ,false); ?> value="flipInX">flipInX</option>
          <option <?php echo selected( $selected1, "flipInY" ,false); ?> value="flipInY">flipInY</option>
          <option <?php echo selected( $selected1, "flipOutX" ,false); ?> value="flipOutX">flipOutX</option>
          <option <?php echo selected( $selected1, "flipOutY" ,false); ?> value="flipOutY">flipOutY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option <?php echo selected( $selected1, "lightSpeedIn" ,false); ?> value="lightSpeedIn">lightSpeedIn</option>
          <option <?php echo selected( $selected1, "lightSpeedOut" ,false); ?> value="lightSpeedOut">lightSpeedOut</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option <?php echo selected( $selected1, "rotateIn" ,false); ?> value="rotateIn">rotateIn</option>
          <option <?php echo selected( $selected1, "rotateInDownLeft" ,false); ?> value="rotateInDownLeft">rotateInDownLeft</option>
          <option <?php echo selected( $selected1, "rotateInDownRight" ,false); ?> value="rotateInDownRight">rotateInDownRight</option>
          <option <?php echo selected( $selected1, "rotateInUpLeft" ,false); ?> value="rotateInUpLeft">rotateInUpLeft</option>
          <option <?php echo selected( $selected1, "rotateInUpRight" ,false); ?> value="rotateInUpRight">rotateInUpRight</option>
        </optgroup>

        <optgroup label="Rotating Exits">
          <option <?php echo selected( $selected1, "rotateOut" ,false); ?> value="rotateOut">rotateOut</option>
          <option <?php echo selected( $selected1, "rotateOutDownLeft" ,false); ?> value="rotateOutDownLeft">rotateOutDownLeft</option>
          <option <?php echo selected( $selected1, "rotateOutDownRight" ,false); ?> value="rotateOutDownRight">rotateOutDownRight</option>
          <option <?php echo selected( $selected1, "rotateOutUpLeft" ,false); ?> value="rotateOutUpLeft">rotateOutUpLeft</option>
          <option <?php echo selected( $selected1, "rotateOutUpRight" ,false); ?> value="rotateOutUpRight">rotateOutUpRight</option>
        </optgroup>

        <optgroup label="Specials">
          <option <?php echo selected( $selected1, "hinge" ,false); ?> value="hinge">hinge</option>
          <option <?php echo selected( $selected1, "rollIn" ,false); ?> value="rollIn">rollIn</option>
          <option <?php echo selected( $selected1, "rollOut" ,false); ?> value="rollOut">rollOut</option>
        </optgroup>

        <optgroup label="Zoom Entrances">
          <option <?php echo selected( $selected1, "zoomIn" ,false); ?> value="zoomIn">zoomIn</option>
          <option <?php echo selected( $selected1, "zoomInDown" ,false); ?> value="zoomInDown">zoomInDown</option>
          <option <?php echo selected( $selected1, "zoomInLeft" ,false); ?> value="zoomInLeft">zoomInLeft</option>
          <option <?php echo selected( $selected1, "zoomInRight" ,false); ?> value="zoomInRight">zoomInRight</option>
          <option <?php echo selected( $selected1, "zoomInUp" ,false); ?> value="zoomInUp">zoomInUp</option>
        </optgroup>

        <optgroup label="Zoom Exits">
          <option <?php echo selected( $selected1, "zoomOut" ,false); ?> value="zoomOut">zoomOut</option>
          <option <?php echo selected( $selected1, "zoomOutDown" ,false); ?> value="zoomOutDown">zoomOutDown</option>
          <option <?php echo selected( $selected1, "zoomOutLeft" ,false); ?> value="zoomOutLeft">zoomOutLeft</option>
          <option <?php echo selected( $selected1, "zoomOutRight" ,false); ?> value="zoomOutRight">zoomOutRight</option>
          <option <?php echo selected( $selected1, "zoomOutUp" ,false); ?> value="zoomOutUp">zoomOutUp</option>
        </optgroup>

    </select></td> </tr>    	    <?php		}

public static function flv_section_woo_flip_hover_out() 	{
$options = get_option( 'flv_woo_flip_admin_settings' ); 
$selected2 = isset( $options['flv_woo_flip_hover_out'] ) ? esc_attr( $options['flv_woo_flip_hover_out']) : 'fadeOutUp';  ?>

	 <tr> <th scope="row"><?php _e('Hover OUT animation','fialovy');?>:</th> <td><select name="flv_woo_flip_admin_settings[flv_woo_flip_hover_out]">
	<optgroup label="Attention Seekers">
          <option <?php echo selected( $selected2, "bounce" ,false); ?> value="bounce">bounce</option>
          <option <?php echo selected( $selected2, "flash" ,false); ?> value="flash">flash</option>
          <option <?php echo selected( $selected2, "pulse" ,false); ?> value="pulse">pulse</option>
          <option <?php echo selected( $selected2, "rubberBand" ,false); ?> value="rubberBand">rubberBand</option>
          <option <?php echo selected( $selected2, "shake" ,false); ?> value="shake">shake</option>
          <option <?php echo selected( $selected2, "swing" ,false); ?> value="swing">swing</option>
          <option <?php echo selected( $selected2, "tada" ,false); ?> value="tada">tada</option>
          <option <?php echo selected( $selected2, "wobble" ,false); ?> value="wobble">wobble</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option <?php echo selected( $selected2, "bounceIn" ,false); ?> value="bounceIn">bounceIn</option>
          <option <?php echo selected( $selected2, "bounceInDown" ,false); ?> value="bounceInDown">bounceInDown</option>
          <option <?php echo selected( $selected2, "bounceInLeft" ,false); ?> value="bounceInLeft">bounceInLeft</option>
          <option <?php echo selected( $selected2, "bounceInRight" ,false); ?> value="bounceInRight">bounceInRight</option>
          <option <?php echo selected( $selected2, "bounceInUp" ,false); ?> value="bounceInUp">bounceInUp</option>
        </optgroup>

        <optgroup label="Bouncing Exits">
          <option <?php echo selected( $selected2, "bounceOut" ,false); ?> value="bounceOut">bounceOut</option>
          <option <?php echo selected( $selected2, "bounceOutDown" ,false); ?> value="bounceOutDown">bounceOutDown</option>
          <option <?php echo selected( $selected2, "bounceOutLeft" ,false); ?> value="bounceOutLeft">bounceOutLeft</option>
          <option <?php echo selected( $selected2, "bounceOutRight" ,false); ?> value="bounceOutRight">bounceOutRight</option>
          <option <?php echo selected( $selected2, "bounceOutUp" ,false); ?> value="bounceOutUp">bounceOutUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option <?php echo selected( $selected2, "fadeIn" ,false); ?> value="fadeIn">fadeIn</option>
          <option <?php echo selected( $selected2, "fadeInDown" ,false); ?> value="fadeInDown">fadeInDown</option>
          <option <?php echo selected( $selected2, "fadeInDownBig" ,false); ?> value="fadeInDownBig">fadeInDownBig</option>
          <option <?php echo selected( $selected2, "fadeInLeft" ,false); ?> value="fadeInLeft">fadeInLeft</option>
          <option <?php echo selected( $selected2, "fadeInLeftBig" ,false); ?> value="fadeInLeftBig">fadeInLeftBig</option>
          <option <?php echo selected( $selected2, "fadeInRight" ,false); ?> value="fadeInRight">fadeInRight</option>
          <option <?php echo selected( $selected2, "fadeInRightBig" ,false); ?> value="fadeInRightBig">fadeInRightBig</option>
          <option <?php echo selected( $selected2, "fadeInUp" ,false); ?> value="fadeInUp">fadeInUp</option>
          <option <?php echo selected( $selected2, "fadeInUpBig" ,false); ?> value="fadeInUpBig">fadeInUpBig</option>
        </optgroup>

        <optgroup label="Fading Exits">
          <option <?php echo selected( $selected2, "fadeOut" ,false); ?> value="fadeOut">fadeOut</option>
          <option <?php echo selected( $selected2, "fadeOutDown" ,false); ?> value="fadeOutDown">fadeOutDown</option>
          <option <?php echo selected( $selected2, "fadeOutDownBig" ,false); ?> value="fadeOutDownBig">fadeOutDownBig</option>
          <option <?php echo selected( $selected2, "fadeOutLeft" ,false); ?> value="fadeOutLeft">fadeOutLeft</option>
          <option <?php echo selected( $selected2, "fadeOutLeftBig" ,false); ?> value="fadeOutLeftBig">fadeOutLeftBig</option>
          <option <?php echo selected( $selected2, "fadeOutRight" ,false); ?> value="fadeOutRight">fadeOutRight</option>
          <option <?php echo selected( $selected2, "fadeOutRightBig" ,false); ?> value="fadeOutRightBig">fadeOutRightBig</option>
          <option <?php echo selected( $selected2, "fadeOutUp" ,false); ?> value="fadeOutUp">fadeOutUp</option>
          <option <?php echo selected( $selected2, "fadeOutUpBig" ,false); ?> value="fadeOutUpBig">fadeOutUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option <?php echo selected( $selected2, "flip" ,false); ?> value="flip">flip</option>
          <option <?php echo selected( $selected2, "flipInX" ,false); ?> value="flipInX">flipInX</option>
          <option <?php echo selected( $selected2, "flipInY" ,false); ?> value="flipInY">flipInY</option>
          <option <?php echo selected( $selected2, "flipOutX" ,false); ?> value="flipOutX">flipOutX</option>
          <option <?php echo selected( $selected2, "flipOutY" ,false); ?> value="flipOutY">flipOutY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option <?php echo selected( $selected2, "lightSpeedIn" ,false); ?> value="lightSpeedIn">lightSpeedIn</option>
          <option <?php echo selected( $selected2, "lightSpeedOut" ,false); ?> value="lightSpeedOut">lightSpeedOut</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option <?php echo selected( $selected2, "rotateIn" ,false); ?> value="rotateIn">rotateIn</option>
          <option <?php echo selected( $selected2, "rotateInDownLeft" ,false); ?> value="rotateInDownLeft">rotateInDownLeft</option>
          <option <?php echo selected( $selected2, "rotateInDownRight" ,false); ?> value="rotateInDownRight">rotateInDownRight</option>
          <option <?php echo selected( $selected2, "rotateInUpLeft" ,false); ?> value="rotateInUpLeft">rotateInUpLeft</option>
          <option <?php echo selected( $selected2, "rotateInUpRight" ,false); ?> value="rotateInUpRight">rotateInUpRight</option>
        </optgroup>

        <optgroup label="Rotating Exits">
          <option <?php echo selected( $selected2, "rotateOut" ,false); ?> value="rotateOut">rotateOut</option>
          <option <?php echo selected( $selected2, "rotateOutDownLeft" ,false); ?> value="rotateOutDownLeft">rotateOutDownLeft</option>
          <option <?php echo selected( $selected2, "rotateOutDownRight" ,false); ?> value="rotateOutDownRight">rotateOutDownRight</option>
          <option <?php echo selected( $selected2, "rotateOutUpLeft" ,false); ?> value="rotateOutUpLeft">rotateOutUpLeft</option>
          <option <?php echo selected( $selected2, "rotateOutUpRight" ,false); ?> value="rotateOutUpRight">rotateOutUpRight</option>
        </optgroup>

        <optgroup label="Specials">
          <option <?php echo selected( $selected2, "hinge" ,false); ?> value="hinge">hinge</option>
          <option <?php echo selected( $selected2, "rollIn" ,false); ?> value="rollIn">rollIn</option>
          <option <?php echo selected( $selected2, "rollOut" ,false); ?> value="rollOut">rollOut</option>
        </optgroup>

        <optgroup label="Zoom Entrances">
          <option <?php echo selected( $selected2, "zoomIn" ,false); ?> value="zoomIn">zoomIn</option>
          <option <?php echo selected( $selected2, "zoomInDown" ,false); ?> value="zoomInDown">zoomInDown</option>
          <option <?php echo selected( $selected2, "zoomInLeft" ,false); ?> value="zoomInLeft">zoomInLeft</option>
          <option <?php echo selected( $selected2, "zoomInRight" ,false); ?> value="zoomInRight">zoomInRight</option>
          <option <?php echo selected( $selected2, "zoomInUp" ,false); ?> value="zoomInUp">zoomInUp</option>
        </optgroup>

        <optgroup label="Zoom Exits">
          <option <?php echo selected( $selected2, "zoomOut" ,false); ?> value="zoomOut">zoomOut</option>
          <option <?php echo selected( $selected2, "zoomOutDown" ,false); ?> value="zoomOutDown">zoomOutDown</option>
          <option <?php echo selected( $selected2, "zoomOutLeft" ,false); ?> value="zoomOutLeft">zoomOutLeft</option>
          <option <?php echo selected( $selected2, "zoomOutRight" ,false); ?> value="zoomOutRight">zoomOutRight</option>
          <option <?php echo selected( $selected2, "zoomOutUp" ,false); ?> value="zoomOutUp">zoomOutUp</option>
        </optgroup>
        
          </select></td> </tr>    	    <?php		}


		}


		$flv_woo_flip_img = new flv_woo_flip_img();
	}
}
