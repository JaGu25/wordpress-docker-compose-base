<?php
$header_style = stm_option('header_style', 'header_default');
$header_cats = ($header_style == 'header_2') ? 'header_course_categories_online' : 'header_course_categories';
$cats = stm_option($header_cats, array());

if (!empty($cats)): ?>
	<?php foreach ($cats as $cat):
	$term = get_term_by('id', $cat, 'stm_lms_course_taxonomy');
	if (!empty($term)):
		$icon = get_term_meta($term->term_id, 'course_icon', true);
		$child_terms = get_terms(array(
			'hide_empty' => 'false',
			'parent'     => $cat,
			'taxonomy'   => 'stm_lms_course_taxonomy'
		)); ?>
            <div class="categories-courses-single">
                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="heading_font">
					<?php if (!empty($icon)): ?>
                        <i class="<?php echo esc_attr($icon) ?>"></i>
					<?php endif; ?>
                    <span><?php echo sanitize_text_field($term->name); ?></span>
                </a>
				<?php if (!empty($child_terms)): ?>
                    <div class="categories-courses-dropdown">
                        <ul>
							<?php foreach ($child_terms as $child):
								$icon_child = get_term_meta($child->term_id, 'course_icon', true);
								$icon_child = (!empty($icon_child)) ? $icon_child : 'lnricons-arrow-right';
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(get_term_link($child->term_id)) ?>">
                                        <i class="<?php echo esc_attr($icon_child); ?>"></i>
                                        <span><?php echo sanitize_text_field($child->name); ?></span>
                                    </a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                        <form action="<?php echo esc_url(get_term_link($term)); ?>">
                            <input name="search" class="form-control"
                                   placeholder="<?php esc_attr_e('Search Courses', 'masterstudy'); ?>"/>
                            <button type="submit">
                                <i class="lnricons-magnifier"></i>
                            </button>
                        </form>
                    </div>
				<?php endif; ?>
            </div>

	<?php endif; ?>

<?php endforeach; ?>
<?php endif;
