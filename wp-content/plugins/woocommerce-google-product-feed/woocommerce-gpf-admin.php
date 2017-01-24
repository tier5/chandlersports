<?php

class woocommerce_gpf_admin {



	private $settings = array();
	private $product_fields = array ();



	function __construct() {

		$this->settings = get_option ( 'woocommerce_gpf_config' );
		$this->product_fields = array (
									'availability' => array (
										'desc' => __( 'Availability', 'woocommerce_gpf' ),
										'full_desc' => __( 'Availability status of items', 'woocommerce_gpf' ),
										'callback' => array ( &$this, 'render_availability' ),
										'can_default' => true ),
									
									'condition' => array (
										'desc' => __( 'Condition', 'woocommerce_gpf' ),
										'full_desc' => __ ( 'Condition or state of items', 'woocommerce_gpf' ),
										'callback' => array ( &$this, 'render_condition' ) ,
										'can_default' => true ),
									
									'brand' => array (
										'desc' => __( 'Brand', 'woocommerce_gpf' ),
										'full_desc' => __ ( 'Brand of the items', 'woocommerce_gpf' ),
										'can_default' => TRUE ),
									
									'product_type' => array (
										'desc' => __( 'Product Type', 'woocommerce_gpf' ),
										'full_desc' => __ ( 'Your category of the items', 'woocommerce_gpf' ),
										'callback' => array ( &$this, 'render_product_type' ),
										'can_default' => true ),
									
									'google_product_category' => array (
										'desc' => __( 'Google Product Category', 'woocommerce_gpf' ),
										'full_desc' => __ ( "Google's category of the item", 'woocommerce_gpf' ),
										'callback' => array ( &$this, 'render_product_type' ),
										'can_default' => true ),
									
									'gtin' => array (
										'desc' => __( 'Global Trade Item Number (GTIN)', 'woocommerce_gpf' ),
										'full_desc' => __ ( 'Global Trade Item Numbers (GTINs) for your items. These identifiers include UPC (in North America), EAN (in Europe), JAN (in Japan), and ISBN (for books)', 'woocommerce_gpf' ) ),
									
									'mpn' => array (
										'desc' => __( 'Manufacturer Part Number (MPN)', 'woocommerce_gpf' ),
										'full_desc' => __ ( "This code uniquely identifies the product to its manufacturer", 'woocommerce_gpf' )
										),
									
									'gender' => array (
										'desc' => __( 'Gender', 'woocommerce_gpf' ),
										'full_desc' => __ ( "Target gender for the item", 'woocommerce_gpf' ),
										'callback' => array ( &$this, 'render_gender' ),
										'can_default' => true ),
									
									'age_group' => array (
										'desc' => __( 'Age Group', 'woocommerce_gpf' ),
										'full_desc' => __ ( "Target age group for the item", 'woocommerce_gpf' ),
										'callback' => array ( &$this, 'render_age_group' ),
										'can_default' => true ),
									
									'color' => array (
										'desc' => __( 'Colour', 'woocommerce_gpf' ),
										'full_desc' => __ ( "Items' Colour", 'woocommerce_gpf' ) ),
									
									'size' => array (
										'desc' => __( 'Size', 'woocommerce_gpf' ),
										'full_desc' => __ ( "Size of the items", 'woocommerce_gpf' ) )
		);

		add_action ( 'init', array ( &$this, 'init' ) );
		add_action ( 'admin_init', array ( &$this, 'admin_init' ), 11 );
		add_action ( 'admin_print_styles', array ( &$this, 'enqueue_styles' ) );
		add_action ( 'admin_print_scripts', array ( &$this, 'enqueue_scripts' ) );

		// Extend Category Admin Page
		add_action( 'product_cat_add_form_fields', array ( &$this, 'category_meta_box' ), 99, 2 ); // After left-col
		add_action( 'product_cat_edit_form_fields', array ( &$this, 'category_meta_box' ), 99, 2 ); // After left-col
		add_action( 'created_product_cat', array ( &$this, 'save_category' ), 15 , 2 ); //After created
		add_action( 'edited_product_cat', array ( &$this, 'save_category' ), 15 , 2 ); //After saved

		add_filter ( 'woocommerce_settings_tabs_array', array ( &$this, 'add_woocommerce_settings_tab' ) );
		add_action ( 'woocommerce_settings_tabs_gpf', array ( &$this, 'config_page' ) );
		add_action ( 'woocommerce_update_options_gpf', array ( &$this, 'save_settings' ) );

	}



