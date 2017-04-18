<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.5
 */

global $woocommerce, $product, $post;
?>
<script type="text/javascript">
    var product_variations_<?php echo $post->ID; ?> = <?php echo json_encode( $available_variations ) ?>;
</script>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>
<div class="right_side_left_content">
<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>">
	<table class="variations" cellspacing="0">
		<tbody>
			<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				<tr>
					<td class="label"><label for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label($name); ?></label></td>
					<td class="value"><select id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
						<option value=""><?php echo __('Choose an option', 'woocommerce') ?>&hellip;</option>
						<?php
							if ( is_array( $options ) ) {

								if ( empty( $_POST ) )
									$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
								else
									$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( sanitize_title( $name ) ) ) {

									$terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) ) continue;
										echo '<option value="' . $term->slug . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
									}
								} else {
									foreach ( $options as $option )
										echo '<option value="' . $option . '" ' . selected( $selected_value, $option, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $option ) . '</option>';
								}
							}
						?>
					</select> <?php
						if ( sizeof($attributes) == $loop )
							echo '<a class="reset_variations" href="#reset">'.__('Clear selection', 'woocommerce').'</a>';
					?></td>
				</tr>
	        <?php endforeach;?>
		</tbody>
	</table>

	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap" style="display:none;">
		<div class="single_variation"></div>
		<div class="variations_button">
			<input type="hidden" name="variation_id" value="" />
			<?php woocommerce_quantity_input(); ?>
			<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>
		</div>
	</div>
	<div><input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /></div>


</form>


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

<div id="excerpt">
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	</div>

	</div>


	<?php if(get_field('hire_per_week_price') != NULL): ?>
		<p id="hire-title">OR HIRE FROM <?php echo get_field('hire_per_week_price'); ?> p/w</p>

        <?php if(get_field('hire_terms') != NULL): ?>
            <div id="hirebox">
                <?php the_field('hire_terms'); ?>
                
                <br style="clear: both;" />
                
                <div class="ahire">
                    <form method="post" action="/equipment-hire/">
                        <input type="hidden" id="proname" name="proname" value="<?php echo get_the_title(); ?>" />
                        <input type="hidden" id="proprice" name="proprice" value="<?php echo get_field('hire_per_week_price'); ?>" />
                        <input type="submit" id="subhire" name="subhire" value="Hire" />
                    </form>
                </div>
            </div>
        <?php endif; ?>

	<?php endif; ?>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
