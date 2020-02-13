<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-13 15:13:39
 *
 * @package dude
 */

$image_big = get_sub_field( 'image_big' );
$image_small_left = get_sub_field( 'image_small_left' );
$image_small_right = get_sub_field( 'image_small_right' );

// Bail if no content
if ( empty( $image_big ) ) {
  return;
}
?>

<section class="block block-images">
  <div class="container">
    <?php if ( ! empty( $image_big ) ) : ?>
      <div class="image image-big">
        <?php image_lazyload_div( $image_big['id'] ); ?>
      </div>
    <?php endif; ?>
  </div>
</section>
