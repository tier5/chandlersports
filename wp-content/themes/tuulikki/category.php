<?php get_header(); ?>


<?php
	global $query_string;
	global $wp_query;

	$objcat=get_category(get_query_var('cat'));
	$cat_id=$objcat->term_id;

	$url_image = "";
	if (class_exists('acf') && get_field("category_image","category_".$cat_id)) {
		$url_image=get_field("category_image","category_".$cat_id);
	}
?>
		<?php if( $url_image ): ?>

			<div class="img-cover-category" style="background-image: url('<?php echo $url_image; ?>');">


			</div><!-- End img-cover -->

			<div class="archive-box">
				<div class="subtitle_page textaligncenter">
					<h3><?php _e( 'Browsing Category', 'ilgelo' ); ?></h3>
				</div>

				<div class="title_page textaligncenter">
					<h1><?php printf( __( '%s', 'ilgelo' ), single_cat_title( '', false ) ); ?></h1>
				</div>


				<div class="desc_archive">
					<?php echo category_description(); ?>
				</div>
			</div><!-- End archive-box -->

			<?php else : ?>
				<div class="archive-box">
					<div class="subtitle_page textaligncenter">
						<h3><?php _e( 'Browsing Category', 'ilgelo' ); ?></h3>
					</div>

					<div class="title_page textaligncenter">
						<h1><?php printf( __( '%s', 'ilgelo' ), single_cat_title( '', false ) ); ?></h1>
					</div>


					<div class="desc_archive">
						<?php echo category_description(); ?>
					</div>
				</div><!-- End archive-box -->
		<?php endif; ?>




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
					query_posts('&paged='.$paged."&showposts=".get_option('posts_per_page')."&cat=".get_query_var('cat'));
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