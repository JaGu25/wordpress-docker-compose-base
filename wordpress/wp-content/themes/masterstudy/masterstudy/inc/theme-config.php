<?php

if (!empty($_GET['lms-layout'])) {

    add_action('init', 'stm_set_layout');

    function stm_set_layout()
    {
        if (!current_user_can('manage_options')) die;
        update_option('stm_lms_layout', $_GET['lms-layout']);
    }

}

if (!function_exists('stm_get_layout')) {
    function stm_get_layout()
    {
        return get_option('stm_lms_layout', 'default');
    }
}

function stm_layout_plugins($layout = 'default', $get_layouts = false)
{
    $required = array(
        'stm-post-type',
        'breadcrumb-navxt',
        'contact-form-7',
    );
    $plugins = array(
        'default' => array(
            'revslider',
            'woocommerce',
            'breadcrumb-navxt',
            'contact-form-7',
        ),
        'online-light' => array(
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'online-dark' => array(
            'revslider',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'academy' => array(
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'course_hub' => array(
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'classic_lms' => array(
            'revslider',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'udemy' => array(
            'revslider',
            'contact-form-7',
            'breadcrumb-navxt',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'single_instructor' => array(
            'revslider',
            'contact-form-7',
            'breadcrumb-navxt',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'woocommerce',
        ),
        'language_center' => array(
            'woocommerce',
            'breadcrumb-navxt',
            'contact-form-7',
        ),
        'rtl-demo' => array(
            'revslider',
            'contact-form-7',
            'breadcrumb-navxt',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'woocommerce',
        ),
        'buddypress-demo' => array(
            'revslider',
            'contact-form-7',
            'breadcrumb-navxt',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'buddypress',
            'woocommerce',
        ),
        'classic-lms-2' => array(
            'revslider',
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'paid-memberships-pro',
            'woocommerce',
        ),
        'distance-learning' => array(
            'masterstudy-lms-learning-management-system',
            'masterstudy-lms-learning-management-system-pro',
            'eroom-zoom-meetings-webinar',
            'woocommerce',
        ),
    );

    if ($get_layouts) return $plugins;

    return array_merge($required, $plugins[$layout]);
}
