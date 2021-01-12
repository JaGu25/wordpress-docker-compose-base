<?php
/**
 * BuddyPress - Members Home
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * @version 3.0.0
 */


$current_user = STM_LMS_User::get_current_user('', false, true);
$tpl = 'buddypress/';
$profile = 'private';

if (STM_LMS_BuddyPress::is_bp_current_user()) {
    $tpl .= "account/{$profile}/main";
} else {
    $profile = 'public';
    $tpl .= "account/{$profile}/main";

    $currentUserID = bp_displayed_user_id();
    $current_user = STM_LMS_User::get_current_user($currentUserID, false, true);
};

stm_lms_register_style('user');


?>

<div class="stm-lms-wrapper">
    <div class="container">
        <?php STM_LMS_Templates::show_lms_template($tpl, compact('current_user')); ?>
    </div>
</div>


<div id="buddypress">

    <?php

    /**
     * Fires before the display of member home content.
     *
     * @since 1.2.0
     */
    do_action('bp_before_member_home_content'); ?>

    <div id="item-nav">
        <div class="item-list-tabs no-ajax heading_font" id="object-nav"
             aria-label="<?php esc_attr_e('Member primary navigation', 'masterstudy'); ?>" role="navigation">
            <ul>

                <?php bp_get_displayed_user_nav(); ?>

                <?php

                /**
                 * Fires after the display of member options navigation.
                 *
                 * @since 1.2.4
                 */
                do_action('bp_member_options_nav'); ?>

            </ul>
        </div>
    </div><!-- #item-nav -->

    <div id="item-body">

        <?php

        /**
         * Fires before the display of member body content.
         *
         * @since 1.2.0
         */
        do_action('bp_before_member_body');

        if (bp_is_user_front()) :

            if(STM_LMS_Instructor::is_instructor($current_user['id'])): ?>
                <div class="stm_lms_bd_student_<?php echo esc_attr($profile); ?>_profile">
                    <?php STM_LMS_Templates::show_lms_template("account/{$profile}/instructor_parts/courses", array('current_user' => $current_user)); ?>
                </div>
            <?php endif;

            if (STM_LMS_BuddyPress::is_bp_current_user()) {
                STM_LMS_Templates::show_lms_template('account/private/parts/tabs', compact('current_user'));
            }

            if(STM_LMS_BuddyPress::is_student_public_profile()): ?>
                <div class="stm_lms_bd_student_public_profile">
                    <?php bp_get_template_part('members/single/activity'); ?>
                </div>
            <?php endif;

            bp_displayed_user_front_template_part();

        elseif (bp_is_user_activity()) :
            bp_get_template_part('members/single/activity');

        elseif (bp_is_user_blogs()) :
            bp_get_template_part('members/single/blogs');

        elseif (bp_is_user_friends()) :
            bp_get_template_part('members/single/friends');

        elseif (bp_is_user_groups()) :
            bp_get_template_part('members/single/groups');

        elseif (bp_is_user_messages()) :
            bp_get_template_part('members/single/messages');

        elseif (bp_is_user_profile()) :
            //bp_get_template_part('members/single/profile');

        elseif (bp_is_user_notifications()) :
            bp_get_template_part('members/single/notifications');

        elseif (bp_is_user_settings()) :
            bp_get_template_part('members/single/settings');

        // If nothing sticks, load a generic template
        else :
            bp_get_template_part('members/single/plugins');

        endif;

        /**
         * Fires after the display of member body content.
         *
         * @since 1.2.0
         */
        do_action('bp_after_member_body'); ?>

    </div><!-- #item-body -->

    <?php

    /**
     * Fires after the display of member home content.
     *
     * @since 1.2.0
     */
    do_action('bp_after_member_home_content'); ?>

</div><!-- #buddypress -->
