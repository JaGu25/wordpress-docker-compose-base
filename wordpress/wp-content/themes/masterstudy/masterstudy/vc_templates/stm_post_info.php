<?php
extract( shortcode_atts( array(
	'css'   => ''
), $atts ) );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

masterstudy_show_template('post_info', $atts);
