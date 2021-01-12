<?php
/*
	Scripts and Styles (SS)
*/
if (!is_admin()) {
	add_action('wp_enqueue_scripts', 'stm_load_theme_ss');
}

function stm_load_theme_ss()
{
	$header_style = stm_option('header_style', 'header_default');

	wp_enqueue_style('linear', get_template_directory_uri() . '/assets/linearicons/linear.css');
	wp_enqueue_style('boostrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('font-awesome-min', get_template_directory_uri() . '/assets/css/font-awesome.min.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('font-icomoon', get_template_directory_uri() . '/assets/css/icomoon.fonts.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('font-icomoon-rtl', get_template_directory_uri() . '/assets/css/rtl_demo/style.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('select2', get_template_directory_uri() . '/assets/css/select2.min.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('stm_theme_styles', get_template_directory_uri() . '/assets/css/styles.css', NULL, STM_THEME_VERSION, 'all');
	stm_module_styles('stm_layout_styles', stm_get_layout(), 'stm_theme_styles');
	wp_register_style('owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', NULL, STM_THEME_VERSION, 'all');

	if (!wp_is_mobile()) {
		wp_enqueue_style('stm_theme_styles_animation', get_template_directory_uri() . '/assets/css/animation.css', NULL, STM_THEME_VERSION, 'all');
	}

	if(is_rtl()) {
        stm_module_styles('rtl', 'rtl');
        stm_module_scripts('rtl', 'rtl');
    }

	stm_module_styles('headers', $header_style);
	stm_module_styles('headers_transparent', "{$header_style}_transparent");

    $enable_shop = stm_option( 'enable_shop', false );
    if($enable_shop) {
        stm_module_styles('stm_woo_styles', 'woocommerce');
    }

	wp_enqueue_style('stm_theme_style', get_stylesheet_uri(), null, STM_THEME_VERSION, 'all');

    $header_desktop_bg = stm_option('header_desktop_bg', '');
    if(!empty($header_desktop_bg)) {
        wp_add_inline_style('stm_theme_style', "
	    #header:not(.transparent_header) .header_default {
	        background-color : {$header_desktop_bg} !important;       
	    }");
    }

    $header_mobile_bg = stm_option('header_mobile_bg', '');
    if(!empty($header_mobile_bg)) {
        wp_add_inline_style('stm_theme_style', "@media (max-width: 992px) {
	    #header .header_default {
	        background-color : {$header_mobile_bg} !important;       
	    }
	}");
    }



	if (function_exists('stm_lms_custom_styles_url') and file_exists(stm_lms_custom_styles_url(true, true) . 'custom_styles.css')) {
		wp_enqueue_style('stm_theme_custom_styles', stm_lms_custom_styles_url(true) . 'custom_styles.css', array(), stm_lms_custom_styles_v());
	} else {
		$upload = wp_upload_dir();
		$upload_url = $upload['baseurl'];
		if(is_ssl()) $upload_url = str_replace('http://', 'https://', $upload_url);
		wp_enqueue_style('stm_theme_custom_styles', "{$upload_url}/stm_lms_styles/custom_styles.css", array(), STM_THEME_VERSION);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	/*Layout icons*/
	if(function_exists('stm_layout_icons_sets')) {
		$icons = stm_layout_icons_sets();
		foreach($icons as $icon_set) {
			wp_enqueue_style($icon_set, get_template_directory_uri() . "/assets/layout_icons/{$icon_set}/style.css", NULL, STM_THEME_VERSION, 'all');
		}
	}

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), STM_THEME_VERSION, TRUE);
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.js', array('jquery'), STM_THEME_VERSION, TRUE);
	wp_enqueue_script('select2', get_template_directory_uri() . '/assets/js/select2.full.min.js', array('jquery'), STM_THEME_VERSION, TRUE);
	wp_enqueue_script('stm_theme_scripts', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), STM_THEME_VERSION, TRUE);
	wp_enqueue_script('ajaxsubmit', get_template_directory_uri() . '/assets/js/ajax.submit.js', array('jquery'), STM_THEME_VERSION, TRUE);

	wp_register_script('owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', 'jquery', STM_THEME_VERSION, TRUE);
	wp_register_script('imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', 'jquery', STM_THEME_VERSION, TRUE);
	wp_register_script('isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', 'jquery', STM_THEME_VERSION, TRUE);
	wp_register_script('countUp.min.js', get_template_directory_uri() . '/assets/js/countUp.min.js', array('jquery'), STM_THEME_VERSION, true);
	wp_register_script('jquery.countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', 'jquery', STM_THEME_VERSION, TRUE);
	wp_register_script('vue.js', get_template_directory_uri() . '/assets/js/vue.min.js', array('jquery'), STM_THEME_VERSION);
	wp_register_script('vue-resource.js', get_template_directory_uri() . '/assets/js/vue-resource.min.js', array('vue.js'), STM_THEME_VERSION);


	/*POSTS*/
	if (is_post_type_archive(array('events'))) {
		stm_module_styles('event_grid');
	} elseif (is_post_type_archive('gallery')) {
		stm_module_styles('gallery_grid');
		wp_enqueue_script('imagesloaded');
		wp_enqueue_script('isotope');
		stm_module_scripts('gallery_grid');
	} elseif (is_post_type_archive('teachers')) {
		stm_module_styles('teachers_grid');
	} elseif (is_post_type_archive('product')) {
		stm_module_styles('featured_products');
	}

	/*AOS*/
	wp_register_script('aos.js', get_template_directory_uri() . '/assets/js/aos.js', array(), STM_THEME_VERSION);
	wp_register_style('aos.css', get_template_directory_uri() . '/assets/css/aos.css', array(), STM_THEME_VERSION);

	if(!defined('STM_POST_TYPE')) {
		wp_enqueue_style('stm_theme_styles_dynamic', get_template_directory_uri() . '/assets/css/dynamic.css');
		wp_enqueue_style('stm_theme_styles_fonts', stm_default_gfonts());
	}

	if(class_exists('bbPress')) {
	    stm_module_styles('bbpress');
    }

	if(defined('HFE_DIR')) {
        stm_module_styles('hfe');
        stm_module_scripts('hfe');
    }

}

function stm_admin_styles()
{
	wp_enqueue_style('stm_theme_admin_styles', get_template_directory_uri() . '/assets/css/admin.css', null, STM_THEME_VERSION, 'all');
	wp_enqueue_style('stm_theme_mstudy_icons', get_template_directory_uri() . '/assets/css/icomoon.fonts.css', null, STM_THEME_VERSION, 'all');
	wp_enqueue_style('stm_theme_mstudy_rtl_icons', get_template_directory_uri() . '/assets/css/rtl_demo/style.css', null, STM_THEME_VERSION, 'all');

	/*Layout icons*/
	if(function_exists('stm_layout_icons_sets')) {
		$icons = stm_layout_icons_sets();
		foreach($icons as $icon_set) {
			wp_enqueue_style($icon_set, get_template_directory_uri() . "/assets/layout_icons/{$icon_set}/style.css", NULL, STM_THEME_VERSION, 'all');
		}
	}

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', NULL, STM_THEME_VERSION, 'all');
	wp_enqueue_style('stm_theme_styles_fonts', stm_default_gfonts());
}

add_action('admin_enqueue_scripts', 'stm_admin_styles');

function stm_default_gfonts() {
	$font_url = '';

	if ( 'off' !== _x( 'on', 'Google font: on or off', 'masterstudy' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Montserrat|Open Sans:200,300,300italic,400,400italic,500,600,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
	}
	return $font_url;
}