<footer>
                  <div class="footer-top">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="#"><i class="fa fa-twitter"></i> Twitter<span class="social-footer-counters"> | 4928</span></a>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="#"><i class="fa fa-facebook"></i> Facebook<span class="social-footer-counters"> |
                                  	 <?php
										function dez_get_the_fb_like( $fb_pagename = '' ) {
										$fburl = 'https://www.facebook.com/'. $fb_pagename;
										$params = 'select like_count from link_stat where url = "'.$fburl.'"';
										$component = urlencode( $params );
										$urls = 'http://graph.facebook.com/fql?q='.$component;
										$string = file_get_contents( $urls );
										if( $string ) {
										 $fbLIkeAndSahre = json_decode( $string );
										 $getFbStatus = $fbLIkeAndSahre->data['0'];
										 $likecount = $getFbStatus->like_count;
										 return $likecount;
										} else {
										 return 'Data did not exist';
										}
										}
										?>
										<?php
echo dez_get_the_fb_like( $fb_pagename = 'https://www.facebook.com/chandlersports/' );
?>
								 7589</span></a>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="https://www.instagram.com/chandler_sports/"><i class="fa fa-instagram"></i> Instagram<span class="social-footer-counters"> |<?php $url = 'https://api.instagram.com/v1/users/3516394587?access_token=3516394587.1677ed0.1bdfb14613ac44928d0873a766f2c144';
$api_response = file_get_contents($url);
$record = json_decode($api_response);
echo $followed_by = $record->data->counts->followed_by;?></span></a>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <a rel="nofollow" target="_blank" href="#"><i class="fa fa-youtube-play"></i> YouTube<span class="social-footer-counters"> | 991</span></a>
                              </div>
                          </div>
                      </div>  
                  </div>
                  <div class="instagram-footer">
                     <ul> 
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
                     
                     </ul> 
                  </div>
                  <div class="copy-right-area">
                      <div class="container-fluid">
                          <div class="col-md-6 col-sm-6">
                             © 2017 <a href="#">Fitness Superstore Blog</a>
                          </div>
                          <div class="col-md-6 col-sm-6 align-right">
                              WordPress Design by
                          </div>
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
