<?php
/**
 * @Author: Roni Laukkarinen
 * @Date:   2020-07-16 17:32:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 17:44:35
 * @package dude
 */

$image = get_sub_field( 'image' );

if ( empty( $image ) ) {
  return;
} ?>

<section class="block block-image-in-container">
  <div class="container">
      <div class="image"><?php image_lazyload_tag( $image ); ?></div>
  </div>
</section>

<?php wp_reset_postdata();
