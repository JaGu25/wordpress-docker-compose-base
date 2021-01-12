<?php
extract(shortcode_atts(array(
    'datepicker' => '',
    'label_color' => '',
    'css' => ''
), $atts));
$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

masterstudy_show_template('countdown', $atts);
