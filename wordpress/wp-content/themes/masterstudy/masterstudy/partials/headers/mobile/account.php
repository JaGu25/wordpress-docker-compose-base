<?php
stm_module_styles('header_mobile', 'account');

if (function_exists('stm_lms_register_style')) {
    wp_enqueue_script('vue.js');
    wp_enqueue_script('vue-resource.js');
    enqueue_login_script();
    stm_lms_register_style('login');
    stm_lms_register_style('register');
    enqueue_register_script();
	stm_lms_register_style('enterprise');
	stm_lms_register_script('enterprise');

}

if (function_exists('stm_lms_register_style')) {
    stm_lms_register_style('become_instructor');
    stm_lms_register_script('become_instructor');
}

if (class_exists('STM_LMS_User')):
    $messages = 0;
    if (is_user_logged_in()) {
        $target = 'stm-lms-modal-become-instructor';
        $modal = 'become_instructor';
    } else {
        $target = 'stm-lms-modal-login';
        $modal = 'login';
    }
    ?>

    <div class="stm_lms_account_popup">
        <div class="stm_lms_account_popup__close">
            <i class="lnr lnr-cross"></i>
        </div>
        <div class="inner">
            <?php if (is_user_logged_in()):
                $user = STM_LMS_User::get_current_user();
                $messages = STM_LMS_Chat::user_new_messages($user['id']);
                ?>
                <div class="stm_lms_account_popup__user">
                    <?php echo html_entity_decode($user['avatar']); ?>
                    <div class="stm_lms_account_popup__user_info">
                        <h4><?php echo sanitize_text_field($user['login']); ?></h4>
                        <a href="<?php echo esc_url(STM_LMS_User::user_page_url()); ?>"
                           target="_blank">
                            <?php esc_html_e('My Profile', 'masterstudy'); ?>
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <a href="<?php echo esc_url(STM_LMS_User::login_page_url()); ?>" class="stm_lms_account_popup__login">
                    <i class="lnr lnr-user sbc"></i>
                    <h3><?php esc_html_e('Login/Sign Up', 'masterstudy'); ?></h3>
                </a>
            <?php endif; ?>

            <?php $w = STM_LMS_User::get_wishlist(get_current_user_id()); ?>

            <div class="stm_lms_account_popup__list heading_font">

                <a class="stm_lms_account_popup__list_single"
                   href="<?php echo esc_url(STM_LMS_Course::courses_page_url()) ?>">
                    <?php esc_html_e('Courses', 'masterstudy'); ?>
                </a>

                <?php if (is_user_logged_in()): ?>
                    <?php
                    if(STM_LMS_Cart::woocommerce_checkout_enabled() && function_exists('wc_get_checkout_url')){
                        $checkout_url = wc_get_checkout_url();
                    }
                    else {
                        $checkout_url = STM_LMS_Cart::checkout_url();
                    }
                    ?>
                    <a class="stm_lms_account_popup__list_single"
                       href="<?php echo esc_url($checkout_url) ?>">
                        <?php esc_html_e('Checkout', 'masterstudy'); ?>
                    </a>

                    <a class="stm_lms_account_popup__list_single has_number"
                       href="<?php echo esc_url(STM_LMS_Chat::chat_url()) ?>">
                        <?php esc_html_e('Messages', 'masterstudy'); ?>
                        <?php if (!empty($messages)): ?>
                            <span class="sbc"><?php echo intval($messages); ?></span>
                        <?php endif; ?>
                    </a>

                <?php endif; ?>

                <a class="stm_lms_account_popup__list_single has_number"
                   href="<?php echo esc_url(STM_LMS_User::wishlist_url()) ?>">
                    <?php esc_html_e('Favorites', 'masterstudy'); ?>
                    <span><?php echo intval(count($w)); ?></span>
                </a>

                <?php if (is_user_logged_in()): ?>
                    <a class="stm_lms_account_popup__list_single"
                       href="<?php echo esc_url(STM_LMS_User::user_page_url()) ?>">
                        <?php esc_html_e('Settings', 'masterstudy'); ?>
                    </a>

                    <?php if (stm_option('online_show_links', true)): ?>
                        <a class="stm_lms_account_popup__list_single"
                           data-target=".<?php echo esc_attr($target); ?>"
                           data-lms-modal="<?php echo esc_attr($modal); ?>"
                           href="#">
                            <?php esc_html_e('Become an Instructor', 'masterstudy'); ?>
                        </a>
                        <a class="stm_lms_account_popup__list_single"
                           data-target=".stm-lms-modal-enterprise"
                           data-lms-modal="enterprise"
                           href="#">
                            <?php esc_html_e('For Enterprise', 'masterstudy'); ?>
                        </a>
                    <?php endif; ?>

                <?php endif; ?>

                <?php if (is_user_logged_in()): ?>
                    <a class="stm_lms_account_popup__list_single"
                       href="<?php echo wp_logout_url('/'); ?>">
                        <?php esc_html_e('Logout', 'masterstudy'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>