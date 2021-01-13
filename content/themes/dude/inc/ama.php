<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2021-01-13 10:34:51
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2021-01-13 11:12:27
 */

add_action( 'rest_api_init', function () {
  register_rest_route( 'ama/v1', '/drafts', array(
    'methods'   => 'GET',
    'callback'  => 'dude_get_ama_drafts',
  ) );
} );

function dude_get_ama_drafts( $data ) {
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

  ob_start();
  ?>
  <div class="ama-item" data-id="<?php echo esc_attr( $post_id ); ?>" data-timestamp="<?php echo esc_attr( $timestamp ); ?>">
    <h3><?php echo esc_html( $question ); ?></h3>
    <?php echo wp_kses_post( wpautop( $answer ) ); ?>
  </div>
  <?php return ob_get_clean();
} // end dude_get_ama_entry
