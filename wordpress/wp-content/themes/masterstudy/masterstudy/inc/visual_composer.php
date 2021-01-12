<?php

add_action( 'init', 'stm_vc_set_as_theme' );

function stm_vc_set_as_theme() {
	vc_set_as_theme();
}

if( function_exists( 'vc_set_default_editor_post_types' ) ){
	vc_set_default_editor_post_types( array( 'page', 'post', 'service', 'project', 'sidebar', 'events', 'product', 'teachers', 'stm-courses' ) );
}

if ( is_admin() ) {
	if ( ! function_exists( 'stm_vc_remove_teaser_metabox' ) ) {
		function stm_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}
		add_action( 'do_meta_boxes', 'stm_vc_remove_teaser_metabox' );
	}
}

add_action( 'admin_init', 'stm_update_existing_shortcodes' );

function stm_update_existing_shortcodes(){

	if ( function_exists( 'vc_add_params' ) ) {

		$vc_column_params = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Stretch column', 'masterstudy'),
				'param_name' => 'stretch',
				'value'      => array(
					esc_html__('Default', 'masterstudy')                  => '',
					esc_html__('Stretch out to the left', 'masterstudy')  => 'left',
					esc_html__('Stretch out to the right', 'masterstudy') => 'right',
				),
				'std'        => '',
				'weight'     => 2
			),
		);

		vc_add_params('vc_column', $vc_column_params);

		vc_add_params( 'vc_gallery', array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Gallery type', 'masterstudy' ),
				'param_name' => 'type',
				'value'    => array(
					__( 'Image grid', 'masterstudy' ) => 'image_grid',
					__( 'Slick slider', 'masterstudy' ) => 'slick_slider',
					__( 'Slick slider 2', 'masterstudy' ) => 'slick_slider_2'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Thumbnail size', 'masterstudy' ),
				'param_name' => 'thumbnail_size',
				'dependency' => array(
					'element' => 'type',
					'value' => array( 'slick_slider_2' )
				),
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		));

		vc_add_params( 'vc_column_inner', array(
			array(
				'type' => 'column_offset',
				'heading' => __( 'Responsiveness', 'masterstudy' ),
				'param_name' => 'offset',
				'group' => __( 'Width & Responsiveness', 'masterstudy' ),
				'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'masterstudy' )
			)
		));

		vc_add_params( 'vc_separator', array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Type', 'masterstudy' ),
				'param_name' => 'type',
				'value'    => array(
					__( 'Type 1', 'masterstudy' ) => 'type_1',
					__( 'Type 2', 'masterstudy' ) => 'type_2'
				)
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			),
		) );

		vc_add_params( 'vc_video', array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Iframe Link', 'masterstudy' ),
				'param_name' => 'link'
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Preview Image', 'masterstudy' ),
				'param_name' => 'image'
			),
		) );

		vc_add_params( 'vc_wp_pages', array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		) );

		vc_add_params( 'vc_row', array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Background position', 'masterstudy' ),
				'param_name' => 'bg_pos',
				'description' => __('Enter background-position in CSS like format', 'masterstudy')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Remove Background on mobile', 'masterstudy' ),
				'param_name' => 'bg_mobile',
				'value'    => array(
					__( 'No', 'masterstudy' ) => 'no',
					__( 'Yes', 'masterstudy' ) => 'yes'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'MasterStudy Animations', 'masterstudy' ),
				'param_name' => 'ms_animations',
				'value'    => array(
					__( 'None', 'masterstudy' ) => '',
					__( 'Flying Students', 'masterstudy' ) => 'flying_students',
				),
				'default' => '',
				'group'      => __( 'Design Options', 'masterstudy' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Animation position on Desktop', 'masterstudy' ),
				'param_name' => 'ms_animation_position',
				'group'      => __( 'Design Options', 'masterstudy' ),
				'dependency' => array(
					'element' => 'ms_animations',
					'value' => array( 'flying_students' )
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Animation position on Laptop', 'masterstudy' ),
				'param_name' => 'ms_animation_position_laptop',
				'group'      => __( 'Design Options', 'masterstudy' ),
				'dependency' => array(
					'element' => 'ms_animations',
					'value' => array( 'flying_students' )
				),
			),
		) );

		vc_add_params( 'vc_empty_space', array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Laptop Height', 'masterstudy' ),
				'param_name' => 'laptop_height',
				'description' => __('Enter empty space height (Note: CSS measurement units allowed).', 'masterstudy')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Tablet Height', 'masterstudy' ),
				'param_name' => 'tablet_height',
				'description' => __('Enter empty space height (Note: CSS measurement units allowed).', 'masterstudy')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Mobile Height', 'masterstudy' ),
				'param_name' => 'mobile_height',
				'description' => __('Enter empty space height (Note: CSS measurement units allowed).', 'masterstudy')
			),
		) );

		vc_add_params( 'vc_btn', array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'masterstudy' ),
				'description' => __( 'Select button display style.', 'masterstudy' ),
				'param_name' => 'style',
				// partly compatible with btn2, need to be converted shape+style from btn2 and btn1
				'value' => array(
					__( 'Modern', 'masterstudy' ) => 'modern',
					__( 'Classic', 'masterstudy' ) => 'classic',
					__( 'Flat', 'masterstudy' ) => 'flat',
					__( 'Outline', 'masterstudy' ) => 'outline',
					__( '3d', 'masterstudy' ) => '3d',
					__( 'Custom', 'masterstudy' ) => 'custom',
					__( 'Outline custom', 'masterstudy' ) => 'outline-custom',
					__( 'Gradient', 'masterstudy' ) => 'gradient',
					__( 'Gradient Custom', 'masterstudy' ) => 'gradient-custom',
					__( 'Theme Button', 'masterstudy' ) => 'theme-button',
				),
			),
		) );

		vc_add_params( 'vc_basic_grid', array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Gap', 'masterstudy' ),
				'param_name' => 'gap',
				'value' => array(
					__( '0px', 'masterstudy' ) => '0',
					__( '1px', 'masterstudy' ) => '1',
					__( '2px', 'masterstudy' ) => '2',
					__( '3px', 'masterstudy' ) => '3',
					__( '4px', 'masterstudy' ) => '4',
					__( '5px', 'masterstudy' ) => '5',
					__( '10px', 'masterstudy' ) => '10',
					__( '15px', 'masterstudy' ) => '15',
					__( '20px', 'masterstudy' ) => '20',
					__( '25px', 'masterstudy' ) => '25',
					__( '30px', 'masterstudy' ) => '30',
					__( '35px', 'masterstudy' ) => '35',
					__( '40px', 'masterstudy' ) => '40',
					__( '45px', 'masterstudy' ) => '45',
					__( '50px', 'masterstudy' ) => '50',
					__( '55px', 'masterstudy' ) => '55',
					__( '60px', 'masterstudy' ) => '60',
				),
				'std' => '30',
				'description' => __( 'Select gap between grid elements.', 'masterstudy' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			)
		) );

	}

	if( function_exists( 'vc_remove_param' ) ){
		vc_remove_param( 'vc_cta_button2', 'h2' );
		vc_remove_param( 'vc_cta_button2', 'content' );
		vc_remove_param( 'vc_cta_button2', 'btn_style' );
		vc_remove_param( 'vc_cta_button2', 'color' );
		vc_remove_param( 'vc_cta_button2', 'size' );
		vc_remove_param( 'vc_cta_button2', 'css_animation' );
	}

    if( function_exists( 'vc_remove_element' ) ){
        vc_remove_element( "vc_cta_button" );
        vc_remove_element( "vc_posts_slider" );
        vc_remove_element( "vc_icon" );
        vc_remove_element( "vc_pinterest" );
        vc_remove_element( "vc_googleplus" );
        vc_remove_element( "vc_facebook" );
        vc_remove_element( "vc_tweetmeme" );
    }

}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'vc_after_init', 'vc_stm_elements' );
}

