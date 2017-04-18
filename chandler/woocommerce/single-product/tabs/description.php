<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $post;

if ( $post->post_content ) : ?>
	<div class="clearfix"></div><!-- /.clearfix -->
	<div class="panel entry-content clearfix" id="tab-description">

		<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'woocommerce')); ?>

		<h2><?php echo $heading; ?></h2>

		<?php the_content(); ?>

		<?php if(get_field('hire_per_week_price') != NULL): ?>

			<hr />

			<h2 id="hire-section">Hire this product</h2>

			<p id="hire-title">Hire this product from <?php echo get_field('hire_per_week_price'); ?> p/w</p>

			<?php if(get_field('hire_terms') != NULL): ?>
				<div id="hirebox">

					<?php the_field('hire_terms'); ?>

					<?php chandler_hireform(); ?>

				</div>
			<?php endif; ?>

		<?php endif; ?>

	</div>
<?php endif; ?>
