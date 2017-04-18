<?php
/**
 * Template Name: WC Cart
 */

get_header(); ?>


<div class="main_banner innerpage-image">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<?php if(!is_user_logged_in()): ?>
					<p id="alreadyregged">Already Registered? <a href="/my-account/">Click here to login</a></p>
				<?php endif; ?>
				<div class="free_del_notice">
					<p>Free delivery in mainland UK on orders over &pound;100</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<a class="button pull-right-desktop" href="/">Continue Shopping</a>
			</div>
		</div>
	</div>
</div>

<hr class="spacer" />

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 wc_cart">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


				<!--
				<div id="cart_side">
					<h3>You may also like...</h3>
				</div>
				-->
				<?php the_content(); ?>

			<?php endwhile; ?>
		</div>
	</div><!-- row -->
</div><!-- container -->

<?php get_footer(); ?>
