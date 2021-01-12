<?php
$cols_per_row = 12 / $per_row;

$terms = get_terms('product_cat', array(
	'hide_empty' => true,
	'number'     => $number,
));

$styles = '';

?>

<?php if (!empty($terms)): ?>

    <div class="stm_vc_product_cat_card row">

		<?php foreach ($terms as $term):
            $custom_id = stm_lms_generate_uniq_id($term);
			$term_meta = get_option("taxonomy_" . $term->term_id);

			$item_clr = (!empty($term_meta['custom_term_meta'])) ? $term_meta['custom_term_meta'] : '#eab830';

			$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
			$cat_image = ($thumbnail_id) ? stm_get_VC_attachment_img_safe($thumbnail_id, 'img-370-400') : false;

			$styles .= ".{$custom_id} .stm_vc_product_cat_card_single_item {background-color: {$item_clr}}";
			$styles .= ".{$custom_id} .course_title_wrapper:after {background-color: {$item_clr}}";

			$num = _n('%s Program', '%s Programs', $term->count, 'masterstudy');
			?>

            <div class="single-course-col col-md-<?php echo esc_attr($cols_per_row . ' ' . $custom_id) ?> col-sm-6 col-xs-12">
                <a href="<?php echo esc_attr(get_term_link($term)); ?>"
                   title="<?php esc_attr_e('View course', 'masterstudy') ?>">
                    <div class="stm_vc_product_cat_card_single_item">

                        <div class="cat_image_uploaded">
							<?php if ($cat_image) echo masterstudy_lazyload_image($cat_image); ?>
                        </div>
                        <div class="course_title_wrapper">
                            <div class="course_category_title heading_font">
                                <h5><?php echo esc_attr($term->name); ?></h5>
                                <span><?php printf($num, $term->count); ?></span>
                            </div>
							<?php if (!empty($term->description)): ?>
                                <p><?php echo html_entity_decode($term->description); ?></p>
							<?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
		<?php endforeach; ?>


    </div>

<?php endif;

stm_module_styles('product_categories', 'cat_card', array(), $styles);