<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function ilgelo_customizer_css() {
    ?>
    <style type="text/css">






/* =======================
   HEADER Settings
==========================*/

	#logo,
	h1.logo_text {
		padding-top: <?php echo get_theme_mod( 'ilgelo_header_padding_top' ); ?>px;
		padding-bottom: <?php echo get_theme_mod( 'ilgelo_header_padding_bottom' ); ?>px;
		padding-left: 0px;
		padding-right: 0px;
		}
		
	@media (max-width: 1000px) {
		#logo, h1.logo_text {
		padding: 30px 0px 20px 0px;
		}
	}
		
	#logo_single {
		padding-top:<?php echo get_theme_mod( 'ilgelo_single_logo_padding_top' ); ?>px;
		}





	<?php if(get_theme_mod( 'ig_hide_mini_logo_mobile' )) : ?>
	@media (max-width: 1000px) {
		#logo_single {
			display: none;
		}
	}
	<?php endif; ?>


	<?php if(get_theme_mod( 'ig_big_logo_mobile' )) : ?>
	@media (max-width: 1000px) {
		.header_logo {
			display: none;
		}
	}
	<?php endif; ?>


/* =======================
   General Colors
==========================*/

body {
	color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;
	background-color: <?php echo get_theme_mod( 'ig_color_body','#fcfcfc' ); ?>;

}

a {
	color: <?php echo get_theme_mod('ig_color_hover','#ef9781'); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;
}

h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h5 a, h6, h6 a, .h1, .h1 a, .h2, .h2 a, .h3, .h3 a, .h4, .h4 a, .h5, .h5 a, .h6, .h6 a {
	color: <?php echo get_theme_mod( 'ig_color_h_text','#353535' ); ?>;
}

