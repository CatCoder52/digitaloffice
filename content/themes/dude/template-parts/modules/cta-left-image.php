<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 15:07:09
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-18 16:32:28
 *
 * @package dude2019
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
      <div class="col">
        <div class="image" style="background-image: url('<?php echo esc_url( wp_get_attachment_url( $bg_image ) ) ?>');"></div>
      </div>

      <div class="col">
        <div class="content">
          <h2 class="block-title"><?php echo esc_html( $title ) ?></h2>
          <?php echo wpautop( $content );
          echo do_shortcode( '[gravityform id=1 title=false description=false ajax=true tabindex=49]' ); ?>
          <p class="end-note is-centered">Fuck the phone, I wanna send <a href="https://www.dude.fi/yhteystiedot">email</a></p>
        </div>
      </div>
    </div>

  </div>
</section>
