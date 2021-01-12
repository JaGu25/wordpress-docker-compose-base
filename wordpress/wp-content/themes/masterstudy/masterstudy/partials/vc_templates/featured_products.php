<?php

/**
 * @var $view_type
 * @var $per_page
 * @var $expert_id
 * @var $category_id
 * @var $product_tag_id
 * @var $meta_key
 * @var $per_row
 * @var $hide_price
 * @var $hide_comments
 * @var $hide_rating
 * @var $featured_product_num
 * @var $css_class
 */


$expert_id = (!isset($expert_id) || empty($expert_id)) ? 'no_expert' : $expert_id;
$category_id = (!isset($category_id) || empty($category_id)) ? 'no_category' : $category_id;
$product_tag_id = (!isset($product_tag_id) || empty($product_tag_id)) ? 'no_tag' : $product_tag_id;

if ($view_type == 'featured_products_carousel') {
    wp_enqueue_script('owl.carousel');
    wp_enqueue_style('owl.carousel');
    stm_module_scripts('featured_products');
}

stm_module_styles('featured_products','style_1');

// All args for extract all products
$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'order' => $order,
    'orderby' => $orderby,
    'posts_per_page' => $per_page,
);

if (!empty($category_id) and $category_id != 'no_category') {
    $args['product_cat'] = $category_id;
}

if (!empty($product_tag_id) and $product_tag_id != 'no_tag') { // ALP for filtering  STM products by tags
    $args['product_tag'] = $product_tag_id;
}

$args['meta_query'][] = array(
    'key' => '_stock_status',
    'value' => 'instock',
);

// Get featured products
if ($meta_key == '_featured') {
    $args['meta_query'][] = array(
        'key' => '_featured',
        'value' => 'yes',
    );
} elseif ($meta_key == 'expert' and $meta_key != 'no_expert') {
    $args['meta_query'][] = array(
        'key' => 'course_expert',
        'value' => $expert_id,
        'compare' => 'LIKE'
    );
}

$featured_query = new WP_Query($args);

$cols_per_row = 12 / $per_row;

$price_bg  = stm_option('secondary_color', '#48a7d4');
$free_price_bg  = stm_option('primary_color', '#48a7d4');

?>


