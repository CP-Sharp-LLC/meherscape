<?php

require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.kses.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.layout1.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.layout2.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.layout3.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.layout.tax.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.layout.user.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.optionsapi.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.framework.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.functions.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/lib/edgtf.icons/edgtf.icons.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/admin/options/edgtf-options-setup.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/admin/meta-boxes/edgtf-meta-boxes-setup.php";
require_once EDGE_FRAMEWORK_ROOT_DIR . "/modules/edgtf-modules-loader.php";

if ( ! function_exists( 'aalto_edge_admin_scripts_init' ) ) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function aalto_edge_admin_scripts_init() {
		/**
		 * @see AaltoEdgeSkinAbstract::registerScripts - hooked with 10
		 * @see AaltoEdgeSkinAbstract::registerStyles - hooked with 10
		 */
		do_action( 'aalto_edge_admin_scripts_init' );
	}
	
	add_action( 'admin_init', 'aalto_edge_admin_scripts_init' );
}

if ( ! function_exists( 'aalto_edge_enqueue_admin_styles' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function aalto_edge_enqueue_admin_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		
		/**
		 * @see AaltoEdgeSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'aalto_edge_enqueue_admin_styles' );
	}
}

if ( ! function_exists( 'aalto_edge_enqueue_admin_scripts' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function aalto_edge_enqueue_admin_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'edgtf-dependence', get_template_directory_uri() . '/framework/admin/assets/js/edgtf-ui/edgtf-dependence.js', array(), false, true );
		wp_enqueue_script( 'edgtf-twitter-connect', get_template_directory_uri() . '/framework/admin/assets/js/edgtf-twitter-connect.js', array(), false, true );
		
		/**
		 * @see AaltoEdgeSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'aalto_edge_enqueue_admin_scripts' );
	}
}

if ( ! function_exists( 'aalto_edge_enqueue_meta_box_styles' ) ) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function aalto_edge_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		
		/**
		 * @see AaltoEdgeSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'aalto_edge_enqueue_meta_box_styles' );
	}
}

if ( ! function_exists( 'aalto_edge_enqueue_meta_box_scripts' ) ) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function aalto_edge_enqueue_meta_box_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'edgtf-dependence' );
		
		/**
		 * @see AaltoEdgeSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'aalto_edge_enqueue_meta_box_scripts' );
	}
}

if ( ! function_exists( 'aalto_edge_enqueue_nav_menu_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function aalto_edge_enqueue_nav_menu_script( $hook ) {
		if ( $hook == 'nav-menus.php' ) {
			wp_enqueue_script( 'edgtf-nav-menu', get_template_directory_uri() . '/framework/admin/assets/js/edgtf-nav-menu.js' );
			wp_enqueue_style( 'edgtf-nav-menu', get_template_directory_uri() . '/framework/admin/assets/css/edgtf-nav-menu.css' );
		}
	}
	
	add_action( 'admin_enqueue_scripts', 'aalto_edge_enqueue_nav_menu_script' );
}

if ( ! function_exists( 'aalto_edge_enqueue_widgets_admin_script' ) ) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 *
	 * @param $hook string current page hook to check
	 */
	function aalto_edge_enqueue_widgets_admin_script( $hook ) {
		if ( $hook == 'widgets.php' ) {
			wp_enqueue_script( 'edgtf-dependence' );
			wp_enqueue_script( 'edgtf-widgets-dependence', get_template_directory_uri() . '/framework/admin/assets/js/edgtf-ui/edgtf-widget-dependence.js', array(), false, true );
		}
	}
	
	add_action( 'admin_enqueue_scripts', 'aalto_edge_enqueue_widgets_admin_script' );
}

if ( ! function_exists( 'aalto_edge_enqueue_taxonomy_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function aalto_edge_enqueue_taxonomy_script( $hook ) {
		if ( $hook == 'edit-tags.php' || $hook == 'term.php' ) {
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2', get_template_directory_uri() . '/framework/admin/assets/css/select2.min.css' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'aalto_edge_enqueue_taxonomy_script' );
}


if ( ! function_exists( 'aalto_edge_init_theme_options_array' ) ) {
	/**
	 * Function that merges $aalto_edge_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function aalto_edge_init_theme_options_array() {
		global $aalto_edge_options, $aalto_edge_Framework;
		
		$db_options = get_option( 'edgtf_options_aalto' );
		
		//does edgtf_options exists in db?
		if ( is_array( $db_options ) ) {
			//merge with default options
			$aalto_edge_options = array_merge( $aalto_edge_Framework->edgtfOptions->options, get_option( 'edgtf_options_aalto' ) );
		} else {
			//options don't exists in db, take default ones
			$aalto_edge_options = $aalto_edge_Framework->edgtfOptions->options;
		}
	}
	
	add_action( 'aalto_edge_after_options_map', 'aalto_edge_init_theme_options_array', 0 );
}

if ( ! function_exists( 'aalto_edge_init_theme_options' ) ) {
	/**
	 * Function that sets $aalto_edge_options variable if it does'nt exists
	 */
	function aalto_edge_init_theme_options() {
		global $aalto_edge_options;
		global $aalto_edge_Framework;
		if ( isset( $aalto_edge_options['reset_to_defaults'] ) ) {
			if ( $aalto_edge_options['reset_to_defaults'] == 'yes' ) {
				delete_option( "edgtf_options_aalto" );
			}
		}
		
		if ( ! get_option( "edgtf_options_aalto" ) ) {
			add_option( "edgtf_options_aalto", $aalto_edge_Framework->edgtfOptions->options );
			
			$aalto_edge_options = $aalto_edge_Framework->edgtfOptions->options;
		}
	}
}

if ( ! function_exists( 'aalto_edge_register_theme_settings' ) ) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function aalto_edge_register_theme_settings() {
		register_setting( 'aalto_edge_theme_menu', 'edgtf_options' );
	}
	
	add_action( 'admin_init', 'aalto_edge_register_theme_settings' );
}

if ( ! function_exists( 'aalto_edge_get_admin_tab' ) ) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function aalto_edge_get_admin_tab() {
		return isset( $_GET['page'] ) ? aalto_edge_strafter( $_GET['page'], 'tab' ) : null;
	}
}

if ( ! function_exists( 'aalto_edge_strafter' ) ) {
	/**
	 * Function that returns string that comes after found string
	 *
	 * @param $string string where to search
	 * @param $substring string what to search for
	 *
	 * @return null|string string that comes after found string
	 */
	function aalto_edge_strafter( $string, $substring ) {
		$pos = strpos( $string, $substring );
		if ( $pos === false ) {
			return null;
		}
		
		return ( substr( $string, $pos + strlen( $substring ) ) );
	}
}

if ( ! function_exists( 'aalto_edge_save_options' ) ) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_edgtf_save_options action.
	 */
	function aalto_edge_save_options() {
		global $aalto_edge_options;
		
		if ( current_user_can( 'administrator' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );
			
			unset( $_REQUEST['action'] );
			
			check_ajax_referer( 'edgtf_ajax_save_nonce', 'edgtf_ajax_save_nonce' );
			
			$aalto_edge_options = array_merge( $aalto_edge_options, $_REQUEST );
			
			update_option( 'edgtf_options_aalto', $aalto_edge_options );
			
			do_action( 'aalto_edge_after_theme_option_save' );
			echo esc_html__( 'Saved', 'aalto' );
			
			die();
		}
	}
	
	add_action( 'wp_ajax_aalto_edge_save_options', 'aalto_edge_save_options' );
}

