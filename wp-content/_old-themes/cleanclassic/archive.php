<?php 
get_header(); 
if (have_posts()) 
{
	$post = $posts[0];
	$title = '';
	if (is_category()){
		$title .= single_cat_title('', false);
	} elseif( is_tag() ) {
		$title .= sprintf(__('Posts Tagged &#8216;%s&#8217;', 'kubrick'), single_tag_title('', false) );
	} elseif( is_day() ) {
		$title .= sprintf(_c('Archive for %s|Daily archive page', 'kubrick'), get_the_date());
	} elseif( is_month() ) {
		$title .= sprintf(_c('Archive for %s|Monthly archive page', 'kubrick'), get_the_date('F Y'));
	} elseif( is_year() ) {
		$title .= sprintf(_c('Archive for %s|Yearly archive page', 'kubrick'), get_the_date('Y'));
	} elseif( is_author() ) {
		$title .= __('Author Archive', 'kubrick');
	} elseif( isset($_GET['paged']) && !empty($_GET['paged']) ) {
		$title .= __('Blog Archives', 'kubrick');
	}
	art_page_navi($title);
    while (have_posts())  
    {
        art_post();
    }
    art_page_navi();
} else {    
	$title = '';
	if ( is_category() ) {
		$title .= sprintf(__("Sorry, but there aren't any posts in the %s category yet.", "kubrick"), single_cat_title('',false));
	} else if ( is_date() ) { 
		$title .= __("Sorry, but there aren't any posts with this date.", "kubrick");
	} else if ( is_author() ) { 
		$userdata = get_userdatabylogin(get_query_var('author_name'));
		$title .= sprintf(__("Sorry, but there aren't any posts by %s yet.", "kubrick"), $userdata->display_name);
	} else {
		$title .= __('No posts found.', 'kubrick');
	}
    art_post_box(
        $title,
		'<p class="center">' .  __('No posts found. Try a different search?', 'kubrick') . '</p>'
        .  "\r\n" .art_get_search());
}
 
get_footer(); 
