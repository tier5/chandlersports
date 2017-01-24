<?php
/*
Template Name: Page About Me 2
*/
?>
<?php get_header(); ?>


<div class="ig_wrapper">
	<div class="main_content">
		
	
		<div class='title_page textaligncenter'>
			<h1><?php the_title(); ?></h1>
		</div>
	

		
		<div class="post_container_single">
					
			<img class="about_img" src="<?php the_field('author_image'); ?>">
			
			
	<div class="textaligncenter">
			<?php
				echo "<ul class='meta-share '>";
						if(get_field('facebook_url')) {
				echo "	<li>";
				echo "		<a target='_blank' href='" . get_field('facebook_url') . "'><i class='fa fa-facebook'></i> facebook</a>";
				echo "	</li>";
						}
							
						if(get_field('twitter_url')) {
				echo "	<li>";
				echo "		<a target='_blank' href='" . get_field('twitter_url') . "'><i class='fa fa-twitter'></i> twitter</a>";
				echo "	</li>";
						}
							
						if(get_field('pinterest_url')) {
				echo "	<li>";
				echo "		<a target='_blank' href='" . get_field('pinterest_url') . "'><i class='fa fa-pinterest'></i> pinterest</a>";
				echo "	</li>";
						}
							
						if(get_field('instagram_url')) {
				echo "	<li>";
				echo "		<a target='_blank' href='" . get_field('instagram_url') . "'><i class='fa fa-instagram'></i> instagram</a>";
				echo "	</li>";
						}
				echo "</ul>";

			?>
		</div><!--  .textaligncenter -->   
			
			
				  		
			<?php
				if(get_field('about_intro')) {
				echo "<div class='story-intro'>";
				echo "	<p>";
							echo get_field('about_intro');
				echo "	</p>";
				echo "</div>";
				   }
			?>
			
			<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>
				<?php the_content();?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'ilgelo').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			
		</div><!--  .post_container_single -->   


	

         <?php comments_template('', true); ?>





   
	</div><!--  .main_content -->   
</div><!--  .ig_wrapper -->
<?php get_footer(); ?>