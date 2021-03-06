<?php

use WPS\Transients;
use WPS\Factories\DB_Collections_Factory;
use WPS\Factories\Webhooks_Factory;
use WPS\Factories\DB_Collects_Factory;
use WPS\Factories\WS_Collects_Factory;
use WPS\Factories\CPT_Model_Factory;

$Webhooks           = Webhooks_Factory::build();
$DB_Collections     = DB_Collections_Factory::build();
$DB_Collects        = DB_Collects_Factory::build();
$WS_Collects        = WS_Collects_Factory::build();
$CPT_Model          = CPT_Model_Factory::build();
$json_data          = file_get_contents('php://input');


if ($Webhooks->webhook_verified($json_data, $Webhooks->get_header_hmac()) ) {

  $collection = json_decode($json_data);

  // Hook: before collection update
  $Webhooks->on_collections_update($collection);


  $post_id            = $CPT_Model->insert_or_update_collection_post($collection);
  $collects_result    = $DB_Collects->modify_from_shopify(
                          $DB_Collects->modify_options(
                            $WS_Collects->get_collects_from_collection($collection),
                            WPS_COLLECTIONS_LOOKUP_KEY
                          )
                        );

  $collection_result  = $DB_Collections->update_items_of_type( $DB_Collections->mod_before_change($collection, $post_id) );

  Transients::delete_cached_single_collection_by_id($post_id);
  Transients::delete_cached_collection_queries();
  

  // Hook: After collection update
  $Webhooks->after_collection_update($collection);

} else {
  error_log('WP Shopify Error - Unable to verify webhook response from collections-update.php');
}
