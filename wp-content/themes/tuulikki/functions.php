<?php
/* ==================================================
Functions - Tuulikki
================================================== */


//==========================================================================
//=========================  Ilgelo Customizer  ============================
//==========================================================================


require_once(TEMPLATEPATH . '/framework/customizer/ilgelo_custom_controller.php');
require_once(TEMPLATEPATH . '/framework/customizer/ilgelo_customizer_settings.php');
require_once(TEMPLATEPATH . '/framework/customizer/ilgelo_customizer_style.php');
require_once(TEMPLATEPATH . '/include/functions-ajax.php');
require_once(TEMPLATEPATH . '/framework/php/library.php');

function ig_wpadmin_head() {


	// Custom CSS wp Customize
	wp_enqueue_style('customcss', get_template_directory_uri().'/framework/customizer/css/customizer.css');

	wp_enqueue_script('customcss');

}
add_action('admin_init', 'ig_wpadmin_head');



//==========================================================================
//=========================  Ilgelo WooCommerce  ============================
//==========================================================================




require_once(TEMPLATEPATH . '/framework/woocommerce/includes/functions.php');




//==========================================================================
//=========================  Infinite Sidebar  =============================
//==========================================================================



require_once(TEMPLATEPATH . '/framework/sidebar/ThemeAdmin.php');
require_once(TEMPLATEPATH . '/framework/sidebar/ThemeSidebar.php');



//==========================================================================
//=============================== MENU =====================================
//==========================================================================




register_nav_menus( array(
		'primary_menu' => __( 'Main Menu', 'ilgelo' ),
		'secondary_menu' => __( 'Secondary Menu', 'ilgelo' ),
		'mini_scroll_menu' => __( 'Menu on Scroll', 'ilgelo' ),
		'mobile_menu' => __( 'Menu Mobile', 'ilgelo' ),
		'woo_menu' => __( 'Shop Menu', 'ilgelo' ),

	));



//==========================================================================
//================================= DEMO IMPORT ============================
//==========================================================================

function ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => 'Demo Import 1',
            'import_file_url'            => get_template_directory_uri() . '/framework/demo_import/demo1/tuulikki_demo1.xml',

          'import_widget_file_url'     =>  get_template_directory_uri() . '/framework/demo_import/demo1/widgets_demo1.json',

            'import_customizer_file_url' => get_template_directory_uri() . '/framework/demo_import/demo1/tuulikki_customize_demo1.dat',


            'import_notice'              => __( 'After importing this demo, you will have to set up the Slide Post and Promo Box separately.<br>
<b>To activate your Slide Post, we recommend reading the tutorial at this <a target="_blank" href="http://sparrowandsnow.com/tuulikki/documentation/active-post-slider/">link</a></b>.<br>
<b>To activate your Promo Box, we suggest reading the tutorial at this <a target="_blank" href="http://sparrowandsnow.com/tuulikki/documentation/create-promo-boxes/">link</a></b>.', 'ilgelo' ),

        ),



    );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );


/* ========== Import Menu ========== */

function dgwork_after_import( $selected_import ) {

    if ( 'Demo Import 1' === $selected_import['import_file_name'] ) {
		$scroll_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$primary_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$secondary_menu = get_term_by( 'name', 'Secondary menu', 'nav_menu' );
		$mobile_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$woo_menu = get_term_by( 'name', 'E-commerce Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'mini_scroll_menu' => $scroll_menu->term_id,
			'primary_menu' => $primary_menu->term_id,
			'secondary_menu' => $secondary_menu->term_id,
			'mobile_menu' => $mobile_menu->term_id,
			'woo_menu' => $woo_menu->term_id,
		));

	}

}
add_action( 'pt-ocdi/after_import', 'dgwork_after_import' );


/* ========== Intro Text ========== */

