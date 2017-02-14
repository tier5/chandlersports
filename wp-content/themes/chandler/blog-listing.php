<?php
/**
* Template Name: Blog Listing
*/

get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$blog_args = array(
  'post_type' => 'post',
  'posts_per_page' => 15,
  'post_status' => 'publish',
  'paged' => $paged,
  'cat' => '-351',
  );
$blog_query = new WP_Query($blog_args);
?>
<style type="text/css">
  .ms-item {
width: 33%;
}
img{max-width: 100%; height: auto;}
.ms-item{text-align: center;}
.ms-item h2.post-title{font-family: 'Montserrat', sans-serif; font-size: 14px; color: #444;
line-height: 1.4em; letter-spacing: 2px; text-transform: uppercase;
}
.date{text-align: center; letter-spacing: 1px; font-size: 12px; text-transform: uppercase;
color: #aaaaaa;
}
.continue-reading{border-bottom: 1px solid #aaaaaa; text-transform: uppercase; font-size: 12px;
display: inline-block; margin-bottom: 20px;
}
.continue-reading a{color: #aaaaaa; text-decoration: none;}

.continue-reading a:hover{color: #409330; text-decoration: none; border-color: #409330}
.container{width: 900px; margin: 0 auto}
.page-title h3{font-family: 'Montserrat', sans-serif; font-size: 32px; text-transform: uppercase;}

ol.breadcrumb li{font-family: 'Montserrat', sans-serif; text-transform: uppercase;}
.pagination{text-align: center; font-family: 'Montserrat', sans-serif; display: block;}
.pagination .current{color: #000; font-weight: 600;}


</style>
<div class="main_banner innerpage-image">
  <section class="section single-wrap">
      <div class="container">
          <div class="page-title">
                    <div class="row">
                        <div class="col-sx-12 text-center">
                            <h3>Blog Heading Goes</h3>
                            <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="http://159.203.95.124/chandlersports">Home</a></li>
                                  <li class="active">Commercial Repairs</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>
<div class="catg_main">
<div class="container ">
<div class="row" id="ms-container">
     
<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()):$blog_query->the_post(); ?>

     <?php $image = $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));?>           
    <div class="ms-item col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <h2 class="post-title"><a href="<?php the_permalink(); ?>" class="post-title-link"><?php the_title(); ?></a></h2>
        <div class="date">August 22, 2016</div>
        <?php if (has_post_thumbnail()) : ?>
          
            <figure class="article-preview-image">
                
                <?php the_post_thumbnail('full'); ?>
                
            </figure>
          
        <?php else : ?>

        <?php endif; ?>
        
           
            
        <?php the_excerpt(); ?>
        
        <div class="continue-reading"><a href="#">Continue Reading</a></div>    
    <div class="clearfix"></div>
    
</div>
                
    <?php 
    endwhile; 
   
    ?>

<?php endif; ?>

</div>
</div>
</div>
<div class="pagination">

<?php
$total_pages = $blog_query->max_num_pages;

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev'),
            'next_text'    => __('next »'),
        ));
    }
?>



</div>



<div class="clearfix"></div>



    <script type="text/javascript">
        
        jQuery(window).load(function() {
      var container = document.querySelector('#ms-container');
      var msnry = new Masonry( container, {
        itemSelector: '.ms-item',
        columnWidth: '.ms-item',                
      });  
      
        });

      
    </script>

<?php get_footer(); ?>
