<?php
if (!isset($content_width)) $content_width = 1170;

add_action('after_setup_theme', 'local_theme_setup');
function local_theme_setup()
{

	add_theme_support('post-thumbnails');
	add_image_size('img-1170-500', 1170, 500, true);
	add_image_size('img-1100-450', 1100, 450, true);
	add_image_size('img-840-430', 840, 430, true);
	add_image_size('img-770-300', 770, 300, true);
	add_image_size('img-370-193', 370, 193, true);

	add_theme_support('title-tag');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	));


	if (!is_textdomain_loaded('masterstudy')) {

		$loaded = load_theme_textdomain('masterstudy', get_template_directory() . '/languages');
//		echo get_template_directory() . '/languages';
//		echo 'Theme Domain isLoaded? '; var_dump($loaded);
	}

	register_nav_menus(array(
		'primary'   => __('Top primary menu', 'masterstudy'),
		'secondary' => __('Secondary menu in the footer', 'masterstudy'),
	));
}

add_action('widgets_init', 'stm_register_sidebar_areas');

function stm_register_sidebar_areas() {
	register_sidebar(array(
		'name'          => __('Primary Sidebar', 'masterstudy'),
		'id'            => 'default',
		'description'   => __('Main sidebar that appears on the right or left.', 'masterstudy'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3>',
		'after_title'   => '</h3></div>',
	));

	register_sidebar(array(
		'name'          => __('Footer Top', 'masterstudy'),
		'id'            => 'footer_top',
		'description'   => __('Footer Top Widgets Area', 'masterstudy'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3>',
		'after_title'   => '</h3></div>',
	));

	register_sidebar(array(
		'name'          => __('Footer Bottom', 'masterstudy'),
		'id'            => 'footer_bottom',
		'description'   => __('Footer Bottom Widgets Area', 'masterstudy'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget_title"><h3>',
		'after_title'   => '</h3></div>',
	));

	if (class_exists('WooCommerce')) {
		register_sidebar(array(
			'name'          => __('Shop', 'masterstudy'),
			'id'            => 'shop',
			'description'   => __('Woocommerce pages sidebar', 'masterstudy'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget_title"><h3>',
			'after_title'   => '</h3></div>',
		));
	}
}