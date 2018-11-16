<?php

use WPS\Transients;
use WPS\WS\Orders;
use WPS\Factories\DB_Orders_Factory;
use WPS\Factories\Webhooks_Factory;

$Webhooks = Webhooks_Factory::build();
$DB_Orders = DB_Orders_Factory::build();
$json_data = file_get_contents('php://input');

if ($Webhooks->webhook_verified($json_data, $Webhooks->get_header_hmac())) {

  $order = json_decode($json_data);

  // Hooks: wps_on_order_paid
  $Webhooks->on_order_paid($order);

  Transients::delete_single('wps_cart_' . Orders::get_cart_id_from_order($order) );

  $DB_Orders->update_items_of_type($order);

  // Hook: wps_after_order_paid
  $Webhooks->after_order_paid($order);

  do_action('wps_webhook_checkouts_order_paid', $order); // Deprecated. Need to leave for backwards compatibility.

} else {
  error_log('WP Shopify Error - Unable to verify response from order-paid webhook');
}