h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover,
.h1 a:hover,
.h2 a:hover,
.h3 a:hover,
.h4 a:hover,
.h5 a:hover,
.h6 a:hover{
	color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781'); ?>;
	}




	/* ===  Colors Meta === */
	.post-header .meta_item a,
	.post-header-single .meta_item,
	.post-header .meta_item,
	.entry-footer-meta .meta_item,
	.entry-footer-meta .meta_item a,
	.meta_related_post h6.r-p-date,
	.post-header-single .toafter a,
	.title_navigation_post h6,
	.title_navigation_post_r h6,
	.ig_recent_big_post_details span,
	.meta_related_post h6.r-p-date,
	.subtitle_page h3,
	.thecomment .comment-text span.date  {
	   	color: <?php echo get_theme_mod( 'ig_color_meta_text','#aaaaaa' ); ?>;
	}

	.post-header-single,
	.entry-footer-meta {
		background-color: <?php echo get_theme_mod( 'ig_color_body','#fcfcfc'); ?>;
	}



	/* === Base Colors === */


	blockquote {
	    border-left-color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}

	#progress {
	    background-color:  <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}

	.post-header-single .title-line__inwrap ul li a,
	.post__category .title-line__inwrap ul li a {
		color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;
	}



	.title-line__inwrap ul li a:hover,
	.post__category .title-line__inwrap ul li a:hover {
		color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}


	.post-header .meta_item a:hover {
		color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;

	}
	ul.meta-share li a:hover {
		color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}
	.entry-footer-meta .meta_item a:hover {
		color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}
	.post-header-single .meta_item a:hover {
		color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;

	}

	.tit_prev span a,
	.tit_next span a  {
	   	color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;
	}
	.tit_prev span a:hover,
	.tit_next span a:hover  {
	   	color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}


	/* === Read More === */

	a.read-more,
	#commentform .submit {
		color: <?php echo get_theme_mod( 'ig_color_more_text','#aaaaaa' ); ?>;
		border-color: <?php echo get_theme_mod( 'ig_color_more_border','#aaaaaa' ); ?>;
		}
	a.read-more:hover,
	#commentform .submit:hover {
		color: <?php echo get_theme_mod( 'ig_color_more_text_hover','#ef9781' ); ?>;
		border-color: <?php echo get_theme_mod( 'ig_color_more_border_hover','#ef9781' ); ?>;
		}


	/* === Slide color & Promo Box & widget Promo Box & featured image box === */

	.overlayBox:hover .slidepost__desc h3,
	.small_slidepost .slide_cat ul li a:hover,
	.big_slidepost .slide_cat ul li a:hover,
	.big_slidepost .slidepost__desc h3 a:hover,
	.wrap_promo_box:hover .promobox__desc h3,
	.widget_promo_box:hover .widget_promobox__desc h3,
	.featured-promobox__desc .featured_cat a:hover,
	.small-post-slider .slidepost__desc h3 a:hover

	 {
		color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}




	.slidepost__desc,
	.promobox__desc h3,
	.featured-promobox__desc,
	.widget_promobox__desc h3,
	.slick-prev, .slick-next,
	.small-post-slider .slick-prev,
	.small-post-slider .slick-next,
	.cont_big_slidepost .slick-prev,
	.cont_big_slidepost .slick-next,
	.ig_posts_slider .slick-prev,
	.ig_posts_slider .slick-next
	{
		background: rgba(<?php echo get_theme_mod( 'ig_slideposts_bg' ); ?>,0.8);
	}
	.featured-promobox__desc {
		background: rgba(<?php echo get_theme_mod( 'ig_slideposts_bg' ); ?>,0.9);
	}

	
	.small-post-slider .slidepost__desc h3 a,
	.big_slidepost .slidepost__desc h3 a,
	.promobox__desc h3,
	.featured-promobox__desc h3,
	.widget_promobox__desc h3,
	.slick-prev:before,
	.slick-next:before,
	.small-post-slider .slick-prev:before,
	.small-post-slider .slick-next:before,
	.cont_big_slidepost .slick-prev:before,
	.cont_big_slidepost .slick-next:before,
	.ig_posts_slider .slick-next:before,
	.ig_posts_slider .slick-prev:before


	 {
		color: <?php echo get_theme_mod( 'ig_slideposts_title','#353535' ); ?>;
	}
	.small_slidepost .slide_cat ul li a,
	.big_slidepost .slide_cat ul li a,
	.featured-promobox__desc .featured_cat a {
		color: <?php echo get_theme_mod( 'ig_slideposts_category','#999999' ); ?>;
	}
	.small-post-slider .slidepost__desc .slide_date,
	.featured-promobox__desc .post-header .meta_item ul li,
	.big_slidepost .slidepost__desc .slide_date {
		color: <?php echo get_theme_mod( 'ig_slideposts_date','#999999' ); ?>;
	}



	 /* === Form color === */

	.ig_widget .mc4wp-form input[type="submit"],
	.ig_widget .mc4wp-form input[type="email"]:focus,
	.ig_widget .mc4wp-form input[type="text"]:focus,
	.wpcf7 input:focus,
.wpcf7 textarea:focus,
.wpcf7 .wpcf7-submit

	{
		border-color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781' ); ?>;
	}






	/* a = default #353535 */
	a.ig_recent_post_title,
	.ig_recent_big_post_details a,
	.ig_widget a,
	.nav-mobile > li > a,
	a.page-numbers,
	.tit_prev span a,
	.tit_next span a,
	.overlayBox:hover .postTime,
	ul.meta-share li a,
	.instagram-title,
	.textt,
	blockquote p,
	.ig_cont_single_only_title .meta_item a,
	.arrow_prev a,
	.arrow_next a,
	.ig_widget .widget_search form
	{
	color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;
	}

	.title-line__inwrap:before,
	.title-line__inwrap:after {
	    border-top-color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;

	}



	/* a:hover = default #ef9781 */
	#logo_single h2 a:hover,
	a.ig_recent_post_title:hover,
	.ig_recent_big_post_details a:hover,
	.ig_widget a:hover,
	.nav-mobile > li > a:hover,
	a.page-numbers:hover,
	.page-numbers.current,
	.tit_prev span a:hover,
	.tit_next span a:hover,
	.cont-aboutme p.tithover:hover,
	.ig_cont_single_only_title .meta_item a:hover,
	.subscribe-box input[type=text]:focus,
	.subscribe-box input[type=email]:focus,
	.subscribe-box input[type=submit]:hover,
	.arrow_prev a:hover,
	.arrow_next a:hover


     {
	color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781'); ?>;
	}


	/* Color Meta = default #878787 */
	.ig_recent_post_details span

	{
	color: <?php echo get_theme_mod( 'ig_color_meta_text','#aaaaaa' ); ?>;
	}



