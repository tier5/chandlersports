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
  <div class="row">
    <div class="col-sm-4 col-xs-12 tab_box pound_tab">
        <div class="pound_tab_box active">
          <div class="col-xs-2 col-sm-12 col-md-2">
            <div class="row">
              <img src="<?= get_template_directory_uri() ?>/images/pound_icon.png" alt="Best price guarantee" class="img-responsive"/>
            </div>
          </div>

          <div class="col-xs-10 col-sm-12 col-md-10">
            <div class="row">
              <span style="padding: 10px;">Best price guarantee</span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12 tab_box van_tab">
        <div class="van_tab_box">
          <div class="col-xs-2 col-sm-12 col-md-2">
            <div class="row">
              <img src="<?= get_template_directory_uri() ?>/images/van_icon.png" alt="Free delivery over &pound;100"  class="img-responsive"/>
            </div>
          </div>

          <div class="col-xs-10 col-sm-12 col-md-10">
            <div class="row">
              <span style="padding: 10px;">Free delivery over &pound;100</span>
            </div>
          </div>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12 tab_box uk_tab">
        <div class="uk_tab_box">
          <div class="col-xs-2 col-sm-12 col-md-2">
            <div class="row">
              <img src="<?= get_template_directory_uri() ?>/images/uk_icon.png" alt="Nationwide Installatio"  class="img-responsive"/>
            </div>
          </div>

          <div class="col-xs-10 col-sm-12 col-md-10">
            <div class="row">
              <span style="padding: 10px;">Nationwide Installation</span>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>

</div>





<div class="catg_main">

  <div class="container">

  <!--<div class="sriv_tit">

          <h1>Highlights</h1>

    </div>-->
