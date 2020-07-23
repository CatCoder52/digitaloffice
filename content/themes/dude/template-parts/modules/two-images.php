<?php
/**
 * @Author: Timi Wahalahti
 * @Date:   2020-07-14 15:02:12
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:10:34
 * @package dude
 */

$image_left = get_sub_field( 'image_left' );
$image_right = get_sub_field( 'image_right' );

if ( empty( $image_left ) || empty( $image_right ) ) {
  return;
} ?>

<section class="block block-two-images has-light-bg">
  <div class="container">
    <div class="cols cols-two">
      <div class="col"><?php image_lazyload_div( $image_left ); ?></div>
      <div class="col"><?php image_lazyload_div( $image_right ); ?></div>
    </div>
  </div>
</section>
