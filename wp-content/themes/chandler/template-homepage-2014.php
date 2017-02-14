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





<div class="header-cta-bar hidden-xs">

  <div class="container">

    <div class="col-sm-4 col-xs-12">

      <div class="col-xs-2 col-sm-12 col-md-2">

        <img src="<?= get_template_directory_uri() ?>/images/pound_icon.jpg" alt="Best price guarantee" />

      </div>

      <div class="col-xs-10 col-sm-12 col-md-10">

        <span>Best price guarantee</span>

      </div>

    </div>

    <div class="col-sm-4 col-xs-12">

      <div class="col-xs-2 col-sm-12 col-md-2">

        <img src="<?= get_template_directory_uri() ?>/images/van_icon.jpg" alt="Free delivery over &pound;100" />

      </div>

      <div class="col-xs-10 col-sm-12 col-md-10">

        <span>Free delivery over &pound;100</span>

      </div>

    </div>

    <div class="col-sm-4 col-xs-12">

      <div class="col-xs-2 col-sm-12 col-md-2">

        <img src="<?= get_template_directory_uri() ?>/images/uk_icon.jpg" alt="Nationwide Installatio" />

      </div>

      <div class="col-xs-10 col-sm-12 col-md-10">

        <span>Nationwide Installation</span>

      </div>

    </div>

  </div>

</div>





<div class="catg_main">

  <div class="container">

  <div class="sriv_tit">

          <h1>Highlights</h1>

    </div>
<div class="row">
  <div class="col-sm-4">
    <div class="middle_content">
      <h2>Fitness Products:</h2>
      <h3>Quality brands at best buys</h3>
      <?php $args = array(
       'show_option_none' => '',
       'hierarchical' => 1,
       'hide_empty' => 0,
       'parent' => 183,
       'taxonomy' => 'product_cat',
       'orderby'  => 'slug'
    );
  $subcats = get_categories($args);
    echo '<ul class="1st_block">';
    $i2=0;
      foreach ($subcats as $sc) if ($i2++ < 5){
        $addClass3 = "body_child";
        //$addClass4 = "has-child-arrow";
        $link = get_term_link( $sc->slug, $sc->taxonomy );
        $count = $sc->count;
        $sub_cat_name=$sc->term_id;
        if($count > 0){$addClass4 = "has-child-arrow";}else{$addClass4="";}
          echo '<li class="has-child-new '.$addClass4.'"><span style="width: 40px;">'.$sc->count.'</span><a class="'.$addClass4.'" href="'. $link .'">'.$sc->name.'</a>
          <div class="'.$addClass3.'">
          <div class="col-md-12">
          <div class="row">
          <div class="col-sm-6">
          <div class="custom-height">
          <h3>'.$sc->name.'</h3>
          <ul>';
          $subargs = array(
           'show_option_none' => '',
           'hierarchical' => 1,
           'hide_empty' => 0,
           'parent' => $sub_cat_name,
           'taxonomy' => 'product_cat',
           'orderby'  => 'slug'
            );
          $i3=0;
          $subsubcats = get_categories($subargs);
        foreach ($subsubcats as $new_sc) if ($i3++ < 5){
          $sub_link = get_term_link( $new_sc->slug, $new_sc->taxonomy );
          $sub_count = $new_sc->count;
        
  echo'<li><a class="" href="'. $sub_link .'">'.$new_sc->name.'</a></li>'; 
}
          echo'</br><a href="'. $link .'" style="color: #b6b3b3;">view more</a></ul></div></div><div class="col-sm-6"><h4 style="text-align: center;color: #ddddd !important;font-weight: 500;">You May Also Like</h4>';
            $args = array(
              'post_type' => 'product',
              'posts_per_page' => 6,
              'tax_query' => array(
                array(
                  'taxonomy' => 'product_cat',
                  'field'    => 'slug',
                  'terms'    => $sc->slug,
                ),
              ),
            );
            $query = new WP_Query( $args );
            //echo'<pre>';
            //print_r($query);
            //foreach ($query as $new_query) {
             while ( $query->have_posts() ) : $query->the_post();
            global $product; 
            $thumbnail = get_the_post_thumbnail_url();
            echo '<div class="col-sm-6"><div class="row"><a href="'.get_permalink( $query->post->ID ).'" title="'.esc_attr($query->post->post_title ? $query->post->post_title : $query->post->ID).'"><div class="productbox"><div class="like_img">';
             if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="100px" height="100px" />'; 
            echo'</div></div><div class="like_title" style="text-align:center">'.get_the_title().'</div></a></div></div>';

          endwhile;wp_reset_query(); 

          echo '</div></div></div></div></li>';

      }
    echo '</ul>';?>
      
      <?php
         
          $category_link = get_category_link( '183' );
      ?>
      <p>Click Here to see<a class="btm_links" href="<?php echo $category_link; ?>">Full category</a></p>
    </div>
    
  </div>
  <div class="col-sm-4">
    <div class="middle_content">
     <h2>Maintanance & Servicing:</h2>
     <h3>We can look after your products</h3>
      <ul>
        <li><span>*</span>Repairs- Fees and Charge</li>
        <li><span>*</span>Servicing- What is included?</li>
        <li><span>*</span>Spare Parts - Most parts sourced</li>
        <li><span>*</span>Upholstery-To you or Collect</li>
        <li><span>*</span>Cabeling Replacement - kevlar and cable</li>
      </ul>
    </div>
 </div>
 <div class="col-sm-4">
  <div class="middle_content">
    <h2>Strength & Training Equipment:</h2>
    <h3>There is setting to big</h3>
    <?php $newargs = array(
       'show_option_none' => '',
       'hierarchical' => 1,
       'hide_empty' => 0,
       'parent' => 160,
       'taxonomy' => 'product_cat',
       'orderby'  => 'slug'
    );
  $newsubcats = get_categories($newargs);
    echo '<ul class="2nd_block">';
    $i3=0;
      foreach ($newsubcats as $newsc) if ($i3++ < 5){
        $newlink = get_term_link( $newsc->slug, $newsc->taxonomy );
        $count = $newsc->count;
          echo '<li class=""><span style="width: 40px;">*</span><a class="" href="'. $newlink .'">'.$newsc->name.'</a></li>';
        }
        echo '</ul>';
      ?>
    <!--<ul>
    <li><span>*</span>Multi stations</li>
    <li><span>*</span>Single stack machines</li>
    <li><span>*</span>Power racks</li>
    <li><span>*</span>Weight benchs</li>
    <li><span>*</span>Dual compact machines</li>
    </ul>-->
      <?php
         
          $category_link2 = get_category_link( '160' );
      ?>
    <p>Click Here to see<a class="btm_links" href="<?php echo $category_link2; ?>">Full category</a></p>

  </div>
 
 </div>