	function init() {

		// Handle ajax requests for the taxonomy search
		if ( isset ( $_GET['woocommerce_gpf_search'] ) ) {
			$this->ajax_handler($_GET['query']);
			exit();
		}

		$this->product_fields = apply_filters ( 'woocommerce_wpf_product_fields', $this->product_fields );
		load_plugin_textdomain ( 'woocommerce_gpf', false, basename( dirname( __FILE__ ) ) . '/languages' );

	}



	function admin_init() {

		// Extend Product Edit Page
		// Note: meta box added in admin_init() - does it need to be?
		add_action ( 'save_post', array ( &$this, 'save_product' ) );

		if ( isset ( $this->settings['product_fields'] ) && count( $this->settings['product_fields'] ) ) {
			add_meta_box ( 'woocommerce-gpf-product-fields', __('Google Product Feed Information', 'woocommerce_gpf'), array(&$this, 'product_meta_box'), 'product', 'advanced', 'high' ) ;
		}

	}



	function ajax_handler( $query ) {

		global $wpdb, $table_prefix;

		// Make sure the taxonomy is up to date
		$taxonomy = $this->refresh_google_taxonomy();

		$sql = "SELECT taxonomy_term FROM ${table_prefix}woocommerce_gpf_google_taxonomy WHERE search_term LIKE %s";
		$results = $wpdb->get_results ( $wpdb->prepare ( $sql, "%".strtolower($query)."%" ) );

		$suggestions = array ();

		foreach ( $results as $match ) {
			$suggestions[] = $match->taxonomy_term;
		}

		$results = array ( 'query' => $query, 'suggestions' => $suggestions, 'data' => $suggestions );
		echo json_encode( $results );
		exit();
	}



	/*
     * Enqueue CSS needed for product pages
     */
	function enqueue_styles() {
		wp_enqueue_style ( 'woocommerce_gpf_admin', plugins_url(basename(dirname(__FILE__))) . '/css/woocommerce-gpf.css' );
		wp_enqueue_style ( 'wooautocomplete', plugins_url(basename(dirname(__FILE__))) . '/js/jquery.autocomplete.css' );
	}



	/**
	 * Enqueue javascript for product_type / google_product_category selector
	 */
	function enqueue_scripts() {
		wp_enqueue_script ( 'wooautocomplete', plugins_url(basename(dirname(__FILE__))) . '/js/jquery.autocomplete.js', array ('jquery', 'jquery-ui-core') );
	}



	/*
     * Render the form to allow users to set defaults per-category
	 *
	 * @param unknown $termortax
	 * @param unknown $taxonomy  (optional)
	 */
	function category_meta_box( $termortax, $taxonomy = null ) {

		// So we can use the same function for add and edit forms
		if ( $taxonomy === null ) {
			$taxonomy = $termortax;
			$term = null;
		} else {
			$term = $termortax;
		}
?>
        <tr>
          <td colspan="2">
            <h3><?php _e('Google Product Feed Information', 'woocommerce_gpf'); ?></h3>
            <p><?php _e ( 'Only enter values here if you want to over-ride the store defaults for products in this category. You can still override the values here against individual products if you want to.', 'woocommerce_gpf'); ?></p>
          </td>
        </tr>
<?php

		if ( $term )
			$current_data = get_metadata ( 'woocommerce_term', $term->term_id, '_woocommerce_gpf_data', true);
		else
			$current_data = array();

		foreach ( $this->product_fields as $key => $fieldinfo ) {

			if ( ! isset ( $this->{"settings"}['product_fields'][$key] ) )
				continue;

			$config = &$this->settings['product_fields'][$key];

			echo '<tr><th>';
			echo '<label for="_woocommerce_gpf_data['.$key.']">'.esc_html($fieldinfo['desc'])."<br/>";
			if ( isset ( $fieldinfo['can_default'] ) && ! empty ( $this->settings['product_defaults'][$key] ) ) {
				echo ' <span class="woocommerce_gpf_default_label">('.__( 'Default: ', 'woocommerce_gpf' ).esc_html($this->settings['product_defaults'][$key]).')</span>';
			}
			echo '</label></th><td>';

			if ( ! isset ( $fieldinfo['callback'] ) || ! is_callable( $fieldinfo['callback'] ) ) {

				echo '<input type="textbox" name="_woocommerce_gpf_data['.$key.']" ';
				if ( !empty ( $current_data[$key] ) )
					echo ' value="'.esc_attr($current_data[$key]).'"';
				echo '>';

			} else {

				if ( isset ( $current_data[$key] ) ) {
					call_user_func( $fieldinfo['callback'], $key, $current_data[$key] );
				} else {
					call_user_func( $fieldinfo['callback'], $key );
				}

			}
			echo '</td></tr>';

		}

	}



