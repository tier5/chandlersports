<?php

function ilgelo_themesetup() {
	if (function_exists('add_theme_support')) {
		add_theme_support("title-tag");
	    add_theme_support( 'automatic-feed-links' );
	}

}
add_action("after_setup_theme", "ilgelo_themesetup");

function ig_get_menu($menu,$class) {
		if (has_nav_menu($menu)) {
		?>
				<div class="<?php echo $class; ?>">
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
		'prev_text'       => __('&laquo;', 'ilgelo'),
		'next_text'       => __('&raquo;', 'ilgelo'),
		'type'            => 'plain',
		'add_args'        => false,
		'add_fragment'    => ''
	);

	$paginate_links = paginate_links($pagination_args);

	if ($paginate_links) {
		echo "<nav class='ilgelo_pagination'>";
		echo $paginate_links;
		echo "</nav>";
		echo "<div class='clear'></div>";
	}
}


function ilgelo_get_the_post_id() {
  if (in_the_loop()) {
       $post_id = get_the_ID();
  } else {
       global $wp_query;
       $post_id = $wp_query->get_queried_object_id();
         }
  return $post_id;
}

?>
