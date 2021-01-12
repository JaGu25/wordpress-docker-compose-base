<?php
/**
 * @var $css_class
 */
?>

<?php if ( comments_open() || get_comments_number() ) { ?>
	<div class="stm_post_comments <?php echo esc_attr($css_class); ?>">
		<?php comments_template(); ?>
	</div>
<?php } ?>
