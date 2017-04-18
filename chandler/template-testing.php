<?php
/**
* Template Name: Testing
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>


<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
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

?></title>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=<?php echo time(); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?=get_stylesheet_directory_uri().'/wc_css.css'?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?=get_stylesheet_directory_uri().'/css/bootstrap.min.css'?>" />


<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="<?=get_stylesheet_directory_uri()?>/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="<?=get_stylesheet_directory_uri()?>/js/ie-emulation-modes-warning.js"></script>

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

<div id="fb-root"></div>
<?php /*
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=427173494029217";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
*/?>

<div id="iefix">
<div id="containers" class="container">
<span id="fortheroad"></span> 

<div id="inner" class="full-width">

<div class="wrapper">



<div id="navigation" class="col-lg-12 col-xs-12 col-md-13 col-sm-12">
	<?php wp_nav_menu(array('container_class' => 'menu-header','theme_location' => 'primary','menu_id' => 'main')); ?>
	<?php 
	global $wp_query;
	if (is_product_category()): $cat = $wp_query->get_queried_object(); endif;
	$section = array(16,17,24,28,29,31,30,32,38,50,51,54,55,53,65,101,121,122,112,80,205,76,57,75,88,90,161,163,194,168,169,186,187,191,188,192,148,140,141,142,143,144,145,34,181,148,149,150,151,183,160,184,139,173,174,175,25,126,113,177,179,130,198,199,200,201,202);
	if(is_product()):
		global $post;
		$terms = get_the_terms($post->ID, 'product_cat');
		$key = array_shift(array_keys($terms));
	endif;

	if( $wp_query->query_vars['pagename'] == 'blog' or $wp_query->query_vars['pagename'] == 'about-chandler-sports' or $wp_query->query_vars['pagename'] == 'cart' or $wp_query->query_vars['pagename'] == 'contact' or $post->post_type == 'post' )
		$show_submenu_anyway = true;

	if( $post->ID == 1354 )
		$show_submenu_anyway = true;

	$this_submenu_is_hidden = 'isHidden';

	if( is_product() ||
        is_front_page() ||
        is_woocommerce() ||
        (isset($cat->term_id) && in_array($cat->term_id, $section)) ||
        (isset($key) && in_array($key, $section)) || $show_submenu_anyway) {

		if ( $post->ID != 1104 ) {
			$this_submenu_is_hidden = '';
		}
	}
	?>
	<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 sub-menu menu-homepage <?=$this_submenu_is_hidden?>">
		<?php if(get_field('navigation','option')): ?>
			<ul class="new-sub-menu">
			<?php while(the_repeater_field('navigation','option')): ?>
			
				<?php 
					// LOOP THROUGH THE MENU ITEMS
					$menuitem = get_sub_field('menu_link');
					echo '<li>';					
						echo '<a href="'.get_term_link($menuitem->slug,'product_cat').'">'.get_sub_field('menu_name').'</a>';						;


						// LEAVE THE END <LI> OPEN - FOR NOW
						
						// LETS START LOOPING THROUGH THE NEST TO GET THE MEGA MENU
						if(have_rows('menu_dropdown')): 
							echo '<a  style="display:none;" class="show-inside-menu-on-hover" href="#"><img src="'.home_url().'/wp-content/themes/chandler/images/icons.png" class="img-responsive menu-arrow-image"></a>';
							echo '<div class="mega-menu">';
							while(the_repeater_field('menu_dropdown')):

								// MENU ITEM
								if(get_sub_field('type') == 'menu'):
									wp_nav_menu(array('menu' => get_sub_field('menu'), 'container_class' => 'inside-menu'));
								endif;
								
								// IMAGE ITEM
								if(get_sub_field('type') == 'image'):
									echo '<div class="inside-menu"><a href="'.get_sub_field('image_link').'"><img src="'.get_sub_field('image').'" border="0" /></a></div>';
								endif;

								// GALLERY ITEM
								if(get_sub_field('type') == 'gallery'):
									echo '<div class="inside-menu br-recent-posts-slider"><div class="br-menu-slider-wrapper">';

									while(the_repeater_field('gallery')):
										echo '
											<div class="slide vis">
												<div class="post-item">
													<a href="'.get_sub_field('slide_link').'"><img src="'.get_sub_field('slide').'" border="0" /></a>
												</div>
											</div>
										';
									endwhile;
									echo '</div></div>';
								endif;
							
							endwhile;
							echo '</div>';
						endif;
					
					echo '</li>';
				?>
			
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>
	<?php

	$this_submenu_is_hidden = 'isHidden';
	if($post->ID == 15 || $post->post_parent == 15 || @in_array($post->ID, $commercials)){
		$this_submenu_is_hidden = '';
	}
	?>
	<div class="sub-menu menu-commercial <?=$this_submenu_is_hidden?>">
		<?php wp_nav_menu(array('menu' => 63)); // COMMERCIAL FITNESS ?>
	</div>

	<?php
	$this_submenu_is_hidden = 'isHidden';
	if($post->ID == 18 || $post->post_parent == 18){
		$this_submenu_is_hidden = '';
	}
	?>
	<div class="sub-menu menu-repair <?=$this_submenu_is_hidden?>">
		<?php wp_nav_menu(array('menu' => 64)); // EQUIPMENT REPAIR ?>
	</div>

	<?php
	$this_submenu_is_hidden = 'isHidden';
	if( in_array( $post->ID, array( 9798  ) ) || in_array( $post->post_parent, array( 9798  ) ) ) {
		$this_submenu_is_hidden = '';
	}
	?>
	<div class="sub-menu menu-service <?=$this_submenu_is_hidden?>">
		<?php wp_nav_menu(array('menu' => 291)); // SERVICE & MAINTENANCE ?>
	</div>
