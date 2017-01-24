<?php
require_once 'class-wc-sagepay-server-iframe-helper.php';
require_once 'class-wc-sagepay-server-iframe-db.php';
/**
* Gateway class
*/
class WC_Sagepay_Server_Iframe extends WC_Payment_Gateway {

    const VPS_PROTOCOL = 2.23;

    const NOTIFICATION_URL = '/sagepay/callback/';
    const REDIRECT_URL = '/sagepay/redirect/';

    //Sage pay currently supported credit/debit cards
    private static $cardtypes = array(
        'MC' => 'MasterCard',
        'VISA' => 'VISA Credit',
        'DELTA' => 'VISA Debit',
        'UKE' => 'VISA Electron',
        'MAESTRO' => 'Maestro (Switch)',
        'AMEX' => 'American Express',
        'DC' => 'Diner\'s Club',
        'JCB' => 'JCB Card',
        'LASER' => 'Laser'
    );

    //list of currencies this can easily be modified by adding/removing items    
    private static $currencies =  array(
        'GBP' => 'GB Pound (GBP)',
        'EURO' => 'Euro',
        'USD' => 'US Dollar (USD)',
    );

    // gateway urls            
    const SIMULATOR_URL    = 'https://test.sagepay.com/Simulator/VSPServerGateway.asp?Service=VendorRegisterTx';
    const TEST_URL         = 'https://test.sagepay.com/gateway/service/vspserver-register.vsp';
    const LIVE_URL         = 'https://live.sagepay.com/gateway/service/vspserver-register.vsp';

