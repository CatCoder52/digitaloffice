<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-31 10:14:43
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
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}

if ( is_post_type_archive( 'reference' ) ) {
  $title = 'Työt';
  $content = 'Olemme tehneet paljon kaikenlaista ja suurimmasta osasta hommia olemme ylpeitä. Muutamiin niistä voit tutustua täällä tarkemmin.';
} ?>

<section class="block block-hero-jobs block-hero<?php if ( $bg_image ) { ?> block-hero-side-columns<?php } ?> block-hero-enable-transition">
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
          <li><a href="#">WordPress-kehittäjää back-end-painotuksella <span class="label">Haku päällä nyt!</span></a></li>
          <li><a href="#">Visuaalista suunnittelijaa project lead-viballa <span class="label">Haku päällä nyt!</span></a></li>
        </ul>
      </div>
    </div>

    <?php if ( $bg_image ) { ?>
    <div class="featured-image featured-image-side">
      <div class="shade"></div>
        <div class="background-image preview lazyload" style="background-image: url('<?php echo $bg_image_tiny; ?>');" data-src="<?php echo esc_url( $bg_image ); ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"></div></noscript>
    </div>
    <?php } ?>

  </div>
</section>
