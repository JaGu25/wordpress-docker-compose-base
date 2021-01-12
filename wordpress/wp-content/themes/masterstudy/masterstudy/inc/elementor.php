<?php

function masterstudy_locate_template($template_name)
{
    $template_name = '/partials/vc_templates/' . $template_name . '.php';

    return locate_template($template_name);

}

function masterstudy_load_template($template_name, $vars = array())
{
    ob_start();
    extract($vars);
    $template = masterstudy_locate_template($template_name);
    if(empty($template)) return false;
    include($template);
    return apply_filters("masterstudy_template_{$template_name}", ob_get_clean(), $vars);
}

function masterstudy_show_template($template_name, $vars = array())
{
    echo masterstudy_load_template($template_name, $vars);
}

add_action('admin_init', function () {
    delete_transient('elementor_activation_redirect');
});

function masterstudy_filtered_output($output) {
    return apply_filters('masterstudy_filtered_output', $output);
}
