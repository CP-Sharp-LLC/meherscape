<?php

namespace EdgeCore\CPT\Team;

use EdgeCore\Lib\PostTypeInterface;

class TeamRegister implements PostTypeInterface {
	private $base;
	
	public function __construct() {
		$this->base    = 'team-member';
		$this->taxBase = 'team-category';
		
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
	}
	
	/**
	 * Registers team archive template if one does'nt exists in theme.
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
				return EDGE_CORE_CPT_PATH . '/team/templates/archive-' . $this->base . '.php';
			}
		}
		
		return $archive;
	}
	
	/**
	 * Registers team single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-' . $this->base . '.php' ) ) {
				return EDGE_CORE_CPT_PATH . '/team/templates/single-' . $this->base . '.php';
			}
		}
		
		return $single;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$menuPosition = 5;
		$menuIcon     = 'dashicons-admin-users';
		$slug         = $this->base;
		
		register_post_type( $this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Edge Team', 'edge-core' ),
					'singular_name' => esc_html__( 'Edge Team Member', 'edge-core' ),
					'add_item'      => esc_html__( 'New Team Member', 'edge-core' ),
					'add_new_item'  => esc_html__( 'Add New Team Member', 'edge-core' ),
					'edit_item'     => esc_html__( 'Edit Team Member', 'edge-core' )
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
			'name'              => esc_html__( 'Team Categories', 'edge-core' ),
			'singular_name'     => esc_html__( 'Team Category', 'edge-core' ),
			'search_items'      => esc_html__( 'Search Team Categories', 'edge-core' ),
			'all_items'         => esc_html__( 'All Team Categories', 'edge-core' ),
			'parent_item'       => esc_html__( 'Parent Team Category', 'edge-core' ),
			'parent_item_colon' => esc_html__( 'Parent Team Category:', 'edge-core' ),
			'edit_item'         => esc_html__( 'Edit Team Category', 'edge-core' ),
			'update_item'       => esc_html__( 'Update Team Category', 'edge-core' ),
			'add_new_item'      => esc_html__( 'Add New Team Category', 'edge-core' ),
			'new_item_name'     => esc_html__( 'New Team Category Name', 'edge-core' ),
			'menu_name'         => esc_html__( 'Team Categories', 'edge-core' )
		);
		
		register_taxonomy( $this->taxBase, array( $this->base ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => $this->taxBase )
		) );
	}
}