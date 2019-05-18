<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:54:33
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 18:01:50
 *
 * @package dude2019
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

<section class="block block-accordion">
  <div class="container">

    <div class="col col-left">
      <h2><?php echo esc_html( $title ) ?></h2>

      <?php if ( ! empty( $subtitle ) ) : ?>
        <h3><?php echo esc_html( $subtitle ) ?></h3>
      <?php endif; ?>
    </div>

    <div class="col col-right">

      <?php foreach ( $accordion as $item ) : ?>
        <div class="accordion<?php if ( $first_open && $i === $accordion_count ) { echo ' open-accordion'; } ?>" data-href="<?php echo esc_attr( sanitize_title( $item['title'] ) ) ?>">
          <h2><?php echo esc_html( $item['title'] ) ?></h2>
        </div>

        <div class="accordion-content wrapper" <?php if ( $first_open && $i === $accordion_count ) { echo 'style="display: grid;"'; } ?>>
          <?php echo wpautop( $item['content'] ) ?>
        </div>
      <?php $i--; endforeach; ?>

    </div>

  </div>
</section>
