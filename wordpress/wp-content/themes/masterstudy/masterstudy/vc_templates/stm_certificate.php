<?php
extract( shortcode_atts( array(
	'title' => '',
	'image'	=> '',
	'css'   => ''
), $atts ) );
$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if(!empty($image)){
	$atts['certificate_url'] = wp_get_attachment_image_src($image, 'img-480-380', true);
}

masterstudy_show_template('certificate', $atts);
