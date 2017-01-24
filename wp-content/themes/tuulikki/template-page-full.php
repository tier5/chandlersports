<?php
/*
Template Name: Page Full
*/
?>
<?php get_header(); ?>


		<?php if(get_field('image_header_page')) {
			echo " <div class='img_header_page' style='background-image: url(" . get_field('image_header_page') . ");'>";
			echo "</div>";
			}
		?>
		
			
	
<?php if(class_exists('acf') && get_field('activate_promotional_box')) {
		include(TEMPLATEPATH."/include/promotional-box.php");
   }
?>



			<?php if(get_field('visible_title')) {
				echo "<div class='title_page textaligncenter'>";
					if(is_front_page()) {
										
						echo "		<h1>	";
									the_title();
						echo "		</h1>";
			
					} else {
			
						echo "		<h2>	";
									the_title();
						echo "		</h2>";

					} 
					echo "</div>";
			}?>

			<?php if(get_field('page_subtitle')) {
				echo "<div class='subtitle_page textaligncenter'>";
				echo "	<h3>" . get_field('page_subtitle') . "</h3>";
				echo "</div>";
			}
			?>
			
			<div class="container">
				<div class="main_content">
					<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>
					    <?php the_content();?>
					    
					    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'ilgelo').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					    
					  <?php endwhile; ?>
					<?php endif; ?>
					
					<?php comments_template('', true); ?>
				</div><!--  .main_content -->
			</div><!-- .container -->
	
	
	
	
	         <div class="clear"></div>

</div><!--  .ig_wrapper -->
<?php get_footer(); ?>