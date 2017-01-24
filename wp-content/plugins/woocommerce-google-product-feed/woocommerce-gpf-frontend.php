<?php
/**
 * woocommerce-gpf-frontend.php
 *
 * @package default
 */


class woocommerce_gpf_frontend {



	private $settings = array();



	/*
     * Constructor. Grab the settings, and add filters if we have stuff to do
     */
	function __construct() {

		$this->settings = get_option ( 'woocommerce_gpf_config' );

		add_action ( 'template_redirect', array ( &$this, 'render_product_feed' ), 15 );

		if ( $this->settings && isset ( $_REQUEST['action'] ) && 'woocommerce_gpf' == $_REQUEST['action'] ) {
            add_action ( 'woocommerce_gpf_elements', array ( &$this, 'google_elements' ), 10, 2 );
            add_action ( 'woocommerce_gpf_elements', array ( &$this, 'multiple_images' ), 10, 2 );
		}

	}



	/**
	 * Retrieve Post Thumbnail URL
	 *
	 * @param int     $post_id (optional) Optional. Post ID.
	 * @param string  $size    (optional) Optional. Image size.  Defaults to 'post-thumbnail'.
	 * @return string|bool Image src, or false if the post does not have a thumbnail.
	 */
	private function get_the_post_thumbnail_src( $post_id = null, $size = 'post-thumbnail' ) {

		$post_thumbnail_id = get_post_thumbnail_id( $post_id );

		if ( ! $post_thumbnail_id ) {
			return false;
        }

		list( $src ) = wp_get_attachment_image_src( $post_thumbnail_id, $size, false );

		return $src;
	}




