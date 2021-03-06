<?php
/**
* Template Name: New Homepage 2014
*/

get_header(); ?>
<style>
.sethomeim img{
	width:273px !important;
	height:277px !important;
	margin:0 auto;
}

</style>
	<div class="main_banner">
        <div class="">
	<div id="owl-demo" class="owl-carousel">

	 <?php
					   $the_query = new WP_Query(array(
						'category_name' => 'banner'
						));
					   while ( $the_query->have_posts() ) :
					   $the_query->the_post();
					    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					  ?>

    	<div class="item">
        	<img src="<?php echo $feat_image;?>" alt="#">
            <div class="container in_ba_tex">
            	<?php the_content();?>
            </div>
        </div>

 <?php
				endwhile;
				 wp_reset_postdata();  ?>

    </div>

    </div>

</div>


<div class="catg_main">
	<div class="container">
	<div class="sriv_tit">
        	<h1>Highlights</h1>
    </div>

    	<div class="main_cat_p_box">

		<?php echo do_shortcode('[contentblock id=home-page-category]'); ?>

        </div>


		<div>

		<?php echo do_shortcode('[contentblock id=home-page-four-category]'); ?>

		</div>

    </div>
</div>

<div class="test_and_lin">
	<div class="container">
    	<div class="col-sm-6">
     <div class="sriv_tit_final was_box" style="margin-bottom:10px;">
        	<h1> Awesome Reasons <span>to Shop at Chandler Sports </span></h1>
        </div>
     <div class="set-all-footer-topall"><ul>
<div class="col-sm-6">
      <li>Over 600 fitness products</li>
      <li>Expert advice and support</li>
      <li>Sales & Advice Line - 01968 670 610</li>
      <li>Commercial Sales & Advice - 01968 672 020</li>
      <li>Option to buy or hire</li>
	 <li>Gym planning and advice</li>
</div>
<div class="col-sm-6">
      <li>Super Saver - free 2-man delivery and installation, removal of packaging and old equipment</li>
      <li>Maintenance & Repairs - complete with 60-day warranty</li>

      <li>14-day Return Options</li>
</div>


     </ul></div>
     </div>
       <div class="col-sm-1"></div>
        <div class="col-sm-5 ab">
        	 <div class="sriv_tit_final was_box">
        	<h1> About <span>Chandlersports </span></h1>
              </div>

		<p>Chandler Sports aims to provide owners and managers of health and fitness facilities with technical assistance and expertise in order to help maintain their fitness equipment.</br></br><a href="<?php echo do_shortcode('[url]'); ?>/about-chandler-sports/" class="all-about-readmore">Read More</a></p>


        </div>
    </div>
</div>

<div class="test_and_lin">

<div class="container">
     <div class="col-sm-2"></div>
     <div class="col-sm-4">

     <a title="Supersaver Delivery Map" href="<?php echo do_shortcode('[url]'); ?>/delivery-map/" target="_blank"><img src="<?php echo do_shortcode('[url]'); ?>/wp-content/uploads/2016/05/super_saver_images1.jpg" alt="" class="img-auto-width-set" /></a>

     </div>

     <div class="col-sm-4">

     <a href="<?php echo do_shortcode('[url]'); ?>/home-fitness-equipment-repairs/" target="_blank"><img src="<?php echo do_shortcode('[url]'); ?>/wp-content/uploads/2016/05/need_an_equipment_images2.jpg" alt="" class="img-auto-width-set" /></a>

     </div>
         <div class="col-sm-2"></div>
</div>

</div>



<div class="srive_box">
	<div class="container">
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
            <!-- <div class="col-sm-3 text-center"><img class="img-circle" src="<?php echo $feat_image;?>" style="width: 100px;height:100px;">
                                    </div>-->
                                    <div class="col-sm-12">
                                    <div class="test_box">
                                      <?php the_content();?>
                                      </div>
                                      <h5><?php the_title();?></span></h5>
                                    </div>
									 </div>
                                </blockquote>
								</div>
			 <?php
				endwhile;
				 wp_reset_postdata();  ?>





                                </div>
                                <!--<blockquote>
                                  <div class="row">
                                    <div class="col-sm-3 text-center">
                                      <img class="img-circle" src="images/testimonials_img_02.png" style="width: 100px;height:100px;">
                                    </div>
                                    <div class="col-sm-9">
                                    <div class="test_box">
                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum letters, as opposed </p>
                                      </div>
                                      <h5>Mary Barra-<span> CEO</span></h5>
                                    </div>
                                  </div>
                                </blockquote>-->
                            </div>
                        </div>

	</div>
	<div class="col-sm-6 ">
    	<div class="sriv_tit eq">
        	<h1>Fitness <span>Equipment Services</span></h1>
        </div>
	<div class="col-sm-12">
        <div class="col-sm-4">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/gym-equipment-spare-parts-edinburgh/"><img src="<?php bloginfo('template_directory'); ?>/images/I1.jpg" alt="" />
                <h2>Spare Parts</h2></a>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/commercial-gym-edinburgh/"><img src="<?php bloginfo('template_directory'); ?>/images/I2.jpg" alt="" />
                <h2>Repairs</h2></a>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/commercial-gym-edinburgh/cabling-services/"><img src="<?php bloginfo('template_directory'); ?>/images/I3.jpg" alt="" />
                <h2>Cabling Service</h2></a>
            </div>
        </div>
	</div>
      </br>
     <div class="col-sm-12">
        <div class="col-sm-4">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/commercial-gym-edinburgh/upholstery-repairs/"><img src="<?php bloginfo('template_directory'); ?>/images/I4.jpg" alt="" />
                <h2>Upholstery</h2></a>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/gym-equipment-service-maintenance-packages/"><img src="<?php bloginfo('template_directory'); ?>/images/I5.jpg" alt="" />
                <h2>Service &
Maintenance
 Contracts</h2></a>
            </div>
        </div>
        <div class="col-sm-4">
        	<div class="sriv_box_1">
            	<a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/"><img src="<?php bloginfo('template_directory'); ?>/images/I6.jpg" alt="" />
                <h2>Delivery,
Installation &
Relocation
</h2></a>
            </div>
        </div>
</div>
</div>
    </div>
</div>




<?php get_footer(); ?>
