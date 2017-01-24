


<header>
	<div class="cont_primary_menu hide_desc_menu">
		<div class="container">


			<?php if(!get_theme_mod('ilgelo_search_active')) : ?>
					<section id="top-search">
						<a class="click_search" href="#0"><i class="fa fa-search"></i></a>
					</section>
				<!-- ==== Search Popup ======== -->
				<div class="container_search">
					<div class="container">
						<?php  include(TEMPLATEPATH."/ilgelo-searchform.php"); ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- ==== Social Icon primary Menu ======== -->
			<?php if(!get_theme_mod('ilgelo_social_active')) : ?>
				<div id="ig-social" <?php if(get_theme_mod('ilgelo_search_active')) : ?>class="nosearch"<?php endif; ?>>
				<?php include(TEMPLATEPATH."/include/social-icons.php"); ?>
				</div>

			<?php endif; ?>
			<div class="top_menu <?php echo get_theme_mod('ilgelo_menu_layout','textaligncenter'); ?>">



<?php if ( has_nav_menu( 'primary_menu' ) ) {

					wp_nav_menu(array(
					'theme_location' => 'primary_menu',
					'menu'            => 'ul',
					'menu_class'      => 'nav-menu',
					'menu_id'         => '',
					'container'       => false,
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'depth'           => 4,
					'walker'          => ''
				     )
				  );
} else {

						  //wp_nav_menu( $defaults );



} ?>
			</div>


		</div><!-- End Container -->
	</div><!-- End cont_primary_menu -->



	<?php if (has_nav_menu("secondary_menu")) : ?>
		<div class="cont_secondary_menu hide_desc_menu">
			<div class="container">
				<div class="below_menu <?php echo get_theme_mod('ilgelo_menu_layout','textaligncenter'); ?>">			<?php wp_nav_menu(array(
					'theme_location' => 'secondary_menu',
					'menu'            => 'ul',
					'menu_class'      => 'nav-menu',
					'menu_id'         => '',
					'container'       => false,
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'depth'           => 4,
					'walker'          => ''
				     )
				  );
				?>
				</div>
			</div><!-- End Container -->
		</div><!-- End cont_secondary_menu -->
	<?php endif; ?>


</header>

