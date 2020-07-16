<?php
/**
 * @Author: Roni Laukkarinen
 * @Date:   2020-07-16 17:32:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 17:46:04
 * @package dude
 */

wp_reset_postdata();
$image_full_width = get_sub_field( 'image_full_width' );

if ( empty( $image_full_width ) ) {
  return;
} ?>

<section class="block block-image-full-width">
  <div class="container">
      <div class="image"><?php image_lazyload_tag( $image_full_width['ID'] ); ?></div>
  </div>
</section>
