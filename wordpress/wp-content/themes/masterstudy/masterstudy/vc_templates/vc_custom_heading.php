<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $el_id
 * @var $css
 * @var $icon
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$source = $text = $link = $google_fonts = $font_container  = $el_id = $el_class = $css = $font_container_data = $google_fonts_data = $icon = '';
// This is needed to extract $font_container_data and $google_fonts_data

extract( shortcode_atts( array(
		'icon'  => '',
		'icon_size'  => '67',
		'icon_pos' => '',
		'icon_pos_top' => '',
		'icon_pos_right' => '',
		'icon_pos_bottom' => '',
		'subtitle'   => '',
		'stripe_pos' => '',
		'subtitle_color' => '',
		'stm_title_font_weight' => ''
), $atts ) );

extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if ( isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

$link = vc_build_link( $link );

masterstudy_show_template('vc_custom_heading', get_defined_vars());
