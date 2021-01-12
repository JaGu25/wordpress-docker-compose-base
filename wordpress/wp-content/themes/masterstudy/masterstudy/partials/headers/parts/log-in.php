<?php

/**
 * @var $args
 */

$title = esc_html__('Log in', 'masterstudy');
$icon = ['value' => 'stmlms-user'];

if(!empty($args)) extract($args);

wp_enqueue_script('vue.js');
wp_enqueue_script('vue-resource.js');

if (function_exists('stm_lms_register_style')) {
	enqueue_login_script();
	stm_lms_register_style('login');
	stm_lms_register_style('register');
	enqueue_register_script();
}
?>

<a href="#"
   class="stm_lms_log_in"
   data-text="<?php echo esc_attr($title); ?>"
   data-target=".stm-lms-modal-login"
   data-lms-modal="login">
    <i class="<?php echo esc_attr($icon['value']); ?>"></i>
    <span><?php echo sanitize_text_field($title); ?></span>
</a>