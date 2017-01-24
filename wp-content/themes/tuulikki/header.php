<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<!-- Favicons  ================================================== -->
		<?php if (!function_exists('has_site_icon') || ! has_site_icon()) { ?>
			<?php if(get_theme_mod('ilgelo_favicon')) : ?>
			<link rel="shortcut icon" href="<?php echo get_theme_mod('ilgelo_favicon'); ?>" />
			<?php endif; ?>
		<?php } ?>
		<!-- RSS & Pingbacks  ================================================== -->
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<!-- =============== // Scripts/CSS HEAD HOOK // =============== -->
		<?php
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
		?>

		</head>

<body <?php body_class(); ?> id="vid-container">
		<!--
		========================================
			 Menu Responsive
		========================================
		-->

		<div class="cont_primary_menu cont_menu_responsive">
			<div class="container ">
			<?php if ( is_single() || is_category()) : ?>
				<div id="logo_single">
					<?php if(!get_theme_mod('ilgelo_single_logo')) : ?>
						<h2 title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'description' ); ?>">
							<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
						</h2>
					<?php else : ?>
							<a href="<?php echo home_url(); ?>"><img width="<?php echo get_theme_mod( 'ilgelo_retina_single_logo' ); ?>" src="<?php echo esc_url(get_theme_mod('ilgelo_single_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
					<?php endif; ?>
				</div><!-- #logo_single -->
			<?php endif; ?>
			
				<!-- ==== Login ======== -->
				<?php if(class_exists('WooCommerce')) : ?>
					<div id="resp-ig-shopping-login">
						<div class="cart-login">
							<?php if(is_user_logged_in()) : ?>
								<a href="<?php echo ilgelo_woocommerce_get_myaccount_url(); ?>" title="<?php echo __('My Account', 'ilgelo') ?>"><?php echo __('My Account', 'ilgelo') ?></a>
							<?php else: ?>
								<a href="<?php echo ilgelo_woocommerce_get_myaccount_url(); ?>" title="<?php echo __('Log In', 'ilgelo') ?>"><?php echo __('Log In', 'ilgelo') ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- ==== Menu Mobile ======== -->
				<section id="top-resp-menu">
					<a class="click_menu" href="#0">
						<i class="fa fa-bars"></i>
					</a>
				</section>
				<?php  include(TEMPLATEPATH."/include/menu-mobile.php"); ?>

				<!-- ==== Cart ======== -->
				<?php if(class_exists('WooCommerce')) : ?>
					<section id="resp-cart">
					<a href="<?php echo ilgelo_woocommerce_get_viewcart_url(); ?>">
						<i class="fa fa-shopping-cart"></i>
					</a>
				<?php endif; ?>




			</div><!-- End Container -->
		</div><!-- End cont_primary_menu -->



		<!-- === End  Menu Responsive ====-->






		<?php if ( is_single() || is_category()) : ?>
			<?php if(!get_theme_mod('ig_disable_ecom_nav') && class_exists('WooCommerce')) : ?>
				<?php if (has_nav_menu('woo_menu')) : ?>
					<div class="e_com_menu hide_desc_menu">
						<div class="container">
							<?php get_template_part('include/menu/menu','cart'); ?>
							<div class="e_com_menu textalignleft">
								<?php wp_nav_menu(array(
										'theme_location' => 'woo_menu',
										'menu'            => 'ul',
										'menu_class'      => 'nav-menu',
										'menu_id'         => '',
										'container'       => false,
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'depth'           => 4,
										'walker'          => '')
										);
								?>
							</div>
						</div><!-- End .Container -->
					</div><!-- End e_com_menu -->
				<?php endif; ?>
			<?php endif; ?>


			<?php if(get_theme_mod('header_single_page') == 'ig_header_big_logo') : ?>
				<?php include(TEMPLATEPATH."/include/header/header-home.php"); ?>
				<?php include(TEMPLATEPATH."/include/header/nav-home.php"); ?>
			<?php elseif(get_theme_mod('header_single_page') == 'ig_header_mini_logo') : ?>
				<?php include(TEMPLATEPATH."/include/header/single-header.php"); ?>
			<?php else : ?>
				<?php include(TEMPLATEPATH."/include/header/single-header.php"); ?>
			<?php endif; ?>

		<?php else : ?>

			<?php if(!get_theme_mod('ig_disable_ecom_nav') && class_exists('WooCommerce')) : ?>
				<?php if (has_nav_menu('woo_menu')) : ?>
					<div class="e_com_menu hide_desc_menu">
						<div class="container">
							<?php get_template_part('include/menu/menu','cart'); ?>

							<div class="e_com_menu textalignleft">
								<?php wp_nav_menu(array(
									'theme_location' => 'woo_menu',
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
						</div><!-- End .Container -->
					</div><!-- End e_com_menu -->
				<?php endif; ?>
			<?php endif; ?>

			<?php if(get_theme_mod('layout_columns') == 'ig_layout1') : ?>
				<?php include(TEMPLATEPATH."/include/header/header-home.php"); ?>
				<?php include(TEMPLATEPATH."/include/header/nav-home.php"); ?>
			<?php elseif(get_theme_mod('layout_columns') == 'ig_layout2') : ?>
				<?php include(TEMPLATEPATH."/include/header/nav-home.php"); ?>
				<?php include(TEMPLATEPATH."/include/header/header-home.php"); ?>
			<?php elseif(get_theme_mod('layout_columns') == 'ig_layout3') : ?>
				<?php include(TEMPLATEPATH."/include/header/single-header.php"); ?>
			<?php else : ?>
				<?php include(TEMPLATEPATH."/include/header/header-home.php"); ?>
				<?php include(TEMPLATEPATH."/include/header/nav-home.php"); ?>
			<?php endif; ?>

		<?php endif; ?>

		<!--
		=====================================
				   MENU ON SCROLL
		=====================================
		-->

		<?php
			$logostyle="position:relative;";
			if(get_theme_mod('ilgelo_menu_layout') == 'textaligncenter') {
				$logostyle="position:absolute;";
			}
		?>


		<div id="mini-header">
			<div class="cont_primary_menu">
				<?php if(is_single()) : ?>
					<div id="progress"></div>
				<?php endif; ?>

				<div class="container">
					<div id="logo_single" style="<?php echo $logostyle ?>">
						<?php if(!get_theme_mod('ilgelo_single_logo')) : ?>
							<h2><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h2>
						<?php else : ?>
							<a href="<?php echo home_url(); ?>"><img width="<?php echo get_theme_mod( 'ilgelo_retina_single_logo' ); ?>" src="<?php echo esc_url(get_theme_mod('ilgelo_single_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php endif; ?>
					</div><!-- #logo_single -->

					<!-- ==== Menu Mobile ======== -->
					<section id="top-resp-menu">
						<a class="click_menu" href="#0"><i class="fa fa-bars"></i></a>
					</section>
					<?php include(TEMPLATEPATH."/include/menu-mobile.php"); ?>

					<!-- ==== Social Icon ======== -->
					<?php if(!get_theme_mod('ilgelo_social_active')) : ?>
						<div id="ig-social" <?php if(get_theme_mod('ilgelo_search_active')) : ?>class="nosearch"<?php endif; ?>>
							<?php include(TEMPLATEPATH."/include/social-icons.php"); ?>
						</div><!-- .ig-social -->
					<?php endif; ?>

					<div class="top_menu <?php echo get_theme_mod( 'ilgelo_menu_layout' ); ?>">
						<?php wp_nav_menu(array(
							'theme_location' => 'mini_scroll_menu',
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
		</div><!-- End #mini-header -->

		<?php if(!get_theme_mod('ig_disable_loading')) : ?>
			<div class="animsition">
		<?php endif; ?>
