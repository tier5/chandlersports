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
  );
$blog_query = new WP_Query($blog_args);
?>

<div class="main_banner innerpage-image">
  <section class="section single-wrap">
      <div class="container">
          <div class="page-title">
                    <div class="row">
                        <div class="col-sx-12 text-center">
                            <h3>Blog</h3>
                            <!-- <div class="bread">
                                <ol class="breadcrumb">
                                  <li><a href="http://localhost/chandlersports">Home</a></li>
                                  <li class="active">Commercial Repairs</li>
                                </ol>
                            </div> -->
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>

<div class="container">
<div class="blog-wrapper">
  <?php if($blog_query->have_posts()):?>
    <?php while($blog_query->have_posts()):$blog_query->the_post();?>
      <?php $image = $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));?>
      <div class="col-sm-4">

      <h2><?php echo get_the_title();?></h2>
      
      <div class="blog-img">
          <div class="blog-date"><?php echo get_the_date('F d, Y');?></div>
          <a href="<?php echo get_permalink();?>"><img src="<?php echo($image[0]!='')?$image[0]:get_template_directory_uri().'/images/No-Image.png';?>"></a>
      </div>
      <div class="blog-short-content">
      <?php 
      $content = get_the_excerpt(); 
      if(strlen($content)>350){
        echo wp_strip_all_tags(substr($content,0,350)).'....';
      }else{
        echo wp_strip_all_tags($content);
      }
      ?>
      </div>
      <a class="pull-left" href="<?php echo get_permalink();?>">Continue Reading</a>
      <a class="pull-right" href="<?php echo get_permalink();?>"><?php
      printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( get_comments_number() ) );
      ?></a>
      <div class="clearfix"></div>
      <hr>
      <?php echo do_shortcode('[addtoany]');?>

      </div>
<?php endwhile;?>
<div class="clearfix"></div>
<hr>
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
<?php endif;?>
</div>
</div>
</div>

<?php get_footer(); ?>
