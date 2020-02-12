<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 15:07:09
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-12 17:43:36
 *
 * @package dude
 */

$bg_image = get_sub_field( 'bg_image' );
$title = get_sub_field( 'title' );
$content = get_sub_field( 'content' );

if ( empty( $bg_image ) || empty( $title ) || empty( $content ) ) {
  return;
} ?>

<section class="block block-cta-left-image">
  <div class="container">

    <div class="cols">
      <div class="col col-image">
        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_image, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo wp_get_attachment_image_url( $bg_image, 'large' ) ?>" data-src-mobile="<?php echo wp_get_attachment_image_url( $bg_image, 'large' ) ?>"></div>
          <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_image, 'large' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo wp_get_attachment_image_url( $bg_image, 'large' ) ?>');"></div></noscript>
        </div>
      </div>

      <div class="col col-content">
        <div class="content">
          <h2 class="block-title"><?php echo esc_html( $title ) ?></h2>
          <?php echo wpautop( $content );
          echo do_shortcode( '[gravityform id=1 title=false description=false ajax=true tabindex=49]' ); ?>
          <p class="end-note is-centered"><a href="https://www.dude.fi/yhteystiedot">Fuck the phone, I wanna send email</a></p>
        </div>
      </div>
    </div>

  </div>
</section>
