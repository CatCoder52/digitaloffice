<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:05:45
 *
 * @package dude
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'singular_alt_title', true );
$logofile = get_post_meta( get_the_id(), 'logo_svg', true );
$url = get_post_meta( get_the_id(), 'url', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
} ?>

<section class="block block-hero block-hero-reference is-centered has-dark-bg">

  <div class="container">
    <div class="content">

      <h1 class="swup-transition-fade"><?php echo esc_html( $title ); ?></h1>

        <div class="hero-description swup-transition-fade">
          <?php the_excerpt(); ?>

          <p class="button-wrapper"><a class="button button-glitch button-mint" href="<?php echo esc_url( $url ) ?>">Siirry sivustolle<?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a></p>
        </div>

    </div>
  </div>

</section>
