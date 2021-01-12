<?php
/**
 * @var $style
 * @var $title
 * @var $content
 * @var $css_class
 */

$accordeon_id = rand(0,9999);
stm_module_styles('course_lessons');
?>

<?php if(!empty($title)): ?>
	<h4 class="course_title"><?php echo esc_attr($title); ?></h4>
<?php endif; ?>

<?php if(function_exists('wpb_js_remove_wpautop') && !empty($content)): ?>

	<?php if( !empty( $content ) ){ ?>
		<div class="course_lessons_section">
			<div class="panel-group" id="accordion_<?php echo esc_attr($accordeon_id); ?>" role="tablist" aria-multiselectable="true">
				<?php echo (function_exists('wpb_js_remove_wpautop')) ? wpb_js_remove_wpautop($content) : $content; ?>
			</div>
		</div>
	<?php } ?>

<?php else: ?>

	<?php if( !empty( $lessons ) ){ ?>
		<div class="course_lessons_section">
			<div class="panel-group" id="accordion_<?php echo esc_attr($accordeon_id); ?>" role="tablist" aria-multiselectable="true">
				<?php
					// masterstudy_show_template('course_lesson', $lessons);
					foreach ($lessons as $key => $lesson) {
						extract($lesson);
						include(masterstudy_locate_template('course_lesson'));
					}
				?>
			</div>
		</div>
	<?php } ?>

<?php endif; ?>
