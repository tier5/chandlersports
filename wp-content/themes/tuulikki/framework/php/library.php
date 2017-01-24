<?php

function ilgelo_themesetup() {
	if (function_exists('add_theme_support')) {
		add_theme_support("title-tag");
	    add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
	}

}
add_action("after_setup_theme", "ilgelo_themesetup");

function ig_get_menu($menu,$class) {
		if (has_nav_menu($menu)) {
		?>
				<div class="<?php echo esc_attr($class); ?>">
					<?php wp_nav_menu(array(
						'theme_location' => $menu,
						'menu'            => 'ul',
						'menu_class'      => 'nav-menu',
						'menu_id'         => '',
						'container'       => false,
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'depth'           => 4,
						'walker'          => ''
						 )
					  );
					?>
				</div>
		<?php
		}
}

function ilgelo_getpage() {
	$paged=1;

	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	return $paged;
}

function ilgelo_pagination($numpages = '',$pagerange = '',$paged='', $tipo='') {
	if (empty($pagerange)) {
		$pagerange = 2;
	}

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

	if ($tipo=='archive') {
		$strpage='page';
	} else {
		$strpage='paged';
	}

	$pagination_args = array(
		'base' => @add_query_arg($strpage,'%#%'),
		'format' => '?'+$strpage+'=%#%',
		'total'           => $numpages,
		'current'         => $paged,
		'show_all'        => False,
		'end_size'        => 1,
		'mid_size'        => $pagerange,
		'prev_next'       => True,
		'prev_text'       => esc_html__('&laquo;', 'ilgelo'),
		'next_text'       => esc_html__('&raquo;', 'ilgelo'),
		'type'            => 'plain',
		'add_args'        => false,
		'add_fragment'    => ''
	);

	//$paginate_links = paginate_links($pagination_args);

	if ($numpages>1) {
		echo "<nav class='ilgelo_pagination'>";
		echo paginate_links($pagination_args);
		echo "</nav>";
		echo "<div class='clear'></div>";
	}
}


function ilgelo_slug_fonts_url($font_families) {
	$fonts_url = "";

	$query_args = array(
		"family" => urlencode($font_families),
		"subset" => urlencode("latin,latin-ext"),
	);
	$fonts_url = add_query_arg($query_args,'https://fonts.googleapis.com/css' );
	return $fonts_url;
}

function ilgelo_formatta_nomesidebar($sidebar) {
	return preg_replace("/[\s_]/", "-", strtolower($sidebar));
}

?>
