<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$totals = $order->get_order_item_totals();
?>
<form id="order_review" method="post">

	<table class="shop_table table">
		<thead>
			<tr>
				<th class="product-name"><?php esc_html_e( 'Product', 'masterstudy'); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Qty', 'masterstudy'); ?></th>
				<th class="product-total"><?php esc_html_e( 'Totals', 'masterstudy'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if ( count( $order->get_items() ) > 0 ) : ?>
				<?php foreach ( $order->get_items() as $item_id => $item ) : ?>
					<?php
					if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
						continue;
					}
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
						<td class="product-name">
							<?php
								echo apply_filters( 'woocommerce_order_item_name', esc_html( $item->get_name() ), $item, false ); // @codingStandardsIgnoreLine

								do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

								wc_display_item_meta( $item );

								do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
							?>
						</td>
						<td class="product-quantity"><?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', esc_html( $item->get_quantity() ) ) . '</strong>', $item ); ?></td><?php // @codingStandardsIgnoreLine ?>
						<td class="product-subtotal"><?php echo stm_echo_safe_output($order->get_formatted_line_subtotal( $item )); ?></td><?php // @codingStandardsIgnoreLine ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<?php if ( $totals ) : ?>
				<?php foreach ( $totals as $total ) : ?>
					<tr>
						<th scope="row" colspan="2"><?php echo stm_echo_safe_output($total['label']); ?></th><?php // @codingStandardsIgnoreLine ?>
						<td class="product-total"><?php echo stm_echo_safe_output($total['value']); ?></td><?php // @codingStandardsIgnoreLine ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tfoot>
	</table>

	<div class="multiseparator"></div>

	<div id="payment">
		<?php if ( $order->needs_payment() ) : ?>
		<h2><?php esc_html_e( 'Payment', 'masterstudy'); ?></h2>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							?>
							<li class="payment_method_<?php echo esc_attr($gateway->id); ?>">
								<input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
								<label for="payment_method_<?php echo esc_attr($gateway->id); ?>"><?php echo stm_echo_safe_output($gateway->get_title()); ?> <?php echo stm_echo_safe_output($gateway->get_icon()); ?></label>
								<?php
									if ( $gateway->has_fields() || $gateway->get_description() ) {
										echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
										$gateway->payment_fields();
										echo '</div>';
									}
								?>
							</li>
							<?php
						}
					} else {
						echo '<p>' . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'masterstudy') . '</p>';
					}
				?>
			</ul>
		<?php endif; ?>
		<div class="form-row">
			<?php wp_nonce_field( 'woocommerce-pay' ); ?>
			<?php
				$pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', __( 'Pay for order', 'masterstudy') );

				echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $pay_order_button_text ) . '" data-value="' . esc_attr( $pay_order_button_text ) . '" />' );
			?>
			<input type="hidden" name="woocommerce_pay" value="1" />
		</div>
	</div>
</form>
