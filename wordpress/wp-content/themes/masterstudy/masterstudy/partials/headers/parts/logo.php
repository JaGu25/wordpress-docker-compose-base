<?php
$page_id = get_the_ID();
if( is_search() ){
	$page_id = get_option( 'page_for_posts' );
}

$layout = stm_lms_get_layout();

$transparent_header = get_post_meta($page_id, 'transparent_header', true);
if($transparent_header) {
	$logo = stm_option( 'logo_transparent', false, 'url' );
	$logo_black = stm_option( 'logo', false, 'url' );
} else {
	$logo = stm_option( 'logo', false, 'url' );
	if($layout === 'course_hub') $logo = stm_option( 'logo_transparent', false, 'url' );
};

if($logo): ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img class="img-responsive logo_transparent_static visible" src="<?php echo esc_url($logo); ?>" style="width: <?php echo stm_option( 'logo_width', '246' ); ?>px;" alt="<?php bloginfo( 'name' ); ?>"/>
		<?php if($transparent_header): ?>
			<img class="img-responsive logo_colored_fixed hidden" src="<?php echo esc_url($logo_black); ?>" style="width: <?php echo stm_option( 'logo_width', '246' ); ?>px;" alt="<?php bloginfo( 'name' ); ?>"/>
		<?php endif; ?>
	</a>
<?php else: ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="logo"><?php bloginfo( 'name' ); ?></span></a>
<?php endif; ?>