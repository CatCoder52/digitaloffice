<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-07 13:22:11
 *
 * @package dude2019
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'singular_alt_title', true );
$logofile = get_post_meta( get_the_id(), 'logo_svg', true );
$url = get_post_meta( get_the_id(), 'url', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
} ?>

<section class="block block-hero-reference">

  <div class="container">

    <div class="cols">
      <div class="col">
        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
          <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
        </div>
      </div>

      <div class="col has-grey-bg">
        <p class="breadcrumb"><a href="<?php echo get_post_type_archive_link( 'reference' ) ?>">Töitämme</a> <?php include get_theme_file_path( '/svg/arrow-breadcrumb.svg' ); ?> <?php the_title() ?></p>

        <div class="content">
          <?php if ( ! empty( $logofile ) && file_exists( get_theme_file_path( "svg/logos/{$logofile}.svg" ) ) ) {
            include get_theme_file_path( "svg/logos/{$logofile}.svg" );
          } ?>

          <h1><?php echo esc_html( $title ) ?></h1>
          <?php the_excerpt(); ?>

          <p class="arrow-link-wrapper"><a href="<?php echo esc_url( $url ) ?>" class="arrow-link">Vieraile sivustolla<span class="arrow"></span></a></p>
        </div>
      </div>
    </div>

  </div>
</section>
