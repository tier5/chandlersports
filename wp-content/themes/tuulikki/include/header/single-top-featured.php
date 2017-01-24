<?php if(has_post_format('gallery')) : ?>




		<div class="big-post-slider">
			
					<?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
		<?php if($images) : ?>
		
			<?php foreach($images as $image) : ?>
			
			<div class="grid_slidepost">
			<?php $the_image = wp_get_attachment_image_src( $image, 'ig_image-slide-post' ); ?> 
			<?php $the_caption = get_post_field('post_excerpt', $image); ?>
			<img src="<?php echo esc_url($the_image[0]); ?>" <?php if($the_caption) : ?>title="<?php echo $the_caption; ?>"<?php endif; ?> />
			</div><!-- .grid_slidepost-->
			
			
			<?php endforeach; ?>
			
			
	</div><!-- .slick-slider-->



		<?php endif; ?>
	
	<?php elseif(has_post_format('video')) : ?>
	
		<div class="post-img">
			<?php $ig_video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
			<?php if(wp_oembed_get( $ig_video )) : ?>
				<?php echo wp_oembed_get($ig_video); ?>
			<?php else : ?>
				<?php echo $ig_video; ?>
			<?php endif; ?>
		</div>
	
	<?php elseif(has_post_format('audio')) : ?>
	
		<div class="post-img audio audio_container
				<?php if(is_single()) : ?>
					ig_offset
				<?php endif; ?>">
			
			<?php $ig_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php if(wp_oembed_get( $ig_audio )) : ?>
				<?php echo wp_oembed_get($ig_audio); ?>
			<?php else : ?>
				<?php echo $ig_audio; ?>
			<?php endif; ?>
		</div>
	
	<?php else : ?>
	
			
<?php $thumb_slide_post = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumb-post');
			$url_slide = $thumb_slide_post["0"];?>
	
		
	<div class="featured-promo-box" style="background-image:url(<?php echo $url_slide ?>)">
		
			
			<div class="featured-overlayBox">
				<div class="featured-promobox__desc">
							<?php if(!get_theme_mod('ig_meta_post_cat')) : ?>
								<div class="featured_cat">
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
							<?php endif; ?>


							<h3><?php the_title(); ?></h3>
															
							
							<div class="post-header">
								<div class="meta_item">
									<ul>
										<?php if(!get_theme_mod('ig_meta_post_author')) : ?>
										<li>
											<span class="author"><?php the_author(); ?></span>
										</li>
										<?php endif; ?>
										
										<?php if(!get_theme_mod('ig_meta_post_date')) : ?>
										<li>
											<span class="date"><?php the_time( get_option('date_format') ); ?></span>
										</li>
										<?php endif; ?>
								
										<?php if(!get_theme_mod('ig_post_comment_link')) : ?>
										<li>
											<?php if( comments_open( $post->ID ) ) { ?>
												<?php comments_popup_link( __("0 Comments", "ilgelo"), __("1 Comments", "ilgelo"),__("% Comments","ilgelo")); ?>
												<?php } ?>
										</li>		
										<?php endif; ?>
									</ul>
								</div><!-- End meta_item -->
							</div><!-- End post-header -->


				</div><!-- .featured-promobox__desc-->
			</div><!-- End featured-overlayBox -->
	</div>
		

		
<?php endif; ?>