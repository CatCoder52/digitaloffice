<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-27 22:39:13
 *
 * @package dude2019
 */

$title = get_the_title();
$content = get_post_meta( get_the_id(), 'hero_content', true );

if ( is_post_type_archive( 'reference' ) ) {
  $title = 'Työt';
  $content = 'Olemme tehneet paljon kaikenlaista ja suurimmasta osasta hommia olemme ylpeitä. Muutamiin niistä voit tutustua täällä tarkemmin.';
} ?>

<section class="block block-hero block-hero-normal block-hero-enable-transition">
  <div class="container">

    <div class="content">
      <h1><?php echo $title ?></h1>

      <?php if ( ! empty( $content ) ) {
        echo wpautop( $content );
      }

      if ( 4449 === get_the_id() ) : ?>
        <p><a href="<?php echo get_post_type_archive_link( 'reference' ) ?>">Mitä helvettiä? Missä työnäytteet?</a></p>
      <?php endif; ?>
    </div>

    <div class="featured-image featured-image-side" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'full' ) ?>);"></div>

  </div>
</section>
