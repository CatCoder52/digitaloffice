<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 16:50:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-25 14:51:15
 *
 * @package dude2019
 */

$content = get_sub_field( 'content' );
$image = get_sub_field( 'image' );

if ( empty( $content ) || empty( $image ) ) {
  return;
} ?>

<section class="block block-text-image">
  <div class="container">

    <div class="cols">
      <div class="col col-content">
        <?php echo wpautop( $content ) ?>
      </div>

      <div class="col col-image" style="background-image: url('<?php echo wp_get_attachment_url( $image ) ?>')"></div>
    </div>

  </div>
</section>
