<?php

use WPS\Transients;
use WPS\Factories\DB_Collects_Factory;
use WPS\Factories\DB_Collections_Factory;
use WPS\Factories\Webhooks_Factory;
use WPS\Factories\WS_CPT_Factory;

$DB_Collects       = DB_Collects_Factory::build();
$DB_Collections    = DB_Collections_Factory::build();
$Webhooks          = Webhooks_Factory::build();
$WS_CPT            = WS_CPT_Factory::build();
$json_data         = file_get_contents('php://input');


if ($Webhooks->webhook_verified($json_data, $Webhooks->get_header_hmac())) {

  $collection = json_decode($json_data);

  // Hook: on collection delete
  $Webhooks->on_collections_delete($collection);

  $post_result          = $WS_CPT->delete_posts_by_ids( $DB_Collections->find_post_id_from_collection_id($collection) );
  $collects_result      = $DB_Collects->delete_collects_from_collection_id($collection->id);
  $collection_result    = $DB_Collections->delete_collection_from_collection_id($collection->id);

  // Hook: After collection delete
  $Webhooks->after_collections_delete($collection);

  Transients::delete_cached_collection_queries();
  Transients::delete_cached_single_collections();

} else {
  error_log('WP Shopify Error - Unable to verify webhook response from collections-delete.php');
}
