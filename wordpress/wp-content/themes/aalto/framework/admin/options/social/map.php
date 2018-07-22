<?php

if ( ! function_exists( 'aalto_edge_social_options_map' ) ) {
	function aalto_edge_social_options_map() {

	    $page = '_social_page';
		
		aalto_edge_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'aalto' ),
				'icon'  => 'fa fa-share-alt'
			)
		);
		
		/**
		 * Enable Social Share
		 */
		$panel_social_share = aalto_edge_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Social Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_panel_social_networks, #edgtf_panel_show_social_share_on'
				),
				'parent'        => $panel_social_share
			)
		);
		
		$panel_show_social_share_on = aalto_edge_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'aalto' ),
				'hidden_property' => 'enable_social_share',
				'hidden_value'    => 'no'
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'no',
				'label'         => esc_html__( 'Posts', 'aalto' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'aalto' ),
				'parent'        => $panel_show_social_share_on
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'aalto' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'aalto' ),
				'parent'        => $panel_show_social_share_on
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
		do_action('aalto_edge_post_types_social_share', $panel_show_social_share_on);
		
		/**
		 * Social Share Networks
		 */
		$panel_social_networks = aalto_edge_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'aalto' ),
				'hidden_property' => 'enable_social_share',
				'hidden_value'    => 'no'
			)
		);
		
		/**
		 * Facebook
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_facebook_share_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_facebook_share_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'hidden_property' => 'enable_facebook_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_facebook_share_container
			)
		);
		
		/**
		 * Twitter
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_twitter_share_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_twitter_share_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'hidden_property' => 'enable_twitter_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'aalto' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		/**
		 * Google Plus
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'google_plus_title',
				'title'  => esc_html__( 'Share on Google Plus', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_google_plus_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_google_plus_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_google_plus_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_google_plus_container',
				'hidden_property' => 'enable_google_plus_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'google_plus_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_google_plus_container
			)
		);
		
		/**
		 * Linked In
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_linkedin_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_linkedin_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'hidden_property' => 'enable_linkedin_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_linkedin_container
			)
		);
		
		/**
		 * Tumblr
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_tumblr_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_tumblr_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'hidden_property' => 'enable_tumblr_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_tumblr_container
			)
		);
		
		/**
		 * Pinterest
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_pinterest_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_pinterest_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'hidden_property' => 'enable_pinterest_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_pinterest_container
			)
		);
		
		/**
		 * VK
		 */
		aalto_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'aalto' )
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_vk_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_vk_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'hidden_property' => 'enable_vk_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'aalto' ),
				'parent'        => $enable_vk_container
			)
		);
		
		if ( defined( 'EDGE_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = aalto_edge_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'aalto' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);
			
			aalto_edge_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}
		
		if ( defined( 'EDGE_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = aalto_edge_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'aalto' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);
			
			aalto_edge_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}
		
		/**
		 * Open Graph
		 */
		$panel_open_graph = aalto_edge_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'aalto' ),
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'aalto' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'aalto' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_enable_open_graph_container'
				),
				'parent'        => $panel_open_graph
			)
		);
		
		$enable_open_graph_container = aalto_edge_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'hidden_property' => 'enable_open_graph',
				'hidden_value'    => 'no',
				'parent'          => $panel_open_graph
			)
		);
		
		aalto_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => EDGE_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'aalto' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html__( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'aalto' ),
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
        do_action('aalto_edge_social_options', $page);
	}
	
	add_action( 'aalto_edge_options_map', 'aalto_edge_social_options_map', 18 );
}