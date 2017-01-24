<?php 
get_header(); 

 if (have_posts()) 
 {
		art_page_navi(__('Search Results', 'kubrick'));
        while (have_posts())  
        {
            art_post();
        }
        art_page_navi();
 } else {   
	    art_post_box(__('Search Results', 'kubrick'),
            '<p class="center">' .  __('No posts found. Try a different search?', 'kubrick') . '</p>'
            .  "\r\n" . art_get_search());
 }
 
get_footer(); 