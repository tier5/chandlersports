<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $product, $post;

if ( ! $product->is_purchasable() ) return;
?>
<div class="right_side_left_content">
<?php if($product->sale_price != NULL): ?>
	<p id="sale_price">Sale Price &pound;<?php echo $product->sale_price; ?></p>
	<p id="rrp"><?php if(get_field('recommended_retail_price') != NULL): ?><span><?php the_field('recommended_retail_price'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?><span>&pound;<?php echo $product->regular_price; ?></span></p>
<?php else: ?>
	<p id="rrpnot"><?php if(get_field('recommended_retail_price') != NULL): ?><span>&pound;<?php the_field('recommended_retail_price'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?> <span>&pound;<?php echo $product->regular_price; ?></span></p>
<?php endif; ?>
<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] );
    endif;
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) );
	 	?>
                <div class=""><p class="free-dilivery">FREE UK DELIVERY</p></div>
	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Buy now', 'woocommerce'), $product->product_type); ?></button>
	 	<a href="#hire-section" class="hire">Hire</a>

	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>

	<div id="product-social-icons">
		<iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;width=50&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false&amp;appId=140052432801561" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:21px; float: left; margin-top: 1px; margin-right: 5px;" allowTransparency="true"></iframe>

		<!-- Place this tag where you want the +1 button to render. -->
		<div class="g-plusone" data-size="medium" data-annotation="none"></div>

		<!-- Place this tag after the last +1 button tag. -->
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>

		<a href="https://twitter.com/share" class="twitter-share-button" data-via="chandler_sports" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>



	<!--<div class="thumbnails clearfix" id="thumbnailcontainer" style="margin-top: 10px;margin-bottom: 20px;">
<?php
	$attachments = get_posts( array(
		'post_type' 	=> 'attachment',
		'numberposts' 	=> -1,
		'post_status' 	=> null,
		'post_parent' 	=> $post->ID,
		'post__not_in'	=> array( get_post_thumbnail_id() ),
		'post_mime_type'=> 'image',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC'
	) );
	if ($attachments) {

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachments as $key => $attachment ) {

			if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 )
				continue;

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image = wp_get_attachment_image_src( get_post_thumbnail_id(),'large');
		?>

			<?php if($loop==0): ?>
				<a href="javascript:void(0);" title="image" rel="{gallery: 'thumbnails', smallimage: '<?php echo $image[0]; ?>',largeimage: '<?php echo $image[0]; ?>'}" class="zoomThumbActive"><img src="<?php echo $image[0]; ?>" border="0" class="single-product-thumbhnail" style="" /></a>
			<?php endif; ?>
			<a href="javascript:void(0);" title="image" rel="{gallery: 'thumbnails', smallimage: '<?php echo $attachment->guid; ?>', largeimage: '<?php echo $attachment->guid; ?>'}">
				<img src="<?php echo $attachment->guid; ?>" border="0" class="single-product-thumbhnail" style="" />
			</a>

		<?php
			//printf( '<a data-href="%s" href="javascript:void(0);" title="%s" rel="" class="%s zoomThumbActive">%s</a>', wp_get_attachment_url( $attachment->ID ), esc_attr( $attachment->post_title ), implode(' ', $classes), wp_get_attachment_image( $attachment->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) );

			$loop++;

		}

	}
?>
</div>-->





	<!--<div id="excerpt">
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	</div>  -->

	<?php /* ?><?php if(get_field('hire_per_week_price') != NULL): ?>
		<p id="hire-title">OR HIRE FROM <?php echo get_field('hire_per_week_price'); ?> p/w</p>

        <?php if(get_field('hire_terms') != NULL): ?>
            <div id="hirebox">

                <?php the_field('hire_terms'); ?>

                <?php chandler_hireform(); ?>

				<!--
                <br style="clear: both;" />

                <div class="ahire">
                    <form method="post" action="/equipment-hire/">
                        <input type="hidden" id="proname" name="proname" value="<?php echo get_the_title(); ?>" />
                        <input type="hidden" id="proprice" name="proprice" value="<?php echo get_field('hire_per_week_price'); ?>" />
                        <input type="submit" id="subhire" name="subhire" value="Hire" />
                    </form>
                </div>
				-->
            </div>
        <?php endif; ?>

	<?php endif; ?><?php */ ?>
</div>