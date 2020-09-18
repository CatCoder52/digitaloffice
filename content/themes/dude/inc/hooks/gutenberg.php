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
 * Enable Gutenberg extra features.
 */
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );

// Button block: Allow for setting custom link class
// @link https://github.com/WordPress/gutenberg/issues/14121#issuecomment-510585925
add_filter( 'render_block', function( $block_content, $block ) {

	// Button block additional class.
	$block_content = str_replace(
		'wp-block-button__link',
		'wp-block-button__link button-mint button-glitch',
		$block_content
	);

	return $block_content;

}, 5, 2 );

/**
 * Custom WP-Admin CSS
 */
add_action( 'admin_head', __NAMESPACE__ . '\dude_custom_css_js' );

function dude_custom_css_js() {
  echo '<style>
  #beacon-container {
    display: none !important;
  }
  </style>';
}
