<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 18:36:52
 *
 * @package dude2019
 */
$content = get_post_meta( get_the_id(), 'hero_content', true ); ?>

<section class="block block-hero block-hero-normal">
  <div class="container">

    <div class="content">
      <h1><?php the_title() ?></h1>

      <?php if ( ! empty( $hero_content ) ) {
        echo wpautop( $hero_content );
      }

      if ( 4449 === get_the_id() ) : ?>
        <p><a href="<?php echo get_post_type_archive_link( 'reference' ) ?>">Mitä helvettiä? Missä työnäytteet?</a></p>
      <?php endif; ?>
    </div>

    <div class="featured-image featured-image-side" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'full' ) ?>);"></div>

  </div>
</section>
