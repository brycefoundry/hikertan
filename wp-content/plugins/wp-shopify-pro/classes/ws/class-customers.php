<?php

namespace WPS\WS;

use WPS\Utils;
use WPS\Messages;

if (!defined('ABSPATH')) {
	exit;
}


class Customers extends \WPS\WS {

	protected $DB_Customers;
	protected $DB_Settings_Syncing;
	protected $DB_Settings_General;
	protected $Async_Processing_Customers;
	protected $Shopify_API;

	public function __construct($DB_Customers, $DB_Settings_Syncing, $DB_Settings_General, $Async_Processing_Customers, $Shopify_API) {

		$this->DB_Customers									= $DB_Customers;
		$this->DB_Settings_Syncing					= $DB_Settings_Syncing;
		$this->DB_Settings_General					= $DB_Settings_General;
		$this->Async_Processing_Customers		=	$Async_Processing_Customers;
		$this->Shopify_API									=	$Shopify_API;

	}

	public function get_customers_count() {

		if (!Utils::valid_backend_nonce($_POST['nonce'])) {
			$this->send_error( Messages::get('nonce_invalid') . ' (get_customers_count)' );
		}


		$customers = $this->Shopify_API->get_customers_count();

		if ( is_wp_error($customers) ) {
			$this->DB_Settings_Syncing->save_notice_and_stop_sync($customers);
			$this->send_error($customers->get_error_message() . ' (get_customers_count)');
		}

		if (Utils::has($customers, 'count')) {
			$this->send_success(['customers' => $customers->count]);

		} else {
			$this->send_warning( Messages::get('customers_not_found') . ' (get_customers_count)' );
		}


	}


	/*

	Get Bulk Cusomters

	Runs for each "page" of the Shopify API

	*/
	public function get_bulk_customers() {

		// First make sure nonce is valid
		if (!Utils::valid_backend_nonce($_POST['nonce'])) {
			$this->send_error( Messages::get('nonce_invalid') . ' (get_bulk_customers)' );
		}

		$param_limit 					= $this->DB_Settings_General->get_items_per_request();
		$param_current_page 	= Utils::get_current_page($_POST);
		$param_status 				= 'any';

		// Grab customers from Shopify
		$customers = $this->Shopify_API->get_customers_per_page($param_limit, $param_current_page, $param_status);

		// Check if error occured during request
		if (is_wp_error($customers)) {
			$this->send_error( $customers->get_error_message() . ' (get_bulk_customers)' );
		}

		// Fire off our async processing builds ...
		if (Utils::has($customers, 'customers')) {

			$this->Async_Processing_Customers->insert_customers_batch($customers->customers);
			$this->send_success($customers->customers);

		} else {

			$this->DB_Settings_Syncing->save_notice( Messages::get('missing_orders_for_page'), 'warning' );
			$this->send_success(); // Choosing not to end sync

		}

	}


	/*

	Hooks

	*/
	public function hooks() {

		add_action( 'wp_ajax_get_bulk_customers', [$this, 'get_bulk_customers']);
		add_action( 'wp_ajax_nopriv_get_bulk_customers', [$this, 'get_bulk_customers']);

		add_action( 'wp_ajax_get_customers_count', [$this, 'get_customers_count']);
		add_action( 'wp_ajax_nopriv_get_customers_count', [$this, 'get_customers_count']);

	}



	/*

	Init

	*/
	public function init() {
		$this->hooks();
	}





}