	/**
	 * Store the per-category defaults
	 *
	 * @param unknown $term_id
	 */
	function save_category( $term_id ) {

		foreach ( $_POST['_woocommerce_gpf_data'] as $key => $value ) {
			$_POST['_woocommerce_gpf_data'][$key] = stripslashes($value);
		}

		if ( isset ( $_POST['_woocommerce_gpf_data'] ) ) {
			update_metadata('woocommerce_term', $term_id, '_woocommerce_gpf_data', $_POST['_woocommerce_gpf_data']);
		}

	}



	/**
	 * Meta box on product pages for setting per-product information
	 */
	function product_meta_box() {

		global $post, $woocommerce_gpf_common;

		$current_data = get_post_meta ( $post->ID, '_woocommerce_gpf_data', true );
		$product_defaults = $woocommerce_gpf_common->get_values_for_product ( $post->ID, true );

		echo '<p>';
		echo '<input type="checkbox" id="woocommerce_gpf_excluded" name="_woocommerce_gpf_data[exclude_product]" '. ((isset($current_data['exclude_product'])) ? checked ( $current_data['exclude_product'], 'on', false ) : '') .'>';
		echo '<label for="_woocommerce_gpf_data[exclude_product]">'.__("Hide this product from the feed", 'woocommerce_gpf');
		echo '</p>';

		echo '<div id="woocommerce_gpf_options">';
		foreach ( $this->product_fields as $key => $fieldinfo ) {

			if ( ! isset ( $this->{"settings"}['product_fields'][$key] ) )
				continue;

			$config = &$this->settings['product_fields'][$key];

			echo '<p><label for="_woocommerce_gpf_data['.$key.']">'.esc_html($fieldinfo['desc']);
			if ( isset ( $fieldinfo['can_default'] ) && ! empty ( $product_defaults[$key] ) ) {
				echo ' <span class="woocommerce_gpf_default_label">('.__( 'Default: ', 'woocommerce_gpf' ).esc_html($product_defaults[$key]).')</span>';
			}
			echo '</label><br/>';

			if ( ! isset ( $fieldinfo['callback'] ) || ! is_callable( $fieldinfo['callback'] ) ) {

				echo '<input type="textbox" name="_woocommerce_gpf_data['.$key.']" ';
				if ( !empty ( $current_data[$key] ) )
					echo ' value="'.esc_attr($current_data[$key]).'"';
				echo '>';

			} else {

				if ( isset ( $current_data[$key] ) ) {
					call_user_func( $fieldinfo['callback'], $key, $current_data[$key] );
				} else {
					call_user_func( $fieldinfo['callback'], $key );
				}

			}
			echo '</p>';

		}
		echo '</div>';
		?>
		<script type="text/javascript">
			jQuery('#woocommerce_gpf_excluded').change(function() {
					if (jQuery("#woocommerce_gpf_excluded").is(':checked')) {
						jQuery('#woocommerce_gpf_options').slideUp('400','swing');
					} else {
						jQuery('#woocommerce_gpf_options').slideDown('400','swing');
					}
				}
			);
			jQuery('#woocommerce_gpf_excluded').change();
		</script>
		<?php
	}



