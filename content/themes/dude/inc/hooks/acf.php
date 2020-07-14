<?php
/**
 * ACF hooks.
 *
 * @package dude
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by: Roni Laukkarinen
 * @Last Modified time: 2020-07-03 15:48:50
 */

// Save merch stock to our custom post meta instead of ACF's
add_filter( 'acf/save_post', 'dude_merch_stock_save', 5 );
function dude_merch_stock_save( $post_id ) {

  // Bail early if no ACF data
  if ( empty( $_POST['acf'] ) ) { // phpcs:ignore
		return;
  }

  $stock = array();

  if ( ! isset( $_POST['acf']['field_5ce9670017057'] ) ) { // phpcs:ignore
		return;
  }

  // Loop models
  foreach ( $_POST['acf']['field_5ce9670017057'] as $model ) { // phpcs:ignore

		// Continue to next if no stock
		if ( empty( $model['field_5ce967501705b'] ) || empty( $model['field_5ce9672317058'] ) ) {
		  continue;
			}

		$stock_key = sanitize_title( $model['field_5ce9672317058'] );

		// Loop stock
		foreach ( $model['field_5ce967501705b'] as $stock_item ) {
		  $stock[ $stock_key ][ $stock_item['field_5ce967681705c'] ] = $stock_item['field_5ce967731705d'];
			}
  }

  update_post_meta( $post_id, '_stock', $stock );

  // Unset the acf field and prevent it from saving
  unset( $_POST['acf']['field_5cb59e0006657'] ); // phpcs:ignore
} // End function dude_merch_stock_save

add_filter( 'acf/load_value/name=models', 'dude_merch_stock', 10, 3 );
function dude_merch_stock( $value, $post_id, $field ) {
  $stock = get_post_meta( $post_id, '_stock', true );
  $stock_acf = array();

  if ( empty( $stock ) ) {
		return;
  }

  foreach ( $value as $model_key => $model ) {
		$stock_key = sanitize_title( $model['field_5ce9672317058'] );

		if ( empty( $stock[ $stock_key ] ) ) {
		  continue;
			}

		$stock_items = array();
		foreach ( $stock[ $stock_key ] as $stock_item_name => $stock_item_value ) {
		  $stock_items[] = array(
			'field_5ce967681705c' => $stock_item_name,
			'field_5ce967731705d' => $stock_item_value,
		  );
			}

		$value[ $model_key ]['field_5ce967501705b'] = $stock_items;
  }

  return $value;
} // End function dude_merch_stock
