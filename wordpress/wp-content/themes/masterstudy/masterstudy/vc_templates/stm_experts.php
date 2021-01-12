<?php
extract(shortcode_atts(array(
	'name'                  => '',
	'image'                 => '',
	'experts_title'         => '',
	'experts_max_num'       => '-1',
	'experts_output_style'  => 'experts_carousel',
	'expert_slides_per_row' => 2,
	'experts_all'           => true,
), $atts));

$atts['experts_max_num'] = (isset($experts_max_num)) ? $experts_max_num : '-1';
$atts['experts_output_style'] = (isset($experts_output_style)) ? $experts_output_style : 'experts_carousel';
$atts['expert_slides_per_row'] = (isset($expert_slides_per_row)) ? $expert_slides_per_row : 2;

masterstudy_show_template('experts', $atts);
