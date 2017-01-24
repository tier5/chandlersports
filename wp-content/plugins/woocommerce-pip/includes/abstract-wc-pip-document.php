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
 * @package   WC-Print-Invoices-Packing-Lists/Document
 * @author    SkyVerge
 * @copyright Copyright (c) 2011-2016, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * PIP Document abstract class
 *
 * Provides an abstract model for documents handled by this plugin
 *
 * @since 3.0.0
 */
abstract class WC_PIP_Document {


	/** @var string the document type identifier */
	public $type = '';

	/** @var string the document name */
	public $name = '';

	/** @var string the document name (plural) */
	public $name_plural = '';

	/** @var \WC_Order an order associated to this document */
	public $order = null;

	/** @var int WC_Order id */
	public $order_id = 0;

	/** @var array $order_ids Used in multiple documents context */
	public $order_ids = array();

	/** @var array Order items */
	protected $items = array();

	/** @var string Sort order items by column key */
	protected $sort_items_by = 'product';

	/** @var bool $has_refunds Order has refunds */
	protected $has_refunds = false;

	/** @var array $refunds Order refunds */
	protected $refunds = array();

	/** @var array table headers */
	protected $table_headers = array();

	/** @var array column widths */
	protected $column_widths = array();

	/** @var bool Whether this document should display a shipping address */
	protected $show_shipping_address = false;

	/** @var bool Whether this document should display a billing address */
	protected $show_billing_address = false;

	/** @var bool Whether this document should display the shipping method */
	protected $show_shipping_method = false;

	/** @var bool Whether this document should display the header */
	protected $show_header = false;

	/** @var bool Whether this document should display coupons used */
	protected $show_coupons_used = false;

	/** @var bool Whether this document should display customer details */
	protected $show_customer_details = false;

	/** @var bool Whether this document should display the customer note */
	protected $show_customer_note = false;

	/** @var bool Whether this document should display terms and conditions */
	protected $show_terms_and_conditions = false;

	/** @var bool Whether this document should display the footer */
	protected $show_footer = false;


	/**
	 * PIP Document constructor
	 *
	 * @since 3.0.0
	 * @param array $args
	 */
	public function __construct( $args ) {

		// set the order object
		if ( isset( $args['order'] ) && $args['order'] instanceof WC_Order ) {
			$this->order = $args['order'];
		} elseif ( isset( $args['order_id'] ) ) {
			$this->order = wc_get_order( (int) $args['order_id'] );
		} else {
			$this->order = wc_get_order( 0 );
		}

		// set order properties
		if ( $this->order instanceof WC_Order ) {

			$this->order_id    = $this->order->id;
			$this->items       = $this->order->get_items();
			$this->refunds     = $this->order->get_refunds();
			$this->has_refunds = (bool) $this->refunds;
		}

		// multiple order ids, used in bulk actions
		if ( isset( $args['order_ids'] ) ) {

			if ( is_array( $args['order_ids'] ) ) {
				$this->order_ids = array_map( 'intval', $args['order_ids'] );
			} else {
				$this->order_ids = (array) explode( ',', $args['order_ids'] );
			}
		}

		// get custom styles
		add_action( 'wc_pip_styles', array( $this, 'custom_styles' ) );

		// add styles in template head
		add_action( 'wc_pip_head', array( $this, 'output_styles' ) );

		// update document counters upon actions
		add_action( 'wc_pip_print',      array( $this, 'upon_print' ), 10, 2 );
		add_action( 'wc_pip_send_email', array( $this, 'upon_send_email' ), 10, 2 );
	}


	/**
	 * Check the document type
	 *
	 * @since 3.0.0
	 * @param array|string $type
	 * @return bool
	 */
	public function is_type( $type ) {
		return is_array( $type ) ? in_array( $this->type, $type, true ) : $type === $this->type;
	}


	/**
	 * Custom styles to be added in stylesheet
	 *
	 * @since 3.0.0
	 */
	public function custom_styles() {

		echo stripslashes( get_option( 'wc_pip_custom_styles', '' ) );
	}


	/**
	 * Output CSS styles in template file
	 *
	 * @since 3.0.0
	 */
	public function output_styles() {

		wc_pip()->get_template( 'styles', array(
			'document' => $this,
		) );
	}


