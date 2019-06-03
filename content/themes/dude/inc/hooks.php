<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-25 17:40:42
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-03 11:58:30
 *
 * @package dude2019
 */

/**
 * Show archives
 */
add_filter( 'air_helper_disable_views_tag', '__return_false' );
add_filter( 'air_helper_disable_views_category', '__return_false' );
add_filter( 'air_helper_disable_views_author', '__return_false' );

/**
 * Disable the custom color picker in Gutenberg.
 */
function bauermedia_gutenberg_disable_custom_colors() {
  add_theme_support( 'editor-color-palette' );
  add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'bauermedia_gutenberg_disable_custom_colors' );

/**
 * Enable Gutenberg extra features.
 */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );

add_action( 'admin_init', 'dude_maybe_hide_editor' );
function dude_maybe_hide_editor() {
  if ( ! isset( $_GET['post'] ) ) { // @codingStandardsIgnoreLine
    return;
  }

  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID']; // @codingStandardsIgnoreLine

  if ( ! isset( $post_id ) ) {
    return;
  }

  $template = get_page_template_slug( $post_id );

  if ( 'template-open-position.php' !== $template ) {
    remove_post_type_support( 'page', 'editor' );
  }
}

// Pre_get_posts for some archives
add_action( 'pre_get_posts', 'dude_pre_get_posts' );
function dude_pre_get_posts( $query ) {
  if ( $query->is_main_query() && $query->is_post_type_archive( 'reference' ) ) {
    $query->set( 'posts_per_page', 100 );
  }
}

// Save merch stock to our custom post meta instead of ACF's
add_filter( 'acf/save_post', 'dude_merch_stock_save', 5 );
function dude_merch_stock_save( $post_id ) {

  // Bail early if no ACF data
  if ( empty( $_POST['acf'] ) ) { // phpcs:ignore
    return;
  }

  $stock = array();

  if ( ! isset( $_POST['acf']['field_5ce9670017057'] ) ) {
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
  unset( $_POST['acf']['field_5cb59e0006657'] );
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

add_filter( 'use_block_editor_for_post_type', 'dude_gutenberg_can_edit_post_type', 10, 2 );
function dude_gutenberg_can_edit_post_type( $can_edit, $post_type ) {
  if ( 'page' === $post_type ) {
    return false;
  }

  return $can_edit;
}

//add_filter( 'gform_submit_button', 'dude_gform_submit_button', 10, 2 );
function dude_gform_submit_button( $button, $form ) {

  $arrow_dom = new DOMDocument();
  $arrow = $arrow_dom->createElement( 'span' );
  $arrow->setAttribute( 'class', 'arrow' );

  $dom = new DOMDocument( '1.0', 'UTF-8' );

  $dom->loadHTML( '<?xml encoding="UTF-8">' . $button );
  $new_arrow = $dom->importNode( $arrow );
  $input = $dom->getElementsByTagName( 'input' )->item(0);
  $new_button = $dom->createElement( 'button' );
  $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
  $new_button->appendChild( $new_arrow );
  $input->removeAttribute( 'value' );

  foreach ( $input->attributes as $attribute ) {
    $new_button->setAttribute( $attribute->name, $attribute->value );
  }

  $input->parentNode->replaceChild( $new_button, $input );

  return $dom->saveHtml( $new_button );
}

function dude_get_custom_excerpt_length( $excerpt = '' ) {
  $split = preg_split( '/(\. |\!|\?)/', $excerpt, 3, PREG_SPLIT_DELIM_CAPTURE );
  $new_excerpt = implode( '', array_slice( $split, 0, 4 ) );

  return $new_excerpt;
} // end function dude_get_custom_excerpt_length

add_filter( 'get_the_excerpt', 'dude_get_the_excerpt', 10, 2 );
function dude_get_the_excerpt( $excerpt, $post = null ) {
  return dude_get_custom_excerpt_length( $excerpt );
} // end function dude_get_the_excerpt
