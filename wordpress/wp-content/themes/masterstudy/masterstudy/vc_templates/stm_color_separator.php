<?php
extract( shortcode_atts( array(
	'color' => '#fdc735',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$unique = stm_create_unique_id($atts);
$atts['unique'] = $unique;
$atts['inline_styles'] = "
    .{$unique} .triangled_colored_separator {
        background-color: {$color} !important;
    }
    .{$unique} .triangled_colored_separator .triangle {
        border-bottom-color: {$color} !important;
    }
";


masterstudy_show_template('color_separator', $atts);