if ( ! function_exists( 'aalto_edge_meta_box_add' ) ) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function aalto_edge_meta_box_add() {
		global $aalto_edge_Framework;
		
		foreach ( $aalto_edge_Framework->edgtfMetaBoxes->metaBoxes as $key => $box ) {
			$hidden = false;
			if ( ! empty( $box->hidden_property ) ) {
				foreach ( $box->hidden_values as $value ) {
					if ( aalto_edge_option_get_value( $box->hidden_property ) == $value ) {
						$hidden = true;
					}
				}
			}
			
			if ( is_string( $box->scope ) ) {
				$box->scope = array( $box->scope );
			}
			
			if ( is_array( $box->scope ) && count( $box->scope ) ) {
				foreach ( $box->scope as $screen ) {
					add_meta_box(
						'edgtf-meta-box-' . $key,
						$box->title,
						'aalto_edge_render_meta_box',
						$screen,
						$box->context,
						$box->priority,
						array( 'box' => $box )
					);
					
					if ( $hidden ) {
						add_filter( 'postbox_classes_' . $screen . '_edgtf-meta-box-' . $key, 'aalto_edge_meta_box_add_hidden_class' );
					}
				}
			}
		}
		
		add_action( 'admin_enqueue_scripts', 'aalto_edge_enqueue_meta_box_styles' );
		add_action( 'admin_enqueue_scripts', 'aalto_edge_enqueue_meta_box_scripts' );
	}
	
	add_action( 'add_meta_boxes', 'aalto_edge_meta_box_add' );
}