<div class="row">
  <div class="col-sm-4">
    <div class="middle_content">

      <h2><img src="<?php echo get_template_directory_uri();?>/images/bar.png" style="float: left;
    margin-top: 4px;margin-right: 5px;">Fitness Products:</h2>
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
    echo '<ul class="first_block">';
    $i2=0;
      foreach ($subcats as $sc) if ($i2++ < 5){
        $addClass3 = "body_child";
        //$addClass4 = "has-child-arrow";
        $link = get_term_link( $sc->slug, $sc->taxonomy );
        $count = $sc->count;
        $sub_cat_name=$sc->term_id;
        if($count > 0){$addClass4 = "has-child-arrow";}else{$addClass4="";}
          echo '<li class="has-child-new '.$addClass4.'" style="line-height:50px;"><span style="width: 40px;">'.$sc->count.'</span><a class="'.$addClass4.'" href="'. $link .'">'.$sc->name.'</a>
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
          echo'<a href="'. $link .'" class="view-more">view more</a></ul></div></div><div class="col-sm-6"><h4 style="text-align: center;color: #ddddd !important;font-weight: 500;">You May Also Like</h4>';
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
            if(strlen(get_the_title()) > 20 ){
              $title = substr(get_the_title(),0,20).'...';
            }else{
              $title = get_the_title(); 
            }
            echo '<div class="col-sm-6"><div class="row"><a href="'.get_permalink( $query->post->ID ).'" title="'.esc_attr($query->post->post_title ? $query->post->post_title : $query->post->ID).'"><div class="productbox"><div class="like_img">';
             if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="100px" height="100px" />'; 
            echo'</div></div><div class="like_title">'.$title.'</div></a></div></div>';

          endwhile;wp_reset_query(); 

          echo '</div></div></div></div></li>';

      }
    echo '</ul>';?>
      
      <?php
         
          $category_link = get_category_link( '183' );
      ?>
      <!--<p style="margin-top: 38px;
    position: relative;"><a class="btm_links" href="<?php echo $category_link; ?>">Shop Now</a></p>-->
    <!--  <div class="more_info full-cat-link" style="margin-top: 38px;">
      <a href="<?php echo $category_link; ?>">Full Category ></a>
      </div> -->
      <a class="btm_links" href="<?php echo $category_link; ?>">Shop Now</a>
    </div>
    
  </div>

  <div class="col-sm-4">
  <div class="middle_content">
    <h2>Strength & Training Equipment:</h2>
    <h3>There is nothing to big we can handle</h3>
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
        $thumbnail_id = get_woocommerce_term_meta( $newsc->term_id, 'thumbnail_id', true ); 
        // get the image URL
      $image = wp_get_attachment_url( $thumbnail_id );
        $newlink = get_term_link( $newsc->slug, $newsc->taxonomy );
        $count = $newsc->count;
        //echo "<img src='{$image}' alt='' width='50' height='50' />";
          echo '<li class=""><span style="width: 40px;"><img src="'.$image.'"alt="" width="50" height="50" /></span><a class="" href="'. $newlink .'">'.$newsc->name.'</a></li>';
        }
        echo '</ul>';
      ?>
      <?php
         
          $category_link2 = get_category_link( '160' );
      ?>
    <a class="btm_links" href="<?php echo $category_link2; ?>">Shop Now</a>
  </div>
 </div>

  <div class="col-sm-4">
  <div class="middle_content comm-fit-mid">
   <h2>Commercial Fitness Services:</h2>
   <h3>Manager or Owner we have you covered</h3>
  <ul>
    <li><span>*</span><a href="<?php echo do_shortcode('[url]'); ?>/commercial-fitness-equipment-edinburgh/gym-design-and-layout/">Gym Design and layout</a></li>
    <li><span>*</span><a href="<?php echo do_shortcode('[url]'); ?>/commercial-fitness-equipment-edinburgh/gymnastic-equipment-repairs/">Gymnastic equipment repair</a></li>
    <li><span>*</span><a href="<?php echo do_shortcode('[url]'); ?>/commercial-fitness-equipment-edinburgh/fitness-equipment-finance/">Finance available</a></li>
    <li><span>*</span><a href="<?php echo do_shortcode('[url]'); ?>/commercial-fitness-equipment-edinburgh/trade-in/">Trade in's welcome</a></li>
    <li><span>*</span><a href="<?php echo do_shortcode('[url]'); ?>/product/impact-rubber-flooring/">Impact rubber flooring</a></li>
    <li><span>*</span><a href="<?php echo do_shortcode('[url]'); ?>/product/gym-mirrors/">Gym mirrors</a></li>
  </ul><a class="btm_links" href="<?php echo do_shortcode('[url]'); ?>/commercial-fitness-equipment-edinburgh/">Learn More</a>
  </div>
 </div>
  
 
</div>
<div class="clear"></div>
<div class="row">
 
  <div class="col-sm-4">
  <div class="middle_content">
   <div class="sriv_tit_final was_box" style="margin-bottom:0px;">

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
    <p>Chandler Sports aims to provide owners and managers of health and fitness facilities with technical assistance and expertise in order to help maintain their fitness equipment.</p><p>Your customers are using your equipment all day, every day and it is all important to minimise the risk of breakages and injuries. Preventative action is best for controlling your business environment and reducing the risk of costly breakdowns.</p><p>Users will be satisfied to know that your equipment is well maintained so they can exercise knowing a treadmill belt will not slip or a bike crank is not cracked.</p>
      <!-- <div class="more_info"> -->
      <a class="btm_links" href="<?php echo do_shortcode('[url]'); ?>/about-chandler-sports/">Read More</a>
      <!-- </div> -->
      <!--<p><a href="<?php echo do_shortcode('[url]'); ?>/about-chandler-sports/" class="all-about-readmore">Read More</a></p>-->
  </div>
 </div>
<div class="col-sm-4">
    <div class="middle_content">
       <div class="sriv_tit_final was_box">
     <h1> REQUEST <span> FOR QUOTATION</span></h1>
   </div>
    <p>Tell us your big idea's from home gym start ups to commercial enterprises</p> 
    <div class="contact-form-wrap">
      <?php echo do_shortcode('[contact-form-7 id="15947" title="Contact form 1"]');?>
    </div>
      <!-- <div style="padding: 0 15%;width: 100%;height: 200px;" class="big_req_img">
