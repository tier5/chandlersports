<?php
/**
 * Template Name: WC Checkout
 */

get_header(); ?>

<div class="container" style="padding-top: 10px;padding-bottom: 20px;">
	<div id="page" class="wc_checkout">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<?php if(!is_user_logged_in()): ?>
				<p id="alreadyregged">Already Registered? <a href="/my-account/">Click here to login</a></p>
			<?php endif; ?>
			<br style="clear: both;" />
			<br style="clear: both;" />
			<h3 id="wc_h3_billing">Billing Address</h3>
			<h3 id="wc_h3_payment">Delivery &amp; Payment</h3>
			<h3 id="wc_h3_review">Review your order</h3>
			
			<?php the_content(); ?>
			
			<br style="clear: both;" />
			
			<div id="bottom_checkout">
				<img src="../wp-content/uploads/2016/05/weaccept.png" alt="we accept" id="weaccept" />
			</div>
			
		<?php endwhile; ?>
	</div>
	
	<br style="clear: both;" />
</div>

<?php get_footer(); ?>