	/**
	 * Store the per-product meta information. Called from wpsc_edit_product which has already checked we're not in an AUTOSAVE
	 *
	 * @param unknown $product_id
	 */
	function save_product( $product_id ) {

		// verify if this is an auto save routine.
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( empty ( $_POST['_woocommerce_gpf_data'] ) )
			return;

		$current_data = get_post_meta ( $product_id, '_woocommerce_gpf_data', true );

		if ( ! $current_data )
			$current_data = array();

		// Remove entries that are blanked out
		foreach ( $_POST['_woocommerce_gpf_data'] as $key => $value) {
			if ( empty ( $value ) ) {
				unset ( $_POST['_woocommerce_gpf_data'][$key] );
				if ( isset ( $current_data[$key] ) )
					unset ( $current_data[$key] );
			} else {
				$_POST['_woocommerce_gpf_data'][$key] = stripslashes($value);
			}
		}
		// Including missing checkboxes
		if ( ! isset ( $_POST['_woocommerce_gpf_data']['exclude_product'] ) ) {
			unset ( $current_data['exclude_product'] );
		}

		$current_data = array_merge( $current_data, $_POST['_woocommerce_gpf_data'] );

		update_post_meta ( $product_id, '_woocommerce_gpf_data', $current_data );

	}



	/**
	 * Used to render the drop-down of valid gender options
	 * PS. Excellent function name
	 *
	 * @param unknown $key
	 * @param unknown $current_data (optional)
	 */
	private function render_gender( $key, $current_data = NULL ) {
?>
        <select name="_woocommerce_gpf_data[<?php esc_attr_e($key); ?>]">
            <option value=""> <?php if ( isset ( $_REQUEST['post'] ) || isset ( $_REQUEST['taxonomy'] ) ) { _e ( 'Use default', 'woocommerce_gpf' ); } else { _e ( 'No default', 'woocommerce_gpf'); }; ?></option>
            <option value="male" <?php if ( $current_data == 'male' ) echo 'selected'; ?>><?php _e ( 'Male', 'woocommerce_gpf'); ?></option>
            <option value="female" <?php if ( $current_data == 'female' ) echo 'selected'; ?>><?php _e ( 'Female', 'woocommerce_gpf'); ?></option>
            <option value="unisex" <?php if ( $current_data == 'unisex' ) echo 'selected'; ?>><?php _e ( 'Unisex', 'woocommerce_gpf'); ?></option>
        </select>
        <?php
	}



	/**
	 * Used to render the drop-down of valid conditions
	 *
	 * @param unknown $key
	 * @param unknown $current_data (optional)
	 */
	private function render_condition( $key, $current_data = NULL ) {
?>
        <select name="_woocommerce_gpf_data[<?php esc_attr_e($key); ?>]">
            <option value=""> <?php if ( isset ( $_REQUEST['post'] ) || isset ( $_REQUEST['taxonomy'] ) ) { _e ( 'Use default', 'woocommerce_gpf' ); } else { _e ( 'No default', 'woocommerce_gpf'); }; ?></option>
            <option value="new" <?php if ( $current_data == 'new' ) echo 'selected'; ?>><?php _e ( 'New', 'woocommerce_gpf'); ?></option>
            <option value="refurbished" <?php if ( $current_data == 'refurbished' ) echo 'selected'; ?>><?php _e ( 'Refurbished', 'woocommerce_gpf'); ?></option>
            <option value="used" <?php if ( $current_data == 'used' ) echo 'selected'; ?>><?php _e ( 'Used', 'woocommerce_gpf'); ?></option>
        </select>
        <?php
	}



	/**
	 * Used to render the drop-down of valid availability
	 *
	 * @param unknown $key
	 * @param unknown $current_data (optional)
	 */
	private function render_availability( $key, $current_data = NULL ) {
?>
        <select name="_woocommerce_gpf_data[<?php esc_attr_e($key); ?>]">
            <option value=""> <?php if ( isset ( $_REQUEST['post'] ) || isset ( $_REQUEST['taxonomy'] ) ) { _e ( 'Use default', 'woocommerce_gpf' ); } else { _e ( 'No default', 'woocommerce_gpf'); }; ?></option>
            <option value="in stock" <?php if ( $current_data == 'in stock' ) echo 'selected'; ?>><?php _e ( 'In Stock', 'woocommerce_gpf'); ?></option>
            <option value="available for order" <?php if ( $current_data == 'available for order' ) echo 'selected'; ?>><?php _e ( 'Available for order', 'woocommerce_gpf'); ?></option>
            <option value="preorder" <?php if ( $current_data == 'preorder' ) echo 'selected'; ?>><?php _e ( 'Pre-Order', 'woocommerce_gpf'); ?></option>
        </select>
        <?php
	}



