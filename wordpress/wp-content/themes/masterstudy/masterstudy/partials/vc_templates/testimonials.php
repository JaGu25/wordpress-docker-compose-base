<?php
/**
 * @var $style
 * @var $atts
 * @var $css_class
 */

$style = $atts['style'] = (empty($style)) ? 'style_1' : $style;

stm_load_vc_element('testimonials', $atts, $style); ?>
