<?php

add_action('vc_after_init', 'stm_image_box_vc');

function stm_image_box_vc()
{
	vc_map(array(
		'name'   => esc_html__('STM Image box', 'masterstudy'),
		'base'   => 'stm_image_box',
		'icon'   => 'stm_image_box',
		'description' => esc_html__('Image box', 'masterstudy'),
		'category' =>array(
			esc_html__('Content', 'masterstudy'),
		),
		'params' => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Style', 'masterstudy' ),
				'param_name' => 'style',
				'value'      => array(
					'Style 1' => 'style_1',
					'Style 2' => 'style_2',
					'Style 3' => 'style_3',
				),
				'std' => 'style_1'
			),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'masterstudy' ),
                'param_name' => 'align',
                'std' => 'left',
                'value'      => array(
                    'Left' => 'left',
                    'Right' => 'right',
                    'Center' => 'center',
                )
            ),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'masterstudy' ),
				'param_name' => 'image'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'masterstudy' ),
				'param_name' => 'title',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'masterstudy' ),
				'param_name' => 'image_size',
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Content', 'masterstudy' ),
				'param_name' => 'textarea',
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Button', 'masterstudy' ),
				'param_name' => 'button',
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'masterstudy' ),
				'param_name' => 'icon',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'style_3' )
				),
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Icon Background Color', 'masterstudy' ),
				'param_name' => 'icon_bg',
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'style_3' )
				),
			),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__('Css', 'masterstudy'),
				'param_name' => 'css',
				'group'      => esc_html__('Design options', 'masterstudy')
			)
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Image_Box extends WPBakeryShortCode
	{
	}
}