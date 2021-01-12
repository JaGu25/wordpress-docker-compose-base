<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

$enable_shop = stm_option('enable_shop');

if($enable_shop):
    do_action( 'woocommerce_before_single_product' );

    if ( post_password_required() ) {
        echo get_the_password_form(); // WPCS: XSS ok.
        return;
    }
    ?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        ?>

        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>

    <?php do_action( 'woocommerce_after_single_product' );
else:
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

$experts = get_post_meta(get_the_id(), 'course_expert', true);

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="single_product_title"><?php wc_get_template('single-product/title.php'); ?></div>

    <div class="single_product_after_title">
        <div class="clearfix">
            <div class="pull-left meta_pull">
				<?php if (!empty($experts) and $experts != 'no_expert' and (is_array($experts) && !in_array("no_expert", $experts))): ?>
                    <div class="pull-left">
                        <div class="meta-unit teacher clearfix">
                            <div class="pull-left">
                                <i class="fa-icon-stm_icon_teacher"></i>
                            </div>
                            <div class="meta_values">
								<?php if (is_array($experts)) { ?>
                                    <div class="label h6"><?php esc_html_e('Teachers', 'masterstudy'); ?></div>
									<?php foreach ($experts as $expert) { ?>
                                        <a href="<?php echo get_permalink($expert); ?>">
                                            <div class="value h6">
												<?php echo esc_attr(get_the_title($expert)); ?><br/>
                                            </div>
                                        </a>
									<?php }
								} else { ?>
                                    <div class="label h6"><?php esc_html_e('Teacher', 'masterstudy'); ?></div>
                                    <a href="<?php echo get_permalink($experts); ?>">
                                        <div class="value h6"><?php echo esc_attr(get_the_title($experts)); ?></div>
                                    </a>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					<?php ?>
				<?php endif; ?>

				<?php
				$args = array(
					'number' => '2',
				);
				$product_cats = get_the_terms(get_the_id(), 'product_cat');
				if (!empty($product_cats)):?>
                    <div class="pull-left xs-product-cats-left">
                        <div class="meta-unit categories clearfix">
                            <div class="pull-left">
                                <i class="fa-icon-stm_icon_category"></i>
                            </div>
                            <div class="meta_values">
                                <div class="label h6"><?php esc_html_e('Category:', 'masterstudy'); ?></div>
                                <div class="value h6">
									<?php foreach ($product_cats as $product_cat): ?>
                                        <a href="<?php echo get_term_link($product_cat); ?>">
                                            <?php echo sanitize_text_field($product_cat->name); ?> <span>/</span>
                                        </a>
									<?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endif; ?>

            </div> <!-- meta pull -->

            <div class="pull-right xs-comments-left">
				<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
				<?php $comments_num = get_comments_number(get_the_id()); ?>
				<?php if ($comments_num): ?>
                    <div class="meta-unit text-right xs-text-left">
                        <div class="value h6"><?php echo esc_attr($comments_num) . ' ' . __('Reviews', 'masterstudy'); ?></div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Images -->
    <div class="stm_woo_gallery-wrapper">
		<?php do_action('woocommerce_before_single_product_summary'); ?>
        <a href="#" class="gallery-prev gallery-btn hidden"><i class="fa fa-chevron-left"></i></a>
        <a href="#" class="gallery-next gallery-btn hidden"><i class="fa fa-chevron-right"></i></a>
    </div>
    <!-- Images END-->

    <!-- Sidebar visible sm and xs -->
    <div class="stm_product_meta_single_page visible-sm visible-xs">
		<?php wc_get_template_part('content-single-product-meta-side'); ?>
    </div>

    <!-- Content -->
	<?php the_content(); ?>
    <!-- Content END -->

    <div class="multiseparator"></div>

	<?php if (is_array($experts)) { ?>
        <h3 class="teacher_single_product_page_title"><?php esc_html_e('About Instructors', 'masterstudy'); ?></h3>
		<?php foreach ($experts as $expert) { ?>
            <!-- Teacher -->
			<?php $teacher_post = get_post($expert); ?>
			<?php $teacher_job = get_post_meta($expert, 'expert_sphere', true); ?>
			<?php
			$origin_socials = array(
				'facebook',
				'linkedin',
				'twitter',
				'google-plus',
				'youtube-play',
			); ?>
            <div class="teacher_single_product_page clearfix">
                <a href="<?php echo get_the_permalink($expert); ?>"
                   title="<?php esc_attr_e('Watch Expert Page', 'masterstudy'); ?>">
					<?php $expert_image = wp_get_attachment_image_src(get_post_thumbnail_id($expert), 'img-129-129', false); ?>
					<?php if (!empty($expert_image[0])): ?>
                        <img class="img-responsive" src="<?php echo esc_url($expert_image[0]); ?>"/>
					<?php endif; ?>
                    <div class="title h4"><?php echo esc_attr(get_the_title($expert)); ?></div>
					<?php if (!empty($teacher_job)): ?>
                        <label class="job"><?php echo esc_attr($teacher_job); ?></label>
					<?php endif; ?>
                </a>
                <div class="expert_socials">
                    <div class="clearfix heading_font">
						<?php foreach ($origin_socials as $social): ?>
							<?php $current_social = get_post_custom_values($social, $expert); ?>
							<?php if (!empty($current_social[0])): ?>
                                <a class="expert-social-<?php echo esc_attr($social); ?>"
                                   href="<?php echo esc_url($current_social[0]); ?>"
                                   title="<?php esc_attr_e('View expert on', 'masterstudy') . ' ' . $social ?>">
                                    <i class="fab fa-<?php echo esc_attr(str_replace('youtube-play', 'youtube', $social)); ?>"></i>
                                </a>
							<?php endif; ?>
						<?php endforeach; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
				<?php if (!empty($teacher_post->post_excerpt)): ?>
                    <div class="content">
						<?php echo esc_attr($teacher_post->post_excerpt); ?>
                    </div>
				<?php endif; ?>
            </div>
            <div class="multiseparator"></div>
			<?php wp_reset_postdata(); ?>
            <!-- Teacher END-->
		<?php }
	} elseif (!empty($experts) and $experts != 'no_expert') { ?>
        <!-- Teacher -->
		<?php $teacher_post = get_post($experts); ?>
		<?php $teacher_job = get_post_meta($experts, 'expert_sphere', true); ?>
		<?php
		$origin_socials = array(
			'facebook',
			'linkedin',
			'twitter',
			'google-plus',
			'youtube-play',
		); ?>
        <h3 class="teacher_single_product_page_title"><?php esc_html_e('About Instructor', 'masterstudy'); ?></h3>
        <div class="teacher_single_product_page clearfix">
            <a href="<?php echo get_the_permalink($experts); ?>"
               title="<?php esc_attr_e('Watch Expert Page', 'masterstudy'); ?>">
				<?php $expert_image = wp_get_attachment_image_src(get_post_thumbnail_id($experts), 'img-129-129', false); ?>
				<?php if (!empty($expert_image[0])): ?>
                    <img class="img-responsive" src="<?php echo esc_url($expert_image[0]); ?>"/>
				<?php endif; ?>
                <div class="title h4"><?php echo esc_attr(get_the_title($experts)); ?></div>
				<?php if (!empty($teacher_job)): ?>
                    <label class="job"><?php echo esc_attr($teacher_job); ?></label>
				<?php endif; ?>
            </a>
            <div class="expert_socials">
                <div class="clearfix heading_font">
					<?php foreach ($origin_socials as $social): ?>
						<?php $current_social = get_post_custom_values($social, $experts); ?>
						<?php if (!empty($current_social[0])): ?>
                            <a class="expert-social-<?php echo esc_attr($social); ?>" href="<?php echo esc_url($current_social[0]); ?>"
                               title="<?php printf(esc_attr__('View expert on %s', 'masterstudy'), $social); ?>">
                                <i class="fab fa-<?php echo esc_attr(str_replace('youtube-play', 'youtube', $social)); ?>"></i>
                            </a>
						<?php endif; ?>
					<?php endforeach; ?>
                </div>
            </div>
            <div class="clearfix"></div>
			<?php if (!empty($teacher_post->post_excerpt)): ?>
                <div class="content">
					<?php echo esc_attr($teacher_post->post_excerpt); ?>
                </div>
			<?php endif; ?>
        </div>
        <div class="multiseparator"></div>
		<?php wp_reset_postdata(); ?>
        <!-- Teacher END-->
	<?php } ?>

	<?php
	$rating_enabled = get_option('woocommerce_enable_reviews');
	$comments_open = comments_open();

	if ($rating_enabled == 'yes' and $comments_open):
		$product = wc_get_product(get_the_id());
		$rating_count = $product->get_rating_count();
		$average = $product->get_average_rating();
		$average = round($average, 1); ?>

        <!-- Reviews -->
        <h3 class="woo_reviews_title"><?php _e('Reviews', 'masterstudy'); ?></h3>
        <div class="clearfix">
            <!-- Reviews Average ratings -->
            <div class="average_rating">
                <p class="rating_sub_title"><?php _e('Average Rating', 'masterstudy'); ?></p>
                <div class="average_rating_unit heading_font">
                    <div class="average_rating_value"><?php echo esc_attr($average); ?></div>
                    <div class="average-rating-stars">
						<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                    </div>
                    <div class="average_rating_num">
						<?php echo esc_attr($rating_count . ' ' . __('Ratings', 'masterstudy')); ?>
                    </div>
                </div>
            </div>
            <!-- Reviews Average ratings END -->

            <!-- Review detailed Rating -->
			<?php
			$comments = get_approved_comments(get_the_ID());

			$rate1 = $rate2 = $rate3 = $rate4 = $rate5 = 0;
			// The Comment Loop
			if ($comments) {
				foreach ($comments as $comment) {
					$rate = get_comment_meta($comment->comment_ID, 'rating', true);
					switch ($rate) {
						case 1:
							$rate1++;
							break;
						case 2:
							$rate2++;
							break;
						case 3:
							$rate3++;
							break;
						case 4:
							$rate4++;
							break;
						case 5:
							$rate5++;
							break;
					} // switch
				}
			}
			$rates = array('5' => $rate5, '4' => $rate4, '3' => $rate3, '2' => $rate2, '1' => $rate1);
			?>
            <div class="detailed_rating">
                <p class="rating_sub_title"><?php _e('Detailed Rating', 'masterstudy'); ?></p>
                <table class="detail_rating_unit">
					<?php foreach ($rates as $key => $rate): ?>
						<?php
						if ($rate != 0 or $rating_count != 0) {
							$fill_value = round($rate * 100 / $rating_count, 2);
						} else {
							$fill_value = 0;
						}
						?>
                        <tr class="stars_<?php echo esc_attr($key); ?>">
                            <td class="key"><?php echo esc_attr(__('Stars', 'masterstudy') . ' ' . $key); ?></td>
                            <td class="bar">
                                <div class="full_bar">
                                    <div class="bar_filler" style="width:<?php echo esc_attr($fill_value); ?>%"></div>
                                </div>
                            </td>
                            <td class="value"><?php echo esc_attr($rate); ?></td>
                        </tr>
					<?php endforeach; ?>
                </table>
            </div>
            <!-- Review detailed Rating END -->
        </div> <!-- clearfix -->
        <div class="multiseparator"></div>


        <?php comments_template(); ?>

	<?php endif; ?>

    <!-- Reviews END -->

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action('woocommerce_after_single_product'); ?>
<?php endif; ?>