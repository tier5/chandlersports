<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

if( !function_exists( 'debug' ) ){
	/**
	 * @param mixed $var
	 * @param string $tag
	*/
	function debug( $var, $tag = 'pre' ){
		echo "<{$tag}>";
		print_r( $var );
		echo "</{$tag}>";
	}
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	register_nav_menus( array(
		'top' => __( 'Top Navigation', 'twentyten' ),
	) );


	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		'default-color' => 'f1f1f1',
	) );

	// The custom header business starts here.

	$custom_header_support = array(
		// The default image to use.
		// The %s is a placeholder for the theme template directory URI.
		'default-image' => '%s/images/headers/path.jpg',
		// The height and width of our custom header.
		'width' => apply_filters( 'twentyten_header_image_width', 940 ),
		'height' => apply_filters( 'twentyten_header_image_height', 198 ),
		// Support flexible heights.
		'flex-height' => true,
		// Don't support text inside the header image.
		'header-text' => false,
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'twentyten_admin_header_style',
	);

	add_theme_support( 'custom-header', $custom_header_support );

	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR', '' );
		define( 'NO_HEADER_TEXT', true );
		define( 'HEADER_IMAGE', $custom_header_support['default-image'] );
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
		add_custom_image_header( '', $custom_header_support['admin-head-callback'] );
		add_custom_background();
	}

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	// ... and thus ends the custom header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'twentyten' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'twentyten' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'twentyten' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'twentyten' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'twentyten' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'twentyten' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'twentyten' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If header-text was supported, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

if ( ! function_exists( 'twentyten_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	//return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	//return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'twentyten' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area-2', 'twentyten' ),
		'id' => 'footer-widget-area-2',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area-3', 'twentyten' ),
		'id' => 'footer-widget-area-3',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3><div class="widget-line"></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area-4', 'twentyten' ),
		'id' => 'footer-widget-area-4',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );

        register_sidebar( array(
		'name' => __( 'cart-box', 'twentyten' ),
		'id' => 'cart-box',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );


        register_sidebar( array(
		'name' => __( 'header-topbar-center', 'twentyten' ),
		'id' => 'header-topbar-center',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );


        register_sidebar( array(
		'name' => __( 'header-topbar-phone', 'twentyten' ),
		'id' => 'header-topbar-phone',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<div id="%1$s" class="widget widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-line"></div>',
	) );


}


/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentyten' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Posted in %1$s', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Posted in %1$s', 'twentyten' );
	} else {
		//$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


function customiseFormLabels($addressTypes, $formID) {
	$addressTypes['international']['zip_label'] = 'Post Code';
	$addressTypes['international']['state_label'] = 'County';
	return $addressTypes;
}

// Use this one to change all gravity address forms to be more British
add_filter('gform_address_types', 'customiseFormLabels', 10, 2);

//add_action('woocommerce_after_shop_loop_item', 'my_print_stars' );


function my_print_stars(){
	    global $wpdb;
	    global $post;
	    $count = $wpdb->get_var("
	    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
	    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	    WHERE meta_key = 'rating'
	    AND comment_post_ID = $post->ID
	    AND comment_approved = '1'
	    AND meta_value > 0
	");

	$rating = $wpdb->get_var("
	    SELECT SUM(meta_value) FROM $wpdb->commentmeta
	    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	    WHERE meta_key = 'rating'
	    AND comment_post_ID = $post->ID
	    AND comment_approved = '1'
	");
	echo '<div class="ratingsstar">';
	if ( $count > 0 ) {

		$average = number_format($rating / $count, 2);
		$rate = explode('.', $average);
		if($rate[0] == 1):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 2):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 3):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 4):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 5):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;

	}
	echo '</div>';

}

