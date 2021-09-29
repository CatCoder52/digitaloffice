<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:33:00
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-09-29 09:59:44
 *
 * @package dude
 */

add_action( 'init', 'dude_register_cpt_merch' );
function dude_register_cpt_merch() {
  $labels = array(
    'name'               => _x( 'Merchit', 'post type general name', 'dude' ),
    'singular_name'      => _x( 'Merch', 'post type singular name', 'dude' ),
    'menu_name'          => _x( 'Merchit', 'admin menu', 'dude' ),
    'name_admin_bar'     => _x( 'Merch', 'add new on admin bar', 'dude' ),
    'add_new'            => _x( 'Lisää merchi', 'example', 'dude' ),
    'add_new_item'       => __( 'Lisää uusi merchi', 'dude' ),
    'new_item'           => __( 'Uusi merchi', 'dude' ),
    'edit_item'          => __( 'Muokkaa merchiä', 'dude' ),
    'view_item'          => __( 'Katsele merchiä', 'dude' ),
    'all_items'          => __( 'Kaikki merchit', 'dude' ),
    'search_items'       => __( 'Etsi merchiä', 'dude' ),
    'parent_item_colon'  => __( 'Tyypin isäntä:', 'dude' ),
    'not_found'          => __( 'Merchejä ei löytynyt.', 'dude' ),
    'not_found_in_trash' => __( 'Merchejä ei löytynyt roskista.', 'dude' ),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true, // Make true in production
    'publicly_queryable' => true, // Make true in production
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => false,
    'capability_type'    => 'post',
    'has_archive'        => true, // Make true in production
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-products',
    'supports'           => array(
      'title',
      'thumbnail',
      'page-attributes',
      'revisions',
    ),
  );

  register_post_type( 'merch', $args );
}

add_action( 'template_redirect', function() {
  if ( ! is_singular( 'merch' ) ) {
    return;
  }

  wp_safe_redirect( get_post_type_archive_link( 'merch' ) );
  exit;
} );

add_filter( 'simpay_form_4535_payment_success_page', function( $url ) {
  $url = add_query_arg( 'rs', 'y', $url );
  return $url;
} );

add_filter( 'simpay_payment_confirmation_content', function( $content, $payment_data ) {
  if ( ! isset( $_GET['rs'] ) ) {
    return $content;
  }

  if ( 'y' !== $_GET['rs'] ) {
    return $content;
  }

  if ( ! isset( $payment_data['paymentintents'][0]->metadata->products_json ) ) {
    return $content;
  }

  $products = json_decode( $payment_data['paymentintents'][0]->metadata->products_json, true );

  if ( ! is_array( $products ) ) {
    return $content;
  }

  foreach ( $products as $product ) {
    $models = get_post_meta( absint( $product['product'] ), '_stock', true );
    if ( ! is_array( $models ) ) {
      continue;
    }

    foreach ( $models as $model_key => $model_stock ) {
      if ( sanitize_title( $product['modelname'] ) !== $model_key ) {
        continue;
      }

      foreach ( $model_stock as $stock_key => $stock ) {
        if ( mb_strtoupper( $product['size'] ) !== $stock_key ) {
          continue;
        }

        $new_stock = absint( $stock ) - absint( $product['qty'] );

        $models[ $model_key ][ $stock_key ] = $new_stock;
      }
    }
  }

  update_post_meta( absint( $product['product'] ), '_stock', $models );

  $new_url = remove_query_arg( 'rs', "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" ); // phpcs:ignore
  $content .= '<meta http-equiv="refresh" content="0;url=' . $new_url . '" />';

  return $content;
}, 10, 2 );
