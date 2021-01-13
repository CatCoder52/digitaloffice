<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2021-01-13 10:34:51
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2021-01-13 10:53:21
 */

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
}
