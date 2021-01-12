<?php
	$image_base = get_template_directory_uri() . '/partials/vc_parts/row_animations/images/';

	stm_module_styles('row_animations', 'flying_students');
	stm_module_scripts('row_animations', 'flying_students');
?>

<div class="stm_lms_row_animation">
	<img src="<?php echo esc_url($image_base) ?>base.png" />
	<img class="book1" src="<?php echo esc_url($image_base) ?>book1.png" />
	<img class="book2" src="<?php echo esc_url($image_base) ?>book2.png" />
	<img class="bubblespeech" src="<?php echo esc_url($image_base) ?>bubblespeech.png" />
	<img class="magnifier" src="<?php echo esc_url($image_base) ?>magnifier.png" />
	<img class="moon" src="<?php echo esc_url($image_base) ?>moon.png" />
</div>