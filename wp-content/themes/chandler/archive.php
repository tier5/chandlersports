<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

include 'blog_header.php'; ?>


<h1 class="page-title">
<?php if ( is_day() ) : ?>
				<?php //printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : 
$year = get_the_time('Y');
$month = get_the_time('m');
?>
				<?php //printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyten' ) ) ); ?>
<?php elseif ( is_year() ) : ?>
				<?php //printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyten' ) ) ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'twentyten' ); ?>
<?php endif; ?>
			</h1>




<?php
//$the_query = new WP_Query( 'monthnum=$month&year=$year' );
//query_posts("year=$year&monthnum=$month");
//print_r($the_query);
// The Loop
//if(have_posts()) : while(have_posts()) : the_post();
	//echo '<li>' . get_the_title() . '</li>';
	//echo '<li>' . the_date() . '</li>';
//endwhile; endif; wp_reset_query(); 
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	//rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archive.php and that will be used instead.
	 */
	 //get_template_part( 'loop', 'archive' );
?>
<div class="bodypart">
                 <div class="container-fluid">
                  
                   <div class="row popular-post"> 
                      <div class="col-md-12 col-sm-12">
                          <h1 class="cat-heading"></h1>
              <?php 
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  query_posts("year=$year&monthnum=$month&posts_per_page=9&paged=$paged"); ?>
						  	<?php if(have_posts()) :
						  		  $i=1;
						  	?>
						  	<div class="row three-block">
							<?php while(have_posts()) : the_post();
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
						<?php 
							$i++;
						endwhile; else: ?>
							<p>Sorry, no posts matched your criteria.</p>
							<?php endif; ?>
                           
                      </div>  
                   </div>
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
                          </div>
                          <div class="col-md-4 col-sm-4 bottom-three-single">
                              <h3>SEARCH THE ARCHIVES</h3>
                              <select name=\"archive-dropdown\" onChange='document.location.href=this.options[this.selectedIndex].value;' class="form-control">
<option value=\"\"><?php echo attribute_escape(__('Select Month')); ?></option>
<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
                          </div>
                          <div class="col-md-4 col-sm-4 bottom-three-single">
                              <h3>FOLLOW US</h3>
                              <div class="bottom-social-media">
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
                          </div>  

                      </div>
                   </div> 
                 </div>
              </div>
              </div>
			
<?php include 'blog_footer.php'; ?>
