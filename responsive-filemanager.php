<?php
	/*
	Plugin Name: Responsive Filemanager
	Plugin URI: https://akismet.com/
	Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="https://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.
	Version: 3.2
	Author: Automattic
	Author URI: https://automattic.com/wordpress-plugins/
	License: GPLv2 or later
	Text Domain: responsive-filemanager
	*/
	
	ini_set( 'error_reporting', E_ALL );
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	
	$upload_dir = wp_upload_dir();
	
	define( 'RF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	define( 'RF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	define( 'RF_UPLOADS_DIR', $upload_dir['basedir'] . '/' );
	define( 'RF_ACF_INTEGRATION', true );
	define( 'RF_ACCESS_KEY', md5( 'rf-admin' ) );
	
	if ( RF_ACF_INTEGRATION ) {
		require_once RF_PLUGIN_PATH."/ext/acf-field-type-template/acf-rfm-field/acf-rfm-field.php";
	}
	
	function mce_custom( $init ) {
		$init['filemanager_title']         = "Responsive Filemanager";
		$init['image_advtab']              = true;
		$opts                              = '*[*]';
		$init['valid_elements']            = $opts;
		$init['extended_valid_elements']   = $opts;
		$init['plugins']                   = $init['plugins'] . ",responsivefilemanager,tabfocus,paste,media,wordpress,wpeditimage,wpgallery,wplink,wpdialogs";
		$init['external_filemanager_path'] = '/wp-content/plugins/responsive-filemanager/ext/responsive_filemanager/filemanager/';
		$init['filemanager_access_key']    = RF_ACCESS_KEY;
		$init['toolbar3']                  = "responsivefilemanager,image media";
		
		return $init;
	}
	
	add_filter( 'tiny_mce_before_init', 'mce_custom', 14 );
	
	/**
	 * Add the TinyMCE VisualBlocks Plugin.
	 *
	 * @param array $plugins An array of all plugins.
	 *
	 * @return array
	 */
	function my_custom_plugins( $plugins ) {
		$plugins['responsivefilemanager'] = RF_PLUGIN_URL . 'ext/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js';
		
		return $plugins;
	}
	
	add_filter( 'mce_external_plugins', 'my_custom_plugins' );