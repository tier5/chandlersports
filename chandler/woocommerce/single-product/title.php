<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<div class="ab_box">
	<?php /* ?><?php if(get_field('brand_logo') != NULL): ?>
		<img src="<?php echo get_field('brand_logo'); ?>" id="brand-logo" />
	<?php endif; ?> <?php */ ?>
	<h1 itemprop="name" class="product_title entry-title" style="width: 100%;"><?php the_title(); ?></h1>
	<?php my_print_starss(); ?>
</div>