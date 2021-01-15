<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2021-01-13 10:34:51
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2021-01-15 14:54:21
 *
 * @package dude
 */

add_filter( 'autoptimize_filter_noptimize', 'ama_noptimize', 10, 0 );
function ama_noptimize() {
  if ( strpos( $_SERVER['REQUEST_URI'], 'ama' ) !== false ) {
    return true;
  } else {
    return false;
  }
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'ama/v1', '/drafts', array(
    'methods'   => 'GET',
    'callback'  => 'dude_get_ama_drafts',
  ) );
} );

function dude_get_ama_drafts() {
  $count = wp_cache_get( 'ama-drafts', 'theme' );
  if ( ! $count ) {
    $count = wp_count_posts( 'ama' )->draft;
    wp_cache_set( 'ama-drafts', 'theme', $count, MINUTE_IN_SECONDS / 4 );
  }

  return $count;
} // end dude_get_ama_drafts

function dude_get_ama_entry( $post_id ) {
  $question = get_the_title( $post_id );
  $answer = get_the_content( $post_id );
  $timestamp = get_the_date( 'Y-m-d H:i:s', $post_id );

  $output = wp_cache_get( "ama-question-{$post_id}", 'theme' );
  if ( ! $output ) :
    ob_start(); var_dump( 'no cache' ); ?>
    <div id="<?php echo esc_attr( $post_id ); ?>" class="inner" data-id="<?php echo esc_attr( $post_id ); ?>" data-timestamp="<?php echo esc_attr( $timestamp ); ?>">
      <h2><?php echo esc_html( $question ); ?></h2>
      <?php echo wp_kses_post( $answer ); ?>
    </div>
    <?php $output = ob_get_clean();
    wp_cache_set( "ama-question-{$post_id}", $output, 'theme', MINUTE_IN_SECONDS * 15 );
  endif;

  return $output;
} // end dude_get_ama_entry

add_action( 'gform_after_submission', 'dude_ama_questions_to_cpt', 10, 2 );
function dude_ama_questions_to_cpt( $entry, $form ) {
  $form_id = 8;
  if ( 'production' === getenv( 'WP_ENV' ) ) {
    $form_id = 9;
  }

  if ( $form['id'] !== $form_id ) {
    return;
  }

  if ( empty( $entry[1] ) ) {
    return;
  }

  wp_insert_post( [
    'ID'          => 0,
    'post_type'   => 'ama',
    'post_status' => 'draft',
    'post_title'  => $entry[1],
  ] );

  return $entry;
}
