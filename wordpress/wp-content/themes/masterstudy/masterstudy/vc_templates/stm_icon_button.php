<?php

$defaults = array(
    'link' => '',
    'link_tooltip' => '',
    'btn_align' => 'left',
    'btn_size' => 'btn-normal-size',

    'button_color' => '#fff',
    'button_text_color_hover' => '',

    'button_bg_color' => 'transparent',
    'button_bg_color_hover' => 'transparent',

    'button_border_color' => '#48a7d4',
    'button_border_color_hover' => '',

    'icon' => '',
    'icon_size' => '16px',
    'css' => ''
);

extract( shortcode_atts( $defaults, $atts ) );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['link'] = vc_build_link( $link );
$atts['btn_align'] = (isset($btn_align)) ? $btn_align : 'left';
$atts['link_tooltip'] = (isset($link_tooltip)) ? $link_tooltip : '';
$atts = wp_parse_args($atts, $defaults);

masterstudy_show_template('icon_button', $atts);