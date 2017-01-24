<?php

	if (have_posts()) {
		while (have_posts()) {
			the_post();

			if(get_theme_mod('ig_home_layout') == 'grid') {
				get_template_part('content', 'grid');

			} elseif (get_theme_mod('ig_home_layout') == 'list') {
				get_template_part('content', 'list');

			} elseif (get_theme_mod('ig_home_layout') == 'full_list') {
				if( $wp_query->current_post == 0 && !is_paged() ) {
					get_template_part('content');
				} else {
					get_template_part('content', 'list');
				}

			} elseif (get_theme_mod('ig_home_layout') == 'full_grid') {

				if( $wp_query->current_post == 0 && !is_paged() ) {
					echo "<div class='first_post'>";
					get_template_part('content');
					echo "</div>";
					echo "<ul id='main-content' class='isotopeWrapper masonryContainer'>";
				} else {
					get_template_part('content', 'grid');
				}
			} else {
				get_template_part('content');
			}
		}
	} else {
		echo "<li class='nomorepost'>";
		_e('No more posts found', 'ilgelo');
		echo "</li>";
	}
?>