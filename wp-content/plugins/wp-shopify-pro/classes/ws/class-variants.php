<?php

namespace WPS\WS;

use WPS\Utils;
use WPS\Messages;

if (!defined('ABSPATH')) {
	exit;
}


class Variants extends \WPS\WS {

	protected $DB_Products;
	protected $DB_Variants;

	public function __construct($DB_Products, $DB_Variants) {

		$this->DB_Products 								= $DB_Products;
		$this->DB_Variants 								= $DB_Variants;

	}


	/*

	Find Variant ID from Options

	*/
	public function get_variant_id_from_product_options() {

		if (isset($_POST['selectedOptions']) && is_array($_POST['selectedOptions'])) {

			$selectedOptions = $_POST['selectedOptions'];

			// TODO: combine below two lines with get_variants
			$productData = $this->DB_Products->get_product_from_post_id($_POST['productID']);
			$variantData = $this->DB_Variants->get_in_stock_variants_from_post_id($_POST['productID']);

			// $productVariants = maybe_unserialize( unserialize( $productData['variants'] ));

			// TODO: Move to Utils
			function array_filter_key($ar, $callback = 'empty') {
				$ar = (array)$ar;
				return array_intersect_key($ar, array_flip(array_filter(array_keys($ar), $callback)));
			}

			// $productWithVariantsProperty = $productData
			$refinedVariants = [];
			$refinedVariantsOptions = [];


			foreach ($variantData as $key => $variant) {

				$refinedVariantsOptions = array_filter_key($variant, function($key) {
					return strpos($key, 'option') === 0;
				});


				$refinedVariants[] = [
					'variant_id' 					=> $variant->variant_id,
					'sku'									=> $variant->sku,
					'inventory_quantity'	=> $variant->inventory_quantity,
					'price'								=> $variant->price,
					'compare_at_price'		=> $variant->compare_at_price,
					'image_id'						=> $variant->image_id,
					'options' 						=> $refinedVariantsOptions
				];

			}


			$constructedOptions = Utils::construct_option_selections($selectedOptions);

			// TODO -- Breakout into own function
			$found = false;


			foreach ($refinedVariants as $key => $variant) {



				$clean_variants = array_filter($variant['options']);

				if (Utils::has_option_values_set($clean_variants)) {
					$option_values = Utils::get_options_values($clean_variants['option_values']);
					$clean_variants = Utils::clean_option_values($option_values);
				}



				if ( $clean_variants === $constructedOptions ) {

					$variant_obj = $this->DB_Variants->get_row_by('variant_id', $variant['variant_id']);
					$productData->variants = $variantData;

					if (Utils::product_inventory($productData, [ (array) $variant_obj ] )) {

						$found = true;
						$this->send_success($variant);

					} else {
						$this->send_error( Messages::get('products_out_of_stock') . ' (get_variant_id_from_product_options 3)' );
					}

				}

			}

			if (!$found) {
				$this->send_error( Messages::get('products_options_unavailable') . ' (get_variant_id_from_product_options 4)' );
			}

		} else {
			$this->send_error( Messages::get('products_options_not_found') . ' (get_variant_id_from_product_options 5)' );

		}

	}


	/*

	Hooks

	*/
	public function hooks() {

		add_action('wp_ajax_get_variants', [$this, 'get_variants']);
		add_action('wp_ajax_nopriv_get_variants', [$this, 'get_variants']);

		add_action('wp_ajax_get_variant_id_from_product_options', [$this, 'get_variant_id_from_product_options']);
		add_action('wp_ajax_nopriv_get_variant_id_from_product_options', [$this, 'get_variant_id_from_product_options']);

	}


	/*

	Init

	*/
	public function init() {
		$this->hooks();
	}


}
