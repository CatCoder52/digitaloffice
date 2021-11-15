<?php
/**
 * @Author:             Roni Laukkarinen
 * @Date:               2021-10-11 16:08:55
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-11-15 16:48:10
 *
 * @package dude
 */

 // Get content
$title = get_sub_field( 'title' );
$boxes = get_sub_field( 'boxes' );

// Bail if no content
if ( empty( $boxes ) ) {
  return;
}
?>

<section class="block block-upsells-mint has-light-bg">
  <div class="container">

    <h2><?php echo esc_html( $title ); ?></h2>

    <div class="boxes">

      <?php foreach ( $boxes as $box ) : ?>
        <div class="box-mint">
          <?php echo wpautop( $box['text'] ) ?>
        </div>
      <?php endforeach; ?>

    </div>

  </div>
 </section>
