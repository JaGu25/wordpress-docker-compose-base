<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if( empty( $product ) || !$product->is_visible() ) {
    return;
}

$classes = array();

$shop_sidebar_position = stm_option( 'shop_sidebar_position', 'none' );
if( isset( $_GET[ 'sidebar_position' ] ) and $_GET[ 'sidebar_position' ] == 'none' ) {
    $shop_sidebar_position = 'none';
}

if( $shop_sidebar_position == 'none' ) {
    $classes[] = 'col-md-3 col-sm-4 col-xs-6 course-col';
}
else {
    $classes[] = 'col-md-4 col-sm-4 col-xs-6 course-col';
}

$enable_shop = stm_option( 'enable_shop', false );

if( $enable_shop ): ?>
    <li <?php wc_product_class( $classes, $product ); ?>>
        <div class="product__inner">

            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_before_shop_loop_item' );

            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            ?>
            <?php
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );

            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </div>
    </li>
<?php
else:
// Extra post classes

    ?>
    <!-- Custom Meta -->
    <?php
    $experts = get_post_meta( get_the_id(), 'course_expert', true );
    $stock = get_post_meta( get_the_id(), '_stock', true );
    $regular_price = get_post_meta( get_the_id(), '_regular_price', true );
    $sale_price = get_post_meta( get_the_id(), '_sale_price', true );
    ?>
    <li <?php wc_product_class( $classes, $product ); ?>>
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>

        <div class="stm_archive_product_inner_unit heading_font">
            <div class="stm_archive_product_inner_unit_centered">

                <div class="stm_featured_product_image">
                    <?php if( $product->is_type( 'simple' ) ) { ?>
                        <div class="stm_featured_product_price">
                            <?php if( !empty( $sale_price ) and $sale_price != 0 ): ?>
                                <div class="price">
                                    <?php echo wc_price( $sale_price ); ?>
                                </div>

                            <?php elseif( !empty( $regular_price ) and $regular_price != 0 ): ?>
                                <div class="price">
                                    <h5><?php echo wc_price( $regular_price ); ?></h5>
                                </div>
                            <?php else: ?>
                                <div class="price price_free">
                                    <h5><?php esc_html_e( 'Free', 'masterstudy' ); ?></h5>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php } elseif( $product->is_type( 'variable' ) ) { ?>
                        <?php $available_variations = $product->get_available_variations(); ?>
                        <?php if( !empty( $available_variations[ 0 ][ 'display_regular_price' ] ) ): ?>

                            <div class="stm_featured_product_price">
                                <div class="price">
                                    <?php if( !empty( $available_variations[ 0 ][ 'display_price' ] ) ): ?>
                                        <?php echo( wc_price( $available_variations[ 0 ][ 'display_price' ] ) ); ?>
                                    <?php else: ?>
                                        <?php echo( wc_price( $available_variations[ 0 ][ 'display_regular_price' ] ) ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php } ?>

                    <?php if( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink() ?>"
                           title="<?php esc_attr_e( 'View course', 'masterstudy' ) ?> - <?php the_title(); ?>">
                            <?php echo masterstudy_lazyload_image( get_the_post_thumbnail( get_the_ID(), 'img-270-283', array( 'class' => 'img-responsive' ) ) ); ?>
                        </a>
                    <?php else: ?>
                        <div class="no_image_holder"></div>
                    <?php endif; ?>

                </div>


                <div class="stm_featured_product_body">
                    <a href="<?php the_permalink() ?>"
                       title="<?php esc_attr_e( 'View course', 'masterstudy' ) ?> - <?php the_title(); ?>">
                        <div class="title"><?php the_title(); ?></div>
                    </a>
                    <?php if( !empty( $experts ) and $experts != 'no_expert' and ( is_array( $experts ) && !in_array( "no_expert", $experts ) ) ): ?>
                        <?php if( is_array( $experts ) ) { ?>
                            <div class="expert">
                                <?php foreach( $experts as $expert ) { ?>
                                    <?php echo esc_attr( get_the_title( $expert ) );
                                    if( end( $experts ) !== $expert ) {
                                        echo ', ';
                                    } ?>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="expert"><?php echo esc_attr( get_the_title( $experts ) ); ?></div>
                        <?php } ?>
                    <?php else: ?>
                        <div class="expert">&nbsp;</div>
                    <?php endif; ?>
                </div>

                <div class="stm_featured_product_footer">
                    <div class="clearfix">
                        <div class="pull-left">

                            <?php $comments_num = get_comments_number( get_the_id() ); ?>
                            <?php if( $comments_num ): ?>
                                <div class="stm_featured_product_comments">
                                    <i class="fa-icon-stm_icon_comment_o"></i><span><?php echo esc_attr( $comments_num ); ?></span>
                                </div>
                            <?php else: ?>
                                <div class="stm_featured_product_comments">
                                    <i class="fa-icon-stm_icon_comment_o"></i><span>0</span>
                                </div>
                            <?php endif; ?>


                            <?php if( !empty( $stock ) ): ?>
                                <div class="stm_featured_product_stock">
                                    <i class="fa-icon-stm_icon_user"></i><span><?php echo esc_attr( floatval( $stock ) ); ?></span>
                                </div>
                            <?php else: ?>
                                <div class="stm_featured_product_stock">
                                    <i class="fa-icon-stm_icon_user"></i><span>0</span>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="pull-right">
                            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                        </div>
                    </div>

                    <div class="stm_featured_product_show_more">
                        <a class="btn btn-default" href="<?php the_permalink() ?>"
                           title="<?php esc_attr_e( 'View more', 'masterstudy' ) ?>"><?php esc_html_e( 'View more', 'masterstudy' ); ?></a>
                    </div>
                </div>

            </div> <!-- stm_archive_product_inner_unit_centered -->
        </div> <!-- stm_archive_product_inner_unit -->
    </li>
<?php endif; ?>