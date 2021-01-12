<?php
$theme_info = wp_get_theme();
define('STM_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ) );
define('STM_MS_SHORTCODES', '1' );

$inc_path = get_template_directory() . '/inc';

$widgets_path = get_template_directory() . '/inc/widgets';
// Theme setups

// Custom code and theme main setups
require_once($inc_path . '/setup.php');

// Header an Footer actions
require_once($inc_path . '/header.php');
require_once($inc_path . '/footer.php');

// Enqueue scripts and styles for theme
require_once($inc_path . '/scripts_styles.php');

/*Theme configs*/
require_once($inc_path . '/theme-config.php');

// Visual composer custom modules
if (defined('WPB_VC_VERSION')) {
	require_once($inc_path . '/visual_composer.php');
}

require_once($inc_path . '/elementor.php');

// Custom code for any outputs modifying
//require_once($inc_path . '/payment.php');
require_once($inc_path . '/custom.php');

// Custom code for woocommerce modifying
if (class_exists('WooCommerce')) {
	require_once($inc_path . '/woocommerce_setups.php');
}

if(defined('STM_LMS_URL')) {
	require_once($inc_path . '/lms/main.php');
}
function stm_glob_pagenow(){
    global $pagenow;
    return $pagenow;
}
function stm_glob_wpdb(){
    global $wpdb;
    return $wpdb;
}

if(class_exists('BuddyPress')) {
    require_once($inc_path . '/buddypress.php');
}

//Announcement banner
if (is_admin()) {
	require_once($inc_path . '/admin/generate_styles.php');
	require_once($inc_path . '/admin/admin_helpers.php');
	require_once($inc_path . '/admin/review/review-notice.php');
	require_once($inc_path . '/admin/product_registration/admin.php');
	require_once($inc_path . '/tgm/tgm-plugin-registration.php');
}
