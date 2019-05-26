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
// add_theme_support( 'woocommerce' );

/**
 * Load textdomain.
 */
load_theme_textdomain( 'dude', get_template_directory() . '/languages' );

/**
 * Define content width in articles
 */
if ( ! isset( $content_width ) ) {
  $content_width = 800;
}

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
 * Move jQuery to footer
 */
function dude_move_jquery_into_footer( $wp_scripts ) {
  if ( ! is_admin() ) {
    $wp_scripts->add_data( 'jquery',         'group', 1 );
    $wp_scripts->add_data( 'jquery-core',    'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
  }
}
add_action( 'wp_default_scripts', 'dude_move_jquery_into_footer' );

/**
 * Enqueue scripts and styles.
 */
function dude_scripts() {
  $dude_template = 'global.min';

  // Styles.
  wp_enqueue_style( 'styles', get_theme_file_uri( "css/{$dude_template}.css" ), array(), filemtime( get_theme_file_path( "css/{$dude_template}.css" ) ) );

  // Scripts.
  wp_enqueue_script( 'jquery-core' );
  wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );

  // Required comment-reply script
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_localize_script( 'scripts', 'dude_screenReaderText', array(
    'expand'      => esc_html__( 'Open child menu', 'dude' ),
    'collapse'    => esc_html__( 'Close child menu', 'dude' ),
    'rotatedevice' => esc_html__( 'Käännä älylaitteesi vaakatasoon', 'dude' ),
  ) );
}
add_action( 'wp_enqueue_scripts', 'dude_scripts' );
