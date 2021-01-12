<?php
/**
 * @var $css
 * @var $title
 * @var $subtitle
 */

if (function_exists('BuddyPress') and class_exists('STM_LMS_Instructor')):
    stm_module_styles('buddypress_instructors');
    stm_module_scripts('buddypress_instructors');

    ?>

    <div class="stm_buddypress_instructors">

        <div class="stm_buddypress_instructors__heading">
            <?php if (!empty($title)): ?>
                <h2 class="stm_buddypress_instructors__title"><?php echo sanitize_text_field($title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($subtitle)): ?>
                <div class="stm_buddypress_instructors__subtitle"><?php echo sanitize_text_field($subtitle); ?></div>
            <?php endif; ?>

        </div>

        <div class="stm_buddypress_instructors__list">
            <?php stm_get_buddypress_instructors_list(); ?>
        </div>

    </div>

<?php endif;
