<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-header textaligncenter">
		<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="meta_item">
			<ul>
				<?php if(!get_theme_mod('ig_meta_post_author')) : ?>
				<li>
					<span class="author"><?php the_author(); ?></span>
				</li>
				<?php endif; ?>
				
				<?php if(!get_theme_mod('ig_meta_post_cat')) : ?>
				<li>
					<span class="cat"><?php the_category(',&nbsp;'); ?></span>
				</li>
				<?php endif; ?>
	
				<?php if(!get_theme_mod('ig_meta_post_date')) : ?>
				<li>
					<span class="date"><?php the_time( 'M j, Y' ); ?></span>
				</li>
				<?php endif; ?>
	
				<?php if(!get_theme_mod('ig_post_comment_link')) : ?>
				<li>
					<?php if( comments_open( $post->ID ) ) { ?>
						<?php comments_popup_link( __("0 Comments", "ilgelo"), __("1 Comments", "ilgelo"),__("% Comments","ilgelo")); ?>
						<?php } ?>
				</li>		
				<?php endif; ?>
			</ul>

		</div><!-- End meta_item -->
		<!--<div class="separator"></div>-->
	</div><!-- End post-header -->



		<?php  include(TEMPLATEPATH."/include/content-media.php"); ?>



	<div class="post_container for_excerpt ">


	<?php if(!get_theme_mod('ig_post_full_cont')) {
			the_excerpt();
		}else{
			the_content();
		}
	?>


	</div><!-- post_container  -->






	<div class="post-footer classic_read-more">

		<?php if(!get_theme_mod('ig_post_full_cont')) {

		echo'<a href="';
		the_permalink();
		echo'" title="';
		 the_title();
		echo' " class="read-more">';
		echo  _e( 'Continue Reading' ,'ilgelo' );
		echo'</a>';

		}else{

		echo  comments_popup_link( __("0 Comments", "ilgelo"), __("1 Comments", "ilgelo"),__("% Comments","ilgelo"),'read-more');

		}
	?>


		<?php if(!get_theme_mod('ig_post_share')) : ?>

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
				<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i> google +</a>
			</li>
		</ul>
			<?php endif; ?>

	</div><!--  post-footer  -->


</article>


<div class="clear"></div>