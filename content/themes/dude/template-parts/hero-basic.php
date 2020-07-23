<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 11:34:45
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
?>

<section class="block block-hero block-hero-basic block-hero-light is-centered">

  <div class="container">

    <div class="content">
      <h1 class="swup-transition-fade"><?php echo esc_html( $title ); ?></h1>

        <?php if ( ! empty( $content ) ) { ?>
          <div class="hero-description swup-transition-fade">
            <?php echo wpautop( $content ); // phpcs:ignore ?>
          </div>
        <?php } ?>

      <?php if ( ! empty( $button ) ) : ?>
        <p class="button-wrapper swup-transition-fade"><a class="button button-glitch button-mint" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?><?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a></p>
      <?php endif; ?>
    </div>

  </div>
</section>
