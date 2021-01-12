<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

    <div id="comment-<?php comment_ID(); ?>" class="comment_container">
        <div class="stm_review_author_name">
            <h4><?php comment_author(); ?>
                <?php
                if (get_option('woocommerce_review_rating_verification_label') === 'yes') {
                    if (wc_customer_bought_product($comment->comment_author_email, $comment->user_id, $comment->comment_post_ID)) {
                        echo '<em class="verified">(' . __('verified owner', 'masterstudy') . ')</em> ';
                    }
                }
                ?>
            </h4>
        </div>

        <?php echo get_avatar($comment, apply_filters('woocommerce_review_gravatar_size', '75'), ''); ?>

        <div class="comment-text">

            <?php if ($rating && get_option('woocommerce_enable_review_rating') == 'yes') : ?>

                <div itemscope itemtype="http://schema.org/Rating" class="star-rating"
                     title="<?php printf(esc_attr__('Rated %d out of 5', 'masterstudy'), $rating) ?>">
                    <span style="width:<?php echo esc_attr($rating / 5) * 100; ?>%"><strong><?php echo sanitize_text_field($rating); ?></strong> <?php esc_html_e('out of 5', 'masterstudy'); ?></span>
                </div>

            <?php endif; ?>

            <?php if ($comment->comment_approved == '0') : ?>

                <p class="meta"><em><?php esc_html_e('Your comment is awaiting approval', 'masterstudy'); ?></em></p>

            <?php else : ?>

                <p class="meta">
                    <time datetime="<?php printf(_x('%s ago', '%s = human-readable time difference', 'masterstudy'), human_time_diff(get_comment_time('U'), current_time('timestamp'))); ?>">
                        <?php printf(_x('%s ago', '%s = human-readable time difference', 'masterstudy'), human_time_diff(get_comment_time('U'), current_time('timestamp'))); ?>
                    </time>
                </p>

            <?php endif; ?>

            <div class="description"><?php comment_text(); ?></div>
        </div>
    </div>