function my_print_starss(){
	    global $wpdb;
	    global $post;
	    $count = $wpdb->get_var("
	    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
	    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	    WHERE meta_key = 'rating'
	    AND comment_post_ID = $post->ID
	    AND comment_approved = '1'
	    AND meta_value > 0
	");

	$rating = $wpdb->get_var("
	    SELECT SUM(meta_value) FROM $wpdb->commentmeta
	    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	    WHERE meta_key = 'rating'
	    AND comment_post_ID = $post->ID
	    AND comment_approved = '1'
	");

	if ( $count > 0 ) {
		echo '<div class="ratingsstar">';
		$average = number_format($rating / $count, 2);
		$rate = explode('.', $average);
		if($rate[0] == 1):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 2):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 3):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 4):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gray_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;


		if($rate[0] == 5):
			echo '	<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
					<img src="/wp-content/themes/chandler/images/gold_star.png" class="astar" />
			';
			echo '<br /><span style="font-size: 10px;">('.$count.' customer '; if($count == 1): echo 'review'; else: echo 'reviews'; endif; echo ')</span>';
		endif;
	echo '</div>';
	echo '<br style="clear: both;" /><br style="clear: both;" />';
	}

}

// hire form
add_action("gform_after_submission", function($entry, $form) {

	// get the entry IDs from the form
    $total_form_id = null;
    $shipping_form_id = null;
    foreach($form['fields'] as $field) {
        if($field['label'] == 'Hire Period') {
            $hireperiod_form_id = $field['id'];
	}
        if($field['label'] == 'Delivery & Collection') {
            $shipping_form_id = $field['id'];
        }
        if($field['label'] == 'Total') {
            $total_form_id = $field['id'];
        }
    }

    // get the shipping from the form entry (stripping non-numeric chars from value)
    $shipping = isset($entry[$shipping_form_id]) ? preg_replace("/([^0-9\\.])/i", "",$entry[$shipping_form_id]) : 0;

    // get the hire period
    $period = '';
    if(isset($entry[$hireperiod_form_id])) {
	$matches = array();
	if(preg_match("/(^[0-9]+ weeks)/i", $entry[$hireperiod_form_id], $matches)) {
		$period = $matches[1];
        }
    }

    // get the total & the hire price
    if(isset($entry[$total_form_id])) {
        $total = isset($entry[$total_form_id]) ? preg_replace("/([^0-9\\.])/i", "",$entry[$total_form_id]) : 0;
        if($total > $shipping) {
            $price = $total - $shipping;

            // the post is our product
            global $woocommerce;
            $post = get_post($entry["post_id"]);

            // add to cart at total price with product price and shipping as item meta
            $woocommerce->cart->add_to_cart($post->ID, $quantity = 1, $variation_id = '', $variation = $entry[$total_form_id], $cart_item_data = array(
                //'chandler_hire_price'=>$price[1],
                'chandler_hire_price'=>$price,
                'chandler_hire_shipping'=>$shipping,
                'chandler_hire_period'=>$period,
            ));
        }
    }
}, 10, 2);

// make sure hire price sticks
add_action('woocommerce_get_cart_item_from_session', function($cart_item, $values) {
    if (isset($values['chandler_hire_price'])) {
        $cart_item['chandler_hire_price'] = $values['chandler_hire_price'];
        $cart_item['chandler_hire_shipping'] = $values['chandler_hire_shipping'];
        $cart_item['chandler_hire_period'] = $values['chandler_hire_period'];
    }
    return $cart_item;
}, 10, 2);

// set teh hire price in the cart
add_action('woocommerce_before_calculate_totals', function($cart_object) {
    foreach ( $cart_object->cart_contents as $key => $value ) {
        if(isset($value['chandler_hire_price']) && $value['chandler_hire_price']) {
            $value['data']->price = $value['chandler_hire_price'];
            if(isset($value['chandler_hire_shipping']) && $value['chandler_hire_shipping']) {
                $value['data']->price += $value['chandler_hire_shipping'];
            }
        }
    }
});

