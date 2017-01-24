<?php if(has_post_format('gallery')) : ?>
	

<div class="slick">
	<div class="slick-slider ig_posts_slider">
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
</div><!-- .slick-->
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
	
		<div class="post-img audio ig_offset_audio_home">
			<?php $ig_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php if(wp_oembed_get( $ig_audio )) : ?>
				<?php echo wp_oembed_get($ig_audio); ?>
			<?php else : ?>
				<?php echo $ig_audio; ?>
			<?php endif; ?>
		</div>
	
	<?php else : ?>
		
		<?php if(has_post_thumbnail()) : ?>
		
				<?php if(get_theme_mod('animation_featured_img') == 'ig_img_layout1') : ?>
						<div class="post-img">
							<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb', array('class' => 'fade_h')); ?></a>
						</div>	
										
				<?php elseif(get_theme_mod('animation_featured_img') == 'ig_img_layout2') : ?>
						
								<?php $thumb_post = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumb-post');
								$url_slide = $thumb_post["0"];?>
							<div class="picc">
									<img src="<?php echo $url_slide ?>" />
									<div class="cont_hover">
									<div class="textt">
									    	<?php the_title(); ?>
									    	<div class="meta_item">
										<?php if(!get_theme_mod('ig_post_cat')) : ?>
											<span class="cat"><?php the_category(',&nbsp;'); ?></span>
										<?php endif; ?>
										</div><!-- End meta_item -->
										<?php if(get_field('number_img_post')) {
										    echo' <span class="img--post"> ' . get_field('number_img_post') . ' Photos</span>';
										}?>
									</div><!-- End textt -->
									<a class="hover_post_thumb" href="<?php echo get_permalink(); ?>"></a>
								</div><!-- End cont_hover -->
							</div><!-- End picc -->
				
				<?php else : ?>
								
						<div class="post-img">
							<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>
						</div>	
						
				<?php endif; ?>
				
		
		<?php endif; ?>
		
	<?php endif; ?>
	
	