    public function __construct() {

        $this->helper = new WC_Sagepay_Server_Iframe_Helper();

        $this->db = new WC_Sagepay_Server_Iframe_Db();

        $this->id = 'sagepay-server-iframe';
        $this->method_title = 'Sagepay Server iFrame';
        $this->icon = WP_PLUGIN_URL . "/" . plugin_basename( dirname(dirname(__FILE__))) . '/images/sagepay.png';
        $this->has_fields = true;
        
        // load form fields
        $this->init_form_fields();

        // load settings
        $this->init_settings();

        // user variables            
        $this->title            = $this->settings['title'];
        $this->description      = $this->settings['description'];
        $this->vendor_name      = $this->settings['vendor-name'];
        $this->mode             = $this->settings['mode'];        
        $this->tx_type          = $this->settings['tx-type'];
        $this->currency         = $this->settings['currency'];
        $this->debug            = $this->settings['debug'];    
        $this->mobile           = $this->settings['mobile'];
        $this->active_cards     = $this->helper->load_user_card_types($this->settings);
        $this->gateway          = $this->helper->get_gateway($this->mode);

        $this->helper->load_js(array(
            'container' => esc_js($this->settings['container']),
        ));

        // make sure we get shipping address details
        update_option('woocommerce_require_shipping_address', 'yes');

        // actions
        add_action('woocommerce_update_options_payment_gateways', array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_sagepay_server_iframe', array($this, 'thankyou_page'));

        // customer emails
        //add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 2);

        // check if the route is a callback OR notification call from sagepay
        add_filter('parse_request', array($this, 'check_route')); 
    }

    /**
    * Initialise Gateway Settings Form Fields
    */
    function init_form_fields() {

        //  array to generate admin form
        $this->form_fields = array(
            'enabled' => array(
                'title' => __( 'Enable/Disable', 'woocommerce' ), 
                'type' => 'checkbox', 
                'label' => __( 'Enable SagePay Server iFrame', 'woocommerce' ), 
                'default' => 'yes'
            ), 
            'title' => array(
                'title' => __( 'Title', 'woocommerce' ), 
                'type' => 'text', 
                'description' => __( 'This is the title displayed to the user during checkout.', 'woocommerce' ), 
                'default' => __( 'SagePay Server iFrame', 'woocommerce' )
            ),
            'description' => array(
                'title' => __( 'Description', 'woocommerce' ), 
                'type' => 'textarea', 
                'description' => __( 'This is the description which the user sees during checkout.', 'woocommerce' ), 
                'default' => __("Payment via SagePay Gateway, you can pay by credit or debit card", 'woocommerce')
            ),
            'container' => array(
                'title' => __( 'Container', 'woocommerce' ), 
                'type' => 'text', 
                'description' => __( 'Enter the CCS ID of the checkout container the Sage Pay iFrame will overlay (default = #content)', 'woocommerce' ), 
                'default' => '#content'
            ),
            'vendor-name' => array(
                'title' => __( 'Vendor Name', 'woocommerce' ), 
                'type' => 'text', 
                'description' => __( 'Please enter your vendor name provided by SagePay.', 'woocommerce' ), 
                'default' => ''
            ),
            'mode' => array(
                'title' => __('Mode Type', 'woocommerce'),
                'type' => 'select',
                'options' => array(
                    'simulator' => 'Simulator', 
                    'test' => 'Test', 
                    'live' => 'Live',
                ),            
                'description' => __( 'Select Simulator, Test or Live modes.', 'woocommerce' )
            ),
            'tx-type' => array(
                'title' => __('Transaction Type', 'woocommerce'),
                'type' => 'select',
                'options' =>  array(
                    'PAYMENT' => __('PAYMENT', 'woocommerce'), 
                    'DEFERRED' => __('DEFERRED', 'woocommerce'), 
                    'AUTHENTICATE' => __('AUTHENTICATE', 'woocommerce')
                ),
                'description' => __( 'Select Payment, Deferred or Authenticated.', 'woocommerce' )
            ),
            '3d-secure' => array(
                'title' => __('3D Secure', 'woocommerce'),
                'type' => 'select',
                'options' => array(
                    0 => 'If 3D-Secure checks are possible and rules 
                    allow, perform the checks and apply the 
                    authorisation rules. (default)',
                    1 => 'Force 3D-Secure checks for transactions 
                        if possible and apply rules for authorisation.',
                    2 => 'Do not perform 3D-Secure checks for 
                        transactions and always authorise.',
                    3 => 'Force 3D-Secure checks for transactions 
                        if possible but ALWAYS obtain an auth code, 
                        irrespective of rule base.',
                ),            
                'description' => __( 'Select 3D Secure mode.', 'woocommerce' )
            ),
            '3d-secure-admin-disabled' => array(
                'title' => __('Disable 3D Secure for Admin?', 'woocommerce'),
                'type' => 'select',
                'options' => array(
                    0 => 'No - keep it enabled.',
                    1 => 'Yes - disable it.',
                ),
                'description' => __( 'Disable 3D Secure for Admin users - for phone orders.', 'woocommerce' )
            ),
            'account-type' => array(
                'title' => __('Account Type', 'woocommerce'),
                'type' => 'select',
                'options' => array(
                    'E' => 'Use the e-commerce merchant account (default).',
                    'C' => 'Use the continuous authority merchant account (if present).',
                    'M' => 'Use the mail order, telephone order account (if present).',
                ),
                'description' => __( 'Select account type.', 'woocommerce' )
            ),
            'apply-avscvs2' => array(
                'title' => __('AVS CVS2', 'woocommerce'),
                'type' => 'select',
                'options' => array(
                    0 => 'If AVS/CV2 enabled then check them. If rules apply, use rules. (default) ',
                    1 => 'Force AVS/CV2 checks even if not enabled for the account. If rules apply, use rules. ',
                    2 => 'Force NO AVS/CV2 checks even if enabled on account. ',
                    3 => 'Force AVS/CV2 checks even if not enabled for the account but DON’T apply any rules. ',
                ),
                'description' => __( 'avs cv2', 'woocommerce' )
            ),
            'allow-giftaid' => array(
                'title' => __('Allow Gift Aid?', 'woocommerce'),
                'type' => 'select',
                'options' => array(
                    0 => 'No Gift Aid Box displayed (default)',
                    1 => 'Display Gift Aid Box on payment screen.',
                ),
                'description' => __( 'Select Allow Gift Aid.', 'woocommerce' )
            ),

            'currency'  =>  array(
                'title' => __('Gateway Currency', 'woocommerce'),
                'type' => 'select',
                'options' => WC_Sagepay_Server_Iframe::$currencies,
                'description' => __( 'Select the currency you are using for this payment gateway.', 'woocommerce' )
            )
        );

        // add available card types to the form field array    
        $cards=0;
        foreach(WC_Sagepay_Server_Iframe::$cardtypes as $cardtype=>$cardname){
            $this->form_fields['cardtype-' . $cardtype] = array(
                'type' => 'checkbox',
                'label' => __( $cardname, 'woocommerce' ), 
                'default' => 'yes'
            );
            if($cards == 0) {
                $this->form_fields['cardtype-' . $cardtype]['title'] = __( 'Supported Cards', 'woocommerce' );
            }
            $cards++;
        }

        $this->form_fields['mobile'] = array(
            'title' => __( 'Use on mobiles/cell/phones', 'woocommerce' ), 
            'type' => 'checkbox', 
            'label' => __( 'Yes', 'woocommerce' ), 
            'default' => 'no'
        );

        $this->form_fields['debug'] = array(
            'title' => __( 'Debug', 'woocommerce' ), 
            'type' => 'checkbox', 
            'label' => __( 'Enable logging ', 'woocommerce' ), 
            'default' => 'no'
        );

    } // End init_form_fields()

    /**
    * Admin Panel Options 
    * - Options for bits like 'title' and availability on a country-by-country basis
    *
    * @since 1.0.0
    */
    public function admin_options() {
        ?>
        <h3><?php _e('SagePay Server iFrame Payment', 'woocommerce'); ?></h3>
        <p><?php _e('Allows Payment to be taken using the SagePay Server Payment Gateway', 'woocommerce'); ?></p>
        <table class="form-table">
        <?php
        // Generate the HTML For the settings form.
        $this->generate_settings_html();
        ?>
        </table><!--/.form-table-->
        <?php
    } // End admin_options()

    /**
    * TODO set up payment fields for sagepay
    **/
    function payment_fields() {
        if ($this->description) echo wpautop(wptexturize($this->description));
    }

    function thankyou_page() {
        if ($this->description) echo wpautop(wptexturize($this->description));
    }

    function email_instructions( $order, $sent_to_admin ) {
        if ( $sent_to_admin ) return;

        if ( $order->status !== 'on-hold') return;

        if ( $order->payment_method !== $this->id) return;

        if ($this->description) echo wpautop(wptexturize($this->description));
    }

    function check_route() {
        if($this->helper->is_notification_url()) {
            $this->_process_callback();
        }
        elseif($this->helper->is_redirect_url()) {
            $this->_process_redirect();
        }
    }

    private function _process_redirect() {
        global $woocommerce;

        $redirect_url = '';

        if($_GET['wc_error'] && $_GET['wc_message']) {
            // TODO log error
            $redirect_url = add_query_arg(
                'wc_error', 
                "There was a problem processing your order. You have not been charged. Please try again.", 
                get_permalink(get_option('woocommerce_checkout_page_id')));
        }
        // TODO better order handling 
        // security - prevent URL tampering
        elseif($_GET['order']) {
            $order_id = filter_var($_GET['order'], FILTER_VALIDATE_INT);
            if($order = new WC_Order($order_id)) {
                $redirect_url = add_query_arg(
                    'key', 
                    $order->order_key, 
                    add_query_arg(
                        'order', 
                        $order_id, 
                        get_permalink(woocommerce_get_page_id('thanks'))
                    )
                );
            }
        }

        if(strlen($redirect_url) > 0) {
            echo <<<EOF
<script type='text/javascript'>
window.top.location = "{$redirect_url}";
</script>
<noscript>
Thank you for your order. 
{$redirect_url}
</noscript>
EOF;
            exit();
        }
    }

    private function _process_callback() {
        global $woocommerce;

        // by default status should be OK 
        // even if order status returned by sagepay is not OK
        $status = 'OK';
        $status_detail = '';
        $redirect_url = '';

        try {

            if($this->settings['debug'] == 'yes') {
                $this->db->insert_debug_info(0, $this->gateway, $_POST, 'CALLBACK', null); 
            }

            if($registered_transaction = $this->db->get_registration($_POST['VPSTxId'])) {

                // BAIL OUT IF SECURITY KEY IS FALSE
                $hash_data = $_POST;
                $hash_data['VendorName'] = $this->vendor_name;

                if(false == $this->helper->is_seckey_ok($registered_transaction->security_key, $hash_data)) {
                    $status = "INVALID";
                    $status_detail = "Security Key does not match.";
                    throw new Exception($status_detail);
                }

                if($order_id = $registered_transaction->order_id) {

                    if($_POST['Status'] == 'OK') {

                        $this->db->insert_transaction($order_id, $this->gateway, $_POST);

                        $order = new WC_Order($order_id);

                        // Check order not already completed
                        if ($order->status == 'completed') {
                            throw new Exception("Order already complete.");
                        }

                        $order->add_order_note( __('Sagepay Server Iframe payment completed', 'woocommerce') 
                            . ' (Transaction ID: ' . $_POST['VPSTxId'] . ')' );

                        $order->payment_complete();                    

                        //$order->update_status('completed', __('Awaiting payment', 'woocommerce'));

                        //$order->reduce_order_stock();

                        $woocommerce->cart->empty_cart();

                        // Empty awaiting payment session
                        unset($_SESSION['order_awaiting_payment']);

                        // Return thankyou redirect
                        //$redirect_url = remove_query_arg( 'wc_error', $redirect );
                        //$redirect_url = remove_query_arg( 'wc_message', $redirect );
                        $redirect_url = add_query_arg(
                            'key', 
                            esc_attr($order->order_key), 
                            add_query_arg(
                                'order', 
                                esc_attr($order_id), 
                                $this->helper->get_redirect_url()
                            ));

                    } //end if post status = ok
                } // END order id matches
            } // END order exists
        }
        catch(Exception $e) {
            if($status == 'OK') $status = "ERROR";
            if(strlen($status_detail) == 0) {
                $status_detail = "There was a problem processing the transaction:";
                $status_detail .= "\n\r[$e]";
            }
        }

        if($status != 'OK') {
            $redirect_url = add_query_arg(
                'wc_error', 
                esc_attr($status), 
                add_query_arg(
                    'wc_message', 
                    esc_attr($status_detail), 
                    $this->helper->get_redirect_url()));
        }

        // build RESPONSE 
        $response = array(
            'Status' => $status,
            'RedirectURL'	=> $redirect_url,
            'StatusDetail' => $status_detail,
        );

        if($this->settings['debug'] == 'yes') {
            $this->db->insert_debug_info($order_id, $this->gateway, $_POST, $response, 'CALLBACK RESPONSE'); 
        }

        // output buffering & header
        @ob_clean();
        header('HTTP/1.1 200 OK');
        foreach($response as $k=>$v) {
            echo "$k=$v\r\n";
        }
        exit();
    } // END func

    // TODO
    private function _validated() {
        return true;
    }

    private function _build_params($order) {

        $vendor_tx_code = $this->helper->gen_tx_code(
            $this->settings['vendor-name'], 
            $order->id); 

        $params = array();
        $params['VPSProtocol'] = WC_Sagepay_Server_Iframe::VPS_PROTOCOL; // 4 chars
        $params['TxType'] = $this->tx_type;// 15 chars
        $params['Vendor'] = $this->vendor_name;//15 chars
        $params['VendorTxCode'] = $vendor_tx_code; //40 chars
        $params['Amount'] = $order->order_total;//numeric
        $params['Currency'] = $this->currency;//alpha 3 chars


        $params['BillingSurname'] = $order->billing_first_name;// alpha 20 chars
        $params['BillingFirstnames'] = $order->billing_last_name;// aplha 20 chars
        $params['BillingAddress1'] = $order->billing_address_1;// alnum 100 chars
        $params['BillingAddress2'] = $order->billing_address_2;// opt - alnum 100 chars 
        $params['BillingCity'] = $order->billing_city;// alnum 40 chars
        $params['BillingPostCode'] = $order->billing_postcode;// alnum 10 chars
        $params['BillingCountry'] = $order->billing_country;//al 2 char
        $params['BillingState'] = ''; // opt - US only al 2 chars
        if($order->billing_country == 'US') $params['BillingState'] = $order->billing_state;
        $params['BillingPhone'] = $order->billing_phone;// opt - alnum 20 char

        $params['DeliverySurname'] = $order->shipping_first_name;
        $params['DeliveryFirstnames'] = $order->shipping_last_name;
        $params['DeliveryAddress1'] = $order->shipping_address_1;
        $params['DeliveryAddress2'] = $order->shipping_address_2;
        $params['DeliveryCity'] = $order->shipping_city;
        $params['DeliveryPostCode'] = $order->shipping_postcode;                    
        $params['DeliveryCountry'] = $order->shipping_country;
        $params['DeliveryState'] = ''; // opt - US only al 2 chars
        if($order->shipping_country == 'US') $params['DeliveryState'] = $order->shipping_state;
        $params['DeliveryPhone'] = $order->billing_phone;                

        $params['CustomerEMail'] = $order->billing_email;


        // TODO - these fields still need to be mapped 
        $params['Basket'] = $this->helper->format_basket($order);//opt max 7500 char
        $params['AllowGiftAid'] = $this->settings['allow-giftaid'];//opt  0,1
        $params['ApplyAVSCV2'] = $this->settings['apply-avscv2'];//opt  0,1,2,3

        $params['Apply3DSecure'] = $this->settings['3d-secure'];//opt  0,1,2,3

	// don't use 3d secure if admin and settings say not to
	if($this->settings['3d-secure-admin-disabled'] && current_user_can('edit_plugins')) {
		$params['Apply3DSecure'] = 2; 
	}

        $params['Profile'] = 'LOW';// we're using iframe - otherwise us normal
        //$params['BillingAgreement'] = '';//opt  0,1
        $params['AccountType'] = $this->settings['account-type'];//opt  E,C,M
        $params['Description'] = 'Online WooCommerce purchase from ' . $this->vendor_name;// max 100 chars
        $params['NotificationURL'] = $this->helper->get_notification_url(); //max 255 chars

        return $params;
                            
    }

    /**
    * process payment
    * 
    * @param int $order_id
    */
    function process_payment( $order_id ) {
        global $woocommerce;

        //$woocommerce->add_error('SagePay transaction NOT registered');
        $response = array();   

        // TODO validate data
        if($this->_validated()){

            error_log($order_id);
            $order = new WC_Order($order_id);
            error_log(var_export($order, true));

            // Mark as on-hold (we're awaiting the sagepay payment)
            $order->update_status('pending', __('Awaiting payment', 'woocommerce'));
            
            $request = $this->_build_params($order);
            error_log(var_export($request, true));
            
            $post_data = array( 
                'body' => http_build_query($request),
                'method' => 'POST',
                'sslverify' => FALSE // because we can;t verify sagepay's cert?
            );                

            // SEND DATA to SAGEPAY
            $result = wp_remote_post($this->gateway, $post_data);

            // check to see if the request was valid
            if(!is_wp_error($result) && $result['response']['code'] >= 200 && $result['response']['code'] < 300) {
                $response = $this->helper->parse_response($result);
            }
            // if not set an error msg
            else {
                $response = array(
                    'Status' => 'Error',
                    'StatusDetail' => $result->get_error_message(),
                );
            }

            /**
             * PROCESS the RESPONSE
             *
             * Return values are:
             *
                VPSProtocol
                Status = OK, MALFORMED, INVALID, ERROR
                StatusDetail
                VPSTxId
                SecurityKey
                NextURL
            */

            // HANDLE RESPONSE STATUS
            // set result to success OR false
            $reply = array();
            switch($response['Status']){
                case 'OK':
                    $reply['result'] = 'success';
                    $reply['message'] = $response['StatusDetail'];
                    $reply['nexturl'] = $response['NextURL'];
                    break;
                case 'MALFORMED':
                case 'INVALID':
                case 'ERROR':
                default:
                    $error = $response['Status'].__(' - unknown error.', 'woocommerce');
                    if(isset($response['StatusDetail'])) $error = $response['StatusDetail'];
                    $woocommerce->add_error($error);
                    //$this->response['message'] = htmlentities($error);                        
                    //$this->response['result'] = strtolower($this->response['Status']);                        
                    $reply['message'] = $error;                        
                    $reply['result'] = strtolower($response['Status']);                        
                    break;
            }

            $this->db->insert_registration($order_id, $this->gateway, $response); 

            if($this->settings['debug'] == 'yes') {
                $this->db->insert_debug_info($order_id, $this->gateway, $request, $response, $reply); 
            }
        }                    
        return $reply;
    } // end process_payment

} // end WC_Sagepay_Server_Iframe class
