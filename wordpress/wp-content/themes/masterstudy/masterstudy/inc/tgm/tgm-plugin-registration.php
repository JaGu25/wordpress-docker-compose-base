<?php

require_once dirname(__FILE__) . '/tgm-plugin-activation.php';

add_action('tgmpa_register', 'stm_require_plugins');

function stm_require_plugins($return = false)
{

    $plugins = array(
        'stm-post-type' => array(
            'name' => 'STM Configurations',
            'slug' => 'stm-post-type',
            'source' => stm_get_tgm_plugin_path('stm-post-type'),
            'version' => '4.2.5',
        ),
        'masterstudy-lms-learning-management-system' => array(
            'name' => 'MasterStudy LMS',
            'slug' => 'masterstudy-lms-learning-management-system',
            'source' => stm_get_tgm_plugin_path('masterstudy-lms-learning-management-system', true),
            'version' => '2.4.7',
        ),
        'masterstudy-lms-learning-management-system-pro' => array(
            'name' => 'MasterStudy LMS PRO',
            'slug' => 'masterstudy-lms-learning-management-system-pro',
            'source' => stm_get_tgm_plugin_path('masterstudy-lms-learning-management-system-pro'),
            'version' => '3.4.6',
        ),
        'js_composer' => array(
            'name' => 'WPBakery Page Builder',
            'slug' => 'js_composer',
            'source' => stm_get_tgm_plugin_path('js_composer'),
            'version' => '6.4.2',
            'required' => false,
            'external_url' => 'http://vc.wpbakery.com',
        ),
        'elementor' => array(
            'name' => 'Elementor',
            'slug' => 'elementor',
            'required' => false,
        ),
        'header-footer-elementor' => array(
            'name' => 'Elementor – Header, Footer & Blocks Template',
            'slug' => 'header-footer-elementor',
            'required' => false,
        ),
        'masterstudy-elementor-widgets' => array(
            'name' => 'Masterstudy Elementor',
            'slug' => 'masterstudy-elementor-widgets',
            'source' => stm_get_tgm_plugin_path('masterstudy-elementor-widgets'),
            'version' => '1.1.1',
        ),
        'revslider' => array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => stm_get_tgm_plugin_path('revslider'),
            'version' => '6.3.1',
            'required' => false,
            'external_url' => 'http://www.themepunch.com/revolution/',
        ),
        'paid-memberships-pro' => array(
            'name' => 'Paid Memberships Pro',
            'slug' => 'paid-memberships-pro',
            'required' => false,
        ),
        'breadcrumb-navxt' => array(
            'name' => 'Breadcrumb NavXT',
            'slug' => 'breadcrumb-navxt',
            'required' => false,
        ),
        'contact-form-7' => array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        'buddypress' => array(
            'name' => 'BuddyPress',
            'slug' => 'buddypress',
            'required' => false,
        ),
        'woocommerce' => array(
            'name' => 'Woocommerce',
            'slug' => 'woocommerce',
        ),
        'eroom-zoom-meetings-webinar' => array(
            'name' => 'eRoom – Zoom Meetings & Webinar',
            'slug' => 'eroom-zoom-meetings-webinar',
        ),
        'accesspress-social-share' => array(
            'name' => 'AccessPress Social Share',
            'slug' => 'accesspress-social-share',
        ),
        'stm-gdpr-compliance' => array(
            'name' => 'GDPR Compliance & Cookie Consent',
            'slug' => 'stm-gdpr-compliance',
            'source' => stm_get_tgm_plugin_path('stm-gdpr-compliance'),
            'version' => '1.1',
        ),
        'add-to-any' => array(
            'name' => 'AddToAny Share Buttons',
            'slug' => 'add-to-any',
            'required' => false,
        ),        
    );

    if ($return) {
        return $plugins;
    } else {
        foreach ($plugins as $plugin => $plugin_data) {
            tgmpa($plugins);
        }
    };

}

;

function masterstudy_premium_bundled_plugins()
{
    return array(
        'js_composer',
        'elementor',
        'masterstudy-elementor-widgets',
    );
}

;
