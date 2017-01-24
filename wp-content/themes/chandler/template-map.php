<?php
/**
 * Template Name: Map
 */

get_header(); ?>
<div class="container">
<div class="ab_box">
	<div id="page" class= "map-class">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
            <h1 style="text-align:center;padding-bottom:10px;"><?php the_title(); ?></h1>
			
            <div class="col-sm-6">
			<div class="field-class" >
				<?php if(get_field('map') != NULL): ?>
					<img src="<?php echo get_field('map'); ?>" border="0" alt="Delivery Map" style="width:100%;" />
				<?php endif; ?>
			</div>
            </div>
			
            <div class="col-sm-6">
			<div  class="field-class">
				<?php the_content(); ?>
			</div>
            </div>
            
			
		<?php endwhile; ?>
	</div>
</div>
</div>	
	<br style="clear: both;" />

<?php get_footer(); ?>
