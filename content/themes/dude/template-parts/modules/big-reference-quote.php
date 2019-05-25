<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:07:55
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-25 16:09:04
 *
 * @package dude2019
 */

$title = get_sub_field( 'title' );
$person_image = get_sub_field( 'person_image' );
$reference = get_sub_field( 'reference' );
$button_text = get_sub_field( 'button_text' );

if ( empty( $title ) || empty( $reference ) || empty( $button_text ) ) {
  return;
}

if ( ! post_exists_id( $reference ) ) {
  return;
}

$logo = get_post_meta( $reference, 'logo_svg', true );
$quote_person = get_post_meta( $reference, 'quote_person', true );
$quote_person_title = get_post_meta( $reference, 'quote_person_title', true );
$quote = get_post_meta( $reference, 'quote', true );

if ( empty( $quote ) ) {
  return;
}

$quote = '"' . $quote . '"';

if ( empty( $button_text ) ) {
  $button_text = 'Tutustu referenssiin';
} ?>

<section class="block block-big-reference-quote<?php if ( ! empty( $person_image ) ) { echo ' has-person-image'; } ?>">
  <div class="container">

    <div class="cols">

      <?php if ( ! empty( $person_image ) ) : ?>
        <div class="col col-person-image" style="background-image: url('<?php echo wp_get_attachment_url( $person_image ) ?>'"></div>
      <?php endif; ?>

      <div class="col col-content">
        <?php if ( ! empty( $logo ) ) {
          include get_theme_file_path( "svg/logos/{$logo}.svg" );
        }

        if ( ! empty( $quote_person ) && ! empty( $quote_person_title ) ) : ?>
          <p class="block-title-pre block-title-pre-quote-person" aria-describedby="<?php echo sanitize_title( $quote_person ); ?>"><?php echo "{$quote_person}, {$quote_person_title}" ?></p>
        <?php endif; ?>

        <h2 class="block-title" id="<?php echo sanitize_title( $quote_person ); ?>"><?php echo get_the_title( $reference ) ?></h2>

        <blockquote>
          <?php echo wpautop( $quote ); ?>
        </blockquote>

        <p><a href="<?php echo get_the_permalink( $reference ) ?>" class="button"><span class="arrow-wrapper"><?php echo esc_html( $button_text ) ?><span class="long-arrow"></span></span></a></p>
      </div>

    </div>

</div>
</section>
