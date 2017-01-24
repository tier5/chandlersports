<?php


function ilgelo_infinitescroll(){
    $paged=1;
    $cate="*";
    $numpost=get_option('posts_per_page');
    $rnd=0;
    if (isset($_POST['page_no'])) {
    	$paged = $_POST['page_no'];
    }
    if (isset($_POST['c'])) {
    	$cate = $_POST['c'];
    }
    if (isset($_POST['np'])) {
    	$numpost = $_POST['np'];
    }
    if (isset($_POST['rnd'])) {
    	$rnd = $_POST['rnd'];
    }

	$args = array(
	  'post_type' => 'post',
	  'posts_per_page' => $numpost,
	  'paged' => $paged,
	  'post_status' => 'publish'
	);
    query_posts($args);

   	get_template_part("include/loop", "index");
    die();
}
add_action("wp_ajax_ilgelo_infinitescroll", "ilgelo_infinitescroll");
add_action("wp_ajax_nopriv_ilgelo_infinitescroll", "ilgelo_infinitescroll");


/* HOME POST GALLERY */
function ilgelo_postgallery(){
	get_template_part("include/slide-posts/slidepost");
    die();
}
add_action("wp_ajax_ilgelo_postgallery", "ilgelo_postgallery");
add_action("wp_ajax_nopriv_ilgelo_postgallery", "ilgelo_postgallery");

