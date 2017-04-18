<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

$related = $product->get_related();

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> 4,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>
<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12  upsells products">

			<h3><?php _e('Related Products', 'woocommerce'); ?></h3>

			<div class="row">
				<ul class="products">

					<?php $i=1; while ( $products->have_posts() ) : $products->the_post(); ?>

						<li class="related-products-li col-lg-3 col-sm-3 col-md-3 col-xs-12 product<?php echo $i; ?>">
		                <div class="pr_box_01 match-height">
							<?php //woocommerce_get_template_part( 'content', 'product' ); ?>
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(),'large'); ?>
							<?php if($image[0] != NULL): ?>
								<div class="im_br"><a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" border="0" style="height: 230px;" /></a></div>
							<?php endif; ?>
							<div class="pr_tit cf">
							<h1 class="related-product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>
		                    <div class="pr_b_left">
							<?php $the_price = get_post_meta( $products->post->ID, '_regular_price', true); ?>
							<h2>&pound;<?php echo $the_price; ?></h2>
							<?php $related_product = new WC_Product($products->post->ID)  ?>
							<?php if($related_product->sale_price != NULL): ?>
							<h3>Sale &pound;<?php echo $related_product->sale_price; ?></h3>
							<h3>SAVE &pound;<?php echo floatval($the_price) - floatval($related_product->sale_price); ?></h3>
							<?php endif; ?>
							</div>
		                    <?php /*if(get_field('recommended_retail_price', $products->post->ID) != NULL): ?>
								<p class="normalprice">Normal price &pound;<span><?php the_field('recommended_retail_price', $products->post->ID); ?></span></p>
							<?php endif;*/ ?>

							<!-- <div class="str_box"> -->
							<?php //if(get_field('product_listing_info')): ?>
							<!-- <div class="product_list_info"> -->
						    <?php //the_field('product_listing_info'); ?>
							<!-- </div> -->
							<!-- </div> -->

			<!-- </div> -->
		<?php //endif; ?>
		</div>
			</li>
					<?php if($i==4): $i=1; else: $i++; endif; endwhile; // end of the loop. ?>

				</ul>
			</div><!-- /.row -->

		</div>
</div><!-- /.row -->
<?php endif;

wp_reset_postdata();
?>
<!--<img src="/wp-content/themes/chandler/images/bottomline.png" style="max-width: 940px; width: 940px; margin: 0 auto 20px auto;" />-->
