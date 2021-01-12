<?php

global $woocommerce;

$post_id = get_the_ID();

$is_shop = false;
$is_product = false;

if (function_exists('is_shop') && (is_shop() || is_product_category())) {
	$is_shop = true;
}

if (function_exists('is_product') && is_product()) {
	$is_product = true;
}

if (is_home() || is_category() || is_search()) {
	$post_id = get_option('page_for_posts');
}

if ($is_shop) {
	$post_id = get_option('woocommerce_shop_page_id');
}

$title = '';

if (is_home()) {
	if (!get_option('page_for_posts')) {
		$title = __('News', 'masterstudy');
	}
	else {
		$title = get_the_title($post_id);
	}
}
elseif ($is_product) {
	$title = get_the_title($post_id);
}
elseif (is_post_type_archive('teachers')) {
	$title = __('Teachers', 'masterstudy');
}
elseif (is_post_type_archive('events')) {
	$title = __('Events', 'masterstudy');
}
elseif (is_category()) {
	$title = single_cat_title('', false);
}
elseif (in_array('woocommerce/woocommerce.php',
		apply_filters('active_plugins', get_option('active_plugins')))
	&& is_product_category()) {
	$title = single_cat_title('', false);
}
elseif (is_tag()) {
	$title = single_tag_title('', false);
}
elseif (is_search()) {
	$title = __('Search', 'masterstudy');
}
elseif (is_day()) {
	$title = get_the_time('d');
}
elseif (is_month()) {
	$title = get_the_time('F Y');
}
elseif (is_year()) {
	$title = get_the_time('Y');
}
elseif (is_single() && is_singular('post')) {
	if (!get_option('page_for_posts')) {
		$title = __('News & Events', 'masterstudy');
	}
	else {
		$title = get_the_title(get_option('page_for_posts'));
	}
}
else {
	$title = get_the_title($post_id);
}

if (is_tax('stm_lms_course_taxonomy')) {
	$courses_page = STM_LMS_Options::courses_page();
	if (empty($courses_page) or !is_page($courses_page)) {
		$post_id = $courses_page;
		$term = get_queried_object();
		$title = $term->name;
	}
}

$title_style = [];
$title_style_h1 = [];
$title_style_subtitle = [];
$title_box_bg_color = get_post_meta($post_id, 'title_box_bg_color', true);
$title_box_font_color = get_post_meta($post_id, 'title_box_font_color', true);
$title_box_line_color = get_post_meta($post_id, 'title_box_line_color', true);
$title_box_custom_bg_image = get_post_meta($post_id, 'title_box_custom_bg_image', true);
$title_box_bg_position = get_post_meta($post_id, 'title_box_bg_position', true);
$title_box_bg_repeat = get_post_meta($post_id, 'title_box_bg_repeat', true);
$title_box_overlay = get_post_meta($post_id, 'title_box_overlay', true);
$title_box_small = get_post_meta($post_id, 'title_box_small', true);
$sub_title = get_post_meta($post_id, 'sub_title', true);
$breadcrumbs = get_post_meta($post_id, 'breadcrumbs', true);
$breadcrumbs_font_color = get_post_meta($post_id, 'breadcrumbs_font_color', true);
$title_box_button_url = get_post_meta($post_id, 'title_box_button_url', true);
$title_box_button_text = get_post_meta($post_id, 'title_box_button_text', true);
$title_box_button_border_color = get_post_meta($post_id, 'title_box_button_border_color', true);
$title_box_button_font_color = get_post_meta($post_id, 'title_box_button_font_color', true);
$title_box_subtitle_font_color = get_post_meta($post_id, 'title_box_subtitle_font_color', true);
$title_box_button_font_color_hover =
	get_post_meta($post_id, 'title_box_button_font_color_hover', true);
$title_box_button_font_arrow_color =
	get_post_meta($post_id, 'title_box_button_font_arrow_color', true);
