<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 15:00:05
 *
 * @package dude
 */

$title = 'Töitämme';
$content = 'Olemme toteuttaneet monipuolisesti verkkosivuja ja -palveluita erilaisille toimijoille. Joihinkin toteutuksiimme voit tutustua täällä tarkemmin.';
?>

<section class="block block-hero block-hero-reference-archive block-hero-enable-transition">
  <div class="container">

    <p class="block-pre-title" aria-describedby="<?php echo esc_html( sanitize_title( $reference['frontpage_upsell_title'] ) ); ?>"><?php echo esc_html( $reference['upper_title'] ); ?></p>
    <h1><?php echo esc_html( $title ); ?></h1>

    <div class="service-hero-wrap">
      <div class="content">
        <p><?php echo esc_html( $content ); ?></p>
      </div>
    </div>

  </div>
</section>