// save the hire price data in the item
add_filter('woocommerce_get_item_data', function($other_data, $cart_item) {
    if(isset($cart_item['chandler_hire_price']) && $cart_item['chandler_hire_price']) {
        $other_data[] = array('name' => 'Hire Price', 'value' => woocommerce_price($cart_item['chandler_hire_price']));
    }
    if(isset($cart_item['chandler_hire_shipping']) && $cart_item['chandler_hire_shipping']) {
        $other_data[] = array('name' => 'Hire Delivery & Collection', 'value' => woocommerce_price($cart_item['chandler_hire_shipping']));
    }
    if(isset($cart_item['chandler_hire_period']) && $cart_item['chandler_hire_period']) {
        $other_data[] = array('name' => 'Hire Period', 'value' => ($cart_item['chandler_hire_period']));
    }
    return $other_data;
}, 10, 2);

// save the extra data to the order
add_action('woocommerce_order_item_meta', function($item_meta, $cart_item) {
    if(isset($cart_item['chandler_hire_price']) && $cart_item['chandler_hire_price']) {
        $item_meta->add('Hire Price', $cart_item['chandler_hire_price']);
    }
    if(isset($cart_item['chandler_hire_shipping']) && $cart_item['chandler_hire_shipping']) {
        $item_meta->add('Hire Delivery & Collection', $cart_item['chandler_hire_shipping']);
    }
    if(isset($cart_item['chandler_hire_period']) && $cart_item['chandler_hire_period']) {
        $item_meta->add('Hire Period', $cart_item['chandler_hire_period']);
    }
}, 10, 2);


// add a meta box for setting the hire form in a product
add_action('add_meta_boxes', function() {
    global $post;
    add_meta_box('woocommerce-hireforms-meta', 'Hire Form', 'hireform_meta_box', 'product', 'normal', 'default');
});

// this is the meta box code for the hire form
function hireform_meta_box($post) {
    ?>
    <style>
        #woocommerce-hireforms-meta .inside{padding:0;margin:0;}
    </style>

    <div class="woocommerce_hireforms panel-wrap product_data woocommerce">

        <div id="hireform_data" class="panel woocommerce_options_panel">

            <?php
            $hireform_id= get_post_meta($post->ID, '_hireform_id', true);

            $hireform = NULL;
            if (is_numeric($hireform_id)) {

                $form_meta = RGFormsModel::get_form_meta($hireform_id);

                if (!empty($form_meta)) {
                    $hireform = RGFormsModel::get_form($hireform_id);
                }
            }
            ?>
            <div class="options_group">
                <p class="form-field">
                    <label for="hireform-id"><?php _e('Choose Form', 'wc_hireforms'); ?></label>
                    <?php
                    echo '<select id="hireform-id" name="hireform-id"><option value="">' . __('None', 'wc_gf_addons') . '</option>';
                    foreach (RGFormsModel::get_forms() as $form) {
                        echo '<option ' . selected($form->id, $hireform_id) . ' value="' . sanitize_title($form->id) . '">' . wptexturize($form->title) . '</option>';
                    }
                    echo '</select>';
                    ?>
                </p>

            </div>

            <div class="options_group" style="padding: 0 9px;">
                <?php if (!empty($hireform) && is_object($hireform)) : ?>
                    <h4><a href="<?php printf('%s/admin.php?page=gf_edit_forms&id=%d', get_admin_url(), $hireform->id) ?>" class="edit_hireform">Edit <?php echo $hireform->title; ?> Hire Form</a></h4>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php
}

// processes the hire form meta box submissions
add_action('woocommerce_process_product_meta', function($post_id, $post) {
    // Save hire form as serialised array
    if (isset($_POST['hireform-id']) && !empty($_POST['hireform-id'])) {
        update_post_meta($post_id, '_hireform_id', $_POST['hireform-id']);
    } else {
        delete_post_meta($post_id, '_hireform_id');
    }
}, 1, 2);

