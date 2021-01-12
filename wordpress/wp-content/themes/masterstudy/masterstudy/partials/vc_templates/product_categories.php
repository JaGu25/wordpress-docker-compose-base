<?php
/**
 * @var $title
 * @var $view_type
 * @var $number
 * @var $per_row
 * @var $box_text_color
 * @var $text_align
 * @var $icon_size
 * @var $auto
 * @var $icon_height
 * @var $css
 * @var $css_class
 */

$new_styles = array('stm_vc_product_cat_card');

if (in_array($view_type, $new_styles)) {
	stm_load_vc_element('product_categories', $atts, $view_type);
} else {

	$carousel_num = rand(0, 9999);

//per row
	$cols_per_row = 12 / $per_row;
	$counter = 0;

// Building terms args
	$taxonomy = array(
		'product_cat',
	);

	$args = array(
		'hide_empty' => true,
		'number'     => $number,
	);

	$terms = get_terms($taxonomy, $args);

	stm_module_styles('product_categories');
	stm_module_scripts('product_categories_height');

	if ($view_type == 'stm_vc_product_cat_carousel') {
		wp_enqueue_script('owl.carousel');
		wp_enqueue_style('owl.carousel');
		stm_module_scripts('product_categories');
	}
	?>

	<?php if (!empty($terms)): ?>

        <div class="product_categories_main_wrapper">
			<?php if ($view_type == 'stm_vc_product_cat_list'): ?>
            <div class="row">
				<?php endif; ?>

				<?php if ($view_type == 'stm_vc_product_cat_carousel'): ?>
                <div class="simple_carousel_with_bullets">
                    <div class="simple_carousel_bullets_init_<?php echo esc_attr($carousel_num); ?> clearfix simple_carousel_init"
                         data-items="<?php echo esc_attr($per_row); ?>">
						<?php endif; ?>

						<?php foreach ($terms as $term): $counter++; ?>

							<?php $term_meta = get_option("taxonomy_" . $term->term_id);

							//Get bg color
							if (!empty($term_meta['custom_term_meta'])) {
								$item_clr = $term_meta['custom_term_meta'];
							} else {
								$item_clr = '#eab830';
							}

							// Get thumbnail
							$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
							if ($thumbnail_id) {
								$cat_image = wp_get_attachment_image_src($thumbnail_id, 'img-122-120');
							} else {
								$cat_image = false;
							}
							?>

                            <div class="single-course-col <?php if ($view_type != 'stm_vc_product_cat_carousel') { ?> col-md-<?php echo esc_attr($cols_per_row) ?> col-sm-4 col-xs-12 <?php }; ?>">
                                <a href="<?php echo esc_attr(get_term_link($term)); ?>"
                                   title="<?php esc_attr_e('View course', 'masterstudy') ?>">
                                    <div class="<?php if ($view_type != 'stm_vc_product_cat_carousel') { ?>stm-no-animation<?php }; ?> project_cat_single_item <?php echo esc_attr($css_class); ?> text-<?php echo esc_attr($text_align); ?>"
                                         style="background-color:<?php echo esc_attr($item_clr); ?>; color: <?php echo esc_attr($box_text_color); ?>">
										<?php if (!empty($term_meta['custom_term_font']) and !$cat_image): ?>
                                            <i class="fa <?php echo esc_attr($term_meta['custom_term_font']); ?>"
                                               style="font-size:<?php echo esc_attr($icon_size) ?>px; height:<?php echo esc_attr($icon_height); ?>px;"></i>
										<?php else: ?>
                                            <div class="cat_image_uploaded"
                                                 style="height:<?php echo esc_attr($icon_height); ?>px;">
												<?php if (!empty($cat_image[0])): ?>
                                                    <img src="<?php echo esc_url($cat_image[0]); ?>"
                                                         style="height:<?php echo esc_attr($icon_size) ?>px;"
                                                         alt="<?php esc_attr_e('Category image', 'masterstudy'); ?>"/>
												<?php endif; ?>
                                            </div>
										<?php endif; ?>
                                        <div class="course_title_wrapper">
                                            <div class="course_category_title h5"
                                                 style="color: <?php echo esc_attr($box_text_color); ?>"><?php echo esc_attr($term->name); ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
						<?php endforeach; ?>

						<?php if ($view_type == 'stm_vc_product_cat_carousel'): ?>
                    </div> <!-- simple_carousel_bullets_init -->
                </div><!-- simple_carousel_with_bullets -->
			<?php endif; ?>

				<?php if ($view_type == 'stm_vc_product_cat_list'): ?>
            </div> <!-- row -->
		<?php endif; ?>
        </div>

	<?php endif;
} ?>
