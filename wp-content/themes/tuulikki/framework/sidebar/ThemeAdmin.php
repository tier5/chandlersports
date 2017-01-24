<?php

class ThemeAdmin {
	public function __construct() {
		add_action( 'init', array($this, 'registerSidebar') );
		add_action( 'admin_menu', array($this, 'setupThemeAdminMenus' ));
	}

	public function setupThemeAdminMenus() {
		add_theme_page("IlGelo: Options", "Add Sidebar", "manage_options", "ilgelo_theme_settings", array($this, "sidebarPage") );
	}

	public function themeSettingsPage() {
		// General Options
	}

	public function registerSidebar() {

			global $wp_registered_sidebars;
		$sidebars = get_option('sidebars');

		if($sidebars) {
			foreach($sidebars as $sidebar) {
				if(!in_array($sidebar, $wp_registered_sidebars)) {
					register_sidebar(array(
							'name'=> $sidebar,
							'id'=> ilgelo_formatta_nomesidebar($sidebar),
							'before_widget' => '<div class="ig_widget">',
							'after_widget' => '</div>',
							'before_title' => '<div class="tit_widget"><span>',
							'after_title' => '</span></div>',
						));
				}

			}

		}
	}

	public function sidebarPage() {
		$output="";
		$output.="<h2>Add Sidebar</h2>";
		if(isset($_POST['update_settings'])) {

			add_option('sidebars', array());
			$new_sidebar = esc_attr($_POST['sidebars']);
			$sidebars = get_option('sidebars');
			if(count($sidebars) == 0) {
				$newsidebars = array();
			} else {
				$newsidebars = $sidebars;
			}
			$newsidebars[] = $new_sidebar;
			update_option('sidebars', $newsidebars);
			$output.="<div id='message' class='updated'>". __( 'Added Sidebar with successful', 'ilgelo' ). "</div>";
		}

		$output.="<form method='post' action=''>";
		$output.=" ". __( 'Here you can create new sidebar', 'ilgelo' ). " ";
		$output.="	<p>";
		$output.="		<label>". __( 'Name of sidebar', 'ilgelo' ). "</label>";
		$output.="		<input type='text' name='sidebars' id='sidebars'/>";
		$output.="	<p>";
		$output.="	 	<input type='submit' value='". __( 'Add Sidebar', 'ilgelo' ). "' class='button-primary'/>";
		$output.="	 	<input type='hidden' name='update_settings' value='Y' />";
		$output.="	 </p>";
		$output.="</form>";

		echo $output;
	}
}

$admin = new ThemeAdmin();
