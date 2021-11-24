<?php
/**
 * @Author: Roni Laukkarinen
 * @Date:   2020-07-16 17:32:53
 * @Last Modified by:   sippis
 * @Last Modified time: 2021-11-24 18:56:45
 * @package dude
 */

$image = get_sub_field( 'image' );
$title = get_sub_field( 'title' );
$centered_text = get_sub_field( 'centered_text' );
$button = get_sub_field( 'link' );

if ( empty( $image ) && is_singular( 'reference' ) ) {
  $image = [ 'ID' => 10274 ];
  $title = 'Soitteleeko?';
  $centered_text = 'Jos työnäyte puhutteli ja haluaisitte vähintäänkin yhtä hienon sivuston, jätäthän yhteystietosi ja Kristian on teihin pikimmiten yhteydessä.';
  $button = null;
}

if ( empty( $image ) ) {
  return;
}

if ( is_singular( 'reference' ) ) { ?>
  <style type="text/css">
    .block.block-cta-with-image {
      padding-top: 0 !important;
    }

    .block.block-cta-with-image h2 {
      color: #131a50 !important;
    }

    .block.block-cta-with-image p {
      color: #131a50 !important;
    }

    .block-cta-with-image #gform_wrapper_11 label.gfield_label {
      display: none !important;
    }

    .block-cta-with-image #gform_wrapper_11 .ginput_container_text input {
      width: 100% !important;
      border-bottom: 2px solid #131a50 !important;
    }

    .block-cta-with-image .col-content {
      background-color: #fff !important;
      padding: 7.5rem 7.25rem !important;
    }
  </style>
<?php } ?>

<section class="block block-cta-with-image">
  <div class="container">
    <div class="cols">

      <div class="col col-image"><?php vanilla_lazyload_div( $image['ID'] ); ?></div>
      <div class="col col-content">

        <div class="content">
          <?php if ( ! empty( $title ) ) : ?>
            <h2><?php echo esc_html( $title ); ?></h2>
          <?php endif; ?>

          <?php if ( ! empty( $centered_text ) ) : ?>
            <div class="text-content">
              <?php echo wpautop( $centered_text ); // phpcs:ignore ?>

              <?php if ( is_singular( 'reference' ) ) {
                if ( function_exists( 'gravity_form' ) ) {
                  gravity_form( 11, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = true, $echo = true );
                }
              } ?>
            </div>
          <?php endif; ?>

          <?php if ( ! empty( $button ) ) : ?>
          <p class="cta-link-wrapper"><a class="cta-link extra-external-link no-external-link-indicator" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( ! empty( $button['target'] ) ) : ?> target="<?php echo esc_html( $button['target'] ); ?>"<?php endif; ?>><?php echo esc_html( $button['title'] ); ?><?php if ( 'https://handbook.dude.fi' === $button['url'] ) : ?><?php include get_theme_file_path( '/svg/external-link.svg' ); ?><?php endif; ?></a></p>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php wp_reset_postdata();
