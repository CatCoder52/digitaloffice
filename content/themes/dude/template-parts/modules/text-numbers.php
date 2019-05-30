<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 18:43:31
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-30 17:28:32
 *
 * @package dude2019
 */

$title = get_sub_field( 'title' );
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

    <?php if ( ! empty( $title ) ) : ?>
      <header class="block-head">
        <h2 class="block-title"><?php echo esc_html( $title ) ?></h2>
      </header>
    <?php endif; ?>

    <div class="columns is-variable is-mobile is-tablet is-multiline">
      <div class="col col-main column is-half">
        <?php echo wpautop( $content ) ?>
      </div>

      <div class="col col-main column is-variable is-half col-numbers columns is-multiline">
        <?php foreach ( $numbers as $number ) : ?>
          <div class="col col-number column is-half">
            <h2><?php echo esc_html( $number['number'] ) ?></h2>
            <p><?php echo esc_html( $number['label'] ) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>
