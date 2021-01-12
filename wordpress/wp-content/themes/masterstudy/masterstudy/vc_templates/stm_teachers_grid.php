<?php

extract(shortcode_atts(array(
	'per_page'   => '4',
	'pagination' => 'show',
	'image_size' => 'img-270-180',
	'css'        => ''
), $atts));

$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$atts['pagination'] = (isset($pagination)) ? $pagination : '';

masterstudy_show_template('teachers_grid', $atts);
