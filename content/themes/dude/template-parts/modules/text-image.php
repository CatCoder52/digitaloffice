<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 16:50:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-07 13:22:11
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

      <div class="col col-image has-lazyload">
        <div class="background-image preview lazyload" style="background-image: url('<?php echo wp_get_attachment_image_url( $image, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo wp_get_attachment_image_url( $image, 'large' ) ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo wp_get_attachment_image_url( $image, 'large' ) ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo wp_get_attachment_image_url( $image, 'large' ) ?>');"></div></noscript>
      </div>
    </div>

  </div>
</section>
