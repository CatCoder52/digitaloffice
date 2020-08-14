<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-08-12 15:16:31
 *
 * @package dude
 */

$title = 'Töitämme';
$content = 'Olemme toteuttaneet monipuolisesti verkkopalveluita ja brändi-identiteettejä kaikenlaisille toimijoille.';
?>

<section class="block block-hero block-hero-reference-archive has-dark-bg">
  <div class="container">

    <h1 class="block-pre-title swup-transition-fade" aria-describedby="<?php echo esc_html( sanitize_title( $title ) ); ?>"><?php echo esc_html( $title ); ?></h1>
    <h2 class="hero-title swup-transition-fade" id="<?php echo esc_html( sanitize_title( $title ) ); ?>">Näistä olemme erityisen ylpeitä</h2>

    <div class="service-hero-wrap swup-transition-fade">
      <div class="content">
        <p><?php echo esc_html( $content ); ?></p>
      </div>
    </div>

  </div>
</section>
