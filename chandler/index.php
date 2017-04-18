<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div class="main_banner innerpage-image">
	<section class="section single-wrap">
    	<div class="container">
        	<div class="page-title">
                    <div class="row">
                        <div class="col-sx-12">
                            <h3><?php the_title(); ?></h3>
                            <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="<?php echo do_shortcode('[url]') ?>">Home</a></li>
                                  <li class="active"><?php the_title(); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>

<div class="catg_main">

  <div class="container">

    <div class="blog_box">
  	     <div class="blo_1 cf">
			<?php get_template_part( 'loop', 'index' ); ?>
		 </div>


</div>
</div>
</div>

<?php get_footer(); ?>
