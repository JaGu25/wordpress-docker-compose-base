<?php

add_action('vc_after_init', 'stm_buddypress_instructors');

function stm_buddypress_instructors()
{
    vc_map(array(
        'name' => esc_html__('STM BuddyPress instructors', 'masterstudy'),
        'base' => 'stm_buddypress_instructors',
        'icon' => 'stm_buddypress_instructors',
        'description' => esc_html__('BuddyPress instructors', 'masterstudy'),
        'category' => array(
            esc_html__('Content', 'masterstudy'),
        ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'masterstudy'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Subtitle', 'masterstudy'),
                'param_name' => 'subtitle'
            ),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Buddypress_Instructors extends WPBakeryShortCode
    {
    }
}