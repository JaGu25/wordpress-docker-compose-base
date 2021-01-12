<?php
extract( shortcode_atts( array(
	'per_page' => '4',
	'css'   => ''
), $atts ) );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

masterstudy_show_template('events_grid', $atts);
