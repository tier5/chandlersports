<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
	<div class="blog">
		<h1 class="page-title"><?php
			printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		?></h1>
		<div class="col-lg-8 col-xs-12 col-sm-8 col-md-8 left-content singalpost">
			<?php
				$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo '<div class="archive-meta">' . $category_description . '</div>';

			/* Run the loop for the category page to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-category.php and that will be used instead.
			 */
			get_template_part( 'loop', 'category' );
			?>
		</div>
		<div  class="col-lg-4 col-xs-12 col-sm-4 col-md-4 right-content singalpost">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>
