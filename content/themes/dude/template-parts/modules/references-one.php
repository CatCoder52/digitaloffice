<?php
/**
 * @Author:             Roni Laukkarinen, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2020-07-14 13:43:53
 *
 * @package dude
 */

$selected_reference = array();
$selected_reference_id = get_sub_field( 'selected_reference' );

if ( ! empty( $selected_reference_id ) ) {
  $selected_reference = array(
    'id'                => $selected_reference_id,
    'title'             => get_the_title( $selected_reference_id ),
    'image_preload_url' => get_the_post_thumbnail_url( $selected_reference_id,   'tiny-preload-thumbnail' ),
    'image_url'         => get_the_post_thumbnail_url( $selected_reference_id, 'full' ),
    'image_url_mobile'  => get_the_post_thumbnail_url( $selected_reference_id, 'large' ),
    'excerpt'           => get_the_excerpt( $selected_reference_id ),
    'permalink'         => get_the_permalink( $selected_reference_id ),
    'logofile'          => get_post_meta( $selected_reference_id, 'logo_svg', true ),
    'quote'             => array(
      'content'           => get_post_meta( $selected_reference_id, 'quote', true ),
      'person'            => get_post_meta( $selected_reference_id, 'quote_person', true ),
      'person_title'      => get_post_meta( $selected_reference_id, 'quote_person_title', true ),
    ),
  );
}

if ( empty( $selected_reference ) ) {
  return;
} ?>

<section class="block block-references-one">
  <div class="container">

    <header class="block-head screen-reader-text">
      <h2 class="block-title" id="block-title-our-services">Referenssit</h2>
    </header>

    <?php if ( ! empty( $selected_reference ) ) : ?>
      <div class="reference-image reference-image-main has-lazyload">
        <div class="background-image preview lazyload" style="background-image: url('<?php echo esc_url( $selected_reference['image_preload_url'] ); ?>');" data-src="<?php echo esc_url( $selected_reference['image_url'] ); ?>" data-src-mobile="<?php echo esc_url( $selected_reference['image_url'] ); ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo $selected_reference['image_url']; ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo esc_url( $selected_reference['image_url'] ); ?>');"></div></noscript>
      </div>

      <div class="cols cols-two">

        <div class="col">
          <?php include get_theme_file_path( "svg/logos/{$selected_reference['logofile']}.svg" ); ?>
          <h3><?php echo esc_html( $selected_reference['title'] ); ?></h3>
          <p><?php echo $selected_reference['excerpt']; // phpcs:ignore ?></p>

          <p class="arrow-link-wrapper"><a href="<?php echo esc_html( $selected_reference['permalink'] ) ?>" class="arrow-link">Tsekkaa työnäyte<span class="arrow"></span></a></p>
        </div>

        <div class="col col-quote">
          <blockquote><p><?php echo esc_html( $selected_reference['quote']['content'] ) ?></p></blockquote>
          <footer><strong><?php echo esc_html( $selected_reference['quote']['person'] ) ?></strong> <?php echo esc_html( $selected_reference['quote']['person_title'] ) ?></footer>
        </div>

      </div>
    <?php endif; ?>

  </div>
</section>

