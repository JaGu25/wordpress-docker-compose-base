<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php do_action('masterstudy_head_start'); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <?php do_action('masterstudy_head_end'); ?>
</head>
<body <?php body_class(); ?> ontouchstart="">

<?php wp_body_open(); ?>

    <?php get_template_part('partials/headers/main'); ?>

    <?php do_action('masterstudy_header_end'); ?>