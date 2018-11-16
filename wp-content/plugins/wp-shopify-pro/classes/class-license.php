<?php

namespace WPS;

use WPS\Utils;

if (!defined('ABSPATH')) {
	exit;
}


class License {

	private $DB_Settings_License;
	private $WS_Settings_License;
	private $DB_Settings_General;


	public function __construct($WS_Settings_License, $DB_Settings_License, $DB_Settings_General) {

		$this->WS_Settings_License				= $WS_Settings_License;
		$this->DB_Settings_License				= $DB_Settings_License;
		$this->DB_Settings_General				= $DB_Settings_General;

	}


	/*

	check_for_updates

	*/
	public function check_for_updates() {

		$license = $this->DB_Settings_License->get();

		if (empty($license)) {
			return;
		}

		/*

		This is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
		you should use your own CONSTANT name, and be sure to replace it throughout this file

		*/
		if(!defined('EDD_SL_STORE_URL')) {
			define( 'EDD_SL_STORE_URL', WPS_PLUGIN_ENV );
		}

		// The name of your product. This should match the download name in EDD exactly
		if (!defined('EDD_SAMPLE_ITEM_ID') ) {
			define( 'EDD_SAMPLE_ITEM_ID', 35 );
		}

		// load our custom updater
		if ( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			include( WPS_PLUGIN_DIR_PATH . 'vendor/EDD/EDD_SL_Plugin_Updater.php' );
		}

		// Setup the updater
		// Calls the init() function within the constructor
		$edd_updater = new \EDD_SL_Plugin_Updater( EDD_SL_STORE_URL, WPS_PLUGIN_ROOT_FILE, array(
				'version' 			=> WPS_NEW_PLUGIN_VERSION,
				'license' 			=> $license->license_key,
				'item_name'     => WPS_PLUGIN_NAME_FULL,
				'item_id'     	=> EDD_SAMPLE_ITEM_ID,
				'author' 				=> WPS_PLUGIN_NAME_FULL,
				'url'           => home_url(),
				'beta'          => $this->DB_Settings_General->get_enable_beta()
			)
		);

		return $edd_updater;

	}


	/*

	Invalid key notice

	*/
	public function activate_key_notice($plugin_file, $plugin_data, $status) {

		$allowed_tags = array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			)
		);

		echo '<tr class="plugin-update-tr active update">';
		echo '<td colspan="3" class="plugin-update colspanchange">';
		echo '<div class="update-message notice inline notice-warning notice-alt">';
		echo '<p>';

		printf(__('Make sure to <a href="%1$sadmin.php?page=wps-settings&tab=updates&activetab=tab-license">activate your license key</a> to receive plugin updates.', WPS_PLUGIN_TEXT_DOMAIN), esc_url(get_admin_url()), esc_url(WPS_PLUGIN_ENV . '/purchase'));


		echo '</p></div></td></tr>';

	}


	/*

	Init

	*/
	public function init() {

		/*

		Important to check this. Otherwise it can conflict with other plugins that also use EDD
		resulting in a fatal error.

		*/
		if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			include( WPS_PLUGIN_DIR_PATH . 'vendor/EDD/EDD_SL_Plugin_Updater.php' );
		}

		if (is_admin()) {

			if ( $this->WS_Settings_License->has_valid_key() ) {

				$EDD_Updater = $this->check_for_updates();

			} else {

				add_filter( 'site_transient_update_plugins', function ($value) {

					if (is_object($value)) {
						unset( $value->response[WPS_PLUGIN_ROOT_FILE] );
						return $value;
					}

				});

				/*

				TODO: Remove and modify the outputted plugin <tr> eventually

				*/
				add_filter('admin_body_class', function($classes) {
					return $classes . ' wps-is-notifying';
				});

				add_action( "after_plugin_row_" . WPS_PLUGIN_ROOT_FILE, [$this, 'activate_key_notice'], 999, 3 );

			}

		}

	}

}