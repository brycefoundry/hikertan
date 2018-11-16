<?php

namespace WPS\WS;

use WPS\Utils;
use WPS\Messages;

if (!defined('ABSPATH')) {
	exit;
}


class Webhooks extends \WPS\WS {

	protected $DB_Settings_Syncing;
	protected $Webhooks;
	protected $Async_Processing_Webhooks;
	protected $Async_Processing_Webhooks_Deletions;
	protected $Shopify_API;

	public function __construct($DB_Settings_Syncing, $Webhooks, $Async_Processing_Webhooks, $Async_Processing_Webhooks_Deletions, $Shopify_API) {

		$this->DB_Settings_Syncing									= $DB_Settings_Syncing;
		$this->Webhooks															= $Webhooks;
		$this->Async_Processing_Webhooks 						= $Async_Processing_Webhooks;
		$this->Async_Processing_Webhooks_Deletions	= $Async_Processing_Webhooks_Deletions;
		$this->Shopify_API													= $Shopify_API;

	}


	public function get_webhooks_count() {

		if (!Utils::valid_backend_nonce($_POST['nonce'])) {
			$this->send_error( Messages::get('nonce_invalid') . ' (get_webhooks_count)' );
		}

		$this->send_success(['webhooks' => WPS_TOTAL_WEBHOOKS_COUNT]);

	}


	public function register_webhooks($webhooks) {

		if ($this->DB_Settings_Syncing->is_syncing()) {
			$this->Async_Processing_Webhooks->insert_webhooks_batch($webhooks);
		}

	}


	public function register_all_webhooks() {

		if (isset($_POST['webhooksReconnect']) && !$_POST['webhooksReconnect']) {
			$this->send_success();

		} else {

			$this->register_webhooks( $this->Webhooks->default_topics() );
			$this->send_success();

		}

	}


	public function get_webhooks() {

		if ( !Utils::valid_backend_nonce($_POST['nonce']) ) {
			$this->send_error( Messages::get('nonce_invalid') . ' (get_webhooks)' );
		}

		// HTTP request
		$webhooks = $this->Shopify_API->get_webhooks();

		if ( is_wp_error($webhooks) ) {
			$this->send_error($webhooks->get_error_message() . ' (get_webhooks)');

		} else {
			$this->send_warning( Messages::get('webhooks_not_found') . ' (get_webhooks)' );
		}

		if (Utils::has($webhooks, 'webhooks')) {
			$this->send_success($webhooks);
		}

	}



	public function delete_webhooks() {

		// HTTP request
		$webhooks = $this->Shopify_API->get_webhooks();

		if ( is_wp_error($webhooks) ) {
			$this->DB_Settings_Syncing->save_notice_and_stop_sync($webhooks);
			$this->send_error($webhooks->get_error_message() . ' (delete_webhooks)');
		}

		if ( Utils::has($webhooks, 'webhooks') && !empty($webhooks->webhooks) ) {

			$this->DB_Settings_Syncing->set_finished_webhooks_deletions(0);
			$this->Async_Processing_Webhooks_Deletions->delete_webhooks_batch($webhooks->webhooks);

		} else {

			$this->send_success( $this->DB_Settings_Syncing->set_finished_webhooks_deletions(1) );

		}

	}


	public function hooks() {

		add_action( 'wp_ajax_register_all_webhooks', [$this, 'register_all_webhooks']);
		add_action( 'wp_ajax_nopriv_register_all_webhooks', [$this, 'register_all_webhooks']);

		add_action( 'wp_ajax_get_webhooks', [$this, 'get_webhooks'] );
		add_action( 'wp_ajax_nopriv_get_webhooks', [$this, 'get_webhooks'] );

		add_action( 'wp_ajax_get_webhooks_count', [$this, 'get_webhooks_count']);
		add_action( 'wp_ajax_nopriv_get_webhooks_count', [$this, 'get_webhooks_count']);

		add_action( 'wp_ajax_delete_webhooks', [$this, 'delete_webhooks']);
		add_action( 'wp_ajax_nopriv_delete_webhooks', [$this, 'delete_webhooks']);

	}


	public function init() {
		$this->hooks();
	}





}
