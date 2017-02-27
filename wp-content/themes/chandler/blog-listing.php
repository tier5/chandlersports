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

                       <!--<div class="item active">
                          <img src="<?php bloginfo('template_directory'); ?>/images/ban2.jpg" alt="Chania">
                          <div class="carousel-caption">
                             <h5>Tips and advice</h5>
                             <h3>Rowing Machine Hiring for just £15 per week!</h3>
                             <p>February 9, 2017</p>
                             <a href="#" class="read-more">View Post</a>
                          </div>
                       </div>
                       <div class="item">
                          <img src="<?php bloginfo('template_directory'); ?>/images/ban3.jpg" alt="Chania">
                          <div class="carousel-caption">
                             <h5>Tips and advice</h5>
                             <h3>York Fitness Chest Strap transmitter – Why is it important to monitor your heart rate during exercise?</h3>
                             <p>February 7, 2017</p>
                             <a href="#" class="read-more">View Post</a>
                          </div>
                       </div>
                       <div class="item">
                          <img src="<?php bloginfo('template_directory'); ?>/images/ban4.jpg" alt="Flower">
                          <div class="carousel-caption">
                             <h5>Tips and advice</h5>
                             <h3>G260 Khronos Semi Commercial Cross-trainer by BH Fitness </h3>
                             <p>December, 30 2016 by Elaine </p>
                             <a href="#" class="read-more">View Post</a>
                          </div>
                       </div>-->
                       
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
                      <div class="col-md-4 col-sm-4">
                          <div class="top-box">
                            <a href="single-categories.html">
                              <img src="<?php bloginfo('template_directory'); ?>/images/cross2.png" alt="img">
                              <div class="top-box-caption">
                                  <h2>Categories Name</h2>
                              </div>
                            </a>    
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                          <div class="top-box">
                            <a href="single-categories.html">
                              <img src="<?php bloginfo('template_directory'); ?>/images/massage.jpg" alt="img">
                              <div class="top-box-caption">
                                  <h2>Categories Name</h2>
                              </div>
                            </a>  
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                         <div class="top-box">
                            <a href="single-categories.html">
                              <img src="<?php bloginfo('template_directory'); ?>/images/treadmillworkout6.gif" alt="img">
                              <div class="top-box-caption">
                                  <h2>Categories Name</h2>
                              </div>
                            </a>  
                          </div>
                      </div>
                   </div>
                   <div class="row popular-post"> 
                      <div class="col-md-12 col-sm-12">
                          <h2>Popular Posts</h2>
                          <div class="row">
                          <div class="col-sm-3">
                              <div class="popular-post-main big-block">
                              <a href="#">
                                <img src="<?php bloginfo('template_directory'); ?>/images/slide13-zone-diet.jpg" alt="img">
                                <div class="popular-post-main-txt">
                                  <h4>Lorem ipsum</h4>
                                </div> 
                              </a>  
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="popular-post-main big-block">
                                <a href="#">
                                <img src="<?php bloginfo('template_directory'); ?>/images/jump-rope-tips4.jpg" alt="img">
                                <div class="popular-post-main-txt">
                                  <h4>Lorem ipsum</h4>
                                </div>
                                </a>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="popular-post-main big-block">
                                <a href="#">
                                <img src="<?php bloginfo('template_directory'); ?>/images/slide14-zone-diet.jpg" alt="img">
                                <div class="popular-post-main-txt">
                                  <h4>Lorem ipsum</h4>
                                </div>
                                </a>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="popular-post-main big-block">
                                <a href="#">
                                <img src="<?php bloginfo('template_directory'); ?>/images/nutrition.jpg" alt="img">
                                <div class="popular-post-main-txt">
                                  <h4>Lorem ipsum</h4>
                                </div>
                                </a>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="popular-post-main big-block">
                                <a href="#">
                                <img src="<?php bloginfo('template_directory'); ?>/images/slide16-zone-diet.jpg" alt="img">
                                <div class="popular-post-main-txt">
                                  <h4>Lorem ipsum</h4>
                                </div>
                                </a>
                              </div>
                            </div>
                          </div> 
                          <div class="row three-block">
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                  <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/pic.jpg" alt="img">
                                  </a>  
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                  <div class="pipdig_geo_tag">
                                    <span>Success Stories</span>
                                  </div>
                                  <a href="#">
                                  <h2>Heading goes here</h2>
                                  </a>
                                  <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                    <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                    </div>
                                  </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                    <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/scottish-veterans.png" alt="img">
                                    </a>
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Tips and Advice</span>
                                </div>
                                  <a href="#">
                                  <h2>Heading goes here</h2> 
                                  </a> 
                                  <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                  <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                    <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/Kettlebell-Information.jpg" alt="img">
                                    </a>
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Guest Blogs</span>
                                </div>
                                <a href="#">
                                  <h2>Heading goes here</h2> 
                                </a>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                  <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                  </div>  
                              </div>
                          
                          </div> 
                          <div class="row three-block">   
                           <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                  <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/pic.jpg" alt="img">
                                  </a>  
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Success Stories</span>
                                </div>
                                <a href="#">
                                  <h2>Heading goes here</h2>
                                </a>
                                  <p>
                                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                    <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                    </div>
                          </div> 

                            

                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                    <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/scottish-veterans.png" alt="img">
                                    </a>
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Tips and Advice</span>
                                </div>
                                  <a href="#">
                                  <h2>Heading goes here</h2> 
                                  </a> 
                                  <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                  <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                    <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/Kettlebell-Information.jpg" alt="img">
                                    </a>
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Guest Blogs</span>
                                </div>
                                <a href="#">
                                  <h2>Heading goes here</h2> 
                                </a>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                  <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                  </div>  
                              </div> 
                            </div>
                            <div class="row three-block">  
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                  <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/pic.jpg" alt="img">
                                  </a>  
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Success Stories</span>
                                </div>
                                  <a href="#">
                                  <h2>Heading goes here</h2>
                                  </a>
                                  <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                    <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                    </div>
                                  </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                    <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/scottish-veterans.png" alt="img">
                                    </a>
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Tips and Advice</span>
                                </div>
                                  <a href="#">
                                  <h2>Heading goes here</h2> 
                                  </a> 
                                  <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                  <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                  </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="popular-post-main big-block">
                                    <a href="#">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/Kettlebell-Information.jpg" alt="img">
                                    </a>
                                    <span class="date-tag">February 14, 2017</span>
                                </div>
                                <div class="pipdig_geo_tag">
                                    <span>Guest Blogs</span>
                                </div>
                                <a href="#">
                                  <h2>Heading goes here</h2> 
                                </a>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                  </p>
                                  <div class="listing-comments"><a href="#"> <i class="fa fa-comments"></i> 0 Comments</a>
                                  </div>  
                              </div>  
                            </div>
                      </div>  
                   </div>
                   <div class="row">
                     <div class="col-md-12 col-sm-12">
                       <div class="pagination">
                          <ul>
                             <li><a class="active-pagination" href="#">1</a></li> 
                             <li><a href="#">2</a></li> 
                             <li><a href="#">3</a></li> 
                             <li><a href="#">4</a></li> 
                             <li><a href="#">5</a></li> 
                             <li><a href="#">6</a></li>
                             <li><a href="#">...</a></li> 
                             <li><a href="#">older post <i class="fa fa-chevron-right"></i></a></li> 
                          </ul>  
                       </div> 
                     </div>  
                   </div>
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
                              <select class="form-control">
                                  <option>Select Category</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                              </select>
                          </div>
                          <div class="col-md-4 col-sm-4 bottom-three-single">
                              <h3>SEARCH THE ARCHIVES</h3>
                              <select class="form-control">
                                  <option>Select Category</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                              </select>
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
