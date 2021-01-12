<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if( empty( $woocommerce_loop[ 'loop' ] ) ) {
    $woocommerce_loop[ 'loop' ] = 0;
}

// Store column count for displaying the grid
if( empty( $woocommerce_loop[ 'columns' ] ) ) {
    $woocommerce_loop[ 'columns' ] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if( !$product || !$product->is_visible() ) {
    return;
}

// Increase loop count
$woocommerce_loop[ 'loop' ]++;

// Extra post classes
$classes = array();

$classes[] = 'col-md-12 course-col-list';

if( 0 == ( $woocommerce_loop[ 'loop' ] - 1 ) % $woocommerce_loop[ 'columns' ] || 1 == $woocommerce_loop[ 'columns' ] ) {
    $classes[] = 'first';
}
if( 0 == $woocommerce_loop[ 'loop' ] % $woocommerce_loop[ 'columns' ] ) {
    $classes[] = 'last';
}
?>

    <!-- Custom Meta -->
<?php
$experts = get_post_meta( get_the_id(), 'course_expert', true );
$status = get_post_meta( get_the_id(), 'course_status', true );
$stock = get_post_meta( get_the_id(), '_stock', true );
$regular_price = get_post_meta( get_the_id(), '_regular_price', true );
$sale_price = get_post_meta( get_the_id(), '_sale_price', true );

$enable_shop = stm_option( 'enable_shop', false );
?>

<?php if( $enable_shop ): ?>
    <li <?php post_class( $classes ); ?>>
        <div class="product-image">
            <a href="<?php the_permalink(); ?>">
                <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
            </a>
        </div>
        <div class="product-content">
            <a href="<?php the_permalink(); ?>">
                <?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
            </a>
            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
            <?php if( !empty( get_the_excerpt() ) ): ?>
                <div class="product-excerpt">
                    <?php echo get_the_excerpt(); ?>
                </div>
            <?php endif; ?>
            <?php
            if( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
                woocommerce_template_loop_add_to_cart();
            }
            ?>
        </div>
    </li>
<?php else: ?>
    <li <?php post_class( $classes ); ?>>

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <div class="stm_archive_product_inner_unit heading_font">
            <div class="stm_archive_product_inner_unit_centered clearfix">

                <div class="stm_featured_product_image_list">

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
                            <?php the_post_thumbnail( 'img-300-225', array( 'class' => 'img-responsive' ) ); ?>
                        </a>
                    <?php else: ?>
                        <div class="no_image_holder"></div>
                    <?php endif; ?>

                </div>

                <div class="stm_products_archive_body_list">
                    <h2 class="title">
                        <?php the_title(); ?>
                        <?php if( !empty( $status ) and $status != 'no_status' ): ?>
                            <span class="product_status h5 <?php echo esc_attr( $status ); ?>">
                            <?php printf( _x( '%s', 'Course status', 'masterstudy' ), stm_lms_get_offline_course_status( $status ) ); ?>
                        </span>
                        <?php endif; ?>
                    </h2>
                    <div class="clearfix stm_product_meta_unit">

                        <?php if( !empty( $experts ) and $experts != 'no_expert' and ( is_array( $experts ) && !in_array( "no_expert", $experts ) ) ): ?>
                            <?php if( is_array( $experts ) ) { ?>
                                <div class="clearfix"></div>
                                <?php foreach( $experts as $expert ) { ?>
                                    <div class="pull-left">
                                        <a class="expert_unit_link" href="<?php echo get_permalink( $expert ); ?>">
                                            <div class="expert_unit">
                                                <?php $expert_image = wp_get_attachment_image_src( get_post_thumbnail_id( $expert ), 'img-75-75', false ); ?>
                                                <?php if( !empty( $expert_image[ 0 ] ) ): ?>
                                                    <div class="expert_img">
                                                        <img class="img-responsive"
                                                             src="<?php echo esc_url( $expert_image[ 0 ] ) ?>"/>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="expert h6">
                                                    <div class="value"><?php echo esc_attr( get_the_title( $expert ) ); ?></div>
                                                    <span><?php esc_html_e( 'Teacher', 'masterstudy' ); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="pull-left">
                                    <a class="expert_unit_link" href="<?php echo get_permalink( $experts ); ?>">
                                        <div class="expert_unit">
                                            <?php $expert_image = wp_get_attachment_image_src( get_post_thumbnail_id( $experts ), 'img-75-75', false ); ?>
                                            <?php if( !empty( $expert_image[ 0 ] ) ): ?>
                                                <div class="expert_img"><img class="img-responsive"
                                                                             src="<?php echo esc_url( $expert_image[ 0 ] ) ?>"/>
                                                </div>
                                            <?php endif; ?>
                                            <div class="expert h6">
                                                <div class="value"><?php echo esc_attr( get_the_title( $experts ) ); ?></div>
                                                <span><?php esc_html_e( 'Teacher', 'masterstudy' ); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php endif; ?>

                        <?php if( !empty( $stock ) ): ?>
                            <div class="pull-right sm-xs-pull-left">
                                <div class="stm_featured_product_stock">
                                    <i class="fa-icon-stm_icon_users"></i>
                                    <span class="h6"><?php echo esc_attr( floatval( $stock ) ); ?> <?php _e( 'Available', 'masterstudy' ); ?>
                                        <br/><?php esc_html_e( 'seats', 'masterstudy' ); ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="pull-right">
                                <div class="stm_featured_product_stock">
                                    <i class="fa-icon-stm_icon_users"></i>
                                    <span class="h6">0 <?php _e( 'Available', 'masterstudy' ); ?>
                                        <br/><?php esc_html_e( 'seats', 'masterstudy' ); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="stm_archive_product_exceprt normal_font">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="see_more h5">
                        <a href="<?php the_permalink() ?>"><?php esc_html_e( 'See more', 'masterstudy' ); ?></a>
                    </div>
                </div>


            </div> <!-- stm_archive_product_inner_unit_centered -->
            <div class="multiseparator"></div>
        </div> <!-- stm_archive_product_inner_unit -->
    </li>
<?php endif; ?>