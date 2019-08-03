<?php

if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class EntropiaCoreImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;
	
	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;
	
	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;
	
	/**
	 * @return EntropiaCoreImport
	 */
	public static function getInstance() {
		if ( self::$instance === null ) {
			return new self();
		}
		
		return self::$instance;
	}
	
	public $message = "";
	public $attachments = false;
	
	function __construct() {
		$this->revSliderFolder = 'edgtf-rev-sliders';
		$this->importURI       = defined( 'EDGE_PROFILE_SLUG' ) ? 'http://export.' . EDGE_PROFILE_SLUG . '-themes.com/' : '';
		
		add_action( 'admin_menu', array( &$this, 'edgtf_admin_import' ) );
		add_action( 'admin_init', array( &$this, 'edgtf_register_theme_settings' ) );

	}
	
	function edgtf_register_theme_settings() {
		register_setting( 'edgtf_options_import_page', 'edgtf_options_import' );
	}
	
	public function import_content( $file ) {
		ob_start();
		require_once( ENTROPIA_CORE_ABS_PATH . '/import/class.wordpress-importer.php' );
		$entropia_import = new WP_Import();
		set_time_limit( 0 );
		
		$entropia_import->fetch_attachments = $this->attachments;
		$returned_value                  = $entropia_import->import( $file );
		
		if ( is_wp_error( $returned_value ) ) {
			$this->message = esc_html__( 'An Error Occurred During Import', 'entropia-core' );
		} else {
			$this->message = esc_html__( 'Content imported successfully', 'entropia-core' );
		}
		
		ob_get_clean();
	}
	
	public function import_widgets( $file, $file2 ) {
		$this->import_custom_sidebars( $file2 );
		$options = $this->file_options( $file );
		
		foreach ( (array) $options['widgets'] as $entropia_widget_id => $entropia_widget_data ) {
			update_option( 'widget_' . $entropia_widget_id, $entropia_widget_data );
		}
		
		$this->import_sidebars_widgets( $file );
		$this->message = esc_html__( 'Widgets imported successfully', 'entropia-core' );
	}
	
	public function import_sidebars_widgets( $file ) {
		$entropia_sidebars = get_option( "sidebars_widgets" );
		unset( $entropia_sidebars['array_version'] );
		$data = $this->file_options( $file );
		
		if ( is_array( $data['sidebars'] ) ) {
			$entropia_sidebars = array_merge( (array) $entropia_sidebars, (array) $data['sidebars'] );
			unset( $entropia_sidebars['wp_inactive_widgets'] );
			$entropia_sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $entropia_sidebars );
			$entropia_sidebars['array_version'] = 2;
			wp_set_sidebars_widgets( $entropia_sidebars );
		}
	}
	
	public function import_custom_sidebars( $file ) {
		$options = $this->file_options( $file );
		update_option( 'edgtf_sidebars', $options );
		$this->message = esc_html__( 'Custom sidebars imported successfully', 'entropia-core' );
	}
	
	public function import_options( $file ) {
		$options       = $this->file_options( $file );
		$result        = update_option( 'edgtf_options_entropia', $options );
		$this->message = esc_html__( 'Options imported successfully', 'entropia-core' );
	}
	
	public function import_menus( $file ) {
		global $wpdb;
		$entropia_terms_table = $wpdb->prefix . "terms";
		$this->menus_data  = $this->file_options( $file );
		$menu_array        = array();
		
		foreach ( $this->menus_data as $registered_menu => $menu_slug ) {
			$term_rows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $entropia_terms_table where slug=%s", $menu_slug ), ARRAY_A );
			
			if ( isset( $term_rows[0]['term_id'] ) ) {
				$term_id_by_slug = $term_rows[0]['term_id'];
			} else {
				$term_id_by_slug = null;
			}
			
			$menu_array[ $registered_menu ] = $term_id_by_slug;
		}
		
		set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_array ) );
	}
	
	public function import_settings_pages( $file ) {
		$pages = $this->file_options( $file );
		
		foreach ( $pages as $entropia_page_option => $entropia_page_id ) {
			update_option( $entropia_page_option, $entropia_page_id );
		}
	}
	
	public function rev_sliders() {
		$rev_sldiers = array(
			'concept-artist.zip',
			'development.zip',
			'game-showcase.zip',
			'main-home.zip',
			'coming-soon.zip',
			'landing-top.zip',
			'main-home-countdown.zip',
			'shop-slider.zip'
		);

		return $rev_sldiers;
	}
	
	public function create_rev_slider_files( $folder ) {
		$rev_list = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;
		
		$upload     = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		if ( ! is_dir( $upload_dir ) ) {
			mkdir( $upload_dir, 0700 );
			mkdir( $upload_dir . '/' . $folder, 0700 );
		}
		
		foreach ( $rev_list as $rev_slider ) {
			file_put_contents( WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider, file_get_contents( $this->importURI . $folder . '/revslider/' . $rev_slider ) );
		}
	}
	
	public function rev_slider_import( $folder ) {
		$this->create_rev_slider_files( $folder );
		
		$rev_sliders   = $this->rev_sliders();
		$dir_name      = $this->revSliderFolder;
		$absolute_path = __FILE__;
		$path_to_file  = explode( 'wp-content', $absolute_path );
		$path_to_wp    = $path_to_file[0];
		
		require_once( $path_to_wp . '/wp-load.php' );
		require_once( $path_to_wp . '/wp-includes/functions.php' );
		require_once( $path_to_wp . '/wp-admin/includes/file.php' );
		
		$rev_slider_instance = new RevSlider();
		
		foreach ( $rev_sliders as $rev_slider ) {
			$nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
			$rev_slider_instance->importSliderFromPost( true, true, $nf );
		}
	}
	
	public function file_options( $file ) {
		$file_content = $this->edgtf_file_contents( $file );
		
		if ( $file_content ) {
			$unserialized_content = unserialize( base64_decode( $file_content ) );
			
			if ( $unserialized_content ) {
				return $unserialized_content;
			}
		}
		
		return false;
	}
	
	function edgtf_file_contents( $path ) {
		$url      = $this->importURI . $path;
		$response = wp_remote_get( $url );
		$body     = wp_remote_retrieve_body( $response );
		
		return $body;
	}
	
	function edgtf_admin_import() {
		if ( entropia_core_theme_installed() ) {
			global $entropia_edge_global_Framework;
			
			$slug           = "_tabimport";
			$this->pagehook = add_submenu_page(
                EDGE_OPTIONS_SLUG,
				esc_html__( 'Entropia Options - Entropia Import', 'entropia-core' ), // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Import', 'entropia-core' ),                     // The text of the menu in the administrator's sidebar
				'administrator',                                          // What roles are able to access the menu
                EDGE_OPTIONS_SLUG . $slug,                  // The ID used to bind submenu items to this menu
				array( $entropia_edge_global_Framework->getSkin(), 'renderImport' )
			);
			
			add_action( 'admin_print_scripts-' . $this->pagehook, 'entropia_edge_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $this->pagehook, 'entropia_edge_enqueue_admin_styles' );
		}
	}
	
	function edgtf_update_meta_fields_after_import( $folder ) {
		global $wpdb;
		$url = home_url( '/' );
		
		$demo_url = $this->edgtf_import_get_demo_url( $folder );
		
		$images_field_array = entropia_edge_meta_boxes()->getOptionsByType( 'image' );
		
		if ( ! ( is_array( $images_field_array ) && count( $images_field_array ) > 0 ) ) {
			$images_field_array = array();
		}
		
		foreach ( $images_field_array as $image_field ) {
			
			$meta_values = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = '" . $image_field . "'" );
			
			foreach ( $meta_values as $meta_value ) {
				$new_value = $this->edgtf_recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );
				
				$wpdb->update(
					$wpdb->postmeta,
					array(
						'meta_value' => $new_value,
					),
					array( 'meta_id' => $meta_value->meta_id )
				);
			}
		}
	}
	
	function edgtf_update_options_after_import( $folder ) {
		$url      = home_url( '/' );
		$demo_url = $this->edgtf_import_get_demo_url( $folder );
		
		$global_options    = get_option( 'edgtf_options_entropia' );
		$new_global_values = str_replace( $demo_url, $url, $global_options );
		
		update_option( 'edgtf_options_entropia', $new_global_values );
	}
	
	function edgtf_import_get_demo_url( $folder ) {
		$demo_url = defined( 'EDGE_PROFILE_SLUG' ) ? 'http://' . str_replace( '/', '', $folder ) . '.' . EDGE_PROFILE_SLUG . '-themes.com/' : '';
		
		return $demo_url;
	}
	
	function edgtf_recalc_serialized_lengths( $sObject ) {
		$ret = preg_replace_callback( '!s:(\d+):"(.*?)";!', 'edgtf_recalc_serialized_lengths_callback', $sObject );
		
		return $ret;
	}
	
	function edgtf_recalc_serialized_lengths_callback( $matches ) {
		return "s:" . strlen( $matches[2] ) . ":\"$matches[2]\";";
	}
}