</div>
	  <nav class="navbar">
	      <div class="top-nav-bar-outer"> 
	        <div class="navbar-header">	

	            <a class="logo-outer pull-left" href="<?php echo home_url( '/' ); ?>"><img src="<?=get_stylesheet_directory_uri();?>/images/logo.png" class="img-responsive"> </a> 
	            <a style="display:none" class="small-logo-outer pull-left" href="<?php echo home_url( '/' ); ?>"><img src="<?=get_stylesheet_directory_uri();?>/images/logo_new.png" class="img-responsive"> </a> 
	           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        </div>
			        <div id="header_right">
				        <div id="navbar" class="collapse navbar-collapse"> 
				          <ul class="top-nav-bar">
						            <?php if(is_user_logged_in()): ?>
									<li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
								<?php else: ?>
									<li><a href="/dev/my-account/">Login</a></li>
								<?php endif; ?>
								<li><a href="/dev/about/">About</a></li>
								<li><a href="/dev/contact">Contact</a></li>
								<li><a href="/dev/blog/">Blog</a></a></li>
								<!--<li><a href="/login/">Log in</a></li>-->
								<?php global $woocommerce; ?>
 								<li>
 									<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
 										Basket (<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>)
 									</a>
 								</li>
				          </ul>					          
				        </div><!--/.nav-collapse -->

				        <div id="searchbar">
		<!--<div class="col-lg-8 col-sm-8 col-xs-12 col-md-8 searchbar-image">
						
			<a href="/delivery-map/" id="delivery-1"><img class="img-responsive" src="wp-content/themes/chandler/images/freedelivery.png"></a>			
				</div>-->
		<div class="search-box">
		<form action="/" id="searchform" method="get" role="search">
			<input type="text" placeholder="Search products" id="s" name="s" value=""><input type="submit" value="" id="searchsubmit">
			<input type="hidden" value="product" name="post_type">
		</form>
	</div>
	</div>



				        <!--<p id="opening-hours">Opening hours Mon - Fri 8.30am - 5.00pm</p>
				          <p id="sales-line">Sales: <strong>01968 670 610</strong></p>
					<p id="service-line">Service: <strong>01968 672 020</strong></p>-->
			         </div>
	      </div>
	    </nav>


<!--<div id="header">
	<div id="logo"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></div>
	<div id="header_right">
		<ul>
			<?php if(is_user_logged_in()): ?>
				<li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
			<?php else: ?>
				<li><a href="/my-account/">Login</a></li>
			<?php endif; ?>
			<li><a href="/about/">About</a></li>
			<li><a href="/contact">Contact</a></li>
			<li><a href="/blog/">Blog</a></a></li>
			 
			<?php global $woocommerce; ?>
				<li>
					<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
						Basket (<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>)
					</a>
				</li>
		</ul>
		
		<p id="opening-hours">Opening hours Mon - Fri 8.30am - 5.00pm</p>
		<p id="sales-line">Sales: <strong>01968 670 610</strong></p>
		<p id="service-line">Service: <strong>01968 672 020</strong></p>
	</div>
</div>-->


<?php if(!is_cart() && !is_checkout()): ?>
	<!--<div id="searchbar" class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
		<!--<div class="col-lg-8 col-sm-8 col-xs-12 col-md-8 searchbar-image">
		<?php if(is_front_page()): ?>				
			<a href="/delivery-map/" id="delivery-1"><img class="img-responsive" src="wp-content/themes/chandler/images/freedelivery.png"></a>			
		<?php else: ?>
			<p id="breadcrumbs">
				<?php if(is_product()): ?>
				 	<a href="/fitness-equipment/<?php echo $terms[$key]->slug; ?>/" class="backto">&lt; See all <?php echo $terms[$key]->name; ?></a>
				<?php endif; ?>
				<?php if(function_exists('yoast_breadcrumb')): yoast_breadcrumb(); endif; ?>
			</p>				
		<?php endif; ?>
		</div>-->
		<!--<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 search-box">
		<form role="search" method="get" id="searchform" action="/">
			<input type="text" value="" name="s" id="s" placeholder="Search products" /><input type="submit" id="searchsubmit" value="" />
			<input type="hidden" name="post_type" value="product" />
		</form>
	</div>
	</div>-->
	
	<!--<span class="ghr"></span>-->