</div>
<div class="clear"></div>
<div class="row">
 
  <div class="col-sm-4">
  <div class="middle_content">
   <div class="sriv_tit_final was_box" style="margin-bottom:10px;">

          <h1> More Reasons <span>why Chandler Sports keep you going </span></h1>

        </div>

     <div class="set-all-footer-topall">
      <ul>

<div class="col-sm-6">

      <li>Over 1000’s of fitness products</li>

      <li>Expert advice and support</li>

      <li>Sales and advice line – 01968672020</li>

      <li>Commercial Sales & Advice - 01968 672 020</li>

      <li>Option to buy, finance or hire</li>

   <li>Gym planning and advice</li>

</div>
    <div class="col-sm-6">

          <li>Super Saver - free 2-man delivery and installation, removal of packaging and old equipment</li>

          <li>Maintenance & Repairs - complete with 60-day warranty</li>
          <li>14-day Return Options</li>

    </div>
  </ul>
   </div>
  </div>
 </div>
  <div class="col-sm-4">
  <div class="middle_content">
      <div class="sriv_tit_final was_box">
          <h1> About <span>Chandlersports </span></h1>
          </div>
    <p>Chandler Sports aims to provide owners and managers of health and fitness facilities with technical assistance and expertise in order to help maintain their fitness equipment.</br>Your customers are using your equipment all day, every day and it is all important to minimise the risk of breakages and injuries. Preventative action is best for controlling your business environment and reducing the risk of costly breakdowns.</br></br><a href="<?php echo do_shortcode('[url]'); ?>/about-chandler-sports/" class="all-about-readmore">Read More</a></p>
  </div>
 </div>

<div class="col-sm-4">
  <div class="middle_content">
   <h2>Commercial Fitness:</h2>
   <h3>There is setting to big</h3>
  <ul>
    <li><span>*</span>Multi stations</li>
    <li><span>*</span>Single stack machines</li>
    <li><span>*</span>Power racks</li>
    <li><span>*</span>Weight benchs</li>
    <li><span>*</span>Dual compact machines</li>
  </ul>
  </div>
 </div>
 </div>

      <div class="main_cat_p_box">



    <?php //echo do_shortcode('[contentblock id=home-page-category]'); ?>



        </div>





    <div>



    <?php //echo do_shortcode('[contentblock id=home-page-four-category]'); ?>



    </div>



    </div>

</div>



<div class="test_and_lin">

  <div class="container">

     <!-- <div class="col-sm-6">

     <div class="sriv_tit_final was_box" style="margin-bottom:10px;">

          <h1> More Reasons <span>why Chandler Sports keep you going </span></h1>

        </div>

     <div class="set-all-footer-topall"><ul>

<div class="col-sm-6">

      <li>Over 1000’s of fitness products</li>

      <li>Expert advice and support</li>

      <li>Sales and advice line – 01968672020</li>

      <li>Commercial Sales & Advice - 01968 672 020</li>

      <li>Option to buy, finance or hire</li>

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

    </div>-->