<?php $newargs1 = array(
       'show_option_none' => '',
       'hierarchical' => 1,
       'hide_empty' => 0,
       'parent' => 183,
       'taxonomy' => 'product_cat',
       'orderby'  => 'slug'
    );
  $newsubcats1 = get_categories($newargs1);
    $i4=0;
      foreach ($newsubcats1 as $newsc1) if ($i4++ < 1){
        $thumbnail_id1= get_woocommerce_term_meta( $newsc1->term_id, 'thumbnail_id', true ); 
        // get the image URL
      $image1 = wp_get_attachment_url( $thumbnail_id1 );
        $newlink1 = get_term_link( $newsc->slug, $newsc->taxonomy );
        $count1 = $newsc->count;
        echo "<img src='{$image}' alt='' width='100%' style='float:left' class='req_img'/>";
          //echo '<li class=""><span style="width: 40px;"><img src="'.$image.'"alt="" width="50" height="50" /></span><a class="" href="'. $newlink .'">'.$newsc->name.'</a></li>';
        }
        
      ?>
    </div>
     <div style="display: inline-block;width: 100%;text-align: center;">
      <?php $newargs = array(
       'show_option_none' => '',
       'hierarchical' => 1,
       'hide_empty' => 0,
       'parent' => 183,
       'taxonomy' => 'product_cat',
       'orderby'  => 'slug'
    );
  $newsubcats = get_categories($newargs);
    $i3=0;
      foreach ($newsubcats as $newsc) if ($i3++ < 4){
        $thumbnail_id = get_woocommerce_term_meta( $newsc->term_id, 'thumbnail_id', true ); 
        // get the image URL
      $image = wp_get_attachment_url( $thumbnail_id );
        $newlink = get_term_link( $newsc->slug, $newsc->taxonomy );
        $count = $newsc->count;
        echo "<img src='{$image}' alt='' width='25%' style='float:left' class='req_img'/>";
          //echo '<li class=""><span style="width: 40px;"><img src="'.$image.'"alt="" width="50" height="50" /></span><a class="" href="'. $newlink .'">'.$newsc->name.'</a></li>';
        }
      ?>
    </div> -->
      <!--<ul>
        <li><span>*</span><a href="#">Repairs- Fees and Charge</a></li>
        <li><span>*</span><a href="#">Servicing- What is included?</a></li>
        <li><span>*</span><a href="#">Spare Parts - Most parts sourced</a></li>
        <li><span>*</span><a href="#">Upholstery-To you or Collect</a></li>
        <li><span>*</span><a href="#">Cabeling Replacement - kevlar and cable</a></li>
      </ul>-->
    <!-- </br></br>
      <div class="more_info">
      <a href="<?php $url = site_url(); echo $url ?>/contact">Request Now ></a>
      </div> -->
      <!--<p style="margin-top: 38px;
    position: relative;"><a class="btm_links" href="<?php //$url = site_url();
//echo $url ?>/contact">Request Now</a></p>-->
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


<div class="footer_up_line">
<div class="container">
    <div class="col-sm-12">
      <h2>Maintanance & Servicing:</h2>
      </div>
    <div class="first_upper_footer">
    <div class="col-md-12 col-sm-12">
      <div class="col-md-5 col-sm-12">
     <!--<div style="color:#333; font-weight:bold;font-size: 22px;text-align:left;">We can look after your products</div>-->
