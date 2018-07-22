<?php
namespace EdgeCore\CPT\Shortcodes\ParallaxHolder;

use EdgeCore\Lib;

class ParallaxHolder implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_parallax_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Parallax Holder', 'edge-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by EDGE', 'edge-core' ),
					'icon'                      => 'icon-wpb-parallax-holder extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
					'as_parent' => array('except' => ''),
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Y Axis Translation', 'edge-core'),
							'admin_label' => true,
							'param_name' => 'y_axis_translation',
							'value' => '-200',
							'description' => esc_html__('Enter the value in pixels. Negative value changes parallax direction.', 'edge-core')
						),
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
	
		$args = array(
			'y_axis_translation' => '-200',
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html= '';
		$y_absolute = aalto_edge_filter_px($y_axis_translation);
		$smoothness = 20; //1 is for linear, non-animated parallax

		$parallax = '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';

		$html .= '<div class="edgtf-parallax-holder" data-parallax="'.$parallax.'">'; 
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;

	}
}