<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 18:43:31
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 18:49:00
 *
 * @package dude2019
 */

$content = get_sub_field( 'content' );
$numbers = get_sub_field( 'numbers' );

if ( empty( $content ) || empty( $numbers ) ) {
  return;
}

foreach ( $numbers as $key => $number ) {
  if ( empty( $number['number'] ) || empty( $number['label'] ) ) {
    unset( $numbers[ $key ] );
  }
}

if ( empty( $numbers ) ) {
  return;
} ?>

<section class="block block-text-numbers">
  <div class="container">

    <div class="col">
      <?php echo wpautop( $content ) ?>
    </div>

    <div class="col col-numbers">

      <?php foreach ( $numbers as $number ) : ?>
        <div class="number">
          <h2><?php echo esc_html( $number['number'] ) ?></h2>
          <p><?php echo esc_html( $number['label'] ) ?></p>
        </div>
      <?php endforeach; ?>

    </div>

  </div>
</section>
