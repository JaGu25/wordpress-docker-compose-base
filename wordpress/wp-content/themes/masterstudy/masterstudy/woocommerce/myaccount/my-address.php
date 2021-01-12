<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'masterstudy'),
		'shipping' => __( 'Shipping address', 'masterstudy'),
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'masterstudy'),
	), $customer_id );
}

$oldcol = 1;
$col    = 1;
?>

<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'masterstudy') ); ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses">
<?php endif; ?>

<div class="row">
<?php foreach ( $get_addresses as $name => $title ) : ?>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 address">
		<header class="title">
			<h3><?php echo sanitize_text_field($title); ?></h3>
		</header>
		<address>
			<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name'     => array(
						'title' => esc_html__('First Name', 'masterstudy'),
						'value' => get_user_meta( $customer_id, $name . '_first_name', true )
					),
					'last_name'     => array(
						'title' => esc_html__('Last Name', 'masterstudy'),
						'value' => get_user_meta( $customer_id, $name . '_last_name', true )
					),
                    'address'     => array(
                        'title' => esc_html__('Address line 1', 'masterstudy'),
                        'value' => get_user_meta( $customer_id, $name . '_address_1', true )
                    ),
                    'address_2'     => array(
                        'title' => esc_html__('Address line 2', 'masterstudy'),
                        'value' => get_user_meta( $customer_id, $name . '_address_2', true )
                    ),
				), $customer_id, $name );


				if ( ! $address )
					esc_html_e( 'You have not set up this type of address yet.', 'masterstudy');
				else
					$output = '';
				$output .= '<div class="table-responsive">';
				$output .= '<table class="table table-stripped address-table">';
				$output .= '<tbody>';
				foreach($address as $value ) {
					$output .= '<tr><th>'. esc_html( $value['title'] ).'</th><td>'. esc_html( $value['value'] ).'</td></tr>';
				}
				$output .= '</tbody>';
				$output .= '</table>';
				$output .= '</div>';
				echo wp_kses_post( $output );
			?>
		</address>
			<footer>
				<a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="button edit edit-billing-address"><?php esc_html_e( 'Edit', 'masterstudy'); ?></a>
			</footer>
	</div>

<?php endforeach; ?>
</div> <!-- row -->
<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
<?php endif;
