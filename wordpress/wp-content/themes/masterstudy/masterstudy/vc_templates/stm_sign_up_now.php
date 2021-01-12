<?php
/**
 * @var $form
 */
extract(shortcode_atts(array(
    'title' => '',
    'form' => '',
    'css' => ''
), $atts));

$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$atts['title'] = (isset($title)) ? $title : '';

masterstudy_show_template('sign_up_now', $atts);