	/**
	 * Checks if customer shipping address should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_shipping_address() {

		/**
		 * Filters if the customer shipping address should be shown in the document.
		 *
		 * @since 3.0.2
		 * @param bool $show_shipping_address Whether to show shipping address on the document or not.
		 * @param string $type WC_PIP_Document type
		 * @param WC_Order $order The WC Order object
		 */
		return apply_filters( 'wc_pip_document_show_shipping_address', $this->show_shipping_address, $this->type, $this->order );
	}


	/**
	 * Checks if customer billing address should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_billing_address() {

		/**
		 * Filters if the customer billing address should be shown in the document.
		 *
		 * @since 3.0.2
		 * @param bool $show_billing_address Whether to show billing address on the document or not.
		 * @param string $type WC_PIP_Document type
		 * @param WC_Order $order The WC Order object
		 */
		return apply_filters( 'wc_pip_document_show_billing_address', $this->show_billing_address, $this->type, $this->order );
	}


	/**
	 * Checks if order shipping method should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_shipping_method() {
		return $this->show_shipping_method;
	}


	/**
	 * Checks if header should be shown in the document
	 *
	 * @since 3.0.3
	 * @return bool, True if shown
	 */
	public function show_header() {

		/**
		 * Filters if the header should be shown in the document.
		 *
		 * @since 3.0.3
		 * @param bool $show_header Whether to show the header on the document or not.
		 * @param string $type WC_PIP_Document type
		 * @param WC_Order $order The WC Order object
		 */
		return apply_filters( 'wc_pip_document_show_header', $this->show_header, $this->type, $this->order );
	}


	/**
	 * Checks if customer details should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_customer_details() {
		return $this->show_customer_details;
	}


	/**
	 * Checks if order coupons used should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_coupons_used() {
		return $this->show_coupons_used;
	}


	/**
	 * Checks if customer note should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_customer_note() {
		return $this->show_customer_note;
	}


	/**
	 * Checks if terms and conditions section should be shown in the document
	 *
	 * @since 3.0.0
	 * @return bool, True if shown
	 */
	public function show_terms_and_conditions() {

		/**
		 * Filters if the terms & conditions should be shown in the document.
		 *
		 * @since 3.0.2
		 * @param bool $show_terms_and_conditions Whether to show terms & conditions on the document or not.
		 * @param string $type WC_PIP_Document type
		 * @param WC_Order $order The WC Order object
		 */
		return apply_filters( 'wc_pip_document_show_terms_and_conditions', $this->show_terms_and_conditions, $this->type, $this->order );
	}


	/**
	 * Checks if the footer should be shown in the document
	 *
	 * @since 3.0.3
	 * @return bool, True if shown
	 */
	public function show_footer() {

		/**
		 * Filters if the footer should be shown in the document.
		 *
		 * @since 3.0.3
		 * @param bool $show_footer Whether to show the footer on the document or not.
		 * @param string $type WC_PIP_Document type
		 * @param WC_Order $order The WC Order object
		 */
		return apply_filters( 'wc_pip_document_show_footer', $this->show_footer, $this->type, $this->order );
	}


	/**
	 * Get the document template HTML
	 *
	 * @since 3.0.0
	 * @param array $args
	 */
	public function output_template( $args = array() ) {

		if ( ! $this->order instanceof WC_Order ) {
			return;
		}

		$template_args = wp_parse_args( $args, array(
			'document'  => $this,
			'order'     => $this->order,
			'order_id'  => $this->order_id,
			'order_ids' => $this->order_ids,
			'type'      => $this->type,
		) );

		$original_order = $this->order;

		wc_pip()->get_template( 'head', $template_args );

		if ( ! empty( $this->order_ids ) ) {

			// Documents for multiple orders
			foreach ( $this->order_ids as $order_id ) {

				$wc_order = wc_get_order( (int) $order_id );

				$template_args['order']    = $this->order    = $wc_order;
				$template_args['order_id'] = $this->order_id = $wc_order->id;

				if ( $wc_order ) {
					$this->get_template_body( $template_args );
				}
			}

			// Restore the original order
			$template_args['order']    = $this->order    = $original_order;
			$template_args['order_id'] = $this->order_id = $original_order->id;

		} else {

			// Single document for an individual order
			$this->get_template_body( $template_args );

		}

		wc_pip()->get_template( 'foot', $template_args );
	}


	/**
	 * Get template body
	 *
	 * @since 3.0.0
	 * @param $args
	 */
	protected function get_template_body( $args ) {

		wc_pip()->get_template( 'content/order-table-before', $args );
		wc_pip()->get_template( 'content/order-table',        $args );
		wc_pip()->get_template( 'content/order-table-items',  $args );
		wc_pip()->get_template( 'content/order-table-after',  $args );
	}


	/**
	 * Get shipping method
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_shipping_method() {

		if ( ! $this->order instanceof WC_Order ) {
			return '';
		}

		if ( $get_shipping_method = $this->order->get_shipping_method() ) {

			$shipping_method = $get_shipping_method . '<br>' . wc_price( $this->order->get_total_shipping() );
		} else {
			$shipping_method =  __( 'No shipping', 'woocommerce-pip' );
		}

		/**
		 * Filters the shipping method(s).
		 *
		 * @since 3.0.0
		 * @param string $shipping_method The formatted shipping method
		 * @param string $type WC_PIP_Document type
		 * @param WC_Order $order The WC Order object
		 */
		return apply_filters( 'wc_pip_document_shipping_method', $shipping_method, $this->type, $this->order );
	}


	/**
	 * Get coupons used for purchase order
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public function get_coupons_used() {

		$coupons = $this->order instanceof WC_Order ? $this->order->get_used_coupons() : array();

		/**
		 * Filters the document's coupons used.
		 *
		 * @since 3.0.0
		 *
		 * @param array $coupons Order coupons array
		 * @param string $document_type PIP document type
		 * @param WC_Order $order Order object
		 */
		return apply_filters( 'wc_pip_document_coupons_used', $coupons, $this->type, $this->order );
	}


	/**
	 * Get customer details
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public function get_customer_details() {

		$customer_details = array();

		if ( isset( $this->order->billing_email ) && $this->order->billing_email ) {

			$customer_details['customer-email'] = array(
				'label' => __( 'Email:', 'woocommerce-pip' ),
				'value' => '<a href="mailto:' . $this->order->billing_email . '">' . $this->order->billing_email . '</a>',
			);
		}

		if ( isset( $this->order->billing_phone ) && $this->order->billing_phone ) {

			$customer_details['customer-phone'] = array(
				'label' => __( 'Phone:', 'woocommerce-pip' ),
				'value' => '<a href="tel:' . $this->order->billing_phone . '">' . $this->order->billing_phone . '</a>',
			);
		}

		/**
		 * Filter the document's customer details.
		 *
		 * @since 3.0.0
		 * @param array $customer_details Associative array
		 * @param int $order_id WC_Order id
		 * @param string $type WC_PIP_Document type
		 * @param \WC_PIP_Document $document An instance of this document
		 */
		return apply_filters( 'wc_pip_document_customer_details', $customer_details, $this->order_id, $this->type, $this );
	}


	/**
	 * Get customer note
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_customer_note() {

		$customer_note = $this->order instanceof WC_Order && ! empty( $this->order->customer_note ) ? nl2br( stripslashes( $this->order->customer_note ) ) : '';

		/**
		 * Filter's the document's customer note.
		 *
		 * @since 3.0.0
		 * @param string $customer_note HTML text
		 * @param int $order_id WC_Order id
		 * @param string $document_type
		 */
		return apply_filters( 'wc_pip_document_customer_note', $customer_note, $this->order_id, $this->type );
	}


	/**
	 * Get invoice date
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_invoice_date() {

		if ( ! $this->order instanceof  WC_Order ) {
			return '';
		}

		$order_date   = $this->order->order_date;
		$invoice_date = new DateTime( $order_date, new DateTimeZone( wc_timezone_string() ) );

		/**
		 * Filter's the invoice date.
		 *
		 * @since 3.0.0
		 * @param string $invoice_date Formatted date
		 * @param string $order_date Order date
		 * @param int $order_id WC_Order id
		 * @param string $type PIP Document type
		 */
		return apply_filters( 'wc_pip_invoice_date', $invoice_date->format( wc_date_format() ), $this->order_id, $order_date, $this->type );
	}


	/**
	 * Check if document associated order has an invoice number
	 *
	 * @since 3.0.0
	 * @return bool
	 */
	public function has_invoice_number() {
		return (bool) get_post_meta( $this->order_id, '_pip_invoice_number', true );
	}


	/**
	 * Get invoice number
	 *
	 * TODO consider moving this method's body into WC_PIP_Handler class to trim down this class a bit {FN 2016-06-02}
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_invoice_number() {

		$invoice_number = get_post_meta( $this->order_id, '_pip_invoice_number', true );

		if ( (int) $this->order_id > 0 && ! $invoice_number ) {

			// start by getting the latest invoice number from a counter
			$invoice_number     = get_option( 'wc_pip_invoice_number_start', '1' );
			// store the raw number for bumping later the counter
			$invoice_number_raw = (int) $invoice_number;

			// are we using standard WC Order number or PIP own count?
			$use_order_number = 'yes' === get_option( 'wc_pip_use_order_number', 'yes' );

			if ( $use_order_number ) {

				// we use get_order_number() so plugins like Sequential Order Number Pro can filter this
				$invoice_number = $this->order->get_order_number();

			} else {

				// add leading zeros if option for minimum digits is set
				$leading_zeros = (int) get_option( 'wc_pip_invoice_minimum_digits', '1' );

				if ( $leading_zeros > 1 ) {
					$invoice_number = str_pad( (string) $invoice_number, $leading_zeros, '0', STR_PAD_LEFT );
				}
			}

			// add any optional suffix/prefix
			$invoice_number = get_option( 'wc_pip_invoice_number_prefix', '' ) . $invoice_number . get_option( 'wc_pip_invoice_number_suffix', '' );

			/**
			 * Filters the invoice number.
			 *
			 * @since 3.0.0
			 * @param string $invoice_number PIP Invoice number
			 * @param int $order_id WC_Order id
			 * @param string $type PIP Document type
			 */
			$invoice_number = apply_filters( 'wc_pip_invoice_number', wc_pip_parse_merge_tags( $invoice_number, $this->type ), $invoice_number, $this->order_id, $this->type );

			// recursive sanity check to prevent duplicate invoice numbers
			// due to possible concurrency issues (2 or more orders at the same time)
			if ( ! $use_order_number && wc_pip()->get_handler_instance()->invoice_number_exists( $invoice_number ) ) {

				// perform an additional sanity check to maybe bump the counter
				// since there's the possibility that identical invoice numbers
				// may exists legitimately in some installations and this would
				// result in a infinite loop otherwise
				if ( $invoice_number_raw === (int) get_option( 'wc_pip_invoice_number_start', '1' ) ) {
					update_option( 'wc_pip_invoice_number_start', $invoice_number_raw + 1 );
				}

				$this->get_invoice_number();
			}

			// add the invoice number post meta
			add_post_meta( $this->order_id, '_pip_invoice_number', $invoice_number, true );

			// bump the internal invoice number counter unless the order number was used
			if ( ! $use_order_number ) {
				update_option( 'wc_pip_invoice_number_start', $invoice_number_raw + 1 );
			}

			/**
			 * Fires after an invoice number is created.
			 *
			 * This action is expected to be fired only when
			 * creating an invoice number for the first time
			 *
			 * @since 3.0.0
			 * @param string $invoice_number The invoice number created
			 * @param \WC_Order $order The order associated to the invoice
			 */
			do_action( 'wc_pip_invoice_number_created', $invoice_number, $this->order );
		}

		return false !== $invoice_number ? $invoice_number : '';
	}


	/**
	 * Get header
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_header() {

		$header = nl2br( stripslashes( get_option( 'wc_pip_header', '' ) ) );

		/**
		 * Filters the document header.
		 *
		 * @since 3.0.0
		 * @param string $header Document header HTML
		 * @param int $order_id WC_Order id
		 * @param string $document_type
		 */
		return apply_filters( 'wc_pip_document_header', $header, $this->order_id, $this->type );
	}


	/**
	 * Get footer
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_footer() {

		$footer = nl2br( stripslashes( get_option( 'wc_pip_footer', '' ) ) );

		/**
		 * Filters the document footer.
		 *
		 * @since 3.0.0
		 * @param string $footer Document footer HTML
		 * @param int $order_id WC_Order id
		 * @param string $document_type
		 */
		return apply_filters( 'wc_pip_document_footer', $footer, $this->order_id, $this->type );
	}


	/**
	 * Get company logo
	 *
	 * @since 3.0.0
	 * @return string HTML
	 */
	public function get_company_logo() {

		$image_html = '';

		if ( $image_url = get_option( 'wc_pip_company_logo', '' ) ) {

			/**
			 * Filters the logo max width.
			 *
			 * @since 3.0.0
			 * @param string $size size in pixels
			 * @param int $order_id WC_Order id
			 * @param string $type PIP Document type
			 */
			$max_width  = apply_filters( 'wc_pip_document_company_logo_max_width', get_option( 'wc_pip_company_logo_max_width', '300' ) . 'px', $this->order_id, $this->type );

			$image_html = '<img src="' . $image_url . '" class="wc-pip-logo logo" style="max-width:' . $max_width . '" /><br />';
		}

		/**
		 * Filters the company logo.
		 *
		 * @since 3.0.0
		 * @param string $image_html Image HTML
		 * @param string $image_url Image URL
		 * @param int $order_id WC_Order id
		 * @param string $type PIP Document type
		 */
		return apply_filters( 'wc_pip_document_company_logo', $image_html, $image_url, $this->order_id, $this->type );
	}


	/**
	 * Get company name
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_company_name() {

		$company_name = get_option( 'wc_pip_company_name', get_bloginfo( 'name' ) );

		/**
		 * Filters the company name.
		 *
		 * @since 3.0.0
		 * @param string $company_name Company name
		 * @param int $order_id WC_Order id
		 * @param string $document_type WC_PIP_Document type
		 */
		return apply_filters( 'wc_pip_document_company_name', $company_name, $this->order_id, $this->type );
	}


	/**
	 * Get company extra info (slogan, subtitle)
	 *
	 * @since 3.0.0
	 * @return string HTML
	 */
	public function get_company_extra_info() {

		$company_extra_info = nl2br( stripslashes( get_option( 'wc_pip_company_extra', '' ) ) );

		/**
		 * Filters the company extra info.
		 *
		 * @since 3.0.0
		 * @param string $company_extra_info Extra info
		 * @param int $order_id WC_Order id
		 * @param string $document_type WC_PIP_Document type
		 */
		return apply_filters( 'wc_pip_document_company_extra_info', $company_extra_info, $this->order_id, $this->type );
	}


	/**
	 * Get company URL
	 *
	 * @since 3.0.0
	 * return string URL
	 */
	public function get_company_url() {

		$company_url = get_option( 'wc_pip_company_url', get_bloginfo( 'url' ) );

		/**
		 * Filters the company url.
		 *
		 * @since 3.0.0
		 * @param string $company_url Company URL
		 * @param int $order_id WC_Order id
		 * @param string $document_type WC_PIP_Document type
		 */
		return apply_filters( 'wc_pip_document_company_url', $company_url, $this->order_id, $this->type );
	}


	/**
	 * Get company link
	 *
	 * @since 3.0.0
	 * @param string $text Optional, text for link (defaults to the url itself)
	 * @return string Formatted HTML
	 */
	public function get_company_link( $text = '' ) {

		if ( $url = $this->get_company_url() ) {

			$link_text = empty( $text ) ? $url : $text;

			return '<a href="' . esc_url( $url ) . '" title="' . esc_attr( $this->get_company_name() ) . '">' . $link_text . '</a>';
		}

		return $text;
	}


	/**
	 * Get company address
	 *
	 * @since 3.0.0
	 * @return string HTML
	 */
	public function get_company_address() {

		$company_address = nl2br( stripslashes( get_option( 'wc_pip_company_address', '' ) ) );

		/**
		 * Filters the company address.
		 *
		 * @since 3.0.0
		 * @param string $company_address Company address
		 * @param int $order_id WC_Order id
		 * @param string $document_type WC_PIP_Document type
		 */
		return apply_filters( 'wc_pip_document_company_address', $company_address, $this->order_id, $this->type );
	}


	/**
	 * Get return policy
	 *
	 * @since 3.0.0
	 * @return string HTML
	 */
	public function get_return_policy() {

		$terms_and_conditions = nl2br( stripslashes( get_option( 'wc_pip_return_policy', '' ) ) );

		/**
		 * Filters the return policy.
		 *
		 * @since 3.0.0
		 * @param string $terms_and_conditions HTML text
		 * @param int $order_id WC_Order id
		 * @param string $document_type WC_PIP_Document type
		 */
		return apply_filters( 'wc_pip_document_terms_and_conditions', $terms_and_conditions, $this->order_id, $this->type );
	}


	/**
	 * Get document table headers
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public function get_table_headers() {

		// bail out if we are on customizer
		if ( is_customize_preview() ) {
			return $this->table_headers;
		}

		/**
		 * Filters the table headers.
		 *
		 * @since 3.0.0
		 * @param array $table_headers Table column headers
		 * @param int $order_id WC_Order id
		 * @param string $document_type WC_PIP_Document type
		 */
		return apply_filters( 'wc_pip_document_table_headers', $this->table_headers, $this->order_id, $this->type );
	}


	/**
	 * Get document table column widths
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public function get_column_widths() {

		// set a default "weight" of 1
		$defaults = array_fill_keys( array_keys( $this->get_table_headers() ), 1 );

		$column_widths = $this->column_widths;

		// do not filter column widths on Customizer
		if ( ! is_customize_preview() ) {

			/**
			 * Filters the table column widths.
			 *
			 * @since 3.0.0
			 *
			 * @param array $column_widths Column widths
			 * @param int $order_id WC_Order id
			 * @param string $document_type WC_PIP_Document type
			 */
			$column_widths = (array) apply_filters( 'wc_pip_document_column_widths', $column_widths, $this->order_id, $this->type );
		}

		$column_widths = wp_parse_args( $column_widths, $defaults );

		$total_width = array_sum( $column_widths );

		foreach ( $column_widths as $name => $width ) {
			$column_widths[ $name ] = ( (float) $width / $total_width ) * 100;
		}

		return $column_widths;
	}


	/**
	 * Get table footer column span
	 *
	 * Calculates the relative footer span for a given number of footer cells
	 *
	 * @since 3.0.0
	 * @param int $cells Table row cells count
	 * @return int Column span
	 */
	public function get_table_footer_column_span( $cells ) {

		$table_headers = $this->get_table_headers();
		$cols          = count( $table_headers );

		// the hidden id col doesn't span
		if ( isset( $table_headers['id'] ) ) {
			$cols--;
		}

		return ( $cols + 1 ) - (int) $cells;
	}


	/**
	 * Get items count
	 *
	 * @since 3.0.0
	 * @return int Items count
	 */
	public function get_items_count() {

		$items = $this->order->get_items();
		$count = 0;

		foreach ( $items as $item_id => $item ) {

			$item_qty = isset( $item['qty'] ) ? max( 0, (float) $item['qty'] ) : 1;

			if ( method_exists( $this, 'maybe_hide_virtual_item' ) && $this->maybe_hide_virtual_item( $item ) ) {
				continue;
			}

			if ( true === $this->has_refunds ) {
				$refund_qty = (float) $this->order->get_qty_refunded_for_item( $item_id );
				$item_qty   = max( 0, $item_qty - $refund_qty );
			}

			$count += ( 1 * $item_qty );
		}

		/**
		 * Filters the order items count.
		 *
		 * @since 3.0.0
		 * @param int $count Items count
		 * @param array $items Items in WC_Order
		 * @param WC_Order $order Order object
		 */
		return apply_filters( 'wc_pip_order_items_count', $count, $items, $this->order );
	}


	/**
	 * Get document table body's rows
	 *
	 * This is generally a list of order items
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public function get_table_rows() {

		$table_cells = array();

		if ( ! is_object( $this->order ) ) {
			return $table_cells;
		}

		$items = $this->order->get_items();

		if ( $this->get_items_count() > 0 ) {

			foreach ( $items as $id => $item ) {

				$table_row_data = $this->get_table_row_order_item_data( $id, $item );

				if ( ! empty( $table_row_data ) ) {
					$table_cells[ $id ] = $table_row_data;
				}
			}

			/**
			 * Filters if items in document tables should be sorted alphabetically.
			 *
			 * By default items are sorted alphabetically but this can be set to false
			 *
			 * @since 3.0.0
			 *
			 * @param bool $sort_alphabetically Default true, set to false to keep WC order sorting
			 * @param int $order_id WC_Order id
			 * @param string $type Document type
			 */
			$sort_alphabetically = apply_filters( 'wc_pip_document_sort_order_items_alphabetically', true, $this->order->id, $this->type );

			if ( true === $sort_alphabetically ) {
				usort( $table_cells, array( $this, 'sort_order_items_by_column_key' ) );
			}
		}

		$table_rows[] = array(
			'items' => $table_cells,
		);

		/**
		 * Filters the document's table rows.
		 *
		 * @since 3.0.0
		 * @param array $table_rows Items row data (maybe alphabetically sorted).
		 * @param array $items Items raw data (unsorted).
		 * @param int $order_id WC_Order ID.
		 * @param string $document_type The document type.
		 * @param \WC_PIP_Document $document The document object.
		 */
		return apply_filters( 'wc_pip_document_table_rows', $table_rows, $items, $this->order->id, $this->type, $this );
	}


	/**
	 * Sort order items by product
	 *
	 * @deprecated
	 * @see WC_PIP_Document::sort_order_items_by_column_key()
	 *
	 * TODO remove this method as part of WC 2.7 compatibility {FN 2016-06-02}
	 *
	 * @since 3.0.2
	 * @param array $row_1 First row to compare for sorting
	 * @param array $row_2 Second row to compare for sorting
	 * @return int
	 */
	protected function sort_order_items_by_product_key( $row_1, $row_2 ) {

		_deprecated_function( 'WC_PIP_Document::sort_order_items_by_product_key()', '3.0.5', 'WC_PIP_Document::sort_order_items_by_column_key()' );

		$this->sort_items_by = 'product';

		return $this->sort_order_items_by_column_key( $row_1, $row_2 );
	}


	/**
	 * Sort order items by column key
	 *
	 * `usort()` function callback, returns:
	 *
	 * -1 - $row_1 is below $row_2
	 *  0 - $row_1 is equal to $row_2
	 *  1 - $row_1 is above $row_2
	 *
	 * @since 3.0.5
	 * @param array $row_1 First row to compare for sorting
	 * @param array $row_2 Second row to compare for sorting
	 * @return int
	 */
	protected function sort_order_items_by_column_key( $row_1, $row_2 ) {

		/**
		 * Filter the sorting order for order items
		 *
		 * By default items are sorted by product name, but sku can be used
		 *
		 * @since 3.0.2
		 * @param string $sort_order_items_key Default 'product', can be set to any column key such as 'sku', 'price', 'weight', etc.
		 * @param int $order_id WC_Order id
		 * @param string $type Document type
		 */
		$sort_order_items_key = apply_filters( 'wc_pip_document_sort_order_items_key', $this->sort_items_by, $this->order_id, $this->type );

		// sanity check, ensure the array contains the requested key
		if ( ! is_string( $sort_order_items_key ) || ! isset( $row_1[ $sort_order_items_key ], $row_2[ $sort_order_items_key ] ) ) {
			return 0;
		}

		// strip HTML tags to make comparing values more accurate
		$item_1_value = wp_strip_all_tags( $row_1[ $sort_order_items_key ], true );
		$item_2_value = wp_strip_all_tags( $row_2[ $sort_order_items_key ], true );

		switch ( $sort_order_items_key ) {

			// numerical sorting
			case 'price':
			case 'quantity':
			case 'weight':

				// strip out any non-numerical characters (except '.' dot)
				$item_1_value = preg_replace( '/[^0-9.]+/i', '', $item_1_value );
				$item_2_value = preg_replace( '/[^0-9.]+/i', '', $item_2_value );

				// compare numerical values
				$compare = (float) $item_1_value < (float) $item_2_value ? -1 : 1;

			break;

			// alphabetical string sorting (product name, SKU...)
			default:
				$compare = strcmp( $item_1_value, $item_2_value );
			break;

		}

		// try getting item ids for filter
		$item_1_id = isset( $row_1['id'] ) ? $this->get_item_id_from_order_table_row_cell_html( $row_1['id'] ) : 0;
		$item_2_id = isset( $row_2['id'] ) ? $this->get_item_id_from_order_table_row_cell_html( $row_2['id'] ) : 0;

		/**
		 * Filter the usort callback to sort order items in document table
		 *
		 * @since 3.0.5
		 * @param int $compare This should be a valid usort callback return value (an integer between -1 and 1)
		 * @param string $sort_order_items_key The column we are sorting for, default is product name
		 * @param int|float|string $item_1_value First value to compare for sorting
		 * @param int|float|string $item_2_value Second value to compare for sorting
		 * @param int $item_1_id Item id for first value
		 * @param int $item_2_id Item id for second value
		 * @param string $type Document type
		 * @param array $items Order items
		 * @param \WC_Order $order Order object for this document
		 */
		return (int) apply_filters( 'wc_pip_sort_order_items', $compare, $sort_order_items_key, $item_1_value, $item_2_value, $item_1_id, $item_2_id, $this->type, $this->items, $this->order );
	}


	/**
	 * Extract a product id from an HTML row cell
	 *
	 * @since 3.0.5
	 * @param string $html HTML with data-id attribute
	 * @return int Will return 0 if not found or unsuccessful
	 */
	private function get_item_id_from_order_table_row_cell_html( $html ) {

		$product_id = 0;

		$dom = new DOMDocument();
		$dom->loadHTML( $html ) ;

		if ( $tags = $dom->getElementsByTagName( 'span' ) ) {

			foreach ( $tags as $span ) {
				$product_id = $span->getAttribute( 'data-item-id' );
			}
		}

		return is_numeric( $product_id ) ? (int) $product_id : 0;
	}


	/**
	 * Get table row order item data
	 *
	 * This method applies filter hooks
	 * @see WC_PIP_Document::get_order_item_data()
	 * for child documents implementation
	 *
	 * @since 3.0.0
	 * @param string $item_id item id
	 * @param array $item WC_Order item meta
	 * @return array
	 */
	protected function get_table_row_order_item_data( $item_id, $item ) {

		$product   = $this->order->get_product_from_item( $item );
		$item_data = $this->get_order_item_data( $item_id, $item, $product );

		/**
		 * Filters if the order item should be visible on the document.
		 *
		 * @since 3.0.0
		 * @param bool $item_visible
		 * @param array $item WC_Order item meta
		 * @param string $document_type
		 */
		if ( ! apply_filters( 'wc_pip_order_item_visible', true, $item, $this->type ) ) {
			$item_data = array();
		}

		/**
		 * Filters the table row item data.
		 *
		 * @since 3.0.0
		 * @param array $item_data The item data.
		 * @param array $item WC_Order item meta.
		 * @param WC_Product $product Product object.
		 * @param int $order_id WC_Order ID.
		 * @param string $document_type The document type.
		 * @param \WC_PIP_Document $document The document object.
		 */
		return apply_filters( 'wc_pip_document_table_row_item_data', $item_data, $item, $product, $this->order_id, $this->type, $this );
	}


	/**
	 * Get order item data
	 *
	 * @since 3.0.0
	 * @param string $item_id The item id
	 * @param array $item The item data
	 * @param WC_Product $product The product object
	 * @return array
	 */
	protected abstract function get_order_item_data( $item_id, $item, $product );


	/**
	 * Get order item product id
	 *
	 * @since 3.0.5
	 * @param int $item_id Order item id
	 * @return string
	 */
	protected function get_order_item_id_html( $item_id ) {
		return '<span data-item-id="' . esc_attr( $item_id ) . '"></span>';
	}


	/**
	 * Get order item SKU
	 *
	 * @since 3.0.0
	 * @param \WC_Product $product Product corresponding to order item
	 * @param string|array $item Order item (optional, used in filter, defaults to empty string)
	 * @return string
	 */
	protected function get_order_item_sku_html( $product, $item = '' ) {

		$sku = $product instanceof WC_Product ? $product->get_sku() : '';

		/**
		 * Filter the order item SKU
		 *
		 * @since 3.1.3
		 * @param string $sku The product SKU
		 * @param array $item Order item (optional, might be empty string)
		 * @param string $type The document type
		 * @param \WC_Product $product The product object
		 * @param \WC_Order $order The order object
		 */
		$sku = apply_filters( 'wc_pip_order_item_sku', $sku, $item, $this->type, $product, $this->order );

		return '<span class="sku">' . $sku . '</span>';
	}


	/**
	 * Get product CSS classes
	 *
	 * @since 3.0.5
	 * @param \WC_Product $product Product object
	 * @param string|array $item Order item (optional, used in filter, defaults to empty string)
	 * @return string
	 */
	protected function get_order_item_product_classes( $product, $item = '' ) {

		/**
		 * Filters the order item product classes
		 *
		 * @since 3.0.0
		 * @param string[] $product_classes Array of strings to be used as item classes
		 * @param \WC_Product $product The product object
		 * @param array|string $item Order item (optional, might be an empty string)
		 * @param string $type Document type
		 */
		$product_classes = apply_filters( 'wc_pip_document_table_product_class', array( 'product-' . $product->get_type() ), $product, $item, $this->type );

		return implode( ' ', array_map( 'sanitize_html_class', $product_classes ) );
	}


	/**
	 * Get order item name
	 *
	 * @since 3.0.0
	 * @param WC_Product $product Product corresponding to order item
	 * @param string|array $item Order item (optional, used in filter defaults to empty string)
	 * @return string
	 */
	protected function get_order_item_name_html( $product, $item = '' ) {

		$has_product   = $product instanceof WC_Product;
		$wrapper_class = 'product product-name';
		$is_visible    = false;

		if ( $has_product ) {

			$product_name  = wp_strip_all_tags( $product->get_title() );
			$wrapper_class = $this->get_order_item_product_classes( $product, $item ) . ' ' . $wrapper_class;

			if ( $is_visible = $product->is_visible() ) {
				$product_name = sprintf( '<a href="%1$s" target="_blank">%2$s</a>', get_permalink( $product->id ), $product_name );
			}

		} elseif ( is_array( $item ) && ! empty( $item['name'] ) ) {

			$product_name = wp_strip_all_tags( $item['name'] );
		}

		if ( isset( $product_name ) ) {

			/**
			 * Filter the order item name.
			 *
			 * @since 3.0.8
			 * @param string $product_name the product name
			 * @param string|array $item the order item
			 * @param bool $is_visible whether the product is visible in the catalog
			 * @param string $type The document type
			 * @param \WC_Product $product The product object
			 * @param \WC_Order $order The order object
			 */
			$product_name = apply_filters( 'wc_pip_order_item_name', $product_name, $item, $is_visible, $this->type, $product, $this->order );

			$product_name_html = '<span class="' . esc_attr( $wrapper_class ) . '">' . $product_name . '</span>';

		} else {

			$product_name_html = '<span class="product">&ndash;</span>';
		}

		return $product_name_html;
	}


	/**
	 * Get order item price
	 *
	 * @since 3.0.0
	 * @param int|string $item_id Item id
	 * @param array $item WC_Order item
	 * @return string Formatted price
	 */
	protected function get_order_item_price_html( $item_id, $item ) {

		if ( ! $this->order instanceof WC_Order ) {
			return '<span class="price">' . wc_price( 0 ) . '</span>';
		}

		// item price
		$item_total = $this->order->get_line_total( $item );
		$item_price = '<span class="price">' . $this->order->get_formatted_line_subtotal( $item )  . '</span>';

		// handle refunds
		if ( $this->has_refunds && $this->order->get_total_refunded_for_item( $item_id ) > 0 ) {

			$refund_total = $this->order->get_total_refunded_for_item( $item_id );

			$item_price   = '<span class="price"><del>' . $this->order->get_formatted_line_subtotal( $item ) . '</del></span> <span class="refund-price">' . wc_price( max( 0, $item_total - $refund_total ), array( 'currency' => $this->order->get_order_currency() ) ) . '</span>';
		}

		return $item_price;
	}


	/**
	 * Get order item quantity
	 *
	 * @since 3.0.0
	 * @param int|string $item_id Item id
	 * @param array $item WC_Order item
	 * @return string
	 */
	protected function get_order_item_quantity_html( $item_id, $item ) {

		$item_quantity_raw = isset( $item['qty'] ) ? max( 0, (int) $item['qty'] ) : 0;
		$item_quantity     = '<span class="quantity">' . $item_quantity_raw . '</span>';

		// Handle refunds
		if ( $this->has_refunds ) {

			$refund_quantity = (int) ( $item_quantity_raw - $this->order->get_qty_refunded_for_item( $item_id ) );

			// Has the quantity changed?
			if ( $refund_quantity !== $item_quantity_raw ) {
				$item_quantity = '<span class="quantity"><del>' . $item_quantity_raw . '</del></span> <span class="refund-quantity">' . $refund_quantity . '</span>';
			}
		}

		return $item_quantity;
	}


	/**
	 * Get order item weight
	 *
	 * @since 3.0.0
	 * @param string|int $item_id Item id
	 * @param array $item WC_Order item
	 * @param WC_Product $product Corresponding product object
	 * @return string
	 */
	protected function get_order_item_weight_html( $item_id, $item, $product ) {

		$item_weight = 0;

		if ( isset( $product->weight ) && $this->order instanceof WC_Order ) {

			$item_quantity   = isset( $item['qty'] ) ? max( 0, (int) $item['qty'] ) : 0;
			$refund_quantity = $this->has_refunds ? (int) $this->order->get_qty_refunded_for_item( $item_id ) : 0;

			/**
			 * Filters the weight of the order item.
			 *
			 * @since 3.0.0
			 * @param float $items_weight Total weight of the item by its quantity
			 * @param string $item_id Item id
			 * @param array $item Item
			 * @param WC_Product $product WC Product object
			 * @param WC_Order $order WC Order object
			 */
			$item_weight = apply_filters( 'wc_pip_order_item_weight', max( 0, (float) ( $product->weight * max( 0, $item_quantity - $refund_quantity ) ) ), $item_id, $item, $product, $this->order );
		}

		return '<span class="weight">' . $item_weight . '</span>';
	}


	/**
	 * Get item meta display
	 *
	 * @since 3.0.0
	 * @param string|int $item_id Order item id
	 * @param array $item Order item data
	 * @param WC_Product $product
	 * @return bool True if to display flat (single line) or false if multi line (e.g. definition list)
	 */
	protected function get_order_item_meta_display( $item_id, $item, $product ) {

		/**
		 * Filters if item meta should be displayed flat. Defaults to definition list (item meta is displayed on new lines).
		 *
		 * @since 3.0.0
		 * @param bool $flat Display item meta in new lines (flat === false) or a single line (flat === true)
		 * @param WC_Product $product The product object
		 * @param string $item_id Item id
		 * @param array $item Item
		 * @param string $type PIP Document type
		 * @param WC_Order $order Order object
		 */
		return (bool) apply_filters( 'wc_pip_document_table_row_item_meta_flat', false, $product, $item_id, $item, $this->type, $this->order );
	}


	/**
	 * Get order item meta
	 *
	 * @since 3.0.0
	 * @param string|int $item_id Order item id
	 * @param array $item Order item data
	 * @param \WC_Product $product
	 * @return string
	 */
	protected function get_order_item_meta_html( $item_id, $item, $product ) {

		$item_meta = new WC_Order_Item_Meta( $item );

		$has_product = $product instanceof WC_Product;

		$wrapper_class = 'product-meta';

		if ( $has_product ) {
			$wrapper_class = $this->get_order_item_product_classes( $product, $item ) . ' ' . $wrapper_class;
		}

		$item_meta_html = '<div class="' . esc_attr( $wrapper_class ) . '">';

		ob_start();

		/**
		 * Fires before order item meta HTML
		 *
		 * @since 3.0.0
		 * @param string|int $item_id Order item id
		 * @param array $item Order item data
		 * @param \WC_Order $order Order object
		 */
		do_action( 'wc_pip_order_item_meta_start', $item_id, $item, $this->order );

		$item_meta_html .= ob_get_clean() . $item_meta->display( $this->get_order_item_meta_display( $item_id, $item, $product ), true, '_', ', ' );

		ob_start();

		/**
		 * Fires after order item meta HTML
		 *
		 * @since 3.0.0
		 * @param string|int $item_id Order item id
		 * @param array $item Order item data
		 * @param \WC_Order $order Order object
		 */
		do_action( 'wc_pip_order_item_meta_end', $item_id, $item, $this->order );

		$item_meta_html .= ob_get_clean();

		/**
		 * Toggle whether to display a purchase note after item meta
		 *
		 * @since 3.1.2
		 * @param bool $show_purchase_note Whether to show or not (default true)
		 * @param string $document_type The document type
		 * @param \WC_Product $product The product to show a purchase note for
		 */
		$show_purchase_note = (bool) apply_filters( 'wc_pip_order_item_meta_show_purchase_note', true, $this->type, $product );

		if ( $has_product && true === $show_purchase_note && ( $this->order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $product->id, '_purchase_note', true ) ) ) ) {
			$item_meta_html .= '<br><blockquote>' . wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ) . '</blockquote>';
		}

		$item_meta_html .= '</div>';

		/**
		 * Filter the order item meta
		 *
		 * @since 3.0.9
		 * @param string $item_meta_html The item meta HTML
		 * @param int $item_id Order item id
		 * @param array $item Order item data
		 * @param string $type Document type
		 * @param \WC_Order $order Order object
		 */
		return apply_filters( 'wc_pip_order_item_meta', $item_meta_html, $item_id, $item, $this->type, $this->order );
	}


	/**
	 * Get table footer
	 *
	 * This method should be overridden by child classes
	 * to output a table footer with column totals and such
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public function get_table_footer() {
		return array();
	}


	/**
	 * Get action status
	 *
	 * @since 3.0.0
	 * @param $action
	 * @return bool
	 */
	private function get_document_action_status( $action ) {
		return $action ? ( (int) $this->get_document_action_count( $action ) > 0 ) : false;
	}


	/**
	 * Get document action count
	 *
	 * @since 3.0.0
	 * @param string $action Type of action to get count for
	 * @return int Count
	 */
	private function get_document_action_count( $action ) {

		/**
		 * Filters the document action counters.
		 *
		 * @since 3.0.0
		 * @param array $action_counters
		 */
		if ( ! $this->order instanceof WC_Order || ! in_array( $action, (array) apply_filters( 'wc_pip_document_action_counters', array( 'print', 'email' ) ), true ) ) {
			return 0;
		}

		// Convert dashes to underscores
		$document_type = str_replace( '-', '_', $this->type );

		// Get count
		return max( 0, (int) get_post_meta( $this->order->id, "_wc_pip_{$document_type}_{$action}_count", true ) );
	}


	/**
	 * Update document action count
	 *
	 * @since 3.0.0
	 * @param string $action Action count to update
	 * @param string|int $amount If unspecified will bump count by one
	 * @return bool
	 */
	private function update_document_action_count( $action, $amount = '' ) {

		/** This filter is documented in includes/abstract-wc-pip-document.php */
		if ( ! $this->order instanceof WC_Order || ! in_array( $action, (array) apply_filters( 'wc_pip_document_action_counters', array( 'print', 'email' ) ), true ) ) {
			return false;
		}

		// Bump + 1 when $amount is unspecified
		if ( '' === $amount || ! is_numeric( $amount )  ) {
			$amount = max( 0, (int) $this->get_document_action_count( $action ) ) + 1;
		}

		// Convert dashes to underscores and get the current count
		$document_type = str_replace( '-', '_', $this->type );

		// Update action count (accounts for bulk actions too)
		if ( $this->order_ids && is_array( $this->order_ids ) ) {

			$success = array();

			foreach ( $this->order_ids as $order_id ) {
				$success[] = update_post_meta( (int) $order_id, "_wc_pip_{$document_type}_{$action}_count", $amount );
			}

			return in_array( true, $success, true );

		} else {

			return update_post_meta( (int) $this->order->id, "_wc_pip_{$document_type}_{$action}_count", $amount );
		}
	}


	/**
	 * Output the template for print
	 *
	 * @since 3.0.0
	 */
	public function print_document() {

		// unhook the admin bar to compensate for crappy plugins
		// which may force it to be rendered on the print window
		remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );

		/**
		 * Fires immediately before the document is output for printing.
		 *
		 * @see WC_PIP_Document::upon_print() among actions performed here
		 *
		 * @since 3.0.0
		 * @param string $type WC_PIP_Document type
		 * @param int $order_id WC_Order id associated with the document
		 * @param int[] $order_ids Array of WC_Order ids associated with the document
		 */
		do_action( 'wc_pip_print', $this->type, $this->order_id, $this->order_ids );

		// Output the template
		$this->output_template( array( 'action' => 'print' ) );
	}


	/**
	 * Update print count upon print action
	 *
	 * @since 3.0.0
	 * @param string $document_type Document type
	 * @param int $order_id WC_Order id
	 */
	public function upon_print( $document_type, $order_id ) {

		// prevent duplicating count in bulk actions
		if ( $document_type !== $this->type || (int) $order_id !== (int) $this->order_id ) {
			return;
		}

		// Bump print count only when a shop manager or admin is printing from back end
		if ( is_admin() && wc_pip()->get_handler_instance()->current_admin_user_can_manage_documents() ) {

			$this->update_print_count();
		}
	}


	/**
	 * Get document print count
	 *
	 * @since 3.0.0
	 * @return int
	 */
	public function get_print_count() {
		return $this->get_document_action_count( 'print' );
	}


	/**
	 * Get print status
	 *
	 * @since 3.0.0
	 * @return bool
	 */
	public function get_print_status() {
		return $this->get_document_action_status( 'print' );
	}


	/**
	 * Update print count for the document
	 *
	 * @since 3.0.0
	 * @param int|string $amount Optional, if empty will bump the saved value
	 * @return bool True on success, false on failure
	 */
	public function update_print_count( $amount = '' ) {
		return $this->update_document_action_count( 'print', $amount );
	}


	/**
	 * Send document by email
	 *
	 * @since 3.0.0
	 */
	public function send_email() {

		if ( ! is_object( $this->order ) ) {
			return;
		}

		// load the WooCommerce mailer
		WC()->mailer();

		$document_type = str_replace( '-', '_', $this->type );

		/**
		 * Triggers the document email.
		 *
		 * @since 3.0.0
		 * @param string $type PIP Document type
		 * @param WC_PIP_Document $document PIP Document object
		 * @param WC_Order $order Order object
		 */
		do_action( "wc_pip_send_email_{$document_type}", $this );
	}


	/**
	 * Update email sent count upon send email action
	 *
	 * @since 3.0.0
	 * @param string $document_type WC_PIP_Document type
	 * @param int $order_id WC_Order id associated to the document
	 */
	public function upon_send_email( $document_type, $order_id ) {

		// prevent duplicating count in bulk actions
		if ( $document_type !== $this->type || (int) $order_id !== (int) $this->order_id ) {
			return;
		}

		$this->update_email_count();
	}


	/**
	 * Get document email count
	 *
	 * @since 3.0.0
	 * @return int
	 */
	public function get_email_count() {
		return $this->get_document_action_count( 'email' );
	}


	/**
	 * Get print status
	 *
	 * @since 3.0.0
	 * @return bool
	 */
	public function get_sent_email_status() {
		return $this->get_document_action_status( 'email' );
	}


	/**
	 * Update email count for the document
	 *
	 * @since 3.0.0
	 * @param int|string $amount Optional, if empty will bump the saved value
	 * @return bool True on success, false on failure
	 */
	public function update_email_count( $amount = '' ) {
		return $this->update_document_action_count( 'email', $amount );
	}


}
