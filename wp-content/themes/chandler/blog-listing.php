<?php
/**
* Template Name: Blog Listing
*/
 include 'blog_header.php';
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
 <div class="slider">
                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                       <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                       <li data-target="#myCarousel" data-slide-to="1"></li>
                       <li data-target="#myCarousel" data-slide-to="2"></li>
                       <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                       <?php
                        $args = array( 'posts_per_page' => 5, 'category' => 402 );
                        $count = 0;
                        $myposts = get_posts( $args );
                        foreach ( $myposts as $post ) : setup_postdata( $post ); 
                        $count++;?>
                       <div class='item <?php if($count == 1){echo 'active';}?>'> 
                          <img src="<?php the_post_thumbnail_url( 'full' );?>" alt="Chania">
                          <div class="carousel-caption">
                             <h5>Tips and advice</h5>
                             <h3><?php the_title(); ?></h3>
                             <p><?php the_date(); ?></p>
                             <a href="<?php echo get_permalink();?>" class="read-more">View Post</a>
                          </div>
                       </div>
                        <?php endforeach; 
                        wp_reset_postdata();?>   
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="left-icon" aria-hidden="true">
                    <img src="<?php bloginfo('template_directory'); ?>/images/left-arrow.png" alt="left">
                    </span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="left-icon" aria-hidden="true">
                    <img src="<?php bloginfo('template_directory'); ?>/images/rht-arrow.png" alt="right">
                    </span>
                    <span class="sr-only">Next</span>
                    </a>
                 </div>
              </div>
              <div class="bodypart">
                 <div class="container-fluid">
                   <div class="row"> 
                    <?php $categories = get_terms( 'category', array(
                          'orderby'    => 'count',
                          'hide_empty' => 1,
                          'number'=> 3
                      ) );
                      
                       foreach ( $categories as $term ) {
                        ?>
                        <div class="col-md-4 col-sm-4">
                          <div class="top-box">
                            <a href="<?php echo get_term_link($term->term_id, 'category'); ?>">
                              <img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($term->term_id); ?>" alt="img">
                              <div class="top-box-caption">
                                  <h2><?php echo $term->name; ?></h2>
                              </div>
                            </a>    
                          </div>
                      </div>
                       <?php }
                       
                  ?>
                   </div>
                   <div class="row popular-post"> 
                      <div class="col-md-12 col-sm-12">
                          <h2>Popular Posts</h2>
                          <div class="row">
                            <?php
                        query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=5&cat=-402');
                        if (have_posts()) : while (have_posts()) : the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        
                         ?>
                            
                            <div class="col-sm-3">
                                                      <div class="popular-post-main big-block">
                                                      <a href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo $image[0];?>" alt="img">
                                                        <div class="popular-post-main-txt">
                                                          <h4><?php the_title(); ?></h4>
                                                        </div> 
                                                      </a>  
                                                      </div>
                                                    </div>
                        <?php
                        endwhile; endif;
                        wp_reset_query();
                        ?>
                          
                          </div>
                          <?php 

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $custom_args = array(
      'post_type' => 'post',
      'posts_per_page' => 9,
      'category__not_in'=> array(402,351), 
      'paged' => $paged
    );

  $custom_query = new WP_Query( $custom_args ); ?>

  <?php if ( $custom_query->have_posts() ) : 
      $i=1;
  ?>
    <div class="row three-block">
    <!-- the loop -->
    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); 
      $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );

    ?>
    
    <div class="col-md-4 col-sm-4">
        <div class="popular-post-main big-block">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url( 'full' );?>" alt="img">
          </a>  
            <span class="date-tag"><?php the_date(); ?></span>
        </div>
        <div class="pipdig_geo_tag">
              <span><?php $category_detail=get_the_category(get_the_ID());//$post->ID
          foreach($category_detail as $cd){
          echo $cd->cat_name;
          }?></span>
        </div>
              <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
              </a>
              <p><?php the_excerpt(); ?></p>
          <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> <a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '% comments already!'); ?></a> Comments</a></div>
    </div>
<?php if( $i % 3==0 ) : ?> 
      </div>
      <!-- row -->
      <div class="row three-block">
           
      <?php endif; ?>        
      <!--<article class="loop">
        <h3><?php the_title(); ?></h3>
        <div class="content">
          <?php the_excerpt(); ?>
        </div>
      </article>-->
    <?php 
    $i++;
    endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->
    </div> </div> </div> 
    <div class="row">
                     <div class="col-md-12 col-sm-12">
                       <div class="pagination">
                        <?php
      if (function_exists(custom_pagination)) {
        custom_pagination($custom_query->max_num_pages,"",$paged);
      }
    ?>
                          
                       </div> 
                     </div>  
                   </div>
    

  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?> 
                         
                   
                   <div class="row">
                      <div class="col-md-12 col-sm-12">
                          <div class="subscription-section">
                              <form>
                                <div class="form-group">
                                    <label>Enter your email address to subscribe to our blog & receive notifications of new posts by email!</label>
                                    <input class="form-control" type="email" name="" placeholder="Email Address">
                                    <input type="submit" value="subscribe">
                                </div>
                              </form>
                          </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="bottom-three-section">
                          <div class="col-md-4 col-sm-4 bottom-three-single">
                              <h3>SELECT A CATEGORY</h3>
                                <?php wp_dropdown_categories( 'show_option_none=Select category' ); ?>
                            <script type="text/javascript">
                                <!--
                                var dropdown = document.getElementById("cat");
                                function onCatChange() {
                                    if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                                        location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
                                    }
                                }
                                dropdown.onchange = onCatChange;
                                -->
                            </script>
                              <!--<select  name="cat" id="cat" class="form-control">
                                <option value="-1">Select Category</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                              </select>-->
                          </div>
                        
                          <div class="col-md-4 col-sm-4 bottom-three-single">
                              <h3>SEARCH THE ARCHIVES</h3>
                              <select name=\"archive-dropdown\" onChange='document.location.href=this.options[this.selectedIndex].value;' class="form-control">
<option value=\"\"><?php echo attribute_escape(__('Select Month')); ?></option>
<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
                              <!--<select class="form-control">
                                  <option>Select Category</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                              </select>-->
                          </div>
                          <div class="col-md-4 col-sm-4 bottom-three-single">
                              <h3>FOLLOW US</h3>
                              <div class="bottom-social-media">
                                  <ul>
                                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                      <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                      <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                  </ul>  
                              </div>
                          </div>  

                      </div>
                   </div> 
                 </div>
              </div>

<?php include 'blog_footer.php'; ?>
