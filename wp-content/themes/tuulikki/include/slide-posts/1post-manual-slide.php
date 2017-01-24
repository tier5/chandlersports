<?php
if( get_field('slide_full', 'options') )
{
    echo "<div class=''>";
}
else
{
    echo "<div class='ig-container'>";

}
?>


	<div class="slick cont_big_slidepost">
		<div class="one-post-slider slider-top">

	<?php
		if(get_field('select_posts','option')):
			while(has_sub_field('select_posts','option')):
				if(class_exists('WooCommerce')) {
					$tipopost = array('post', 'product');
				} else {
					$tipopost = array('post');
				}

				$post_object = get_sub_field('select_the_posts');
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$post_per_page = -1; // -1 shows all posts
				$args=array(
					'page_id' => $post_object->ID,
					'genre' => 'mystery',
					'post_type' => $tipopost,
					'paged' => $paged,
					'posts_per_page' => $post_per_page
				);
				$temp = $wp_query;  // assign orginal query to temp variable for later use
				$wp_query = null;
				$wp_query = new WP_Query($args);

				if(have_posts()) :
					while ($wp_query->have_posts()) : $wp_query->the_post();
	?>
			<div class="big_slidepost ig-slide-margin">
							<?php
								$thumb_slide_post = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ig_image-1-post');
								$url_slide = $thumb_slide_post["0"];
							?>
							<!--	<img alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  src="<?php echo esc_url($url_slide); ?>">							
							
							
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<div class="link_slide_center"></div>
							</a>
							
							-->

							
				<div class="totalcover-1post" style="background-image:url(<?php echo esc_url($url_slide); ?>);">
			
							
							
							<div class="slidepost__desc">
								<div class="post__category slide_cat">
									<ul>
										<?php
											if (strtolower($post->post_type)=="product") {
												$categories = get_the_terms($post->ID, "product_cat");
												foreach ($categories as $category) {
													echo '<li><a href="'.esc_attr(get_term_link($category, 'cat')).'">'.$category->name.'</a></li>';
												}
											} else {
												$categories = get_the_category();
												foreach ($categories as $category) {
													echo '<li><a href="' . get_category_link($category->term_id) . '">'.$category->cat_name.'</a></li>';
												}
											}
										?>
									</ul>
								</div>
								
																<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

								
								
								<time class="slide_date">
									<?php the_time( get_option('date_format') ); ?>
								</time>

							</div><!-- .slidepost__desc-->
							
					
			</div>	<!-- total cover -->
									
							
							
							
			</div><!-- .big_slidepost-->

	<?php
					endwhile;
				else:
				endif;

				$wp_query = $temp;  //reset back to original query

				wp_reset_postdata();
			endwhile;
		endif;
	?>


		</div><!-- .slick-slider -->
	</div><!-- .slick -->

	<div class="clear"></div>

</div><!-- End ig-container -->