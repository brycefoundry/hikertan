<?php

use WPS\Factories\DB_Orders_Factory;
use WPS\Factories\Webhooks_Factory;

$Webhooks = Webhooks_Factory::build();
$DB_Orders = DB_Orders_Factory::build();
$json_data = file_get_contents('php://input');

if ($Webhooks->webhook_verified($json_data, $Webhooks->get_header_hmac())) {

  $order = json_decode($json_data);

  // Hook: wps_on_product_update
  $Webhooks->on_order_updated($order);

  $DB_Orders->update_items_of_type($order);

  // Hook: wps_after_order_updated
  $Webhooks->after_order_updated($order);

} else {
  error_log('WP Shopify Error - Unable to verify webhook response from order-updated.php');
}