// utility function to display the hire form is one is set on the product
function chandler_hireform() {
    global $post;

    if($hireform_id = get_post_meta($post->ID, '_hireform_id', true)) {
    ?>
        <br style="clear: both;" />
        <a class="toggle_hire hire">Click Here For Hire Options</a>
        <div class="toggle_form" style="display: none;">
	        <h2>Hire Form</h2>
	        <div class="container">
		        <div class="row">
			        <div class="col-xs-12">
		                <?php echo do_shortcode('[gravityform id='.$hireform_id.' title=false description=false]'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    <?php
    }

    if(get_field('hire_prices') != NULL):
    	//echo do_shortcode('[gravityform id='.$hireform_id.' title="false" description="false" field_values="pricelist=test|1,test|2"]');
    endif;

}

// dynamically add hire periods to the hire form

// see: http://www.gravityhelp.com/documentation/page/Gform_pre_render
add_filter("gform_pre_render", "add_hire_periods");
//add_filter("gform_admin_pre_render", "add_hire_periods");
add_filter('gform_pre_submission_filter', 'add_hire_periods');
function add_hire_periods($form){

	if($form["id"] != 10) return $form;

	$hire_prices = get_field('hire_prices');
	if($hire_prices && is_array($hire_prices)) {

		$items = array();

		foreach($form["fields"] as &$field) {
			// if the field is called Hire Period
			// and we have hire periods
			// then add them instead of the configured choices
			if($field["label"] == 'Hire Period'){
				if(count($hire_prices) > 0) {
					foreach($hire_prices as $price) {
						//$price['price'] = str_replace('� ', ' �', $price['price']);
						$items[] = array(
							"text" => $price['term'],
							"value" => $price['term'],
							"price" =>$price['price'],
						);
					}
					//var_dump($field["choices"]);
					$field["choices"] = $items;
					break;
				}
			}
		}

	}

	return $form;
}

add_action('woocommerce_before_single_product', function() {
?><script type="text/javascript">
function gform_format_option_label(label, original_label, price_label, current_price, price, form_id, field_id) {
    //ignore all forms, except the one with ID = 10
    if(form_id == 10 && field_id == 3) {
        //changing label
        label = original_label;
        /* grrrr
        var diff = gformGetPriceDifference(current_price, price);
        diff = gformToNumber(diff) == 0 ? "" : " " + diff;
        var price_label = " " + diff;
        label = original_label + price_label.replace(/(\+)/, "$1 ");
        */
    }
    return label;
}
</script><?php
}, 30);




add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
function wc_loop_shop_columns( $number_columns ) {
	return 5;
}


/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

Class BeRocket_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 5;
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			echo $before_widget;
			if( $title ) echo $before_title . $title . $after_title; ?>

			<div class="br-controls"><div class="br-buttons"><div class="br-prev"></div><div class="br-next"></div></div></div>

			<div class="br-recent-posts-slider">
				<div class="br-recent-posts-wrapper">
					<?php
					$saved_post = '';
					while( $r->have_posts() ) :
						$r->the_post();
						$echo = '<div class="post-item">
									<a title="'.get_the_title().'" class="post-item-image" href="'.get_permalink().'">
										'.get_the_post_thumbnail( $r->post->ID, array( 300, 300 ) ).'
									</a>
									<div class="post-title">
										<a title="'.get_the_title().'" href="'.get_permalink().'">'.get_the_title().'</a>
									</div>
									<p>'.get_the_excerpt().'</p>
									<div class="entry-meta clearfix">
										<div class="left">
											<a title="'.get_the_title().'" href="'.get_permalink().'" class="read-more">Read More</a>
										</div>
										<div class="right">
											<span class="meta-date">'.get_the_date().'</span>
										</div>
										<div class="clear"></div>
									</div>
								</div>';

						if( !$saved_post ){
							$saved_post = $echo;
						}else{
							echo '<div class="slide">'.$saved_post.$echo.'</div>';
							$saved_post = '';
						}
					endwhile;
					?>
				</div>
			</div>

			<?php
			echo $after_widget;
			wp_reset_postdata();
		endif;
	}
}
function berocket_recent_widget_registration() {
	unregister_widget('WP_Widget_Recent_Posts');
	register_widget('BeRocket_Recent_Posts_Widget');
}
add_action('widgets_init', 'berocket_recent_widget_registration');




