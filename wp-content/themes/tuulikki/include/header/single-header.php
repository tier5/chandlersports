	<header>
				<div class="cont_primary_menu hide_desc_menu">
					<div class="container">
						<div id="logo_single"
							<?php if(get_theme_mod('ilgelo_menu_layout') == 'textaligncenter') : ?>
								style="position: absolute;"
							<?php else : ?>
								style="position: relative;"
								<?php endif; ?>>

							<?php if(!get_theme_mod('ilgelo_single_logo')) : ?>
								<h2>
									<a href="<?php echo home_url(); ?>" alt="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
								</h2>
							<?php else : ?>
									<a href="<?php echo home_url(); ?>"><img width="<?php echo get_theme_mod( 'ilgelo_retina_single_logo' ); ?>" src="<?php echo esc_url(get_theme_mod('ilgelo_single_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" />
									</a>
							<?php endif; ?>
						</div><!-- #logo_single -->

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

						<!-- ==== Social Icon Single Primary Menu ======== -->
						<?php if(!get_theme_mod('ilgelo_social_active')) : ?>
							<div id="ig-social" <?php if(get_theme_mod('ilgelo_search_active')) : ?>class="nosearch"<?php endif; ?>>
								<?php include(TEMPLATEPATH."/include/social-icons.php"); ?>
							</div>
						<?php endif; ?>

						<div class="top_menu <?php echo get_theme_mod( 'ilgelo_menu_layout','textaligncenter' ); ?>">
							<?php wp_nav_menu(array(
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
							?>
						</div>

					</div><!-- End Container -->
				</div><!-- End cont_primary_menu -->

				<?php if(!get_theme_mod('ilgelo_secondary_menu')) : ?>
					<div class="cont_secondary_menu hide_desc_menu">
						<div class="container">
							<div class="below_menu <?php echo get_theme_mod( 'ilgelo_menu_layout','textaligncenter' ); ?>">			<?php wp_nav_menu(array(
								'theme_location' => 'secondary_menu',
								'menu'            => 'ul',
								'menu_class'      => 'nav-menu animsition-link',
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