/* === Top Navigation Bar === */

		<?php if(get_theme_mod( 'ig_topbar_bg' )) : ?>
		.cont_primary_menu, .top_menu .nav-menu ul {
			background:<?php echo get_theme_mod( 'ig_topbar_bg','#f2f2f2' ); ?>;
		}<?php endif; ?>

		<?php if(get_theme_mod( 'ig_topbar_nav_color' )) : ?>
		.top_menu .nav-menu li a,
		.top_menu .menu li a,
		.top_menu .menu > li.menu-item-has-children:before,
		.top_menu .nav-menu > li.menu-item-has-children:before
		  {
			color:<?php echo get_theme_mod( 'ig_topbar_nav_color','#7f7f7f' ); ?>;
		}
		<?php endif; ?>

		.top_menu .nav-menu li:hover > a,
		.top_menu .menu li:hover > a {
			color:<?php echo get_theme_mod( 'ig_topbar_nav_color_active','#ef9781' ); ?>;
		}
		.top_menu li.current-menu-item > a,
		.top_menu .current_page_item,
		.top_menu .menu li.current-menu-item > a,
		.top_menu .menu .current_page_item {
			 /* Color Current Page */
			color:<?php echo get_theme_mod( 'ig_topbar_nav_color_active','#ef9781' ); ?> !important;
		}
		.top_menu .nav-menu ul li,
		.top_menu .menu ul li {
			border-top-color: <?php echo get_theme_mod( 'ig_drop_border','#fcfcfc' ); ?>;
		}
		.top_menu .nav-menu li:hover > ul,
		.top_menu .menu li:hover > ul {
			background: <?php echo get_theme_mod( 'ig_drop_bg','#f9f9f9' ); ?>;
		}
		.top_menu .nav-menu ul a,
		.top_menu .menu ul a {
			color:<?php echo get_theme_mod( 'ig_drop_text_color','#b5b5b5' ); ?> !important;
		}
		.top_menu .nav-menu ul a:hover,
		.top_menu .menu ul a:hover {
			color: <?php echo get_theme_mod( 'ig_drop_text_hover_color','#ef9781' ); ?> !important;
			background:<?php echo get_theme_mod( 'ig_drop_text_hover_bg','#f2f2f2' ); ?>;
		}





/* === Below Navigation Bar  === */

	<?php if(get_theme_mod( 'ig_below_bar_bg' )) : ?>
	.cont_secondary_menu {
		background:<?php echo get_theme_mod( 'ig_below_bar_bg','#fcfcfc' ); ?>;
	}
	<?php endif; ?>

	<?php if(get_theme_mod( 'ig_below_bar_nav_color' )) : ?>
	.below_menu .nav-menu li a,
	.below_menu .menu > li.menu-item-has-children:before,
	.below_menu .nav-menu > li.menu-item-has-children:before {
		color:<?php echo get_theme_mod( 'ig_below_bar_nav_color','#999999' ); ?>;
	}
	<?php endif; ?>
	.below_menu .nav-menu li:hover > a {
		color:<?php echo get_theme_mod( 'ig_below_bar_nav_color_active','#ef9781' ); ?>;
	}
	.below_menu li.current-menu-item > a, .below_menu .current_page_item {
		 /* Color Current Page */
		color:<?php echo get_theme_mod( 'ig_below_bar_nav_color_active','#ef9781' ); ?> !important;
	}
	.below_menu .nav-menu ul li {
	border-top-color: <?php echo get_theme_mod( 'ig_below_drop_border', '#eeeeee' ); ?>;
	}
	.below_menu .nav-menu li:hover > ul {
		background: <?php echo get_theme_mod( 'ig_below_drop_bg','#f9f9f9' ); ?>;
	}
	.below_menu .nav-menu ul a {
		color:<?php echo get_theme_mod( 'ig_below_drop_text_color','#878787' ); ?> !important;
	}
	.below_menu .nav-menu ul a:hover {
		color: <?php echo get_theme_mod( 'ig_below_drop_text_hover_color','#ef9781' ); ?> !important;
		background:<?php echo get_theme_mod( 'ig_below_drop_text_hover_bg','#fcfcfc' ); ?>;
	}


