<?php if(has_post_format('gallery')) : ?>


	<div class="ig_posts_slider">
		<?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
		<?php if($images) : ?>
		
			<?php foreach($images as $image) : ?>
			<?php $the_image = wp_get_attachment_image_src( $image, 'ig_image-slide-post' ); ?> 
			<?php $the_caption = get_post_field('post_excerpt', $image); ?>
			<img src="<?php echo esc_url($the_image[0]); ?>" <?php if($the_caption) : ?>title="<?php echo $the_caption; ?>"<?php endif; ?> />
			<?php endforeach; ?>
	</div><!-- .ig_posts_slider-->

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
		
		<?php if(has_post_thumbnail()) : ?>
				<div class="post-img textaligncenter fadeInUp wow animated">
					<?php the_post_thumbnail('full-thumb'); ?>
				</div>					
		<?php endif; ?>
		
	<?php endif; ?>
