<?php
/**
 * The current version of the theme.
 *
 * @package dude
 */

define( 'AIR_LIGHT_VERSION', '4.6.5' );

/**
 * Requires.
 */
require get_theme_file_path( '/inc/hooks.php' );
require get_theme_file_path( '/inc/functions.php' );
require get_theme_file_path( '/inc/ama.php' );

/**
 *  Content.
 */
require get_theme_file_path( '/inc/cpt/reference.php' );
require get_theme_file_path( '/inc/cpt/person.php' );
require get_theme_file_path( '/inc/cpt/merch.php' );
require get_theme_file_path( '/inc/cpt/order.php' );
require get_theme_file_path( '/inc/cpt/ama.php' );

/**
 * Enable theme support for essential features.
 */
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

/**
 * Load textdomain.
 */
load_theme_textdomain( 'dude', get_template_directory() . '/languages' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _dude_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'dude' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'dude' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', '_dude_widgets_init' );

/**
 * Returns the built asset filename and path depending on
 * current environment.
 *
 * @param string $filename File name with the extension
 * @return string file and path of the asset file
 */
function get_asset_file( $filename ) {
  $filetype = pathinfo( $filename )['extension'];
  return "${filetype}/${filename}";
} // end get_asset_file

/**
 * Enqueue scripts and styles.
 */
function dude_scripts() {
  $dude_template = 'global.min';

  // Styles.
  wp_enqueue_style( 'styles', get_theme_file_uri( "css/{$dude_template}.css" ), array(), filemtime( get_theme_file_path( "css/{$dude_template}.css" ) ) );

  // Scripts.
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );
  // wp_enqueue_script( 'tweenmax', get_theme_file_uri( 'js/src/tweenmax.min.js' ), array(), filemtime( get_theme_file_path( 'js/src/tweenmax.min.js' ) ), true );
  // wp_enqueue_script( 'buttons', get_theme_file_uri( 'js/src/buttons.js' ), array(), filemtime( get_theme_file_path( 'js/src/buttons.js' ) ), true );

  wp_localize_script( 'scripts', 'dude', array(
    'theme_base'  => get_template_directory_uri(),
  ) );

  wp_localize_script( 'scripts', 'dude_screenReaderText', array(
    'expand'      => esc_html__( 'Avaa alavalikko', 'dude' ),
    'collapse'    => esc_html__( 'Sulje alavalikko', 'dude' ),
    'external_link' => esc_html__( 'Ulkoinen sivusto:', 'dude' ),
    'homeurl'      => esc_url( get_home_url() ),
  ) );

  if ( is_post_type_archive( 'merch' ) ) {
		wp_enqueue_script( 'store', get_theme_file_uri( 'js/store.js' ), array(), filemtime( get_theme_file_path( 'js/store.js' ) ), true );
  }

  // Disable air-helper stuff
  remove_action( 'wp_footer', 'air_helper_enqueue_instantpage_script', 50 );
}
add_action( 'wp_enqueue_scripts', 'dude_scripts' );

/**
 * Enqueue block editor JavaScript and CSS
 */
function register_block_editor_assets() {

  // Dependencies
  $dependencies = [
    'wp-blocks',    // Provides useful functions and components for extending the editor
    'wp-i18n',      // Provides localization functions
    'wp-element',   // Provides React.Component
    'wp-components', // Provides many prebuilt components and controls
  ];

  // Enqueue the bundled block JS file
  // wp_enqueue_script(
  //   'block-editor-js',
  //   get_theme_file_uri( get_asset_file( 'gutenberg-editor.js' ) ),
  //   $dependencies,
  //   filemtime( get_theme_file_path( get_asset_file( 'gutenberg-editor.js' ) ) ),
  //   'all'
  // );

  // Enqueue optional editor only styles
  wp_enqueue_style(
    'block-editor-styles',
    get_theme_file_uri( get_asset_file( 'gutenberg.min.css' ) ),
    [],
    filemtime( get_theme_file_path( get_asset_file( 'gutenberg.min.css' ) ) ),
    'all',
    true
  );
} // end register_block_editor_assets
add_action( 'enqueue_block_editor_assets', 'register_block_editor_assets' );

