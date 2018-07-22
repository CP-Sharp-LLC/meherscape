<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class EdgeSkin extends AaltoEdgeSkinAbstract {
    /**
     * Skin constructor. Hooks to aalto_edge_admin_scripts_init and aalto_edge_enqueue_admin_styles
     */
    public function __construct() {
        $this->skinName = 'edge';

        //hook to
        add_action('aalto_edge_admin_scripts_init', array($this, 'registerStyles'));
        add_action('aalto_edge_admin_scripts_init', array($this, 'registerScripts'));

        add_action('aalto_edge_enqueue_admin_styles', array($this, 'enqueueStyles'));
        add_action('aalto_edge_enqueue_admin_scripts', array($this, 'enqueueScripts'));

        add_action('aalto_edge_enqueue_meta_box_styles', array($this, 'enqueueStyles'));
        add_action('aalto_edge_enqueue_meta_box_scripts', array($this, 'enqueueScripts'));

		add_action('before_wp_tiny_mce', array($this, 'setShortcodeJSParams'));
    }

    /**
     * Method that registers skin scripts
     */
	public function registerScripts() {

		//This part is required for field type address
        $enable_google_map_in_admin = apply_filters('aalto_edge_google_maps_in_backend', false);
        if($enable_google_map_in_admin) {
            //include google map api script
            $google_maps_api_key          = aalto_edge_options()->getOptionValue( 'google_maps_api_key' );
            $google_maps_extensions       = '';
            $google_maps_extensions_array = apply_filters( 'aalto_edge_google_maps_extensions_array', array() );
            if ( ! empty( $google_maps_extensions_array ) ) {
                $google_maps_extensions .= '&libraries=';
                $google_maps_extensions .= implode( ',', $google_maps_extensions_array );
            }
            if ( ! empty( $google_maps_api_key ) ) {
                wp_register_script( 'edgtf-admin-maps', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . $google_maps_extensions, array(), false, true );
                $this->scripts['jquery.geocomplete.min'] = array(
                    'path'       => 'assets/js/edgtf-ui/jquery.geocomplete.min.js',
                    'dependency' => array( 'edgtf-admin-maps' )
                );
            }
        }
		
		$this->scripts['bootstrap.min']          = array(
			'path'       => 'assets/js/bootstrap.min.js',
			'dependency' => array()
		);
		$this->scripts['jquery.nouislider.min']  = array(
			'path'       => 'assets/js/edgtf-ui/jquery.nouislider.min.js',
			'dependency' => array()
		);
		$this->scripts['edgtf-ui-admin']         = array(
			'path'       => 'assets/js/edgtf-ui/edgtf-ui.js',
			'dependency' => array()
		);
		$this->scripts['edgtf-bootstrap-select'] = array(
			'path'       => 'assets/js/edgtf-ui/edgtf-bootstrap-select.min.js',
			'dependency' => array()
		);
		$this->scripts['select2']                = array(
			'path'       => 'assets/js/edgtf-ui/select2.min.js',
			'dependency' => array()
		);
		
		foreach ( $this->scripts as $scriptHandle => $script ) {
			aalto_edge_register_skin_script( $scriptHandle, $script['path'], $script['dependency'] );
		}
	}

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['edgtf-bootstrap'] = 'assets/css/edgtf-bootstrap.css';
        $this->styles['edgtf-page-admin'] = 'assets/css/edgtf-page.css';
        $this->styles['edgtf-options-admin'] = 'assets/css/edgtf-options.css';
        $this->styles['edgtf-meta-boxes-admin'] = 'assets/css/edgtf-meta-boxes.css';
        $this->styles['edgtf-ui-admin'] = 'assets/css/edgtf-ui/edgtf-ui.css';
        $this->styles['edgtf-forms-admin'] = 'assets/css/edgtf-forms.css';
        $this->styles['edgtf-import'] = 'assets/css/edgtf-import.css';
        $this->styles['font-awesome-admin'] = 'assets/css/font-awesome/css/font-awesome.min.css';
        $this->styles['select2'] = 'assets/css/select2.min.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            aalto_edge_register_skin_style($styleHandle, $stylePath);
        }
    }

    /**
     * Method that renders options page
     *
     * @see EdgeSkin::getHeader()
     * @see EdgeSkin::getPageNav()
     * @see EdgeSkin::getPageContent()
     */
    public function renderOptions() {
        global $aalto_edge_Framework;
        $tab    = aalto_edge_get_admin_tab();
        $active_page = $aalto_edge_Framework->edgtfOptions->getAdminPageFromSlug($tab);
        if ($active_page == null) return;
        ?>
        <div class="edgtf-options-page edgtf-page">
            <?php $this->getHeader($active_page); ?>
            <div class="edgtf-page-content-wrapper">
                <div class="edgtf-page-content">
                    <div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    /**
     * Method that renders header of options page.
     * @param bool $show_save_btn whether to show save button. Should be hidden on import page
     *
     * @see AaltoEdgeSkinAbstract::loadTemplatePart()
     */
    public function getHeader($activePage = '', $show_save_btn = true) {
        $this->loadTemplatePart('header', array('active_page' => $activePage, 'show_save_btn' => $show_save_btn));
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $is_import_page if is import page highlighted that tab
     *
     * @see AaltoEdgeSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $is_import_page = false, $is_backup_options_page = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'is_import_page' => $is_import_page,
			'is_backup_options_page' => $is_backup_options_page
        ));
    }

    /**
     * Method that loads current page content
     *
     * @param AaltoEdgeAdminPage $page current page to load
     * @see AaltoEdgeSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page) {
        $this->loadTemplatePart('content', array('page' => $page));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }

	/**
	 * Method that loads content for backup page
	 */
	public function getBackupOptionsContent() {
		$this->loadTemplatePart('backup-options');
	}

	/**
	 * Method that loads anchors and save button template part
	 *
	 * @param AaltoEdgeAdminPage $page current page to load
	 * @see AaltoEdgeSkinAbstract::loadTemplatePart()
	 */
    public function getAnchors($page) {
        $this->loadTemplatePart('anchors', array('page' => $page));

    }
	
	/**
	 * Method that renders import page
	 *
	 *  @see EdgeSkin::getHeader()
	 *  @see EdgeSkin::getPageNav()
	 *  @see EdgeSkin::getImportContent()
	 */
    public function renderImport() { ?>
        <div class="edgtf-options-page edgtf-page">
            <?php $this->getHeader('', false); ?>
            <div class="edgtf-page-content-wrapper">
                <div class="edgtf-page-content">
                    <div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

	/**
	 * Method that renders backup options page
	 *
	 * @see EdgeSkin::getHeader()
	 * * @see EdgeSkin::getPageNav()
	 * * @see EdgeSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="edgtf-options-page edgtf-page">
			<?php $this->getHeader('',false); ?>
			<div class="edgtf-page-content-wrapper">
				<div class="edgtf-page-content">
					<div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }

}
?>