<?php
/**
 * @var $css_class
 * @var $include_categories
 * @var $limit
 */

stm_module_styles('headers', 'header_2');

stm_module_styles('header_mobile', 'account');

stm_module_scripts('header_js', 'header_2');

?>

<div class="header_2 header_default">

    <div class="header_top">

        <div class="stm_courses_search <?php echo esc_attr($css_class); ?>">

            <?php if ($include_categories) get_template_part('partials/headers/parts/categories', null, compact('limit')); ?>
            <?php get_template_part('partials/headers/parts/courses-search'); ?>

        </div>

        <div class="stm_header_top_search sbc">
            <i class="lnr lnr-magnifier"></i>
        </div>

        <?php get_template_part('partials/headers/mobile/search'); ?>

    </div>

</div>