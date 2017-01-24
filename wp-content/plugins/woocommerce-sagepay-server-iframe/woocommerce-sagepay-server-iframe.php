<?php
/*
Plugin Name: WooCommerce SagePay Server iFrame Gateway
Plugin URI: http://inigo.net/woocommerce-sagepay-server
Description: Extends WooCommerce with the SagePay gateway.
Version: 0.1
Author: Neill Russell (@enru)  
Author URI: http://enru.co.uk/

Copyright: © 2012 Inigo Media Ltd.
License: GNU General Public License v2.0
License URI: http://www.gnu.org/old-licenses/gpl-2.0.html
*/

/**
 * Check if WooCommerce is active
 **/
require 'classes/class-wc-sagepay-server-iframe-db.php';
register_activation_hook(__FILE__, array('WC_SagePay_Server_Iframe_Db', 'create_db'));
//register_activation_hook(__FILE__, array('WC_SagePay_Server_Iframe_Db', 'install_db'));

if(in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) {

    function woocommerce_sagepay_server_iframe_init() {

        if(class_exists('WC_SagePay_Server_Iframe')) return;
        
        define("SAGEPAY_SERVER_IFRAME_DIR", dirname(__FILE__));

        /**
        * Localisation
        */
        load_plugin_textdomain(
            'wc-sagepay-server-iframe', 
            false, 
            dirname(plugin_basename( __FILE__ )) . '/languages');

        /**
        * Add the Gateway to WooCommerce
        **/
        function woocommerce_add_sagepay_server_iframe_gateway($methods) {
            $methods[] = 'WC_Sagepay_Server_Iframe';
            return $methods;
        }
        add_filter('woocommerce_payment_gateways', 'woocommerce_add_sagepay_server_iframe_gateway');

        /**
        * Load Sagepay Server classes
        **/
        require 'classes/class-wc-sagepay-server-iframe.php';

        /**
         * Check if user is on a mobile if it is add the restrict filter 
        **/
        require_once 'Mobile-Detect/Mobile_Detect.php';
        $detect = new Mobile_Detect();
        if($detect->isMobile()) {
            add_filter('woocommerce_available_payment_gateways', 'restrict_sagepay_server_iframe');
        }

/*
        // restrict for IE < 9
        add_filter('woocommerce_available_payment_gateways', function($available_gateways) {
            foreach($available_gateways as $key => $gateway) {
                if($gateway->id == 'sagepay-server-iframe') {
                    if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])) unset($available_gateways[$key]);
                    break;
                }
            }
            return $available_gateways;
        });
*/

    }
    add_action('plugins_loaded', 'woocommerce_sagepay_server_iframe_init', 0);

    // restrict for mobile phones
    function restrict_sagepay_server_iframe($available_gateways) {
        foreach($available_gateways as $key => $gateway) {
            if($gateway->id == 'sagepay-server-iframe') {
                if($gateway->mobile != 'yes') unset($available_gateways[$key]); 
                break;
            }
        }
        return $available_gateways;
    }
}// end if woocommerce
