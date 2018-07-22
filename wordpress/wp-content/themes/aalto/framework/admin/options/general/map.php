<?php

if ( ! function_exists( 'aalto_edge_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function aalto_edge_general_options_map() {
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'aalto' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = aalto_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'aalto' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'aalto' ),
				'parent'        => $panel_design_style
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'aalto' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_additional_google_fonts_container"
				)
			)
		);
		
		$additional_google_fonts_container = aalto_edge_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'hidden_property' => 'additional_google_fonts',
				'hidden_value'    => 'no'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'aalto' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'aalto' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'aalto' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'aalto' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'aalto' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'aalto' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'aalto' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'aalto' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'aalto' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'aalto' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'aalto' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'aalto' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'aalto' ),
					'100i' => esc_html__( '100 Thin Italic', 'aalto' ),
					'200'  => esc_html__( '200 Extra-Light', 'aalto' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'aalto' ),
					'300'  => esc_html__( '300 Light', 'aalto' ),
					'300i' => esc_html__( '300 Light Italic', 'aalto' ),
					'400'  => esc_html__( '400 Regular', 'aalto' ),
					'400i' => esc_html__( '400 Regular Italic', 'aalto' ),
					'500'  => esc_html__( '500 Medium', 'aalto' ),
					'500i' => esc_html__( '500 Medium Italic', 'aalto' ),
					'600'  => esc_html__( '600 Semi-Bold', 'aalto' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'aalto' ),
					'700'  => esc_html__( '700 Bold', 'aalto' ),
					'700i' => esc_html__( '700 Bold Italic', 'aalto' ),
					'800'  => esc_html__( '800 Extra-Bold', 'aalto' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'aalto' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'aalto' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'aalto' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'aalto' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'aalto' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'aalto' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'aalto' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'aalto' ),
					'greek'        => esc_html__( 'Greek', 'aalto' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'aalto' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'aalto' )
				)
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'aalto' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'aalto' ),
				'parent'      => $panel_design_style
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'aalto' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'aalto' ),
				'parent'      => $panel_design_style
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'aalto' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'aalto' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'aalto' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_boxed_container"
				)
			)
		);
		
			$boxed_container = aalto_edge_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'hidden_property' => 'boxed',
					'hidden_value'    => 'no'
				)
			);
		
				aalto_edge_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'aalto' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'aalto' ),
						'parent'      => $boxed_container
					)
				);
				
				aalto_edge_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'aalto' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'aalto' ),
						'parent'      => $boxed_container
					)
				);
				
				aalto_edge_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'aalto' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'aalto' ),
						'parent'      => $boxed_container
					)
				);
				
				aalto_edge_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'aalto' ),
						'description'   => esc_html__( 'Choose background image attachment', 'aalto' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'aalto' ),
							'fixed'  => esc_html__( 'Fixed', 'aalto' ),
							'scroll' => esc_html__( 'Scroll', 'aalto' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'aalto' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_paspartu_container"
				)
			)
		);
		
			$paspartu_container = aalto_edge_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'hidden_property' => 'paspartu',
					'hidden_value'    => 'no'
				)
			);
		
				aalto_edge_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'aalto' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'aalto' ),
						'parent'      => $paspartu_container
					)
				);
				
				aalto_edge_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'aalto' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'aalto' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				aalto_edge_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'aalto' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'aalto' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				aalto_edge_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'aalto' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'aalto' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'aalto' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'edgtf-grid-1100' => esc_html__( '1100px - default', 'aalto' ),
					'edgtf-grid-1300' => esc_html__( '1300px', 'aalto' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'aalto' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'aalto' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'aalto' )
				)
			)
		);

        aalto_edge_add_admin_field(
            array(
                'name'          => 'content_grid_lines',
                'type'          => 'select',
                'default_value' => 'none',
                'label'         => esc_html__('Grid Lines in Page Background', 'aalto'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines you would like to display. The lines will be placed on the page grid.', 'aalto'),
                'parent'        => $panel_design_style,
                'options'       => array(
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
                        'none'    => '#edgtf_lines_container',
                        '2'      => '',
                        '3'      => '',
                        '4'      => '',
                        '5'      => '',
                        '6'      => '',
                    ),
                    'show'       => array(
                        'none'    => '',
                        '2'      => '#edgtf_lines_container',
                        '3'      => '#edgtf_lines_container',
                        '4'      => '#edgtf_lines_container',
                        '5'      => '#edgtf_lines_container',
                        '6'      => '#edgtf_lines_container',
                    )
                )
            )
        );

        $lines_container = aalto_edge_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'lines_container',
                'hidden_property' => 'content_grid_lines',
                'hidden_value'    => 'none'
            )
        );

        aalto_edge_add_admin_field(
            array(
                'name'          => 'content_grid_lines_skin',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Grid Lines Skin', 'aalto' ),
                'description'   => esc_html__( 'Choose skin for background grid lines', 'aalto' ),
                'parent'        => $lines_container,
                'options'       => array(
                    'light'  => esc_html__( 'Light', 'aalto' ),
                    'dark' => esc_html__( 'Dark', 'aalto' )
                )
            )
        );

        aalto_edge_add_admin_field(
            array(
                'name'          => 'default_pattern_image',
                'type'          => 'image',
                'label'         => esc_html__( 'Default Pattern Image', 'aalto' ),
                'description'   => esc_html__( 'Choose default pattern image for your website', 'aalto' ),
                'parent'        => $panel_design_style
            )
        );
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'aalto' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'aalto' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = aalto_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'aalto' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'aalto' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'aalto' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_page_transitions_container"
				)
			)
		);
		
			$page_transitions_container = aalto_edge_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'hidden_property' => 'smooth_page_transitions',
					'hidden_value'    => 'no'
				)
			);
		
				aalto_edge_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'aalto' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'aalto' ),
						'parent'        => $page_transitions_container,
						'args'          => array(
							"dependence"             => true,
							"dependence_hide_on_yes" => "",
							"dependence_show_on_yes" => "#edgtf_page_transition_preloader_container"
						)
					)
				);
				
				$page_transition_preloader_container = aalto_edge_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'hidden_property' => 'page_transition_preloader',
						'hidden_value'    => 'no'
					)
				);
		
		
					aalto_edge_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'aalto' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = aalto_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'aalto' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'aalto' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = aalto_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					aalto_edge_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'aalto' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
								'aalto'        			=> esc_html__( 'Aalto', 'aalto' ),
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
							        "aalto"         		=> "#edgtf_aalto_loader_title_container",
							        "rotate_circles"        => "",
							        "pulse"                 => "",
							        "double_pulse"          => "",
							        "cube"                  => "",
							        "rotating_cubes"        => "",
							        "stripes"               => "",
							        "wave"                  => "",
							        "two_rotating_circles"  => "",
							        "five_rotating_circles" => "",
							        "atom"                  => "",
							        "clock"                 => "",
							        "mitosis"               => "",
							        "lines"                 => "",
							        "fussion"               => "",
							        "wave_circles"          => "",
							        "pulse_circles"         => ""
							    ),
							    'hide'        => array(
							        "aalto"         		=> "",
							        ""                      => "#edgtf_aalto_loader_title_container",
							        "rotate_circles"        => "#edgtf_aalto_loader_title_container",
							        "pulse"                 => "#edgtf_aalto_loader_title_container",
							        "double_pulse"          => "#edgtf_aalto_loader_title_container",
							        "cube"                  => "#edgtf_aalto_loader_title_container",
							        "rotating_cubes"        => "#edgtf_aalto_loader_title_container",
							        "stripes"               => "#edgtf_aalto_loader_title_container",
							        "wave"                  => "#edgtf_aalto_loader_title_container",
							        "two_rotating_circles"  => "#edgtf_aalto_loader_title_container",
							        "five_rotating_circles" => "#edgtf_aalto_loader_title_container",
							        "atom"                  => "#edgtf_aalto_loader_title_container",
							        "clock"                 => "#edgtf_aalto_loader_title_container",
							        "mitosis"               => "#edgtf_aalto_loader_title_container",
							        "lines"                 => "#edgtf_aalto_loader_title_container",
							        "fussion"               => "#edgtf_aalto_loader_title_container",
							        "wave_circles"          => "#edgtf_aalto_loader_title_container",
							        "pulse_circles"         => "#edgtf_aalto_loader_title_container"
							    )
							)
						)
					);
					
					aalto_edge_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'aalto' ),
							'parent'        => $row_pt_spinner_animation
						)
					);

					$aalto_loader_title_container = aalto_edge_add_admin_container(
					    array(
					        'name'            => 'aalto_loader_title_container',
					        'hidden_property' => 'smooth_pt_spinner_type',
					        'hidden_value'    => '',
					        'hidden_values'   =>array(
					            "",
					            "rotate_circles",
					            "pulse",
					            "double_pulse",
					            "cube",
					            "rotating_cubes",
					            "stripes",
					            "wave",
					            "two_rotating_circles",
					            "five_rotating_circles",
					            "atom",
					            "clock",
					            "mitosis",
					            "lines",
					            "fussion",
					            "wave_circles",
					            "pulse_circles"
					        ),
							'parent'        => $page_transitions_container
					    )
					);

					aalto_edge_add_admin_field(
					    array(
					        'type'          => 'text',
					        'name'          => 'aalto_loader_title',
					        'default_value' => 'Aalto',
					        'label'         => esc_html__('Loader Title', 'aalto'),
					        'args' => array(
					            'col_width' => 2,
					        ),
					        'parent'        => $aalto_loader_title_container,
					    )
					);

					
					aalto_edge_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'aalto' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'aalto' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'aalto' ),
				'parent'        => $panel_settings
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'aalto' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = aalto_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'aalto' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'aalto' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = aalto_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'aalto' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'aalto' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_general_options_map', 1 );
}

if ( ! function_exists( 'aalto_edge_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function aalto_edge_page_general_style( $style ) {
		$current_style = '';
		$page_id       = aalto_edge_get_page_id();
		$class_prefix  = aalto_edge_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = aalto_edge_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = aalto_edge_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = aalto_edge_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = aalto_edge_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.edgtf-boxed .edgtf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= aalto_edge_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_color = aalto_edge_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = aalto_edge_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( aalto_edge_string_ends_with( $paspartu_width, '%' ) || aalto_edge_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.edgtf-paspartu-enabled .edgtf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= aalto_edge_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		$paspartu_responsive_width = aalto_edge_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( aalto_edge_string_ends_with( $paspartu_responsive_width, '%' ) || aalto_edge_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . aalto_edge_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'aalto_edge_add_page_custom_style', 'aalto_edge_page_general_style' );
}