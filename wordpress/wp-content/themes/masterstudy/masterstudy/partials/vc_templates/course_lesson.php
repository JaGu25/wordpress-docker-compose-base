<?php
/**
 * @var $title
 * @var $private_lesson
 * @var $icon
 * @var $content
 * @var $badge
 * @var $preview_video
 * @var $private_placeholder
 * @var $meta
 * @var $meta_icon
 * @var $css
 * @var $css_class
 */

 $icon = (!empty($icon['value'])) ? $icon['value'] : '';

$stm_tab_id = 'tab' . rand(0, 9999);
$tapableTab = '';
if (!empty($content)) {
    $tapableTab = 'tapable';
}

// Get current user and check if he bought current course
$bought_course = false;
$current_user = wp_get_current_user();
if (!empty($current_user->user_email) and !empty($current_user->ID)) {
    if(function_exists('wc_customer_bought_product')) {
        if (wc_customer_bought_product($current_user->user_email, $current_user->ID, get_the_id())) {
            $bought_course = true;
        }
    }
}

if (!empty($icon)) $icon = str_replace(
    array('fa-pencil-square-o'),
    array('fa-pencil-alt'),
    $icon
);

?>

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading_<?php echo esc_attr($stm_tab_id); ?>">
        <div class="course_meta_data">
            <div class="panel-title">
                <a class="collapsed <?php echo esc_attr($tapableTab); ?>" role="button" data-toggle="collapse"
                   href="#<?php echo esc_attr($stm_tab_id); ?>" aria-expanded="false" aria-controls="collapseOne">
                    <table class="course_table">
                        <tr>
                            <td class="number"></td>

                            <td class="icon">
                                <?php if (!empty($icon)): ?>
                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                <?php endif; ?>
                            </td>

                            <?php if (!empty($title)): ?>
                                <td class="title">

                                    <div class="course-title-holder">
                                        <strong><?php echo esc_attr($title); ?></strong>
                                        <?php if (!empty($content)): ?><i
                                                class="fa fa-sort-down"></i><?php else: ?>&nbsp;<?php endif; ?>

                                        <?php if (!empty($badge) and $badge != 'no_badge'): ?>
                                            <div class="stm_badge stm_small_badge">
                                                <div class="badge_unit heading_font <?php echo esc_attr($badge); ?>">
                                                    <?php printf(_x('%s', 'Course Badge (masterstudy Offline courses via WooCommerce)', 'masterstudy'), $badge); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </td>
                            <?php endif; ?>

                            <td class="stm_badge">
                                <?php if (!empty($preview_video)): ?>
                                    <div class="badge_unit heading_font video_course_preview"
                                         data-fancybox="<?php echo esc_attr($preview_video); ?>">
                                        <?php esc_html_e('Preview', 'masterstudy'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($private_lesson) and $private_lesson):
                                    if ($bought_course):
                                        if (!empty($meta) or !empty($meta_icon)): ?>
                                            <div class="meta">
                                                <?php if (!empty($meta_icon)): ?>
                                                    <i class="fa <?php echo esc_attr($meta_icon); ?>"></i>
                                                <?php endif;
                                                echo esc_attr($meta); ?>
                                            </div>
                                        <?php endif;
                                    else: ?>
                                        <div class="meta">
                                            <i class="fa fa-lock"></i> <?php _e('Private', 'masterstudy'); ?>
                                        </div>
                                    <?php endif;
                                else:
                                    if (!empty($meta) or !empty($meta_icon)): ?>
                                        <div class="meta">
                                            <?php if (!empty($meta_icon)): ?>
                                                <i class="fa <?php echo esc_attr($meta_icon); ?>"></i>
                                            <?php endif;
                                            echo esc_attr($meta); ?>
                                        </div>
                                    <?php endif;
                                endif; ?>

                            </td>
                        </tr>
                    </table>
                </a>
            </div>
        </div>
    </div>
    <?php if (!empty($content)): ?>
        <div id="<?php echo esc_attr($stm_tab_id); ?>" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading_<?php echo esc_attr($stm_tab_id); ?>">
            <div class="panel-body">
                <div class="course-panel-body">
                    <?php
                        // Check for private content only on course page
                        if (!empty($private_lesson) and $private_lesson) {
                            if ($bought_course) {
                                echo stm_echo_safe_output($content);
                            } else {
                                // placeholder
                                if (!empty($private_placeholder)) {
                                    echo stm_echo_safe_output($private_placeholder);
                                } else {
                                    esc_html_e('The content of this lesson is locked. To unlock it, you need to Buy this Course.', 'masterstudy');
                                }
                            }
                        } else {
                            echo stm_echo_safe_output($content);
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