if ( ! function_exists( 'aalto_edge_meta_box_save' ) ) {
	/**
	 * Function that saves meta box to postmeta table
	 *
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function aalto_edge_meta_box_save( $post_id, $post ) {
		global $aalto_edge_Framework;
		
		$nonces_array = array();
		$meta_boxes   = aalto_edge_framework()->edgtfMetaBoxes->getMetaBoxesByScope( $post->post_type );
		
		if ( is_array( $meta_boxes ) && count( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				$nonces_array[] = 'aalto_edge_meta_box_' . $meta_box->name . '_save';
			}
		}
		
		if ( is_array( $nonces_array ) && count( $nonces_array ) ) {
			foreach ( $nonces_array as $nonce ) {
				if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) {
					return;
				}
			}
		}
		
		$postTypes = apply_filters( 'aalto_edge_meta_box_post_types_save', array( 'post', 'page' ) );
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		
		if ( ! isset( $_POST['_wpnonce'] ) ) {
			return;
		}
		
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		
		if ( ! in_array( $post->post_type, $postTypes ) ) {
			return;
		}
		
		foreach ( $aalto_edge_Framework->edgtfMetaBoxes->options as $key => $box ) {
			
			if ( isset( $_POST[ $key ] ) && trim( $_POST[ $key ] !== '' ) ) {
				
				$value = $_POST[ $key ];
				
				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
				$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
				$portfolios = true;

			}
		}
		
		if ( $portfolios ) {
			update_post_meta( $post_id, 'edgtf_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'edgtf_portfolios' );
		}

		$portfolio_images = false;
		if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
				$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
				$portfolio_images = true;
			}
		}
		
		if ( $portfolio_images ) {
			update_post_meta( $post_id, 'edgtf_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id, 'edgtf_portfolio_images' );
		}
	}
	
	add_action( 'save_post', 'aalto_edge_meta_box_save', 1, 2 );
}

if ( ! function_exists( 'aalto_edge_render_meta_box' ) ) {
	/**
	 * Function that renders meta box
	 *
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function aalto_edge_render_meta_box( $post, $metabox ) { ?>
		<div class="edgtf-meta-box edgtf-page">
			<div class="edgtf-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field( 'aalto_edge_meta_box_' . $metabox['args']['box']->name . '_save', 'aalto_edge_meta_box_' . $metabox['args']['box']->name . '_save' ); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'aalto_edge_meta_box_add_hidden_class' ) ) {
	/**
	 * Function that adds class that will initially hide meta box
	 *
	 * @param array $classes array of classes
	 *
	 * @return array modified array of classes
	 */
	function aalto_edge_meta_box_add_hidden_class( $classes = array() ) {
		if ( ! in_array( 'edgtf-meta-box-hidden', $classes ) ) {
			$classes[] = 'edgtf-meta-box-hidden';
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'aalto_edge_remove_default_custom_fields' ) ) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function aalto_edge_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( apply_filters( 'aalto_edge_meta_box_post_types_remove', array( 'post', 'page' ) ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}
	
	add_action( 'do_meta_boxes', 'aalto_edge_remove_default_custom_fields' );
}

if ( ! function_exists( 'aalto_edge_generate_icon_pack_options' ) ) {
	/**
	 * Generates options HTML for each icon in given icon pack
	 * Hooked to wp_ajax_update_admin_nav_icon_options action
	 */
	function aalto_edge_generate_icon_pack_options() {
		global $aalto_edge_IconCollections;
		
		$html               = '';
		$icon_pack          = isset( $_POST['icon_pack'] ) ? $_POST['icon_pack'] : '';
		$collections_object = $aalto_edge_IconCollections->getIconCollection( $icon_pack );
		
		if ( $collections_object ) {
			$icons = $collections_object->getIconsArray();
			if ( is_array( $icons ) && count( $icons ) ) {
				foreach ( $icons as $key => $icon ) {
					$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $key ) . '</option>';
				}
			}
		}
		
		echo wp_kses( $html, array( 'option' => array( 'value' => true ) ) );
	}
	
	add_action( 'wp_ajax_update_admin_nav_icon_options', 'aalto_edge_generate_icon_pack_options' );
}

