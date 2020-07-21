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
 * Custom WP-Admin CSS
 */
add_action( 'admin_head', __NAMESPACE__ . '\dude_custom_css_js' );

function dude_custom_css_js() {
  echo '<style>
  @font-face {
    font-family: "Circular";
    src: url("' . get_template_directory_uri() . '/fonts/f5437dcddb7d5641ae51a8109a31fa53.eot");
    src: url("' . get_template_directory_uri() . '/fonts/f5437dcddb7d5641ae51a8109a31fa53.eot?#iefix") format("embedded-opentype"), url("' . get_template_directory_uri() . '/fonts/f5437dcddb7d5641ae51a8109a31fa53.woff") format("woff"), url("' . get_template_directory_uri() . '/fonts/f5437dcddb7d5641ae51a8109a31fa53.woff2") format("woff2"), url("' . get_template_directory_uri() . '/fonts/f5437dcddb7d5641ae51a8109a31fa53.ttf") format("truetype"), url("' . get_template_directory_uri() . '/fonts/f5437dcddb7d5641ae51a8109a31fa53.svg#Circular") format("svg");
    font-style: normal;
    font-weight: 400;
  }

  @font-face {
    font-family: "Circular";
    src: url("' . get_template_directory_uri() . '/fonts/d2eb57af9849479498a3aab358ef6c92.eot");
    src: url("' . get_template_directory_uri() . '/fonts/d2eb57af9849479498a3aab358ef6c92.eot?#iefix") format("embedded-opentype"), url("' . get_template_directory_uri() . '/fonts/d2eb57af9849479498a3aab358ef6c92.woff") format("woff"), url("' . get_template_directory_uri() . '/fonts/d2eb57af9849479498a3aab358ef6c92.woff2") format("woff2"), url("' . get_template_directory_uri() . '/fonts/d2eb57af9849479498a3aab358ef6c92.ttf") format("truetype"), url("' . get_template_directory_uri() . '/fonts/d2eb57af9849479498a3aab358ef6c92.svg#Circular") format("svg");
    font-style: italic;
    font-weight: 400;
  }

  @font-face {
    font-family: "Circular";
    src: url("' . get_template_directory_uri() . '/fonts/86a7bec49ba4953ef59891e1597151d1.eot");
    src: url("' . get_template_directory_uri() . '/fonts/86a7bec49ba4953ef59891e1597151d1.eot?#iefix") format("embedded-opentype"), url("' . get_template_directory_uri() . '/fonts/86a7bec49ba4953ef59891e1597151d1.woff") format("woff"), url("' . get_template_directory_uri() . '/fonts/86a7bec49ba4953ef59891e1597151d1.woff2") format("woff2"), url("' . get_template_directory_uri() . '/fonts/86a7bec49ba4953ef59891e1597151d1.ttf") format("truetype"), url("' . get_template_directory_uri() . '/fonts/86a7bec49ba4953ef59891e1597151d1.svg#Circular") format("svg");
    font-style: normal;
    font-weight: 500;
  }

  @font-face {
    font-family: "Circular";
    src: url("' . get_template_directory_uri() . '/fonts/469779bbfe42049602ae0c100c517e90.eot");
    src: url("' . get_template_directory_uri() . '/fonts/469779bbfe42049602ae0c100c517e90.eot?#iefix") format("embedded-opentype"), url("' . get_template_directory_uri() . '/fonts/469779bbfe42049602ae0c100c517e90.woff") format("woff"), url("' . get_template_directory_uri() . '/fonts/469779bbfe42049602ae0c100c517e90.woff2") format("woff2"), url("' . get_template_directory_uri() . '/fonts/469779bbfe42049602ae0c100c517e90.ttf") format("truetype"), url("' . get_template_directory_uri() . '/fonts/469779bbfe42049602ae0c100c517e90.svg#Circular") format("svg");
    font-style: italic;
    font-weight: 500;
  }

  @font-face {
    font-family: "Circular";
    src: url("' . get_template_directory_uri() . '/fonts/0fe7d5a9ec1ccd7bf994e3bbe8cd4c10.eot");
    src: url("' . get_template_directory_uri() . '/fonts/0fe7d5a9ec1ccd7bf994e3bbe8cd4c10.eot?#iefix") format("embedded-opentype"), url("' . get_template_directory_uri() . '/fonts/0fe7d5a9ec1ccd7bf994e3bbe8cd4c10.woff") format("woff"), url("' . get_template_directory_uri() . '/fonts/0fe7d5a9ec1ccd7bf994e3bbe8cd4c10.woff2") format("woff2"), url("' . get_template_directory_uri() . '/fonts/0fe7d5a9ec1ccd7bf994e3bbe8cd4c10.ttf") format("truetype"), url("' . get_template_directory_uri() . '/fonts/0fe7d5a9ec1ccd7bf994e3bbe8cd4c10.svg#Circular") format("svg");
    font-style: normal;
    font-weight: 700;
  }

  @font-face {
    font-family: "Circular";
    src: url("' . get_template_directory_uri() . '/fonts/e964570c740cb80bd168ac14fbd51b4f.eot");
    src: url("' . get_template_directory_uri() . '/fonts/e964570c740cb80bd168ac14fbd51b4f.eot?#iefix") format("embedded-opentype"), url("' . get_template_directory_uri() . '/fonts/e964570c740cb80bd168ac14fbd51b4f.woff") format("woff"), url("' . get_template_directory_uri() . '/fonts/e964570c740cb80bd168ac14fbd51b4f.woff2") format("woff2"), url("' . get_template_directory_uri() . '/fonts/e964570c740cb80bd168ac14fbd51b4f.ttf") format("truetype"), url("' . get_template_directory_uri() . '/fonts/e964570c740cb80bd168ac14fbd51b4f.svg#Circular") format("svg");
    font-style: normal;
    font-weight: 900;
  }
  </style>';
}

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

  wp_register_style( 'dude-block-editor', get_theme_file_uri( 'css/gutenberg.min.css', __FILE__ ), null, null ); // phpcs:ignore
}
add_action( 'admin_init',  'dude_register_block_editor_assets' );

// Front end side:
function dude_register_block_assets() {
  if ( is_admin() ) {
    wp_register_style( 'dude-block', get_theme_file_uri( 'css/gutenberg.min.css', __FILE__ ), null, null ); // phpcs:ignore
  }
}
add_action( 'init',  'dude_register_block_assets' );

register_block_type( 'dude-plugin-namespace/dude-block', array(
  'editor_script' => 'dude-block-editor',
  'editor_style'  => 'dude-block-editor',
  'script'        => 'dude-block',
  'style'         => 'dude-block',
));
