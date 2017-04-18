<?php
/**
* Template Name: Blog About
*/

include 'blog_header.php'; ?>
<style>
label {
    width: 100%;
}</style>
 <div class="bodypart category-page">

                 <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                          <div class="row"> 
                              <div class="col-md-12 col-sm-12">
                          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
                          ?>
                          <h1 class="cat-heading"><?php the_title(); ?></h1>
                          <p><?php the_content(); ?></p>
                        </div></div>
                          <div class="reply">
                            <?php
                          if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                  endif;
                          ?>
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
                             </div> 
                          </div>
                          <div class="right-location">
                              <h3>Find our HQ</h3>
                              <div class="row">
                                <div class="col-md-12 col-sm-12" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
                                  <div style="width: 100%"><iframe width="600" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d666.1074765366265!2d-3.2184400845228516!3d55.83647154876212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc0669f7062c813df!2sChandler+Sports!5e0!3m2!1sen!2sin!4v1490797393979" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

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
                    <div class="">
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
                      </div>
                   </div>
                 </div>
              </div>
            </div>


<br style="clear: both;" />
<?php include 'blog_footer.php'; ?>
