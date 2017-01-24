<article id="post-<?php the_ID(); ?>" <?php post_class('list-item frontpage-post frontpage-postx'); ?>>
	<div class="thumb-wrap">
	<?php
		$thumb_slide_post = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ig_image-list-blog');
		$url_slide = $thumb_slide_post["0"];
	?>
		<div class="frontpage-thumb position-center size-cover" style="background-image:url(<?php echo $url_slide ?>);">
			<ul>
				<li class="item-thumbs" style="opacity: 1;">
					<a class="hover-wrap" href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>">
						<span class="overlay-img"></span>
						<span class="overlay-img-thumb font-plus"></span>
						<div class="read-more-list">
							<span title="Continue Reading" ><?php _e( 'Continue Reading' ,'ilgelo' ) ?></span>
						</div>
					</a>
				</li>
			</ul>
		</div><!-- .frontpage-thumb -->
	</div><!-- .thumb-wrap -->

	<div class="post-wrap">
		<a class="post-content-link" href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>">
			<div class="post-header textalignleft">
				<?php if(is_single()) : ?>
					<h1><?php the_title(); ?></h1>
				<?php else : ?>
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>

				<?php

					if ( ! has_excerpt() ) {
						echo mvc_content_limit($post->post_content,50);
					} else {
						the_excerpt();
					}
				?>
			</div><!-- End post-header -->
		</a>
		<div class="entry-footer-meta">
			<div class="meta_item">
				<ul>
					<?php if(!get_theme_mod('ig_meta_post_author')) : ?>
						<li><span class="author"><?php the_author(); ?></span></li>
					<?php endif; ?>
					<?php if(!get_theme_mod('ig_meta_post_cat')) : ?>
						<li><span class="cat"><?php the_category(',&nbsp;'); ?></span></li>
					<?php endif; ?>
					<?php if(!get_theme_mod('ig_meta_post_date')) : ?>
						<li><span class="date"><?php the_time( get_option('date_format') ); ?></span></li>
					<?php endif; ?>

					<?php if(!get_theme_mod('ig_post_comment_link')) : ?>
						<li>
							<?php
								if( comments_open( $post->ID ) ) {
									comments_popup_link( __("0 Comments", "ilgelo"), __("1 Comments", "ilgelo"),__("% Comments","ilgelo"));
								}
							?>
						</li>
					<?php endif; ?>

				</ul>
			</div><!-- End meta_item -->
		</div><!-- .entry-footer-meta -->
	</div><!-- .post-wrap -->
</article>