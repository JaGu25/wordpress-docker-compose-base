<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$atts['main_class'] = $main_class = stm_create_unique_id($atts);
$atts['atts'] = $atts;

masterstudy_show_template('image_box', $atts);
