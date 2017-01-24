<div class="post-header title_page textaligncenter">
		<div class="title_page">
				<h1><?php the_title(); ?></h1>
		</div><!-- End title_page -->
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
</div><!-- End post-header -->
