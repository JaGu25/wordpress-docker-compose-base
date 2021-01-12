<?php
extract(shortcode_atts(array(
	'title'          => '',
	'view_type'      => 'stm_vc_product_cat_carousel',
	'number'         => '',
	'per_row'        => 6,
	'box_text_color' => '#fff',
	'text_align'     => 'center',
	'icon_size'      => '60',
	'auto'           => '0',
	'icon_height'    => '69',
	'css'            => ''
), $atts));

$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$atts['view_type'] = (isset($view_type)) ? $view_type : 'stm_vc_product_cat_carousel';
$atts['number'] = (isset($number)) ? $number : '';
$atts['per_row'] = (isset($per_row)) ? $per_row : 6;
$atts['text_align'] = (isset($text_align)) ? $text_align : 'center';
$atts['icon_size'] = (isset($icon_size)) ? $icon_size : '60';
$atts['auto'] = (isset($auto)) ? $auto : '0';
$atts['icon_height'] = (isset($icon_height)) ? $icon_height : '69';
$atts['atts'] = $atts;

masterstudy_show_template('product_categories', $atts);
