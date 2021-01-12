<?php

/**
 * @var $args
 */

$link_1_title = esc_html__('Become an Instructor', 'masterstudy');
$link_2_title = esc_html__('For Enterprise', 'masterstudy');
$link_1_icon = array(
    'value' => 'lnr lnr-bullhorn'
);
$link_2_icon = array(
    'value' => 'stmlms-case'
);

if(!empty($args)) extract($args);

if (function_exists('stm_lms_register_style')) {
    stm_lms_register_style('enterprise');
    stm_lms_register_script('enterprise');
}

if (!empty($link_1_title)): ?>

    <?php if (is_user_logged_in()):
        $target = 'stm-lms-modal-become-instructor';
        $modal = 'become_instructor';

        if (function_exists('stm_lms_register_style')) {
            stm_lms_register_style('become_instructor');
            stm_lms_register_script('become_instructor');
        }
        ?>
        <a href="#"
           class="stm_lms_bi_link normal_font"
           data-target=".<?php echo esc_attr($target); ?>"
           data-lms-modal="<?php echo esc_attr($modal); ?>">
            <i class="<?php echo esc_attr($link_1_icon['value']) ?> secondary_color"></i>
            <span><?php echo sanitize_text_field($link_1_title); ?></span>
        </a>
    <?php else: ?>
        <?php if (class_exists('STM_LMS_User')): ?>
            <a href="<?php echo esc_url(STM_LMS_User::login_page_url()); ?>"
               class="stm_lms_bi_link normal_font">
                <i class="<?php echo esc_attr($link_1_icon['value']) ?> secondary_color"></i>
                <span><?php echo sanitize_text_field($link_1_title); ?></span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

<?php endif; ?>

<?php if (!empty($link_2_title)): ?>

    <a href="#" class="stm_lms_bi_link normal_font" data-target=".stm-lms-modal-enterprise" data-lms-modal="enterprise">
        <i class="<?php echo esc_attr($link_2_icon['value']) ?> secondary_color"></i>
        <span><?php echo sanitize_text_field($link_2_title); ?></span>
    </a>

<?php endif; ?>