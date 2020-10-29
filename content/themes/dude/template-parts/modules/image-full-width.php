<?php
/**
 * @Author: Roni Laukkarinen
 * @Date:   2020-07-16 17:32:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:08:20
 * @package dude
 */

wp_reset_postdata();
$image_full_width = get_sub_field( 'image_full_width' );

if ( empty( $image_full_width ) ) {
  return;
} ?>

<section class="block has-dark-bg block-image-full-width">
  <div class="container">
      <div class="image"><?php vanilla_lazyload_tag( $image_full_width['ID'] ); ?></div>
  </div>
</section>
