<?php
/**
 * Template Name: Hire
 */

get_header(); ?>

	<div id="page">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			
			<?php the_content(); ?>
			
			<p><strong>Product:</strong> <?php echo $_POST['proname']; ?><br />
			<strong>Price:</strong> <?php echo $_POST['proprice']; ?> per week</p>
			
			<?php echo do_shortcode('[gravityform id="4" name="Hire Enquiry" title="false" description="false" ajax="true" field_values="proname='.$_POST['proname'].'&proprice='.$_POST['proprice'].'"]'); ?>
		<?php endwhile; ?>
	</div>
	
	<div id="pageside">
	
		<div class="side_icons">
			<a href="#"><img src="/wp-content/themes/chandler/images/fb-btn.png" border="0" /></a> 
			<a href="#"><img src="/wp-content/themes/chandler/images/twitter-btn.png" border="0" /></a> 
			<a href="#"><img src="/wp-content/themes/chandler/images/gplusbtn.png" border="0" /></a>
		</div>
	
		<?php 
			if($post->ID == 15 || $post->post_parent == 15 || in_array($post->ID, array(1294,1104))):
				wp_nav_menu(array('menu' => 70, 'menu_class' => 'sidenav'));
			else:
				if($post->post_parent) {
				    $post_ancestors = get_post_ancestors($post->ID);
				    $post_root = count($post_ancestors)-1;
				    $post_parent = $post_ancestors[$post_root];
				    $title = get_the_title($post_ancestors[$post_root]);
				} else {
				    $post_parent = $post->ID;
				    $title = get_the_title($post->ID);
				}
				$children = wp_list_pages("title_li=&child_of=".$post_parent."&echo=0&depth=1");
				if($children) {
				    echo '  <h3>'.$title.'</h3>'."\n";
				    echo '  <ul class="sidenav">'."\n";
				    echo        $children."\n";
				    echo '  </ul>'."\n";
				} 
			endif;
		?>
	</div>
	
	<br style="clear: both;" />

<?php get_footer(); ?>
