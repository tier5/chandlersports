<?php
/**
* The Header for our theme.
*
* Displays all of the <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> section and everything up till <div id="main">
*
* @package WordPress
* @subpackage Twenty_Ten
* @since Twenty Ten 1.0
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
   <?php global $woocommerce; ?>
  <?php
  /*
  * Print the <title> tag based on what is being viewed.
  */
  global $page, $paged;
  wp_title( ' | ', true, 'right' );
  // Add the blog name.
  // bloginfo( 'name' );
  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
  echo " | $site_description";
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
  echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
  ?>
</title>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=<?php echo time(); ?>" />
<!--   <link rel="stylesheet" type="text/css" media="all" href="<?=get_stylesheet_directory_uri().'/wc_css.css'?>" /> -->
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="stylesheet" type="text/css" media="all" href="<?=get_stylesheet_directory_uri().'/css/bootstrap.min.css'?>" />
  <link href="<?php bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet" type="text/css">
  <link href="<?php bloginfo('template_directory'); ?>/css/stylesheet.css" rel="stylesheet" type="text/css">
  <link href="<?php bloginfo('template_directory'); ?>/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="<?php bloginfo('template_directory'); ?>/css/menu-style.css" rel="stylesheet" type="text/css">
  <link href='http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' rel='stylesheet' type='text/css'>
  <link href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.css" rel="stylesheet" type="text/css">
  <link href="<?php bloginfo('template_directory'); ?>/css/owl.theme.css" rel="stylesheet" type="text/css">
  <link href="<?php bloginfo('template_directory'); ?>/css/bootstrap-responsive-tabs.css" rel="stylesheet" type="text/css">
  <link href="<?php bloginfo('template_directory'); ?>/css/responsive.css" rel="stylesheet" type="text/css">
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="<?=get_stylesheet_directory_uri()?>/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!--<script src="<?=get_stylesheet_directory_uri()?>/js/ie-emulation-modes-warning.js"></script>-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/chandler/css/ie.css" />
<![endif]-->
<?php
/* We add some JavaScript to pages with the comment form
* to support sites with threaded comments (when in use).
*/
if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
/* Always have wp_head() just before the closing </head>
* tag of your theme, or you will break many plugins, which
* generally use this hook to add elements to <head> such
* as styles, scripts, and meta tags.
*/
wp_head();
?>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/chandler/_iestyle.css" />
<![endif]-->
<?php /*
<script type="text/javascript" src="//fast.fonts.com/jsapi/9120d1f2-e488-4043-a9c1-6b5afee262b0.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
*/ ?>
<script src="<?=get_stylesheet_directory_uri().'/js/slides.js'?>"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?=get_stylesheet_directory_uri().'/zoom.css'?>" />
<script src="<?=get_stylesheet_directory_uri().'/js/zoom.js'?>"></script>
<script src="<?=get_stylesheet_directory_uri().'/js/high.js'?>"></script>
<script src="<?=get_stylesheet_directory_uri().'/js/bootstrap.min.js'?>"></script>
<script src="<?=get_stylesheet_directory_uri().'/js/custom.js'?>?v=1.2.3"></script>
  <script>
  jQuery(function($){
  if($('#slides').length) {
  $("#slides").slides({
  generateNextPrev: true,
  generatePagination: true,
  effect: 'fade'
  });
  }
  if($('#pageslides').length) {
  $("#pageslides").slides({
  generateNextPrev: true,
  generatePagination: true,
  effect: 'fade'
  });
  }
  $('.inside-menu').matchHeight();
  });
  jQuery(function($) {
  if($('#singleimg').length) {
  $('#singleimg').jqzoom({
  zoomType: 'standard',
  lens:true,
  preloadImages: false,
  alwaysOn:false,
  zoomWidth: 459,
  zoomHeight: 459,
  title: false,
  xOffset: 28,
  yOffset: 0
  });
  }
  //jQuery('.toggle_form').hide();
  jQuery(".toggle_hire").click(function(){
  jQuery(".toggle_form").toggle();
  });
  });
  /* MAtrix M JS*/
  jQuery( document ).ready(function() {
     jQuery('#main li').append('<a href="#" class="show-mega-menu-on-hover" style="display:none;"><img class="img-responsive menu-arrow-image" src="<?=get_stylesheet_directory_uri();?>/images/icons.png"></a>');
  });
  </script>
