<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-30 16:07:15
 *
 * @package dude2019
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'title_alt', true );
$logofile = get_post_meta( get_the_id(), 'logo_svg', true );
$url = get_post_meta( get_the_id(), 'url', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
} ?>

<section class="block block-hero block-hero-reference">
  <div class="container">

    <div class="featured-image featured-image-side">
      <div class="shade"></div>

      <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
      <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
      <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>

    </div>

    <div class="content">
      <p><a href="<?php echo get_post_type_archive_link( 'reference' ) ?>">Työt</a> <?php the_title() ?></p>

      <?php if ( ! empty( $logofile ) && file_exists( get_theme_file_path( "svg/logos/{$logofile}.svg" ) ) ) {
        include get_theme_file_path( "svg/logos/{$logofile}.svg" );
      } ?>

      <h1><?php echo esc_html( $title ) ?></h1>
      <?php the_excerpt(); ?>

      <p class="arrow-link-wrapper"><a href="<?php echo esc_url( $url ) ?>" class="arrow-link">Vieraile sivustolla<span class="arrow"></span></a></p>
    </div>

  </div>
</section>
