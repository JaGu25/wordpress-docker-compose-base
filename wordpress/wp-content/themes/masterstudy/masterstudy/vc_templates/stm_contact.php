<?php
/**
 * @var $image_size
 * @var $name
 * @var $phone
 * @var $email
 * @var $skype
 */

extract( shortcode_atts( array(
	'name'  => '',
	'image'  => '',
	'image_size'  => 'thumb-124x108',
	'job'  => '',
	'phone'  => '',
	'email'  => '',
	'skype'  => '',
	'css'  => ''
), $atts ) );

$atts['css_class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$atts['image'] = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $image_size ) );
$atts['image_size'] = $image_size;
$atts['image_id'] = $image;

masterstudy_show_template('contact', $atts);
