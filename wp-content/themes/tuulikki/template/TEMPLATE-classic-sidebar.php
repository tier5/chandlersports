<?php
/*
Template Name: Blog Classic + Sidebar
*/
?>
<?php get_header(); ?>

	<?php
	$slideinclude="";

	if(class_exists('acf') && get_field('activate_post_slider','options')) {
		echo "<div id='home-postgallery'></div>";
	}
	
	 if(class_exists('acf') && get_field('activate_promotional_box')) {
		include(TEMPLATEPATH."/include/promotional-box.php");
   }
?>

<?php if(class_exists('acf') && get_field('activate_post_slider','options')) { ?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery.ajax({
			url: "<?php echo site_url()?>/wp-admin/admin-ajax.php",
			type:"POST",
			data: "action=ilgelo_postgallery",
			success: function(html){
				if (html.trim()!="") {
					var el = jQuery(html);
					el.imagesLoaded(function () {
						jQuery('#home-postgallery').html(el);
						homePostgalleryInit();
					});
				}
			}
		});
	});
</script>

<?php } ?>


<div class="ig_wrapper">
	<div class="main_content">
		<div class="main_content__r">

				<?php
					$paged = ilgelo_getpage();
					query_posts('&paged='.$paged."&showposts=".get_option('posts_per_page'));
				?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php get_template_part('content', 'content'); ?>

					<?php endwhile; ?>

				<?php endif; ?>

				<div class="clear"></div>

					<?php
						ilgelo_pagination($wp_query->max_num_pages,"",$paged);
					?>

		</div><!--  .main_content__full - .main_content__r -->
	</div><!--  .main_content -->

	
	<aside class="cont_sidebar sticky_sider">
          <?php get_sidebar( $name ); ?>
	</aside><!--  .cont_sidebar -->


</div><!--  .ig_wrapper -->



<?php get_footer(); ?>