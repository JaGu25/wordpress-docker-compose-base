<?php

add_action('init', 'stm_generate_theme_styles');

function stm_generate_theme_styles() {

    if(current_user_can('manage_options')) {

        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/stm_lms_styles';
        wp_mkdir_p($upload_dir);

        stm_custom_to_styles($wp_filesystem, $upload_dir);
    }
}

function stm_custom_to_styles($wp_filesystem, $upload_dir) {
	$css = '';

	$button_borders = stm_option('button_radius', 0);
	if(!empty($button_borders)) $css .= ".btn{border-radius:{$button_borders}px;}";

	$button_dimensions = stm_option("button_dimensions", 0);
	if(!empty($button_dimensions) and is_array($button_dimensions)) {
		$css .= ".btn{";
		foreach($button_dimensions as $style => $padding) {
			if(isset($style) and $padding !== '') $css .= "{$style}:{$padding}px;";
		}
		$css .= "}";
	}

	$main_dimensions = stm_option("main_paddings", 0);
	if(!empty($main_dimensions) and is_array($main_dimensions)) {
		$css .= "#wrapper #main{";
		foreach($main_dimensions as $style => $padding) {
			if(isset($style) and $padding !== '') $css .= "{$style}:{$padding}px;";
		}
		$css .= "}";
	}

	for($i = 1;$i < 7; $i++) {
		$h_margins = stm_option("h{$i}_dimensions", 0);
		if(!empty($h_margins) and is_array($h_margins)) {
			$css .= "h{$i}{";
			foreach($h_margins as $style => $margin) {
				if(isset($style) and $margin !== '') $css .= "{$style}:{$margin}px;";
			}
			$css .= "}";
		}
	}

	if(!empty($css)) {
		$wp_filesystem->put_contents($upload_dir . '/custom_styles.css', $css, FS_CHMOD_FILE);
	}
}