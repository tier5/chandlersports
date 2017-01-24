
<div class="header_logo" <?php if(get_theme_mod('layout_columns') == 'ig_layout1') : ?>
					  style="margin-bottom: 0px;"
			<?php endif; ?>>

		<?php if(get_theme_mod('ilgelo_home_bg_logo')) : ?>
			<div class="parallax-window" data-parallax="scroll" data-bleed="0" position="center" speed="0.2" data-image-src="<?php echo esc_url(get_theme_mod('ilgelo_home_bg_logo')); ?>">
		<?php endif; ?>

		<?php if(get_theme_mod('ig_bg_header')) : ?>
			<div id="color_bg_header" style="background-color:  <?php echo get_theme_mod( 'ig_bg_header' ); ?>;">
		<?php endif; ?>

	<!--  <span class="section_mask" style="background-color: #333; opacity: 0.1;"></span> -->
				<div class="container">
				<div id="logo" class="fade_logo <?php echo get_theme_mod( 'ilgelo_logo_layout' ); ?>">
				<?php if(!get_theme_mod('ilgelo_logo')) : ?>

					<?php if(is_front_page()) : ?>
							<h1 class="logo_text"><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
							<h2 class="logo_text"><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h2>
					<?php endif; ?>

				<?php else : ?>
				
					<?php if(is_front_page()) : ?>
						<h1><a href="<?php echo home_url(); ?>"><img width="<?php echo get_theme_mod( 'ilgelo_retina_logo' ); ?>" src="<?php echo esc_url(get_theme_mod('ilgelo_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h1>
					<?php else : ?>
						<h2><a href="<?php echo home_url(); ?>"><img width="<?php echo get_theme_mod( 'ilgelo_retina_logo' ); ?>" src="<?php echo esc_url(get_theme_mod('ilgelo_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
					<?php endif; ?>


				<?php endif; ?>
			</div><!-- #logo -->
			</div><!-- .container -->


		<?php if(get_theme_mod('ig_bg_header')) : ?>
			</div> <!-- #color_bg_header -->
		<?php endif; ?>


		<?php if(get_theme_mod('ilgelo_home_bg_logo')) : ?>
			<script>
				jQuery(document).ready(function() {
					try {
						jQuery('.parallax-window').parallax({imageSrc: '<?php echo esc_url(get_theme_mod('ilgelo_home_bg_logo')); ?>'});
					} catch(err) {
					}
				});
			</script>
			</div> <!-- .parallax-window -->
		<?php endif; ?>


</div> <!-- .header_logo -->
