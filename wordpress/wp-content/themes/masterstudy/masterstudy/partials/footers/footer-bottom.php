<?php if (is_active_sidebar('footer_bottom')) {

	$footer_enabled = stm_option('footer_bottom');
	$widget_areas = stm_option('footer_bottom_columns');
	if (!$widget_areas) {
		$widget_areas = 4;
	};
	if ($footer_enabled) {
		$footer_bottom_title_uppercase = (stm_option('footer_bottom_title_uppercase', true)) ? 'text-upper' : 'text-normal'; ?>

        <div id="footer_bottom">
            <div class="footer_widgets_wrapper kek <?php echo esc_attr($footer_bottom_title_uppercase); ?>">
                <div class="container">
                    <div class="widgets <?php echo  esc_attr("cols_{$widget_areas}"); ?> clearfix">
						<?php dynamic_sidebar('footer_bottom'); ?>
                    </div>
                </div>
            </div>
        </div>

	<?php } ?>
<?php } ?>