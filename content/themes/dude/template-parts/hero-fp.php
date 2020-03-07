<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-07 11:17:22
 *
 * @package dude
 */

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}
?>

<section class="block block-hero block-hero-frontpage block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content">
      <h1>Visuaalisesti päräyttäviä, räätälöityjä verkkosivustoja.</h1>
      <p>Autamme sinua ja yritystänne pysymään edelläkävijänä toteuttamalla aikaa kestävät, laadukkaat verkkosivut. Tulosta ei tehdä valmisteemoilla.</p>
      <p class="button-wrapper"><a href="#" class="button"><span>Aloitetaanko projekti?</span><?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a> <a href="#" class="link link-browse no-text-link">Selaa tehtyjä töitämme</a></p>
    </div>

  </div>
</section>
