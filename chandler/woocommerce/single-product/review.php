<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post;
?>

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
		<div class="comment-text">

			<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
				<p class="meta"><em><?php _e('Your comment is awaiting approval', 'woocommerce'); ?></em></p>
			<?php else : ?>
				<p class="meta">
					<strong itemprop="author"><?php comment_author(); ?></strong> <?php

						if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
							if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
								echo '(' . __('verified owner', 'woocommerce') . ') ';

					?>&ndash; <time itemprop="datePublished" time datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__('M jS Y', 'woocommerce')); ?></time>:
				</p>
			<?php endif; ?>

				<div itemprop="description" class="description"><?php comment_text(); ?></div>
		</div>
	</div>
