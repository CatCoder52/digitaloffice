<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-30 17:49:45
 *
 * @package dude2019
 */

$hero_content = get_post_meta( get_the_id(), 'hero_content', true ); ?>

<section class="block block-hero block-hero-service block-hero-enable-transition">
  <div class="container">

    <h1 class="animate animate-1"><?php the_title() ?></h1>

    <div class="service-hero-wrap">
      <div class="content animate animate-2">
        <?php if ( ! empty( $hero_content ) ) {
          echo wpautop( $hero_content );
        } ?>
      </div>

      <?php if ( isset( $logos ) ) : ?>
        <section class="customer-logos animate animate-3">
          <ul class="customer-logos-list">
            <?php foreach ( $logos as $logo ) : ?>
              <li>
                <?php include get_theme_file_path( "svg/logos/{$logo}.svg" ) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
      <?php endif; ?>
    </div>

  </div>
</section>
