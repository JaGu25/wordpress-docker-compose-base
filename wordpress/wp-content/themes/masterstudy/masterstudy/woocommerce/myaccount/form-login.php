<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="row" id="customer_login">

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<?php endif; ?>

		<h4><?php esc_html_e( 'Login', 'masterstudy'); ?></h4>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Username or email address', 'masterstudy'); ?> *" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'masterstudy'); ?> *" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row form-row-login">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'masterstudy'); ?>" />
				<label for="rememberme" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'masterstudy'); ?>
				</label>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'masterstudy'); ?></a>
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

		<h4><?php esc_html_e( 'Register', 'masterstudy'); ?></h4>

		<form method="post" class="register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Username', 'masterstudy'); ?> *"/>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email', 'masterstudy'); ?> *"/>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" placeholder="<?php esc_attr_e( 'Password', 'masterstudy'); ?> *" />
				</p>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'masterstudy'); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'masterstudy'); ?>" />
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
