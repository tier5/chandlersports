<?php get_header(); ?>


<div class="ig_wrapper">
	<div class="main_content">
		<div class="archive-box">
			<div class="subtitle_page textaligncenter">
				<h3><?php _e( 'Search results for', 'ilgelo' ); ?></h3>
			</div>

			<div class="title_page textaligncenter">
				<h1><?php printf( __( '%s', 'ilgelo' ), get_search_query() ); ?></h1>
			</div>
		</div>
	</div>
</div>


<div class="ig_wrapper">
	<div class="main_content">

	<div <?php if(get_theme_mod('ig_sidebar_archive') == true) : ?> class="main_content__full"
				<?php elseif(get_theme_mod('ig_archive_layout') == 'full_grid') : ?>
					class=" main_content__grid"

				<?php elseif(get_theme_mod('ig_archive_layout') == 'grid') : ?>
					class=" main_content__grid"

				<?php else : ?>
					class="main_content__r"

		     <?php endif; ?>>


				<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_archive_layout') == 'full_grid') : ?>


					<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_archive_layout') == 'grid') : ?>
					<ul class="ig-grid isotopeWrapper masonryContainer">
					<?php endif; ?>

				<?php endif; ?>


				<?php
					$paged = ilgelo_getpage();
					$search = (get_query_var('s')) ? get_query_var('s') : '';
					$category = (get_query_var('cat')) ? get_query_var('cat') : '';
					$tag = (get_query_var('tag')) ? get_query_var('tag') : '';

					query_posts('&paged='.$paged."&s=".$search."&cat=".$category."&tag=".$tag);
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
							<ul class="isotopeWrapper masonryContainer">



						<?php else : ?>
							<?php get_template_part('content', 'grid'); ?>
						<?php endif; ?>

					<?php else : ?>

						<?php get_template_part('content'); ?>

					<?php endif; ?>

				<?php endwhile; ?>


				<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_archive_layout') == 'full_grid') : ?></ul><?php endif; ?>


					<?php ilgelo_pagination($wp_query->max_num_pages,"",$paged); ?>

<?php else : ?>

					<p class="nothing"><?php _e( 'Sorry, no posts were found. Try searching for something else.', 'ilgelo' ); ?></p>

				<?php endif; ?>

		</div><!--  .main_content__full - .main_content__r -->
	</div><!--  .main_content -->

	<?php if(get_theme_mod('ig_sidebar_archive')) : else : ?>
		<aside class="cont_sidebar sticky_sider">
			<?php get_sidebar(); ?>
		</aside><!--  .cont_sidebar -->
	<?php endif; ?>

</div><!--  .ig_wrapper -->
<?php get_footer(); ?>