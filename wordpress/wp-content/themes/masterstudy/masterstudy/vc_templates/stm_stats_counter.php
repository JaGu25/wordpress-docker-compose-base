<?php
extract( shortcode_atts( array(
	'title' => '',
	'counter_value' => '1000',
	'duration' => '2.5',
	'icon'  => '',
	'icon_size'  => '65',
	'icon_height'  => '90',
	'icon_text_alignment' => 'center',
	'icon_text_color' => '#fff',
	'counter_text_color' => '#eab830',
	'text_font_size' => '',
	'counter_text_font_size' => '',
	'border' => '',
	'css'   => ''
), $atts ) );

$atts['counter_value'] = $counter_value;
$atts['duration'] = $duration;
$atts['icon_size'] = $icon_size;
$atts['icon_height'] = $icon_height;
$atts['icon_text_alignment'] = $icon_text_alignment;
$atts['icon_text_color'] = $icon_text_color;
$atts['counter_text_color'] = $counter_text_color;
$atts['text_font_size'] = $text_font_size;
$atts['counter_text_font_size'] = $counter_text_font_size;

$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$atts['id'] = 'counter_' . stm_create_unique_id($atts);

masterstudy_show_template('stats_counter', $atts);
