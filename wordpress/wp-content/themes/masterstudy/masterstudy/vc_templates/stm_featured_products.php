<?php

/**
 * @var $view_type
 * @var $per_page
 * @var $expert_id
 * @var $meta_key
 * @var $per_row
 * @var $hide_price
 * @var $hide_comments
 * @var $hide_rating
 */

extract(shortcode_atts(array(
    'meta_key' => 'all',
    'expert_id' => 'no_expert',
    'category_id' => 'no_category',
    'product_tag_id' => 'no_tag',
    'view_type' => 'featured_products_carousel',
    'auto' => '0',
    'per_page' => '-1',
    'per_row' => 4,
    'order' => 'DESC',
    'orderby' => 'date',
    'hide_price' => false,
    'hide_rating' => false,
    'hide_comments' => false,
    'price_bg' => '#48a7d4',
    'free_price_bg' => '#eab830',
    'css' => ''
), $atts));

$atts['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$atts['featured_product_num'] = stm_create_unique_id($atts);
$atts['meta_key'] = (isset($meta_key)) ? $meta_key : 'all';
$atts['view_type'] = (isset($view_type)) ? $view_type : 'featured_products_carousel';
$atts['per_page'] = (isset($per_page)) ? $per_page : '-1';
$atts['per_row'] = (isset($per_row)) ? $per_row : 4;
$atts['hide_price'] = (isset($hide_price)) ? $hide_price : false;
$atts['hide_rating'] = (isset($hide_rating)) ? $hide_rating : false;
$atts['hide_comments'] = (isset($hide_comments)) ? $hide_comments : false;

masterstudy_show_template('featured_products', $atts);