function vc_stm_elements(){
	$order_by_values = array(
		'',
		__( 'Date', 'masterstudy' ) => 'date',
		__( 'ID', 'masterstudy' ) => 'ID',
		__( 'Author', 'masterstudy' ) => 'author',
		__( 'Title', 'masterstudy' ) => 'title',
		__( 'Modified', 'masterstudy' ) => 'modified',
		__( 'Random', 'masterstudy' ) => 'rand',
		__( 'Comment count', 'masterstudy' ) => 'comment_count',
		__( 'Menu order', 'masterstudy' ) => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'masterstudy' ) => 'DESC',
		__( 'Ascending', 'masterstudy' ) => 'ASC',
	);
	vc_map( array(
		'name'        => __( 'STM Teachers', 'masterstudy' ),
		'base'        => 'stm_experts',
		'icon'        => 'stm_experts',
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Section title', 'masterstudy' ),
				'param_name' => 'experts_title',
				'description' => __( "Title will be shown on the top of section", 'masterstudy' )
			),
			array(
				'type' => 'number_field',
				'holder' => 'div',
				'heading' => __( 'Number of Teachers to output', 'masterstudy' ),
				'param_name' => 'experts_max_num',
				'description' => __( "Fill field with number only", 'masterstudy' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Style', 'masterstudy' ),
				'param_name' => 'experts_output_style',
				'value'      => array(
					'Carousel' => 'experts_carousel',
					'List' => 'experts_list'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'All teachers', 'masterstudy' ),
				'param_name' => 'experts_all',
				'value'      => array(
					'Show link to all Teachers' => 'yes',
					'Hide link to all Teachers' => 'no'
				)
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Number of Teachers per row', 'masterstudy' ),
				'param_name' => 'expert_slides_per_row',
				'std' => 2,
				'value'      => array(
					'1' => 1,
					'2' => 2,
				)
			),
		)
	) );
	
	vc_map( array(
		'name'        => __( 'STM Teacher Details', 'masterstudy' ),
		'base'        => 'stm_teacher_detail',
		'icon'        => 'stm_teacher_detail',
		'category'    => __( 'STM', 'masterstudy' ),
		'description' => __('Only on expert page', 'masterstudy'),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	
	vc_map( array(
		'name'        => __( 'STM Testimonials', 'masterstudy' ),
		'base'        => 'stm_testimonials',
		'icon'        => 'stm_testimonials',
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Section title', 'masterstudy' ),
				'param_name' => 'testimonials_title',
				'description' => __( "Title will be shown on the top of section", 'masterstudy' )
			),
			array(
				'type' => 'number_field',
				'heading' => __( 'Number of testimonials to output', 'masterstudy' ),
				'param_name' => 'testimonials_max_num',
				'description' => __( "Fill field with number only", 'masterstudy' )
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Text Color', 'masterstudy' ),
				'param_name' => 'testimonials_text_color',
				'value' => '#aaaaaa',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Style', 'masterstudy' ),
				'param_name' => 'style',
				'std' => 'style_1',
				'value'      => array(
					'Style 1' => 'style_1',
					'Style 2' => 'style_2',
					'Style 3' => 'style_3',
					'Style 4' => 'style_4',
					'Style 5' => 'style_5',
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of testimonials per row', 'masterstudy' ),
				'param_name' => 'testimonials_slides_per_row',
				'std' => 2,
				'value'      => array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				)
			),
		)
	) );
	
	// Get post types to offer
	$post_list_data = array(
		'Post'	=> 'post',
		'Experts' => 'teachers',
		'Testimonials' => 'testimonial'
	);
	
	vc_map( array(
		'name'        => __( 'STM Post List', 'masterstudy' ),
		'base'        => 'stm_post_list',
		'icon'        => 'stm_post_list',
		'params'      => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Post Data', 'masterstudy' ),
				'param_name' => 'post_list_data_source',
				'description' => __( "Choose post type", 'masterstudy' ),
				'value' => $post_list_data,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Number of items to output', 'masterstudy' ),
				'param_name' => 'post_list_per_page',
				'description' => __( "Fill field with number only", 'masterstudy' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of items to output per row', 'masterstudy' ),
				'param_name' => 'post_list_per_row',
				'value' => array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'6' => 6,
				),
				'std' => 3,
				'group' => __('List design', 'masterstudy'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show post date', 'masterstudy' ),
				'param_name' => 'post_list_show_date',
				'group' => __('Item design', 'masterstudy'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show post categories', 'masterstudy' ),
				'param_name' => 'post_list_show_cats',
				'group' => __('Item design', 'masterstudy'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show post tags', 'masterstudy' ),
				'param_name' => 'post_list_show_tags',
				'group' => __('Item design', 'masterstudy'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show comments tags', 'masterstudy' ),
				'param_name' => 'post_list_show_comments',
				'group' => __('Item design', 'masterstudy'),
			),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Custom color', 'masterstudy' ),
                'param_name' => 'custom_color',
                'group' => __('Item design', 'masterstudy'),
            ),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Icon Box', 'masterstudy' ),
		'base'        => 'stm_icon_box',
		'icon'        => 'stm_icon_box',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'masterstudy' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'masterstudy' ),
				'param_name' => 'link'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Holder', 'masterstudy' ),
				'param_name' => 'title_holder',
				'value' => array(
					'H1' => 'h1',
					'H2' => 'h2',
					'H3' => 'h3',
					'H4' => 'h4',
					'H5' => 'h5',
				),
				'std' => 'h3'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Hover position', 'masterstudy' ),
				'param_name' => 'hover_pos',
				'value' => array(
					esc_html__('None', 'masterstudy') => 'none',
					esc_html__('Top', 'masterstudy') => 'top',
					esc_html__('Right', 'masterstudy') => 'right',
					esc_html__('Left', 'masterstudy') => 'left',
					esc_html__('Bottom', 'masterstudy') => 'bottom',
				),
				'std' => 'h3'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Box background color', 'masterstudy' ),
				'param_name' => 'box_bg_color',
				'description' => 'default - green'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Box text color', 'masterstudy' ),
				'param_name' => 'box_text_color',
				'description' => 'Default - white'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Box icon color', 'masterstudy' ),
				'param_name' => 'box_icon_bg_color',
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Link color style', 'masterstudy' ),
				'param_name' 		=> 'link_color_style',
				'value'				=> array(
					'Standart' => 'standart',
					'Dark'  => 'dark',
				),
				'description'       => __( 'Enter icon size in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'masterstudy' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Icon Size', 'masterstudy' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '60',
				'description'       => __( 'Enter icon size in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Icon Align', 'masterstudy' ),
				'param_name' 		=> 'icon_align',
				'value'				=> array(
					'Center' => 'center',
					'Left'  => 'left',
					'Right' => 'right'
				),
				'description'       => __( 'Enter icon size in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Icon Height', 'masterstudy' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '65',
				'dependency' => array(
					'element' => 'icon_align',
					'value' => array( 'center' )
				),
				'description'       => __( 'Enter icon height in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Icon Width', 'masterstudy' ),
				'param_name' 		=> 'icon_width',
				'value'				=> '65',
				'dependency' => array(
					'element' => 'icon_align',
					'value' => array( 'left', 'right' )
				),
				'description'       => __( 'Enter icon height in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Icon Color', 'masterstudy' ),
				'param_name' 		=> 'icon_color',
				'value' 			=> '#fff',
				'description'		=> 'Default - White'
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Text', 'masterstudy' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Icon Css', 'masterstudy' ),
				'param_name' => 'css_icon',
				'group'      => __( 'Icon Design options', 'masterstudy' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Stats Counter', 'masterstudy' ),
		'base'        => 'stm_stats_counter',
		'icon'        => 'stm_stats_counter',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'masterstudy' ),
				'param_name' => 'title'
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Counter Value', 'masterstudy' ),
				'param_name' 		=> 'counter_value',
				'value'				=> '1000'
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Duration', 'masterstudy' ),
				'param_name' 		=> 'duration',
				'value'				=> '2.5'
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'masterstudy' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Size', 'masterstudy' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '65',
				'description'       => __( 'Enter icon size in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Height', 'masterstudy' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '90',
				'description'       => __( 'Enter icon height in px', 'masterstudy' )
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Text alignment', 'masterstudy' ),
				'param_name' 		=> 'icon_text_alignment',
				'value' => array(
					'Center' => 'center',
					'Left' => 'left',
					'Right' => 'right',
				),
				'description'       => __( 'Text alignment in block', 'masterstudy' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Text color', 'masterstudy' ),
				'param_name' 		=> 'icon_text_color',
				'description'       => __( 'Text color(white - default)', 'masterstudy' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Text font size (px)', 'masterstudy' ),
				'param_name' 		=> 'text_font_size',
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Counter text color', 'masterstudy' ),
				'param_name' 		=> 'counter_text_color',
				'description'       => __( 'Counter Text color(yellow - default)', 'masterstudy' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Counter text font size (px)', 'masterstudy' ),
				'param_name' 		=> 'counter_text_font_size',
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Include Border', 'masterstudy' ),
				'param_name' 		=> 'border',
				'value' => array(
					'None' => 'none',
					'Right' => 'right',
				),
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Icon Button', 'masterstudy' ),
		'base'        => 'stm_icon_button',
		'icon'        => 'stm_icon_button',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'masterstudy' ),
				'param_name' => 'link'
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Link tooltip (title)', 'masterstudy' ),
				'param_name' 		=> 'link_tooltip',
				'value'				=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Button alignment', 'masterstudy' ),
				'param_name' 		=> 'btn_align',
				'value' 			=> array(
					'Left' => 'left',
					'Center' => 'center',
					'Right' => 'right'
				),
				'std' => 'left',
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Button Size', 'masterstudy' ),
				'param_name' 		=> 'btn_size',
				'value' 			=> array(
					'Normal' => 'btn-normal-size',
					'Small' => 'btn-sm',
				),
				'std' => 'left',
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Text Color', 'masterstudy' ),
				'param_name' 		=> 'button_color',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Text Color Hover', 'masterstudy' ),
				'param_name' 		=> 'button_text_color_hover',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Background Color', 'masterstudy' ),
				'param_name' 		=> 'button_bg_color',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Background Color Hover', 'masterstudy' ),
				'param_name' 		=> 'button_bg_color_hover',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Border Color', 'masterstudy' ),
				'param_name' 		=> 'button_border_color',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Border Color Hover', 'masterstudy' ),
				'param_name' 		=> 'button_border_color_hover',
				'value'				=> ''
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'masterstudy' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type'	 			=> 'dropdown',
				'heading'			=> 'Icon Size',
				'param_name'		=> 'icon_size',
				'value' => array(
					__( '10px', 'masterstudy' ) => '10',
					__( '11px', 'masterstudy' ) => '11',
					__( '12px', 'masterstudy' ) => '12',
					__( '13px', 'masterstudy' ) => '13',
					__( '14px', 'masterstudy' ) => '14',
					__( '15px', 'masterstudy' ) => '15',
					__( '16px', 'masterstudy' ) => '16',
					__( '17px', 'masterstudy' ) => '17',
					__( '18px', 'masterstudy' ) => '18',
					__( '19px', 'masterstudy' ) => '19',
					__( '20px', 'masterstudy' ) => '20',
				),
				'std' => '16',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Colored Separator', 'masterstudy' ),
		'base'        => 'stm_color_separator',
		'icon'        => 'stm_color_separator',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Separator Color', 'masterstudy' ),
				'param_name' => 'color'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) )  ) {
		vc_map( array(
			'name'        => __( 'Product Categories', 'masterstudy' ),
			'base'        => 'stm_product_categories',
			'icon'        => 'stm_product_categories',
			'category'    => __( 'STM', 'masterstudy' ),
			'params'      => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'View type', 'masterstudy' ),
					'param_name' => 'view_type',
					'value' => array(
						'Carousel' => 'stm_vc_product_cat_carousel',
						'List' => 'stm_vc_product_cat_list',
						'Card' => 'stm_vc_product_cat_card',
					),
					'std' => 'stm_vc_product_cat_carousel'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Carousel Auto Scroll', 'masterstudy' ),
					'param_name' => 'auto',
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Number of items to output', 'masterstudy' ),
					'param_name' => 'number',
					'description' => 'Leave field empty to display all categories',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Number of items per row', 'masterstudy' ),
					'param_name' => 'per_row',
					'value' => array(
						'6' => 6,
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1
					),
					'std' => 6
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Box text Color', 'masterstudy' ),
					'param_name' => 'box_text_color',
					'group' => 'Item Options'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Text box Align', 'masterstudy' ),
					'param_name' => 'text_align',
					'value' => array(
						'Center' => 'center',
						'Left' => 'left',
						'Right' => 'right',
					),
					'group' => 'Item Options'
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Icon size', 'masterstudy' ),
					'param_name' => 'icon_size',
					'group' => 'Item Options',
					'value' => '60',
					'description' => 'If category has font icon chosen - size will be applied',
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Icon height', 'masterstudy' ),
					'param_name' => 'icon_height',
					'group' => 'Item Options',
					'value' => '69',
					'description' => 'If category has font icon chosen - height will be applied',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'masterstudy' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'masterstudy' )
				)
			)
		) );
		
		
		$experts = array(
		    'Choose expert for course' => 'no_expert',
	    );
		
		$experts_args = array(
			'post_type'		=> 'teachers',
			'post_status' => 'publish',
			'posts_per_page'=> -1,
		);
		
		$experts_query = new WP_Query($experts_args);
		
		foreach($experts_query->posts as $expert){
			$experts[$expert->post_title] = $expert->ID;
		};
		
		$stm_product_categories = array();
		
		$all_product_categories = get_terms('product_cat', array('hide_empty'=>true));

		if(!empty($all_product_categories)){
			foreach($all_product_categories as $category) {
				$stm_product_categories[html_entity_decode($category->name)] = $category->slug;
			}
		}

		// STM product tags		// ALP adds filter by tag

		$stm_product_tags = array();

		$all_product_tags = get_terms('product_tag', array('hide_empty'=>true));

		if(!empty($all_product_tags)){
			foreach($all_product_tags as $tag) {
				$stm_product_tags[html_entity_decode($tag->name)] = $tag->slug;
			}
		}

		vc_map( array(
			'name'        => __( 'Products List (All, featured, teacher courses)', 'masterstudy' ),
			'base'        => 'stm_featured_products',
			'icon'        => 'stm_color_separator',
			'category'    => __( 'STM', 'masterstudy' ),
			'params'      => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Meta sorting key', 'masterstudy' ),
					'param_name' => 'meta_key',
					'value' => array(
						'All' => 'all',
						'Featured' => '_featured',
						'Expert' => 'expert',
						'Category' => 'category',
						'Tag' => 'tag',
					),
					'std' => 'all'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose expert', 'masterstudy' ),
					'param_name' => 'expert_id',
					'value' => $experts,
					'std' => 'no_expert',
					'dependency' => array(
						'element' => 'meta_key',
						'value' => array( 'expert' )
					),
				),
				// Tag  Sorting // ALP filters by tag
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose tag', 'masterstudy' ),
					'param_name' => 'product_tag_id',
					'value' => $stm_product_tags,
					'std' => 'no_tag',
					'dependency' => array(
						'element' => 'meta_key',
						'value' => array( 'tag' )
					),
				),
				// Category Sorting
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose category', 'masterstudy' ),
					'param_name' => 'category_id',
					'value' => $stm_product_categories,
					'std' => 'no_category',
					'dependency' => array(
						'element' => 'meta_key',
						'value' => array( 'category' )
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'View type', 'masterstudy' ),
					'param_name' => 'view_type',
					'value' => array(
						'Carousel' => 'featured_products_carousel',
						'List' => 'featured_products_list',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Carousel Auto Scroll', 'masterstudy' ),
					'param_name' => 'auto',
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Number of items to output', 'masterstudy' ),
					'param_name' => 'per_page',
					'description' => __( 'Leave empty to display all', 'masterstudy' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Number of items per row', 'masterstudy' ),
					'param_name' => 'per_row',
					'value' => array(
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1
					),
					'std' => 4
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order', 'masterstudy' ),
					'param_name' => 'order',
					'value' => array(
						'Descending' => 'DESC',
						'Ascending' => 'ASC',
					),
					'std' => 'DESC'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'masterstudy' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'std' => 'date'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Don\'t Show price', 'masterstudy' ),
					'param_name' => 'hide_price',
					'group' => 'Item Options'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Don\'t Show rating', 'masterstudy' ),
					'param_name' => 'hide_rating',
					'group' => 'Item Options'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Don\'t Show comments number', 'masterstudy' ),
					'param_name' => 'hide_comments',
					'group' => 'Item Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Price Badge background color', 'masterstudy' ),
					'param_name' => 'price_bg',
					'group' => 'Item Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Price Badge (Free) background color', 'masterstudy' ),
					'param_name' => 'free_price_bg',
					'group' => 'Item Options'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'masterstudy' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'masterstudy' )
				)
			)
		) );
	}
	
	vc_map( array(
		'name'        => __( 'Mailchimp', 'masterstudy' ),
		'base'        => 'stm_mailchimp',
		'icon'        => 'stm_mailchimp',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'masterstudy' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Title color', 'masterstudy' ),
				'param_name' => 'title_color',
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Button color', 'masterstudy' ),
				'param_name' => 'button_color',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Countdown', 'masterstudy' ),
		'base'        => 'stm_countdown',
		'icon'        => 'stm_countdown',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'stm_datepicker_vc',
				'heading' => __( 'Count to date', 'masterstudy' ),
				'param_name' => 'datepicker',
				'holder' => 'div'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Labels color', 'masterstudy' ),
				'param_name' => 'label_color',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );

	$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
	$available_cf7 = array();
	if( $cf7Forms = get_posts( $args ) and is_admin()){
		foreach($cf7Forms as $cf7Form){
			$available_cf7[$cf7Form->post_title] = $cf7Form->ID;
		};
	} else {
		$available_cf7['No CF7 forms found'] = 'none';
	};
	vc_map( array(
		'name'        => __( 'Sign Up Now', 'masterstudy' ),
		'base'        => 'stm_sign_up_now',
		'icon'        => 'icon-wpb-contactform7',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'masterstudy' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Choose form', 'masterstudy' ),
				'param_name' => 'form',
				'value' => $available_cf7,
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post info', 'masterstudy' ),
		'base'        => 'stm_post_info',
		'icon'        => 'stm_post_info',
		'description' => __('Only on post page', 'masterstudy'),
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post tags', 'masterstudy' ),
		'base'        => 'stm_post_tags',
		'icon'        => 'stm_post_tags',
		'category'    => __( 'STM', 'masterstudy' ),
		'description' => __('Only on post page', 'masterstudy'),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Share', 'masterstudy' ),
		'base'        => 'stm_share',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'masterstudy' ),
				'param_name' => 'title',
				'value'      => __( 'Share:', 'masterstudy' )
			),
			array(
				'type'       => 'textarea_raw_html',
				'heading'    => __( 'Code', 'masterstudy' ),
				'param_name' => 'code',
				'value'      => "<span class='st_facebook_large' displayText=''></span>
<span class='st_twitter_large' displayText=''></span>
<span class='st_googleplus_large' displayText=''></span>"
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Multiply separator', 'masterstudy' ),
		'base'        => 'stm_multy_separator',
		'icon'        => 'stm_multy_separator',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post author', 'masterstudy' ),
		'base'        => 'stm_post_author',
		'icon'        => 'stm_post_author',
		'description' => __('Only on post page', 'masterstudy'),
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post comments', 'masterstudy' ),
		'base'        => 'stm_post_comments',
		'icon'        => 'stm_post_comments',
		'description' => __('Only on post page', 'masterstudy'),
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Animation Block', 'masterstudy' ),
		'base'        => 'stm_animation_block',
		"is_container" => true,
		"content_element" => true,
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Select Animation type', 'masterstudy' ),
				'param_name' => 'type',
				'value' => array(
					'Fade' => 'fade',
					'Fade Up' => 'fade-up',
					'Fade Down' => 'fade-down',
					'Fade Left' => 'fade-left',
					'Fade Right' => 'fade-right',
					'Fade Up Right' => 'fade-up-right',
					'Fade Up Left' => 'fade-up-left',
					'Fade Down Right' => 'fade-down-right',
					'Fade Down Left' => 'fade-down-left',
					'Flip Up' => 'flip-up',
					'Flip Down' => 'flip-down',
					'Flip Left' => 'flip-left',
					'Flip Right' => 'flip-right',
					'Slide Up' => 'slide-up',
					'Slide Down' => 'slide-down',
					'Slide Left' => 'slide-left',
					'Slide Right' => 'slide-right'
				),
				'std' => 'fade',
				'holder' => 'div',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Duration (ms)', 'masterstudy' ),
				'param_name' => 'duration',
				'std' => 300
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Delay (ms)', 'masterstudy' ),
				'param_name' => 'delay',
				'std' => 0
			),
		),
		'js_view' => 'VcColumnView'
	) );
	
	vc_map( array(
		'name'        => __( 'Course Lessons', 'masterstudy' ),
		'base'        => 'stm_course_lessons',
		'as_parent'   => array('only' => 'stm_course_lesson'),
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Section Title', 'masterstudy' ),
				'param_name' => 'title',
				'holder'	=> 'div'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'masterstudy' )
			)
		),
		'js_view' => 'VcColumnView'
	) );
	
	vc_map( array(
		'name'        => __( 'Lesson', 'masterstudy' ),
		'base'        => 'stm_course_lesson',
		'as_child' => array('only' => 'stm_course_lessons'),
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Lesson title', 'masterstudy' ),
				'param_name' => 'title',
				'holder'	=> 'div'
			),
			array(
				'type'	 => 'checkbox',
				'heading' => __('Private', 'masterstudy'),
				'param_name' => 'private_lesson',
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'masterstudy' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type'	=> 'textarea_html',
				'param_name' => 'content',
				'holder'	=> 'div',
				'group'	=> 'Tab Text'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Lesson badge', 'masterstudy' ),
				'param_name' => 'badge',
				'value' => array(
					'Choose Badge'	=> 'no_badge',
					'Test'		=> 'test',
					'Video'		=> 'video',
					'Exam'		=> 'exam',
					'Quiz'		=> 'quiz',
					'Lecture'   => 'lecture',
					'Seminar'	=> 'seminar',
					'Free'		=> 'free',
					'Practice'  => 'practice',
					'Exercise'  => 'exercise',
					'Activity'  => 'activity',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Preview video', 'masterstudy' ),
				'description' => __('This video will be opened in popup by clicking "Preview" button (just insert link to the video)', 'masterstudy'),
				'param_name' => 'preview_video',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Private lesson content placeholder', 'masterstudy' ),
				'description' => __('You can change standart placeholder to your custom text', 'masterstudy'),
				'param_name' => 'private_placeholder',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Lesson meta', 'masterstudy' ),
				'param_name' => 'meta',
				'holder'	=> 'div',
				'group' => 'Lesson meta',
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Lesson Icon', 'masterstudy' ),
				'param_name' => 'meta_icon',
				'group' => 'Lesson meta',
			),
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Pricing Plan', 'masterstudy' ),
		'base'        => 'stm_pricing_plan',
		'icon'        => 'stm_pricing_plan',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Plan title', 'masterstudy' ),
				'param_name' => 'title',
				'holder'	=> 'div'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Plan Color', 'masterstudy' ),
				'param_name' => 'color',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Plan price', 'masterstudy' ),
				'param_name' => 'price',
				'holder'	=> 'div'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Plan payment period', 'masterstudy' ),
				'param_name' => 'period',
				'holder'	=> 'div'
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Plan Text', 'masterstudy' ),
				'param_name' => 'content',
				'holder'	=> 'div'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Plan Button', 'masterstudy' ),
				'param_name' => 'button',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group' => __('Design Options', 'masterstudy'),
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Contact', 'masterstudy' ),
		'base'        => 'stm_contact',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Name', 'masterstudy' ),
				'param_name' => 'name'
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'masterstudy' ),
				'param_name' => 'image'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'masterstudy' ),
				'param_name' => 'image_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'masterstudy' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Job', 'masterstudy' ),
				'param_name' => 'job'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Phone', 'masterstudy' ),
				'param_name' => 'phone'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Email', 'masterstudy' ),
				'param_name' => 'email'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Skype', 'masterstudy' ),
				'param_name' => 'skype'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'masterstudy' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Gallery Grid', 'masterstudy' ),
		'base'        => 'stm_gallery_grid',
		'icon'        => 'stm_gallery_grid',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'masterstudy' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Masonry Mode', 'masterstudy' ),
				'param_name' => 'masonry'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Gallery per page', 'masterstudy' ),
				'description'    => __( 'Only numbers', 'masterstudy' ),
				'param_name' => 'per_page'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Certificate', 'masterstudy' ),
		'base'        => 'stm_certificate',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Certificate name', 'masterstudy' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Certificate Print', 'masterstudy' ),
				'param_name' => 'image'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Event info', 'masterstudy' ),
		'base'        => 'stm_event_info',
		'icon'        => 'stm_event_info',
		'description' => __('Only on event page', 'masterstudy'),
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );

	vc_map( array(
		'name'        => __( 'Teachers Grid', 'masterstudy' ),
		'base'        => 'stm_teachers_grid',
		'icon'        => 'stm_teachers_grid',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'number_field',
				'heading'    => __( 'Teacher per page', 'masterstudy' ),
				'param_name' => 'per_page',
				'default'	 => '8',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'masterstudy' ),
				'param_name' => 'image_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'masterstudy' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Show Pagination', 'masterstudy' ),
				'param_name' => 'pagination',
				'value'      => array(
					'Show'  => 'show',
					'Hide'   => 'hide'
				),
				'std' => 'show',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Events Grid', 'masterstudy' ),
		'base'        => 'stm_events_grid',
		'icon'        => 'stm_events_grid',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'number_field',
				'heading'    => __( 'Events per page', 'masterstudy' ),
				'param_name' => 'per_page',
				'default'	 => '8',
				
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css'
			)
		)
	) );
	
	$stm_sidebars_array = get_posts( array( 'post_type' => 'sidebar', 'posts_per_page' => -1 ) );
	$stm_sidebars = array( __( 'Select', 'masterstudy' ) => 0 );
	if( $stm_sidebars_array ){
		foreach( $stm_sidebars_array as $val ){
			$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
		}
	}

	vc_map( array(
		'name'        => __( 'STM Sidebar', 'masterstudy' ),
		'base'        => 'stm_sidebar',
		'category'    => __( 'STM', 'masterstudy' ),
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Code', 'masterstudy' ),
				'param_name' => 'sidebar',
				'value'      => $stm_sidebars
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Sidebar position', 'masterstudy' ),
				'param_name' => 'sidebar_position',
				'value'      => array(
					'Right'  => 'right',
					'Left'   => 'left'
				)
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'masterstudy' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'masterstudy' )
			)
		)
	) );

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Stm_Course_Lessons extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_Stm_Animation_Block extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Experts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Teacher_Detail extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_List extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Stats_Counter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Icon_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Product_Categories extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Color_Separator extends WPBakeryShortCode {
	}
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) )  ) {
			class WPBakeryShortCode_Stm_Featured_Products extends WPBakeryShortCode {
		}
	}
	class WPBakeryShortCode_Stm_Mailchimp extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Countdown extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Sign_Up_Now extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Tags extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Share extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Multy_Separator extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Author extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Course_Lesson extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Pricing_Plan extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Contact extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Gallery_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Certificate extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Event_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Teachers_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Events_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
	}
}

