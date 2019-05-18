<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 19:33:53
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 19:36:07
 *
 * @package dude2019
 */

$title = get_sub_field( 'title' );
$link = get_sub_field( 'link' );

if ( empty( $title ) || empty( $link ) ) {
  return;
} ?>

<section class="block block-cta-text">
  <div class="container">

    <h2><?php echo esc_html( $title ) ?></h2>
    <p><a href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?></a></p>

  </div>
</section>
