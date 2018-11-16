<?php

use WPS\Transients;
use WPS\CPT as CPT_Main;
use WPS\Factories\DB_Variants_Factory;
use WPS\Factories\DB_Options_Factory;
use WPS\Factories\DB_Images_Factory;
use WPS\Factories\DB_Tags_Factory;
use WPS\Factories\DB_Products_Factory;
use WPS\Factories\DB_Collects_Factory;
use WPS\Factories\WS_Collects_Factory;
use WPS\Factories\CPT_Model_Factory;
use WPS\Factories\Webhooks_Factory;

$Webhooks           = Webhooks_Factory::build();
$CPT_Model          = CPT_Model_Factory::build();
$DB_Products        = DB_Products_Factory::build();
$DB_Tags            = DB_Tags_Factory::build();
$DB_Variants        = DB_Variants_Factory::build();
$DB_Options         = DB_Options_Factory::build();
$DB_Images          = DB_Images_Factory::build();
$DB_Collects        = DB_Collects_Factory::build();
$WS_Collects        = WS_Collects_Factory::build();
$json_data          = file_get_contents('php://input');


if ($Webhooks->webhook_verified($json_data, $Webhooks->get_header_hmac())) {

  $product = json_decode($json_data);

  // Needed because of discrepancies between Shopify's API Product and ProductListing endpoints
  $product = $product->product_listing;
  $product = $DB_Products->switch_shopify_ids($product, 'product_id', 'id');

  // Hook: wps_on_product_create
  $Webhooks->on_product_create($product);

  $post_id            = $CPT_Model->insert_or_update_product_post($product);
  $variants_result    = $DB_Variants->modify_from_shopify( $DB_Variants->modify_options( $DB_Variants->maybe_add_product_id_to_variants($product) ) );
  $options_result     = $DB_Options->modify_from_shopify( $DB_Options->modify_options($product) );
  $images_result      = $DB_Images->modify_from_shopify( $DB_Images->modify_options($product) );
  $collects_result    = $DB_Collects->modify_from_shopify( $DB_Collects->modify_options( $WS_Collects->get_collects_from_product($product) ) );

  $tags_result        = $DB_Tags->modify_from_shopify(
                          $DB_Tags->modify_options(
                            $DB_Tags->add_tags_to_product(
                              $DB_Tags->construct_tags_for_insert($product, $post_id),
                              $product
                            )
                          )
                        );

  $products_result    = $DB_Products->insert_items_of_type( $DB_Products->mod_before_change($product, $post_id) );

  Transients::delete_cached_product_queries();
  Transients::delete_cached_product_single();

  // Hook: wps_on_product_create
  $Webhooks->after_product_create($product);


} else {
  error_log('WP Shopify Error - Unable to verify webhook response from product-create.php');

}
