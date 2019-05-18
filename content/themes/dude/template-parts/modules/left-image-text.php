<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:34:24
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 17:38:04
 *
 * @package dude2019
 */

$bg_image = get_sub_field( 'image' );
$content = get_sub_field( 'content' );

if ( empty( $bg_image ) || empty( $content ) ) {
  return;
} ?>

<section class="block block-left-image-text">
  <div class="container">

    <div class="cols">
      <div class="col">
        <div class="image" style="background-image: url('<?php echo esc_url( wp_get_attachment_url( $bg_image ) ) ?>');"></div>
      </div>

      <div class="col">
        <div class="content">
          <?php echo wpautop( $content ); ?>
        </div>
      </div>
    </div>

  </div>
</section>
