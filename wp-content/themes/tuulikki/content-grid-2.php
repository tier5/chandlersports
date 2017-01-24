<li class="cont_masonry_2 isotopeItem_masonry">
	
<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
	
	
	<div class="post-header textaligncenter">
		
		
		
		<?php if(is_single()) : ?>
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
			<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
		
		
				
		<div class="meta_item">
			<?php if(!get_theme_mod('ig_meta_post_date')) : ?>
			<span class="date"><?php the_time( get_option('date_format') ); ?></span>
			<?php endif; ?>
		</div><!-- End meta_item -->

		
		
	</div><!-- End post-header -->
	



	<?php if(has_post_thumbnail()) : ?>
	<div class="post-img">
		<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('grid_column'); ?></a>
	</div>
	<?php endif; ?>
	
	
	
	
	
		
	<div class="post_container_grid">
						
	<?php if ( ! has_excerpt() ) {
		echo mvc_content_limit($post->post_content,25);
		} else { 
	     the_excerpt();
		}
	?>								
	</div>
	
	
	
	
	
		<div class="grid_read-more">

			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="read-more grid"><?php _e( 'Continue Reading' ,'ilgelo' ) ?></a>

		</div>

	
	
	
	
	
	
	
		
</article>
</li>