$prev_next_buttons = get_post_meta($post_id, 'prev_next_buttons', true);
$prev_next_buttons_border_color = get_post_meta($post_id, 'prev_next_buttons_border_color', true);
$prev_next_buttons_arrow_color_hover =
	get_post_meta($post_id, 'prev_next_buttons_arrow_color_hover', true);

if ($title_box_bg_color) {
	$title_style['bg_color'] = 'background-color: ' . $title_box_bg_color . ';';
}

if ($title_box_font_color) {
	$title_style_h1['font_color'] = 'color: ' . $title_box_font_color . ';';
}

if ($title_box_subtitle_font_color) {
	$title_style_subtitle['font_color'] = 'color: ' . $title_box_subtitle_font_color . ';';
}

if ($title_box_custom_bg_image = wp_get_attachment_image_src($title_box_custom_bg_image, 'full')) {
	$title_style['bg_image'] = 'background-image: url(' . $title_box_custom_bg_image[0] . ');';

	if ($title_box_bg_position) {
		$title_style['bg_position'] = 'background-position: ' . $title_box_bg_position . ';';
	}

	if ($title_box_bg_repeat) {
		$title_style['bg_repeat'] = 'background-repeat: ' . $title_box_bg_repeat . ';';
	}
}

?>

<?php if (get_post_type() != 'teachers' or get_post_type() != 'event' or get_post_type()
	!= 'gallery'): ?>
	<?php if (get_post_meta($post_id, 'title', true) != 'hide') { ?>
		<div class="entry-header <?php if (is_tag()): ?>tag-header <?php endif; ?>clearfix<?php if ($title_box_small
			|| $is_shop
			|| $is_product) {
			echo ' small';
		} ?>" style="<?php echo implode(' ', $title_style); ?>">
            <div class="container">
				<?php if ($title_box_overlay) {
					echo '<div class="overlay"></div>';
				} ?>
				<div class="entry-title-left">
                    <div class="entry-title">
						<?php if (is_single() && is_singular('post')) { ?>
							<h2 class="h1"
								style="<?php echo implode(' ',
									$title_style_h1); ?>"><?php echo sanitize_text_field($title); ?></h2>
						<?php } else { ?>
							<h1 style="<?php echo implode(' ',
								$title_style_h1); ?>"><?php echo sanitize_text_field($title); ?></h1>
						<?php } ?>
						<?php if ($sub_title && !is_search()) { ?>
							<div class="sub_title h3"
								 style="<?php echo implode(' ',
									 $title_style_subtitle); ?>"><?php echo sanitize_text_field($sub_title); ?></div>
						<?php } ?>
						<?php if ($title_box_line_color): ?>
							<div class="stm_colored_separator">
                                <div class="triangled_colored_separator"
									 style="background-color:<?php echo esc_attr($title_box_line_color); ?>; ">
                                    <div class="triangle"
										 style="border-bottom-color:<?php echo esc_attr($title_box_line_color); ?>;"></div>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
                <div class="entry-title-right">
					<?php if ($title_box_button_url) { ?>
						<a href="<?php echo esc_url($title_box_button_url); ?>"
						   class="button"><span><?php echo sanitize_text_field($title_box_button_text); ?></span> <i
								class="fa fa-chevron-right"></i></a>
					<?php } ?>
					<?php if ($prev_next_buttons) { ?>
						<div class="prev_next_post">
							<?php
							$taxonomy = 'category';
							if (get_post_type() == 'project') {
								$taxonomy = 'project_category';
							}
							previous_post_link('%link', '<i class="fa fa-chevron-left"></i>', true,
								'', $taxonomy);
							next_post_link('%link', '<i class="fa fa-chevron-right"></i>', true, '',
								$taxonomy);
							?>
                        </div>
					<?php } ?>
                </div>
				<?php if ($title_box_line_color || $breadcrumbs_font_color
					|| $title_box_button_border_color
					|| $title_box_button_font_color
					|| $title_box_button_font_color_hover
					|| $title_box_button_font_arrow_color
					|| $prev_next_buttons_border_color
					|| $prev_next_buttons_arrow_color_hover) { ?>
					<style type="text/css">
                        <?php if( $title_box_line_color ){ ?>
						.entry-header .entry-title h1.h2:before {
							background: <?php echo esc_attr( $title_box_line_color ); ?>;
						}

						<?php } ?>

						<?php if( $title_box_button_border_color ){ ?>
						.entry-header .entry-title-right .button {
							border: 3px solid<?php echo esc_attr( $title_box_button_border_color ); ?>;
						}

						.entry-header .entry-title-right .button:hover,
						.entry-header .entry-title-right .button:active,
						.entry-header .entry-title-right .button:focus {
							background: <?php echo esc_attr( $title_box_button_border_color ); ?>;
						}

						<?php } ?>
						<?php if( $title_box_button_font_color ){ ?>
						.entry-header .entry-title-right .button {
							color: <?php echo esc_attr( $title_box_button_font_color ); ?>;
						}

						<?php } ?>
						<?php if( $title_box_button_font_color_hover ){ ?>
						.entry-header .entry-title-right .button:hover,
						.entry-header .entry-title-right .button:active,
						.entry-header .entry-title-right .button:focus,
						.entry-header .entry-title-right .button:hover .fa,
						.entry-header .entry-title-right .button:active .fa,
						.entry-header .entry-title-right .button:focus .fa {
							color: <?php echo esc_attr( $title_box_button_font_color_hover ); ?>;
						}

						<?php } ?>
						<?php if( $title_box_button_font_arrow_color ){ ?>
						.entry-header .entry-title-right .button .fa {
							color: <?php echo esc_attr( $title_box_button_font_arrow_color ); ?>;
						}

						<?php } ?>
						<?php if( $prev_next_buttons_border_color ){ ?>
						.prev_next_post a {
							border-color: <?php echo esc_attr( $prev_next_buttons_border_color ); ?> !important;
							color: <?php echo esc_attr( $prev_next_buttons_border_color ); ?>;
						}

						.prev_next_post a:hover {
							background-color: <?php echo esc_attr( $prev_next_buttons_border_color ); ?>;
						}

						<?php } ?>
						<?php if( $prev_next_buttons_arrow_color_hover ){ ?>
						.prev_next_post a:hover {
							color: <?php echo esc_attr( $prev_next_buttons_arrow_color_hover ); ?>;
						}

						<?php } ?>
                    </style>
				<?php } ?>
            </div>
        </div>
	<?php } ?>
