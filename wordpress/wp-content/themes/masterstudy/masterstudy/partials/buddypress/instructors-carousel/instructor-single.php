<?php
/**
 * @var $instructor_id
 * @var $value_occurrence
 */

$user = STM_LMS_User::get_current_user($instructor_id, false, true, false, 270);

$rating = STM_LMS_Instructor::my_rating_v2($user);

$user_url = $user['url'];

$posts = count_user_posts($instructor_id, 'stm-courses');

?>

<div class="stm_lms_instructors_carousel__single">

    <?php if (!empty($user['avatar'])): ?>
        <div class="stm_lms_instructors_carousel__single_avatar">
            <a href="<?php echo esc_url($user_url); ?>">
                <?php echo stm_lms_filtered_output($user['avatar']); ?>
            </a>

            <?php $socials = array('facebook', 'twitter', 'instagram', 'google-plus');
            $fields = STM_LMS_User::extra_fields();
            ?>

            <div class="stm_lms_user_info_top__socials">
                <?php foreach ($socials as $social): ?>
                    <?php if (!empty($user['meta'][$social])): ?>
                        <a href="<?php echo esc_url($user['meta'][$social]); ?>"
                           target="_blank"
                           class="<?php echo esc_attr($social); ?> stm_lms_update_field__<?php echo esc_attr($social); ?>">
                            <i class="fab fa-<?php echo esc_attr($fields[$social]['icon']) ?>"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="stm_lms_instructors_carousel__single_name_activity">

        <?php if (!empty($user['login'])): ?>
            <a href="<?php echo esc_url($user_url); ?>" class="stm_lms_instructors_carousel__single_name heading_font" alt="<?php echo esc_attr($user['login']); ?>">
                <?php echo sanitize_text_field($user['login']); ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($activity_number)): ?>
            <div class="stm_lms_instructors_carousel__single_activity">
                <?php printf(esc_html__('Courses: %s', 'masterstudy'), $posts); ?>
            </div>
        <?php endif; ?>

    </div>

    <div class="stm_lms_instructors_carousel__single_position_rate">

        <?php if (!empty($user['meta']) and !empty($user['meta']['position'])): ?>
            <div class="stm_lms_instructors_carousel__single_position">
                <?php echo sanitize_text_field($user['meta']['position']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($rating['total'])): ?>
            <div class="stm-lms-user_rating check_in_single">
                <div class="star-rating star-rating__big">
                    <span style="width: <?php echo floatval($rating['percent']); ?>%;"></span>
                </div>
                <strong class="rating heading_font"><?php echo floatval($rating['average']); ?></strong>
                <div class="stm-lms-user_rating__total">
                    <?php echo sanitize_text_field($rating['total_marks']); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>


</div>