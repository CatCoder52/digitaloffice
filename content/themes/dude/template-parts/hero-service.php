<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-08-14 22:45:03
 *
 * @package dude
 */

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}

// Fields
$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'title_alt', true );
$content = get_post_meta( get_the_id(), 'hero_content', true );
$button = get_post_meta( get_the_id(), 'hero_button', true );
?>

<section class="block block-hero block-hero-service<?php if ( is_page( 9 ) ) : ?> has-dark-bg<?php else : ?> has-light-bg<?php endif; ?>">

  <?php if ( $bg_image ) { ?>
    <div class="featured-image" aria-hidden="true">
      <div class="shade" aria-hidden="true"></div>
      <div class="lazy" data-bg="<?php echo esc_url( $bg_image ); ?>" aria-hidden="true"></div>
    </div>
  <?php } ?>

<div class="container">

    <h1 id="content" class="swup-transition-fade"><?php the_title() ?></h1>

    <div class="service-hero-wrap swup-transition-fade">
      <div class="content">
        <?php if ( ! empty( $content ) ) {
          echo wpautop( $content ); // phpcs:ignore
        } ?>

        <?php if ( ! empty( $button ) ) : ?>
          <p class="button-wrapper"><a class="button button-glitch button-mint" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?><?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a></p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>
