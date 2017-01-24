<?php
/**
* Helper class
*/
class WC_Sagepay_Server_Iframe_Helper {

    function load_js($js_params = array()) {
        // embed the javascript file that makes the AJAX request
        wp_enqueue_script(
            'sagepay-server-iframe', 
            plugin_dir_url(dirname(__FILE__)) . 'js/ajax.js', 
            array('jquery', 'jquery-migrate', 'jquery-plugins'));

        // declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
        $js_params['ajaxurl'] = admin_url('admin-ajax.php');
        wp_localize_script(
            'sagepay-server-iframe', 
            'sagepayServerIframe', 
            $js_params);

        // our JS should handle the checkout submit 
        // if bypassed somehow & woocommerce submit is used we need to stop
        // the form submission needs to be done in an iframe
        //add_action( 'wp_ajax_nopriv_sagepay-server-iframe-submit', array('WC_Sagepay_Server_Iframe', 'halt_order'));
        //add_action( 'wp_ajax_sagepay-server-iframe-submit', array('WC_Sagepay_Server_Iframe', 'halt_order'));
 
    }

    /**
    * generate a unique vendorTxCode
    */
    function gen_tx_code($vendor_name, $order_id) {
        $time_stamp = date("ymdHis");
        //$rand_num = rand(0,32000)*rand(0,32000);
        //$this->vendor_tx_code = $this->vendor_name . "-" . $time_stamp . "-" . $rand_num;
        return  $vendor_name . "-" . $time_stamp . "-" . $order_id;
    }

    function get_protocol() {
        return isset($_SERVER['HTTPS']) ? 'https' : 'http';
    }

    function get_current_url() {
        $protocol = $this->get_protocol();
        $url = parse_url($_SERVER['REQUEST_URI']);
        return $protocol . '://'.$_SERVER['HTTP_HOST'].$url['path'];
    }

    function get_notification_url() {
        return home_url(WC_Sagepay_Server_Iframe::NOTIFICATION_URL, $this->get_protocol());
    }

    function get_redirect_url() {
        return home_url(WC_Sagepay_Server_Iframe::REDIRECT_URL, $this->get_protocol());
    }

    function is_notification_url($url=null) {
        if(is_null($url)) $url = $this->get_current_url(); 
        return rtrim($this->get_notification_url(), '/') == rtrim($url, '/');
    }

    function is_redirect_url($url=null) {
        if(is_null($url)) $url = $this->get_current_url(); 
        return rtrim($this->get_redirect_url(), '/') == rtrim($url, '/');
    }

    function get_gateway($mode) {
        // GATEWAY URL - simulator by default
        $gateway =  WC_Sagepay_Server_Iframe::SIMULATOR_URL;

        switch($mode) {
            case 'live':
                $gateway =  WC_Sagepay_Server_Iframe::LIVE_URL;
                break;
            case 'test':
                $gateway =  WC_Sagepay_Server_Iframe::TEST_URL;
                break;
            default: break;
        }
        return $gateway;
    }

    function parse_response($raw) {
        if(isset($raw['body'])) {
            // split response into lines
            $response = array();
            $body = explode(chr(10), $raw['body']);
            foreach($body as $line) {
                $pair = explode('=', $line, 2);
                if (isset($pair[0]) and isset($pair[1])) {
                    $response[trim($pair[0])] = trim($pair[1]);
                }
            }

            // additional information returned for debugging
            //$response['VendorTxCode'] = $this->vendor_tx_code;
            
            // creation date & time
            $response['Created'] = date('Y-m-d H:i:s');
            return $response;
        }
    }

    function load_user_card_types($settings) {
        // group & tidy available user card types
        $cards = array();
        foreach($settings as $k => $v ) {
            if(preg_match('/^cardtype-/', $k)) {
                if($v == 'yes') $cards[] = preg_replace('/^cardtype-/', '', $k);
            }                
        }
        return $cards;
    }

    function format_basket($order) {
        $basket= array();
        //Item : Quantity : Value : Tax : Total : Line Total
		$items = $order->get_items(); 
		$item_count = count($items); 
		if($item_count>0) { 
            foreach ($items as $item) {
                $basket[] = $item['name'];
                $basket[] = $item['qty'];
                $basket[] = $order->get_item_total($item);
                $basket[] = $order->get_item_tax($item);
                $basket[] = $order->get_item_total($item, $inc_tax=true);
                $basket[] = $order->get_line_total($item, $inc_tax=true);
            }
        }
        return $item_count . ':' . implode(':', $basket);

    }

    function is_seckey_ok($seckey, $data) {
        /*
        uppercase MD5 signature of the concatenation of the values of:
        VPSTxId + VendorTxCode + Status + TxAuthNo +
        VendorName+ AVSCV2 + SecurityKey + AddressResult
        + PostCodeResult + CV2Result + GiftAid +
        3DSecureStatus + CAVV + AddressStatus +
        PayerStatus + CardType + Last4Digits.
        */
        $hash = strtoupper(md5(
            $data['VPSTxId']
            .$data['VendorTxCode']
            .$data['Status']
            .$data['TxAuthNo']
            .$data['VendorName']
            .$data['AVSCV2']
            .$seckey
            .$data['AddressResult']
            .$data['PostCodeResult']
            .$data['CV2Result']
            .$data['GiftAid']
            .$data['3DSecureStatus']
            .$data['CAVV']
            .$data['AddressStatus']
            .$data['PayerStatus']
            .$data['CardType']
            .$data['Last4Digits']
        ));
        return strtoupper($data['VPSSignature']) == strtoupper($hash);
    }

} // end WC_Sagepay_Server_Iframe_Helper class
