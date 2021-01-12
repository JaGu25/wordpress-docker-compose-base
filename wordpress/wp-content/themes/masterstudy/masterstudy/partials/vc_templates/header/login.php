<?php
/**
 *
 * @var $css_class
 * @var $title
 * @var $icon
 */

stm_module_styles('headers', 'header_2');

$logged_in = is_user_logged_in();

if(!empty($_GET['action']) && $_GET['action'] === 'elementor') $logged_in = false;

?>

<div class="header_2">

    <div class="header_top">

        <div class="<?php echo esc_attr($css_class); ?>">
            <?php
            if ($logged_in) {
                STM_LMS_Templates::show_lms_template('global/account-dropdown');
            } else {
                get_template_part('partials/headers/parts/log-in', null, compact('title', 'icon'));
            }
            ?>

        </div>


    </div>

</div>