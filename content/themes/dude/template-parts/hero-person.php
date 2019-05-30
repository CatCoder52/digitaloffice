<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-30 16:00:36
 *
 * @package dude2019
 */

$job_title = get_post_meta( get_the_id(), 'title', true );
$tel = get_post_meta( get_the_id(), 'tel', true );
$email = get_post_meta( get_the_id(), 'email', true );
$social = get_field( 'social_media' );

if ( ! empty( $social ) ) {
  foreach ( $social as $key => $item ) {
    if ( empty( $item['name'] ) || empty( $item['value'] ) ) {
      unset( $social[ $key ] );
    }
  }
} ?>

<section class="block block-hero block-hero-person">
  <div class="container">

    <div class="featured-image featured-image-side">
      <div class="shade"></div>

      <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'preload' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
      <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
      <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>

    </div>

    <div class="content">

      <p class="title-pre" aria-describedby="person-name"><?php echo esc_html( $job_title ) ?></p>
      <h1 class="person-name"><?php get_the_title() ?></h1>

      <p class="contact">
        <a href="mailto:<?php echo esc_attr( $email ) ?>"><?php echo esc_html( $email ) ?></a>
        <?php if ( ! empty( $tel ) ) : ?>
          <br/><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $tel ) ) ?>"><?php echo esc_html( $tel ) ?></a>
        <?php endif; ?>
      </p>

      <?php if ( ! empty( $social ) ) : ?>
        <div class="social">
          <?php foreach ( $social as $item ) :
            $icon = sanitize_title( $item['name'] ); ?>
            <a href="<?php echo esc_url( $item['value'] ) ?>"><?php include get_theme_file_path( "svg/social/{$icon}.svg" ) ?><span class="screen-reader-text"><?php echo esc_html( $item['name'] ) ?></span></a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>

  </div>
</section>
