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

/**
 * Hide classic editor
 */
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
 * Register Gutenberg blocks
 */
function dude_register_block_editor_assets() {
  $dependencies = array(
    'wp-blocks',    // Provides useful functions and components for extending the editor
    'wp-i18n',      // Provides localization functions
    'wp-element',   // Provides React.Component
    'wp-components', // Provides many prebuilt components and controls
  );

  // wp_register_script( 'dude-block-editor', get_theme_file_uri( 'js/src/block.js', __FILE__ ), $dependencies, null );
  wp_register_style( 'dude-block-editor', get_theme_file_uri( 'css/gutenberg.min.css', __FILE__ ), null, null );
}
add_action( 'admin_init',  'dude_register_block_editor_assets' );

// Front end side:
function dude_register_block_assets() {
  if ( is_admin() ) {
    // wp_register_script( 'dude-block', get_theme_file_uri( 'js/src/block.js', __FILE__ ), array( 'jquery' ), null, null, null, true );
    wp_register_style( 'dude-block', get_theme_file_uri( 'css/gutenberg.min.css', __FILE__ ), null, null );
  }
}
add_action( 'init',  'dude_register_block_assets' );

register_block_type( 'dude-plugin-namespace/dude-block', array(
  'editor_script' => 'dude-block-editor',
  'editor_style'  => 'dude-block-editor',
  'script'        => 'dude-block',
  'style'         => 'dude-block',
));

// Only allow certain blocks
// @link https://rudrastyh.com/gutenberg/remove-default-blocks.html
add_filter( 'allowed_block_types',  'dude_allowed_block_types' );

function dude_allowed_block_types( $allowed_blocks ) {

  return array(
    'core/image',
    'core/paragraph',
    'core/heading',
    'core/list',
    'core/heading',
    'core/gallery',
    'core/list',
    'core/pullquote',
    'core/quote',
    'core/file',
    'core/video',
    'core/html',
    'core/spacer',
    'core/table',
    'core/separator',

    // All blocks:
    //
    // core/paragraph
    // core/image
    // core/heading
    // (Deprecated) core/subhead — Subheading
    // core/gallery
    // core/list
    // core/quote
    // core/audio
    // core/cover (previously core/cover-image)
    // core/file
    // core/video
    // core/table
    // core/verse
    // core/code
    // core/freeform — Classic
    // core/html — Custom HTML
    // core/preformatted
    // core/pullquote
    // core/button
    // core/text-columns — Columns
    // core/media-text — Media and Text
    // core/more
    // core/nextpage — Page break
    // core/separator
    // core/spacer
    // core/shortcode
    // core/archives
    // core/categories
    // core/latest-comments
    // core/latest-posts
    // core/calendar
    // core/rss
    // core/search
    // core/tag-cloud
    // core/embed
    // core-embed/twitter
    // core-embed/youtube
    // core-embed/facebook
    // core-embed/instagram
    // core-embed/wordpress
    // core-embed/soundcloud
    // core-embed/spotify
    // core-embed/flickr
    // core-embed/vimeo
    // core-embed/animoto
    // core-embed/cloudup
    // core-embed/collegehumor
    // core-embed/dailymotion
    // core-embed/funnyordie
    // core-embed/hulu
    // core-embed/imgur
    // core-embed/issuu
    // core-embed/kickstarter
    // core-embed/meetup-com
    // core-embed/mixcloud
    // core-embed/photobucket
    // core-embed/polldaddy
    // core-embed/reddit
    // core-embed/reverbnation
    // core-embed/screencast
    // core-embed/scribd
    // core-embed/slideshare
    // core-embed/smugmug
    // core-embed/speaker
    // core-embed/ted
    // core-embed/tumblr
    // core-embed/videopress
    // core-embed/wordpress-tv
  );

}
