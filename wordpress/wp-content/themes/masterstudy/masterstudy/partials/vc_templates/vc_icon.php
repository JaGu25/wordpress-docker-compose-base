<?php

if (!defined('ABSPATH')) {
    die('-1');
}

$class_to_filter = '';

$has_style = false;
if (strlen($background_style) > 0) {
    $has_style = true;
    if (false !== strpos($background_style, 'outline')) {
        $background_style .= ' vc_icon_element-outline'; // if we use outline style it is border in css
    } else {
        $background_style .= ' vc_icon_element-background';
    }
}

$iconClass = $icon['value'];

$style = '';
if ('custom' === $background_color) {
    if (false !== strpos($background_style, 'outline')) {
        $style = 'border-color:' . $custom_background_color;
    } else {
        $style = 'background-color:' . $custom_background_color;
    }
}
$style = $style ? ' style="' . esc_attr($style) . '"' : '';
$rel = '';
if (!empty($url['rel'])) {
    $rel = ' rel="' . esc_attr($url['rel']) . '"';
}
$output = '';
$output .= '<div' . (!empty($el_id) ? ' id="' . esc_attr($el_id) . '"' : '') . ' class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left';
if ($has_style) {
    $output .= ' vc_icon_element-have-style';
}
$output .= '"><div class="vc_icon_element-inner vc_icon_element-color-' . esc_attr($color);
if ($has_style) {
    $output .= ' vc_icon_element-have-style-inner';
}

$output .= ' vc_icon_element-size-' . esc_attr($size) . ' vc_icon_element-style-' . esc_attr($background_style) . ' vc_icon_element-background-color-' . esc_attr($background_color) . '" ' . $style . '><span class="vc_icon_element-icon ' . $icon['value'] . '" ' . ('custom' === $color ? 'style="color:' . esc_attr($custom_color) . ' !important"' : '') . '></span>';

if (!empty($url['url'])) {
    $output .= '<a class="vc_icon_element-link" href="' . esc_url($url['url']) . '" ' . $rel . ' title="' . esc_attr($url['title']) . '" target="' . (strlen($url['target']) > 0 ? esc_attr($url['target']) : '_self') . '"></a>';
}
$output .= '</div></div>';

echo masterstudy_filtered_output( $output );