if ( ! function_exists( 'aalto_edge_save_dismisable_notice' ) ) {
	/**
	 * Updates user meta with dismisable notice. Hooks to admin_init action
	 * in order to check this on every page request in admin
	 */
	function aalto_edge_save_dismisable_notice() {
		if ( is_admin() && ! empty( $_GET['edgtf_dismis_notice'] ) ) {
			$notice_id       = sanitize_key( $_GET['edgtf_dismis_notice'] );
			$current_user_id = get_current_user_id();
			
			update_user_meta( $current_user_id, 'dismis_' . $notice_id, 1 );
		}
	}
	
	add_action( 'admin_init', 'aalto_edge_save_dismisable_notice' );
}

if ( ! function_exists( 'aalto_edge_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function aalto_edge_ajax_status( $status, $message, $data = null ) {
		$response = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		);
		
		$output = json_encode( $response );
		
		exit( $output );
	}
}

if ( ! function_exists( 'aalto_edge_hook_twitter_request_ajax' ) ) {
	/**
	 * Wrapper function for obtaining twitter request token.
	 * Hooks to wp_ajax_edgtf_twitter_obtain_request_token ajax action
	 *
	 * @see EdgeTwitterApi::obtainRequestToken()
	 */
	function aalto_edge_hook_twitter_request_ajax() {
		EdgeTwitterApi::getInstance()->obtainRequestToken();
	}
	
	add_action( 'wp_ajax_edgtf_twitter_obtain_request_token', 'aalto_edge_hook_twitter_request_ajax' );
}


if ( ! function_exists( 'aalto_edge_set_admin_google_api_class' ) ) {
	function aalto_edge_set_admin_google_api_class( $classes ) {
		$google_map_api = aalto_edge_options()->getOptionValue( 'google_maps_api_key' );

		if ( empty( $google_map_api ) ) {
			$classes .= ' edgtf-empty-google-api';
		}
		
		return $classes;
	}
	
	add_filter( 'admin_body_class', 'aalto_edge_set_admin_google_api_class' );
}

if ( ! function_exists( 'aalto_edge_comment' ) ) {
	/**
	 * Function which modify default WordPress comments
	 *
	 * @return comments html
	 */
	function aalto_edge_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		global $post;
		
		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment   = $post->post_author == $comment->user_id;
		
		$comment_class = 'edgtf-comment clearfix';
		
		if ( $is_author_comment ) {
			$comment_class .= ' edgtf-post-author-comment';
		}
		
		if ( $is_pingback_comment ) {
			$comment_class .= ' edgtf-pingback-comment';
		}
		?>
		
		<li>
		<div class="<?php echo esc_attr( $comment_class ); ?>">
			<?php if ( ! $is_pingback_comment ) { ?>
				<div class="edgtf-comment-image"> <?php echo aalto_edge_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
			<?php } ?>
			<div class="edgtf-comment-text">
				<div class="edgtf-comment-info">
					<h5 class="edgtf-comment-name vcard">
						<?php if ( $is_pingback_comment ) {
							esc_html_e( 'Pingback:', 'aalto' );
						} ?>
						<?php echo wp_kses_post( get_comment_author_link() ); ?>
					</h5>
					<?php
					comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( 'Reply', 'aalto' ),
						'depth'      => $depth,
						'max_depth'  => $args['max_depth']
					) ) );
					edit_comment_link( esc_html__( 'Edit', 'aalto' ) );
					?>
				</div>
                <div class="edgtf-comment-date"><?php comment_time( get_option( 'date_format' ) ); ?></div>
				<?php if ( ! $is_pingback_comment ) { ?>
					<div class="edgtf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

/* Taxonomy custom fields functions - START */

if ( ! function_exists( 'aalto_edge_init_custom_taxonomy_fields' ) ) {
	function aalto_edge_init_custom_taxonomy_fields() {
		do_action( 'aalto_edge_custom_taxonomy_fields' );
	}
	
	add_action( 'after_setup_theme', 'aalto_edge_init_custom_taxonomy_fields' );
}

if ( ! function_exists( 'aalto_edge_taxonomy_fields_add' ) ) {
	function aalto_edge_taxonomy_fields_add() {
		global $aalto_edge_Framework;
		
		foreach ( $aalto_edge_Framework->edgtfTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_add_form_fields', 'aalto_edge_taxonomy_fields_display_add', 10, 2 );
		}
	}
	
	add_action( 'after_setup_theme', 'aalto_edge_taxonomy_fields_add', 11 );
}

if ( ! function_exists( 'aalto_edge_taxonomy_fields_edit' ) ) {
	function aalto_edge_taxonomy_fields_edit() {
		global $aalto_edge_Framework;
		
		foreach ( $aalto_edge_Framework->edgtfTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_edit_form_fields', 'aalto_edge_taxonomy_fields_display_edit', 10, 2 );
		}
	}
	
	add_action( 'after_setup_theme', 'aalto_edge_taxonomy_fields_edit', 11 );
}

if ( ! function_exists( 'aalto_edge_taxonomy_fields_display_add' ) ) {
	function aalto_edge_taxonomy_fields_display_add( $taxonomy ) {
		global $aalto_edge_Framework;
		
		foreach ( $aalto_edge_Framework->edgtfTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'aalto_edge_taxonomy_fields_display_edit' ) ) {
	function aalto_edge_taxonomy_fields_display_edit( $term, $taxonomy ) {
		global $aalto_edge_Framework;
		
		foreach ( $aalto_edge_Framework->edgtfTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'aalto_edge_save_taxonomy_custom_fields' ) ) {
	function aalto_edge_save_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'aalto_edge_taxonomy_fields', array() );
		
		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				add_term_meta( $term_id, $value, $_POST[ $value ] );
			}
		}
	}
	
	add_action( 'created_term', 'aalto_edge_save_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'aalto_edge_update_taxonomy_custom_fields' ) ) {
	function aalto_edge_update_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'aalto_edge_taxonomy_fields', array() );
		
		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_term_meta( $term_id, $value, $_POST[ $value ] );
			} else {
				update_term_meta( $term_id, $value, '' );
			}
		}
	}
	
	add_action( 'edited_term', 'aalto_edge_update_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'aalto_edge_tax_add_script' ) ) {
	function aalto_edge_tax_add_script() {
		wp_enqueue_media();
		wp_enqueue_script( 'edgtf-tax-js', EDGE_FRAMEWORK_ROOT . '/admin/assets/js/edgtf-tax-custom-fields.js' );
	}
	
	add_action( 'admin_enqueue_scripts', 'aalto_edge_tax_add_script' );
}

