<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<?php

	if (class_exists('acf')) {
		if(get_field('featured_image_size_options') == "top-featured") {
			echo'	<div class="ig_wrapper single_media_wrapper">';
			include(get_template_directory()."/include/header/single-top-featured.php");
			echo'	</div>';
		} elseif(get_field('featured_image_size_options') == "in-featured") {
			include(get_template_directory()."/include/header/single-only-title.php");
		} elseif(get_field('featured_image_size_options') == "none-featured") {
			include(get_template_directory()."/include/header/single-only-title.php");
		} else {
			include(get_template_directory()."/include/header/single-only-title.php");
		}
	} else {
		include(get_template_directory()."/include/header/single-only-title.php");
	}

?>





<div class="ig_wrapper">
	<div class="main_content">
	<div class="divider_head_single"></div>
	<div <?php if(get_theme_mod('ig_sidebar_post') == true) : ?> class="container"
		      <?php else : ?>
			 class="main_content__r"
		<?php endif; ?>>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page'); ?>>



<!--================================
	  POST HEADER - Title & Meta
================================-->

<?php
	if (class_exists('acf') && get_field('featured_image_size_options') == "none-featured") {
		// Silence
	} elseif (class_exists('acf') && get_field('featured_image_size_options') == "top-featured") {

		if(has_post_format('gallery')|| has_post_format('audio') || has_post_format('video')) {
	      include(get_template_directory()."/include/header/single-only-title.php");
		} else {
	       // Silence
		}

	} else {

		if(!get_theme_mod('ig_post_thumb')):
		include(TEMPLATEPATH."/include/single-media.php");
		endif;

	}
?>


<!--================================
	  CONTENT
================================-->

	<div class="post_container_single">

			<?php if (class_exists('acf') && get_field('story_intro')) {
			echo'<div class="story-intro">';
			echo'<p>' . get_field('story_intro') . '</p>';
			echo'</div>';
			}?>

	<?php the_content(); ?>



<!--================================
	  POST SHARE
================================-->

		<?php if(!get_theme_mod('ig_post_share')) : ?>
			<div class="post-footer">

				<ul class="meta-share">
					<li>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i> facebook</a>
					</li>
					<li>
						<a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php the_title(); ?>%20-%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i> twitter</a>
					</li>
					<li>
						<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
						<a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $pin_image; ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i> pinterest</a>
					</li>
					<li>
						<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i> google + </a>
					</li>
				</ul>



	<div class="post-header textaligncenter">
		<div class="meta_item">
					<?php if(!get_theme_mod('ig_meta_post_tags')) : ?>
						<span class="cat"><?php the_tags(); ?></span>
					<?php endif; ?>
		</div><!-- End meta_item -->
	</div><!--  post-header  -->



			</div><!--  post-footer  -->
		<?php endif; ?>

	</div><!-- post_container_single  -->


</article>




<!--================================
	  AUTHOR
================================-->

<?php if(!get_theme_mod('ig_post_author')) : ?>
	<?php ilgelo_post_author(); ?>
<?php endif; ?>


<!--================================
	  Start previous/next post link
================================-->

<div class="ig_navigation post_container_sub_single">

	<?php
		$prevPost = get_previous_post();
		if ($prevPost) {
			$prevthumbnail = get_the_post_thumbnail($prevPost->ID,'ig_image-prev-next' );
			$prevdate = get_the_date("",$prevPost->ID);
	?>

		<div class='cont_prev_left'>
			<div>
				<div class="title_navigation_post">
					<div class="arrow_prev">
						<?php previous_post_link('%link',''); ?>
					</div>
					<h5><?php previous_post_link('%link'); ?></h5>
					<h6 class="r-p-date"><?php echo $prevdate; ?></h6>
				</div>
			</div>
		</div><!--  cont_prev_left  -->
	<?php } ?>


	<?php
		$nextPost = get_next_post();
		if ($nextPost) {
			$nextthumbnail = get_the_post_thumbnail($nextPost->ID,'ig_image-prev-next' );
			$nextdate = get_the_date("",$nextPost->ID);

	?>

		<div class='cont_next_right'>
			<div>


				<div class="title_navigation_post_r">

					<div class="arrow_next">
						<?php next_post_link('%link',''); ?>
					</div>

					<h5><?php next_post_link('%link'); ?></h5>
					<h6 class="r-p-date"><?php echo $nextdate; ?></h6>
				</div>


			</div>
		</div><!--  cont_next_right  -->
	<?php } ?>


</div> <!-- end ig_navigation -->



<!--================================
	  RELATED POST
================================-->

<?php if(!get_theme_mod('ig_post_related')) : ?>
	<?php ilgelo_post_related(); ?>
<?php endif; ?>




<!--================================
	  COMMENTS
================================-->

<?php comments_template('', true); ?>


	 	</div><!--   .container or .main_content__r -->
	 </div><!--  .main_content -->


	<?php if(get_theme_mod('ig_sidebar_post')) : else : ?>
		<div class="divider_head_single"></div>
		<aside class="cont_sidebar sticky_sider">

			<?php /*
			<!-- author box in sidebar -->
				 <div class="sidebar_author">
				<?php  ilgelo_post_author(); ?>
	 		</div>
	 		*/ ?>


	          <?php get_sidebar( $name ); ?>
		</aside><!--  .cont_sidebar -->
	<?php endif; ?>


</div><!--  .ig_wrapper -->

	<?php endwhile; ?>

<?php endif; ?>





<?php get_footer(); ?>