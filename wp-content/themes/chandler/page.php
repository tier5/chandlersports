<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
                        <div class="col-sx-12 text-center">
                            <h3><?php the_title(); ?></h3>
                            <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="<?= site_url(); ?>">Home</a></li>
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
		<div class="ab_box">
	   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<!-- 				<h1 class="page-title-h4"><?php the_title(); ?></h1> -->
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