<?php endif; ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php if(get_field('slider') != NULL): ?>
<div id="slides">
<div class="slides_container">
<?php while(the_repeater_field('slider')): ?>
<div style="background-image: url(<?php echo get_sub_field('image'); ?>);">
<!--<div id="brandlogo">
<?php if(get_sub_field('brand_logo')): ?>
	<img src="<?php echo get_sub_field('brand_logo'); ?>" />
<?php endif; ?>
</div>-->
<!--<div id="content">
<?php if(get_sub_field('slide_link') == 1): ?>
	<a href="<?php echo get_sub_field('buy_now_link'); ?>" class="entirebuy"></a> 
<?php endif; ?>

<?php if(get_sub_field('title') != NULL): ?>
	<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
<?php endif; ?>
<?php if(get_sub_field('price') != NULL): ?>
	<p id="slideprice"><?php echo get_sub_field('price'); ?></p>
<?php endif; ?>
<?php if(get_sub_field('slide_link') != 1): ?>
	<?php if(get_sub_field('buy_now_link') != NULL): ?>
		<a href="<?php echo get_sub_field('buy_now_link'); ?>" class="buynowlink">Buy Now</a> 
	<?php endif; ?>
<?php endif; ?>
<?php if(get_sub_field('hire_link') != NULL): ?>
	<a href="<?php echo get_sub_field('hire_link'); ?>" class="hirenowlink"><?php echo get_sub_field('hire_text'); ?></a> 
<?php endif; ?>
</div>-->
</div>
<?php endwhile; ?>
</div>
</div>
<?php endif; ?>



<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 kurt-home-products-outer">
<div id="kurt" class="col-lg-12 col-sm-12 col-xs-12 col-md-12 kurt-outer">
	
	<h2>Fitness Equipment Services</h2> 
	
	<ul>
		<li>
			<a href="/gym-equipment-spare-parts-edinburgh/"><img src="/wp-content/themes/chandler/images/I1.jpg"></a>
			<a href="/gym-equipment-spare-parts-edinburgh/">Spare Parts</a>
		</li>
		<li>
			<a href="/commercial-gym-edinburgh/"><img src="/wp-content/themes/chandler/images/I2.jpg"></a>
			<a href="/commercial-gym-edinburgh/">Repairs</a>
		</li>
		<li>
			<a href="/commercial-gym-edinburgh/cabling-services/"><img src="/wp-content/themes/chandler/images/I3.jpg"></a>
			<a href="/commercial-gym-edinburgh/cabling-services/">Cabling Service</a>
		</li>
		<li>
			<a href="/commercial-gym-edinburgh/upholstery-repairs/"><img src="/wp-content/themes/chandler/images/I4.jpg"></a>
			<a href="/commercial-gym-edinburgh/upholstery-repairs/">Upholstery</a>
		</li>
		<li>
			<a href="/gym-equipment-servicing-maintenance-contracts-edinburgh/"><img src="/wp-content/themes/chandler/images/I5.jpg"></a>
			<a href="/gym-equipment-servicing-maintenance-contracts-edinburgh/">Service &amp; Maintenance Contracts</a>
		</li>
		<li>
			<a href="/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/"><img src="/wp-content/themes/chandler/images/I6.jpg"></a>
			<a href="/gym-equipment-servicing-maintenance-contracts-edinburgh/delivery-installations-relocation/">Delivery, Installation &amp; Relocation</a>
		</li>
	</ul>
	
	<!--<img src="/wp-content/themes/chandler/images/kurt.png" />-->
	<!--<p id="greenarrow"><a href="/blog/">Chandler Sports Blog</a></p>-->
	
	<?php the_content(); ?>

	<!-- <h3>Welcome to Chandler Sports!</h3>
	<p class="kurtmap">Here you'll find a range of services, the latest products and all the information you need to help you find what you are looking for.</p> -->
	 
	
	<br  style="clear: both;" />
	
</div>

