<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 16:41:23
 *
 * @package dude2019
 */

$content = get_post_meta( get_the_id(), 'hero_content', true ); ?>

<section class="block block-hero block-hero-service">
  <div class="container">

    <h1><?php the_title() ?></h1>

    <?php if ( ! empty( $hero_content ) ) {
      echo wpautop( $hero_content );
    }

    if ( isset( $logos ) ) : ?>
      <div class="logos logos-<?php echo count( $logos ) ?>">
        <?php foreach ( $logos as $logo ) : ?>
          <div class="col"><?php include get_theme_file_path( "svg/logos/{$logo}.svg" ) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