/** Taxonomy Delete Image **/
if ( ! function_exists( 'aalto_edge_tax_del_image' ) ) {
	function aalto_edge_tax_del_image() {
		/** If we don't have a term_id, bail out **/
		if ( ! isset( $_GET['term_id'] ) ) {
			esc_html_e( 'Not Set or Empty', 'aalto' );
			exit;
		}
		
		$field_name = $_GET['field_name'];
		$term_id    = $_GET['term_id'];
		$imageID    = get_term_meta( $term_id, $field_name, true );  // Get our attachment ID
		
		if ( is_numeric( $imageID ) ) {                              // Verify that the attachment ID is indeed a number
			wp_delete_attachment( $imageID );                       // Delete our image
			delete_term_meta( $term_id, $field_name );// Delete our image meta
			exit;
		}
		
		esc_html_e( 'Contact Administrator', 'aalto' ); // If we've reached this point, something went wrong - enable debugging
		exit;
	}
	
	add_action( 'wp_ajax_aalto_edge_tax_del_image', 'aalto_edge_tax_del_image' );
}

/* Taxonomy custom fields functions - END */

/* User custom fields functions - START */

if ( ! function_exists( 'aalto_edge_init_custom_user_fields' ) ) {
	function aalto_edge_init_custom_user_fields() {
		do_action( 'aalto_edge_custom_user_fields' );
	}
	
	add_action( 'after_setup_theme', 'aalto_edge_init_custom_user_fields' );
}

if ( ! function_exists( 'aalto_edge_user_fields_edit' ) ) {
	function aalto_edge_user_fields_edit($user) {
		global $aalto_edge_Framework;

		foreach ( $aalto_edge_Framework->edgtfUserOptions->userOptions as $key => $fields ) {

			$display_fields = false;
			foreach ($user->roles as $role) {
				if (in_array($role, $fields->scope)){
					$display_fields = true;
					break;
				}
			}
			if ( $display_fields ) {
				$fields->render();
			}
		}
	}
	
	add_action('show_user_profile', 'aalto_edge_user_fields_edit');
	add_action('edit_user_profile', 'aalto_edge_user_fields_edit');
}

if ( ! function_exists( 'aalto_edge_save_user_fields' ) ) {
	function aalto_edge_save_user_fields($user_id) {

		$fields = apply_filters( 'aalto_edge_user_fields', array() );

		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_user_meta( $user_id, $value, $_POST[ $value ] );
			}
		}
	}
		
	add_action( 'personal_options_update', 'aalto_edge_save_user_fields');
	add_action( 'edit_user_profile_update', 'aalto_edge_save_user_fields');
}
/* User custom fields functions - END */
?>