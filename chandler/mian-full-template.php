	<?php
/**
 * Template name:main-full-template
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
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
		<div class="ab_box">
	   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title-h4"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<div class="test_and_lin">
	<div class="container">
    	<div class="col-sm-6">
        	<div class="left_box_ti cf">
            	<div class="col-sm-6">
                	<a href="<?php echo home_url();?>/delivery-map/"><img src="<?php bloginfo('template_directory'); ?>/images/super_saver_images.jpg" alt="" /></a>
                </div>
                <div class="col-sm-6">
                	<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/need_an_equipment_images.jpg" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
        	<div class="was_box">
                        	<h1>WHAT<span> PEOPLE SAY</span></h1>
                            <div class="testimonials">
                            <div id="owl-demo-4" class="owl-carousel">
                            <?php
					   $the_query = new WP_Query(array(
						'category_name' => 'Testimonials'
						));
					   while ( $the_query->have_posts() ) :
					   $the_query->the_post();
					    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					  ?>
                                <div class="item">
                            	<blockquote>
                                  <div class="row">
                                    <div class="col-sm-3 text-center">
                                      <img class="img-circle" src="<?php echo $feat_image;?>" style="width: 100px;height:100px;">
                                    </div>
                                    <div class="col-sm-9">
                                    <div class="test_box">
                                       <?php the_content();?>
                                      </div>
                                      <h5><?php the_title();?></h5>
                                    </div>
                                  </div>
                                </blockquote>
                                </div>
                             <?php
				 endwhile;
				 wp_reset_postdata();
				?>

                                </div>

                            </div>
                        </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
