<?php
/**
* @var $css_class
 */

stm_module_styles('headers', 'header_2');

?>

<div class="header_top_bar <?php echo esc_attr($css_class); ?>">

    <?php get_template_part('partials/headers/parts/wpml_switcher'); ?>

</div>