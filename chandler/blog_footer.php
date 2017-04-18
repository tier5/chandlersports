<footer><div class="new-footer">
                      <div class="container">
                          <div class="col-md-4 col-sm-4">
                              <div class="footer-logo">
                                <a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="" src="<?php echo site_url();?>/wp-content/themes/chandler/images/logo-test-final-1.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
                                <?php if ( get_theme_mod( 'Client_logo' ) ) : ?>
                                <!--<a class="" href="<?php //echo esc_url( home_url( '/' ) ); ?>" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="" src="<?php //echo get_theme_mod( 'Client_logo' ); ?>" alt="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>-->

                              <?php else : ?>

                                <!--<div class="site-introduction">
                                  <h1 class="site-title"><a href="<?php //echo home_url( '/' ); ?>" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a></h1>
                                  <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                                </div>-->
                              <?php endif; ?>
                              </div>
                              <p class="align-center">
                               <?php dynamic_sidebar( 'blog_bottom1' ); ?>
                              </p>
                          </div>
                          <div class="col-md-4 col-sm-4">
                              <div class="tit_widget"><span>LATEST POSTS</span>
                              </div> 
                              <ul class="ig_recent_posts">
                                 <?php
                        query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=3&cat=-428');
                        if (have_posts()) : while (have_posts()) : the_post();
                        $image_footer = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        
                         ?>
                                <li>
                                      <figure> <a href="<?php echo get_permalink();?>" class="ig_bg_images">
                                       <img width="90" height="60" src="<?php echo $image_footer[0];?>" scale="0"></a>
                                       </figure>
                                       <div class="ig_recent_post_details">
                                        <a title="Decadent flowers" href="<?php echo get_permalink();?>" class="ig_recent_post_title"><?php the_title(); ?>
                                        </a> 
                                        <span><?php the_date();?></span>
                                       </div>
                                  </li>
                      <?php endwhile; endif;
                        wp_reset_query();?> 
                              </ul> 
                          </div>
                          <div class="col-md-4 col-sm-4">
                              <div class="tit_widget"><span>Workout Video</span>
                              </div>
                              <iframe width="400" height="230" src="https://www.youtube.com/embed/IpOB2bwLXkc"></iframe>    
                          </div>

                      </div>  
                  </div>  
                  <div class="footer-top">
                      <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-12 col-sm-12" style="text-align:center;">
                                <a href="https://www.instagram.com/chandler_sports/">FOLLOW US ON INSTAGRAM</a>
                            </div>
                             <!--<div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="#"><i class="fa fa-twitter"></i> Twitter<span class="social-footer-counters"> | 4928</span></a>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="#"><i class="fa fa-facebook"></i> Facebook<span class="social-footer-counters"> |
                                  	 <?php
										function fb_count($value='') 
                          { 
                             if($value){
                               $url='http://api.facebook.com/method/fql.query?query=SELECT fan_count FROM page WHERE';
                               if(is_numeric($value)) { $qry=' page_id="'.$value.'"';} //If value is a page ID
                               else {$qry=' username="'.$value.'"';} //If value is not a ID. 
                               $xml = @simplexml_load_file($url.$qry) or die ("invalid operation");
                               $fb_count = $xml->page->fan_count;
                               return $fb_count;
                            }else{
                              return '0';
                            }
                          }
										?>
										<?php echo fb_count( $value = '465752946790356' );?>
								 7589</span></a>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="https://www.instagram.com/chandler_sports/"><i class="fa fa-instagram"></i> Instagram<span class="social-footer-counters"> |<?php $url = 'https://api.instagram.com/v1/users/3516394587?access_token=3516394587.1677ed0.1bdfb14613ac44928d0873a766f2c144';
