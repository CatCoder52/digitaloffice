<?php
/**
 * @Author: Roni Laukkarinen
 * @Date:   2020-07-16 17:32:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-17 11:56:53
 * @package dude
 */

$image = get_sub_field( 'image' );
$title = get_sub_field( 'title' );
$centered_text = get_sub_field( 'centered_text' );
$button = get_sub_field( 'link' );

if ( empty( $image ) ) {
  return;
} ?>

<section class="block block-cta-with-image">
  <div class="container">
    <div class="cols">

      <div class="col col-image"><?php image_lazyload_div( $image['ID'] ); ?></div>
      <div class="col col-content">

        <div class="content">
          <?php if ( ! empty( $title ) ) : ?>
            <h2><?php echo esc_html( $title ); ?></h2>
          <?php endif; ?>

          <?php if ( ! empty( $centered_text ) ) : ?>
            <div class="text-content">
              <?php echo wpautop( $centered_text ); // phpcs:ignore ?>
            </div>
          <?php endif; ?>

          <?php if ( ! empty( $button ) ) : ?>
            <p class="cta-link-wrapper"><a class="cta-link" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?></a></p>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php wp_reset_postdata();
