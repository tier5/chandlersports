<?php
/*
Plugin Name: WooCommerce Product Enquiry Form
Plugin URI: http://woothemes.com/woocommerce
Description: Adds an enquiry form tab to certain product pages which allows customers to contact you about a product. Also includes optional reCAPTCHA for preventing spam.
Version: 1.0.4
Author: WooThemes
Author URI: http://woothemes.com
Requires at least: 3.1
Tested up to: 3.2

	Copyright: © 2009-2011 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 **/
if ( ! function_exists( 'is_woocommerce_active' ) ) require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 **/
if (is_admin()) {
	$woo_plugin_updater_product_enquiry_form = new WooThemes_Plugin_Updater( __FILE__ );
	$woo_plugin_updater_product_enquiry_form->api_key = '8afed9d94f86e5560c73c9eebd1fc7ac';
	$woo_plugin_updater_product_enquiry_form->init();
}
		
if (is_woocommerce_active()) {
	
	/**
	 * Localisation
	 **/
	load_plugin_textdomain('wc_enquiry_form', false, dirname( plugin_basename( __FILE__ ) ) . '/');
	
	/**
	 * woocommerce_product_enquiry_form class
	 **/
	if (!class_exists('woocommerce_product_enquiry_form')) {
	 
		class woocommerce_product_enquiry_form {
			
			var $send_to;
			var $settings;
			
			public function __construct() { 
				
				$this->send_to = get_option('woocommerce_product_enquiry_send_to');
				
				// Init settings
				$this->settings = array(
					array( 'name' => __( 'Product Enquiries', 'woothemes' ), 'type' => 'title', 'desc' => '', 'id' => 'product_enquiry' ),
					array(  
						'name' => __('Product enquiry email', 'wc_enquiry_form'),
						'desc' 		=> __('Where to send product enquiries.', 'wc_enquiry_form'),
						'id' 		=> 'woocommerce_product_enquiry_send_to',
						'type' 		=> 'text',
						'std'		=> get_option('admin_email')
					),
					array(  
						'name' => __('ReCaptcha public key', 'wc_enquiry_form'),
						'desc' 		=> __('Enter your key if you wish to use <a href="https://www.google.com/recaptcha/">recaptcha</a> on the product enquiry form.', 'wc_enquiry_form'),
						'id' 		=> 'woocommerce_recaptcha_public_key',
						'type' 		=> 'text',
						'std'		=> ''
					),
					array(  
						'name' => __('ReCaptcha private key', 'wc_enquiry_form'),
						'desc' 		=> __('Enter your key if you wish to use <a href="https://www.google.com/recaptcha/">recaptcha</a> on the product enquiry form.', 'wc_enquiry_form'),
						'id' 		=> 'woocommerce_recaptcha_private_key',
						'type' 		=> 'text',
						'std'		=> ''
					),
					array( 'type' => 'sectionend', 'id' => 'product_enquiry'),
				);
				
				// Default options
				add_option('woocommerce_product_enquiry_send_to', get_option('admin_email'));
				
				// Settings
				add_action('woocommerce_settings_general_options_after', array(&$this, 'admin_settings'));
				add_action('woocommerce_update_options_general', array(&$this, 'save_admin_settings'));
				
			   	// Frontend
				add_action('woocommerce_product_tabs', array(&$this, 'product_enquiry_tab'), 25);
				add_action('woocommerce_product_tab_panels', array(&$this, 'product_enquiry_tab_panel'), 25);
				
				// AJAX
				add_action('wp_ajax_woocommerce_product_enquiry_post', array(&$this, 'process_form'));
				add_action('wp_ajax_nopriv_woocommerce_product_enquiry_post', array(&$this, 'process_form'));
				
				// Write panel
				add_action('woocommerce_product_options_general_product_data', array(&$this, 'write_panel'));
				add_action('woocommerce_process_product_meta', array(&$this, 'write_panel_save'));
				
		    } 
		    
	        /*-----------------------------------------------------------------------------------*/
			/* Class Functions */
			/*-----------------------------------------------------------------------------------*/ 
			
			function product_enquiry_tab() {
				global $post, $woocommerce;
				
				if (get_post_meta($post->ID, 'woocommerce_disable_product_enquiry', true)=='yes') return;
				?>
				<li><a href="#tab-enquiry"><?php echo apply_filters('product_enquiry_tab_title', __('Product Enquiry', 'wc_enquiry_form')); ?></a></li>
				<?php
			}
			
			
			function product_enquiry_tab_panel() {
				global $post, $woocommerce;
				
				if (get_post_meta($post->ID, 'woocommerce_disable_product_enquiry', true)=='yes') return;
				
				if (is_user_logged_in()) :
					$current_user = get_user_by('id', get_current_user_id());
				endif;
			
				?>
				<div class="panel" id="tab-enquiry">
					<h2><?php echo apply_filters('product_enquiry_heading', __('Product Enquiry', 'wc_enquiry_form')); ?></h2>
				
					<form action="" method="post" id="product_enquiry_form">
						
						<?php do_action('product_enquiry_before_form'); ?>
						
						<p class="form-row form-row-first">
							<label for="product_enquiry_name"><?php _e('Name', 'wc_enquiry_form'); ?></label>
							<input type="text" class="input-text" name="product_enquiry_name" id="product_enquiry_name" placeholder="<?php _e('Your name', 'wc_enquiry_form'); ?>" value="<?php if (isset($current_user)) echo $current_user->user_nicename; ?>" />
						</p>
						
						<p class="form-row form-row-last">
							<label for="product_enquiry_email"><?php _e('Email address', 'wc_enquiry_form'); ?></label>
							<input type="text" class="input-text" name="product_enquiry_email" id="product_enquiry_email" placeholder="<?php _e('you@yourdomain.com', 'wc_enquiry_form'); ?>" value="<?php if (isset($current_user)) echo $current_user->user_email; ?>" />
						</p>
						
						<div class="clear"></div>
						
						<?php do_action('product_enquiry_before_message'); ?>
						
						<p class="form-row notes">
							<label for="product_enquiry_message"><?php _e('Enquiry', 'wc_enquiry_form'); ?></label>
							<textarea class="input-text" name="product_enquiry_message" id="product_enquiry_message" rows="5" cols="20" placeholder="<?php _e('What would you like to know?', 'wc_enquiry_form'); ?>"></textarea>
						</p>
						
						<?php do_action('product_enquiry_after_message'); ?>
						
						<div class="clear"></div>
						
						<?php
							$publickey = get_option('woocommerce_recaptcha_public_key');
							$privatekey = get_option('woocommerce_recaptcha_private_key');
  							if ($publickey && $privatekey) :
  								if (!function_exists('recaptcha_get_html')) require_once(WP_PLUGIN_DIR . "/" . plugin_basename( dirname(__FILE__)) . '/recaptchalib.php' );
  								
  								?>
  								<div class="form-row notes">
	  								<script type="text/javascript">
										var RecaptchaOptions = {
											theme : "clean"
										};
									</script>
									<?php echo recaptcha_get_html($publickey); ?>
								</div>
								<div class="clear"></div>
								<?php
								
  							endif;
						?>
						
						<p>
							<input type="hidden" name="product_id" value="<?php echo $post->ID; ?>" />
							<input type="submit" id="send_product_enquiry" value="<?php _e('Send Enquiry', 'wc_enquiry_form'); ?>" class="button" />
						</p>
						
						<?php do_action('product_enquiry_after_form'); ?>
						
					</form>
					
					<script type="text/javascript">
						
						jQuery(function(){
							jQuery('#send_product_enquiry').click(function(){
								
								// Remove errors
								jQuery('.product_enquiry_result').remove();
								
								// Required fields
								if (!jQuery('#product_enquiry_name').val()) {
									jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error"><?php _e('Please enter your name.', 'wc_enquiry_form'); ?></p>');
									jQuery('.product_enquiry_result').fadeIn();
									return false;
								}
								
								if (!jQuery('#product_enquiry_email').val()) {
									jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error"><?php _e('Please enter your email.', 'wc_enquiry_form'); ?></p>');
									jQuery('.product_enquiry_result').fadeIn();
									return false;
								}
								
								if (!jQuery('#product_enquiry_message').val()) {
									jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error"><?php _e('Please enter your enquiry.', 'wc_enquiry_form'); ?></p>');
									jQuery('.product_enquiry_result').fadeIn();
									return false;
								}

								// Block elements
								jQuery('#product_enquiry_form').block({message: null, overlayCSS: {background: '#fff url(<?php echo $woocommerce->plugin_url(); ?>/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.6}});
								
								// AJAX post
								var data = {
									action: 			'woocommerce_product_enquiry_post',
									security: 			'<?php echo wp_create_nonce("product-enquiry-post"); ?>',
									post_data:			jQuery('#product_enquiry_form').serialize()
								};
									
								jQuery.post( '<?php echo str_replace( array('https:', 'http:'), '', admin_url( 'admin-ajax.php' ) ); ?>', data, function(response) {									
									if (response=='SUCCESS') {
										
										jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_message"><?php echo apply_filters('product_enquiry_success_message', __('Enquiry sent successfully. We will get back to your shortly.', 'wc_enquiry_form')); ?></p>');
										
										jQuery('#product_enquiry_form textarea').val('');
										
									} else {
										
										if (window.Recaptcha) {
											Recaptcha.reload();
										}
										
										jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error">' + response + '</p>');
										
									}
									
									jQuery('#product_enquiry_form').unblock();
									
									jQuery('.product_enquiry_result').fadeIn();
								
								});
								
								return false;
								
							});
						});
						
					</script>
				
				</div>
				<?php
			}
			
			
			function process_form() {
				global $woocommerce;
				
				check_ajax_referer( 'product-enquiry-post', 'security' );
				
				do_action('product_enquiry_process_form');
				
				$post_data = array();
				parse_str($_POST['post_data'], $post_data);
				
				$name 		= isset($post_data['product_enquiry_name']) ? woocommerce_clean($post_data['product_enquiry_name']) : '';
				$email 		= isset($post_data['product_enquiry_email']) ? woocommerce_clean($post_data['product_enquiry_email']) : '';
				$enquiry 	= isset($post_data['product_enquiry_message']) ? woocommerce_clean($post_data['product_enquiry_message']) : '';
				$product_id = isset($post_data['product_id']) ? (int) $post_data['product_id'] : 0;
				
				if (!$product_id) :
					_e('Invalid product!', 'wc_enquiry_form');
					die();
				endif;
				
				if (!is_email($email)) :
					_e('Please enter a valid email.', 'wc_enquiry_form');
					die();
				endif;
				
				// Recaptcha
				$publickey = get_option('woocommerce_recaptcha_public_key');
				$privatekey = get_option('woocommerce_recaptcha_private_key');
				if ($publickey && $privatekey) :
					if (!function_exists('recaptcha_get_html')) require_once(WP_PLUGIN_DIR . "/" . plugin_basename( dirname(__FILE__)) . '/recaptchalib.php' );
					
					$resp = recaptcha_check_answer ($privatekey,
	                    $_SERVER["REMOTE_ADDR"],
	                    $post_data["recaptcha_challenge_field"],
	                    $post_data["recaptcha_response_field"]);
	            	
	            	if (!$resp->is_valid) :
	            		_e('Please double check the anti-spam field.', 'wc_enquiry_form');
						die();
	            	endif;
				
				endif;
				
				$product 	= get_post($product_id);
				$subject 	= apply_filters('product_enquiry_email_subject', sprintf( __('Product Enquiry - %s', 'wc_enquiry_form'), $product->post_title));
				
				$message = array();
				
				$message['greet']		= __("Hello, ", 'wc_enquiry_form');
				$message['space_1']  	= '';
				$message['intro']		= sprintf(__("You have been contacted by %s (%s) about %s (%s). Their enquiry is as follows: ", 'wc_enquiry_form'), $name, $email, $product->post_title, get_permalink($product->ID));
				$message['space_2']  	= '';
				$message['message'] 	= $enquiry;
				
				$message 	= implode("\n", apply_filters('product_enquiry_email_message', $message));
				
				$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
				
				if (wp_mail( $this->send_to, $subject, $message, $headers )) echo 'SUCCESS'; else echo 'Error';

				die();
			}

			function admin_settings() {
				woocommerce_admin_fields( $this->settings );
			}
			
			function save_admin_settings() {
				woocommerce_update_options( $this->settings );
			}
			
		    function write_panel() {
		    	echo '<div class="options_group">';
		    	woocommerce_wp_checkbox( array( 'id' => 'woocommerce_disable_product_enquiry', 'label' => __('Disable enquiry form?', 'wc_enquiry_form') ) );
		  		echo '</div>';
		    }
		    
		    function write_panel_save( $post_id ) {
		    	$woocommerce_disable_product_enquiry = isset($_POST['woocommerce_disable_product_enquiry']) ? 'yes' : 'no';
		    	update_post_meta($post_id, 'woocommerce_disable_product_enquiry', $woocommerce_disable_product_enquiry);
		    }
			
		}
		
		$GLOBALS['woocommerce_product_enquiry_form'] = new woocommerce_product_enquiry_form();
	}
}