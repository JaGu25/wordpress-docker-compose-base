<?php

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

masterstudy_show_template('buddypress_groups', $atts);
