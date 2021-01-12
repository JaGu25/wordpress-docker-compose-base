<?php
// Declare Woo support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support()
{
    add_theme_support( 'woocommerce' );
}

// Remove woo styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

//Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults )
{
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults[ 'delimiter' ] = '<i class="fa fa-chevron-right"></i>';
    return $defaults;
}

add_action( 'woocommerce_before_main_content', 'stm_woo_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'stm_woo_theme_wrapper_end', 10 );

function stm_woo_theme_wrapper_start()
{
    echo esc_attr( '' );
}

function stm_woo_theme_wrapper_end()
{
    echo esc_attr( '' );
}

// Remove product count
$stm_options = get_option( 'stm_option', array() );
$enable_shop = false;
if( !empty( $stm_options[ 'enable_shop' ] ) ) {
    $enable_shop = $stm_options[ 'enable_shop' ];
}
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
if( !$enable_shop ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
}

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

add_action( 'after_setup_theme', 'stm_woo_setup' );
function stm_woo_setup()
{
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_filter( 'woocommerce_gallery_thumbnail_size', 'stm_woocommerce_gallery_thumbnail_size', 100, 1 );

function stm_woocommerce_gallery_thumbnail_size( $dims )
{
    return array( 150, 100 );
}

add_filter( 'woocommerce_gallery_image_size', 'stm_woocommerce_gallery_image_size' );

function stm_woocommerce_gallery_image_size( $size )
{
    return 'large';
}

add_filter( 'single_product_archive_thumbnail_size', 'stm_single_product_archive_thumbnail_size' );

function stm_single_product_archive_thumbnail_size( $size )
{
    return 'full';
}

add_filter( 'woocommerce_output_related_products_args', 'stm_related_products_args' );

function stm_related_products_args( $args )
{
    $args['posts_per_page'] = 3;
    $args['columns'] = 3;
    return $args;
}