/* === Color social Navigation === */

	#ig-social a i {
		color:<?php echo get_theme_mod( 'ig_topbar_social_color', '#999999' ); ?>;
	}
	#ig-social a:hover i {
		color:<?php echo get_theme_mod( 'ig_topbar_social_color_hover', '#ef9781' ); ?>;
	}

/* === Color Search Navigation === */

	#top-search i {
		color:<?php echo get_theme_mod( 'ig_topbar_search_magnify','#999999' ); ?>;
	}
	#top-search i:hover {
		color:<?php echo get_theme_mod( 'ig_topbar_search_magnify_hover','#ef9781' ); ?>;
	}


/* === Colors: Mobile Menu === */

	.container_menu {
		background: <?php echo get_theme_mod( 'ig_bg_mobile','#f6f6f6' ); ?>;
	}


/* === Color: Sidebar === */

	.ig_widget, .ig_widget .tagcloud a,
	.subscribe-box {
		border-color: <?php echo get_theme_mod( 'ig_sidebar_border','#efefef' ); ?>;
		border-style: solid;
		border-width: 1px;
		background-color: <?php echo get_theme_mod( 'ig_sidebar_bg', '#f7f7f7' ); ?>;
	}

	/* Divider Line Color Widget Title */
	.ig_widget .tit_widget span:after {
    border-bottom-color: <?php echo get_theme_mod( 'ig_color_divider_widget_title','#ef9781'); ?>;
}



/* === Divider Line & border === */
	.post-footer,
	.grid-item {
		border-color: <?php echo get_theme_mod( 'ig_color_divider','#eaeaea' ); ?>;
	}







	/* === Color: Widget About === */
	.container-aboutme {
		border-color: <?php echo get_theme_mod( 'ig_wid_about_border','#e5e8ea' ); ?>;
		background-color: <?php echo get_theme_mod( 'ig_wid_about_background','#eff0f2' ); ?>;
	}
	.cont-aboutme p.tit {
		color: <?php echo get_theme_mod( 'ig_wid_about_title','#353535' ); ?>;
	}
	.cont-aboutme p.subtit {
		color: <?php echo get_theme_mod( 'ig_wid_about_sub_title','#a3a3a3' ); ?>;
	}
	.cont-aboutme p.desc {
		color: <?php echo get_theme_mod( 'ig_wid_about_text','#353535' ); ?>;
	}
	.cont-aboutme ul.meta-share,
	.cont-aboutme ul.meta-share li a {
		color: <?php echo get_theme_mod( 'ig_wid_about_social','#353535' ); ?>;
	}
	.cont-aboutme ul.meta-share li a:hover {
		color: <?php echo get_theme_mod( 'ig_wid_about_social_hover','#ef9781' ); ?>;
	}


  /* === Color: Footer === */


.sub_footer {
	background: <?php echo get_theme_mod( 'ig_bg_footer','#ffffff' ); ?>;
}

.sub_footer .text_footer {
	color:  <?php echo get_theme_mod( 'ig_text_footer','#353535' ); ?>;
}
.sub_footer .text_footer a {
	color:  <?php echo get_theme_mod( 'ig_hover_footer','#ef9781' ); ?>;
}
.sub_footer .text_footer a:hover {
	color:  <?php echo get_theme_mod( 'ig_text_footer','#353535' ); ?>;
}
.padding_footer_column {
	background: <?php echo get_theme_mod( 'ig_bg_footer_sidebar','#f7f7f7' ); ?>;
}





