<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:48:37
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-11 14:40:53
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

    <header class="block-head screen-reader-text">
      <h2 class="block-title" id="block-title-our-services">Palvelumme</h2>
    </header>

    <div class="cols cols-services cols-services-design">

      <div class="col col-content">
        <span class="step"><?php include get_theme_file_path( '/svg/01.svg' ); ?></span>
        <h2 class="col-title">Suunnittelu</h2>

        <p>Nunc semper, velit vitae feugiat venenatis, dolor libero imperdiet nisi, at viverra neque justo ultrices libero. Curabitur aliquet sapien non placerat hendrerit. Vivamus ornare auctor sapien, vel tempus arcu aliquam eget.</p>

        <p class="link-wrapper"><a href="#" class="cta-link">Lisää suunnittelupalveluista</a></p>
      </div>

      <div class="col col-services">

        <div class="col-inner">
          <h3>Käyttöliittymät</h3>
          <p>Kaunis verkkosivusto ilman logiikkaa on kuin playboy-malli ilman tissejä. Meiltähän hoituu tämäkin niin pieniin kuin suurempiinkin sivustoihin.</p>
        </div>

        <div class="col-inner">
          <h3>Visuaalinen suunnittelu</h3>
          <p>Suorastaan naurettavan tyylikkäät verkkosivustot tai markkinointimateriaalit pitävät yrityksesi imagon kirkkaana ja uskottavana.</p>
        </div>

        <div class="col-inner">
          <h3>Kickoff-workshop</h3>
          <p>Aloitus-työpaja, jossa määritellään tavoitteet ja suuntaviivat sekä ideoidaan uudistusta. Loistava tapa tiivistää yhteistyötä heti projektin alkumetreillä.</p>
        </div>

        <div class="col-inner">
          <h3>Käyttäjäkokemus</h3>
          <p>Huono käyttäjäkokemus voi johtaa potentiaalisen asiakkaan karkaamisen kilpailijalle. Teemme verkkosivustostasi käyttäjälle miellyttävän käyttää.</p>
        </div>

        <div class="col-inner">
          <h3>Brändi-identiteetit</h3>
          <p>Aika kävellyt yrityksesi ilmeen yli? Toivotamme sen tervetulleeksi tälle vuosikymmenelle ja otamme homman haltuun.</p>
        </div>

      </div>
    </div>

    <div class="cols cols-services cols-services-development">

      <div class="col col-content">
        <span class="step"><?php include get_theme_file_path( '/svg/02.svg' ); ?></span>
        <h2 class="col-title">Kehitys</h2>

        <p>Tekniseltä osaamiseltamme olemme aivan suomen parhaimmistoa. Anisi, at viverra neque justo ultrices libero. Curabitur aliquet sapien non placerat hendrerit. Vivamus ornare auctor sapien, vel tempus arcu aliquam eget.</p>

        <p class="link-wrapper"><a href="#" class="cta-link">Lisää kehitysvammoista</a></p>
      </div>

      <div class="col col-services">

        <div class="col-inner">
          <h3>WordPress-verkkosivut</h3>
          <p>Laadukkaalla verkkosivustolla luotsaat yrityksesi kasvuun. WordPress-osaamisemme on laajaa ja tiedämme, mikä toimii tai mikä ei. </p>
        </div>

        <div class="col-inner">
          <h3>Integraatiot</h3>
          <p>Proin imperdiet magna nec dolor ultricies facilisis. Nulla facilisi. Donec convallis nisi ac vehicula ullamcorper.</p>
        </div>

        <div class="col-inner">
          <h3>Hakukoneoptimointi</h3>
          <p>Tehosta näkyvyyttäsi hakukoneissa. Hoidamme tarvittavat toimenpiteet puolestasi.</p>
        </div>

        <div class="col-inner">
          <h3>WooCommerce-verkkokaupat</h3>
          <p>Proin imperdiet magna nec dolor ultricies facilisis. Nulla facilisi. Donec convallis nisi ac vehicula ullamcorper.</p>
        </div>

        <div class="col-inner">
          <h3>Ylläpitopalvelut</h3>
          <p>Tarjoamme verkkosivustoasiakkaillemme myös laadukasta ylläpitopalvelua. Lorem ipsum demer les acculate ethel.</p>
        </div>

      </div>
    </div>

</section>
