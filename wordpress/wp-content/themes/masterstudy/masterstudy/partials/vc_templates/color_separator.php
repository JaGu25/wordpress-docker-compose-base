<?php
/**
 * @var $css
 * @var $color
 * @var $unique
 * @var $inline_styles
 * @var $css_class
 */

if(empty($css_class)) $css_class = 'masterstudy_color_separator_';

stm_module_styles('color_separator', 'style_1', array('stm_theme_style'), $inline_styles);

?>

<div class="stm_colored_separator<?php echo esc_attr( $css_class . ' ' . $unique ); ?>">
	<div class="triangled_colored_separator">
		<div class="triangle"></div>
	</div>
</div>
