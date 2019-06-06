<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-06 16:01:14
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
      <h2 class="block-title" id="block-title-our-services">Mieluiten vain muutamaa asiaa todella hyvin, kuin vähän kaikkea sinne päin.</h2>
    </header>

    <div class="cols">
      <div class="col col-text">
        <h3><a href="/verkkosivut">Verkkosivut ja -palvelut</a></h3>
        <p class="col-description">Ei valmisratkaisuja, vaan laadukkaasti räätälöiden. Tämähän se meidän ykkösjuttu on.</p>

        <p class="cta-link"><a href="/verkkosivut">Tutustu</a></p>
      </div>

      <div class="col col-text">
        <h3><a href="/visuaalinen-suunnittelu">Visuaalinen suunnittelu</a></h3>
        <p class="col-description">Verkkopalveluiden ulkoasujen lisäksi meillä tehdään myös maailmanluokan yritysilmeitä.</p>

        <p class="cta-link"><a href="/visuaalinen-suunnittelu">Tutustu</a></p>
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