add_filter( 'script_loader_tag', 'dude_script_loader_tag', 10, 2 );

// Remove Gutenberg inline "Normalization styles" like .editor-styles-wrapper h1
// color: inherit;
// @source https://github.com/WordPress/gutenberg/issues/18595#issuecomment-599588153
function remove_gutenberg_inline_styles( $editor_settings, $post ) {
  unset( $editor_settings['styles'][0] );
  return $editor_settings;
} // end remove_gutenberg_inline_styles
add_filter( 'block_editor_settings', 'remove_gutenberg_inline_styles', 10, 2 );

/**
 * Make sure Gutenberg wp-admin editor styles are loaded
 */
function setup_editor_styles() {
  // Add support for editor styles.
  add_theme_support( 'editor-styles' );

  // Enqueue editor styles.
  add_editor_style( get_theme_file_uri( get_asset_file( 'gutenberg.min.css' ) ) );
}
add_action( 'after_setup_theme', 'setup_editor_styles' );

function dude_script_loader_tag( $tag, $handle ) {
  if ( 'store' === $handle ) {
		return str_replace( '<script', '<script data-swup-reload-script data-swup-ignore-script', $tag );
  }

  return $tag;
}
add_action( 'after_setup_theme', 'dude_add_image_sizes' );

function dude_add_image_sizes() {
  add_image_size( 'tiny-preload-thumbnail', 20, 20 );
}

/**
 * Edit delivery of specific style sheets from certain templates.
 */
function dude_remove_styles() {
  if ( is_page_template( 'template-surveys-modern.php' ) || is_page_template( 'template-surveys-wpforms.php' ) ) {
    wp_dequeue_style( 'styles' );
    wp_enqueue_style( 'surveystyles', get_theme_file_uri( 'css/surveys.min.css' ), array(), filemtime( get_theme_file_path( 'css/surveys.min.css' ) ) );
  }

  if ( is_page_template( 'template-ama.php' ) ) {
    wp_dequeue_style( 'styles' );
    wp_enqueue_style( 'amastyles', get_theme_file_uri( 'css/ama.min.css' ), array(), filemtime( get_theme_file_path( 'css/ama.min.css' ) ) );
    add_filter( 'pre_option_rg_gforms_disable_css', '__return_true' );
  }

  if ( is_post_type_archive( 'merch' ) || get_post_type() === 'merch' ) {
    wp_dequeue_style( 'styles' );
    wp_enqueue_style( 'surveystyles', get_theme_file_uri( 'css/store.min.css' ), array(), filemtime( get_theme_file_path( 'css/store.min.css' ) ) );
  }
}
add_action( 'wp_print_styles', 'dude_remove_styles', 99 );

add_filter( 'embed_thumbnail_image_size', function() {
  return 'default';
} );

/**
 * PHP 8 function support for PHP 7.4
 */
if ( ! function_exists( 'str_contains' ) ) {
  function str_contains( string $haystack, string $needle ) : bool { // phpcs:ignore
      return '' === $needle || false !== strpos( $haystack, $needle );
  }
}

/**
 * Add required attributes to Gravity Forms fields to enable native validation
 */
add_filter( 'gform_field_content', __NAMESPACE__ . '\add_custom_attr', 10, 5 );
function add_custom_attr( $field_content, $field, $value, $form_id ) {

  // Add type attribute to file upload button, otherwise it tries to send
  if ( 'fileupload' === $field->type ) {
    $field_content = str_replace( '<button', '<button type="button"', $field_content );
  }

  // Add required to get native HTML validation instead of GF jQuery version
  if ( true === $field->isRequired ) { // phpcs:ignore
    $field_content = str_replace( 'type=', 'required type=', $field_content );
  }

  return $field_content;
 }

/**
 * Change gravity forms input to button that validates natively (remove onclick and onkeypress events)
 */
add_filter( 'gform_submit_button', __NAMESPACE__ . '\form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
  return "<input type='submit' class='button gform_button' id='gform_submit_button_{$form['id']}' Value='Lähetä' />";
}
