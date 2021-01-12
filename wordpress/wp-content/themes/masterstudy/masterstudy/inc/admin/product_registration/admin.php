<?php
$includes = get_template_directory() . '/inc/admin/product_registration/includes/';
define('STM_ITEM_NAME', 'MasterStudy');
define('STM_API_URL', 'https://panel.stylemixthemes.com/api/');

/*Connect Envato market plugin.*/
if(!class_exists('Envato_Market')) {
	stm_include_file($includes . 'envato-market/envato-market.php');
}

stm_include_file( $includes . 'theme.php' );
stm_include_file( $includes . 'admin_screens.php' );

$tr = get_site_transient('update_themes');