function pagination($pages = '', $range = 4)
{
	$showitems = ($range * 2)+1;

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}

	if(1 != $pages)
	{
		echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
		//&& $paged > $range+1 && $showitems < $pages
		//&& $showitems < $pages
		if($paged > 2 ) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 ) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
			}
		}
		//&& $showitems < $pages
		//&&  $paged+$range-1 < $pages && $showitems < $pages
		if ($paged < $pages ) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
		if ($paged < $pages-1 ) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
	}
}

class WPBR_938753_Custom_Walker extends Walker_Page {
	function start_el( &$output, $page, $depth, $args, $current_page = 0, $request_type = 'post' ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';
		$css_class = array('page_item', 'page-item-'.$page->ID, 'widgett');
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		}
		elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$icon_class = get_post_meta($page->ID, 'icon_class', true); //Retrieve stored icon class from post meta

		$output .= $indent . '<div class="' . $css_class . '">';
		$output .= '<div class="imgholder"><a href="' . get_permalink($page->ID) . '" rel="bookmark">';

		if( $request_type == 'post' ) {
			if( has_post_thumbnail( $page->ID ) ){
				$output .= get_the_post_thumbnail( $page->ID, array( 90, 600 ) );}
			else{
				$image = apply_filters( 'woocommerce_placeholder_img_src', plugins_url( '/woocommerce/assets/images/placeholder.png', 'woocommerce' ) );
				$image = str_replace( ' ', '%20', $image );
				$output .= '<img class="sidebar-item-image" src="' . esc_url( $image ) . '" alt="' . esc_attr( $page->title ) . '" height="60" width="90" />';
			}

		}else{
			$thumbnail_id_woo = get_woocommerce_term_meta( $page->object_id, 'thumbnail_id', true  );
			$thumbnail_id=get_post_meta($page->ID,'_thumbnail_id','true');
			if ( $thumbnail_id ) {
				$image = wp_get_attachment_image_src( $thumbnail_id, array( 90, 60 ) );
				$image = str_replace( ' ', '%20', $image[0] );
				$output .= '<img class="sidebar-item-image" src="' . esc_url( $image ) . '" alt="' . esc_attr( $page->title ) . '" />';
			} else {
				$image = apply_filters( 'woocommerce_placeholder_img_src', plugins_url( '/woocommerce/assets/images/placeholder.png', 'woocommerce' ) );
				$image = str_replace( ' ', '%20', $image );
				$output .= '<img class="sidebar-item-image" src="' . esc_url( $image ) . '" alt="' . esc_attr( $page->title ) . '" height="60" width="90" />';
			}
		}
		$output .= '</div><div class="wttitle"><h4><a href="' . get_permalink($page->ID) . '" rel="bookmark">';
		$output .= $args->link_before;

		if($icon_class){ //Test if $icon_class exists
			$output .= '<span class="' . $args->icon_class . '"></span>'; //If it exists output a span with the $icon_class attached to it
		}

		$output .= apply_filters( 'the_title', ( ($request_type == 'post')?$page->post_title:$page->title), $page->ID );
		$output .= $args->link_after. '</a></h4></div>';

		if ( !empty($args->show_date) ) {
			if ( 'modified' == $args->show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;
			$output .= " " . mysql2date($args->date_format, $time);
		}
	}

	function end_el( &$output, $object ){
		$output .= "</div>";
	}
}

class WPBR_938753_POST_Custom_Walker extends WPBR_938753_Custom_Walker {

	function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {
		parent::start_el( $output, $page, $depth, $args, $current_page );
	}
}

class WPBR_938753_PROD_CAT_Custom_Walker extends WPBR_938753_Custom_Walker {

	function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {
		parent::start_el( $output, $page, $depth, $args, $current_page, 'prod_cat' );
	}
}

