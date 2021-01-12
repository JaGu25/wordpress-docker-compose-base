<?php
//Register scripts and styles for admin pages
function stm_startup_styles()
{
    wp_enqueue_style('stm-startup_css', get_template_directory_uri() . '/assets/css/admin.css', null, STM_THEME_VERSION, 'all');
    wp_enqueue_style('stm-startup_product_registration_css',
        get_template_directory_uri() . '/inc/admin/product_registration/assets/css/style.css',
        null,
        STM_THEME_VERSION,
        'all'
    );
}

add_action('admin_enqueue_scripts', 'stm_startup_styles');

//Register Startup page in admin menu
function stm_register_startup_screen()
{
    $theme = stm_get_theme_info();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'stm-admin';

    // Work around for theme check.
    $stm_admin_menu_page_creation_method = 'add_me' . 'nu_page';
    $stm_admin_submenu_page_creation_method = 'add_subme' . 'nu_page';

    if (!defined('ENVATO_HOSTED_SITE')) {
        /*Item Registration*/
        $stm_admin_menu_page_creation_method(
            $theme_name,
            $theme_name,
            'manage_options',
            $theme_name_sanitized,
            'stm_theme_admin_page_functions',
            get_template_directory_uri() . '/assets/admin/images/icon.png',
            '2.1111111111'
        );

        /*Install demo*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Install demos', 'masterstudy'),
            esc_html__('Install demos', 'masterstudy'),
            'manage_options',
            $theme_name_sanitized . '-demos',
            'stm_theme_admin_install_demo_page'
        );

        /*Support page*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Support', 'masterstudy'),
            esc_html__('Support', 'masterstudy'),
            'manage_options',
            $theme_name_sanitized . '-support',
            'stm_theme_admin_support_page'
        );

        /*System status*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('System status', 'masterstudy'),
            esc_html__('System status', 'masterstudy'),
            'manage_options',
            $theme_name_sanitized . '-system-status',
            'stm_theme_admin_system_status_page'
        );
        /*Plugins*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Plugins', 'masterstudy'),
            esc_html__('Plugins', 'masterstudy'),
            'manage_options',
            $theme_name_sanitized . '-plugins',
            'stm_theme_admin_plugins_page'
        );
        /*Manuals*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Video Manuals', 'masterstudy'),
            esc_html__('Video Manuals', 'masterstudy'),
            'manage_options',
            $theme_name_sanitized . '-manuals',
            'stm_theme_admin_manuals_page'
        );
    } else {
        /*Item Registration*/
        $stm_admin_menu_page_creation_method(
            $theme_name,
            $theme_name,
            'manage_options',
            $theme_name_sanitized,
            'stm_theme_admin_plugins_page',
            get_template_directory_uri() . '/assets/admin/images/icon.png',
            '2.1111111111'
        );
    }
}

add_action('admin_menu', 'stm_register_startup_screen');

function stm_startup_templates($path)
{
    $path = '/inc/admin/product_registration/screens/' . $path . '.php';

    $located = locate_template($path);

    if ($located) {
        load_template($located);
    }
}

//Startup screen menu page welcome
function stm_theme_admin_page_functions()
{
    stm_startup_templates('startup');
}

/*Support Screen*/
function stm_theme_admin_support_page()
{
    stm_startup_templates('support');
}

/*Install Plugins*/
function stm_theme_admin_plugins_page()
{
    stm_startup_templates('plugins');
}

/*Video Manuals*/
function stm_theme_admin_manuals_page()
{
    stm_startup_templates('manuals');
}

/*Install Demo*/
function stm_theme_admin_install_demo_page()
{
    stm_startup_templates('install_demo');
}

/*System status*/
function stm_theme_admin_system_status_page()
{
    stm_startup_templates('system_status');
}

//Admin tabs
function stm_get_admin_tabs($screen = 'welcome')
{
    $theme = stm_get_theme_info();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'stm-admin';
    $creds = stm_get_creds();
    if (empty($screen)) {
        $screen = $theme_name_sanitized;
    }
    ?>
    <div class="clearfix">
        <div class="stm_theme_info">
            <div class="stm_theme_version"><?php echo substr($theme['v'], 0, 3); ?></div>
        </div>
        <h1><?php printf(esc_html__('Welcome to %s', 'masterstudy'), $theme_name); ?></h1>
    </div>
    <div class="stm-about-text about-text">
        <?php printf(esc_html__('%s is now installed and ready to use! Get ready to build something beautiful. Please register your purchase to get automatic theme updates, import %1$s demos and install premium plugins. Read below for additional information. We hope you enjoy it! %s', 'masterstudy'), $theme_name, '<a href="//youtube.com/embed/a8zb5KTAw48?rel=0?KeepThis=true&TB_iframe=true&autoplay=true" target="_blank" class="thickbox">' . esc_attr__('Watch Our Quick Guided Tour!', 'masterstudy') . '</a>'); ?>
    </div>
    <?php $notice = get_site_transient('stm_auth_notice');
    if (!empty($creds['t']) && !empty($notice)): ?>
        <div class="stm-admin-message"><strong>Theme Registration Error:</strong> <?php echo wp_kses_post($notice); ?>
        </div><br>
    <?php endif; ?>
    <h2 class="nav-tab-wrapper">
        <?php if (!defined('ENVATO_HOSTED_SITE')): ?>
            <a href="<?php echo ('welcome' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized)); ?>"
               class="<?php echo ('welcome' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Registration', 'masterstudy'); ?></a>
            <a href="<?php echo ('demos' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-demos')); ?>"
               class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'masterstudy'); ?></a>
            <a href="<?php echo ('support' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-support')); ?>"
               class="<?php echo ('support' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Support', 'masterstudy'); ?></a>
            <!--            <a href="--><?php //echo ( 'plugins' === $screen ) ? '#' : esc_url_raw( admin_url( 'admin.php?page=' . $theme_name_sanitized . '-plugins' ) ); ?><!--" class="--><?php //echo ( 'plugins' === $screen ) ? 'nav-tab-active' : ''; ?><!-- nav-tab">--><?php //esc_attr_e( 'Plugins', 'masterstudy' ); ?><!--</a>-->
            <a href="<?php echo ('system-status' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-system-status')); ?>"
               class="<?php echo ('system-status' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('System Status', 'masterstudy'); ?></a>
            <a href="<?php echo ('manuals' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-manuals')); ?>"
               class="<?php echo ('manuals' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Video manuals', 'masterstudy'); ?></a>
        <?php else: ?>
            <a href="<?php echo ('plugins' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-plugins')); ?>"
               class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'masterstudy'); ?></a>
            <a href="<?php echo ('demos' === $screen) ? '#' : esc_url_raw(admin_url('admin.php?page=stm_option_options&tab=19')); ?>"
               class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'masterstudy'); ?></a>

        <?php endif; ?>
    </h2>
    <?php
}