<?php
/*
Plugin Name: WooCommerce Google Product Feed
Plugin URI: http://www.leewillis.co.uk/wordpress-plugins/?utm_source=wordpress&utm_medium=www&utm_campaign=woocommerce-gpf
Description: Woocommerce extension that allows you to more easily populate advanced attributes into the Google Merchant Centre feed 
Author: Lee Willis
Version: 1.5.5
Author URI: http://www.leewillis.co.uk/
License: GPLv3
*/

/**
 * Required functions
 **/
if ( ! function_exists( 'is_woocommerce_active' ) ) require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 **/
if (is_admin()) {
	$woo_plugin_updater_google_feed = new WooThemes_Plugin_Updater( __FILE__ );
	$woo_plugin_updater_google_feed->api_key = '231ef495a163f7f1c8f57beef93d0502';
	$woo_plugin_updater_google_feed->init();
}
	
if ( is_admin() ) {
	require_once ( 'woocommerce-gpf-common.php' );
	require_once ( 'woocommerce-gpf-admin.php' );
} else {
    if ( isset ( $_REQUEST['action'] ) && 'woocommerce_gpf' == $_REQUEST['action'] ) {
	    require_once ( 'woocommerce-gpf-common.php' );
	    require_once ( 'woocommerce-gpf-frontend.php' );
    }
}

register_activation_hook ( __FILE__, 'woocommerce_gpf_install' );

function woocommerce_gpf_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "woocommerce_gpf_google_taxonomy";

    $sql = "CREATE TABLE $table_name (
                         `taxonomy_term` text,
                         `search_term` text
                             )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