<?php if(class_exists('WooCommerce')) { ?>
	/* ======================================
		   Woocommerce Custom Style
	=========================================*/


	/* === Woo-Commerce Navigation Nav  === */

	<?php if(get_theme_mod( 'ig_e_com_bar_bg' )) : ?>
	.e_com_menu {
		background:<?php echo get_theme_mod( 'ig_e_com_bar_bg','#3c3c42' ); ?>;
	}
	<?php endif; ?>

	<?php if(get_theme_mod( 'ig_e_com_bar_nav_color' )) : ?>
	.e_com_menu .nav-menu li a,
	.e_com_menu .menu > li.menu-item-has-children:before,
	.e_com_menu .nav-menu > li.menu-item-has-children:before,
	.cart-login a,
	.num_items,
	.cart-contents:before {
		color:<?php echo get_theme_mod( 'ig_e_com_bar_nav_color','#a3a3a3' ); ?>;
	}
	<?php endif; ?>
	.e_com_menu .nav-menu li:hover > a,
	.cart-login a:hover,
	#ig-shopping-cart:hover .num_items,
	#ig-shopping-cart:hover .cart-contents:before {
		color:<?php echo get_theme_mod( 'ig_e_com_bar_nav_color_active','#ef9781' ); ?>;
	}
	.e_com_menu li.current-menu-item > a, .e_com_menu .current_page_item {
		 /* Color Current Page */
		color:<?php echo get_theme_mod( 'ig_e_com_bar_nav_color_active','#ef9781' ); ?> !important;
	}
	.e_com_menu .nav-menu ul li,
	#ig-shopping-login ul li {
	border-top-color: <?php echo get_theme_mod( 'ig_e_com_drop_border','#eeeeee' ); ?>;
	}
	.e_com_menu .nav-menu li:hover > ul,
	#ig-shopping-cart .sub-cart-menu,
	#ig-shopping-login .sub-login-menu {
		background: <?php echo get_theme_mod( 'ig_e_com_drop_bg','#f9f9f9' ); ?>;
	}
	.e_com_menu .nav-menu ul a,
	.list_menu_account li a,
	#ig-shopping-cart ul li {
		color:<?php echo get_theme_mod( 'ig_e_com_drop_text_color','#878787' ); ?> !important;
	}
	.e_com_menu .nav-menu ul a:hover,
	.list_menu_account li a:hover {
		color: <?php echo get_theme_mod( 'ig_e_com_drop_text_hover_color','#ef9781' ); ?> !important;
		background:<?php echo get_theme_mod( 'ig_e_com_drop_text_hover_bg','#fcfcfc' ); ?>;
	}


	.e_com_menu .cart-border {
		border-color: <?php echo get_theme_mod( 'ig_e_com_vertical_divider','#595959' ); ?>;
	}



	/* Woo-Commerce Grid layout */
	<?php if(get_theme_mod('ig_woo_related_prod_layout') == '3') : ?>
		/* 3 Columns Related Products */
		.woocommerce .related ul.products li.product, .woocommerce-page ul.products li.product {
		float: left;
		margin: 0 2% 20px 0;
		padding: 0;
		position: relative;
		width: 32%;
		}
		.woocommerce .related ul.products li.last, .woocommerce-page ul.products li.last {
		margin-right: 0;
		}

		@media screen and (max-width: 768px) {
			.woocommerce .related ul.products li.product, .woocommerce-page ul.products li.product {
			width: 48%;
			}
		}

		<?php else : ?>

		/* 4 Columns Related Products */
		.woocommerce .related ul.products li.product, .woocommerce-page ul.products li.product {
		float: left;
		margin: 0 2% 25px 0;
		padding: 0;
		position: relative;
		width: 23.5%;
		}
		.woocommerce .related ul.products li.last, .woocommerce-page ul.products li.last {
		margin-right: 0;
		}

	<?php endif; ?>

	<?php if(get_theme_mod('ig_woo_shop_layout') == '3') : ?>
		/* 3 Columns Shop page */
		.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
			float: left;
			margin: 0 2% 2.992em 0;
			padding: 0;
			position: relative;
			width: 32%;
		}
		.woocommerce ul.products li.last, .woocommerce-page ul.products li.last {
			margin-right: 0;
		}

		@media screen and (max-width: 768px) {

		.woocommerce ul.products li.product,
		.woocommerce-page ul.products li.product {
			margin: 0 2% 2.992em 0;
			width: 48%;
			}
		}
		@media screen and (max-width: 480px) {

		.woocommerce ul.products li.product,
		.woocommerce-page ul.products li.product {
			margin: 0px 0px 20px 0px;
			width: 100%;
			}
		}



		<?php else : ?>

		/* 4 Columns Shop page */
		.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
			float: left;
			margin: 0 2% 2.992em 0;
			padding: 0;
			position: relative;
			width: 23.5%;
		}
		.woocommerce ul.products li.last, .woocommerce-page ul.products li.last {
			margin-right: 0;
		}

		@media screen and (max-width: 768px) {

		.woocommerce ul.products li.product,
		.woocommerce-page ul.products li.product {
			margin: 0 2% 2.992em 0;
			width: 48%;
			}
		}
		@media screen and (max-width: 480px) {

		.woocommerce ul.products li.product,
		.woocommerce-page ul.products li.product {
			margin: 0px 0px 20px 0px;
			width: 100%;
			}
		}

	<?php endif; ?>


		/* Woocommerce Color Hover  */
		.woocommerce ul.products li:hover a h3,
		.woocommerce .woocommerce-ordering select:hover,
		.woocommerce div.product .entry-summary span.price,
		.woocommerce .star-rating,
		.del_prod a.ig_remove:hover,
		a.ig_cat_product_title:hover,
		.woocommerce a.remove,
		.woocommerce span.onsale,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce nav.woocommerce-pagination ul li span.current
		{
			color: <?php echo get_theme_mod( 'ig_color_hover','#ef9781'); ?> !important;
		}

		/* Woocommerce Color Body  */
		.woocommerce div.product .stock,
		.woocommerce div.product .entry-summary p.price
		{
			color: <?php echo get_theme_mod( 'ig_color_body_text','#353535' ); ?>;
		}

		 /* Woocommerce Color H  */
		.woocommerce div.product .product_title,
		.del_prod a.ig_remove,
		a.ig_cat_product_title
		{
			color: <?php echo get_theme_mod( 'ig_color_h_text','#353535' ); ?>;
		}

		.subtotal_cont {
			border-top-color: <?php echo get_theme_mod( 'ig_e_com_drop_border','#eeeeee' ); ?>;
			color: <?php echo get_theme_mod( 'ig_color_h_text','#353535' ); ?>;
		}


		.ig_cat_product_details span {
			color:  <?php echo get_theme_mod( 'ig_e_com_drop_text_color','#878787' ); ?>;
		}



		 /* Woocommerce Button  */
		.woocommerce-product-search input[type="submit"],
		.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		a.edit,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce a.button
		{
		color: <?php echo get_theme_mod( 'ig_color_more_text','#aaaaaa' ); ?> !important;
		border-color: <?php echo get_theme_mod( 'ig_color_more_border','#aaaaaa' ); ?>;
		}

		.woocommerce #respond input#submit:hover,
		.woocommerce a.button:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		a.edit:hover,
		.woocommerce-product-search input[type="submit"]:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover
		{
		color: <?php echo get_theme_mod( 'ig_color_more_text_hover','#ef9781' ); ?> !important;
		border-color: <?php echo get_theme_mod( 'ig_color_more_border_hover','#ef9781' ); ?>;
		}


<?php } ?>


.big_slidepost,
.small_slidepost {
	margin-top: <?php if (class_exists('acf')) the_field('slider_margin', 'options'); ?>px !important;
}


/* ======================================
	Custom CSS
=========================================*/



<?php if(get_theme_mod( 'ig_custom_css' )) : ?>
<?php echo get_theme_mod( 'ig_custom_css' ); ?>
<?php endif; ?>





/* === End === */

    </style>
    <?php
}
add_action( 'wp_head', 'ilgelo_customizer_css' );

?>