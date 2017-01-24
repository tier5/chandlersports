<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	if (class_exists('acf')) {
		if (get_field('activate_promotional_box-home','option') && (is_home()||is_front_page())) {
			get_template_part("include/promotional", "box-home");
		} else if (get_field('activate_promotional_box')) {
			get_template_part("include/promotional", "box");
		}
	}

	$template = get_option( 'template' );

	if (is_product_category()) {
		global $query_string;
		global $wp_query;

		$objcats=wp_get_post_terms(get_the_ID(),'product_cat');
		if(!empty($objcats)) {
			$objcat=array_shift($objcats);

			$cat_id=$objcat->term_id;

			$url_image = "";
			if (get_field("category_image","product_cat_".$cat_id)) {
				$url_image=get_field("category_image","product_cat_".$cat_id);
			}
			if( $url_image ) { ?>

					<div class="img-cover-category" style="margin-bottom: 110px; background-image: url('<?php echo $url_image; ?>');">
						<div class="post-header-single textaligncenter">
								<div class="archive-box textaligncenter">
									<div class="title-line">
										<div class="title-line__inwrap">
											<?php _e( 'Product Category', 'ilgelo' ); ?>
										</div>
									</div>
									<h1>
									<?php printf( __( '%s', 'ilgelo' ), single_cat_title( '', false ) ); ?>
									</h1>



						<div class="desc_archive">
							<?php echo category_description(); ?>
						</div>




								</div>
						</div> <!-- End post-header-single -->

					</div><!-- End img-cover -->
						<div class="clear"></div>

			<?php } else { ?>
			<div class="archive-box textaligncenter">
				<div class="title-line">
					<div class="title-line__inwrap">
						<?php _e( 'Browsing Category', 'ilgelo' ); ?>
					</div>
				</div>
				<h1>
					<?php printf( __( '%s', 'ilgelo' ), single_cat_title( '', false ) ); ?>
				</h1>
				<div class="desc_archive">
					<?php echo category_description(); ?>
				</div>

			</div>

			<?php
			}
		}
	}


	switch( $template ) {
		case 'twentyeleven' :
			echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
			break;
		case 'twentytwelve' :
			echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
			break;
		case 'twentythirteen' :
			echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
			break;
		case 'twentyfourteen' :
			echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
			break;
		case 'twentyfifteen' :
			echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
			break;
		case 'twentysixteen' :
			echo '<div id="primary" class="content-area twentysixteen"><main id="main" class="site-main" role="main">';
			break;
		default :
		echo '<div class="ig-container"><div id="container"><div id="content" role="main">';
			break;
	}
