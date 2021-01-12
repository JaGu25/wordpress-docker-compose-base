<?php

/**
 * @var $post_list_data_source
 */

$pairs = array(
    'name' => '',
    'image' => '',
    'post_list_data_source' => 'post',
    'post_list_per_page' => '3',
    'post_list_per_row' => '3',
    'post_list_show_date' => '',
    'post_list_show_cats' => '',
    'post_list_show_tags' => '',
    'post_list_show_comments' => '',
    'custom_color' => '',
);

extract(shortcode_atts($pairs, $atts));

$atts = wp_parse_args($atts, $pairs);

$atts['post_list_data_source'] = $post_list_data_source;

masterstudy_show_template('post_list', $atts);