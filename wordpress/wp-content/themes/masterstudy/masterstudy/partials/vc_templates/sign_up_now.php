<?php
/**
 * @var $title
 * @var $form
 * @var $css
 * @var $css_class
 */

stm_module_styles('sign_up_now');
?>

<div class="stm_sign_up_now <?php echo esc_attr($css_class); ?>">
    <div class="stm_sign_up_now_inner">
        <?php if ($title): ?>
            <h2><?php echo esc_attr($title); ?></h2>
        <?php endif; ?>
        <?php if ($form != '' and $form != 'none'): ?>
            <?php $cf7 = get_post($form); ?>

            <?php if (!empty($cf7)): ?>
                <div class="stm_sign_up_form">
                    <?php echo(do_shortcode('[contact-form-7 id="' . $cf7->ID . '" title="' . ($cf7->post_title) . '"]')); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div> <!-- stm_subscribe -->
