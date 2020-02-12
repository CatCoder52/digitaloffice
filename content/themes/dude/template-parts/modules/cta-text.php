<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 19:33:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-12 17:43:36
 *
 * @package dude
 */

$title = get_sub_field( 'title' );
$link = get_sub_field( 'link' );

if ( empty( $title ) || empty( $link ) ) {
  return;
} ?>

<section class="block block-cta-text">
  <div class="container">

    <h2 class="block-title"><?php echo esc_html( $title ) ?></h2>
    <p><a class="cta-link" href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?></a></p>

  </div>
</section>