<h2>Commercial facilities and home use: </h2>
<h3>Fitness equipment maintenance and repairs</h3>
      <ul>
        <li><span><img src="<?php bloginfo('template_directory'); ?>/images/main-1.png"></span><a href="#">Repairs - Fees and Charge</a></li>
        <li><span><img src="<?php bloginfo('template_directory'); ?>/images/main-2.png"></span><a href="#">Servicing - What is included?</a></li>
        <li><span><img src="<?php bloginfo('template_directory'); ?>/images/spare_part.png"></span><a href="#">Spare Parts - Most parts sourced</a></li>
        <li><span><img src="<?php bloginfo('template_directory'); ?>/images/main-3.png"></span><a href="#">Upholstery - To you or Collect</a></li>
        <li><span><img src="<?php bloginfo('template_directory'); ?>/images/Replace-icon.png"></span><a href="#">Cabling Replacement - kevlar and cable</a></li>
      </ul>
      <!--<div class="more_info">
      <a href="">More enquery ></a>
      </div>-->
      </div>
      <div class="col-md-7 col-sm-12 video_sec">
      <div class="row">
       <iframe width="400" height="280" src="https://www.youtube.com/embed/IpOB2bwLXkc"></iframe>
      </div>
      </div> 
      </div> 
    </div>
</div>
</div>






<div class="test_and_lin">

<!--<div class="test_and_lin ">-->

  <div class="container">
    <div class="col-sm-12 after-middle">
     <div class="col-sm-4">
     <a title="Supersaver Delivery Map" href="<?php echo do_shortcode('[url]'); ?>/delivery-map/" target="_blank"><img src="<?php echo do_shortcode('[url]'); ?>/wp-content/uploads/2016/05/super_saver_images1.jpg" alt="" class="img-auto-width-set" /></a>
     </div>
     <div class="col-sm-4">
     <?php echo do_shortcode('[email-subscribers namefield="NO" desc="" group="Public"]');?>
     </div>
     <div class="col-sm-4">
     <a href="<?php echo do_shortcode('[url]'); ?>/home-fitness-equipment-repairs/" target="_blank"><img src="<?php echo do_shortcode('[url]'); ?>/wp-content/uploads/2016/05/need_an_equipment_images2.png" alt="" class="img-auto-width-set" /></a>
     </div>
         <div class="col-sm-2"></div>

  </div>
  </div>
<!--</div>-->
<div class="onsale-wrapper">
  <div class="container">
  <div class="col-sm-12 onsale-scroll">
  <div class="was_box">  
  <h1>On <span>Sale</span></h1>
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
<div class="owl-buttons"><div class="owl-prev"><img src="<?php echo get_template_directory_uri();?>/images/prev.png"></div><div class="owl-next"><img src="<?php echo get_template_directory_uri();?>/images/next.png"></div></div>
  <?php

}

  ?>

  </div>

  </div>

</div>

<div class="onsale-wrapper">
  <div class="container">
  <div class="col-sm-12 onsale-scroll">
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
  <div class="owl-buttons"><div class="newowl-prev"><img src="<?php echo get_template_directory_uri();?>/images/prev.png"></div><div class="newowl-next"><img src="<?php echo get_template_directory_uri();?>/images/next.png"></div></div>


  <?php

}

  ?>

  </div>

  </div>

</div>  

<script>

  jQuery(document).ready(function(){
    var owl = null;
    var carousal=$("#sale-owl");

$('#sale-owl').owlCarousel({

    loop:true,

    margin:10,

    items:5,

    navigation:false,
    afterInit: function() {
      owl = this;
    }

    //navigationText: ["<img src='<?php echo get_template_directory_uri();?>/images/prev.png'>","<img src='<?php echo get_template_directory_uri();?>/images/next.png'>"]
});
$('.owl-next').click(function(){
  //alert('test');
    carousal.trigger('owl.goTo', owl.currentItem + 5)
  });

  $('.owl-prev').click(function(){
    //alert('test2');
    carousal.trigger('owl.goTo', owl.currentItem - 5)
  });
var newowl = null;
var newcarousal=$("#latest-owl");
$('#latest-owl').owlCarousel({

    loop:true,

    margin:10,

    items:5,

    navigation:false,

    //navigationText: ["<img src='<?php echo get_template_directory_uri();?>/images/prev.png'>","<img src='<?php echo get_template_directory_uri();?>/images/next.png'>"]



afterInit: function() {
      newowl = this;
    }

    //navigationText: ["<img src='<?php echo get_template_directory_uri();?>/images/prev.png'>","<img src='<?php echo get_template_directory_uri();?>/images/next.png'>"]
});
$('.newowl-next').click(function(){
  //alert('test');
    newcarousal.trigger('owl.goTo', newowl.currentItem + 5)
  });

  $('.newowl-prev').click(function(){
    //alert('test2');
    newcarousal.trigger('owl.goTo', newowl.currentItem - 5)
  });

  });

