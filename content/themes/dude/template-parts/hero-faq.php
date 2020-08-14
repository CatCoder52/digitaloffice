<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-08-14 22:44:03
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

<section class="block block-hero block-hero-faq block-hero-light has-light-bg">

  <?php if ( $bg_image ) { ?>
    <div class="featured-image" aria-hidden="true">
      <div class="shade" aria-hidden="true"></div>
        <div aria-hidden="true" class="background-image preview lazyload" style="background-image: url('<?php echo $bg_image_tiny; ?>');" data-src="<?php echo esc_url( $bg_image ); ?>" data-src-mobile="<?php echo esc_url( $bg_image_mobile[0] ); ?>"></div>
        <div aria-hidden="true" class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>></div>
        <noscript><div aria-hidden="true" class="background-image full-image" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"></div></noscript>
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

      <ul class="faq-tags">
        <li><a href="#aikataulu" class="js-trigger no-text-link">Aikataulu</a></li>
        <li><a href="#hinnoittelu" class="js-trigger no-text-link">Hinnoittelu</a></li>
        <li><a href="#yllapito" class="js-trigger no-text-link">WordPress-ylläpito</a></li>
      </ul>

    </div>

  </div>
</section>
