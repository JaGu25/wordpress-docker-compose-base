<?php
/**
 * @var $per_page
 * @var $pagination
 * @var $image_size
 * @var $css
 * @var $css_class
 */

$paged = get_query_var('paged', 1);

$teachers = new WP_Query(
	array(
		'post_type'      => 'teachers',
		'posts_per_page' => $per_page,
		'paged'          => $paged
	)
);

$image_size = (!empty($image_size)) ? $image_size : 'img-270-180';


stm_module_styles('teachers_grid');
?>

<?php if ($teachers->have_posts()): ?>
    <div class="row">
		<?php while ($teachers->have_posts()): $teachers->the_post(); ?>
			<?php
			$origin_socials = array(
				'facebook',
				'linkedin',
				'twitter',
				'google-plus',
				'youtube-play',
			); ?>
			<?php $job = get_post_meta(get_the_id(), 'expert_sphere', true); ?>
            <div class="col-md-3 col-sm-4 col-xs-6 teacher-col">
                <div class="teacher_content">

					<?php if (has_post_thumbnail()): ?>
                        <div class="teacher_img">
                            <a href="<?php the_permalink(); ?>"
                               title="<?php _e('Watch teacher page', 'masterstudy'); ?>">
                                <?php echo stm_get_VC_attachment_img_safe(get_post_thumbnail_id(), $image_size); ?>
                            </a>
                            <div class="expert_socials clearfix text-center">
                                <div class="display_inline_block">
									<?php foreach ($origin_socials as $social): ?>
										<?php $current_social = get_post_custom_values($social, get_the_id()); ?>
										<?php if (!empty($current_social[0])): ?>
                                            <a class="expert-social-<?php echo esc_attr($social); ?>"
                                               href="<?php echo esc_url($current_social[0]); ?>"
                                               title="<?php echo __('View expert on', 'masterstudy') . ' ' . $social ?>">
                                                <i class="fab fa-<?php echo esc_attr(str_replace('youtube-play', 'youtube', $social)); ?>"></i>
                                            </a>
										<?php endif; ?>
									<?php endforeach; ?>
                                </div>
                            </div>
                        </div>
					<?php endif; ?>
                    <a href="<?php the_permalink(); ?>" title="<?php _e('Watch teacher page', 'masterstudy'); ?>">
                        <h4 class="title"><?php the_title(); ?></h4>
                    </a>
					<?php if (!empty($job)): ?>
                        <div class="job heading_font"><?php echo esc_attr($job); ?></div>
					<?php endif; ?>
                    <div class="content">
						<?php the_excerpt(); ?>
                    </div>
                </div>
                <div class="multiseparator"></div>
            </div>
		<?php endwhile; ?>
    </div>

	<?php
	if ($pagination === 'show') {
		echo paginate_links(array(
			'type'      => 'list',
			'total'     => $teachers->max_num_pages,
			'prev_text' => '<i class="fa fa-chevron-left"></i><span class="pagi_label">' . __('Previous', 'masterstudy') . '</span>',
			'next_text' => '<span class="pagi_label">' . __('Next', 'masterstudy') . '</span><i class="fa fa-chevron-right"></i>',
		));
	}
	?>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
