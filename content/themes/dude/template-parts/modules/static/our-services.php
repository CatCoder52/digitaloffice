<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-01 13:44:19
 *
 * @package dude2019
 */

$image = get_sub_field( 'image' );

if ( empty( $image ) ) {
  return;
}

$image = wp_get_attachment_image_url( $image, 'large' );
$image_preload = wp_get_attachment_image_url( $image, 'tiny-preload-thumbnail' ); ?>

<section class="block block-our-services">
  <div class="container">

    <header class="block-head">
      <p class="block-title-pre" aria-describedby="block-title-our-services">Mitä me teemme?</p>
      <h2 class="block-title" id="block-title-our-services">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
    </header>

    <div class="cols">
      <div class="col col-text">
        <h3>Verkkosivut ja -palvelut</h3>
        <p class="col-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut ex consequat, facilisis.</p>

        <p class="cta-link"><a href="#">Tutustu</a></p>
      </div>

      <div class="col col-text">
        <h3>Visuaalinen suunnittelu</h3>
        <p class="col-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut ex consequat, facilisis.</p>

        <p class="cta-link"><a href="#">Tutustu</a></p>
      </div>

      <div class="col col-featured-image">
      </div>
    </div>

    <div class="image has-lazyload">
      <div class="background-image preview lazyload" style="background-image: url('<?php echo $image_preload ?>');" data-src="<?php echo $image ?>"></div>
      <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $image ?>');"<?php endif; ?>></div>
      <noscript><div class="background-image full-image" style="background-image: url('<?php echo $image ?>');"></div></noscript>
    </div>

  </div>
</section>
