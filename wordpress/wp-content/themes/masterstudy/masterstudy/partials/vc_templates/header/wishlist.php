<?php

/**
* @var $css_class
* @var $icon
 */

stm_module_styles('headers', 'header_2');

?>

<div class="header_2">

    <div class="header_top <?php echo esc_attr($css_class); ?>">

        <?php STM_LMS_Templates::show_lms_template('global/wishlist-button', array('icon' => $icon['value'], 'class' => 'mtc_h')); ?>

    </div>

</div>