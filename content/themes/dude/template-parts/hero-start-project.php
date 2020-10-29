<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-08-14 22:45:19
 *
 * @package dude
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'title_alt', true );
$content = get_post_meta( get_the_id(), 'hero_content', true );
$button = get_post_meta( get_the_id(), 'hero_button', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
}

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}
?>

<section class="block block-hero block-hero-light block-hero-start-project is-centered">

  <?php if ( $bg_image ) { ?>
    <div class="featured-image" aria-hidden="true">
      <div class="shade" aria-hidden="true"></div>
      <div class="lazy" data-bg="<?php echo esc_url( $bg_image ); ?>" aria-hidden="true"></div>
    </div>
  <?php } ?>

  <div class="container">

    <div class="content">
      <h1 id="content" class="swup-transition-fade"><?php echo esc_html( $title ); ?></h1>

      <?php if ( ! empty( $content ) ) { ?>
        <div class="hero-description swup-transition-fade">
          <?php echo wpautop( $content ); // phpcs:ignore ?>
        </div>
      <?php } ?>

      <?php if ( ! empty( $button ) ) : ?>
        <p class="button-wrapper swup-transition-fade"><a class="button button-glitch button-mint" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?><?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a></p>
      <?php endif; ?>

      <a href="#lomake" class="js-trigger" data-mt-duration="300"><svg class="arrow-down swup-transition-fade" xmlns="http://www.w3.org/2000/svg" width="18" height="97" viewBox="0 0 18 97"><path fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.148 1.08v94.296m0 0l7.228-7.228m-7.228 7.228L1.92 88.148"/></svg></a>

    </div>

  </div>
</section>
