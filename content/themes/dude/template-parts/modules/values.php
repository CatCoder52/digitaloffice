<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:54:33
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:10:37
 *
 * @package dude
 */

// settings
$first_open = true;
$i = 0;

// get content
$title = get_sub_field( 'title' );
$subtitle = get_sub_field( 'subtitle' );
$accordion = get_sub_field( 'accordion' );

// bail if no content
if ( empty( $title ) || empty( $accordion ) ) {
  return;
}

// check that accordion has content
foreach ( $accordion as $key => $item ) {
  if ( empty( $item['title'] ) || empty( $item['content'] ) ) {
    unset( $accordion[ $key ] );
  }
}

// count accordion items
$accordion_count = count( $accordion );
$i = $accordion_count;

// bail if no content
if ( empty( $accordion ) ) {
  return;
} ?>

<section class="block block-values has-light-bg">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title"><?php echo esc_html( $title ); ?></h2>
    </header>

    <div class="cols">

      <?php foreach ( $accordion as $item ) : ?>
        <div class="col">

          <h3><?php echo esc_html( $item['title'] ) ?></h3>
          <?php echo wpautop( $item['content'] ) ?>

        </div>
      <?php endforeach; ?>

    </div>

  </div>
 </section>
