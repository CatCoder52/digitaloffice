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
require get_theme_file_path( '/inc/menus.php' );
require get_theme_file_path( '/inc/nav-walker.php' );

/**
 *  Content.
 */
require get_theme_file_path( '/inc/cpt/reference.php' );
require get_theme_file_path( '/inc/cpt/person.php' );
require get_theme_file_path( '/inc/cpt/merch.php' );
require get_theme_file_path( '/inc/cpt/order.php' );

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
 * Enqueue scripts and styles.
 */
function dude_scripts() {
  $dude_template = 'global.min';

  // Styles.
  wp_enqueue_style( 'styles', get_theme_file_uri( "css/{$dude_template}.css" ), array(), filemtime( get_theme_file_path( "css/{$dude_template}.css" ) ) );

  // Scripts.
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );

  wp_localize_script( 'scripts', 'dude', array(
    'theme_base'  => get_template_directory_uri(),
  ) );

  wp_localize_script( 'scripts', 'dude_screenReaderText', array(
    'expand'      => esc_html__( 'Avaa alavalikko', 'dude' ),
    'collapse'    => esc_html__( 'Sulje alavalikko', 'dude' ),
    'homeurl'      => esc_url( get_home_url() ),
  ) );

  if ( is_post_type_archive( 'merch' ) ) {
		wp_enqueue_script( 'store', get_theme_file_uri( 'js/store.js' ), array(), filemtime( get_theme_file_path( 'js/store.js' ) ), true );
  }

  // Disable air-helper stuff
  remove_action( 'wp_footer', 'air_helper_enqueue_instantpage_script', 50 );
}
add_action( 'wp_enqueue_scripts', 'dude_scripts' );

add_filter( 'script_loader_tag', 'dude_script_loader_tag', 10, 2 );

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
