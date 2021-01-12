<?php
/**
 * My Orders - Deprecated
 *
 * @deprecated 2.6.0 this template file is no longer used. My Account shortcode uses orders.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$my_orders_columns = apply_filters( 'woocommerce_my_account_my_orders_columns', array(
	'order-number'  => __( 'Order', 'masterstudy'),
	'order-date'    => __( 'Date', 'masterstudy'),
	'order-status'  => __( 'Status', 'masterstudy'),
	'order-total'   => __( 'Total', 'masterstudy'),
	'order-actions' => '&nbsp;',
) );

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => $order_count,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => array_keys( wc_get_order_statuses() ),
) ) );

if ( $customer_orders ) : ?>

	<h3 class="mg-bt-20"><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent Orders', 'masterstudy') ); ?></h3>
	<div class="stm_colored_separator">
		<div class="triangled_colored_separator left">
			<div class="triangle"></div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered shop_table shop_table_responsive my_account_orders">

			<thead>
				<tr>
					<th class="order-number"><span class="nobr"><?php esc_html_e( 'Order', 'masterstudy'); ?></span></th>
					<th class="order-date"><span class="nobr"><?php esc_html_e( 'Date', 'masterstudy'); ?></span></th>
					<th class="order-status"><span class="nobr"><?php esc_html_e( 'Status', 'masterstudy'); ?></span></th>
					<th class="order-total"><span class="nobr"><?php esc_html_e( 'Total', 'masterstudy'); ?></span></th>
					<th class="order-actions">&nbsp;</th>
				</tr>
			</thead>

			<tbody><?php
				foreach ( $customer_orders as $customer_order ) {
					$order = wc_get_order( $customer_order );
					$order->populate( $customer_order );
					$item_count = $order->get_item_count();

					?><tr class="order">
						<td class="order-number" data-title="<?php esc_attr_e( 'Order Number', 'masterstudy'); ?>">
							<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
								#<?php echo wp_kses_post($order->get_order_number()); ?>
							</a>
						</td>
						<td class="order-date" data-title="<?php esc_attr_e( 'Date', 'masterstudy'); ?>">
							<time datetime="<?php echo date( 'Y-m-d', strtotime( $order->order_date ) ); ?>" title="<?php echo esc_attr( strtotime( $order->order_date ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></time>
						</td>
						<td class="order-status" data-title="<?php esc_attr_e( 'Status', 'masterstudy'); ?>" style="text-align:left; white-space:nowrap;">
							<?php echo wc_get_order_status_name( $order->get_status() ); ?>
						</td>
						<td class="order-total" data-title="<?php esc_attr_e( 'Total', 'masterstudy'); ?>">
							<?php echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'masterstudy'), $order->get_formatted_order_total(), $item_count ); ?>
						</td>
						<td class="order-actions">
							<?php
								$actions = array();

								if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_payment', array( 'pending', 'failed' ), $order ) ) ) {
									$actions['pay'] = array(
										'url'  => $order->get_checkout_payment_url(),
										'name' => __( 'Pay', 'masterstudy')
									);
								}

								if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) {
									$actions['cancel'] = array(
										'url'  => $order->get_cancel_order_url( wc_get_page_permalink( 'myaccount' ) ),
										'name' => __( 'Cancel', 'masterstudy')
									);
								}

								$actions['view'] = array(
									'url'  => $order->get_view_order_url(),
									'name' => __( 'View', 'masterstudy')
								);

								$actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

								if ( $actions ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									}
								}
							?>
						</td>
					</tr><?php
				}
			?></tbody>

		</table>
	</div>

<?php endif; ?>
