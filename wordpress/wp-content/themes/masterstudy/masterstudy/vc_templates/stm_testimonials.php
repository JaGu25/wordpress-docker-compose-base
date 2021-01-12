<?php

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$atts['atts'] = $atts;

masterstudy_show_template('testimonials', $atts);
