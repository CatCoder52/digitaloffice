<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:48:37
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-14 16:43:56
 *
 * @package dude
 */

// Fields
$title = get_sub_field( 'title' );
$description = get_sub_field( 'description' );
$button = get_sub_field( 'cta-link' );
$services = get_sub_field( 'services' );
?>

<section class="block block-our-services">
  <div class="container">

    <header class="block-head screen-reader-text">
      <h2 class="block-title" id="block-title-our-services">Palvelumme</h2>
    </header>

    <div class="cols cols-services">

      <div class="col col-content">
        <?php if ( ! empty( $title ) ) : ?>
          <h2 class="col-title"><?php echo esc_attr( $title ); ?></h2>

          <?php if ( ! empty( $content ) ) {
            echo wpautop( $content ); // phpcs:ignore
          } ?>

          <?php if ( ! empty( $button ) ) : ?>
            <p class="link-wrapper"><a class="cta-link" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?></a></p>
          <?php endif; ?>
      </div>

      <?php if ( ! empty( $services ) ) : ?>
        <div class="col col-services">

        <?php foreach ( $services as $service ) :

          // Repeater fields
          $service_name = $service['service_name'];
          $service_description = $service['service_description'];
          ?>
            <div class="col-inner">
              <?php if ( ! empty( $service_name ) ) : ?>
                <h3><?php echo esc_attr( $service_name ); ?></h3>
              <?php endif; ?>

              <?php if ( ! empty( $service_description ) ) : ?>
                <?php echo wpautop( $service_description ); // phpcs:ignore ?>
              <?php endif; ?>
            </div>

          <?php endforeach; ?>

        </div>
      <?php endif; ?>

    </div>
    <?php endif; ?>

</section>
