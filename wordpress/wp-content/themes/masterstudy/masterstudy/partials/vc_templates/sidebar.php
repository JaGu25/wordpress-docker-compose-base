<?php
/**
 * @var $css
 * @var $sidebar
 * @var $sidebar_position
 * @var $css_class
 * @var $is_elementor
 */

$post_sidebar = get_post( $sidebar );
if( empty( $post_sidebar ) || $sidebar == '0' ){
	return;
};

if(empty($is_elementor)) $is_elementor = false;

if(!$is_elementor): ?>

<style type="text/css">
	<?php echo get_post_meta( $sidebar, '_wpb_shortcodes_custom_css', true ); ?>
</style>

<div class="sidebar-area sidebar-area-<?php echo esc_attr($sidebar_position); ?> <?php echo esc_attr( $css_class ); ?>">
	<?php echo apply_filters( 'the_content' , $post_sidebar->post_content); ?>
</div>

<?php else: ?>

	<div class="sidebar-area sidebar-area-<?php echo esc_attr($sidebar_position); ?> <?php echo esc_attr( $css_class ); ?>">

		<?php

		echo \Elementor\Plugin::$instance->frontend->get_builder_content($sidebar);

		?>

	</div>

<?php endif;