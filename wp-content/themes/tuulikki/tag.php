<?php get_header(); ?>



<div class="ig_wrapper">
	<div class="main_content">
		<div class="archive-box">
			<div class="subtitle_page textaligncenter">
				<h3><?php _e( 'Browsing Tag', 'ilgelo' ); ?></h3>
			</div>

			<div class="title_page textaligncenter">
				<h1><?php printf( __( '%s', 'ilgelo' ), single_tag_title( '', false ) ); ?></h1>
			</div>
		</div>
	</div>
</div>



<div class="ig_wrapper">
	<div class="main_content">

	<div <?php if(get_theme_mod('ig_sidebar_archive') == true) : ?> class="container"
		      <?php else : ?>
			 class="main_content__r"
		<?php endif; ?>>






				<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_home_layout') == 'full_grid') : ?>


					<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_archive_layout') == 'grid') : ?>
					<ul class="sp-grid isotopeWrapper masonryContainer">
					<?php endif; ?>

				<?php endif; ?>


					<?php
					$paged = ilgelo_getpage();
					query_posts('&paged='.$paged."&showposts=".get_option('posts_per_page')."&tag=".get_query_var('tag'));
				?>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php if(get_theme_mod('ig_archive_layout') == 'grid') : ?>

						<?php get_template_part('content', 'grid'); ?>

					<?php elseif(get_theme_mod('ig_archive_layout') == 'list') : ?>

						<?php get_template_part('content', 'list'); ?>

					<?php elseif(get_theme_mod('ig_archive_layout') == 'full_list') : ?>

						<?php if( $wp_query->current_post == 0 && !is_paged() ) : ?>
							<?php get_template_part('content'); ?>
						<?php else : ?>
							<?php get_template_part('content', 'list'); ?>
						<?php endif; ?>

					<?php elseif(get_theme_mod('ig_archive_layout') == 'full_grid') : ?>




						<?php if( $wp_query->current_post == 0 && !is_paged() ) : ?>
							<div class="first_post">
								<?php get_template_part('content'); ?>
							</div>
							<ul class="ig-grid isotopeWrapper masonryContainer">



						<?php else : ?>
							<?php get_template_part('content', 'grid'); ?>
						<?php endif; ?>

					<?php else : ?>

						<?php get_template_part('content'); ?>

					<?php endif; ?>



				<?php endwhile; ?>

				<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_archive_layout') == 'full_grid') : ?></ul><?php endif; ?>


					<?php ilgelo_pagination($wp_query->max_num_pages,"",$paged); ?>

				<?php endif; ?>


		</div><!--  .main_content__full - .main_content__r -->
	</div><!--  .main_content -->

	<?php if(get_theme_mod('ig_sidebar_archive')) : else : ?>
		<aside class="cont_sidebar">
			<?php get_sidebar(); ?>
		</aside><!--  col-md-3 -->
	<?php endif; ?>

</div><!--  .ig_wrapper -->

<?php get_footer(); ?>