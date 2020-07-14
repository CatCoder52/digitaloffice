<?php
/**
 * Gutenberg related hooks.
 *
 * @package dude
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by: Roni Laukkarinen
 * @Last Modified time: 2020-07-03 15:48:50
 */

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

add_filter( 'use_block_editor_for_post_type', 'dude_gutenberg_can_edit_post_type', 10, 2 );
function dude_gutenberg_can_edit_post_type( $can_edit, $post_type ) {
  if ( 'page' === $post_type ) {
		return false;
  }

  return $can_edit;
}
