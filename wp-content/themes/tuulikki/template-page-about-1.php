<?php
/* 
Template Name: Page About Me 1
*/
?>
<?php get_header(); ?>


<div class="ig_wrapper">
	<div class="main_content">
		
			
		<div class="post_container_single">
			<div class="box-left">		
				<img class="about_img" src="<?php the_field('author_image'); ?>">
			</div><!-- end box-left -->
			
			
			
			<div class="box-right">		
							
				<div class='title_page textalignleft'>
					<h1><?php the_title(); ?></h1>
				</div>
			
			<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>
				<?php the_content();?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'ilgelo').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php endwhile; ?>
			<?php endif; ?>
				<div class="textalignleft">
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
			

			
			
			
			
			
			
			
			
			
			
			
		</div><!--  .post_container_single -->   


			</div><!-- end box-right -->

	         <div class="clear"></div>



         <?php comments_template('', true); ?>


   
	</div><!--  .main_content -->   
</div><!--  .ig_wrapper -->
<?php get_footer(); ?>