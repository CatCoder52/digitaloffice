<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-25 13:36:13
 *
 * @package dude2019
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'title_alt', true );
$content = get_post_meta( get_the_id(), 'hero_content', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
}

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}

if ( is_post_type_archive( 'reference' ) ) {
  $title = 'Työt';
  $content = 'Olemme tehneet paljon kaikenlaista ja suurimmasta osasta hommia olemme ylpeitä. Muutamiin niistä voit tutustua täällä tarkemmin.';
} ?>

<section class="block block-hero-jobs block-hero block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content">
      <div class="side-content-box contact-information">
        <h1 class="animate animate-1"><?php echo $title ?></h1>

        <div class="hero-description animate animate-2">
          <?php if ( ! empty( $content ) ) {
            echo wpautop( $content );
          }
          ?>
        </div>

        <ul class="jobs animate animate-3">
          <li><a href="<?php echo get_page_link(4588); ?>">WordPress-kehittäjää back-end-painotuksella <span class="label">Haku päällä nyt!</span></a></li>
          <li><a href="<?php echo get_page_link(4793); ?>">Visuaalista suunnittelijaa project lead-viballa <span class="label">Haku päällä nyt!</span></a></li>
        </ul>
      </div>
    </div>

  </div>
</section>
