<?php
/**
 * @Author:             Roni Laukkarinen, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:48:37
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:10:30
 *
 * @package dude
 */

// Fields
$title = get_sub_field( 'title' );
$content = get_sub_field( 'text' );
$button = get_sub_field( 'cta-link' );
?>

<section class="block block-title-left-text-right has-light-bg">
  <div class="container">

    <div class="cols swup-transition-fade">
      <div class="col col-title">
        <?php if ( ! empty( $title ) ) : ?>
          <h2><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
      </div>

      <div class="col col-text">
        <?php if ( ! empty( $content ) ) {
          echo wpautop( $content ); // phpcs:ignore
        } ?>

        <?php if ( ! empty( $button ) ) : ?>
          <p class="link-wrapper"><a class="cta-link" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?></a></p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>
