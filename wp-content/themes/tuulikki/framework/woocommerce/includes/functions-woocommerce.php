<?php

	function ilgelo_woocommerce_getcart() {
		global $woocommerce;
		return $woocommerce->cart->get_cart();
	}
	function ilgelo_woocommerce_getcart_subtotal() {
		global $woocommerce;
		return $woocommerce->cart->get_cart_subtotal();
	}
	function ilgelo_woocommerce_get_checkout_url() {
		global $woocommerce;
		return $woocommerce->cart->get_checkout_url();
	}
	function ilgelo_woocommerce_get_viewcart_url() {
		global $woocommerce;
		return $woocommerce->cart->get_cart_url();
	}
	function ilgelo_woocommerce_get_cart_contents_count() {
		global $woocommerce;
		return $woocommerce->cart->get_cart_contents_count();
	}
	function ilgelo_woocommerce_get_removeproduct_url($item) {
		global $woocommerce;
		return $woocommerce->cart->get_remove_url($item);
	}
	function ilgelo_woocommerce_get_myaccount_url() {
		return get_permalink(get_option('woocommerce_myaccount_page_id'));
	}
	function ilgelo_woocommerce_get_changepassword_url() {
		global $woocommerce;
		$url="";
		if(version_compare($woocommerce->version, "2.1", "<")) {
			$url=get_permalink(get_option('woocommerce_change_password_page_id'));
		} else {
			$url=wc_customer_edit_account_url();
		}
		return $url;
	}
	function ilgelo_woocommerce_get_editaddress_url() {
		global $woocommerce;
		$url="";
		if(version_compare($woocommerce->version, "2.1", "<")) {
			$url=get_permalink(get_option('woocommerce_edit_address_page_id'));
		} else {
			$url=wc_get_endpoint_url("edit-address", "", get_permalink(wc_get_page_id("myaccount")));
		}
		return $url;
	}
	function ilgelo_woocommerce_get_vieworder_url() {
		global $woocommerce;
		$url="";
		if(version_compare($woocommerce->version, "2.1", "<")) {
			$url=get_permalink(get_option('woocommerce_view_order_page_id'));
		} else {
			$url=get_permalink(get_option('woocommerce_myaccount_page_id'));
		}
		return $url;
	}
	function ilgelo_woocommerce_get_logout_url() {
		return wp_logout_url(home_url('/'));
	}



?>