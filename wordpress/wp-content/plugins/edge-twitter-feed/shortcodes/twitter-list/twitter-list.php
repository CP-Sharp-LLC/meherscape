<?php

namespace EdgeTwitter\Shortcodes\TwitterList;

use EdgeTwitter\Lib;

class TwitterList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_twitter_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Twitter List', 'edge-twitter-feed' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by EDGE', 'edge-twitter-feed' ),
					'icon'                      => 'icon-wpb-twitter-list extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'edge-twitter-feed' ),
							'value'       => array(
								esc_html__( 'Simple', 'edge-twitter-feed' )   => 'simple',
								esc_html__( 'Boxed', 'edge-twitter-feed' )   => 'boxed',
							)
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'user_id',
							'heading'     => esc_html__( 'User ID', 'edge-twitter-feed' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'edge-twitter-feed' ),
							'value'       => array(
								esc_html__( 'One', 'edge-twitter-feed' )   => '1',
								esc_html__( 'Two', 'edge-twitter-feed' )   => '2',
								esc_html__( 'Three', 'edge-twitter-feed' ) => '3',
								esc_html__( 'Four', 'edge-twitter-feed' )  => '4',
								esc_html__( 'Five', 'edge-twitter-feed' )  => '5'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'space_between_columns',
							'heading'    => esc_html__( 'Space Between Columns', 'edge-twitter-feed' ),
							'value'      => array_flip( aalto_edge_get_space_between_items_array() )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_tweets',
							'heading'    => esc_html__( 'Number of Tweets', 'edge-twitter-feed' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'transient_time',
							'heading'    => esc_html__( 'Tweets Cache Time', 'edge-twitter-feed' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Skin', 'edge-twitter-feed' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-twitter-feed' )   => '',
								esc_html__( 'Light', 'edge-twitter-feed' )   => 'light',
								esc_html__( 'Dark', 'edge-twitter-feed' )   => 'dark',
							)
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'					=> 'simple',
			'user_id'               => '',
			'number_of_columns'     => '3',
			'space_between_columns' => 'normal',
			'number_of_tweets'      => '',
			'transient_time'        => '',
			'skin'					=> ''
		);
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		
		$twitter_api           = new \EdgeTwitterApi();
		$params['twitter_api'] = $twitter_api;
		
		if ( $twitter_api->hasUserConnected() ) {
			$response = $twitter_api->fetchTweets( $user_id, $number_of_tweets, array(
				'transient_time' => $transient_time,
				'transient_id'   => 'edgtf_twitter_' . rand( 0, 1000 )
			) );
			
			$params['response'] = $response;
		}
		
		//Get HTML from template based on type of team
		$html = edgtf_twitter_get_shortcode_module_template_part( 'holder', 'twitter-list', '', $params );
		
		return $html;
	}
	
	public function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-twitter-list-'.$params['type'] : 'edgtf-twitter-list-simple';
		$holderClasses[] = $this->getColumnNumberClass( $params['number_of_columns'] );
		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'edgtf-' . $params['space_between_columns'] . '-space' : 'edgtf-tl-normal-space';
		$holderClasses[] = ! empty( $params['skin'] ) ? 'edgtf-' . $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}

    public function getColumnNumberClass( $params ) {
        switch ( $params ) {
            case 1:
                $classes = 'edgtf-tl-one-column';
                break;
            case 2:
                $classes = 'edgtf-tl-two-columns';
                break;
            case 3:
                $classes = 'edgtf-tl-three-columns';
                break;
            case 4:
                $classes = 'edgtf-tl-four-columns';
                break;
            case 5:
                $classes = 'edgtf-tl-five-columns';
                break;
            default:
                $classes = 'edgtf-tl-three-columns';
                break;
        }

        return $classes;
    }
}