<?php

add_action('hfe_footer_before', 'masterstudy_before_footer');
add_action('masterstudy_before_footer', 'masterstudy_before_footer');

function masterstudy_before_footer() {
    require_once get_template_directory() . '/partials/footers/before_footer.php';
}

add_action('masterstudy_after_footer', 'masterstudy_after_footer');

function masterstudy_after_footer() {
    require_once get_template_directory() . '/partials/footers/after_footer.php';
}