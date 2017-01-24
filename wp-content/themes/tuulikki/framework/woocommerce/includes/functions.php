<?php
	require_once(TEMPLATEPATH . '/framework/woocommerce/includes/functions-woocommerce.php');

	ilgelo_woocommerce_setup();

	function ig_woocommerce_setup() {
		add_theme_support('woocommerce');
	}
	add_action('after_setup_theme', 'ig_woocommerce_setup');


	/*function ig_woocommerce_scripts() {
		wp_register_style('custom-woocommerce', get_template_directory_uri() . '/framework/woocommerce/css/woocommerce.css');
		//wp_enqueue_script('custom-woocommerce');
	}
	add_action('ig_woocommerce_scripts', 'my_woo_syle');*/

	function ilgelo_dropdown_cart() {
		global $woocommerce;
		$items = ilgelo_woocommerce_getcart();

			foreach($items as $item => $values) {
				$_product = $values['data']->post;
				//product image
				$getProductDetail = wc_get_product( $values['product_id'] );
				echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )

				echo "<b>".$_product->post_title.'</b>  <br> Quantity: '.$values['quantity'].'<br>';
				$price = get_post_meta($values['product_id'] , '_price', true);
				echo "  Price: ".$price."<br>";
				/*Regular Price and Sale Price*/
				echo "Regular Price: ".get_post_meta($values['product_id'] , '_regular_price', true)."<br>";
				echo "Sale Price: ".get_post_meta($values['product_id'] , '_sale_price', true)."<br>";
			}
	}


	function ilgelo_woocommerce_setup() {
		$productperpage="9";

		add_filter('loop_shop_columns', 'ilgelo_woocommerce_loopcolumns');
		function ilgelo_woocommerce_loopcolumns() {
			$shopcolumns=4;
			if(get_theme_mod('ig_woo_shop_layout') && get_theme_mod('ig_woo_shop_layout')!="") {
				$shopcolumns=get_theme_mod('ig_woo_shop_layout');
			}
			return $shopcolumns;
		}

		add_filter( 'woocommerce_output_related_products_args', 'ilgelo_woocommerce_relatedproduct' );
		function ilgelo_woocommerce_relatedproduct($args) {
			$relatedproduct=3;

			if(get_theme_mod('ig_woo_related_prod_layout') && get_theme_mod('ig_woo_related_prod_layout')!="") {
				$relatedproduct=get_theme_mod('ig_woo_related_prod_layout');
			}

			$args['posts_per_page'] = $relatedproduct;
			$args['columns'] = $relatedproduct;

			return $args;
		}

		if(get_theme_mod('ig_shop_number_product') && get_theme_mod('ig_shop_number_product')!="") {
			$productperpage=get_theme_mod('ig_shop_number_product');
		}
		add_filter('loop_shop_per_page', create_function('$cols', 'return '.$productperpage.';'), 20);

	}

?>