<?php

namespace WPS\WS;

if (!defined('ABSPATH')) {
	exit;
}

use WPS\Utils;
use WPS\Messages;


class Orders extends \WPS\WS {

	protected $DB_Orders;
	protected $DB_Settings_General;
	protected $DB_Settings_Syncing;
	protected $Async_Processing_Orders_Factory;
	protected $Shopify_API;

	public function __construct($DB_Orders, $DB_Settings_General, $DB_Settings_Syncing, $Async_Processing_Orders_Factory, $Shopify_API) {

		$this->DB_Orders 												= $DB_Orders;
		$this->DB_Settings_General 							= $DB_Settings_General;
		$this->DB_Settings_Syncing							=	$DB_Settings_Syncing;
		$this->Async_Processing_Orders_Factory	= $Async_Processing_Orders_Factory;
		$this->Shopify_API											= $Shopify_API;

	}


	public function get_orders_count() {


		if (!Utils::valid_backend_nonce($_POST['nonce'])) {
			$this->send_error( Messages::get('nonce_invalid') . ' (get_orders_count)' );
		}


		$orders = $this->Shopify_API->get_orders_count('any');


		if ( is_wp_error($orders) ) {
			$this->DB_Settings_Syncing->save_notice_and_stop_sync($orders);
			$this->send_error($orders->get_error_message() . ' (get_orders_count)');
		}

		if (Utils::has($orders, 'count')) {
			$this->send_success(['orders' => $orders->count]);

		} else {
			$this->send_warning( Messages::get('orders_not_found') . ' (get_orders_count)' );
		}

	}


	/*

	Only returns note attribute with name 'cartID'

	*/
	private static function filter_order_note_attributes_by_cart_id($attribute) {
		return $attribute->name === 'cartID';
	}


	/*

	Filters order note attributes by car ID

	*/
	private static function get_cart_id_from_order_note_attributes($order) {
		return array_filter($order->note_attributes, [__CLASS__, 'filter_order_note_attributes_by_cart_id']);
	}


	/*

	Get cart id from order

	*/
	public static function get_cart_id_from_order($order) {

		$cartID = self::get_cart_id_from_order_note_attributes($order);

		if (is_array($cartID) && isset($cartID[0]->value)) {
			return $cartID[0]->value;

		} else {
			return false;

		}

	}


	public function get_bulk_orders() {

		// First make sure nonce is valid
		if (!Utils::valid_backend_nonce($_POST['nonce'])) {
			$this->send_error( Messages::get('nonce_invalid') . ' (get_bulk_orders)' );
		}

		// Grab orders from Shopify
		$param_limit 						= $this->DB_Settings_General->get_items_per_request();
		$param_current_page 		= Utils::get_current_page($_POST);
		$param_status 					= 'any';

		$orders = $this->Shopify_API->get_orders_per_page($param_limit, $param_current_page, $param_status);

		// Check if error occured during request
		if (is_wp_error($orders)) {
			$this->send_error($orders->get_error_message() . ' (get_bulk_orders)');
		}

		// Fire off our async processing builds ...
		if (Utils::has($orders, 'orders')) {

			$this->Async_Processing_Orders_Factory->insert_orders_batch($orders->orders);
			$this->send_success($orders->orders);

		} else {

			// Just because the user doesnt have orders doesn't mean we should end the sync
			$this->DB_Settings_Syncing->save_notice( Messages::get('missing_orders_for_page'), 'warning' );
			$this->send_success();

		}

	}


	/*

	Hooks

	*/
	public function hooks() {

		add_action( 'wp_ajax_get_bulk_orders', [$this, 'get_bulk_orders']);
		add_action( 'wp_ajax_nopriv_get_bulk_orders', [$this, 'get_bulk_orders']);

		add_action( 'wp_ajax_get_orders_count', [$this, 'get_orders_count']);
		add_action( 'wp_ajax_nopriv_get_orders_count', [$this, 'get_orders_count']);

	}


	/*

	Init

	*/
	public function init() {
		$this->hooks();
	}





}