function ocdi_plugin_intro_text( $default_text ) {
    $default_text .= '
    “Import Demo Data” lets you upload pages, posts, images, widgets, and theme settings (colors and layouts) with just 1 clicks!<br>
- Click once more on the button “Import Demo Data.”<br>
This is the easiest way to set up your theme. It will enable you to make changes quickly and easily, instead of creating contents from scratch. <br><br>

Note:<br>
1) Should it happen that, after importing the theme, you can no longer see posts, pages, or images, please do not click the “Import Demo Data” button again. Click once and wait – it may take a couple of minutes. <br>
2) Should you get any error messages, make sure that your server is properly configured: Memory Limit > =64MB and Execution>=60<br>
    ';

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );


/* ========== Hide Standard Text ========== */

add_action( 'admin_head', 'cn_admin_customize' );
function cn_admin_customize() {

 ?>
<style type="text/css" media="screen">
.ocdi__intro-text

{display:none;}
</style>

<?php
}




//==========================================================================
//=========================== WIDGET ACTIVATION ============================
//==========================================================================


require_once(get_template_directory().'/framework/widget/widget.php' );


//==========================================================================
//=========================== PLUGIN ACTIVATION ============================
//==========================================================================


require_once(get_template_directory().'/framework/plugin-activation/init.php' );



//==========================================================================
//=========================== Textdomain ===================================
//==========================================================================


load_theme_textdomain('ilgelo', get_template_directory() . '/languages');



//==========================================================================
//===================== LOAD SCRIPTS =======================================
//==========================================================================


function ilgelo_enqueue_scripts() {


 wp_enqueue_script( 'jquery' );

	if(!get_theme_mod('ig_disable_loading')) {
		wp_enqueue_script('loadingoverlay', get_template_directory_uri().'/framework/assets/js/loadingoverlay.js', array(),'',true);
		wp_enqueue_script('loadingoverlay');

	}

	if(!get_theme_mod('ig_disable_sticky_sider')) {
		wp_enqueue_script('sticky', get_template_directory_uri().'/framework/assets/js/sticky.js', array(),'',true);
		wp_enqueue_script('sticky');

	}




	//JS
	wp_enqueue_script('wow', get_template_directory_uri().'/framework/assets/js/wow.min.js', array(),'',false);
	wp_enqueue_script('plugin', get_template_directory_uri().'/framework/assets/js/plugin.js', array(),'',true);
	wp_enqueue_script('isotope', get_template_directory_uri().'/framework/assets/js/jquery.isotope.js', array(),'',true);
	//wp_enqueue_script('modernizr', get_template_directory_uri().'/framework/assets/js/modernizr.js', array(),'',true);
	wp_enqueue_script('main', get_template_directory_uri().'/framework/assets/js/main.js', array(),'',true);
	wp_enqueue_script('vide', get_template_directory_uri().'/framework/assets/js/jquery.vide.js', array(),'',true);
	wp_enqueue_script('slick', get_template_directory_uri().'/framework/assets/js/slicknew.js', array(),'',true);
	wp_enqueue_script('parallax', get_template_directory_uri().'/framework/assets/js/parallax.min.js', array(),'',true);
	wp_enqueue_script('animsition', get_template_directory_uri().'/framework/assets/js/jquery.animsition.min.js', array(),'',true);
	wp_enqueue_script('imagesloaded', get_template_directory_uri().'/framework/assets/js/imagesloaded.pkgd.min.js', array(),'',true);



	//JS
	wp_enqueue_script('plugin');
	wp_enqueue_script('isotope');
//	wp_enqueue_script('modernizr');
	wp_enqueue_script('wow');
	wp_enqueue_script('vide');
	wp_enqueue_script('main');
	wp_enqueue_script('slick');
	wp_enqueue_script('parallax');
	wp_enqueue_script('animsition');
	wp_enqueue_script('imagesloaded');

	// Loads the javascript required for threaded comments
	if( is_singular() && comments_open() && get_option( 'thread_comments') )
        wp_enqueue_script( 'comment-reply' );

}
add_action('wp_enqueue_scripts', 'ilgelo_enqueue_scripts');






//==========================================================================
//====================== LOAD STYLES =======================================
//==========================================================================

