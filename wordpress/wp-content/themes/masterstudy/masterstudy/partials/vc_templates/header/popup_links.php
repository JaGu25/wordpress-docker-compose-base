<?php
/**
 * @var $css_class
 * @var $link_1_title
 * @var $link_1_icon
 * @var $link_2_title
 * @var $link_2_icon
 */

stm_module_styles('headers', 'header_2');

?>

<div class="header_2">

    <div class="header_top">

        <div class="stm_header_links <?php echo esc_attr($css_class); ?>">

            <?php get_template_part('partials/headers/parts/links',
                null,
                compact('link_1_title', 'link_1_icon', 'link_2_title', 'link_2_icon')); ?>

        </div>

    </div>

</div>