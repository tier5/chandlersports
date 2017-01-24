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
		<div class="big-post-slider slider-top">

		<?php

		$postxpage=get_field('number_post', 'options');
		$categories=get_field('categorys_post', 'options');

		$wp_query = new WP_Query( array(
				'posts_per_page' => $postxpage,
				'cat' =>  implode(",",$categories)
			));

		if (have_posts()):
			while ($wp_query->have_posts()) : $wp_query->the_post();
		?>

		
			<div class="big_slidepost ig-slide-margin">
							<?php
								$thumb_slide_post = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ig_image-3-post');
								$url_slide = $thumb_slide_post["0"];
							?>
						<!--	<img alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  src="<?php echo esc_url($url_slide); ?>">							
							
							
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<div class="link_slide_center"></div>
							</a>
							
							-->

							
				<div class="totalcover-3postcentral" style="background-image:url(<?php echo esc_url($url_slide); ?>);">
			
							
							
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




                    <?php endwhile; ?>
              <?php else : ?>

               <?php endif;  ?>

 <?php // Ripristina Query & Post Data originali
wp_reset_query();
wp_reset_postdata();
?>



	</div><!-- .slick-slider -->
</div><!-- .slick -->
<div class="clear"></div>
</div><!-- End ig-container -->