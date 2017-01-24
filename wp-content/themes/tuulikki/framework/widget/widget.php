<?php
	
require_once(get_template_directory().'/framework/widget/widget-about.php');
require_once(get_template_directory().'/framework/widget/widget-social.php');
require_once(get_template_directory().'/framework/widget/widget-posts.php');
require_once(get_template_directory().'/framework/widget/widget-big-posts.php');
require_once(get_template_directory().'/framework/widget/widget-banner.php');
require_once(get_template_directory().'/framework/widget/widget-full-banner.php');
require_once(get_template_directory().'/framework/widget/widget-promo-box.php');


	// Register and load the widget
	function widget_load() {
		register_widget('ilgelo_about');
		register_widget('ilgelo_wSocial');
		register_widget('ilgelo_posts');
		register_widget('ilgelo_big_posts');
		register_widget('ilgelo_full_banner');
		register_widget('ilgelo_banner');
		register_widget('ilgelo_promobox');
		
	}


add_action( 'widgets_init', 'widget_load' );

?>