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
 * @package   WC-Print-Invoices-Packing-Lists/Templates
 * @author    SkyVerge
 * @copyright Copyright (c) 2011-2016, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * Template Body after content
 *
 * @type \WC_Order $order Order object
 * @type \WC_PIP_Document Document object
 * @type string $type Document type
 * @type string $action Current document action
 *
 * @version 3.0.3
 * @since 3.0.0
 */

						?>
					</table>

					<?php
						/**
						 * Fires after the document's body (order table).
						 *
						 * @since 3.0.0
						 * @param string $type Document type
						 * @param string $action Current action running on Document
						 * @param WC_PIP_Document $document Document object
						 * @param WC_Order $order Order object
						 */
						do_action( 'wc_pip_after_body', $type, $action, $document, $order );
					?>

					<?php if ( $document->show_coupons_used() ) : ?>

						<?php $coupons = $document->get_coupons_used(); ?>

						<?php if ( $coupons && is_array( $coupons ) ) : ?>

							<?php
								/* translators: Placeholder: %1$s - opening <strong> tag, %2$s - coupons count (used in order), %3$s - closing </strong> tag - %4$s - coupons list */
								printf( '<div class="coupons-used">' . _n( '%1$sCoupon used:%3$s %4$s', '%1$sCoupons used (%2$s):%3$s %4$s', count( $coupons ), 'woocommerce-pip' ) . '</div><br>', '<strong>', count( $coupons ), '</strong>', '<span class="coupon">' . implode( '</span>, <span class="coupon">', $coupons ) . '</span>' );
							?>

						<?php endif; ?>

					<?php endif; ?>

					<?php if ( $document->show_customer_details() ) : ?>

						<?php $customer_details = $document->get_customer_details(); ?>

						<?php if ( ! empty( $customer_details ) && is_array( $customer_details ) ) : ?>

							<h3><?php esc_html_e( 'Customer Details', 'woocommerce-pip' ); ?></h3>

							<ul class="customer-details">
								<?php foreach ( $customer_details as $id => $data ) : ?>

									<li class="<?php echo sanitize_html_class( $id ); ?>"><?php printf( '<strong>%1$s</strong> %2$s', $data['label'], $data['value'] ); ?></li>

								<?php endforeach; ?>
							</ul>

						<?php endif; ?>

					<?php endif; ?>

					<?php if ( $document->show_customer_note() ) : ?>

						<div class="customer-note"><blockquote><?php echo $document->get_customer_note(); ?></blockquote></div>

					<?php endif; ?>

					<?php
						/**
						 * Fires after customer details.
						 *
						 * @since 3.0.0
						 * @param string $type Document type
						 * @param string $action Current action running on Document
						 * @param WC_PIP_Document $document Document object
						 * @param WC_Order $order Order object
						 */
						do_action( 'wc_pip_order_details_after_customer_details', $type, $action, $document, $order );
					?>
				</main>

				<br>

				<footer class="document-footer <?php echo $type; ?>-footer">
					<?php
						/**
						 * Fires before the document's footer.
						 *
						 * @since 3.0.0
						 * @param string $type Document type
						 * @param string $action Current action running on Document
						 * @param WC_PIP_Document $document Document object
						 * @param WC_Order $order Order object
						 */
						do_action( 'wc_pip_before_footer', $type, $action, $document, $order );
					?>

					<?php if ( $document->show_terms_and_conditions() ) : ?>

						<div class="terms-and-conditions"><?php echo $document->get_return_policy(); ?></div>

					<?php endif; ?>

					<hr>

					<?php if ( $document->show_footer() ) : ?>

						<div class="document-colophon <?php echo $type; ?>-colophon">
							<?php echo $document->get_footer(); ?>
						</div>

					<?php endif; ?>

					<?php
						/**
						 * Fires after the document's footer.
						 *
						 * @since 3.0.0
						 * @param string $type Document type
						 * @param string $action Current action running on Document
						 * @param WC_PIP_Document $document Document object
						 * @param WC_Order $order Order object
						 */
						do_action( 'wc_pip_after_footer', $type, $action, $document, $order );
					?>
				</footer>

			</div><!-- .container -->
			<?php