<?php endif; ?>

<!-- Breads -->
<?php $header_style = stm_option('header_style', 'header_default'); ?>
<?php $transparent_header = get_post_meta($post_id, 'transparent_header', true); ?>
<div class="stm_lms_breadcrumbs stm_lms_breadcrumbs__<?php echo esc_attr($header_style); ?>">

	<?php if ($breadcrumbs_font_color) { ?>
		<style>
		.breadcrumbs a, .breadcrumbs, .breadcrumbs .navxtBreads, .stm_breadcrumbs_unit .navxtBreads, .stm_breadcrumbs_unit .navxtBreads>span, .stm_breadcrumbs_unit .navxtBreads>span a {
			color: <?php echo esc_attr( $breadcrumbs_font_color ); ?>;
		}
		</style>

	<?php } ?>

	<?php if ($breadcrumbs != 'hide'): ?>
		<?php
		if ($is_shop || $is_product) {
			woocommerce_breadcrumb();
		}
		else {
			if (function_exists('bcn_display')) { ?>
				<div class="stm_breadcrumbs_unit">
                    <div class="container">
                        <div class="navxtBreads">
                            <?php bcn_display(); ?>
                        </div>
                    </div>
                </div>
			<?php } else { ?>
				<div class="breadcrumbs_holder_empty"></div>
			<?php }
		}
		?>
	<?php elseif ($transparent_header !== 'on'): ?>
		<div class="breadcrumbs_holder"></div>
	<?php endif; ?>
</div>
