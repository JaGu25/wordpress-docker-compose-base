<?php
/**
 * @var $icon_align
 * @var $icon_height
 * @var $icon_width
 * @var $icon_width
 * @var $link_color_style
 * @var $css_icon
 * @var $box_bg_color
 * @var $box_text_color
 * @var $title_holder
 * @var $icon_size
 * @var $icon_color
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon_inline_css = '';
$icon_inline_css = ($icon_align == 'center') ? "height:".esc_attr($icon_height)."px;" : "width:".esc_attr($icon_width)."px;";

$atts['css_icon'] = $atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['css_icon_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css_icon, ' ' ) );
$atts['icon_inline_css'] = $icon_inline_css;
$atts['link'] = vc_build_link( $link );
$atts['unique'] = stm_create_unique_id($atts);
$atts['content'] = $content;

masterstudy_show_template('icon_box', $atts);