function ig_enqueue_dynamic_css() {

	//CSS FONT
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/framework/assets/css/fonts/font-awesome/font-awesome.min.css');


	//CSS
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/framework/assets/css/bootstrap.css');
	wp_enqueue_style('ig-responsive', get_template_directory_uri().'/framework/assets/css/ig-responsive.css');
	wp_enqueue_style('animate-css', get_template_directory_uri().'/framework/assets/css/animate.css');
	wp_enqueue_style('animsition-css', get_template_directory_uri().'/framework/assets/css/animsition.min.css');
	wp_enqueue_style('slick', get_template_directory_uri().'/framework/assets/css/slick.css');
if(class_exists('WooCommerce')) {
		wp_enqueue_style('ig_woocommerce', get_template_directory_uri().'/framework/assets/css/ig_woocommerce.css');
	}

	//wp_register_style('main-css', get_stylesheet_directory_uri() . '/style.css');

	//CSS FONT
	wp_enqueue_style('font-awesome');

     // GOOGLE FONT
	wp_enqueue_style('default_body_font', 'http://fonts.googleapis.com/css?family=Merriweather:400,700,latin-ext');
	wp_enqueue_style('default_heading_font', 'http://fonts.googleapis.com/css?family=Montserrat:400,700,latin-ext');
}

add_action('wp_enqueue_scripts', 'ig_enqueue_dynamic_css');

function register_childcss() {
	wp_enqueue_style('main-css', get_stylesheet_directory_uri() . "/style.css");
}
add_action('wp_enqueue_scripts', 'register_childcss', 15);


//==========================================================================
//====================== THEME SUPPORT =====================================
//==========================================================================


	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );


// - 1 Post Slide
	 add_image_size( 'ig_image-1-post', 1900, 525, true);

// - 3 Post Slide Center
	 add_image_size( 'ig_image-3-post', 750, 530, true);

// - 4 Post Slide
	 add_image_size( 'ig_image-4-post', 390, 500, true);

// - List Blog Full
     add_image_size( 'ig_image-list-blog', 500, 600, true);

// - prev Next Post
     add_image_size( 'ig_image-prev-next', 140, 140, true);

// - Related Post
     add_image_size( 'ig_related-post', 280, 185, true);

// - Thumb Post
     add_image_size( 'thumb-post', 1160, 2000, true);

// - Grid Post
     add_image_size( 'grid_column', 560, 9999 );

// - Thumb Widget - ( Recent Posts )
     add_image_size( 'thumb-widget', 80, 99999 );






// Gallery Size

if ( ! isset( $content_width ) )
    $content_width = 890;




//==========================================================================
//===================== SIDEBAR ============================================
//==========================================================================



//Blog Sidebar


	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'Ilgelo' ),
		'id' => 'blog-sidebar',
		'description' => __( 'The blog sidebar left and rigth ', 'ilgelo' ),
		'before_widget' => '<div class="ig_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="tit_widget"><span>',
		'after_title' => '</span></div>',
	) );



// Widget Area below slider/promo box

	register_sidebar( array(
		'name' => esc_html__( 'Area below slider', 'ilgelo' ),
		'id' => 'below-slider-sidebar',
		'description' => esc_html__( 'Widget Area below slider/promo box content perfect for newsletter and text widget', 'ilgelo' ),
		'before_widget' => '<div class="ig-below-area">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );



// Widget Area below post content

	register_sidebar( array(
		'name' => esc_html__( 'Area below post', 'ilgelo' ),
		'id' => 'below-post-sidebar',
		'description' => esc_html__( 'Widget Area below post content perfect for newsletter and text widget', 'ilgelo' ),
		'before_widget' => '<div class="ig-below-area">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );


//Central Instagram Footer
	register_sidebar(array(
		'name' => 'Instagram Footer',
		'id' => 'instagram_footer',
		'before_widget' => '<div id="%1$s" class="instagram-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="instagram-title">',
		'after_title' => '</h4>',
		'description' => 'Use the Instagram widget here. IMPORTANT: For best result select "Large" under "Photo Size" and set number of photos to 6.',
	));



//Footer Sidebar

// 1
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'ilgelo' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'ilgelo' ),
		'before_widget' => '<div class="ig_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="tit_widget"><span>',
		'after_title' => '</span></div>',

	) );

// 2
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'ilgelo' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'ilgelo' ),
	'before_widget' => '<div class="ig_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="tit_widget"><span>',
		'after_title' => '</span></div>',
	) );

