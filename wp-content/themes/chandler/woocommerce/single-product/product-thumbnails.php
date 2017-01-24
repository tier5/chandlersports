<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $woocommerce;
?>
<?php /*?><div class="rollover_outer"><p id="rollover"><img class="rollover_image" src="<?php echo home_url().'/wp-content/themes/chandler/images/glasszoom.png'?>">Click image to enlarge</p></div><?php */?>

<div class="row">
	<div class="col-sm-12">
		<div class="thumbnails" id="thumbnailcontainer">
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
			<?php if(get_field('product_video') != NULL): ?>
				<?php $video = explode('v=', get_field('product_video')); ?>
				<a href="<?php the_field('product_video') ?>" class="video-thumbnail fancybox-media">
					<i class="fa fa-play" aria-hidden="true"></i>
					<img src="https://img.youtube.com/vi/<?php echo $video[1]; ?>/2.jpg" alt="Video thumbnail" />
				</a>
			<?php endif; ?>
		</div>
	</div>
</div><!-- /.row -->