</head>
<body <?php body_class(); ?>>
<?php /*
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=427173494029217";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
*/?>

<div class="top_hed">
	<div class="container">
    <div class="row">
      <div class="col-sm-4 hidden-xs">
        Open Mon - Fri, 8:30am - 5pm
      </div>
      <div class="col-xs-12 col-sm-8">
	      <div class="row">
		      <div class="col-xs-6 col-sm-6 col-md-3">
			      <span>Support: <a href="tel:01968 672 0202">01968 672 0202</a></span>
		      </div>
		      <div class="col-xs-6 col-sm-6 col-md-3">
			      <span>Sales: <a href="tel:01968 670 610">01968 670 610</a></span>
		      </div>
	      </div>
      </div>
    </div>
	</div>
</div><!-- top_hed -->

<div class="top_logo_headr">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-4">
				<div class="logo cf">
					<?php if ( get_theme_mod( 'Client_logo' ) ) : ?>
					<a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="" src="<?php echo get_theme_mod( 'Client_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				<?php else : ?>
					<div class="site-introduction">
						<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					</div>
				<?php endif; ?>
				</div><!-- logo cf -->
			</div>
			<div class="col-sm-3 col-md-4">
				<div class="head_search">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
						<input type="hidden" name="post_type" value="product" />
						<input name="s" type="text" placeholder="Search the site"  onblur="this.value = this.value || this.defaultValue;" onfocus="this.value = '';" />
						<button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div><!-- head_search -->
			</div><!-- col -->

			<div class="col-xs-6 col-sm-3 col-md-2  header-icon-area">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user" aria-hidden="true"></i>
					</div>
					<div class="col-xs-9">
						<?php
						if (is_user_logged_in()) :
						?>
							<h3><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a></h3>
							<p><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></p>
						<?php else: ?>
							<h3>My account</h3>
							<p><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a></p>
						<?php endif; ?>
					</div>
				</div><!-- row -->
			</div><!-- header-icon-area -->

			<div class="col-xs-6 col-sm-2 col-md-2 header-icon-area">
				<div class="row">
					<div class="col-xs-3 col-sm-4">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-xs-9 col-sm-8">
						<h3><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a></h3>
						<p><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo $woocommerce->cart->get_cart_total(); ?></p></a>
					</div>
				</div><!-- row -->
			</div><!-- header-icon-area -->

		</div><!-- row -->
	</div><!-- container -->
</div><!-- top_logo_headr -->

<div class="header_nav_bar">
	<div class="container">
    	<div class="menu-container">
          <div class="menu">
	 <?php wp_nav_menu( array( 'container' => false, 'menu_class' => 'false','theme_location' => 'primary' ) );  ?>
          </div>
        </div>
    </div>
</div>
<div class="header-cta-bar hidden-xs">
  <div class="container">
    <div class="col-sm-4 col-xs-12">
      <div class="col-xs-2 col-sm-12 col-md-2">
        <img src="<?= get_template_directory_uri() ?>/images/pound_icon.jpg" alt="Best price guarantee" />
      </div>
      <div class="col-xs-10 col-sm-12 col-md-10">
        <span>Best price guarantee</span>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="col-xs-2 col-sm-12 col-md-2">
        <img src="<?= get_template_directory_uri() ?>/images/van_icon.jpg" alt="Free delivery over &pound;100" />
      </div>
      <div class="col-xs-10 col-sm-12 col-md-10">
        <span>Free delivery over &pound;100</span>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="col-xs-2 col-sm-12 col-md-2">
        <img src="<?= get_template_directory_uri() ?>/images/uk_icon.jpg" alt="Nationwide Installatio" />
      </div>
      <div class="col-xs-10 col-sm-12 col-md-10">
        <span>Nationwide Installation</span>
      </div>
    </div>
  </div>
</div>
