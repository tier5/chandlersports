<?php

    /**
     * WC_Gateway_Sagepay_Direct class.
     *
     * @extends WC_Payment_Gateway / WC_Payment_Gateway_CC
     *
     * WC_Payment_Gateway_CC is new for WC 2.6
     */
    if( class_exists( 'WC_Payment_Gateway_CC' ) ) {
        class _WC_Gateway_Sagepay_Direct extends WC_Payment_Gateway_CC {}
    } else {
        class _WC_Gateway_Sagepay_Direct extends WC_Payment_Gateway {}
    }

    class WC_Gateway_Sagepay_Direct extends _WC_Gateway_Sagepay_Direct {

    	/**
    	 * [$sage_cardtypes description]
    	 * Set up accepted card types for card type drop down
    	 * From Version 3.3.0
    	 * @var array
    	 */
        var $sage_cardtypes = array(
        			'MasterCard'		=> 'MasterCard',
					'MasterCard Debit'	=> 'MasterCard Debit',
					'Visa'				=> 'Visa',
					'Visa Debit'		=> 'Visa Debit',
					'Discover'			=> 'Discover',
					'American Express' 	=> 'American Express',
					'Maestro'			=> 'Maestro',
					'JCB'				=> 'JCB',
					'Laser'				=> 'Laser'
				);
        var $default_tokens 				= 'no';
		var $default_tokens_message			= '';
		var $default_vendortxcodeprefix 	= 'wc_';

        /**
         * __construct function.
         *
         * @access public
         * @return void
         */
        public function __construct() {

            $this->id                   = 'sagepaydirect';
            $this->method_title         = __( 'SagePay Direct', 'woocommerce_sagepayform' );
            $this->method_description   = __( 'SagePay Direct', 'woocommerce_sagepayform' );
            $this->icon                 = apply_filters( 'wc_sagepaydirect_icon', '' );
            $this->has_fields           = true;

            $this->sagelinebreak 		= '0';

            // Load the form fields
            $this->init_form_fields();

            // Load the settings.
            $this->init_settings();

            // Get setting values
            $this->enabled				= $this->settings['enabled'];
            $this->title				= $this->settings['title'];
            $this->description			= $this->settings['description'];
            $this->vendor 				= $this->settings['vendor'];
            $this->status				= $this->settings['status'];
			$this->txtype				= $this->settings['txtype'];
			$this->cvv					= isset( $this->settings['cvv'] ) && $this->settings['cvv'] == 'yes' ? true : false;
			$this->cardtypes			= !empty( $this->settings['cardtypes'] ) ? $this->settings['cardtypes'] : $this->sage_cardtypes;
			$this->secure				= isset( $this->settings['3dsecure'] ) ? $this->settings['3dsecure'] : "0";
			$this->allowgiftaid 		= "0";
			$this->accounttype 			= "E";
			$this->billingagreement 	= "0";
			$this->debug				= isset( $this->settings['debug'] ) && $this->settings['debug'] == 'yes' ? true : false;
			$this->notification 		= isset( $this->settings['notification'] ) ? $this->settings['notification'] : get_bloginfo( 'admin_email' );
			$this->sagelinebreak		= isset( $this->settings['sagelinebreak'] ) ? $this->settings['sagelinebreak'] : "0";
			$this->defaultpostcode		= isset( $this->settings['defaultpostcode'] ) ? $this->settings['defaultpostcode'] : '';
            $this->vendortxcodeprefix   = isset( $this->settings['vendortxcodeprefix'] ) ? $this->settings['vendortxcodeprefix'] : $this->default_vendortxcodeprefix;

			$this->saved_cards 			= isset( $this->settings['tokens'] ) ? $this->settings['tokens'] : $this->default_tokens;
			$this->tokens_message 		= isset( $this->settings['tokensmessage'] ) ? $this->settings['tokensmessage'] : $this->default_tokens_message;

			$this->sagelink				= 0;
            $this->sagelogo				= 0;

           	// Sage urls
            if ( $this->status == 'live' ) {
            	// LIVE
				$this->purchaseURL 		= 'https://live.sagepay.com/gateway/service/vspdirect-register.vsp';
				$this->voidURL 			= 'https://live.sagepay.com/gateway/service/void.vsp';
				$this->refundURL 		= 'https://live.sagepay.com/gateway/service/refund.vsp';
				$this->releaseURL 		= 'https://live.sagepay.com/gateway/service/release.vsp';
				$this->repeatURL 		= 'https://live.sagepay.com/gateway/service/repeat.vsp';
				$this->testurlcancel	= 'https://live.sagepay.com/gateway/service/cancel.vsp';
				$this->authoriseURL 	= 'https://live.sagepay.com/gateway/service/authorise.vsp';
				$this->callbackURL 		= 'https://live.sagepay.com/gateway/service/direct3dcallback.vsp';
				// Standalone Token Registration
				$this->addtokenURL		= 'https://live.sagepay.com/gateway/service/directtoken.vsp';
				// Removing a Token
				$this->removetokenURL	= 'https://live.sagepay.com/gateway/service/removetoken.vsp';
			} else {
				// TEST
				$this->purchaseURL 		= 'https://test.sagepay.com/gateway/service/vspdirect-register.vsp';
				$this->voidURL 			= 'https://test.sagepay.com/gateway/service/void.vsp';
				$this->refundURL 		= 'https://test.sagepay.com/gateway/service/refund.vsp';
				$this->releaseURL 		= 'https://test.sagepay.com/gateway/service/release.vsp';
				$this->repeatURL 		= 'https://test.sagepay.com/gateway/service/repeat.vsp';
				$this->testurlcancel	= 'https://test.sagepay.com/gateway/service/cancel.vsp';
				$this->authoriseURL 	= 'https://test.sagepay.com/gateway/service/authorise.vsp';
				$this->callbackURL 		= 'https://test.sagepay.com/gateway/service/direct3dcallback.vsp';
				// Standalone Token Registration
				$this->addtokenURL		= 'https://test.sagepay.com/gateway/service/directtoken.vsp';
				// Removing a Token
				$this->removetokenURL	= 'https://test.sagepay.com/gateway/service/removetoken.vsp';
			}

			// 3D iframe
            $this->iframe_3d_callback   = esc_url( SAGEPLUGINURL . 'assets/pages/3dcallback.php' );
            $this->iframe_3d_redirect   = esc_url( SAGEPLUGINURL . 'assets/pages/3dredirect.php' );

            $this->vpsprotocol			= '3.00';

            // ReferrerID
            $this->referrerid 			= 'F4D0E135-F056-449E-99E0-EC59917923E1';

            // Supports
            $this->supports 			= array(
            									'products',
            									'refunds',
												'subscriptions',
												'subscription_cancellation',
												'subscription_reactivation',
												'subscription_suspension',
												'subscription_amount_changes',
												'subscription_payment_method_change',
												'subscription_payment_method_change_customer',
												'subscription_payment_method_change_admin',
												'subscription_date_changes',
												'multiple_subscriptions',
            									'pre-orders',
												'tokenization'
										);

			// Add test card info to the description if in test mode
			if ( $this->status != 'live' ) {
				$this->description .= ' ' . sprintf( __( '<br />TEST MODE ENABLED.<br />In test mode, you can use Visa card number 4929000000006 with any CVC and a valid expiration date or check the documentation (<a href="%s">Test card details for your test transactions</a>) for more card numbers.', 'woocommerce_sagepayform' ), 'http://www.sagepay.co.uk/support/12/36/test-card-details-for-your-test-transactions' );
				$this->description  = trim( $this->description );
			}

			// Hooks
			add_action( 'woocommerce_receipt_' . $this->id, array($this, 'authorise_3dsecure') );
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );

			// SSL Check
			$sagepaydirect_ssl_nag_dismissed = get_option( 'sagepaydirect-ssl-nag-dismissed' );
			if( empty( $sagepaydirect_ssl_nag_dismissed ) || $sagepaydirect_ssl_nag_dismissed != '1' ) {
				add_action( 'admin_notices', array( $this, $this->id . '_ssl_check') );
			}

			// Scripts
			add_action( 'wp_enqueue_scripts', array( $this, $this->id . '_scripts' ) );

			// WC version
			$this->wc_version = get_option( 'woocommerce_version' );

        } // END __construct

		/**
		 * Check if this gateway is enabled
		 */
		public function is_available() {

			if ( $this->enabled == "yes" ) {

				if ( ! is_ssl() && ! $this->status == 'live' ) {
					return false;
				}

				// Required fields check
				if ( ! $this->vendor ) {
					return false;
				}

				return true;

			}
			return false;

		}

		/**
    	 * Payment form on checkout page
    	 */
		public function payment_fields() {

			$display_tokenization = $this->supports( 'tokenization' ) && is_checkout() && $this->saved_cards == 'yes';

			if ( is_add_payment_method_page() ) {
				$pay_button_text = __( 'Add Card', 'woocommerce_sagepayform' );
			} else {
				$pay_button_text = '';
			}

			echo '<div id="sagepaydirect-payment-data">';

			if ( $this->description ) {
				echo apply_filters( 'wc_sagepaydirect_description', wp_kses_post( $this->description ) );
			}

			if ( $display_tokenization && class_exists( 'WC_Payment_Token_CC' ) ) {
				$this->tokenization_script();
				$this->saved_payment_methods();
			}

			// Use our own payment fields for now, until this issue is fixed
			// https://github.com/woothemes/woocommerce/issues/11214
			$this->sagepay_credit_card_form();

			if ( $display_tokenization && class_exists( 'WC_Payment_Token_CC' ) ) {
				$this->save_payment_method_checkbox();
			}

			echo '</div>';

		}

		/**
		 * Use a custom save_payment_method_checkbox to include a description from the settings
		 * @return [type] [description]
		 */
		public function save_payment_method_checkbox() {
			echo sprintf(
				'<p class="form-row woocommerce-SavedPaymentMethods-saveNew">
					<input id="wc-%1$s-new-payment-method" name="wc-%1$s-new-payment-method" type="checkbox" value="true" style="width:auto;" />
					<label for="wc-%1$s-new-payment-method" style="display:inline;">%2$s</label><br />
					%3$s
				</p>',
				esc_attr( $this->id ),
				esc_html__( 'Save to Account', 'woocommerce' ),
				apply_filters( 'wc_sagepaydirect_tokens_message', wp_kses_post( $this->tokens_message ) )
			);
		}

		/**
    	 * Validate the payment form
    	 */
		public function validate_fields() {

			try {

				$sage_card_type 		= isset($_POST[$this->id . '-card-type']) ? woocommerce_clean($_POST[$this->id . '-card-type']) : '';
				$sage_card_number 		= isset($_POST[$this->id . '-card-number']) ? woocommerce_clean($_POST[$this->id . '-card-number']) : '';
				$sage_card_cvc 			= isset($_POST[$this->id . '-card-cvc']) ? woocommerce_clean($_POST[$this->id . '-card-cvc']) : '';
				$sage_card_expiry		= isset($_POST[$this->id . '-card-expiry']) ? woocommerce_clean($_POST[$this->id . '-card-expiry']) : '';
				$sage_card_save_token	= isset($_POST['wc-sagepaydirect-new-payment-method']) ? woocommerce_clean($_POST['wc-sagepaydirect-new-payment-method']) : false;
				$sage_card_token 		= isset($_POST['wc-sagepaydirect-payment-token']) ? woocommerce_clean($_POST['wc-sagepaydirect-payment-token']) : false;

				/**
				 * Check if we need to validate card form
				 */
				if ( $sage_card_token === false || $sage_card_token === 'new' ) {

					// Format values
					$sage_card_number    	= str_replace( array( ' ', '-' ), '', $sage_card_number );
					$sage_card_expiry    	= array_map( 'trim', explode( '/', $sage_card_expiry ) );
					$sage_card_exp_month 	= str_pad( $sage_card_expiry[0], 2, "0", STR_PAD_LEFT );
					$sage_card_exp_year  	= $sage_card_expiry[1];

					// Validate values
					if ( empty( $sage_card_type ) || ctype_digit( $sage_card_type ) || !in_array($sage_card_type, $this->cardtypes ) ) {
						throw new Exception( __( 'Please choose a card type', 'woocommerce_sagepayform' ) );
					}

					if ( ( $this->cvv && !ctype_digit( $sage_card_cvc ) ) || ( $this->cvv && strlen( $sage_card_cvc ) < 3 ) || ( $this->cvv && strlen( $sage_card_cvc ) > 4 ) ) {
						throw new Exception( __( 'Card security code is invalid (only digits are allowed)', 'woocommerce_sagepayform' ) );
					}

					if ( !ctype_digit( $sage_card_exp_month ) || $sage_card_exp_month > 12 || $sage_card_exp_month < 1 ) {
						throw new Exception( __( 'Card expiration month is invalid', 'woocommerce_sagepayform' ) );
					}	

					if ( !ctype_digit( $sage_card_exp_year ) || $sage_card_exp_year < date('y') || strlen($sage_card_exp_year) != 2 ) {
						throw new Exception( __( 'Card expiration year is invalid', 'woocommerce_sagepayform' ) );
					}

					if ( empty( $sage_card_number ) || ! ctype_digit( $sage_card_number ) ) {
						throw new Exception( __( 'Card number is invalid', 'woocommerce_sagepayform' ) );
					}

					return true;
				} else {
					return true;
				}

			} catch( Exception $e ) {

				wc_add_notice( $e->getMessage(), 'error' );
				return false;

			}

		}

		/**
		 * Process the payment and return the result
		 */
		public function process_payment( $order_id ) {

			$sage_card_type 		= isset($_POST[$this->id . '-card-type']) ? woocommerce_clean($_POST[$this->id . '-card-type']) : '';
			$sage_card_number 		= isset($_POST[$this->id . '-card-number']) ? woocommerce_clean($_POST[$this->id . '-card-number']) : '';
			$sage_card_cvc 			= isset($_POST[$this->id . '-card-cvc']) ? woocommerce_clean($_POST[$this->id . '-card-cvc']) : '';
			$sage_card_expiry		= isset($_POST[$this->id . '-card-expiry']) ? woocommerce_clean($_POST[$this->id . '-card-expiry']) : false;
			$sage_card_save_token	= isset($_POST['wc-sagepaydirect-new-payment-method']) ? woocommerce_clean($_POST['wc-sagepaydirect-new-payment-method']) : false;
			$sage_card_token 		= isset($_POST['wc-sagepaydirect-payment-token']) ? woocommerce_clean($_POST['wc-sagepaydirect-payment-token']) : false;

			// Format values
			$sage_card_number    	= str_replace( array( ' ', '-' ), '', $sage_card_number );
			if( $sage_card_expiry != false ) {
				$sage_card_expiry    	= array_map( 'trim', explode( '/', $sage_card_expiry ) );
				$sage_card_exp_month 	= str_pad( $sage_card_expiry[0], 2, "0", STR_PAD_LEFT );
				$sage_card_exp_year  	= $sage_card_expiry[1];
			} else {
				$sage_card_exp_month 	= '';
				$sage_card_exp_year  	= '';
			}

			// woocommerce order instance
           	$order  = wc_get_order( $order_id );

           	// If the order has a 0
           	if( $order->get_total() == 0 ) {
           		// This is a subscription with a free trial period or a payment method change

				if( isset($_GET['change_payment_method']) && class_exists( 'WC_Subscriptions_Order' ) ) {
					/**
					 * Payment Method Change
					 */

	 				// Get parent order ID
	            	$subscription 		= new WC_Subscription( $order_id );
	            	$parent_order_id 	= $subscription->order->id;

	            	// Register the new token
					$register_token = $this->sagepay_register_token( $order->billing_first_name . ' ' . $order->billing_last_name, $sage_card_number, $sage_card_exp_month . $sage_card_exp_year, $sage_card_cvc, $sage_card_type );

					if ( $register_token['Status'] === 'OK' ) {
						// Save the new token
						$this->save_token( $register_token['Token'], $sage_card_type, substr( $sage_card_number, -4 ), $sage_card_exp_month, $sage_card_exp_year );
						// Update Parent Order with new token info
						update_post_meta( $parent_order_id, '_SagePayDirectToken' , str_replace( array('{','}'),'',$register_token['Token'] ) );
					} else {
						// Token creation failed
						$sage_card_save_token = false;
					}

					// This transaction uses an existing token
					// Just update the parent order with the new token
					if ( $sage_card_token !== false && $sage_card_token !== 'new' ) {
					
						$token = new WC_Payment_Token_CC();
						$token = WC_Payment_Tokens::get( $sage_card_token );
						if ( $token ) {
							if ( $token->get_user_id() == $order->customer_user ) {
								// Store the new token in the order
								update_post_meta( $parent_order_id, '_SagePayDirectToken' , $token->get_token() );
							}

						}

					}

					// Complete the order
           			$order->payment_complete();

				} else {
					/**
					 * Free Trial Period
					 */
					
					// This transaction uses an existing token
					// Just update the parent order with the new token
					if ( $sage_card_token !== false && $sage_card_token !== 'new' ) {
					
						$token = new WC_Payment_Token_CC();
						$token = WC_Payment_Tokens::get( $sage_card_token );
						if ( $token ) {
							if ( $token->get_user_id() == $order->customer_user ) {
								// Store the existing token in the order
								update_post_meta( $order->id, '_SagePayDirectToken' , str_replace( array('{','}'),'',$token->get_token() ) );
								// Complete the order
           						$order->payment_complete();
							}

						}

					} else {

						// Register the new token
						$register_token = $this->sagepay_register_token( $order->billing_first_name . ' ' . $order->billing_last_name, $sage_card_number, $sage_card_exp_month . $sage_card_exp_year, $sage_card_cvc, $sage_card_type );

						if ( $register_token['Status'] === 'OK' ) {

							$this->save_token( $register_token['Token'], $sage_card_type, substr( $sage_card_number, -4 ), $sage_card_exp_month, $sage_card_exp_year );
							// Store the token in the order
							update_post_meta( $order->id, '_SagePayDirectToken' , str_replace( array('{','}'),'',$register_token['Token'] ) );
							// Add Order note confirming token
							$order->add_order_note( $register_token['StatusDetail'] );

							// Complete the order
	           				$order->payment_complete();

						} else {

							// Token creation failed
							$sage_card_save_token = false;
							$order->add_order_note( $register_token['StatusDetail'] );

						}

					}

				}

				// Return thank you page redirect
				return array(
					'result'   => 'success',
					'redirect' => $this->get_return_url( $order )
				);

           	} else {
           		// This transaction requires payment, lets go
				/**
				 * Build data query for Sage
				 */
				$data = $this->build_query( $order, $sage_card_number, $sage_card_exp_month, $sage_card_exp_year, $sage_card_cvc, $sage_card_type, $sage_card_save_token, $sage_card_token );

				if( empty($data) ) {
					$this->sagepay_message( (__('Payment error, please try again', 'woocommerce_sagepayform') ) , 'error' );
				} else {

					/**
					 * Send $data to Sage
					 * @var [type]
					 */
					$sageresult = $this->sagepay_post( $data, $this->purchaseURL );

					if( isset($sageresult['Status']) && $sageresult['Status']!= '' ) {

						$sageresult = $this->process_response ( $sageresult, $order );

						// Store the $VendorTxCode for refunds etc.
						$VendorTxCode = WC()->session->get( 'VendorTxCode' );
						update_post_meta( $order->id, '_VendorTxCode' , $VendorTxCode );
						update_post_meta( $order->id, '_RelatedVendorTxCode' , $VendorTxCode );

						// Store the $txtype for RELEASE
						$txtype = $this->get_txtype( $order->id, $order->get_total() );
						update_post_meta( $order->id, '_SagePayTransactionType', $txtype );

						return array(
	            	       		'result'	=> $sageresult['result'],
	            	       		'redirect'	=> $sageresult['redirect']
	            	       	);

					} else {

	            	   	/**
	            	     * Payment Failed! - $sageresult['Status'] is empty
	            	  	 */
						$order->add_order_note( __('Payment failed, contact Sage. This transaction returned no status, you should contact Sage.', 'woocommerce_sagepayform') );

						$this->sagepay_message( (__('Payment error, please contact ' . get_bloginfo( 'admin_email' ), 'woocommerce_sagepayform') ) , 'error' );

					} // isset($sageresult['Status']) && $sageresult['Status']!= ''

				}

			}
	
		}

        /**
         * Authorise 3D Secure payments
         * 
         * @param int $order_id
         */
        function authorise_3dsecure( $order_id ) {

        	// woocommerce order instance
           	$order  = wc_get_order( $order_id );

           	$MD 		= WC()->session->get( 'MD' );
           	$PAReq 		= WC()->session->get( 'PAReq' );
           	$ACSURL 	= WC()->session->get( 'ACSURL' );
           	$TermURL 	= WC()->session->get( 'TermURL' );

            if( isset( $MD ) && isset( $PAReq ) && $PAReq != '' && isset( $ACSURL ) && isset( $TermURL ) ) { 

            	$redirect_page = 
            		'<!--Non-IFRAME browser support-->' .
                    '<SCRIPT LANGUAGE="Javascript"> function OnLoadEvent() { document.form.submit(); }</SCRIPT>' .
                    '<html><head><title>3D Secure Verification</title></head>' . 
                    '<body OnLoad="OnLoadEvent();">' .
                    '<form name="form" action="'. $ACSURL .'" method="post">' .
                    '<input type="hidden" name="PaReq" value="' . $PAReq . '"/>' .                
                    '<input type="hidden" name="MD" value="' . $MD . '"/>' .
                    '<input type="hidden" name="TermURL" value="' . $TermURL . '"/>' .
                    '<NOSCRIPT>' .
                    '<center><p>Please click button below to Authenticate your card</p><input type="submit" value="Go"/></p></center>' .
                    '</NOSCRIPT>' .
                    '</form></body></html>';

                $iframe_page = 
                	'<iframe src="' . $this->iframe_3d_redirect . '" name="3diframe" width="100%" height="500px" >' .
                    $redirect_page .
                    '</iframe>';
                    
                echo $iframe_page;
				return;

            }

            if ( isset($_POST['MD']) && isset($_POST['PARes']) ) {

				$redirect_url = $this->get_return_url( $order );

				try {

					// set the URL that will be posted to.
					$url 		 = $this->callbackURL;
					$sage_result = array();

					$data  = 'MD=' . $_POST['MD'];
					$data .='&PaRes=' . $_POST['PARes'];

					/**
					 * Send $data to Sage
					 * @var [type]
					 */
					$sageresult = $this->sagepay_post( $data, $url );

					if( isset( $sageresult['Status']) && $sageresult['Status']!= '' && $sageresult['Status']!= 'REJECTED' ) {

						$sageresult = $this->process_response( $sageresult, $order );

					} elseif( isset( $sageresult['Status']) && $sageresult['Status']!= '' && $sageresult['Status']== 'REJECTED' ) {

						$redirect_url = $order->get_checkout_payment_url();
						throw new Exception( __('3D Secure Payment error, please try again.', 'woocommerce_sagepayform')  );

						unset( $_POST['MD'] );
						unset( $_POST['PARes'] );

					} else {

						$redirect_url = $order->get_checkout_payment_url();

						/**
            	    	 * Payment Failed! - $sageresult['Status'] is empty
            	  		 */
						$order->add_order_note( __('Payment failed at 3D Secure, contact Sage. This transaction returned no status, you should contact Sage.', 'woocommerce_sagepayform') );

						throw new Exception( __('3D Secure Payment error, please try again.' ), 'woocommerce_sagepayform');

						unset( $_POST['MD'] );
						unset( $_POST['PARes'] );

					}

				} catch( Exception $e ) {
					wc_add_notice( $e->getMessage(), 'error' );
				}

				wp_redirect( $redirect_url );
				exit;

            }

        } // end auth_3dsecure

		function build_query ( $order, $sage_card_number = '', $sage_card_exp_month = '', $sage_card_exp_year = '', $sage_card_cvc = '', $sage_card_type = '', $sage_card_save_token = false, $sage_card_token = false ) {

			// Make sure $details is an array
			$details = array();

			// woocommerce order instance
			if ( !is_object($order) ) {
				$order  = wc_get_order( $order );
			}

			// set $registered_token to false
			$registered_token = false;

			/**
			 * Create Token if $sage_card_token is 'new'
			 */
			if ( $sage_card_token === 'new' && $sage_card_save_token) {

				$register_token = $this->sagepay_register_token( $order->billing_first_name . ' ' . $order->billing_last_name, $sage_card_number, $sage_card_exp_month . $sage_card_exp_year, $sage_card_cvc, $sage_card_type );
				
				if ( $register_token['Status'] === 'OK' ) {

					$this->save_token( $register_token['Token'], $sage_card_type, substr( $sage_card_number, -4 ), $sage_card_exp_month, $sage_card_exp_year );

					$order->add_order_note( $register_token['StatusDetail'] );

					$registered_token = true;

				} else {

					// Token creation failed
					$sage_card_save_token = false;
					$order->add_order_note( $register_token['StatusDetail'] );

				}

			} // Create Token if $sage_card_token is true

			/**
			 * Let's start building the data array to process the transaction
			 */
			if( $sage_card_save_token && $registered_token ) {

				// We are using the new token 
				$details = array(
					"Token" 			=>	str_replace( array('{','}'),'',$register_token['Token'] ),
					"StoreToken" 		=>	"1",
					"Apply3DSecure" 	=>	$this->secure,
				);

				// Store the token in the order
				update_post_meta( $order->id, '_SagePayDirectToken' , str_replace( array('{','}'),'',$register_token['Token'] ) );
						
			} elseif ( $sage_card_token !== false && $sage_card_token !== 'new' ) {
				// This transaction uses an existing token
				// Turn off CV2 requirement for tokens, it's already been checked when the token was created
				// CV2 numbers can not be stored
				// Don't apply 3D Secure rules 
				$token = new WC_Payment_Token_CC();
				$token = WC_Payment_Tokens::get( $sage_card_token );
				if ( $token ) {
					if ( $token->get_user_id() == $order->customer_user ) {
		    			$details = array(
							"Token" 			=>	$token->get_token(),
							"StoreToken" 		=>	"1",
							"ApplyAVSCV2" 		=>	"2",
							"Apply3DSecure"		=>	"2",
						);

						// Store the token in the order
						update_post_meta( $order->id, '_SagePayDirectToken' , $token->get_token() );
					}

				}

			} else {
				$details = array(
					"CardHolder" 		=>	$order->billing_first_name . ' ' . $order->billing_last_name,
					"CardNumber" 		=>	$sage_card_number,
					"ExpiryDate"		=>	$sage_card_exp_month . $sage_card_exp_year,
					"CV2"				=>	$sage_card_cvc,
					"CardType"			=>	$this->cc_type( $sage_card_number, $sage_card_type ),
					"ApplyAVSCV2" 		=>	$this->cvv,
					"Apply3DSecure" 	=>	$this->secure,
				);

			}

		    $VendorTxCode = WC_Sagepay_Common_Functions::build_vendortxcode( $order, $this->id, $this->vendortxcodeprefix );

		    WC()->session->set( "VendorTxCode", $VendorTxCode );

			// make your query.
			$data	 = array(
				"VPSProtocol"		=>	$this->vpsprotocol,
				"TxType"			=>	$this->get_txtype( $order->id, $order->get_total() ),
				"Vendor"			=>	$this->vendor,
				"VendorTxCode" 		=>	$VendorTxCode,
				"Amount" 			=>	$order->get_total(),
				"Currency"			=>	WC_Sagepay_Common_Functions::get_order_currency( $order ),
				"Description"		=>	 __( 'Order', 'woocommerce_sagepayform' ) . ' ' . str_replace( '#' , '' , $order->get_order_number() ),
				"BillingSurname"	=>	$order->billing_last_name,
				"BillingFirstnames" =>	$order->billing_first_name,
				"BillingAddress1"	=>	$order->billing_address_1,
				"BillingAddress2"	=>	$order->billing_address_2,
				"BillingCity"		=>	$order->billing_city,
				"BillingPostCode"	=>	$this->billing_postcode( $order->billing_postcode ),
				"BillingCountry"	=>	$order->billing_country,
				"BillingState"		=>	$this->get_state( $order->billing_country, 'billing', $order ),
				"BillingPhone"		=>	$order->billing_phone,
				"DeliverySurname" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliverysurname', $order->shipping_last_name ),
				"DeliveryFirstnames"=>	apply_filters( 'woocommerce_sagepay_direct_deliveryfirstname', $order->shipping_first_name ),
				"DeliveryAddress1" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliveryaddress1', $order->shipping_address_1 ),
				"DeliveryAddress2" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliveryaddress2', $order->shipping_address_2 ),
				"DeliveryCity" 		=>	apply_filters( 'woocommerce_sagepay_direct_deliverycity', $order->shipping_city ),
				"DeliveryPostCode" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliverypostcode', $order->shipping_postcode ),
				"DeliveryCountry" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliverycountry', $order->shipping_country ),
				"DeliveryState" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliverystate', $this->get_state( $order->shipping_country, 'shipping', $order ) ),
				"DeliveryPhone" 	=>	apply_filters( 'woocommerce_sagepay_direct_deliveryphone', $order->billing_phone ),
				"CustomerEMail" 	=>	$order->billing_email,
				"AllowGiftAid" 		=>	$this->allowgiftaid,
				"ClientIPAddress" 	=>	$this->get_ipaddress(),
				"AccountType" 		=>	$this->accounttype,
				"BillingAgreement" 	=>	$this->billingagreement,
				"ReferrerID" 		=>	$this->referrerid,
				"Website" 			=>	site_url()
			);
				
			// Check basket length, Sage limits basket to 7500 characters.
			$basket = WC_Sagepay_Common_Functions::sagepay_basket( $order->id );
			if( mb_strlen( $basket ) <= 7500 ) {
				$data["Basket"] = $basket;
			}

			/**
			 * Combine $details and $data to send to Sage
			 */
			if( !empty($details) && !empty($data) ) {
				$data = $details + $data;
			} else {
				$data = array();
			}

			// Filter the args if necessary, use with caution
            $data = apply_filters( 'woocommerce_sagepay_direct_data', $data, $order );

			/**
			 * Debugging
			 */
	  		if ( $this->debug == true ) {
	  			WC_Sagepay_Common_Functions::sagepay_debug( $data, $this->id, __('Sent to SagePay : ', 'woocommerce_sagepayform'), TRUE );
			}

			/**
			 * Convert the $data array for Sage
			 */
			$data = http_build_query( $data, '', '&' );

			return $data;
		}

		/**
		 * Send the info to Sage for processing
		 * https://test.sagepay.com/showpost/showpost.asp
		 */
        function sagepay_post( $data, $url ) {

			$res = wp_remote_post( $url, array(
												'method' 		=> 'POST',
												'timeout' 		=> 45,
												'redirection' 	=> 5,
												'httpversion' 	=> '1.0',
												'blocking' 		=> true,
												'headers' 		=> array('Content-Type'=> 'application/x-www-form-urlencoded'),
												'body' 			=> $data,
												'cookies' 		=> array()
    										)
										);

			if( is_wp_error( $res ) ) {

				/**
				 * Debugging
				 */
  				if ( $this->debug == true ) {
  					WC_Sagepay_Common_Functions::sagepay_debug( $res->get_error_message(), $this->id, __('Remote Post Error : ', 'woocommerce_sagepayform'), FALSE );
				}

			} else {

				/**
				 * Debugging
				 */
				if ( $this->debug == true ) {
  					WC_Sagepay_Common_Functions::sagepay_debug( $res['body'], $this->id, __('SagePay Direct Return : ', 'woocommerce_sagepayform'), FALSE );
				}

				return $this->sageresponse( $res['body'] );

			}

        }

        /**
         * process_response
         *
         * take the reponse from Sage and do some magic things.
         * 
         * @param  [type] $sageresult [description]
         * @param  [type] $order      [description]
         * @return [type]             [description]
         */
        function process_response( $sageresult, $order ) {

       		switch( strtoupper($sageresult['Status']) ) {
                case 'OK':
               	case 'REGISTERED':
               	case 'AUTHENTICATED':
						
					/**
					 * Successful payment
					 */
					$successful_ordernote = '';

					foreach ( $sageresult as $key => $value ) {
						$successful_ordernote .= $key . ' : ' . $value . "\r\n";
					}

					$order->add_order_note( __('Payment completed', 'woocommerce_sagepayform') . '<br />' . $successful_ordernote );

					update_post_meta( $order->id, '_VPSTxId' , str_replace( array('{','}'),'',$sageresult['VPSTxId'] ) );
					update_post_meta( $order->id, '_SecurityKey' , $sageresult['SecurityKey'] );
					update_post_meta( $order->id, '_TxAuthNo' , $sageresult['TxAuthNo'] );

					update_post_meta( $order->id, '_RelatedVPSTxId' , str_replace( array('{','}'),'',$sageresult['VPSTxId'] ) );
					update_post_meta( $order->id, '_RelatedSecurityKey' , $sageresult['SecurityKey'] );
					update_post_meta( $order->id, '_RelatedTxAuthNo' , $sageresult['TxAuthNo'] );

					update_post_meta( $order->id, '_AVSCV2' , $sageresult['AVSCV2'] );
					update_post_meta( $order->id, '_AddressResult' , $sageresult['AddressResult'] );
					update_post_meta( $order->id, '_PostCodeResult' , $sageresult['PostCodeResult'] );
					update_post_meta( $order->id, '_CV2Result' , $sageresult['CV2Result'] );
					update_post_meta( $order->id, '_3DSecureStatus' , $sageresult['3DSecureStatus'] );

					if ( class_exists('WC_Pre_Orders') && WC_Pre_Orders_Order::order_contains_pre_order( $order->id ) ) {
						// mark order as pre-ordered / reduce order stock
						WC_Pre_Orders_Order::mark_order_as_pre_ordered( $order );
					} else {
						$order->payment_complete( str_replace( array('{','}'),'',$sageresult['VPSTxId'] ) );
					}

					/**
					 * Empty awaiting payment session
					 */
					unset( WC()->session->order_awaiting_payment );
						
					/**
					 * Return thank you redirect
					 */
					$redirect = $this->get_return_url( $order );
                	
                    /**
                     * Return thank you page redirect
                     */
                    $sageresult['result'] 	= 'success';
                    $sageresult['redirect'] = $redirect;

                    return $sageresult;

                break;

                case '3DAUTH':

                	WC()->session->set( "MD", $sageresult['MD'] );
                	WC()->session->set( "ACSURL", $sageresult['ACSURL'] );
                	WC()->session->set( "PAReq", $sageresult['PAReq'] );
                	WC()->session->set( "TermURL", WC_HTTPS::force_https_url( $this->iframe_3d_callback ) );
                	WC()->session->set( "TermURL", $this->iframe_3d_callback );
                	WC()->session->set( "Complete3d", $order->get_checkout_payment_url( true ) );

                    /**
                     * go to the pay page for 3d securing
                     */
           			$sageresult['result'] 	= 'success';
                    $sageresult['redirect'] = $order->get_checkout_payment_url( true );
                    
                    return $sageresult;
                
                break;

                case 'NOTAUTHED':
                case 'MALFORMED':
                case 'INVALID':
                case 'ERROR':
                	/**
                	 * Payment Failed!
                	 */
					$order->add_order_note( __('Payment failed', 'woocommerce_sagepayform') . '<br />' .
													$sageresult['StatusDetail']
												);

					$this->sagepay_message( (__('Payment error', 'woocommerce_sagepayform') . ': ' . $sageresult['StatusDetail'] ) , 'error' );

				break;

				case 'REJECTED':
                	/**
                	 * Payment Failed!
                	 */
					$order->add_order_note( __('Payment failed, there was a problem with 3D Secure', 'woocommerce_sagepayform') . '<br />' .
													$sageresult['StatusDetail']
												);

					$this->sagepay_message( (__('Payment error, there was a problem with 3D Secure', 'woocommerce_sagepayform') . ': ' . $sageresult['StatusDetail'] ) , 'error' );

					WC()->session->set( "MD", '' );
                	WC()->session->set( "ACSURL", '' );
                	WC()->session->set( "PAReq", '' );
                	WC()->session->set( "TermURL", '' );
                	WC()->session->set( "TermURL", '' );
                	WC()->session->set( "Complete3d", '' );
				
                    /**
                     * go to the pay page for 3d securing
                     */
           			$sageresult['result'] 	= 'success';
                    $sageresult['redirect'] = $order->get_checkout_payment_url();

                    return $sageresult;

				break;

                default:

                	/**
                	 * Payment Failed!
                	 */
					$order->add_order_note( __('Payment failed, contact Sage. This transaction returned no status, you should contact Sage. ' . $sageresult['StatusDetail'], 'woocommerce_sagepayform') );

					$this->sagepay_message( (__('Payment error, please contact ' . get_bloginfo( 'admin_email' ), 'woocommerce_sagepayform') ) , 'error' );

				break;

			}

        }

		/**
		 * sagepay_message
		 * 
		 * return checkout messages / errors
		 * 
		 * @param  [type] $message [description]
		 * @param  [type] $type    [description]
		 * @return [type]          [description]
		 */
		function sagepay_message( $message, $type ) {

			if ( function_exists( 'wc_add_notice' ) ) {
				return wc_add_notice( $message, $type );
			} else {
				return WC()->add_error( $e->getMessage() );
			}

		}

		/**
		 * sageresponse
		 *
		 * take response from Sage and process it into an array
		 * 
		 * @param  [type] $array [description]
		 * @return [type]        [description]
		 */
		function sageresponse( $array ) {

			$response 		= array();
			$sagelinebreak 	= $this->sage_line_break( $this->sagelinebreak );
            $results  		= preg_split( $sagelinebreak, $array );

            foreach( $results as $result ){ 

            	$value = explode( '=', $result, 2 );
                $response[trim($value[0])] = trim($value[1]);

            }

            return $response;

		}

	    /**
		 * Credit Card Fields.
		 *
		 * Core credit card form which gateways can used if needed.
		 */
    	function sagepay_credit_card_form() {

			wp_enqueue_script( 'wc-credit-card-form' );

			$card_options = '<option value = "0">Card Type</option>';
			foreach ( $this->cardtypes as  $key => $value ) {
				$card_options .= '<option value="' . $value . '">' . $value . '</option>';
			}

			$fields = array(
				'card-type-field' => '<p class="form-row form-row-wide">
					<label for="' . $this->id . '-card-type">' . __( "Card Type", 'woocommerce' ) . ' <span class="required">*</span></label>
	            	<select id="' . $this->id . '-card-type" class="input-text wc-credit-card-form-card-type" name="' . $this->id . '-card-type" >' . $card_options . ' </select>
				</p>',
				'card-number-field' => '<p class="form-row form-row-wide">
					<label for="' . $this->id . '-card-number">' . __( "Card Number", 'woocommerce' ) . ' <span class="required">*</span></label>
					<input id="' . $this->id . '-card-number" class="input-text wc-credit-card-form-card-number" type="text" maxlength="20" autocomplete="off" placeholder="•••• •••• •••• ••••" name="' . $this->id . '-card-number" />
				</p>',
				'card-expiry-field' => '<p class="form-row form-row-first">
					<label for="' . $this->id . '-card-expiry">' . __( "Expiry (MM/YY)", 'woocommerce' ) . ' <span class="required">*</span></label>
					<input id="' . $this->id . '-card-expiry" class="input-text wc-credit-card-form-card-expiry" type="text" autocomplete="off" placeholder="MM / YY" name="' . $this->id . '-card-expiry" />
				</p>',
				'card-cvc-field' => '<p class="form-row form-row-last">
					<label for="' . $this->id . '-card-cvc">' . __( "Card Code", 'woocommerce' ) . ' <span class="required">*</span></label>
					<input id="' . $this->id . '-card-cvc" class="input-text wc-credit-card-form-card-cvc" type="text" autocomplete="off" placeholder="CVC" name="' . $this->id . '-card-cvc" />
				</p>'
			);
			
			// Add token option to checkout field if setting is set to optional
//			if( $this->saved_cards == 'optional' ) {

//				$fields['card-token-field'] =  '<p class="form-row form-row-first">
//					<label for="' . $this->id . '-card-token">' . __( "Card Code", 'woocommerce' ) . ' <span class="required">*</span></label>
//					<input id="' . $this->id . '-card-token" class="input-text wc-credit-card-form-card-token" type="text" autocomplete="off" placeholder="CVC" name="' . $this->id . '-card-token" />
//					<br />
//				</p>';

//			}

			// Allow fields to be filtered if required
			$fields = apply_filters( 'woocommerce_sagepaydirect_credit_card_form_fields', $fields );

			?>
			<fieldset id="<?php echo $this->id; ?>-cc-form">
<?php 			
				do_action( 'woocommerce_credit_card_form_before', $this->id ); 
				foreach( $fields as $field ) {
					echo $field;
				}
				do_action( 'woocommerce_credit_card_form_after', $this->id ); 
?>
				<div class="clear"></div>
			</fieldset>
			<?php
    	}

    	/**
    	 * Sage has specific requirements for the credit card type field
    	 * @param  [type] $cardNumber   [description]
    	 * @param  [type] $card_details [description]
    	 * @return [type]               [Card Type]
    	 */
		function cc_type( $cardNumber, $card_details ) {

			$replace = array(
							'VISAELECTRON' 					=> 'UKE',
							'VISAPURCHASING'				=> 'VISA',
							'VISADEBIT' 					=> 'DELTA',
							'VISACREDIT' 					=> 'VISA',
							'MASTERCARDDEBIT' 				=> 'MCDEBIT',
							'MASTERCARDCREDIT' 				=> 'MC',
							'MasterCard Debit'				=> 'MCDEBIT',
							'MasterCard'					=> 'MC',
							'Visa Debit'					=> 'DELTA',
							'Visa'							=> 'VISA',
							'Discover'						=> 'DC',
							'American Express' 				=> 'AMEX',
							'Maestro'						=> 'MAESTRO',
							'JCB'							=> 'JCB',
							'Laser'							=> 'LASER'
			);

			$replace = apply_filters( 'woocommerce_sagepay_direct_cardtypes_array', $replace );

			// Clean up the card_details in to Sage format
			$card_details = $this->str_replace_assoc( $replace,$card_details );

			return $card_details;

    	}

    	/**
    	 * Sage has specific requirements for the credit card type field
    	 * @param  [type] $cardNumber   [description]
    	 * @param  [type] $card_details [description]
    	 * @return [type]               [Card Type]
    	 */
		function cc_type_name( $cc_type ) {

			$replace = array(
							'UKE' 		=> 'Electron',
							'VISA'		=> 'Visa',
							'DELTA' 	=> 'Visa Debit',
							'MCDEBIT' 	=> 'Mastercard Debit',
							'MC' 		=> 'Mastercard',
							'DC'		=> 'Discover',
							'AMEX' 		=> 'AMEX',
							'MAESTRO'	=> 'Maestro',
							'JCB'		=> 'JCB',
							'LASER'		=> 'Laser'
			);

			$replace = apply_filters( 'woocommerce_sagepay_direct_cardnames_array', $replace );

			// Clean up the card_details in to Sage format
			$cc_type_name = $this->str_replace_assoc( $replace, strtoupper($cc_type) );

			return $cc_type_name;

    	}

        /**
         * Load the settings fields.
         *
         * @access public
         * @return void
         */
        function init_form_fields() {	
			include ( SAGEPLUGINPATH . 'includes/sagepay-direct-admin.php' );
		}

		/**
		 * Check if SSL is enabled and notify the user
	 	 */
		function sagepaydirect_ssl_check() {

			if( $this->enabled == "yes" ) {
	     
		    	if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'no' && ! class_exists( 'WordPressHTTPS' ) ) {
		     		echo '<div class="error notice sagepaydirect-ssl-nag is-dismissible"><p>'.sprintf(__('SagePay Direct is enabled and the <a href="%s">force SSL option</a> is disabled; your checkout is not secure! Please enable SSL and ensure your server has a valid SSL certificate before going live.', 'woocommerce_sagepayform'), admin_url('admin.php?page=woocommerce')).'</p></div>';
		    	}

		    }

		}

		/**
		 * Enqueue scipts for the CC form.
		 */
		function sagepaydirect_scripts() {
			wp_enqueue_style( 'wc-sagepaydirect', SAGEPLUGINURL.'assets/css/checkout.css' );

			if ( ! wp_script_is( 'jquery-payment', 'registered' ) ) {
				wp_register_script( 'jquery-payment', SAGEPLUGINURL.'assets/js/jquery.payment.js', array( 'jquery' ), '1.0.2', true );
			}

			if ( ! wp_script_is( 'wc-credit-card-form', 'registered' ) ) {
				wp_register_script( 'wc-credit-card-form', SAGEPLUGINURL.'assets/js/credit-card-form.js', array( 'jquery', 'jquery-payment' ), WC()->version, true );
			}

		}

		/**
		 * Enqueues our tokenization script to handle some of the new form options.
		 * @since 2.6.0
		 */
		public function tokenization_script() {
			wp_enqueue_script(
				'sagepay-tokenization-form',
				SAGEPLUGINURL.'assets/js/tokenization-form.js',
				array( 'jquery' ),
				WC()->version
			);
		}

		/**
		 * [get_icon description] Add selected card icons to payment method label, defaults to Visa/MC/Amex/Discover
		 * @return [type] [description]
		 */
		public function get_icon() {
			return WC_Sagepay_Common_Functions::get_icon( $this->cardtypes, $this->sagelink, $this->sagelogo, $this->id );
		}

		/**
		 * SagePay Direct Refund Processing
		 * @param  Varien_Object $payment [description]
		 * @param  [type]        $amount  [description]
		 * @return [type]                 [description]
		 */
    	function process_refund( $order_id, $amount = NULL, $reason = '' ) {

    		$order 			= new WC_Order( $order_id );

			$VendorTxCode 	= 'Refund-' . $order_id . '-' . time();

            // SAGE Line 50 Fix
            $VendorTxCode 	= str_replace( 'order_', '', $VendorTxCode );

            // Fix for missing '_VendorTxCode'
            $_VendorTxCode 			= get_post_meta( $order_id, '_VendorTxCode', true );
            $_RelatedVendorTxCode 	= get_post_meta( $order_id, '_RelatedVendorTxCode', true );

            if ( !isset($_VendorTxCode) || $_VendorTxCode == '' ) {
            	$_VendorTxCode = $_RelatedVendorTxCode;
            }

			// New API Request for cancellations
			$api_request 	 = 'VPSProtocol=' . urlencode( $this->vpsprotocol );
			$api_request 	.= '&TxType=REFUND';
			$api_request   	.= '&Vendor=' . urlencode( $this->vendor );
			$api_request 	.= '&VendorTxCode=' . $VendorTxCode;
			$api_request   	.= '&Amount=' . urlencode( $amount );
			$api_request 	.= '&Currency=' . get_post_meta( $order_id, '_order_currency', true );
			$api_request 	.= '&Description=Refund for order ' . $order_id;
			$api_request	.= '&RelatedVPSTxId=' . get_post_meta( $order_id, '_VPSTxId', true );
			$api_request	.= '&RelatedVendorTxCode=' . $_VendorTxCode;
			$api_request	.= '&RelatedSecurityKey=' . get_post_meta( $order_id, '_SecurityKey', true );
			$api_request	.= '&RelatedTxAuthNo=' . get_post_meta( $order_id, '_TxAuthNo', true );

			$result = $this->sagepay_post( $api_request, $this->refundURL );

			if ( 'OK' != $result['Status'] ) {

					$content = 'There was a problem refunding this payment for order ' . $order_id . '. The Transaction ID is ' . $api_request['RelatedVPSTxId'] . '. The API Request is <pre>' . 
						print_r( $api_request, TRUE ) . '</pre>. SagePay returned the error <pre>' . 
						print_r( $result['StatusDetail'], TRUE ) . '</pre> The full returned array is <pre>' . 
						print_r( $result, TRUE ) . '</pre>. ';
					
					wp_mail( $this->notification ,'SagePay Refund Error ' . $result['Status'] . ' ' . time(), $content );

			} else {

				$refund_ordernote = '';

				foreach ( $result as $key => $value ) {
					$refund_ordernote .= $key . ' : ' . $value . "\r\n";
				}

				$order->add_order_note( __('Refund successful', 'woocommerce_sagepayform') . '<br />' . 
										__('Refund Amount : ', 'woocommerce_sagepayform') . $amount . '<br />' .
										__('Refund Reason : ', 'woocommerce_sagepayform') . $reason . '<br />' .
										__('Full return from SagePay', 'woocommerce_sagepayform') . '<br />' .
										$refund_ordernote );
		
				return true;
		
			}

    	} // process_refund
    	
		/**
		 * @return bool
		 */
		function is_session_started() {
    		
    		if ( php_sapi_name() !== 'cli' ) {
        		
        		if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            		return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        		} else {
            		return session_id() === '' ? FALSE : TRUE;
        		}
    		
    		}
    		
    		return FALSE;
		
		}

		public function str_replace_assoc(array $replace, $subject) {
   			return str_replace( array_keys($replace), array_values($replace), $subject );   
		}

		/**
		 * Set a default postcode for Elavon users
		 */
		function billing_postcode( $postcode ) {
			if ( '' != $postcode ) {
				return $postcode;
			} else {
				return $this->defaultpostcode;
			}

		}

		/**
		 * Set billing or shipping state
		 */
		function get_state( $country, $billing_or_shipping, $order ) {

			if ( $billing_or_shipping == 'billing' ) {
            	
            	if ( $country == 'US' ) {
            		return  $order->billing_state;
            	} else {
            		return '';
            	}

            } elseif ( $billing_or_shipping == 'shipping' ) {
            	
            	if ( $country == 'US' ) {
            		return  $order->shipping_state;
            	} else {
            		return '';
            	}

            }

		}

		/**
		 * [sage_line_break description]
		 * Set line break
		 */
		function sage_line_break ( $sage_line_break ) {
			
			switch ( $sage_line_break ) {
    			case '0' :
        			$line_break = '/$\R?^/m';
        			break;
    			case '1' :
        			$line_break = PHP_EOL;
        			break;
    			case '2' :
        			$line_break = '#\n(?!s)#';
        			break;
        		case '3' :
        			$line_break = '#\r(?!s)#';
        			break;
    			default:
       				$line_break = '/$\R?^/m';
			}

			return $line_break;
		
		}

		/**
		 * Get IP Address
		 */
		function get_ipaddress() {

			if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
    			$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
    			$userip 	= $_SERVER['HTTP_X_FORWARDED_FOR'];
    			$userip		= explode( ',', $userip );
    			$ip = $userip[0];
			} else {
    			$ip = $_SERVER['REMOTE_ADDR'];
			}

			// Sage won't accept IP6 so reject anything over 15 characters.
			if( mb_strlen( $ip ) > 15 ) {
				$ip = '';
			}

			return $ip;
		}

        /**
         * sagepay_register_token
         * Send transaction for token registration, no money will be taken this time.
         * 
         * @return [type] [description]
         */
        function sagepay_register_token( $CardHolder, $CardNumber, $ExpiryDate, $CV2, $CardType ) {
            /**
             * Sent to : 
             * https://test.sagepay.com/gateway/service/directtoken.vsp
             * https://live.sagepay.com/gateway/service/directtoken.vsp
             * 
             * requires : 
             * VPSProtocol => 3.00
             * TxType => TOKEN
             * Vendor => From settings
             * Currency => GBP
             * Cardholder => From form
             * CardNumber => From form
             * ExpiryDate => From form
             * CV2 => From form
             * CardType => From form
             *
             * Returns :
             * VPSProtocol => 3.00
             * TxType => TOKEN
             * Status => (OK, MALFORMED, INVALID, ERROR)
             * StatusDetail => ''
             */

            $data    = array(
                "VPSProtocol"       => $this->vpsprotocol,
                "TxType"            => 'TOKEN',
                "Vendor"            => $this->vendor,
                "Currency"          => get_woocommerce_currency(),
                "Cardholder"        => $CardHolder,
                "CardNumber"        => $CardNumber,
                "ExpiryDate"        => $ExpiryDate,
                "CV2"               => $CV2,
                "CardType"          => $this->cc_type( $CardNumber, $CardType ),
            );

            /**
             * Convert the $data array for Sage
             */
            $data = http_build_query( $data, '', '&' );

            $sageresult = $this->sagepay_post( $data, $this->addtokenURL );

            return $sageresult;

        }

		/**
		 * Add payment method via account screen.
		 * @since 3.0.0
		 */
		public function add_payment_method() {

			if( is_user_logged_in() ) {     
			
				$sage_card_type 		= isset($_POST[$this->id . '-card-type']) ? woocommerce_clean($_POST[$this->id . '-card-type']) : '';
				$sage_card_number 		= isset($_POST[$this->id . '-card-number']) ? woocommerce_clean($_POST[$this->id . '-card-number']) : '';
				$sage_card_cvc 			= isset($_POST[$this->id . '-card-cvc']) ? woocommerce_clean($_POST[$this->id . '-card-cvc']) : '';
				$sage_card_expiry		= isset($_POST[$this->id . '-card-expiry']) ? woocommerce_clean($_POST[$this->id . '-card-expiry']) : '';

				// Format values
				$sage_card_number    	= str_replace( array( ' ', '-' ), '', $sage_card_number );
				$sage_card_expiry    	= array_map( 'trim', explode( '/', $sage_card_expiry ) );
				$sage_card_exp_month 	= str_pad( $sage_card_expiry[0], 2, "0", STR_PAD_LEFT );
				$sage_card_exp_year  	= $sage_card_expiry[1];

				$CardHolder 			= $order->billing_first_name . ' ' . $order->billing_last_name;

				$sage_add_card_error 	= false;

				/**
				 * Create Token if $sage_card_token is true
				 */
				$register_token = $this->sagepay_register_token( $CardHolder, $sage_card_number, $sage_card_exp_month . $sage_card_exp_year, $sage_card_cvc, $sage_card_type );

				if ( $register_token['Status'] === 'OK' ) {

					$this->save_token( $register_token['Token'], $sage_card_type, substr( $sage_card_number, -4 ), $sage_card_exp_month, $sage_card_exp_year );

					return array(
						'result'   => 'success',
						'redirect' => wc_get_endpoint_url( 'payment-methods' ),
					);

				} else {
					wc_add_notice( __( 'There was a problem adding the card. ' . $register_token['StatusDetail'], 'woocommerce_sagepayform' ), 'error' );
					return;
				}

			} else {
				wc_add_notice( __( 'There was a problem adding the card. Please make sure you are logged in.', 'woocommerce_sagepayform' ), 'error' );
				return;
			}

		}

		/**
		 * Use the txtype from settings unless the order contains a pre-order or the order value is 0
		 *
		 * @param  {[type]} $order_id [description]
		 * @param  {[type]} $amount   [description]
		 * @return {[type]}           [description]
		 */
		function get_txtype( $order_id, $amount ) {

			if( class_exists( 'WC_Pre_Orders' ) && WC_Pre_Orders_Order::order_contains_pre_order( $order_id ) ) {
				return 'AUTHENTICATE';
			} elseif( $amount == 0 ) {
				return 'AUTHENTICATE';
			} else {
				return $this->txtype;
			}

		}

		/**
		 * [save_token description]
		 * @param  [type] $token        [description]
		 * @param  [type] $card_type    [description]
		 * @param  [type] $last4        [description]
		 * @param  [type] $expiry_month [description]
		 * @param  [type] $expiry_year  [description]
		 * @return [type]               [description]
		 */
		function save_token( $sagetoken, $card_type, $last4, $expiry_month, $expiry_year ) {
					
			$token = new WC_Payment_Token_CC();

			$token->set_token( str_replace( array('{','}'),'',$sagetoken ) );
			$token->set_gateway_id( $this->id );
			$token->set_card_type( $this->cc_type_name( $this->cc_type( '', $card_type ) ) );
			$token->set_last4( $last4 );
			$token->set_expiry_month( $expiry_month );
			$token->set_expiry_year( 2000 + $expiry_year );
			$token->set_user_id( get_current_user_id() );

			$token->save();

		}

	} // END CLASS
