<?php

namespace WPS\WS;

if (!defined('ABSPATH')) {
	exit;
}

use WPS\Utils;
use WPS\Transients;
use WPS\Messages;

class Collections extends \WPS\WS {

	protected $WS_Collections_Custom;
	protected $WS_Collections_Smart;
	protected $DB_Settings_General;
	protected $DB_Settings_Connection;
	protected $Shopify_API;


	public function __construct($WS_Collections_Smart, $WS_Collections_Custom, $DB_Settings_General, $DB_Settings_Connection, $Shopify_API) {

		$this->WS_Collections_Smart 		= $WS_Collections_Smart;
		$this->WS_Collections_Custom 		= $WS_Collections_Custom;
		$this->DB_Settings_General 			= $DB_Settings_General;
		$this->DB_Settings_Connection 	= $DB_Settings_Connection;
		$this->Shopify_API							= $Shopify_API;

	}


	/*

	Gets all collections

	*/
	public function get_all_collections() {

		if (!Utils::valid_backend_nonce($_POST['nonce'])) {
			$this->send_error( Messages::get('nonce_invalid')  . ' (get_all_collections)');
		}

		if (!$this->DB_Settings_Connection->has_connection()) {
			$this->send_error( Messages::get('connection_not_found') . ' (get_all_collections)');
		}

		$collections_cache = Transients::get('wps_sync_by_collections');

		if ( !empty($collections_cache) ) {
			$this->send_success( maybe_unserialize($collections_cache) );
		}


		$param_limit 					= $this->DB_Settings_General->get_items_per_request();
		$smart_collections 		= $this->Shopify_API->get_smart_collections_per_page($param_limit, 1);
		$custom_collections 	= $this->Shopify_API->get_custom_collections_per_page($param_limit, 1);


		if (Utils::has($smart_collections, 'errors')) {
			$this->send_error($smart_collections->errors);
		}

		if (Utils::has($custom_collections, 'errors')) {
			$this->send_error($custom_collections->errors);
		}



		$collections_merged = array_merge($smart_collections->smart_collections, $custom_collections->custom_collections);



		if (!empty($collections_merged)) {

			$collections_merged_final_reduced = array_map( function($collection) {

				$new_collection_obj = new \stdClass();
				$new_collection_obj->id = $collection->id;
				$new_collection_obj->title = $collection->title;

				return $new_collection_obj;

			}, $collections_merged);

			$collections_serialized = maybe_serialize($collections_merged_final_reduced);

			Transients::set('wps_sync_by_collections', $collections_serialized);

			$this->send_success($collections_merged);

		}


	}






	/*

	Hooks

	*/
	public function hooks() {

		add_action('wp_ajax_get_all_collections', [$this, 'get_all_collections']);
		add_action('wp_ajax_nopriv_get_all_collections', [$this, 'get_all_collections']);

	}


	/*

	Init

	*/
	public function init() {
		$this->hooks();
	}


}
