<?php
/**
 * WooCommerce Print Invoices/Packing Lists
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Print
 * Invoices/Packing Lists to newer versions in the future. If you wish to
 * customize WooCommerce Print Invoices/Packing Lists for your needs please refer
 * to http://docs.woothemes.com/document/woocommerce-print-invoice-packing-list/
 *
 * @package   WC-Print-Invoices-Packing-Lists/Handler
 * @author    SkyVerge
 * @copyright Copyright (c) 2011-2016, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * Handler class
 *
 * Handles general PIP tasks
 *
 * @since 3.0.0
 */
class WC_PIP_Handler {


	/**
	 * Add hooks/filters
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		// generate invoice number upon order status change to paid
		add_action( 'woocommerce_order_status_processing', array( $this, 'generate_invoice_number' ), 20 );
		add_action( 'woocommerce_order_status_completed',  array( $this, 'generate_invoice_number' ), 20 );
	}


	/**
	 * Whether to generate invoice numbers on order paid
	 *
	 * @since 3.1.1
	 * @return bool
	 */
	private function generate_invoice_number_on_order_paid() {

		/**
		 * Toggle invoice number generation upon paid order
		 *
		 * @since 3.0.3
		 * @param bool $generate_invoice_number Default true
		 */
		return (bool) apply_filters( 'wc_pip_generate_invoice_number_on_order_paid', true );
	}


	/**
	 * Get user capabilities allowed to print or email documents
	 *
	 * @since 3.0.5
	 * @return array
	 */
	public function get_admin_capabilities() {

		/**
		 * Filter lower capabilities allowed to manage documents
		 * i.e. print, email, from admin or front end
		 *
		 * @since 3.0.5
		 * @param array $capabilities
		 */
		$can_manage_documents = apply_filters( 'wc_pip_can_manage_documents', array(
			'manage_woocommerce',
			'manage_woocommerce_orders',
			'edit_shop_orders',
		) );

		return (array) $can_manage_documents;
	}


	/**
	 * Check if current user can print a document
	 *
	 * @since 3.0.5
	 * @return bool
	 */
	public function current_admin_user_can_manage_documents() {

		// admin can always manage
		$can_manage = is_user_admin();

		if ( ! $can_manage && $admin_caps = $this->get_admin_capabilities() ) {

			foreach ( $admin_caps as $capability ) {

				// stop as soon as there's at least one capability that grants management rights
				if ( $can_manage = current_user_can( $capability ) ) {
					break;
				}
			}
		}

		return $can_manage;
	}


	/**
	 * Check if customer can view invoices in front end
	 *
	 * @since 3.1.1
	 * @param int $user_id Optional, user id passed in filter, defaults to current user
	 * @return bool Will always return false if the current user (default) is not logged in
	 */
	public function customer_can_view_invoices( $user_id = null ) {

		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}

		// sanity check, returns false for customers not logged in
		if ( 0 === (int) $user_id || ! is_numeric( $user_id ) ) {
			return false;
		}

		/**
		 * Toggle if customers can view invoices
		 *
		 * @since 3.0.5
		 * @param bool $customers_can_view_invoices Whether customers can see invoices (true), or not (false), default true
		 * @param int $user_id Optional user to check for, defaults to current user id
		 */
		return (bool) apply_filters( 'wc_pip_customers_can_view_invoices', true, (int) $user_id );
	}


	/**
	 * Generate a document invoice number
	 *
	 * Normally runs as a callback upon order status change to paid
	 * It will not generate a new one if already set
	 *
	 * @since 3.0.0
	 * @param int $order_id
	 */
	public function generate_invoice_number( $order_id ) {

		if ( false !== $this->generate_invoice_number_on_order_paid() ) {

			$document = wc_pip()->get_document( 'invoice', array( 'order_id' => $order_id ) );

			if ( $document ) {

				$document->get_invoice_number();
			}
		}
	}


	/**
	 * Check if a document invoice number exists
	 *
	 * @since 3.1.1
	 * @param string $invoice_number The invoice number to search
	 * @return bool
	 */
	public function invoice_number_exists( $invoice_number ) {

		$found = get_posts( array(
			'nopaging'    => true,
			'fields'      => 'ids',
			'post_type'   => 'shop_order',
			'post_status' => array_keys( wc_get_order_statuses() ),
			'meta_query'  => array(
				array(
					'key'     => '_pip_invoice_number',
					'value'   => $invoice_number,
				),
			),
		) );

		return ! empty( $found );
	}


}