	/**
	 * Used to render the drop-down of valid age groups
	 *
	 * @param unknown $key
	 * @param unknown $current_data (optional)
	 */
	private function render_age_group( $key, $current_data = NULL ) {
?>
        <select name="_woocommerce_gpf_data[<?php esc_attr_e($key); ?>]">
            <option value=""> <?php if ( isset ( $_REQUEST['post'] ) || isset ( $_REQUEST['taxonomy'] ) ) { _e ( 'Use default', 'woocommerce_gpf' ); } else { _e ( 'No default', 'woocommerce_gpf'); }; ?></option>
            <option value="adult" <?php if ( $current_data == 'adult' ) echo 'selected'; ?>><?php _e ( 'Adults', 'woocommerce_gpf'); ?></option>
            <option value="kids" <?php if ( $current_data == 'kids' ) echo 'selected'; ?>><?php _e ( 'Children', 'woocommerce_gpf'); ?></option>
        </select>
        <?php
	}



	/*
     * Retrieve the Google taxonomy list to allow users to choose from it
	 *
	 * @return unknown
	 */
	private function refresh_google_taxonomy() {

		global $wpdb, $table_prefix;

		// Retrieve from cache - avoid hitting Google.com too much because you know they might mind :)
		$taxonomies_cached = get_transient ( 'woocommerce_gpf_taxonomy' );
		if ( $taxonomies_cached )
			return true;
		set_transient ( 'woocommerce_gpf_taxonomy', true, time() + 60*60*24*14 );

		$request = wp_remote_get ('http://www.google.com/basepages/producttype/taxonomy.en-US.txt');

		if ( is_wp_error ( $request ) || ! isset ( $request['response']['code'] ) || '200' != $request['response']['code'] )
			return array();

		$taxonomies = explode( "\n", $request['body'] );
		// Strip the comment at the top
		array_shift( $taxonomies );
		// Strip the extra newline at the end
		array_pop( $taxonomies ) ;

		$sql = "DELETE FROM ${table_prefix}woocommerce_gpf_google_taxonomy";
		$wpdb->query ( $sql );

		foreach  ( $taxonomies as $term ) {

			$sql = "INSERT INTO ${table_prefix}woocommerce_gpf_google_taxonomy VALUES ( %s, %s )";
			$wpdb->query ( $wpdb->prepare ( $sql, $term, strtolower( $term ) ) );
		}

		return true;
	}



	/**
	 * Let people choose from the Google taxonomy for the product_type tag
	 *
	 * @param unknown $key
	 * @param unknown $current_data (optional)
	 */
	function render_product_type( $key, $current_data = NULL) {

		$google_taxonomy = $this->refresh_google_taxonomy();
?>
        <input name="_woocommerce_gpf_data[<?php esc_attr_e($key); ?>]" class="woocommerce_gpf_product_type_<?php esc_attr_e ( $key ); ?>" <?php echo $current_data ? 'value="'.esc_attr($current_data).'"' : ''; ?> style="width: 800px;">
        <script type="text/javascript">
            jQuery(document).ready(function(){
                    jQuery('.woocommerce_gpf_product_type_<?php esc_attr_e ( $key ); ?>').wooautocomplete( { minChars: 3, deferRequestBy: 5, serviceUrl: 'index.php?woocommerce_gpf_search=true' } );
            });
        </script>
<?php
	}



	/**
	 *
	 * @param unknown $tabs
	 * @return unknown
	 */
	function add_woocommerce_settings_tab( $tabs ) {

		$tabs['gpf'] = __('Google Product Feed', 'woocommerce_gpf');
		return $tabs;

	}