<?php if ($featured_query->have_posts()): ?>

    <div class="stm_featured_products_unit <?php echo esc_attr($view_type); ?>">

        <?php if ($view_type == 'featured_products_carousel'): ?>
        <div class="simple_carousel_with_bullets">
            <div class="simple_carousel_bullets_init_<?php echo esc_attr($featured_product_num); ?> clearfix simple_carousel_init"
                 data-items="<?php echo esc_attr($per_row); ?>">
                <?php else: ?>
                <div class="row">
                    <?php endif; ?>

                    <?php while ($featured_query->have_posts()): $featured_query->the_post(); ?>
                        <?php
                        global $product;
                        $experts = get_post_meta(get_the_id(), 'course_expert', true);
                        $stock = get_post_meta(get_the_id(), '_stock', true);
                        $regular_price = get_post_meta(get_the_id(), '_regular_price', true);
                        $sale_price = get_post_meta(get_the_id(), '_sale_price', true);
                        ?>
                        <div class="col-md-<?php echo esc_attr($cols_per_row); ?> col-sm-4 col-xs-12">
                            <div class="stm_featured_product_single_unit<?php echo esc_attr($css_class); ?> heading_font">
                                <div class="stm_featured_product_single_unit_centered">


                                    <div class="stm_featured_product_image">

                                        <?php if (!$hide_price): ?>
                                            <?php if ($product->is_type('simple')) { ?>
                                                <div class="stm_featured_product_price">
                                                    <?php if (!empty($sale_price) and $sale_price != 0): ?>
                                                        <div class="price"
                                                             style="background-color:<?php echo esc_attr($price_bg); ?>">
                                                            <h5><?php echo wc_price($sale_price); ?></h5>
                                                        </div>
                                                    <?php elseif (!empty($regular_price) and $regular_price != 0): ?>
                                                        <div class="price"
                                                             style="background-color:<?php echo esc_attr($price_bg); ?>">
                                                            <h5><?php echo wc_price($regular_price); ?></h5>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="price price_free"
                                                             style="background-color:<?php echo esc_attr($free_price_bg); ?>">
                                                            <h5><?php _e('Free', 'masterstudy'); ?></h5>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php } elseif ($product->is_type('variable')) { ?>
                                                <?php $available_variations = $product->get_available_variations(); ?>
                                                <?php if (!empty($available_variations[0]['display_regular_price'])): ?>

                                                    <div class="stm_featured_product_price">
                                                        <div class="price"
                                                             style="background-color:<?php echo esc_attr($price_bg); ?>">
                                                            <?php if (!empty($available_variations[0]['display_price'])): ?>
                                                                <?php echo(wc_price($available_variations[0]['display_price'])); ?>
                                                            <?php else: ?>
                                                                <?php echo(wc_price($available_variations[0]['display_regular_price'])); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php } ?>
                                        <?php endif; ?>


                                        <?php if (has_post_thumbnail()): ?>
                                            <a href="<?php the_permalink() ?>"
                                               title="<?php esc_attr_e('View course', 'masterstudy') ?> - <?php the_title(); ?>">
                                                <?php echo masterstudy_lazyload_image(get_the_post_thumbnail(get_the_ID(), 'img-270-283', array('class' => 'img-responsive'))); ?>
                                            </a>
                                        <?php else: ?>
                                            <div class="no_image_holder"></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="stm_featured_product_body">
                                        <a href="<?php the_permalink() ?>"
                                           title="<?php esc_attr_e('View course', 'masterstudy') ?> - <?php the_title(); ?>">
                                            <div class="title"><?php the_title(); ?></div>
                                        </a>
                                        <?php if (!empty($experts) and $experts != 'no_expert' and (is_array($experts) && !in_array("no_expert", $experts))): ?>
                                            <?php if (is_array($experts)) { ?>
                                                <div class="expert">
                                                    <?php foreach ($experts as $expert) { ?>
                                                        <?php echo esc_attr(get_the_title($expert));
                                                        if (end($experts) !== $expert) {
                                                            echo ', ';
                                                        } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="expert"><?php echo esc_attr(get_the_title($experts)); ?></div>
                                            <?php } ?>
                                        <?php else: ?>
                                            <div class="expert">&nbsp;</div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="stm_featured_product_footer">
                                        <div class="clearfix">
                                            <div class="pull-left">

                                                <?php if (!$hide_comments): ?>
                                                    <?php $comments_num = get_comments_number(get_the_id()); ?>
                                                    <?php if ($comments_num): ?>
                                                        <div class="stm_featured_product_comments">
                                                            <i class="fa-icon-stm_icon_comment_o"></i><span><?php echo esc_attr($comments_num); ?></span>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="stm_featured_product_comments">
                                                            <i class="fa-icon-stm_icon_comment_o"></i><span>0</span>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if (!empty($stock)): ?>
                                                    <div class="stm_featured_product_stock">
                                                        <i class="fa-icon-stm_icon_user"></i><span><?php echo esc_attr(floatval($stock)); ?></span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="stm_featured_product_stock">
                                                        <i class="fa-icon-stm_icon_user"></i><span>0</span>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                            <?php if (!$hide_rating): ?>
                                                <div class="pull-right">
                                                    <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="stm_featured_product_show_more">
                                            <a class="btn btn-default" href="<?php the_permalink() ?>"
                                               title="<?php esc_attr_e('View more', 'masterstudy') ?>"><?php _e('View more', 'masterstudy'); ?></a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <?php if ($view_type == 'featured_products_carousel'): ?>
                </div> <!-- simple_carousel_with_bullets_init -->
            </div> <!-- simple_carousel_with_bullets -->
            <?php else: ?>
        </div> <!-- row -->
    <?php endif; ?>

    </div> <!-- stm_featured_products_unit -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>
