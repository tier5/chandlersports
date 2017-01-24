<?php get_header(); ?>


	<div class="archive-box textaligncenter">

		<?php
			if ( is_day() ) :
					echo"<div class='subtitle_page'>";
					echo _e( '<span>Daily Archives</span>', 'ilgelo' );
					echo"</div>";
					
				printf( __( '<div class="title_page"><h1>%s</h1></div>', 'ilgelo' ), get_the_date() );

			elseif ( is_month() ) :

					echo"<div class='subtitle_page'>";
				     echo _e( '<h3>Monthly Archives</h3>', 'ilgelo' );
					echo"</div>";

				printf( __( '<div class="title_page"><h1>%s</h1></div>', 'ilgelo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ilgelo' ) ) );

			elseif ( is_year() ) :

					echo"<div class='subtitle_page'>";
					echo _e( '<span>Yearly Archives</span>', 'ilgelo' );
					echo"</div>";
					
				printf( __( '<div class="title_page"><h1>%s</h1></div>', 'ilgelo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ilgelo' ) ) );

			else :
				_e( '<h2>Archives</h2>', 'ilgelo' );

			endif;
		?>

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
					global $query_string;
					global $wp_query;

					$paged = ilgelo_getpage();

					$query_args = explode("&", $query_string);
					$search_query = array();

					foreach($query_args as $key => $string) {
						$query_split = explode("=", $string);
						$search_query[$query_split[0]] = urldecode($query_split[1]);
					}
					$search_query["paged"] = $paged;
					query_posts($search_query);
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
							<ul class="sp-grid isotopeWrapper masonryContainer">



						<?php else : ?>
							<?php get_template_part('content', 'grid'); ?>
						<?php endif; ?>

					<?php else : ?>

						<?php get_template_part('content'); ?>

					<?php endif; ?>



				<?php endwhile; ?>

				<?php if(get_theme_mod('ig_archive_layout') == 'grid' || get_theme_mod('ig_archive_layout') == 'full_grid') : ?></ul><?php endif; ?>


					<?php ilgelo_pagination($wp_query->max_num_pages,"",$paged,'archive'); ?>

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