$api_response = file_get_contents($url);
$record = json_decode($api_response);
echo $followed_by = $record->data->counts->followed_by;?></span></a>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="#"><i class="fa fa-youtube-play"></i> YouTube<span class="social-footer-counters"> |<?php $params = array('sslverify' => false,'timeout' => 60);
                                    $yt_data = wp_remote_get('https://www.googleapis.com/youtube/v3/channels?part=statistics&id=YOUR_CHANNEL_ID&key=YOUR_API_KEY', $params);
                                    if (is_wp_error($yt_data) || '400' <= $yt_data['response']['code'] ) {
                                      echo 'Something went wrong';
                                    } 
                                    else {
                                      $response = json_decode( $yt_data['body'], true );
                                     echo $count = intval($response['items'][0]['statistics']['subscriberCount']);
                                    }?></span></a>
                              </div>-->
                          </div>
                      </div>  
                  </div>
                  <div class="instagram-footer">
                    <ul id="rudr_instafeed"></ul>
                    <script>
                    
                      var token = '3516394587.1677ed0.1bdfb14613ac44928d0873a766f2c144', // learn how to var token = '1362124742.3ad74ca.6df307b8ac184c2d830f6bd7c2ac5644',
                        num_photos = 6;
                     
                    jQuery.ajax({
                        url: 'https://api.instagram.com/v1/users/self/media/recent',
                        dataType: 'jsonp',
                        type: 'GET',
                        data: {access_token: token, count: num_photos},
                        success: function(data){
                            console.log(data);
                            for( x in data.data ){
          jQuery('#rudr_instafeed').append('<li><a href="'+data.data[x].link+'"><img src="'+data.data[x].images.low_resolution.url+'"></a><span class="instagram-likes"><i class="fa fa-comment">'+data.data[x].comments.count+'</i><i class="fa fa-heart"></i>'+data.data[x].likes.count+'</span></li>');
                            }
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                    </script>
                    
                     <!--<ul> 
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide13-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide14-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide16-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/treadmill-2.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide13-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide14-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide16-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/treadmill-2.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide13-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide14-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/slide16-zone-diet.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                        <li>
                          <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/treadmill-2.jpg" alt="img"></a>
                          <span class="instagram-likes">
                              <i class="fa fa-comment"></i> 1  
                              <i class="fa fa-heart"></i> 13
                          </span>
                        </li>
                     
                     </ul>--> 
                  </div>
                  <div class="copy-right-area">
                      <div class="container-fluid">
                          <div class="col-md-12 col-sm-12">
                             © 2017 <a href="#">Chandlersports Blog</a>
                          </div>
                          <!--<div class="col-md-6 col-sm-6 align-right">
                              
                          </div>-->
                      </div>  
                  </div>
              </footer>
          </div>
          <div id="sidebar-wrapper">
              <div class="main">
                <h2>Looking for Something?</h2>
                <div class="search-box">
                  <h6><i class="fa fa-search"></i> Search:</h6>
                  <form>
                    <div class="form-group">
                        <input type="text" name="">
                    </div>
                  </form>
                </div>
                <h5>Post Categories:</h5> 
                
                    <ul>
                    	<?php $categories = get_terms( 'category', array(
                          'orderby'    => 'count',
                          'hide_empty' => 1,
                          'exclude'    => array(428,351),
                          
                      ) );
                      
                       foreach ( $categories as $term ) {
                        ?>
                        
                         <li>
                            <a href="<?php echo get_term_link($term->term_id, 'category'); ?>">
                                  <?php echo $term->name; ?>
                            </a>    
                         </li>
                      
                       <?php }
                       
                  ?>
                    </ul>  
              </div>
          </div>
      </div>

      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>-->
      <script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>

     <script>
    jQuery("#menu-toggle").click(function(e) {
      //alert('heee');
        e.preventDefault();
        jQuery("#wrapper").toggleClass("toggled");
    });
    </script>


      <script type="text/javascript">
         jQuery('.carousel').carousel({
         interval: 5000
         })
      </script>
<?php wp_footer(); ?>
   </body>
</html>
