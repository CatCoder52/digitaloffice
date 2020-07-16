<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 16:06:05
 *
 * @package dude
 */

$title = 'Töitämme';
$content = 'Olemme toteuttaneet monipuolisesti verkkosivuja ja -palveluita erilaisille toimijoille. Joihinkin toteutuksiimme voit tutustua täällä tarkemmin.';
?>

<section class="block block-hero block-hero-reference-archive">
  <div class="container">

    <h1 class="block-pre-title" aria-describedby="<?php echo esc_html( sanitize_title( $title ) ); ?>"><?php echo esc_html( $title ); ?></h1>
    <h2 class="hero-title" id="<?php echo esc_html( sanitize_title( $title ) ); ?>">Näistä olemme erityisen ylpeitä</h2>

    <div class="service-hero-wrap">
      <div class="content">
        <p><?php echo esc_html( $content ); ?></p>
      </div>
    </div>

  </div>
</section>
