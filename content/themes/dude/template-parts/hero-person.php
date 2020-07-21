<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-21 15:06:28
 *
 * @package dude
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

<section class="block block-hero-person">
  <div class="container">
    <div class="cols">
      <div class="col">

      <div class="content">
        <header class="block-head">
          <p class="block-title-pre" aria-describedby="block-title-job-title"><?php echo esc_html( $job_title ) ?></p>
          <h1 class="block-title" id="block-title-job-title"><?php the_title() ?></h1>
        </header>

          <?php the_content(); ?>

          <p class="contact">
            <a class="contact-detail" href="mailto:<?php echo esc_attr( $email ) ?>"><?php echo esc_html( $email ) ?></a>
            <?php if ( ! empty( $tel ) ) : ?>
              <br/><a class="contact-detail" href="tel:<?php echo esc_attr( str_replace( ' ', '', $tel ) ) ?>"><?php echo esc_html( $tel ) ?></a>
            <?php endif; ?>
          </p>

          <?php if ( ! empty( $social ) ) : ?>
            <ul class="social">
              <?php foreach ( $social as $item ) :
                $icon = sanitize_title( $item['name'] ); ?>
                <li class="<?php echo $icon; ?>"><a class="contact-detail" href="<?php echo esc_url( $item['value'] ) ?>"><?php include get_theme_file_path( "svg/social/{$icon}.svg" ) ?><span class="screen-reader-text"><?php echo esc_html( $item['name'] ) ?></span></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>

      <div class="col col-person-image">
        <div class="image has-lazyload">
          <?php image_lazyload_tag( get_post_thumbnail_id( $post->ID ) ); ?>
        </div>
      </div>
    </div>
  </div>
</section>