add_filter('body_class','browser_body_class');

function browser_body_class($classes = '') {
	if( is_page() )
		$classes[] = 'blog';

	return $classes;
}

// Register our tweaked Category Archives widget
function berocket_widgets_init() {
	register_widget( 'WP_Widget_Categories_custom' );
}
add_action( 'widgets_init', 'berocket_widgets_init' );

/**
 * Tweaked WP core Categories widget class
 */
class WP_Widget_Categories_Custom extends WP_Widget_Categories{

	function widget( $args, $instance ){
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories Custom', 'mytextdomain'  ) : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<ul>
			<?php

			$args = array(
				'orderby'       => 'name',
				'order'         => 'ASC',
				'show_count'    => 0,
				'title_li'      => '',
				'exclude'       => '',
				'echo'          => 1,
				'depth'         => 2,
				'walker'        => new WPBR_w342e_Custom_Walker
			);

			wp_list_categories( $args );
			?>
		</ul>
		<?php
		echo $after_widget;
	}
}

class WPBR_w342e_Custom_Walker extends Walker_Category{
	function start_lvl( &$output, $depth = 0, $args = array() ){
		if ( 'list' != $args['style'] )
			return;
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<span class='arrow'></span><ul class='children'>\n";
	}
}



function url_shortcode() {
return get_bloginfo('url');
}
add_shortcode('url','url_shortcode');





function Client_theme_customizer( $wp_customize ) {

   $wp_customize->add_section( 'Client_logo_section' , array(
    'title'       => __( 'Logo', 'Client' ),
    'priority'    => 30,

    'description' => 'Upload a logo to replace the default site name and description in the header',
) );

   $wp_customize->add_setting( 'Client_logo' );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Client_logo', array(
    'label'    => __( 'Logo', 'Client' ),
    'section'  => 'Client_logo_section',
    'settings' => 'Client_logo',

) ) );


}
add_action('customize_register', 'Client_theme_customizer');

add_theme_support('post-thumbnails');




/* BIG SPRING ADDITIONS */

// Add custom style

function add_custom_style() {
  wp_enqueue_style( 'bigspring-style', get_template_directory_uri() . '/css/custom.css' );
  wp_enqueue_script( 'masonry' );
}
add_action( 'wp_enqueue_scripts', 'add_custom_style' );

// Remove WC styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb
add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

function woocommerce_template_product_description() {
woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_product_description', 10 );

/* Add new widget area in footer */

function new_footer_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Widget Area-5',
		'id'            => 'ooter-widget-area-5'
	) );

}
add_action( 'widgets_init', 'new_footer_widgets_init' );
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<i class="fa fa-chevron-left"></i> Newer Posts'),
    'next_text'       => __('older post <i class="fa fa-chevron-right"></i>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}
function get_categories_with_images($post_id,$separator ){
     
    //first get all categories of that post
    $post_categories = wp_get_post_categories( $post_id );
    $cats = array();
     
    foreach($post_categories as $c){
        $cat = get_category( $c );
        $cat_data = get_option("category_$c");
         
        //and then i just display my category image if it exists
        $cat_image = '';
        if (isset($cat_data['img'])){
            $cat_image = '<img src="'.$cat_data['img'].'">';
        }
        $cats[] =  $cat_image . '<a href="'.get_category_link( $c ) . '">' .$cat->name .'</a>';
    }
    return implode($separator , $cats);
}
function get_related_author_posts() {
    global $authordata, $post;

    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

    $output = '<ul>';
    foreach ( $authors_posts as $authors_post ) {
        $output .= '<li><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
    }
    $output .= '</ul>';

    return $output;
}
function wpse_modify_category_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_category() ) {
            $query->set( 'posts_per_page', 9 );
        } 
        if ( $query->is_archive() ) {
            $query->set( 'posts_per_page', 9 );
        }
        
    } 
}
add_action( 'pre_get_posts', 'wpse_modify_category_query' );
function rudr_instagram_api_curl_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}