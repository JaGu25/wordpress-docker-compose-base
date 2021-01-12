<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['uniq_class'] = stm_create_unique_id($atts);

masterstudy_show_template('mailchimp', $atts);