</script>



<script type="text/javascript">
  jQuery(document).ready(function($){
    $('.has-child-new').click(function(e){
  e.stopPropagation();
      $(this).siblings('li').children('div.body_child').css('display','none');
      $(this).children('div.body_child').css('display','block');
      e.preventDefault();
    });
    $( ".tab_box" ).click(function(){
      $(this).toggleClass('active');
    });

$("body").click(function() {
    $(".body_child").hide();
});

$('.has-child-new').dblclick(function(e){
  e.stopPropagation();
  window.location = $(this).children('a').attr('href');
        return false;
});

  });

</script>
<div class="srive_box">
  <div class="container">
    <div class="col-sm-6 no-margin-left">
      <div class="srive_left">
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

       <?php endwhile; wp_reset_postdata();  ?>


                                </div>

                                

                            </div>

     </div></div>
    </div>

  <div class="col-sm-6 no-margin-right">
      <div class="srive_left">
      <div class="sriv_tit eq was_box">

          <h1>Fitness <span>Equipment Services</span></h1>

        </div>

  <div class="col-sm-12">

        <div class="col-sm-4">

          <div class="sriv_box_1">

              <a href="<?php echo home_url();?>/gym-equipment-spare-parts-edinburgh/"><img src="<?php bloginfo('template_directory'); ?>/images/icon.png" alt="" />

                <h2>Spare Parts</h2></a>

            </div>

        </div>

        <div class="col-sm-4">

          <div class="sriv_box_1">

              <a href="<?php echo home_url();?>/commercial-gym-edinburgh/"><img src="<?php bloginfo('template_directory'); ?>/images/icon2.png" alt="" />

                <h2>Repairs</h2></a>

            </div>

        </div>

        <div class="col-sm-4">

          <div class="sriv_box_1">

              <a href="<?php echo home_url();?>/commercial-gym-edinburgh/cabling-services/"><img src="<?php bloginfo('template_directory'); ?>/images/icon3.png" alt="" />

                <h2>Cabling Service</h2></a>

            </div>

        </div>

  </div>

      </br>

     <div class="col-sm-12">

        <div class="col-sm-4">

          <div class="sriv_box_1">

              <a href="<?php echo home_url();?>/commercial-gym-edinburgh/upholstery-repairs/"><img src="<?php bloginfo('template_directory'); ?>/images/icon4.png" alt="" />

                <h2>Upholstery</h2></a>

            </div>

        </div>

        <div class="col-sm-4">

          <div class="sriv_box_1">

           <!-- <a href="<?php //echo home_url();?>/gym-equipment-service-maintenance-packages/">-->

              <a href="<?php echo home_url();?>/service-maintenance-contracts/"><img src="<?php bloginfo('template_directory'); ?>/images/icon5.png" alt="" />

                <h2>Service &

Maintenance

 Contracts</h2></a>

            </div>

        </div>

        <div class="col-sm-4">

          <div class="sriv_box_1">

              <a href="<?php echo home_url();?>/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/"><img src="<?php bloginfo('template_directory'); ?>/images/icon6.png" alt="" />

                <h2>Delivery,Installation & Relocation</h2></a>

  </div>

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
  $(".req_img").click(function(){
  $img = $(this).clone();
  $(".big_req_img").show().html($img.attr({
        width: 200,
        height: 200
    }));
}); 



$(".tab_box").hover(function(){
  
     $(this).siblings('div').children('div').removeClass("active");
     
    $(this).children('div').addClass('active');
  });
});

</script>



<?php get_footer(); ?>
