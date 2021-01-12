<?php

add_action('vc_after_init', 'stm_buddypress_groups');

function stm_buddypress_groups()
{
	vc_map(array(
		'name'   => esc_html__('STM BuddyPress groups', 'masterstudy'),
		'base'   => 'stm_buddypress_groups',
		'icon'   => 'stm_buddypress_groups',
		'description' => esc_html__('BuddyPress groups', 'masterstudy'),
		'category' =>array(
			esc_html__('Content', 'masterstudy'),
		),
		'params' => array(
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'masterstudy' ),
                'param_name' => 'title'
            ),
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Buddypress_Groups extends WPBakeryShortCode
	{
	}
}