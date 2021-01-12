<?php
extract( shortcode_atts( array(
	'color' => '',
	'title' => '',
	'price' => '',
	'period' => '',
	'button' => '',
	'css'	=> ''
), $atts ) );


$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['button'] = vc_build_link( $button );
$atts['plan']  = 'stm_pricing_plan_' . stm_create_unique_id($atts);

masterstudy_show_template('pricing_plan', $atts);
