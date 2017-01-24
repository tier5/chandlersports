<?php 
get_header();

 if (have_posts()) 
 {
    while (have_posts())  
    {
        art_page_navi();
        art_post();
        comments_template();
    }
    art_page_navi();
 } else {    
        art_post_box(
            __('Not Found', 'kubrick'),
            '<p class="center">' .  __('Sorry, but you are looking for something that isn&#8217;t here.', 'kubrick') . '</p>'
            .  "\r\n" . art_get_search());
 }

get_footer(); 