	/**
	 *
	 */
	function render_product_feed() {

		global $wpdb, $wp_query, $post;

		// Don't cache feed under WP Super-Cache
		define('DONOTCACHEPAGE', TRUE);

        // Cater for large stores
        set_time_limit ( 0 );

        // Can't enable this until http://core.trac.wordpress.org/ticket/19708 is fixed
        //if ( function_exists ( 'wp_suspend_cache_addition' ) ) {
			//wp_suspend_cache_addition ( true ) ;
		//}

		$siteurl = home_url('/');
		$self = home_url("/index.php?action=woocommerce_gpf");

		header("Content-Type: application/xml; charset=UTF-8");
        if ( isset ( $_REQUEST['feeddownload'] ) ) {
		    header('Content-Disposition: attachment; filename="E-Commerce_Product_List.xml"');
        } else {
		    header('Content-Disposition: inline; filename="E-Commerce_Product_List.xml"');
        }

        // Core feed information
		echo "<?xml version='1.0' encoding='UTF-8' ?>\n\r";
		echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom' xmlns:g='http://base.google.com/ns/1.0'>\n";
		echo "  <channel>\n";
		echo "    <title><![CDATA[".get_option('blogname')." Products]]></title>\n";
		echo "    <link>".$siteurl."</link>\n";
		echo "    <description>This is the WooCommerce Product List RSS feed</description>\n";
		echo "    <generator>WooCommerce Google Product Feed Plugin (http://plugins.leewillis.co.uk/store/plugins/woocommerce-google-product-feed/)</generator>\n";
		echo "    <atom:link href='$self' rel='self' type='application/rss+xml' />\n";

		// Is Google Checkout available as a payment gateway
		$google_checkout_note = FALSE;

        $currency = get_option ( 'woocommerce_currency' );
        $weight_units = get_option ( 'woocommerce_weight_unit' );
        $base_country = get_option ( 'woocommerce_base_country' );

        if ( !empty ( $base_country ) && substr ( $base_country, 0, 2 ) == 'US' ) {
            $US_feed = true;
        } else {
            $US_feed = false;
        }

        // Query for the products
		$chunk_size = apply_filters ( 'woocommerce_gpf_chunk_size', 20 );

		$args['post_type'] = 'product';
		$args['numberposts'] = $chunk_size;
		$args['offset'] = 0;

		$products = get_posts ($args);

		while ( count ( $products ) ) {
			
			foreach ($products as $post) {

				setup_postdata($post);

	            $woocommerce_product = new woocommerce_product ( $post->ID );

	            if ( $woocommerce_product->visibility == 'hidden' )
	            	continue;

                if ( $US_feed ) {
				    $price = $woocommerce_product->get_price_excluding_tax();
                } else {
				    $price = $woocommerce_product->get_price();
                }

	            if ( count ( $woocommerce_product->children ) ) {

				    $children = $woocommerce_product->children;

	                foreach ( $children as $child_product ) {
	    
                        if ( $US_feed ) {
	                        $child_price = $child_product->product->get_price_excluding_tax();
                        } else {
	                        $child_price = $child_product->product->get_price();
                        }
	    
					    if (($price == 0) && ($child_price > 0)) {
						    $price = $child_price;
					    } else if ( ($child_price > 0) && ($child_price < $price) ) {
							    $price = $child_price;
					    }

				    }

	            }

                if ( empty ( $price ) )
                    continue;

                $price = number_format ( $price, 2, '.', '' );

                // Check to see if the product has been excluded
                // Fortunately WooCommerce already fetches the data for us
                $tmp_product_data = $woocommerce_product->product_custom_fields['_woocommerce_gpf_data'][0];
                $tmp_product_data = unserialize ( $tmp_product_data );
                if ( isset ( $tmp_product_data['exclude_product'] ) )
                	continue;

				$purchase_link = get_permalink($post->ID);

				echo "    <item>\n\r";
				if ($google_checkout_note) {
					echo "      <g:payment_notes>Google Checkout</g:payment_notes>\n\r";
				}
				echo "      <title><![CDATA[".get_the_title()."]]></title>\n\r";
				echo "      <link>$purchase_link</link>\n\r";
				// Google limit the description to 10,000 characters
				echo "      <description><![CDATA[".substr(apply_filters ('the_content', get_the_content()),0,10000)."]]></description>\n\r";
				echo "      <guid>woocommerce_gpf_".$post->ID."</guid>\n\r";

				$image_link = $this->get_the_post_thumbnail_src ( $post->ID, 'shop_large' );

				if ( ! empty ( $image_link ) ) {
				    echo "      <g:image_link>$image_link</g:image_link>\n\r";
				}


				echo "      <g:price>$price $currency</g:price>\n\r";

				$google_elements = apply_filters ( 'woocommerce_gpf_elements', array(), $post->ID );

				$done_condition = FALSE;
				$done_weight = FALSE;

				if ( count( $google_elements ) ) {

					foreach ( $google_elements as $element_name => $element_values ) {

						foreach ( $element_values as $element_value ) {

                            // Special case for stock - only send a value if the product is in stock
                            if ( 'g:availability' == $element_name ) {
                                if ( ! $woocommerce_product->is_in_stock() ) {
                                    $element_value = 'out of stock';
                                }
                            }

							echo "      <".$element_name.">";
							echo "<![CDATA[".$element_value."]]>";
							echo "</".$element_name.">\n\r";

						}

						if ($element_name == 'g:shipping_weight')
							$done_weight = TRUE;

						if ($element_name == 'g:condition')
							$done_condition = TRUE;

					}

				}

				if (!$done_condition)
					echo "      <g:condition>new</g:condition>\n\r";

				if ( ! $done_weight ) {
					$weight = apply_filters ( 'woocommerce_gpf_shipping_weight', $woocommerce_product->get_weight(), $post->ID );
	                if ( $weight_units == 'lbs' )
	                    $weight_units = 'lb';

					if ( $weight && is_numeric( $weight ) && $weight > 0 ) {
						echo "      <g:shipping_weight>$weight $weight_units</g:shipping_weight>";
					}
				}

				echo "    </item>\n\r";

			}

			$args['offset'] += $chunk_size;
			$products = get_posts ( $args );

		}

		echo "  </channel>\n\r";
		echo "</rss>";

		exit();
	}



	/*
     * Add the "advanced" information to the Google field based on either the per-product settings, category settings, or store defaults
     */
	function google_elements( $elements, $product_id ) {

		global $woocommerce_gpf_common;

		// Retrieve the info set against the product by this plugin.
		$product_values = $woocommerce_gpf_common->get_values_for_product ( $product_id );

		if ( ! empty ( $product_values ) ) {

			foreach ( $product_values as $key => $value ) {

				$elements['g:'.$key] = array ($value);

			}

		}

		return $elements;
	}



	/*
     * Add additional images to the feed
     */
	function multiple_images ( $elements, $product_id ) {

		global $woocommerce_gpf_common;

		$main_thumbnail = get_post_meta ( $product_id, '_thumbnail_id', true );

        $images = get_children( array ( 'post_parent' => $product_id,
                                        'post_status' => 'inherit',
                                        'post_type' => 'attachment',
                                        'post_mime_type' => 'image',
                                        'exclude' => isset($main_thumbnail) ? $main_thumbnail : '',
                                        'order' => 'ASC',
                                        'orderby' => 'menu_order' ) );

         
        if ( is_array ( $images ) && count ( $images ) ) {

            foreach ( $images as $image ) {
                
                $full_image_src = wp_get_attachment_image_src( $image->ID, 'original' );

                $elements['g:additional_image_link'][] = $full_image_src[0];

            }

        }

		return $elements;
	}



}


$woocommerce_gpf_frontend = new woocommerce_gpf_frontend();


?>
