<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:34:24
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-25 13:47:05
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
        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_image, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo wp_get_attachment_image_url( $bg_image, 'full' ) ?>" data-src-mobile="<?php echo wp_get_attachment_image_url( $bg_image, 'large' ) ?>"></div>
          <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_image, 'full' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_image, 'full' ) ?>');"></div></noscript>
        </div>
      </div>

      <div class="col has-grey-bg has-grey-bg-extend-right">
        <div class="content">
          <?php echo wpautop( $content ); ?>
        </div>
      </div>
    </div>

  </div>
</section>
