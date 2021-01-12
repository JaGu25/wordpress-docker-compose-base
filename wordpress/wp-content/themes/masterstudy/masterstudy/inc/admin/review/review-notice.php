<?php

if(!function_exists('stm_ajax_add_review')) {
    function stm_ajax_add_review () {
        check_ajax_referer('stm_ajax_add_review', 'security');
        $status = $_GET['add_review_status'];
        update_option('add_review_status', $status);
    }
}

add_action('wp_ajax_stm_ajax_add_review', 'stm_ajax_add_review');
add_action('wp_ajax_nopriv_stm_ajax_add_review', 'stm_ajax_add_review');

function pearl_review_admin_notice() {
    $status = get_option('add_review_status', '');

    if(empty($status)) {
        
        $theme = stm_get_theme_info();
        $theme_name = $theme['name'];

        wp_enqueue_script('review-notice', get_template_directory_uri() . '/inc/admin/review/review-notice.js', 'jQuery', NULL, true);

        echo '
        <style>.review-message {
            border-color: #d54e21 !important;
          }
          
          .review-message p:last-child {
            margin-top: 0;
          }
          
          .review-message p.submit a.button-primary{
            background: #d54e21;
            border-color: #d54e21 #d54e21 #d61c00;
            box-shadow: 0 1px 0 #d61c00;
            color: #fff;
            text-decoration: none;
            text-shadow: 0 -1px 1px #d54e21, 1px 0 1px #d54e21, 0 1px 1px #d54e21, -1px 0 1px #d54e21;
          }</style>
          
          <div id="message" class="notice notice-info review-message">
            <p>If you are happy with the <b>' . $theme_name . '</b>, please give it a review on ThemeForest.net :)</p>
            <p class="submit">
                <a href="https://themeforest.net/downloads" class="add_review button-primary" target="_blank">Leave a Review</a>
                <a href="#" class="skip_review button-secondary">No, thank you</a>
            </p>
        </div>';
    }
}

add_action('admin_notices', 'pearl_review_admin_notice');
