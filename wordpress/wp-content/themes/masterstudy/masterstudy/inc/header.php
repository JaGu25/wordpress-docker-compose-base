<?php

add_action('wp_body_open', 'masterstudy_after_body_open');

function masterstudy_after_body_open()
{
    require_once get_template_directory() . '/partials/headers/after_body_open.php';
}

add_action('hfe_header', 'masterstudy_header_end_hfb', 999);
add_action('masterstudy_header_end', 'masterstudy_header_end');

function masterstudy_header_end_hfb()
{
    require_once get_template_directory() . '/partials/headers/after_header_hfb.php';
}

function masterstudy_header_end()
{
    require_once get_template_directory() . '/partials/headers/after_header.php';
}

add_filter('masterstudy-elementor-widgets-styles', function ($css) {

    $header_styles = stm_option('font_heading');
    $secondary_color = stm_option('secondary_color');

    $menu_css = '';

    if (!empty($header_styles) and !empty($header_styles['font-family'])) {
        $menu_css .= "
            header#masthead .menu-item a.hfe-sub-menu-item, 
            header#masthead .menu-item a.hfe-menu-item {
                font-family : {$header_styles['font-family']};
            }
        ";
    }

    if (!empty($secondary_color)) {
        $menu_css .= "
            a.hfe-sub-menu-item:hover, 
            a.hfe-menu-item:hover {
                color : {$secondary_color};
            }
        ";
    }

    $menu_css .= "
        @media (max-width: 767px) {
            .stm_lms_wishlist_button a, .masterstudy_elementor_stm_lms_login a {
                background-color : {$secondary_color};
            }
        }
    ";

    if (!empty($menu_css)) {
        $css = str_replace("</style>", "{$menu_css}</style>", $css);
    }

    $css = str_replace(
        '.elementor-section.elementor-section-boxed:not(.elementor-section-stretched) > .elementor-container',
        '#main .elementor-section.elementor-section-boxed:not(.elementor-section-stretched) > .elementor-container',
        $css);

    return $css;

});

add_filter('elementor/frontend/the_content', function ($content) {
    return $content;
}, 10, 1);

add_filter('elementor/frontend/builder_content_data', function ($data, $post_id) {


    $sticky = get_post_meta($post_id, 'sticky', true);
    $absolute = get_post_meta($post_id, 'absolute', true);
    $sticky_threshold = get_post_meta($post_id, 'sticky_threshold', true);
    $sticky_threshold_color = get_post_meta($post_id, 'sticky_threshold_color', true);

    if(empty($sticky_threshold)) $sticky_threshold = 100;
    if(empty($sticky_threshold_color)) $sticky_threshold_color = '#000';

    wp_localize_script('stm-hfe', "stm_hfe_settings_{$post_id}", array(
        'id' => $post_id,
        'sticky' => $sticky,
        'absolute' => $absolute,
        'sticky_threshold' => $sticky_threshold,
        'sticky_threshold_color' => $sticky_threshold_color,
    ));


    return $data;

}, 10, 2);