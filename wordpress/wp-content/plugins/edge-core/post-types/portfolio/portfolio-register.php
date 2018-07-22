<?php

namespace EdgeCore\CPT\Portfolio;

use EdgeCore\Lib\PostTypeInterface;

/**
 * Class PortfolioRegister
 * @package EdgeCore\CPT\Portfolio
 */
class PortfolioRegister implements PostTypeInterface {
	private $base;
	
	public function __construct() {
		$this->base    = 'portfolio-item';
		$this->taxBase = 'portfolio-category';
		
		add_filter( 'archive_template', array( $this, 'registerArchiveTemplate' ) );
		add_filter( 'single_template', array( $this, 'registerSingleTemplate' ) );
	}
	
	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
		$this->registerTax();
		$this->registerTagTax();
	}
	
	/**
	 * Registers portfolio archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 *
	 * @param $archive string current template
	 *
	 * @return string string changed template
	 */
	public function registerArchiveTemplate( $archive ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/archive-' . $this->base . '.php' ) ) {
				return EDGE_CORE_CPT_PATH . '/portfolio/templates/archive-' . $this->base . '.php';
			}
		}
		
		return $archive;
	}
	
	/**
	 * Registers portfolio single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-portfolio-item.php' ) ) {
				return EDGE_CORE_CPT_PATH . '/portfolio/templates/single-' . $this->base . '.php';
			}
		}
		
		return $single;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$menuPosition = 5;
		$menuIcon     = 'dashicons-screenoptions';
		$slug         = $this->base;
		
		if ( edgtf_core_theme_installed() ) {
			if ( aalto_edge_options()->getOptionValue( 'portfolio_single_slug' ) ) {
				$slug = aalto_edge_options()->getOptionValue( 'portfolio_single_slug' );
			}
		}
		
		register_post_type( $this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Edge Portfolio', 'edge-core' ),
					'singular_name' => esc_html__( 'Edge Portfolio Item', 'edge-core' ),
					'add_item'      => esc_html__( 'New Portfolio Item', 'edge-core' ),
					'add_new_item'  => esc_html__( 'Add New Portfolio Item', 'edge-core' ),
					'edit_item'     => esc_html__( 'Edit Portfolio Item', 'edge-core' )
				),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => array( 'slug' => $slug ),
				'menu_position' => $menuPosition,
				'show_ui'       => true,
				'supports'      => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments'
				),
				'menu_icon'     => $menuIcon
			)
		);
	}
	
	/**
	 * Registers custom taxonomy with WordPress
	 */
	private function registerTax() {
		$labels = array(
			'name'              => esc_html__( 'Portfolio Categories', 'edge-core' ),
			'singular_name'     => esc_html__( 'Portfolio Category', 'edge-core' ),
			'search_items'      => esc_html__( 'Search Portfolio Categories', 'edge-core' ),
			'all_items'         => esc_html__( 'All Portfolio Categories', 'edge-core' ),
			'parent_item'       => esc_html__( 'Parent Portfolio Category', 'edge-core' ),
			'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'edge-core' ),
			'edit_item'         => esc_html__( 'Edit Portfolio Category', 'edge-core' ),
			'update_item'       => esc_html__( 'Update Portfolio Category', 'edge-core' ),
			'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'edge-core' ),
			'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'edge-core' ),
			'menu_name'         => esc_html__( 'Portfolio Categories', 'edge-core' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-category' )
		) );
	}
	
	/**
	 * Registers custom tag taxonomy with WordPress
	 */
	private function registerTagTax() {
		$labels = array(
			'name'              => esc_html__( 'Portfolio Tags', 'edge-core' ),
			'singular_name'     => esc_html__( 'Portfolio Tag', 'edge-core' ),
			'search_items'      => esc_html__( 'Search Portfolio Tags', 'edge-core' ),
			'all_items'         => esc_html__( 'All Portfolio Tags', 'edge-core' ),
			'parent_item'       => esc_html__( 'Parent Portfolio Tag', 'edge-core' ),
			'parent_item_colon' => esc_html__( 'Parent Portfolio Tags:', 'edge-core' ),
			'edit_item'         => esc_html__( 'Edit Portfolio Tag', 'edge-core' ),
			'update_item'       => esc_html__( 'Update Portfolio Tag', 'edge-core' ),
			'add_new_item'      => esc_html__( 'Add New Portfolio Tag', 'edge-core' ),
			'new_item_name'     => esc_html__( 'New Portfolio Tag Name', 'edge-core' ),
			'menu_name'         => esc_html__( 'Portfolio Tags', 'edge-core' )
		);
		
		register_taxonomy( 'portfolio-tag', array( $this->base ), array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-tag' )
		) );
	}
}