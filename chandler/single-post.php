<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

include 'blog_header.php'; ?>
 <div class="bodypart category-page">

                 <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
                            setPostViews(get_the_ID());
                          ?>
                          <div class="entry-header">
                              <span class="date-bar-white-bg">
                                <?php $category_detail=get_the_category(get_the_ID());//$post->ID
                                    foreach($category_detail as $cd){
                                    echo $cd->cat_name;
                                    }?> / <?php the_date('F, d Y'); 
                                ?> 
                              </span>
                          </div>
                          <h1 class="cat-heading"><?php the_title(); ?></h1>
                          <p><?php the_content(); ?></p>
                          
                          <div class="tab-section">
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-user"></span> BIO</a></li>
                              <li><a data-toggle="tab" href="#menu1"><i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                               Latest post</a></li>
                              
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                   <div class="row">   
                                      <div class="col-md-1 col-sm-1">
                                          <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                                      </div> 
                                      <div class="col-md-11 col-sm-11">
                                          <h2><?php the_author(); ?></h2>
                                          <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                          </p>
                                      </div> 
                                   </div> 
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                  <div class="row"> 
                                    <div class="col-md-1 col-sm-1">
                                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                                      <!--<img src="images/logo-icon.png" alt="img">-->
                                    </div>
                                    <div class="col-md-11 col-sm-11">
                                      <h2>Latest posts by <?php the_author(); ?></h2>
                                     <p>
                                      <?php
                                      $id=get_the_author_meta('ID');
                                      $latest_post = get_posts( array(
                                              'author'      => $id,
                                              'orderby'     => 'date',
                                              'numberposts' => 3,
					      'category__not_in'=> array(421,351)
                                        ));
                                        //print_r($latest_post); 
                                        //$latest_post = $latest_post[0];

                                        foreach($latest_post as $newpost){
                                        echo "<div id='bloggers_latest_post'>
                                                      <a href='$newpost->guid'>$newpost->post_title</a>
                                              </div>";

                                      }
                                        ?>
                                     </p>
                                    </div> 
                                  </div>   
                                </div>
                                
                            </div>
                          </div>
                          <div class="follow">
                              <h6>Follow:</h6>
                              <ul>
                                   <li>
                                      <a href="https://www.instagram.com/chandler_sports/"><i class="fa fa-instagram"></i></a>
                                   </li>
                                   <li>
                                      <a href="https://www.facebook.com/chandlersports/?ref=ts"><i class="fa fa-facebook"></i></a>
                                   </li>
                                   <li>
                                      <a href="https://www.youtube.com/user/chandlersports"><i class="fa fa-youtube-play"></i></a>
                                   </li>
                                   <li>
                                      <a href="https://plus.google.com/+ChandlersportsCoUk"><i class="fa fa-google-plus"></i></a>
                                   </li>
                                   <li>
                                      <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-search"></i></a>
                                   </li>
                              </ul>  
                          </div>
                          
                          <div class="row others-blog">
                            <h3>You may also enjoy:</h3>
                          <?php
                        query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=4&cat=-402');
                        if (have_posts()) : while (have_posts()) : the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        
                         ?>
                            
                            <div class="col-sm-3">
                                                      
                                                      <a href="<?php the_permalink(); ?>">
                                                        <div class="others-blog-pic">
                                                        <img src="<?php echo $image[0];?>" alt="img">
                                                        </div>
                                                          <h4><?php the_title(); ?></h4> 
                                                      </a>  
                                                     
                                                    </div>
                        

                        <?php
                        endwhile; endif;
                        wp_reset_query();
                        ?>
                           
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                            <div class="share_ico">
                          <?php echo do_shortcode('[ssba]'); ?>
                            </div>
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-md-12">
                          <div class="page_nav_links">  
                           <div class="prev_next">
                              <div class="nav_left" style="width: 50%;float: left;">
                                  <span class="prev nav_link"> < Previous Post</span>
                                  <div class="prev_post"><?php previous_post_link('%link', '%title'); ?></div>
                              </div>
                               <div class="nav_right" style="width: 50%;float: right;text-align: right;">
                                  <span class="next nav_link">Next Post > </span>
                                  <div class="prev_post"><?php next_post_link('%link', '%title'); ?></div>
                              </div>
                          </div>
                          </div>
                          </div>
                          </div>
                          <div class="reply">
                            <?php
                          if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                  endif;
                          ?>
                          <!--<div class="col-md-12 col-sm-12">
                              <h3>Leave a Reply </h3>
                              <textarea></textarea>
                              <input class="btn submit-btn" type="submit" value="Submit">
                          </div>-->
                          </div>
                         
                        <?php endwhile; ?>  
                        </div>
                        
                        <div class="col-md-4 col-sm-4">
                          <div class="follow-us-section">
                              <h3>Follow Us</h3>
                             <div class="row"> 
                              <div class="col-md-4 col-sm-4">
                                  <a href="#">
                                    <i class="fa fa-twitter"></i>
                                    <br>
                                    <h5>Twitter</h5>
                                  </a>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                  <a href="https://www.instagram.com/chandler_sports/">
                                    <i class="fa fa-instagram"></i>
                                    <br>
                                    <h5>Instagram</h5>
                                  </a>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                  <a href="https://www.facebook.com/chandlersports/?ref=ts">
                                    <i class="fa fa-facebook"></i>
                                    <br>
                                    <h5>Facebook</h5>
                                  </a>
                              </div>
                             </div>
                             <div class="row"> 
                              <div class="col-md-4 col-sm-4">
                                  <a href="https://plus.google.com/+ChandlersportsCoUk">
                                    <i class="fa fa-google-plus"></i>
                                    <br>
                                    <h5>Google+</h5>
                                  </a>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                  <a href="https://www.youtube.com/user/chandlersports">
                                    <i class="fa fa-youtube-play"></i>
                                    <br>
                                    <h5>YouTube</h5>
                                  </a>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                  <a href="#">
                                    <i class="fa fa-envelope"></i>
                                    <br>
                                    <h5>Email</h5>
                                  </a>
                              </div>
                             </div> 
                          </div>
                          <div class="right-location">
                              <h3>Find our HQ</h3>
                              <div class="row">
                                <div class="col-md-12 col-sm-12" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);"">
                                  <div style="width: 100%"><iframe width="500" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d666.1074765366265!2d-3.2184400845228516!3d55.83647154876212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc0669f7062c813df!2sChandler+Sports!5e0!3m2!1sen!2sin!4v1490797393979" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></iframe>

                                </div>  
                              </div>
                          </div>
                          <div class="latest-youtube">
                             <h3>Latest on YouTube</h3>
                              <iframe width="560" height="315" src="https://www.youtube.com/embed/2y0IAhqtsjw" frameborder="0" allowfullscreen></iframe>
                          </div>
                          <div class="select-category">
                            <h3>Select a Category</h3>
                            <?php wp_dropdown_categories( 'show_option_none=Select category' ); ?>
                            <script type="text/javascript">
                                
                                var dropdown = document.getElementById("cat");
                                function onCatChange() {
                                    if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                                        location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
                                    }
                                }
                                dropdown.onchange = onCatChange;
                                
                            </script>
                          </div>
                          <div class="select-category">
                            <h3>Search the Archives</h3>
                            <select name=\"archive-dropdown\" onChange='document.location.href=this.options[this.selectedIndex].value;' class="form-control">
<option value=\"\"><?php echo attribute_escape(__('Select Month')); ?></option>
<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
                          </div>
                          <div class="select-category">
                            <h3>Looking for Something?</h3>
                            <input class="form-control" type="text" name="">
                          </div>  
                        </div>

                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                          <div class="subscription-section">
                              <form>
                                <div class="form-group">                                    
        <?php //echo do_shortcode('[jetpack_subscription_form subscribe_button="subscribe" show_subscribers_total="1"]');?>
                                </div>
                              </form>
                          </div>
                      </div>
                   </div>

                  <div class="row">
                      <div class="bottom-three-section">                          
                      </div>
                   </div>
                 </div>
              </div>


<br style="clear: both;" />
<?php include 'blog_footer.php'; ?>
