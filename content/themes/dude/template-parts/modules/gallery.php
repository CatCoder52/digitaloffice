<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-25 14:37:31
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-12 17:43:36
 *
 * @package dude
 */

// try to get images from ccahe
$images = wp_cache_get( get_the_id() . '_gallery_images', 'theme' );

// no images on cache, get fresh
if ( ! $images ) {
  $images = get_sub_field( 'images' );

  if ( empty( $images ) ) {
    return;
  }

  shuffle( $images ); // set to random order

  foreach ( $images as $key => $image ) {
    $images[ $key ] = array(
      'id'  => $image['ID'],
      'url' => $image['url'],
      'alt' => get_post_meta( $image['ID'], '_wp_attachment_image_alt', true ),
    );
  }

  // save to cache
  wp_cache_set( get_the_id() . '_gallery_images', $images, 'theme', DAY_IN_SECONDS );
}

if ( empty( $images ) ) {
  return;
} ?>

<section class="block block-gallery">
  <div class="container">

    <div class="cols" id="gallery">
      <?php $x = 0; foreach ( $images as $image ) :
        if ( $x < 7 ) : ?>
        <div class="col" style="background-image: url('<?php echo esc_url( $image['url'] ) ?>');">
          <a class="global-link" href="<?php echo esc_url( $image['url'] ) ?>"><span class="screen-reader-text">Avaa galleria kuvaan "<?php echo esc_html( $image['alt'] ) ?>"</span></a>
        </div>
      <?php else : ?>
          <a class="global-link hidden" href="<?php echo esc_url( $image['url'] ) ?>"><span class="screen-reader-text">Avaa galleria kuvaan "<?php echo esc_html( $image['alt'] ) ?>"</span></a>
        <?php endif; ?>
      <?php $x++; endforeach; ?>
    </div>

  </div>
</section>