// 3
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'ilgelo' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'ilgelo' ),
		'before_widget' => '<div class="ig_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="tit_widget"><span>',
		'after_title' => '</span></div>',
	) );

// 4
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'ilgelo' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'ilgelo' ),
		'before_widget' => '<div class="ig_widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="tit_widget"><span>',
		'after_title' => '</span></div>',

	) );




// Woocommerce Sidebar

if(class_exists('WooCommerce')) {
	register_sidebar( array(
			'name' => __( 'Woocommerce Shop Page', 'ilgelo' ),
			'id' => 'woocommerce-shop-page',
			'description' => __( 'Shop page widget area', 'ilgelo' ),
			'before_widget' => '<div class="ig_widget">',
			'after_widget' => '</div>',
			'before_title' => '<div class="tit_widget"><span>',
			'after_title' => '</span></div>',
		) );

	register_sidebar( array(
			'name' => __( 'Woocommerce Product Page', 'ilgelo' ),
			'id' => 'woocommerce-product-page',
			'description' => __( 'Product page widget area', 'ilgelo' ),
			'before_widget' => '<div class="ig_widget">',
			'after_widget' => '</div>',
			'before_title' => '<div class="tit_widget"><span>',
			'after_title' => '</span></div>',
		) );
}


//==========================================================================
//============================= EXCERPT ====================================
//==========================================================================


function mvc_content_limit($content, $limit) {
 $content = wp_strip_all_tags($content);
 $content = explode(' ', $content, $limit);
 if (count($content)>=$limit) {
  array_pop($content);
  $content = implode(" ",$content).'...';
 } else {
  $content = implode(" ",$content);
 }
 $content = preg_replace('/\[.+\]/','', $content);
 $content = apply_filters('the_content', $content);
 $content = str_replace(']]>', ']]&gt;', $content);
 return $content;
}

//==========================================================================
//================================= ACF ====================================
//==========================================================================

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Tuulikki Panel',
		'menu_title'	=> 'Tuulikki Panel',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Slide Posts',
		'menu_title'	=> 'Slide Posts',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Promo Box',
		'menu_title'	=> 'Promo Box',
		'parent_slug'	=> 'theme-general-settings',
	));

}


require_once(get_template_directory().'/framework/acf/acf-options.php' );





//==========================================================================
//================================= WP TITLE  ==============================
//==========================================================================
/**
 * From Twentyfourteen
 * @return string The filtered title.
 */
function ilgelo_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ilgelo' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'ilgelo_wp_title', 10, 2 );




//==========================================================================
//===========================  FUNCTION POST ===============================
//======================== RELATED POST - AUTHOR ===========================
//==========================================================================


require_once(TEMPLATEPATH . '/include/post-function.php');


//==========================================================================
//================================= LIMIT TAG CLOUD ========================
//==========================================================================


/*
add_filter('widget_tag_cloud_args', 'tag_widget_limit');

//Limit number of tags inside widget
function tag_widget_limit($args){

 //Check if taxonomy option inside widget is set to tags
 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = 5; //Limit number of tags
 }

 return $args;
}

*/


//==========================================================================
//===========================  COMMENTS ====================================
//==========================================================================


function ilgelo_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'ilgelo_excerpt_more' );



function so_comment_button() {

    echo ' <div class="ig-new_buttom textaligncenter"><input name="submit" class="button" type="submit" value="' . esc_html__( 'Post Comment', 'ilgelo' ) . '" /></div>';

}

add_action( 'comment_form', 'so_comment_button' );


?>