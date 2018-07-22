<?php

if ( ! function_exists( 'aalto_edge_map_general_meta' ) ) {
	function aalto_edge_map_general_meta() {
		
		$general_meta_box = aalto_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'aalto_edge_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'aalto' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'aalto' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'aalto' ),
				'parent'      => $general_meta_box
			)
		);

		aalto_edge_add_meta_box_field(
			array(
				'name' => 'edgtf_page_scroll_to_content_meta',
				'type' => 'select',
				'label' => esc_html__('One-Scroll To Page Content', 'aalto'),
				'description' => esc_html__('Enable this option will allow for direct scroll to content on down scroll.', 'aalto'),
				'options' => array(
					'no' => esc_html__('No','aalto'),
					'yes' => esc_html__('Yes','aalto')
				),
				'parent' => $general_meta_box
			)
		);

		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'aalto' ),
				'parent'        => $general_meta_box
			)
		);
		
		$edgtf_content_padding_group = aalto_edge_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'aalto' ),
				'description' => esc_html__( 'Define styles for Content area', 'aalto' ),
				'parent'      => $general_meta_box
			)
		);
		
			$edgtf_content_padding_row = aalto_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row',
					'next'   => true,
					'parent' => $edgtf_content_padding_group
				)
			);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'   => 'edgtf_page_content_top_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Top Padding', 'aalto' ),
						'parent' => $edgtf_content_padding_row,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'    => 'edgtf_page_content_top_padding_mobile',
						'type'    => 'selectsimple',
						'label'   => esc_html__( 'Set this top padding for mobile header', 'aalto' ),
						'parent'  => $edgtf_content_padding_row,
						'options' => aalto_edge_get_yes_no_select_array( false )
					)
				);
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'aalto' ),
				'description' => esc_html__( 'Choose background color for page content', 'aalto' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'    => 'edgtf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'aalto' ),
				'parent'  => $general_meta_box,
				'options' => aalto_edge_get_yes_no_select_array(),
				'args'    => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgtf_boxed_container_meta',
						'no'  => '#edgtf_boxed_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgtf_boxed_container_meta'
					)
				)
			)
		);
		
			$boxed_container_meta = aalto_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'hidden_property' => 'edgtf_boxed_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'aalto' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'aalto' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'aalto' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'aalto' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'aalto' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'aalto' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'          => 'edgtf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => 'fixed',
						'label'         => esc_html__( 'Background Image Attachment', 'aalto' ),
						'description'   => esc_html__( 'Choose background image attachment', 'aalto' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'aalto' ),
							'fixed'  => esc_html__( 'Fixed', 'aalto' ),
							'scroll' => esc_html__( 'Scroll', 'aalto' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'aalto' ),
				'parent'        => $general_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array(),
				'args'    => array(
					'dependence'    => true,
					'hide'          => array(
						''    => '#edgtf_edgtf_paspartu_container_meta',
						'no'  => '#edgtf_edgtf_paspartu_container_meta',
						'yes' => ''
					),
					'show'          => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgtf_edgtf_paspartu_container_meta'
					)
				)
			)
		);
		
			$paspartu_container_meta = aalto_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'edgtf_paspartu_container_meta',
					'hidden_property' => 'edgtf_paspartu_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'aalto' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'aalto' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'aalto' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'aalto' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'aalto' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'aalto' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				aalto_edge_add_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'aalto' ),
						'options'       => aalto_edge_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'aalto' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'aalto' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'aalto' ),
					'edgtf-grid-1100' => esc_html__( '1100px', 'aalto' ),
					'edgtf-grid-1300' => esc_html__( '1300px', 'aalto' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'aalto' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'aalto' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'aalto' )
				)
			)
		);

        aalto_edge_add_meta_box_field(
            array(
                'name'          => 'edgtf_content_grid_lines_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Lines in Page Background', 'aalto'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines you would like to display. The lines will be placed on the page grid.', 'aalto'),
                'parent'        => $general_meta_box,
                'options'       => array(
                    "" => "",
                    "none" => esc_html__("None", 'aalto'),
                    "2" => "3 lines",
                    "3" => "4 lines",
                    "4" => "5 lines",
                    "5" => "6 lines",
                    "6" => "7 lines"
                ),
                'args'    => array(
                    'dependence' => true,
                    'hide'       => array(
                        ''    => '#edgtf_lines_container_meta',
                        'none'  => '#edgtf_lines_container_meta',
                        '2' => '',
                        '3' => '',
                        '4' => '',
                        '5' => '',
                        '6' => ''
                    ),
                    'show'       => array(
                        ''    => '',
                        'none'  => '',
                        '2' => '#edgtf_lines_container_meta',
                        '3' => '#edgtf_lines_container_meta',
                        '4' => '#edgtf_lines_container_meta',
                        '5' => '#edgtf_lines_container_meta',
                        '6' => '#edgtf_lines_container_meta'
                    )
                )
            )
        );

        $lines_container_meta = aalto_edge_add_admin_container(
            array(
                'parent'          => $general_meta_box,
                'name'            => 'lines_container_meta',
                'hidden_property' => 'edgtf_content_grid_lines_meta',
                'hidden_values'   => array(
                    '',
                    'none'
                )
            )
        );

        aalto_edge_add_meta_box_field(
            array(
                'name'          => 'edgtf_content_grid_lines_skin_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Grid Lines Skin', 'aalto' ),
                'description'   => esc_html__( 'Choose skin for background grid lines', 'aalto' ),
                'parent'        => $lines_container_meta,
                'options'       => array(
                    ''      => '',
                    'light'  => esc_html__( 'Light', 'aalto' ),
                    'dark' => esc_html__( 'Dark', 'aalto' )
                )
            )
        );
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'          => 'edgtf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'aalto' ),
				'parent'        => $general_meta_box,
				'options'       => aalto_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgtf_page_transitions_container_meta',
						'no'  => '#edgtf_page_transitions_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgtf_page_transitions_container_meta'
					)
				)
			)
		);
		
			$page_transitions_container_meta = aalto_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'page_transitions_container_meta',
					'hidden_property' => 'edgtf_smooth_page_transitions_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				aalto_edge_add_meta_box_field(
					array(
						'name'        => 'edgtf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'aalto' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'aalto' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => aalto_edge_get_yes_no_select_array(),
						'args'        => array(
							'dependence' => true,
							'hide'       => array(
								''    => '#edgtf_page_transition_preloader_container_meta',
								'no'  => '#edgtf_page_transition_preloader_container_meta',
								'yes' => ''
							),
							'show'       => array(
								''    => '',
								'no'  => '',
								'yes' => '#edgtf_page_transition_preloader_container_meta'
							)
						)
					)
				);
				
				$page_transition_preloader_container_meta = aalto_edge_add_admin_container(
					array(
						'parent'          => $page_transitions_container_meta,
						'name'            => 'page_transition_preloader_container_meta',
						'hidden_property' => 'edgtf_page_transition_preloader_meta',
						'hidden_values'   => array(
							'',
							'no'
						)
					)
				);
				
					aalto_edge_add_meta_box_field(
						array(
							'name'   => 'edgtf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'aalto' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = aalto_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'aalto' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'aalto' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = aalto_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					aalto_edge_add_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'edgtf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'aalto' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								'aalto'                 => esc_html__( 'Aalto', 'aalto' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'aalto' ),
								'pulse'                 => esc_html__( 'Pulse', 'aalto' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'aalto' ),
								'cube'                  => esc_html__( 'Cube', 'aalto' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'aalto' ),
								'stripes'               => esc_html__( 'Stripes', 'aalto' ),
								'wave'                  => esc_html__( 'Wave', 'aalto' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'aalto' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'aalto' ),
								'atom'                  => esc_html__( 'Atom', 'aalto' ),
								'clock'                 => esc_html__( 'Clock', 'aalto' ),
								'mitosis'               => esc_html__( 'Mitosis', 'aalto' ),
								'lines'                 => esc_html__( 'Lines', 'aalto' ),
								'fussion'               => esc_html__( 'Fussion', 'aalto' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'aalto' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'aalto' )
							),
							'args'          => array(
							    "dependence"             => true,
							    'show'        => array(
							        '' 			=> "",
							        'aalto'   	=> "#edgtf_aalto_loader_container_meta",
							        'square' 			=> "",
							        'pulse' 			=> "",
							        'double_pulse'		=> "",
							        'cube' 				=> "",
							        'rotating_cubes' 	=> "",
							        'stripes' 			=> "",
							        'wave' 				=> "",
							        'two_rotating_circles' 	=> "",
							        'five_rotating_circles' =>  "",
							        'atom' 					=>  "",
							        'clock' 				=>  "",
							        'mitosis' 				=>  "",
							        'lines' 				=>  "",
							        'fussion' 				=>  "",
							        'wave_circles' 			=>  "",
							        'pulse_circles' 		=>  ""
							    ),
							    'hide'        => array(
							        ""      => "#edgtf_aalto_loader_container_meta",
							        "aalto"         => "",
							        'square' => "#edgtf_aalto_loader_container_meta",
							        'pulse' => "#edgtf_aalto_loader_container_meta",
							        'double_pulse' => "#edgtf_aalto_loader_container_meta",
							        'cube' => "#edgtf_aalto_loader_container_meta",
							        'rotating_cubes' => "#edgtf_aalto_loader_container_meta",
							        'stripes' => "#edgtf_aalto_loader_container_meta",
							        'wave' => "#edgtf_aalto_loader_container_meta",
							        'two_rotating_circles' => "#edgtf_aalto_loader_container_meta",
							        'five_rotating_circles' =>  "#edgtf_aalto_loader_container_meta",
							        'atom' =>  "#edgtf_aalto_loader_container_meta",
							        'clock' =>  "#edgtf_aalto_loader_container_meta",
							        'mitosis' =>  "#edgtf_aalto_loader_container_meta",
							        'lines' =>  "#edgtf_aalto_loader_container_meta",
							        'fussion' =>  "#edgtf_aalto_loader_container_meta",
							        'wave_circles' =>  "#edgtf_aalto_loader_container_meta",
							        'pulse_circles' =>  "#edgtf_aalto_loader_container_meta"
							    )
							)
						)
					);
					
					aalto_edge_add_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'edgtf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'aalto' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);

				    $edgtf_aalto_loader_container_meta = aalto_edge_add_admin_container(
				        array(
				            'parent'          => $row_pt_spinner_animation_meta	,
				            'name'            => 'aalto_loader_container_meta',
				            'hidden_property' => 'edgtf_smooth_pt_spinner_type_meta',
				            'hidden_value'    => '',
				            'hidden_values'   =>array(
				              	'' => "",
			                    'square' => "",
			                    'pulse' => "",
			                    'double_pulse' => "",
			                    'cube' => "",
			                    'rotating_cubes' => "",
			                    'stripes' => "",
			                    'wave' => "",
			                    'two_rotating_circles' => "",
			                    'five_rotating_circles' =>  "",
			                    'atom' =>  "",
			                    'clock' =>  "",
			                    'mitosis' =>  "",
			                    'lines' =>  "",
			                    'fussion' =>  "",
			                    'wave_circles' =>  "",
			                    'pulse_circles' =>  ""
				            )
				        )
				    );

				    aalto_edge_add_meta_box_field(
				        array(
				        	'type'          => 'text',
				        	'name'          => 'edgtf_aalto_loader_title_meta',
				        	'default_value' => 'Aalto',
				        	'label'         => esc_html__('Loader Title', 'aalto'),
				        	'args' => array(
				        	    'col_width' => 2,
				        	),
				            'parent'        => $edgtf_aalto_loader_container_meta,
				        )
				    );
					
					aalto_edge_add_meta_box_field(
						array(
							'name'        => 'edgtf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'aalto' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'aalto' ),
							'options'     => aalto_edge_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		aalto_edge_add_meta_box_field(
			array(
				'name'        => 'edgtf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'aalto' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'aalto' ),
				'parent'      => $general_meta_box,
				'options'     => aalto_edge_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'aalto_edge_meta_boxes_map', 'aalto_edge_map_general_meta', 10 );
}