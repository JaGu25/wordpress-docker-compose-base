<?php
/**
 * @var $name
 * @var $image
 * @var $experts_title
 * @var $experts_max_num
 * @var $experts_output_style
 * @var $expert_slides_per_row
 * @var $experts_all
 */

$args = array(
    'post_type' => 'teachers',
    'posts_per_page' => $experts_max_num
);

$current_id = get_the_ID();

if(!empty($current_id) && get_post_type($current_id) === 'teachers') {
    $args['post__not_in'] = array($current_id);
}

$experts = new WP_Query($args);

?>

<?php
/* Count slide and columns of slides */
$slide_col = 12 / $expert_slides_per_row;

wp_enqueue_script('owl.carousel');
wp_enqueue_style('owl.carousel');
stm_module_styles('experts_carousel');
stm_module_scripts('experts_carousel', 'style_1', array('owl.carousel'));
?>

<?php if ($experts->have_posts()): $count = 0; ?>
    <div class="experts_main_wrapper simple_carousel_wrapper">
        <div class="clearfix experts_control_bar_top">
			<?php if (!empty($experts_title)): ?>
                <div class="pull-left">
                    <h2 class="experts_main_title"><?php echo sanitize_text_field($experts_title); ?></h2>
                </div>
			<?php endif; ?>
            <div class="pull-right experts_control_bar">
                <div class="clearfix">
					<?php if ($experts_output_style == 'experts_carousel'): ?>
                        <div class="pull-right">
                            <a href="#" class="btn-carousel-control simple_carousel_prev"
                               title="<?php esc_attr_e('Scroll Carousel left', 'masterstudy'); ?>">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                            <a href="#" class="btn-carousel-control simple_carousel_next"
                               title="<?php esc_attr_e('Scroll Carousel right', 'masterstudy'); ?>">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
					<?php endif; ?>
					<?php if ($experts_all == 'yes'): ?>
                        <div class="pull-right btn-experts-all">
                            <a class="btn btn-primary btn-sm"
                               href="<?php echo(get_post_type_archive_link('teachers')); ?>"
                               title="<?php esc_attr_e('View all teachers', 'masterstudy'); ?>">
                                <span class="icon-stm_icon_brain"></span><?php _e('View all', 'masterstudy'); ?>
                            </a>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="<?php echo esc_attr($experts_output_style); ?>_unit">
            <div class="expert-carousel-init simple_carousel_init" data-items="<?php echo esc_attr($expert_slides_per_row); ?>">

				<?php while ($experts->have_posts()):
					$experts->the_post();
					$count++;
					$job = get_post_meta(get_the_id(), 'expert_sphere', true);

					$origin_socials = array(
						'facebook',
						'linkedin',
						'twitter',
						'google-plus',
						'youtube-play',
					);

					$certificate = get_post_meta(get_the_id(), 'expert_certified', true); ?>

                    <div class="expert-single-slide">
                        <div class="st_experts <?php echo esc_attr($experts_output_style); ?>">
                            <div class="media">
                                <div class="media-left expert-media">
									<?php if (has_post_thumbnail()): ?>
										<?php the_post_thumbnail('img-129-129', array('class' => 'img-responsive')); ?>
									<?php endif; ?>
                                    <div class="expert_socials clearfix">
										<?php foreach ($origin_socials as $social): ?>
											<?php $current_social = get_post_custom_values($social, get_the_id()); ?>
											<?php if (!empty($current_social[0])): ?>
                                                <a class="expert-social-<?php echo esc_attr($social); ?>"
                                                   href="<?php echo esc_url($current_social[0]); ?>"
                                                   title="<?php printf(esc_attr__('View expert on %s', 'masterstudy'), $social); ?>">
                                                    <i class="fab fa-<?php echo esc_attr(str_replace('youtube-play', 'youtube', $social)); ?>"></i>
                                                </a>
											<?php endif; ?>
										<?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <a class="expert_inner_title_link"
                                       href="<?php echo get_the_permalink(get_the_id()); ?>"
                                       title="<?php esc_attr_e('View teacher page', 'masterstudy'); ?>">
                                        <h3 class="expert_inner_title"><?php the_title(); ?></h3>
                                    </a>
									<?php if (!empty($job)): ?>
                                        <div class="expert_job"><?php echo sanitize_text_field($job); ?></div>
									<?php endif; ?>
                                    <hr>
                                    <div class="expert_excerpt">
										<?php the_excerpt(); ?>
                                    </div>
									<?php if (!empty($certificate)): ?>
                                        <div class="expert_certified"><?php echo _e("Certified by", 'masterstudy') . ' '; ?>
                                            <span class="orange"><?php echo wp_kses_post($certificate); ?></span>
                                        </div>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
            </div>    <!-- init carousel -->
        </div> <!-- unit -->
    </div> <!-- experts main wrapper -->
<?php endif; ?>
