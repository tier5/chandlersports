<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;

$customer_id = get_current_user_id();

$args = array(
    'numberposts'     => $recent_orders,
    'meta_key'        => '_customer_user',
    'meta_value'	  => $customer_id,
    'post_type'       => 'shop_order',
    'post_status'     => 'publish'
);
$customer_orders = get_posts($args);

if ($customer_orders) :
?>
	<div style="float: left; width: 150px; margin: 0 0 20px 0; font-weight: bold; border-bottom: 3px solid #cccccc;">
		<span class="nobr"><?php _e('Order', 'woocommerce'); ?></span>
	</div>
	<div style="float: left; width: 200px; margin: 0 0 20px 0; font-weight: bold; border-bottom: 3px solid #cccccc;">
		<span class="nobr"><?php _e('Ship to', 'woocommerce'); ?></span>
	</div>
	<div style="float: left; width: 100px; margin: 0 0 20px 0; font-weight: bold; border-bottom: 3px solid #cccccc;">
		<span class="nobr"><?php _e('Total', 'woocommerce'); ?></span>
	</div>
	<div style="float: left; width: 100px; margin: 0 0 20px 0; font-weight: bold; border-bottom: 3px solid #cccccc;">
		<span class="nobr"><?php _e('Status', 'woocommerce'); ?></span>
	</div>

		<?php
			foreach ($customer_orders as $customer_order) :
				$order = new WC_Order();
				$order->populate( $customer_order );
				$status = get_term_by('slug', $order->status, 'shop_order_status');
		?>
				<div style="width: 150px; float: left; margin: 0 0 10px 0; padding: 0 0 10px 0;">
						<a href="<?php echo esc_url( add_query_arg('order', $order->id, get_permalink(woocommerce_get_page_id('view_order'))) ); ?>"><?php echo $order->get_order_number(); ?></a> &ndash;<br /><time title="<?php echo esc_attr( strtotime($order->order_date) ); ?>"><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></time>
				</div>
				
				<div style="width: 200px; float: left; margin: 0 0 10px 0; padding: 0 0 10px 0;">
					<address><?php if ($order->get_formatted_shipping_address()) echo $order->get_formatted_shipping_address(); else echo '&ndash;'; ?></address>
				</div>
				
				<div style="width: 100px; float: left; margin: 0 0 10px 0; padding: 0 0 10px 0;">
					<?php echo $order->get_formatted_order_total(); ?>
				</div>
				
				<div style="width: 100px; float: left; margin: 0 0 10px 0; padding: 0 0 10px 0;">
					<?php echo ucfirst( __( $status->name, 'woocommerce' ) ); ?>
					<?php if (in_array($order->status, array('pending', 'failed'))) : ?>
						<a href="<?php echo esc_url( $order->get_cancel_order_url() ); ?>" class="cancel" title="<?php _e('Click to cancel this order', 'woocommerce'); ?>">(<?php _e('Cancel', 'woocommerce'); ?>)</a>
					<?php endif; ?>
					
					
					<?php if (in_array($order->status, array('pending', 'failed'))) : ?>
						<br />
						<br />
						<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e('Pay', 'woocommerce'); ?></a>
					<?php endif; ?>

					<br />
					<br />
					<a href="<?php echo esc_url( add_query_arg('order', $order->id, get_permalink(woocommerce_get_page_id('view_order'))) ); ?>" class="button"><?php _e('View', 'woocommerce'); ?></a>
				</div>
						
						
				<br style="clear: both;" />
				<span style="border-bottom: 1px solid #cccccc; width: 560px; clear: both; height: 1px; display: block; margin: 0 0 20px 0;"></span>


		<?php
			endforeach;
		?>
<?php
else :
?>
	<p><?php _e('You have no recent orders.', 'woocommerce'); ?></p>
<?php
endif;
?>
