<?php
extract( shortcode_atts( array(
	'css' => '',
	'sidebar' => '0',
	'sidebar_position' => 'right'
), $atts ) );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['sidebar_position'] = $sidebar_position;

masterstudy_show_template('sidebar', $atts);
