<?php
/**
 * @var $style
 * @var $title
 * @var $image
 * @var $certificate_url
 * @var $css_class
 */

stm_module_styles('certificate');

?>

<?php if(!empty($image) && !empty($certificate_url)): ?>
	<div class="certificate <?php echo esc_attr($css_class); ?>">
		<div class="certificate-frame">
			<div class="certificate-holder">
				<img class="img-responsive" src="<?php echo esc_url($certificate_url[0]); ?>" />
			</div>
		</div>
		<?php if(!empty($title)): ?>
			<div class="h4 title text-center"><?php echo esc_attr($title); ?></div>
		<?php endif; ?>
	</div>
<?php endif; ?>
