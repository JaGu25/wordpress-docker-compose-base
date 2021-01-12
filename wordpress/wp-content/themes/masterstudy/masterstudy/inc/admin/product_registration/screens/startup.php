<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

$theme = stm_get_theme_info();
$theme_name = $theme['name'];

$creds = stm_get_creds();
$auth_code = stm_check_auth();

$message = '';

if (!empty($auth_code)) {
	$icon = 'dashicons dashicons-yes';
	$envato_market = Envato_Market::instance();
	$envato_market->items()->set_themes(true);
	$themes = $envato_market->items()->themes('purchased');
} else {
	$icon = 'dashicons dashicons-no';
	$message = esc_html__('Please make sure you have purchased this theme with the account you registered current token', 'masterstudy');
}

if (empty($creds['t'])) {
	$icon = 'dashicons dashicons-post-status';
	$message = '';
}
?>

<div class="wrap about-wrap stm-admin-wrap stm-admin-start-screen">

	<?php stm_get_admin_tabs(); ?>

	<?php if (empty($auth_code)) { ?>
        <div class="stm-notice">
            <p class="about-description">
				<?php printf(esc_html__('Thank you for choosing %s! Please register it to enable the %1$s demos and theme auto updates. The instructions below must be followed exactly.', 'masterstudy'), $theme_name); ?>
            </p>
        </div>
	<?php } ?>

    <div class="two-col panel">
		<?php
		if (!empty($themes) and !empty($auth_code)) {
			envato_market_themes_column('active');
		}
		?>
    </div>

    <form id="stm_item_registration" method="post" action="">
		<?php settings_fields('stm_registration'); ?>
        <div class="stm_item_registration_input">
            <span class="<?php echo esc_attr($icon); ?>"></span>
            <input type="text" name="stm_registration[token]"
                   value="<?php echo (!empty($creds['t'])) ? esc_attr($creds['t']) : ''; ?>"/>
        </div>
		<?php submit_button(esc_attr__('Submit', 'masterstudy'), array('primary', 'large', 'stm-admin-button', 'stm-admin-large-button')); ?>
    </form>

	<?php if (!empty($message)): ?>
        <div class="stm-admin-message"><?php echo wp_kses_post($message); ?></div>
	<?php endif; ?>

	<?php if (empty($auth_code)) { ?>
        <h3><?php esc_html_e('Instructions For Generating A Token', 'masterstudy'); ?></h3>
        <ol>
            <li><?php printf(__('Click on this <a href="%s" target="_blank">Generate A Personal Token</a> link. <strong>IMPORTANT:</strong> You must be logged into the same Themeforest account that purchased %s. If you are logged in already, look in the top menu bar to ensure it is the right account. If you are not logged in, you will be directed to login then directed back to the Create A Token Page.', 'masterstudy'), 'https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t', $theme_name); ?></li>
            <li><?php esc_html_e('Enter a name for your token, then check the boxes for <strong>View Your Envato Account Username, Download Your Purchased Items, Verify Purchases You\'ve Made</strong> and <strong>List Purchases You\'ve Made</strong> from the permissions needed section. Check the box to agree to the terms and conditions, then click the <strong>Create Token button</strong>', 'masterstudy'); ?></li>
            <li><?php esc_html_e('A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field below and click the <strong>Submit</strong> button.', 'masterstudy'); ?></li>
            <li><?php esc_html_e('You will see a green check mark for success, or a failure message if something went wrong. If it failed, please make sure you followed the steps above correctly.', 'masterstudy'); ?></li>
        </ol>
	<?php } ?>

</div>