add_filter( 'vc_iconpicker-type-fontawesome', 'stm_construct_icons' );

function stm_construct_icons( $fonts ){


	$fonts['Master Study icons'] = array(
		array( "fa-icon-stm_icon_teacher" => __( "STM Teacher", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_category" => __( "STM Category", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_film-play" => __( "STM Film play", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_clock" => __( "STM Clock", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_bullhorn" => __( "STM Bullhorn", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_mail-o" => __( "STM Mail-o", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_phone-o" => __( "STM Phone-o", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_pin-o" => __( "STM Pin-o", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_skype-o" => __( "STM Skype-o", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_book" => __( "STM Book", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_alarm" => __( "STM Alarm", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_briefcase" => __( "STM Briefcase", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_diamond" => __( "STM Diamond", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_earth" => __( "STM Earth", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_graduation-hat" => __( "STM Graduation Hat", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_license" => __( "STM License", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_users" => __( "STM Users", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_brain" => __( "STM Brain", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_handshake" => __( "STM Handshake", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_net" => __( "STM Net", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_linkedin" => __( "STM LinkedIn", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_pin" => __( "STM Pin", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_market_research" => __( "STM Market Researches", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_medal_one" => __( "STM Champion Medal", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_mountain_biking" => __( "STM Bike Riding", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_paint_palette" => __( "STM Paint Palette", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_phone" => __( "STM Phone", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_fax" => __( "STM Fax", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_seo_monitoring" => __( "STM SEO monitoring", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_seo_performance_up" => __( "STM SEO performance up", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_user" => __( "STM User", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_guitar" => __( "STM Guitar", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_add_user" => __( "STM Add User", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_aps" => __( "STM Adope PhotoShop", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_chevron_right" => __( "STM Chevrone Right", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_chevron_left" => __( "STM Chevrone Left", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_viral_marketing" => __( "STM Viral Marketing", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_yoga" => __( "STM Yoga", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_youtube_play" => __( "STM Youtube Play", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_book_black" => __( "STM Book solid", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_book_stack" => __( "STM Book stack", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_ecommerce_cart" => __( "STM Ecommerce cart", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_certificate" => __( "STM Certificate", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_climbing" => __( "STM Mountain Climbing", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_comment_o" => __( "STM Comment solid", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_drawing_tool_circle" => __( "STM Circle Drawer", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_diploma_paper" => __( "STM Diploma Paper", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_drawing_tool_point" => __( "STM Point Drawer", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_dribble" => __( "STM Dribble", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_doc_edit" => __( "STM Document Edit", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_users_group" => __( "STM Users group", 'masterstudy' ) ),
		array( "fa-icon-stm_icon_ms_logo" => __( "STM Small logo", 'masterstudy' ) ),

		array( "rtl_demo-cert" => __( "STM Certificate", 'masterstudy' ) ),
		array( "rtl_demo-like" => __( "STM Like", 'masterstudy' ) ),
		array( "rtl_demo-miracle" => __( "STM Miracle", 'masterstudy' ) ),
		array( "rtl_demo-notebook" => __( "STM Notebook", 'masterstudy' ) ),
		array( "rtl_demo-qa" => __( "STM question answers", 'masterstudy' ) ),
		array( "rtl_demo-students" => __( "STM Students", 'masterstudy' ) ),
		array( "rtl_demo-teacher" => __( "STM Teacher", 'masterstudy' ) ),
	);

	$fonts['Linear Icons'] = array(
		array('lnr lnr-home' => 'home'),
		array('lnr lnr-apartment' => 'apartment'),
		array('lnr lnr-pencil' => 'pencil'),
		array('lnr lnr-magic-wand' => 'magic-wand'),
		array('lnr lnr-drop' => 'drop'),
		array('lnr lnr-lighter' => 'lighter'),
		array('lnr lnr-poop' => 'poop'),
		array('lnr lnr-sun' => 'sun'),
		array('lnr lnr-moon' => 'moon'),
		array('lnr lnr-cloud' => 'cloud'),
		array('lnr lnr-cloud-upload' => 'cloud-upload'),
		array('lnr lnr-cloud-download' => 'cloud-download'),
		array('lnr lnr-cloud-sync' => 'cloud-sync'),
		array('lnr lnr-cloud-check' => 'cloud-check'),
		array('lnr lnr-database' => 'database'),
		array('lnr lnr-lock' => 'lock'),
		array('lnr lnr-cog' => 'cog'),
		array('lnr lnr-trash' => 'trash'),
		array('lnr lnr-dice' => 'dice'),
		array('lnr lnr-heart' => 'heart'),
		array('lnr lnr-star' => 'star'),
		array('lnr lnr-star-half' => 'star-half'),
		array('lnr lnr-star-empty' => 'star-empty'),
		array('lnr lnr-flag' => 'flag'),
		array('lnr lnr-envelope' => 'envelope'),
		array('lnr lnr-paperclip' => 'paperclip'),
		array('lnr lnr-inbox' => 'inbox'),
		array('lnr lnr-eye' => 'eye'),
		array('lnr lnr-printer' => 'printer'),
		array('lnr lnr-file-empty' => 'file-empty'),
		array('lnr lnr-file-add' => 'file-add'),
		array('lnr lnr-enter' => 'enter'),
		array('lnr lnr-exit' => 'exit'),
		array('lnr lnr-graduation-hat' => 'graduation-hat'),
		array('lnr lnr-license' => 'license'),
		array('lnr lnr-music-note' => 'music-note'),
		array('lnr lnr-film-play' => 'film-play'),
		array('lnr lnr-camera-video' => 'camera-video'),
		array('lnr lnr-camera' => 'camera'),
		array('lnr lnr-picture' => 'picture'),
		array('lnr lnr-book' => 'book'),
		array('lnr lnr-bookmark' => 'bookmark'),
		array('lnr lnr-user' => 'user'),
		array('lnr lnr-users' => 'users'),
		array('lnr lnr-shirt' => 'shirt'),
		array('lnr lnr-store' => 'store'),
		array('lnr lnr-cart' => 'cart'),
		array('lnr lnr-tag' => 'tag'),
		array('lnr lnr-phone-handset' => 'phone-handset'),
		array('lnr lnr-phone' => 'phone'),
		array('lnr lnr-pushpin' => 'pushpin'),
		array('lnr lnr-map-marker' => 'map-marker'),
		array('lnr lnr-map' => 'map'),
		array('lnr lnr-location' => 'location'),
		array('lnr lnr-calendar-full' => 'calendar-full'),
		array('lnr lnr-keyboard' => 'keyboard'),
		array('lnr lnr-spell-check' => 'spell-check'),
		array('lnr lnr-screen' => 'screen'),
		array('lnr lnr-smartphone' => 'smartphone'),
		array('lnr lnr-tablet' => 'tablet'),
		array('lnr lnr-laptop' => 'laptop'),
		array('lnr lnr-laptop-phone' => 'laptop-phone'),
		array('lnr lnr-power-switch' => 'power-switch'),
		array('lnr lnr-bubble' => 'bubble'),
		array('lnr lnr-heart-pulse' => 'heart-pulse'),
		array('lnr lnr-construction' => 'construction'),
		array('lnr lnr-pie-chart' => 'pie-chart'),
		array('lnr lnr-chart-bars' => 'chart-bars'),
		array('lnr lnr-gift' => 'gift'),
		array('lnr lnr-diamond' => 'diamond'),
		array('lnr lnr-linearicons' => 'linearicons'),
		array('lnr lnr-dinner' => 'dinner'),
		array('lnr lnr-coffee-cup' => 'coffee-cup'),
		array('lnr lnr-leaf' => 'leaf'),
		array('lnr lnr-paw' => 'paw'),
		array('lnr lnr-rocket' => 'rocket'),
		array('lnr lnr-briefcase' => 'briefcase'),
		array('lnr lnr-bus' => 'bus'),
		array('lnr lnr-car' => 'car'),
		array('lnr lnr-train' => 'train'),
		array('lnr lnr-bicycle' => 'bicycle'),
		array('lnr lnr-wheelchair' => 'wheelchair'),
		array('lnr lnr-select' => 'select'),
		array('lnr lnr-earth' => 'earth'),
		array('lnr lnr-smile' => 'smile'),
		array('lnr lnr-sad' => 'sad'),
		array('lnr lnr-neutral' => 'neutral'),
		array('lnr lnr-mustache' => 'mustache'),
		array('lnr lnr-alarm' => 'alarm'),
		array('lnr lnr-bullhorn' => 'bullhorn'),
		array('lnr lnr-volume-high' => 'volume-high'),
		array('lnr lnr-volume-medium' => 'volume-medium'),
		array('lnr lnr-volume-low' => 'volume-low'),
		array('lnr lnr-volume' => 'volume'),
		array('lnr lnr-mic' => 'mic'),
		array('lnr lnr-hourglass' => 'hourglass'),
		array('lnr lnr-undo' => 'undo'),
		array('lnr lnr-redo' => 'redo'),
		array('lnr lnr-sync' => 'sync'),
		array('lnr lnr-history' => 'history'),
		array('lnr lnr-clock' => 'clock'),
		array('lnr lnr-download' => 'download'),
		array('lnr lnr-upload' => 'upload'),
		array('lnr lnr-enter-down' => 'enter-down'),
		array('lnr lnr-exit-up' => 'exit-up'),
		array('lnr lnr-bug' => 'bug'),
		array('lnr lnr-code' => 'code'),
		array('lnr lnr-link' => 'link'),
		array('lnr lnr-unlink' => 'unlink'),
		array('lnr lnr-thumbs-up' => 'thumbs-up'),
		array('lnr lnr-thumbs-down' => 'thumbs-down'),
		array('lnr lnr-magnifier' => 'magnifier'),
		array('lnr lnr-cross' => 'cross'),
		array('lnr lnr-menu' => 'menu'),
		array('lnr lnr-list' => 'list'),
		array('lnr lnr-chevron-up' => 'chevron-up'),
		array('lnr lnr-chevron-down' => 'chevron-down'),
		array('lnr lnr-chevron-left' => 'chevron-left'),
		array('lnr lnr-chevron-right' => 'chevron-right'),
		array('lnr lnr-arrow-up' => 'arrow-up'),
		array('lnr lnr-arrow-down' => 'arrow-down'),
		array('lnr lnr-arrow-left' => 'arrow-left'),
		array('lnr lnr-arrow-right' => 'arrow-right'),
		array('lnr lnr-move' => 'move'),
		array('lnr lnr-warning' => 'warning'),
		array('lnr lnr-question-circle' => 'question-circle'),
		array('lnr lnr-menu-circle' => 'menu-circle'),
		array('lnr lnr-checkmark-circle' => 'checkmark-circle'),
		array('lnr lnr-cross-circle' => 'cross-circle'),
		array('lnr lnr-plus-circle' => 'plus-circle'),
		array('lnr lnr-circle-minus' => 'circle-minus'),
		array('lnr lnr-arrow-up-circle' => 'arrow-up-circle'),
		array('lnr lnr-arrow-down-circle' => 'arrow-down-circle'),
		array('lnr lnr-arrow-left-circle' => 'arrow-left-circle'),
		array('lnr lnr-arrow-right-circle' => 'arrow-right-circle'),
		array('lnr lnr-chevron-up-circle' => 'chevron-up-circle'),
		array('lnr lnr-chevron-down-circle' => 'chevron-down-circle'),
		array('lnr lnr-chevron-left-circle' => 'chevron-left-circle'),
		array('lnr lnr-chevron-right-circle' => 'chevron-right-circle'),
		array('lnr lnr-crop' => 'crop'),
		array('lnr lnr-frame-expand' => 'frame-expand'),
		array('lnr lnr-frame-contract' => 'frame-contract'),
		array('lnr lnr-layers' => 'layers'),
		array('lnr lnr-funnel' => 'funnel'),
		array('lnr lnr-text-format' => 'text-format'),
		array('lnr lnr-text-format-remove' => 'text-format-remove'),
		array('lnr lnr-text-size' => 'text-size'),
		array('lnr lnr-bold' => 'bold'),
		array('lnr lnr-italic' => 'italic'),
		array('lnr lnr-underline' => 'underline'),
		array('lnr lnr-strikethrough' => 'strikethrough'),
		array('lnr lnr-highlight' => 'highlight'),
		array('lnr lnr-text-align-left' => 'text-align-left'),
		array('lnr lnr-text-align-center' => 'text-align-center'),
		array('lnr lnr-text-align-right' => 'text-align-right'),
		array('lnr lnr-text-align-justify' => 'text-align-justify'),
		array('lnr lnr-line-spacing' => 'line-spacing'),
		array('lnr lnr-indent-increase' => 'indent-increase'),
		array('lnr lnr-indent-decrease' => 'indent-decrease'),
		array('lnr lnr-pilcrow' => 'pilcrow'),
		array('lnr lnr-direction-ltr' => 'direction-ltr'),
		array('lnr lnr-direction-rtl' => 'direction-rtl'),
		array('lnr lnr-page-break' => 'page-break'),
		array('lnr lnr-sort-alpha-asc' => 'sort-alpha-asc'),
		array('lnr lnr-sort-amount-asc' => 'sort-amount-asc'),
		array('lnr lnr-hand' => 'hand'),
		array('lnr lnr-pointer-up' => 'pointer-up'),
		array('lnr lnr-pointer-right' => 'pointer-right'),
		array('lnr lnr-pointer-down' => 'pointer-down'),
		array('lnr lnr-pointer-left' => 'pointer-left'),
	);

	$fonts['Font Awesome 5'] = stm_new_fa_icons();

	if(function_exists('stm_layout_icons_loader')) {
		$add_fonts = stm_layout_icons_loader();
		$fonts = array_merge($add_fonts, $fonts);
	}

    return $fonts;
}

add_filter( 'vc_load_default_templates', 'vc_right_sidebar_template' );

function vc_right_sidebar_template( $data ) {
	$template               = array();
	$template['name']       = __( 'Content with Right sidebar', 'masterstudy' );
	$template['content']    = <<<CONTENT
        [vc_row full_width="" parallax="" parallax_image=""][vc_column width="3/4" el_class="vc_sidebar_position_right" offset="vc_col-lg-9 vc_col-md-9 vc_col-sm-12"][/vc_column][vc_column width="1/4" offset="vc_hidden-sm vc_hidden-xs"][vc_widget_sidebar sidebar_id="default" el_class="sidebar-area-right sidebar-area"][/vc_column][/vc_row]
CONTENT;

	array_unshift( $data, $template );
	return $data;
}

add_filter( 'vc_load_default_templates', 'vc_left_sidebar_template' );

function vc_left_sidebar_template( $data ) {
	$template               = array();
	$template['name']       = __( 'Content with left sidebar', 'masterstudy' );
	$template['content']    = <<<CONTENT
        [vc_row full_width="" parallax="" parallax_image=""][vc_column width="1/4" offset="vc_hidden-sm vc_hidden-xs"][vc_widget_sidebar sidebar_id="default" el_class="sidebar-area-left sidebar-area"][/vc_column][vc_column width="3/4" el_class="vc_sidebar_position_left" offset="vc_col-lg-9 vc_col-md-9 vc_col-sm-12"][/vc_column][/vc_row]
CONTENT;

	array_unshift( $data, $template );
	return $data;
}

$modules = array(
	'stm_image_box',
    'buddypress_groups',
    'buddypress_instructors',
);

foreach($modules as $module) {
	require_once $inc_path . '/vc/modules/' . $module . '.php';
}