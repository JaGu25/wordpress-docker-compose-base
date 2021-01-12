<?php
/**
 * @var $css_class
 */

$job = get_post_meta(get_the_id(), 'expert_sphere', true);
$origin_socials = array(
	'facebook',
	'linkedin',
	'twitter',
	'google-plus',
	'youtube-play',
);

stm_module_styles('teacher_detail');
?>

<div class="stm_teacher_single_featured_image">
	<?php if(has_post_thumbnail()): ?>
		<div class="display_inline_block">
			<?php the_post_thumbnail('img-840-400', array('class'=>'img-responsive')); ?>
			<div class="stm_teacher_single_socials text-center">
				<div class="display_inline_block">
					<?php foreach($origin_socials as $social): ?>
						<?php $current_social = get_post_custom_values($social, get_the_id()); ?>
						<?php if(!empty($current_social[0])): ?>
							<a class="expert-social-<?php echo esc_attr($social); ?>" href="<?php echo esc_url($current_social[0]); ?>" title="<?php printf(esc_attr__('View expert on %s', 'masterstudy'), $social); ?>">
								<i class="fab fa-<?php echo esc_attr(str_replace('youtube-play', 'youtube', $social)); ?>"></i>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
