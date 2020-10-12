<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-10-12 20:55:31
 *
 * @package dude
 */

$image_big = get_sub_field( 'image_big' );
$image_small_left = get_sub_field( 'image_small_left' );
$image_small_right = get_sub_field( 'image_small_right' );
$style = get_sub_field( 'style' );

// Bail if no content
if ( empty( $image_big ) ) {
  return;
}
?>

<section class="block has-dark-bg block-images has-style-<?php echo $style; ?>" aria-hidden="true">
  <div class="container">
  <h2 class="screen-reader-text">Kuvia toimistolta</h2>
    <?php if ( ! empty( $image_big ) ) : ?>
      <div class="image image-big">
        <div aria-hidden="true" data-defer="<?php echo esc_url( wp_get_attachment_image_url( $image_big['id'], 'full' ) ); ?>" class="background-image"></div>
      </div>
    <?php endif; ?>

    <?php if ( ! empty( $image_small_left ) ) : ?>
      <div class="image image-small-left">
        <div aria-hidden="true" data-defer="<?php echo esc_url( wp_get_attachment_image_url( $image_small_left['id'], 'full' ) ); ?>" class="background-image"></div>
      </div>
    <?php endif; ?>

    <?php if ( ! empty( $image_small_right ) ) : ?>
      <div class="image image-small-right">
        <div aria-hidden="true" data-defer="<?php echo esc_url( wp_get_attachment_image_url( $image_small_right['id'], 'full' ) ); ?>" class="background-image"></div>
      </div>
    <?php endif; ?>
  </div>
</section>