<div id="homeproducts" class="col-lg-6 col-xs-12 col-sm-6 col-md-6 home-products-outer" style="display:none;">
	<?php if(get_field('products') != NULL): ?>
		<?php $i=1; while(the_repeater_field('products')): ?>
			<div class="col-lg-4 col-xs-12 col-sm-6 col-md-4 aproduct aproduct<?php echo $i; ?>">
				<a href="<?php echo get_sub_field('buy_link'); ?>"><img class="img-responsive" src="<?php echo get_sub_field('image'); ?>" border="0" /></a>
				<h3><a href="<?php echo get_sub_field('buy_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
				
				<div class="abuy">
					<a href="<?php echo get_sub_field('buy_link'); ?>">Buy</a>
					<br style="clear: both;" />
					<?php if(get_sub_field('sale_price')): ?><strike><?php endif; ?><?php echo get_sub_field('rrp'); ?><?php if(get_sub_field('sale_price')): ?></strike><?php endif; ?><br />
					<?php if(get_sub_field('sale_price')): ?>
						<span class="bigred">Sale <?php echo get_sub_field('sale_price'); ?></span><br />
					<?php endif; ?>
				</div>
				
				<?php if(get_sub_field('hire_link') != NULL): ?>
					<div class="ahire">
						<a href="<?php echo get_sub_field('hire_link'); ?>">Hire</a>
						<br style="clear: both;" />
						<span><?php echo get_sub_field('hire_price'); ?><i>per week</i></span>
					</div>
				<?php endif; ?>
				
				<p><?php echo get_sub_field('kurt_says'); ?></p>
				
			</div>
			
		<?php $i++; endwhile; ?>
	<?php endif; ?>
</div>

</div><!-- Outside Kurt Home Products-->



<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 fitness-equipment-outer">				
		<!--<h2>Home Fitness Equipment</h2>-->
		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 fitness-row">
		<?php if(get_field('home_fitness_equipment') != NULL): ?>
			<?php $i=1; while(the_repeater_field('home_fitness_equipment')): ?>
				<div class="col-lg-3 col-xs-12 col-sm-3 col-md-3 fitness<?php echo $i; ?>">
					<a href="<?php echo get_sub_field('page_link'); ?>"><img class="img-responsive" src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
					<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<?php 
							/*if(get_sub_field('home_product_categories')):
								echo '<ul class="childfit">';
								//echo '<li>View all '.get_sub_field('title').'</li>';
								$child = get_sub_field('home_product_categories'); 
								foreach($child as $aterm):
									$term = get_term($aterm, 'product_cat'); 
									$alink = get_term_link($term);
									
									//echo '<li><a href="'.$alink.'">'.$term->name.'</a></li>';
									echo '<li>'.$term->name.'</li>';
								endforeach;
								echo '</ul>';
							endif;*/
						?>
				</div>
			<?php if($i==4): $i=1; echo '<br style="clear: both;" />'; else: $i++; endif; endwhile; ?>
		<?php endif; ?>
	</div>
</div>	
<?php if(get_field('commercial_gym_supply') != NULL): ?>
<div class="commercial-fitness col-lg-12 col-xs-12 col-sm-12 col-md-12">				
<h2>Commercial Gym Supply</h2>

<?php $closed = true; $i=1; while(the_repeater_field('commercial_gym_supply')): ?>
	<?php 
	if( $i == 1 ){ echo '<div  class="col-lg-12 col-xs-12 col-sm-12 col-md-12 fitness_row_commercial">'; $closed = false; }
	?>
	<div class="col-lg-3 col-xs-12 col-sm-3 col-md-3 fitness<?php echo $i; ?>">
		<a href="<?php echo get_sub_field('page_link'); ?>"><img class="img-responsive" src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>" border="0" /></a>
		<h3><a href="<?php echo get_sub_field('page_link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
			<?php 
				if(get_sub_field('commercial_product_category')):
					echo '<ul class="childfit">';
					$child = get_sub_field('commercial_product_category'); 
					foreach($child as $aterm):
		  				$term = get_term($aterm, 'product_cat'); 
						$alink = get_term_link($term);

						//echo '<li><a href="'.$alink.'">'.$term->name.'</a></li>';
						echo '<li>'.$term->name.'</li>';
					endforeach;
					echo '</ul>';
				endif;
			?>
	</div>
	<?php
	if( $i == 4 ){ echo "</div>"; $closed = true; }
	?>
<?php if($i==4): $i=1; else: $i++; endif; endwhile; ?>
<?php
if( !$closed ){ echo "</div>"; }
?>
	
</div>	
<?php endif; ?>

<?php endwhile; ?>

<div id="promises" class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p>Best Price Promise | Call for our best deal</p>
	<span class="greendot"></span>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p>Get expert advice on fitness equipment</p>
	<span class="greendot"></span>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-12 col-md-4 no-padding">
	<p class="last-child">Installation Service available UK wide</p>
	</div>
</div>

<style>
#navigation {
  margin-top: 35px;
}.navbar {
  border: 1px solid transparent;
  margin-bottom: 20px;
  min-height: 0px;
  position: static;
}
</style>

<?php get_footer(); ?>