</div>



<div class="test_and_lin">



<div class="container">

     

     <div class="col-sm-4">



     <a title="Supersaver Delivery Map" href="<?php echo do_shortcode('[url]'); ?>/delivery-map/" target="_blank"><img src="<?php echo do_shortcode('[url]'); ?>/wp-content/uploads/2016/05/super_saver_images1.jpg" alt="" class="img-auto-width-set" /></a>



     </div>



     <div class="col-sm-4">



     <?php echo do_shortcode('[email-subscribers namefield="NO" desc="" group="Public"]');?>



     </div>



     <div class="col-sm-4">



     <a href="<?php echo do_shortcode('[url]'); ?>/home-fitness-equipment-repairs/" target="_blank"><img src="<?php echo do_shortcode('[url]'); ?>/wp-content/uploads/2016/05/need_an_equipment_images2.jpg" alt="" class="img-auto-width-set" /></a>



     </div>

         <div class="col-sm-2"></div>

</div>



</div>



<div class="onsale-wrapper">

  <div class="container">

  <div class="col-sm-12">

  <div class="was_box">  

  <h1>On <span>sale</span></h1>

  </div>

  <?php 

  $args = array(

    'post_type'      => 'product',

    'posts_per_page' => -1,

    'orderby' => 'title',

    'order' => 'asc',

    'meta_query'     => array(

        'relation' => 'OR',

        array( // Simple products type

            'key'           => '_sale_price',

            'value'         => 0,

            'compare'       => '>',

            'type'          => 'numeric'

        ),

        array( // Variable products type

            'key'           => '_min_variation_sale_price',

            'value'         => 0,

            'compare'       => '>',

            'type'          => 'numeric'

        )

    )

);



$loop = new WP_Query( $args );



?>

<?php 

if($loop->have_posts()){

  ?>



   <div id="sale-owl" class="owl-carousel">

  <?php

  while($loop->have_posts()):$loop->the_post();

  $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));

  ?>

 

    <div class="item">

    <?php woocommerce_get_template_part( 'content', 'product' );?>

   <!--  <img src="<?php //echo($image[0]!='')?$image[0]:''; ?>" />

    <h4><?php //echo get_the_title();?></h4> -->



    </div>

  

  <?php

  endwhile;

  ?>

  </div>

  <?php

}

  ?>

  </div>

  </div>

</div>

<div class="onsale-wrapper">

  <div class="container">

  <div class="col-sm-12">

  <div class="was_box">  

  <h1>New to <span>Market</span></h1>

  </div>

  <?php 

  $newargs = array(

'post_type' => 'product',

'stock' => 1,

'posts_per_page' => -1,

'orderby' =>'date',

'order' => 'DESC' );

$newloop = new WP_Query( $newargs );



?>

<?php 

if($newloop->have_posts()){

  ?>



   <div id="latest-owl" class="owl-carousel">

  <?php

  while($newloop->have_posts()):$newloop->the_post();

  $newimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));

  ?>

 

    <div class="item">

    <?php woocommerce_get_template_part( 'content', 'product' );?>

   <!--  <img src="<?php //echo($image[0]!='')?$image[0]:''; ?>" />

    <h4><?php //echo get_the_title();?></h4> -->



    </div>

  

  <?php

  endwhile;

  ?>

  </div>

  <?php

}

  ?>

  </div>

  </div>

</div>  

<script>

  jQuery(document).ready(function(){

$('#sale-owl').owlCarousel({

    loop:true,

    margin:10,

    items:5,

    navigation:true,

    navigationText: ["<img src='<?php echo get_template_directory_uri();?>/images/prev.png'>","<img src='<?php echo get_template_directory_uri();?>/images/next.png'>"]



});

$('#latest-owl').owlCarousel({

    loop:true,

    margin:10,

    items:5,

    navigation:true,

    navigationText: ["<img src='<?php echo get_template_directory_uri();?>/images/prev.png'>","<img src='<?php echo get_template_directory_uri();?>/images/next.png'>"]



});

  });

</script>



<script type="text/javascript">
  jQuery(document).ready(function($){
    $('.has-child-new').hover(function(){
      $(this).children('div.body_child').css('display','block');
    }, 
  function () {
    $(this).children('div.body_child').css('display','none');
  });
  });
</script>







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

           <!-- <a href="<?php //echo home_url();?>/gym-equipment-service-maintenance-packages/">-->

              <a href="<?php echo home_url();?>/service-maintenance-contracts/"><img src="<?php bloginfo('template_directory'); ?>/images/I5.jpg" alt="" />

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



<script type="text/javascript">

  jQuery(document).ready(function(){

    $('.es_textbox_class').attr("placeholder", "Enter Your Email");

    $('.es_lablebox').text('');

    $('.es_lablebox').text('Deals, Clearance and discounts');

  });

</script>



<?php get_footer(); ?>
