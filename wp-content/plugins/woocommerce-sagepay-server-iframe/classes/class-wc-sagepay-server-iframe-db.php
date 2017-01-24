<?php
/**
* DB class
*/
class WC_Sagepay_Server_Iframe_Db {

    const VERSION = "1.0";

    function __construct() {
    }

    static function create_db() {
        global $wpdb;

        $table_name = $wpdb->prefix . "sagepay_server_iframe_debug";
          
        $sql = "CREATE TABLE $table_name (
            id int(10) unsigned NOT NULL auto_increment,
            order_id int unsigned NOT NULL,
            gateway mediumtext,
            request text,
            response text,
            reply text,
            remote_addr varchar(255),
            created timestamp,
            PRIMARY KEY  (id)
        )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        $table_name = $wpdb->prefix . "sagepay_server_iframe_registrations";

        $sql = "CREATE TABLE $table_name (
            id int(10) unsigned NOT NULL auto_increment,
            order_id int unsigned NOT NULL,
            gateway mediumtext,
            vps_protocol varchar(255) NOT NULL,
            status varchar(255) default NULL,
            status_detail varchar(255) default NULL,
            vps_tx_id varchar(255) default NULL,
            security_key varchar(255) default NULL,
            next_url varchar(255) default NULL,
            remote_addr varchar(255),
            created timestamp,
            PRIMARY KEY  (id),
            UNIQUE KEY vpstxid (vps_tx_id)
        )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        $table_name = $wpdb->prefix . "sagepay_server_iframe_transactions";

        $sql = "CREATE TABLE $table_name (
            id int(10) unsigned NOT NULL auto_increment,
            order_id int unsigned NOT NULL,
            gateway mediumtext,
            vps_protocol varchar(255) NOT NULL,
            tx_type varchar(255) NOT NULL,
            vendor_tx_code varchar(255) NOT NULL,
            vps_tx_id varchar(255) default NULL,
            status varchar(255) default NULL,
            status_detail varchar(255) default NULL,
            tx_auth_no varchar(255) default NULL,
            avscv2 varchar(255) default NULL,
            address_result varchar(255) default NULL,
            postcode_result varchar(255) default NULL,
            cv2result varchar(255) default NULL,
            giftaid tinyint(2) default NULL,
            threed_secure_status varchar(255) default NULL,
            cavv varchar(255) default NULL,
            address_status varchar(255) default NULL,
            payer_status varchar(255) default NULL,
            card_type varchar(255) default NULL,
            last_four_digits varchar(255) default NULL,
            vps_signature varchar(255) default NULL,
            remote_addr varchar(255),
            created timestamp,
            PRIMARY KEY  (id)
        )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option("sagepay_server_iframe_db_version", WC_Sagepay_Server_Iframe_Db::VERSION);
    }

    function insert_debug_info($order_id, $gateway, $request, $response, $reply) {
        global $wpdb;
        if(WP_DEBUG) $wpdb->show_errors();
        $id = $wpdb->insert(
            $wpdb->prefix . "sagepay_server_iframe_debug",
            array(
                'order_id' => $order_id,
                'gateway' => $gateway,
                'request' => mysql_real_escape_string(serialize($request)),
                'response' => mysql_real_escape_string(serialize($response)),
                'reply' => mysql_real_escape_string(serialize($reply)),
                'remote_addr' => $_SERVER['REMOTE_ADDR'],
            ));
        if(WP_DEBUG == true) {
            error_log(var_export($request, true));
            error_log(var_export($response, true)); 
            error_log(var_export($reply, true)); 
        }
    }

    function insert_registration($order_id, $gateway, $response) {
        global $wpdb;
        if(WP_DEBUG) $wpdb->show_errors();
	if($this->get_registration($response['VPSTxId'])) {
	    $this->update_registration($order_id, $gateway, $response); 
	}
	else {
		$id = $wpdb->insert(
		    $wpdb->prefix . "sagepay_server_iframe_registrations",
		    array(
			'order_id' => $order_id,
			'gateway' => $gateway,
			'vps_protocol' => $response['VPSProtocol'],
			'status'=>$response['Status'],
			'status_detail' => $response['StatusDetail'],
			'vps_tx_id' => $response['VPSTxId'],
			'security_key' => $response['SecurityKey'],
			'next_url' => $response['NextURL'],
			'remote_addr' => $_SERVER['REMOTE_ADDR'],
		    ));
	}
    }

    function update_registration($order_id, $gateway, $response) {
        global $wpdb;
        if(WP_DEBUG) $wpdb->show_errors();
        $id = $wpdb->update(
            $wpdb->prefix . "sagepay_server_iframe_registrations",
            array(
                'gateway' => $gateway,
                'vps_protocol' => $response['VPSProtocol'],
                'status'=>$response['Status'],
                'status_detail' => $response['StatusDetail'],
                'security_key' => $response['SecurityKey'],
                'next_url' => $response['NextURL'],
                'remote_addr' => $_SERVER['REMOTE_ADDR'],
            ),
	    array(
                'order_id' => $order_id,
                'vps_tx_id' => $response['VPSTxId'],
	    ));
    }

    function get_registration($txid) {
        global $wpdb;
        if(WP_DEBUG) $wpdb->show_errors();
        $table = $wpdb->prefix . "sagepay_server_iframe_registrations";
        $query = $wpdb->prepare(
            "SELECT * FROM $table WHERE vps_tx_id = %s",
            $txid);
        return $wpdb->get_row($query);
    }

    function insert_transaction($order_id, $gateway, $response) {
        global $wpdb;
        if(WP_DEBUG) $wpdb->show_errors();
        $id = $wpdb->insert(
            $wpdb->prefix . "sagepay_server_iframe_transactions",
            array(
                'order_id'=>$order_id,
                'gateway'=>$gateway,
                'vps_protocol'=>$response['VPSProtocol'],
                'tx_type'=>$response['TxType'],
                'vendor_tx_code' => $response['VendorTxCode'],
                'vps_tx_id' => $response['VPSTxId'],
                'status' => $response['Status'],
                'status_detail' => $response['StatusDetail'],
                'tx_auth_no' => $response['TxAuthNo'],
                'avscv2' => $response['AVSCV2'],
                'address_result' => $response['AddressResult'],
                'postcode_result' => $response['PostCodeResult'],
                'cv2result' => $response['CV2Result'],
                'giftaid' => $response['GiftAid'],
                'threed_secure_status' => $response['3DSecureStatus'],
                'cavv' => $response['CAVV'],
                'address_status' => $response['AddressStatus'],
                'payer_status' => $response['PayerStatus'],
                'card_type' => $response['cardType'],
                'last_four_digits' => $response['Last4Digits'],
                'vps_signature' => $response['VPSSignature'],
                'remote_addr' => $_SERVER['REMOTE_ADDR'],
            ));
    }

} // end WC_Sagepay_Server_Iframe_Db class
