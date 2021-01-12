<?php
$header_style = stm_option('header_style', 'header_default');
$header_top_bar = stm_option('top_bar');

$page_id = get_the_ID();
if (is_search()) {
	$page_id = get_option('page_for_posts');
}

$transparent_header = get_post_meta($page_id, 'transparent_header', true);
$sticky_header = stm_option('sticky_header');
$sticky_header_color = stm_option('header_fixed_color');
if ($transparent_header) {
	$transparent_header = 'transparent_header';
} else {
	$transparent_header = 'transparent_header_off';
	$sticky_header_color = stm_option('header_color');
};

if ($sticky_header) {
	$transparent_header .= ' sticky_header';
}

?>

<div id="header" class="<?php echo esc_attr($transparent_header); ?>" data-color="<?php echo esc_attr($sticky_header_color); ?>">

	<?php if (!empty($header_top_bar) and $header_top_bar): ?>
		<?php get_template_part("partials/headers/top-bar"); ?>
	<?php endif; ?>

	<?php if ($sticky_header): ?>
        <div class="sticky_header_holder"></div>
	<?php endif; ?>

    <div class="header_default <?php echo esc_attr($header_style); ?>">
		<?php get_template_part("partials/headers/{$header_style}"); ?>
    </div>
</div> <!-- id header -->