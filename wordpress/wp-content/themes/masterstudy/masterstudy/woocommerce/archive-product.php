<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php
$shop_sidebar_id = stm_option( 'shop_sidebar' );
$enable_shop = stm_option( 'enable_shop', false );
$shop_sidebar_position = stm_option( 'shop_sidebar_position', 'none' );
$content_before = $content_after = $sidebar_before = $sidebar_after = '';
$sidebar_type = '';

// For demo
if( isset( $_GET[ 'sidebar_position' ] ) and $_GET[ 'sidebar_position' ] == 'right' ) {
    $shop_sidebar_position = 'right';
}
elseif( isset( $_GET[ 'sidebar_position' ] ) and $_GET[ 'sidebar_position' ] == 'left' ) {
    $shop_sidebar_position = 'left';
}
elseif( isset( $_GET[ 'sidebar_position' ] ) and $_GET[ 'sidebar_position' ] == 'none' ) {
    $shop_sidebar_position = 'none';
}

if( $shop_sidebar_id ) $shop_sidebar = get_post( $shop_sidebar_id );

if( is_active_sidebar( 'shop' ) ) {
    $shop_sidebar = 'widget_area';
    $shop_sidebar_position = 'right';
}

if( $shop_sidebar_position == 'right' && isset( $shop_sidebar ) ) {
    $content_before .= '<div class="row">';
    $content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
    $content_before .= '<div class="sidebar_position_right">';
    // .products
    $content_after .= '</div>'; // sidebar right
    $content_after .= '</div>'; // col
    $sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
    $sidebar_before .= '<div class="sidebar-area sidebar-area-right">';
    // .sidebar-area
    $sidebar_after .= '</div>'; // sidebar area
    $sidebar_after .= '</div>'; // col
    $sidebar_after .= '</div>'; // row
}

if( $shop_sidebar_position == 'left' && isset( $shop_sidebar ) ) {
    $content_before .= '<div class="row">';
    $content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';
    $content_before .= '<div class="sidebar_position_left">';
    // .products
    $content_after .= '</div>'; // sidebar right
    $content_after .= '</div>'; // col
    $sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
    $sidebar_before .= '<div class="sidebar-area sidebar-area-left">';
    // .sidebar-area
    $sidebar_after .= '</div>'; // sidebar area
    $sidebar_after .= '</div>'; // col
    $sidebar_after .= '</div>'; // row
};

// Grid or list
$layout_products = stm_option( 'shop_layout' );
if( isset( $_GET[ 'view_type' ] ) ) {
    if( $_GET[ 'view_type' ] == 'list' ) {
        $layout_products = 'list';
    }
    else {
        $layout_products = 'grid';
    }
}

$display_type = get_option( 'woocommerce_shop_page_display', '' );

get_template_part( 'partials/title_box' ); ?>

    <div class="container">

        <?php echo wp_kses_post( $content_before ); ?>
        <?php if( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h2 class="archive-course-title"><?php woocommerce_page_title(); ?></h2>
        <?php endif; ?>

        <?php
        do_action( 'woocommerce_archive_description' ); ?>

        <?php wc_get_template_part( 'global/helpbar' ); ?>
        <div class="stm_archive_product_inner_grid_content">
            <?php

            if( have_posts() and $display_type != 'subcategories' ) : ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php if( !empty( $display_type ) ) woocommerce_output_product_categories(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php if( $layout_products == 'list' ): ?>
                        <?php if( !$enable_shop ): ?>
                            <div class="stm_woo_archive_view_type_list">
                        <?php endif; ?>
                        <?php wc_get_template_part( 'content', 'product-list' ); ?>
                        <?php if( !$enable_shop ): ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endif; ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <div class="multiseparator <?php echo esc_attr( $layout_products ); ?>"></div>

                <?php do_action( 'woocommerce_after_shop_loop' ); /* Pagination */ ?>

            <?php elseif( !woocommerce_product_loop() ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif; ?>

        </div> <!-- stm_product_inner_grid_content -->
        <?php echo wp_kses_post( $content_after ); ?>

        <?php echo wp_kses_post( $sidebar_before ); ?>
        <?php
        if( isset( $shop_sidebar ) && $shop_sidebar_position != 'none' ) {
            if( $shop_sidebar == 'widget_area' ) {
                dynamic_sidebar( 'shop' );
            }
            else {
                echo apply_filters( 'the_content', $shop_sidebar->post_content );
            }
        }
        ?>
        <?php echo wp_kses_post( $sidebar_after ); ?>

    </div> <!-- container -->

<?php get_footer();