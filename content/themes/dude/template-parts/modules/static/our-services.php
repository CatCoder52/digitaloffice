<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-17 14:19:07
 *
 * @package dude
 */

$image_id_design = get_sub_field( 'image_design' );
$image_id_development = get_sub_field( 'image_development' );

if ( empty( $image_id_design ) ) {
  return;
}

$image_design_full = wp_get_attachment_image_url( $image_id_design, 'large' );
$image_design_mobile = wp_get_attachment_image_url( $image_id_design, 'large' );
$image_design_preload = wp_get_attachment_image_url( $image_id_design, 'tiny-preload-thumbnail' );
$image_development_full = wp_get_attachment_image_url( $image_id_development, 'large' );
$image_development_mobile = wp_get_attachment_image_url( $image_id_development, 'large' );
$image_development_preload = wp_get_attachment_image_url( $image_id_development, 'tiny-preload-thumbnail' );
?>

<section class="block block-our-services">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title" id="block-title-our-services">Näitä voimme tarjota teille</h2>
    </header>

    <div class="cols cols-two">

      <div class="col col-content">
        <h3 class="col-title">UI/UX-Suunnittelu</h3>

        <p>Kokeneen suunnittelutiimimme avulla saat ensimmäisen merkittävän askeleen kohti helppokäyttöistä verkkosivustoa tai kaunista ilmeuudistusta.</p>

        <ul class="list-features">
          <li>Käyttöliiittymäsuunnittelu</li>
          <li>Käyttökokemussuunnittelu</li>
          <li>Ilmesuunnittelu</li>
          <li>Markkinointimateriaalit</li>
        </ul>

        <p class="button-wrapper"><a href="#" class="button">Lue lisää suunnittelusta</a></p>
      </div>

      <div class="col col-image"></div>
    </div>

    <div class="cols cols-two col-two-opposite">
      <div class="col col-content">
        <h3 class="col-title">Kehitys & ylläpito</h3>

        <p>Kokeneen suunnittelutiimimme avulla saat ensimmäisen merkittävän askeleen kohti helppokäyttöistä verkkosivustoa tai kaunista ilmeuudistusta.</p>

        <ul class="list-features">
          <li>WordPress-verkkosivut</li>
          <li>WooCommerce-verkkokaupat</li>
          <li>Integraatiot ja WordPress-lisäosat</li>
          <li>WordPress-ylläpitopalvelut</li>
        </ul>

        <p class="button-wrapper"><a href="#" class="button">Lue lisää kehityksestä</a></p>
      </div>

      <div class="col col-image"></div>
    </div>

</section>
