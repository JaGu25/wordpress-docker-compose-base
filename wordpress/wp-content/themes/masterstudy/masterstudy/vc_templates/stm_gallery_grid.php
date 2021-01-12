<?php
extract( shortcode_atts( array(
	'title' => '',
	'masonry' => '',
	'per_page' => '12',
	'css'   => ''
), $atts ) );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

masterstudy_show_template('gallery_grid', $atts);
