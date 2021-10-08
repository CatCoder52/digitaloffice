<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-10-08 15:48:37
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

<section class="block block-hero block-hero-jobs is-centered has-light-bg">

  <?php if ( $bg_image ) { ?>
    <div class="featured-image" aria-hidden="true">
      <div class="shade" aria-hidden="true"></div>
      <div class="lazy" data-bg="<?php echo esc_url( $bg_image ); ?>" aria-hidden="true"></div>
    </div>
  <?php } ?>

  <div class="container">

    <div class="content">
      <h1 id="content"><?php echo esc_html( $title ); ?></h1>

      <?php if ( ! empty( $content ) ) { ?>
        <div class="hero-description swup-transition-fade">
          <?php echo wpautop( $content ); // phpcs:ignore ?>
        </div>
      <?php } ?>

      <?php if ( ! empty( $button['url'] ) || ! empty( $button['title'] ) ) : ?>
        <p class="button-wrapper">
          <a href="<?php echo esc_url( $button['url'] ); ?>" class="no-text-link no-external-link-indicator
          <?php if ( str_contains( $button['url'], '#' ) ) : ?>
            <?php echo ' js-trigger'; ?>
          <?php endif; ?>">
            <?php echo wp_kses_post( $button['title'] ); ?>
            <span class="screen-reader-text">Katso avoimet työpaikat</span>
          </a>
        </p>
      <?php endif; ?>
    </div>

    <?php include get_theme_file_path( '/svg/logo-big-white.svg' ); ?>
  </div>
</section>
