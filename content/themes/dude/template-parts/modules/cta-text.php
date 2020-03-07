<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 19:33:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-07 15:50:06
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

    <h2><?php echo $title; // WPCS: XSS OK ?></h2>
    <p class="link-wrapper"><a class="cta-link" href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?></a></p>

  </div>
</section>
