<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

include 'blog_header.php'; ?>

<div class="container">
<div class="col-lg-12">
<div class="ab_box">
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
  setPostViews(get_the_ID());
  ?>
  <h1> test
    <?php the_title(); ?>
  </h1>
  <div class="postedmeta">Posted on <span>
    <?php the_date('F, d Y'); ?>
    </span> by <span>
    <?php the_author(); ?>
    </span></div>
  <?php the_content(); ?>
  <p id="postedin">
    <?php twentyten_posted_in(); ?>
  </p>
  <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="560" data-num-posts="100"></div>
  <?php
  if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
  ?>
  <?php endwhile; ?>
</div>
</div>
</div>

<?php /*?><div class="col-lg-4 col-xs-12 col-sm-4 col-md-4 right-content singalpost">
          
              <div class="side_icons">
                  <a href="#"><img src="/wp-content/themes/chandler/images/fb-btn.png" border="0" /></a>
                  <a href="#"><img src="/wp-content/themes/chandler/images/twitter-btn.png" border="0" /></a> 
                  <a href="#"><img src="/wp-content/themes/chandler/images/gplusbtn.png" border="0" /></a>
              </div>
          
              <?php get_sidebar(); ?>		
          </div>
<?php */?>
<!--<div class="test_and_lin">
  <div class="container">
    <div class="col-sm-6">
      <div class="left_box_ti cf">
        <div class="col-sm-6"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/super_saver_images.jpg" alt="" /></a> </div>
        <div class="col-sm-6"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/need_an_equipment_images.jpg" alt="" /></a> </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="was_box">
        <h1>WHAT<span>PEOPLE SAY</span></h1>
        <div class="testimonials">
          <div id="owl-demo-4" class="owl-carousel">
            <div class="item">
              <blockquote>
                <div class="row">
                  <div class="col-sm-3 text-center"> <img class="img-circle" src="<?php bloginfo('template_directory'); ?>/images/testimonials_img_01.png" style="width: 100px;height:100px;"> </div>
                  <div class="col-sm-9">
                    <div class="test_box">
                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum letters, as opposed </p>
                    </div>
                    <h5>John Smith- <span>Managing Director</span></h5>
                  </div>
                </div>
              </blockquote>
            </div>
            <div class="item">
              <blockquote>
                <div class="row">
                  <div class="col-sm-3 text-center"> <img class="img-circle" src="<?php bloginfo('template_directory'); ?>/images/testimonials_img_02.png" style="width: 100px;height:100px;"> </div>
                  <div class="col-sm-9">
                    <div class="test_box">
                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum letters, as opposed </p>
                    </div>
                    <h5>Mary Barra-<span> CEO</span></h5>
                  </div>
                </div>
              </blockquote>
            </div>
            <div class="item">
              <blockquote>
                <div class="row">
                  <div class="col-sm-3 text-center"> <img class="img-circle" src="<?php bloginfo('template_directory'); ?>/images/testimonials_img_01.png"> </div>
                  <div class="col-sm-9">
                    <div class="test_box">
                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum letters, as opposed </p>
                    </div>
                    <h5>John Smith- <span>Managing Director</span></h5>
                  </div>
                </div>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>-->
<br style="clear: both;" />
<?php include 'blog_footer.php'; ?>
