<?php

/*
  Plugin Name: Gravity Forms CapsuleCRM Add-On
  Description: Integrates Gravity Forms with CapsuleCRM allowing form submissions to be automatically sent to your CapsuleCRM account
  Version: 1.0.0
  Author: Alinea.im
  Author URI: http://www.alinea.im
 */

add_action('init', array('GFCapsuleCRM', 'init'));
require_once(__DIR__ . "/api/CapsuleCRMAPI.php");

class GFCapsuleCRM {

	private static $path = "gravity-forms-capsulecrm/capsulecrm.php";
	private static $url = "http://www.gravityforms.com";
	private static $slug = "gravity-forms-capsulecrm";
	private static $version = "1.0.0";
	private static $min_gravityforms_version = "1.0.0";

	//Plugin starting point. Will load appropriate files
	public static function init() {

		add_action("admin_notices",
				  array('GFCapsuleCRM', 'is_gravity_forms_installed'), 10);

		if (!self::is_gravityforms_supported()) {
			return;
		}

		if (is_admin()) {

			//creates a new Settings page on Gravity Forms' settings screen
			if (self::has_access("gravityforms_capsulecrm")) {
				RGForms::add_settings_page("CapsuleCRM",
						  array("GFCapsuleCRM", "rgformsaction_settings_page"), "");
			}
		}

		//creates the subnav left menu
		add_filter("gform_addon_navigation",
				  array('GFCapsuleCRM', 'filter_create_menu'), 20);


		if (self::is_capsulecrm_page()) {
			//enqueueing sack for AJAX requests
			wp_enqueue_script(array("sack"));
			wp_enqueue_style('gravityforms-admin', GFCommon::get_base_url() . '/css/admin.css');
		} else if (in_array(RG_CURRENT_PAGE, array("admin-ajax.php"))) {
			//add_action('wp_ajax_rg_update_feed_active', array('GFCapsuleCRM', 'update_feed_active'));
			//add_action('wp_ajax_gf_select_capsulecrm_form', array('GFCapsuleCRM', 'select_capsulecrm_form'));
			//add_action('wp_ajax_update_capsulecrm_form', array('GFCapsuleCRM', 'action_ajax_update_capsulecrm_form'));
			//add_action('wp_ajax_resend_capsulecrm_form', array('GFCapsuleCRM', 'action_ajax_resend_capsulecrm_form'));
		} elseif (in_array(RG_CURRENT_PAGE, array('admin.php'))) {

			add_action('admin_head',  array('GFCapsuleCRM', 'action_show_capsulecrm_status'));
		} else {
			//handling submission.
			//add_action("gform_pre_submission", array('GFCapsuleCRM', 'action_gform_pre_submission'), 10, 2);
			add_action('gform_post_submission', array('GFCapsuleCRM', 'action_gform_post_submission'), 10, 2);
		}

		add_action("gform_editor_js", array('GFCapsuleCRM', 'action_add_form_option_js'), 10);
		add_filter('gform_tooltips', array('GFCapsuleCRM', 'filter_add_form_option_tooltip'));
		add_filter("gform_confirmation", array('GFCapsuleCRM', 'filter_confirmation_error'));
		//add_action('gform_entries_first_column_actions', array('GFCapsuleCRM', 'action_gform_entries_first_column_actions'), 10, 5);
	}
	#############################################################################
	##PLUGIN FUNCTIONS###########################################################
	#############################################################################
	public static function uninstall() {
		if (!GFCapsuleCRM::has_access("gravityforms_capsulecrm_uninstall")) {
			(__("You don't have adequate permission to uninstall CapsuleCRM Add-On.",
								 "gravityformscapsulecrm"));
		}
		delete_option("gf_capsulecrm_settings");
		$plugin = "gravityformscapsulecrm/capsulecrm.php";
		deactivate_plugins($plugin);
		update_option('recently_activated',
				  array($plugin=>time()) + (array) get_option('recently_activated'));
	}
	private static function is_gravityforms_supported() {
		if (class_exists("GFCommon")) {
			$is_correct_version = version_compare(GFCommon::$version,
					  self::$min_gravityforms_version, ">=");
			return $is_correct_version;
		} else {
			return false;
		}
	}
	public static function is_gravity_forms_installed() {
		global $pagenow, $page;
		$message = '';
		if ($pagenow != 'plugins.php') {
			return;
		}
		if (!class_exists('RGForms')) {
			if (file_exists(WP_PLUGIN_DIR . '/gravityforms/gravityforms.php')) {
				$message .= '<p>Gravity Forms is installed but not active. <strong>Activate Gravity Forms</strong> to use the Gravity Forms CapsuleCRM plugin.</p>';
			} else {
				$message .= '<h2><a href="http://katz.si/gravityforms">Gravity Forms</a> is required.</h2><p>You do not have the Gravity Forms plugin enabled. <a href="http://katz.si/gravityforms">Get Gravity Forms</a>.</p>';
			}
		}
		if (!empty($message)) {
			echo '<div id="message" class="error">' . $message . '</div>';
		}
	}
	protected static function has_access($required_permission) {
		$has_members_plugin = function_exists('members_get_capabilities');
		$has_access = $has_members_plugin ? current_user_can($required_permission) : current_user_can("level_7");
		if ($has_access)
			return $has_members_plugin ? $required_permission : "level_7";
		else
			return false;
	}
	protected static function get_base_url() {
		return plugins_url(null, __FILE__);
	}
	protected function get_base_path() {
		$folder = basename(dirname(__FILE__));
		return WP_PLUGIN_DIR . "/" . $folder;
	}
	#############################################################################
	##ACTION: Templating actions#################################################
	#############################################################################
	public static function action_gform_entries_first_column_actions($form_id, $field_id, $value, $lead, $query_string) {
		if (!self::is_gf_capsulecrm_form(self::get_gfmodel($form_id)))
			return; 
		$lead_id = $lead['id'];
		self::render("action_gform_entries_first_column_actions.html",
				  array('text'=>__("Update this entry", "gfcapsulecrm"), 'style'=>"", 'action'=>"update_capsulecrm_form('$lead_id', '$form_id');"));
		self::render("action_gform_entries_first_column_actions.html",
				  array('text'=>__("Resend this entry", "gfcapsulecrm"), 'style'=>"", 'action'=>"resend_capsulecrm_form('$lead_id', '$form_id');"));
		add_action('admin_footer',
				  array('GFCapsuleCRM', 'action_include_js_in_footer_admin'));
	}
	public static function action_include_js_in_footer_admin() {
		self::render("function.js", array());
	}
	public static function action_add_form_option_js() {
		ob_start();
		gform_tooltip("form_capsulecrm");
		$tooltip = ob_get_contents();
		ob_end_clean();
		self::render("action_add_form_option.js",
				  array(
			 "tooltip"=>trim($tooltip),
		));
	}
	public static function filter_create_menu($menus) {
		$permission = self::has_access("gravityforms_capsulecrm");
		if (!empty($permission)) {
			$menus[] = array(
				 "name"=>"gf_capsulecrm",
				 "label"=>__("CapsuleCRM", "gravityformscapsulecrm"),
				 "callback"=>array("GFCapsuleCRM", "capsulecrm_page"),
				 "permission"=>$permission
			);
		}
		return $menus;
	}
	public static function filter_add_form_option_tooltip($tooltips) {
		$tooltips["form_capsulecrm"] = "<h6>" . __("Enable CapsuleCRM Integration",
							 "gravity-forms-capsulecrm") . "</h6>" . __("Check this box to integrate this form with CapsuleCRM. When an user submits the form, the data will be added to CapsuleCRM.",
							 "gravity-forms-capsulecrm");
		return $tooltips;
	}
	public static function filter_confirmation_error($confirmation, $form = '', $lead = '', $ajax = '') {

		if (current_user_can('administrator') && !empty($_REQUEST['capsulecrmErrorMessage'])) {
			$confirmation .= sprintf(__('%sThe entry was not added to CapsuleCRM because %sboth first and last names are required%s, and were not detected. %sYou are only being shown this because you are an administrator. Other users will not see this message.%s%s',
								 'gravity-forms-capsulecrm'),
					  '<div class="error" style="text-align:center; color:#790000; font-size:14px; line-height:1.5em; margin-bottom:16px;background-color:#FFDFDF; margin-bottom:6px!important; padding:6px 6px 4px 6px!important; border:1px dotted #C89797">',
					  '<strong>', '</strong>', '<em>', '</em>', '</div>');
		}
		return $confirmation;
	}
	public static function action_show_capsulecrm_status() {
		//TODO: Delete the global page_now here?
		//global $pagenow;
		if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'gf_edit_forms' && !isset($_REQUEST['id'])) {
			$activeforms = array();
			$forms = RGFormsModel::get_forms();
			if (!is_array($forms)) {
				return;
			}
			foreach ($forms as $form) {
				$form = RGFormsModel::get_form_meta($form->id);
				if (is_array($form) && !empty($form['enableCapsuleCRM'])) {
					$activeforms[] = $form['id'];
				}
			}
			if (!empty($activeforms)) {
				self::render("show_capsulecrm_status",
						  array(
					 "activeforms"=>$activeforms
				));
			}
		}
	}
	public static function rgformsaction_settings_page() {
		$message = $validimage = false;
		if (!empty($_POST["uninstall"])) {
			check_admin_referer("uninstall", "gf_capsulecrm_uninstall");
			self::uninstall();
			echo '<div class="updated fade" style="padding:20px;">' . _e(sprintf("Gravity Forms CapsuleCRM Add-On have been successfully uninstalled. It can be re-activated from the %splugins page%s.",
								 "<a href='plugins.php'>", "</a>"), "gravityformscapsulecrm") . '</div>';
			return;
		} else if (!empty($_POST["gf_capsulecrm_submit"])) {
			check_admin_referer("update", "gf_capsulecrm_update");
			$settings = array(
				 "url"=>stripslashes($_POST["gf_capsulecrm_url"]),
				 "token"=>stripslashes($_POST["gf_capsulecrm_token"]),
				 "cron"=>(isset($_POST["gf_capsulecrm_croned"]) &&$_POST["gf_capsulecrm_croned"]=="on"?true:false)
			);
			update_option("gf_capsulecrm_settings", $settings);
		} else {
			$settings = get_option("gf_capsulecrm_settings");
		}

		$api = self::get_api();

		if ($api->test_account()) {
			$message = 'Valid CapsuleCRM URL and API Token.';
			$class = "updated";
			$validimage = '<img src="' . GFCommon::get_base_url() . '/images/tick.png"/>';
			$valid = true;
		} else {
			$message = 'Invalid CapsuleCRM URL and/or API Token. Please try another combination.';
			$class = "error";
			$valid = false;
			$validimage = '<img src="' . GFCommon::get_base_url() . '/images/cross.png"/>';
		}

		self::render("rgformsaction_settings_page",
				  array(
			 'message'=>$message,
			 'class'=>$class,
			 'valid'=>$valid,
			 'validimage'=>$validimage,
			 'settings'=>$settings,
		));
	}
	#############################################################################
	##GFORM calls################################################################
	#############################################################################
	public static function get_gfmodel($form_id) {
		return RGFormsModel::get_form_meta($form_id);
	}
	public static function get_gflead($lead_id) {
		return RGFormsModel::get_lead($lead_id);
	}
	public static function is_gf_capsulecrm_form($gfmodel) {
		return !empty($gfmodel['enableCapsuleCRM']);
	}
	#############################################################################
	##INTERNALS##################################################################
	#############################################################################
	public static function render($template, $vars = array()) {
		foreach ($vars as $name=>$value)
			$$name = $value;
		require __DIR__ . "/templates/" . $template . ".php";
	}
	//Returns true if the current page is a capsulecrm page. Returns false if not
	private static function is_capsulecrm_page() {
		if (empty($_GET["page"])) {
			return false;
		}
		$current_page = trim(strtolower($_GET["page"]));
		$capsulecrm_pages = array("gf_capsulecrm");

		return in_array($current_page, $capsulecrm_pages);
	}
	public static function capsulecrm_page() {
		if (isset($_GET["view"]) && $_GET["view"] == "edit") {
			self::edit_page($_GET["id"]);
		} else {
			self::rgformsaction_settings_page();
		}
	}
	private static function get_api() {
		$settings = get_option("gf_capsulecrm_settings");
		return new CapsuleCRMAPI($settings["url"], $settings["token"], $settings["cron"]);
	}
	#############################################################################
	##ACTION: Manipulation Data##################################################
	#############################################################################
	public static function action_gform_pre_submission($gfmodel) {
		if (!self::is_gf_capsulecrm_form($gfmodel))
			return;
		//self::get_api()->process("pre_create", $gfmodel, $lead);
	}
	public static function action_gform_post_submission($lead, $gfmodel) {
		if (!self::is_gf_capsulecrm_form($gfmodel))
			return;
		self::get_api()->process($gfmodel, $lead);
	}
	public static function action_ajax_update_capsulecrm_form($model_id, $lead_id) {
		$gfmodel = self::get_gfmodel($model_id);
		if (!self::is_gf_capsulecrm_form($gfmodel))
			return;
		$lead = self::get_lead($lead_id);
		self::get_api()->process($gfmodel, $lead);
	}
	public static function action_ajax_resend_capsulecrm_form($model_id, $lead_id) {
		$gfmodel = self::get_gfmodel($model_id);
		if (!self::is_gf_capsulecrm_form($gfmodel))
			return;
		$lead = self::get_lead($lead_id);
		self::get_api()->process($gfmodel, $lead);
	}
}

?>
