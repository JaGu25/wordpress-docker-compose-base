<?php
extract(shortcode_atts(array(
    'title' => '',
    'icon' => '',
    'private_lesson' => '',
    'badge' => '',
    'meta' => '',
    'meta_icon' => '',
    'preview_video' => '',
    'private_placeholder' => '',
    'css' => ''
), $atts));

$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

masterstudy_show_template('course_lesson', $atts);