	/**
	 * Show config page, and process form submission
	 */
	function config_page() {

		if ( ! empty ( $_POST['woocommerce_gpf_config'] ) ) {
			$this->save_settings();
		}

?>
        <h3><?php _e ( 'Settings for your store', 'woocommerce_gpf' ); ?></h3>
		<p><?php _e ("This page allows you to control what data is added to your Google Merchant Centre feed.", 'woocommerce_gpf'); ?></p>
        <p><?php _e ("Choose the fields you want to include here, and also set store-wide defaults. You can also set defaults against categories, or provide information on each product page. ", 'woocommerce_gpf'); ?><?php _e ( "Depending on what you sell, and where you are selling it to Google apply different rules as to which information you should supply. You can find Google's list of what information is required on ", 'woocommerce_gpf'); ?><a href="http://www.google.com/support/merchants/bin/answer.py?answer=188494" rel="nofollow"><?php _e ( 'this page', 'woocommerce_gpf' ); ?></a></p>
        <p><?php _e ( "Your feed is available here: ", 'woocommerce_gpf'); ?><a href="<?php esc_attr_e ( home_url()."/index.php?action=woocommerce_gpf" ); ?>" target="_blank"><?php esc_html_e ( home_url("/index.php?action=woocommerce_gpf") ); ?></a> or <a href="<?php esc_attr_e ( home_url("/index.php?action=woocommerce_gpf&feeddownload=true") ); ?>"><?php _e('download a copy of your feed', 'woocommerce_gpf'); ?></a>.</p>
        </p>

		<p><?php _e ( 'Choose which fields you want in your feed for each product, and set store-wide defaults below where necessary: ', 'woocommerce_gpf' ); ?><br/></p>
        <table class="form-table">
        <?php
		foreach ( $this->product_fields as $key => $info ) {
			echo '<tr valign="top">';
			echo '  <th scope="row" class="titledesc">'.esc_html ( $info['desc'] ). '</th>';
			echo '  <td class="forminp">';
			echo '    <div class="woocommerce_gpf_field_selector_group">';
			echo '    <input type="checkbox" class="woocommerce_gpf_field_selector" name="woocommerce_gpf_config[product_fields]['.$key.']" ';
			if ( isset ( $this->settings['product_fields'][$key] ) ) {
				echo 'checked="checked"';
			}
			echo '><label for="woocommerce_gpf_config[product_fields]['.$key.']">'.esc_html ( $info['full_desc'] ) . '</label>';
			if ( isset ( $this->product_fields[$key]['can_default'] ) ) {

				echo '<div class="woocommerce_gpf_config_'.$key.'"';
				if ( ! isset ( $this->settings['product_fields'][$key] ) ) {
					echo ' style="display:none;"';

				}
				echo '>'.__( 'Store default: ', 'woocommerce_gpf' );
				if ( ! isset ( $this->{"product_fields"}[$key]['callback'] ) || ! is_callable( $this->{"product_fields"}[$key]['callback'] ) ) {

					echo '<input type="textbox" name="_woocommerce_gpf_data['.$key.']" ';
					if ( !empty ( $this->settings['product_defaults'][$key] ) )
						echo ' value="'.esc_attr($this->settings['product_defaults'][$key]).'"';
					echo '>';

				} else {

					if ( isset ( $this->settings['product_defaults'][$key] ) ) {
						call_user_func( $this->{"product_fields"}[$key]['callback'], $key, $this->settings['product_defaults'][$key] );
					} else {
						call_user_func( $this->{"product_fields"}[$key]['callback'], $key );
					}

				}
				echo "</div></div></td>";
			}
			echo '</tr>';
		}
?>
        </table>
	    <script type="text/javascript">
		    jQuery(document).ready(function(){
  			    jQuery('.woocommerce_gpf_field_selector').change(function(){
  			    	group = jQuery(this).parent('.woocommerce_gpf_field_selector_group');
                    defspan = group.children('div');
                    defspan.slideToggle('fast');
                });
            });
        </script>
		<?php
	}



	/**
	 * Save the settings from the config page
	 */
	function save_settings() {

		// Check nonce
		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'woocommerce-settings' ) ) die( __( 'Action failed. Please refresh the page and retry.', 'woothemes' ) );

		if ( ! $this->settings ) {
			$this->settings = array();
			add_option ( 'woocommerce_gpf_config', $this->settings, '', 'yes' );
		}

		foreach ( $_POST['_woocommerce_gpf_data'] as $key => $value ) {
			$_POST['_woocommerce_gpf_data'][$key] = stripslashes($value);
		}

		// We do these so we can re-use the same form field rendering code for the fields
		if ( isset ( $_POST['_woocommerce_gpf_data'] ) ) {
			$_POST['woocommerce_gpf_config']['product_defaults'] = $_POST['_woocommerce_gpf_data'];
			unset ( $_POST['_woocommerce_gpf_data'] );
		}

		$this->settings = $_POST['woocommerce_gpf_config'];
		update_option ( 'woocommerce_gpf_config', $this->settings );

		echo '<div id="message" class="updated"><p>'.__('Settings saved.').'</p></div>';

	}


}


$woocommerce_gpf_admin = new woocommerce_gpf_admin();



?>
