<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $woocommerce;

?>

<div class="row">
	<div class="col-xs-12">
		<div class="breadcrumbs-wrapper">
			<?php woocommerce_breadcrumb() ?>
		</div><!-- /.breadcrumbs-wrapper -->
	</div><!-- /.col-xs-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-6 col-sm-12 col-md-6 col-xs-12"><!-- images -->

		<?php if ( has_post_thumbnail() ) : ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(),'large'); ?>


			<a itemprop="image" id="singleimg" href="<?php echo $image[0]; ?>" class="zoom" rel="thumbnails" title="<?php echo $image[0]; ?>" border="0"><img class="img-responsive" src="<?php echo $image[0]; ?>" <?php /*?>width="400"<?php */?> width="100%" /></a>

		<?php else : ?>

			<img class="img-responsive" src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />

		<?php endif; ?>

		<div class="clearfix"></div><!-- /.clearfix -->

		<?php do_action('woocommerce_product_thumbnails'); ?>

	</div>
