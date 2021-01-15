<?php
/**
 * Plugin Name: Dude AMA
 * Description: Functionality to have an "Ask Me Anything" -live session
 * Version: 0.0.1
 * Author: Digitoimisto Dude Oy, Niku Hietanen
 * Author URI: https://www.dude.fi
 * Requires at least: 5.0
 * Tested up to: 5.5
 * License: GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package dude-ama
 */

namespace Dude_Ama;

if ( ! defined( 'ABSPATH' ) ) {
  exit();
}

add_action( 'rest_api_init', __NAMESPACE__ . '\register_question_api' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\register_scripts' );
add_action( 'dude_ama_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts' );

/**
 * Register scripts
 */
function register_scripts() {
  wp_register_script(
    'vue',
    'https://unpkg.com/vue@3.0.5/dist/vue.global.prod.js',
    [],
    '3.0.5',
    true
  );
  wp_register_script(
    'axios',
    'https://unpkg.com/axios/dist/axios.min.js',
    [],
    '1.0.0',
    true
  );
  wp_register_script(
    'dude-ama',
    untrailingslashit( plugin_dir_url( __FILE__ ) ) . '/scripts.js',
    [
      'vue',
      'axios',
    ],
    filemtime( untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/scripts.js' ),
    true
  );
  wp_localize_script(
    'dude-ama',
    'dudeAmaApiURL',
    esc_url( get_home_url() )
  );
}

/**
 * Enqueue AMA scripts
 */
function enqueue_scripts() {
  wp_enqueue_script( 'vue' );
  wp_enqueue_script( 'axios' );
  wp_enqueue_script( 'dude-ama' );
}

/**
 * Register API for questions
 */
function register_question_api() {
  register_rest_field(
    'ama',
    'meta',
    [
     'get_callback' => __NAMESPACE__ . '\get_rendered_ama',
     'schema'       => null,
    ]
  );

  register_rest_route( 'dude-ama/v1', 'create-question/', array(
    'methods' => 'post',
    'callback' => __NAMESPACE__ . '\save_question',
    'permission_callback' => '__return_true',
  ) );
}

function save_question( $request ) {
  $question = sanitize_text_field( $request->get_param( 'question' ) );

  if ( ! empty( $question ) ) {
    $new_post = [
      'post_title'    => $question,
      'post_content'  => '',
      'post_status'   => 'draft',
      'post_author'   => 1,
      'post_type'     => 'ama',
    ];
    wp_insert_post( $new_post );
  }
}

/**
 * Get rendered html
 */
function get_rendered_ama( $ama ) {
  $rendered_listing = dude_get_ama_entry( $ama['id'] );
  return [
    'rendered_listing' => $rendered_listing,
  ];
}
