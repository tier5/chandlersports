<div id="widget-area">
	<?php
		global $post;
		if ($post!=null) {
			$id = $post->ID;
			$sidebar = ilgelo_formatta_nomesidebar(get_post_meta($id, 'sidebar', true));

			if($sidebar != '' && is_active_sidebar($sidebar)) {
				dynamic_sidebar($sidebar);
			} else if (is_active_sidebar('Blog sidebar')) {
				dynamic_sidebar('Blog sidebar');

			}
		}
	?>
</div>