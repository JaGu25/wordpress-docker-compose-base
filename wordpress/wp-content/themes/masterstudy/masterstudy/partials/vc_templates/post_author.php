<?php
/**
 * @var $css_class
 */
?>

<div class="stm_author_box clearfix<?php echo esc_attr($css_class); ?>">
    <div class="author_name">
		<h4><?php _e( 'Author:', 'masterstudy' ); ?> <?php the_author_meta('nickname'); ?></h4>
	</div>
	<div class="author_avatar">
		<?php echo get_avatar( get_the_author_meta( 'email' ), 174 ); ?>
		<div class="author_info">
			<div class="author_content"><?php echo get_the_author_meta( 'description' ); ?></div>
		</div>
	</div>
</div>
