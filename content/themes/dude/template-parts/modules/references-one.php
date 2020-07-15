<?php
/**
 * @Author:             Roni Laukkarinen, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-15 12:17:32
 *
 * @package dude
 */

$reference = [];
$reference_id = get_sub_field( 'selected_reference' );

if ( empty( $reference_id ) ) {
  return;
}

$reference = array(
  'id'                => $reference_id,
  'upper_title'       => get_the_title( $reference_id ),
  'title'             => ( ! empty( $title ) ) ? $title : get_the_title( $reference_id ),
  'excerpt'           => ( ! empty( $description ) ) ? $description : get_the_excerpt( $reference_id ),
  'permalink'         => get_the_permalink( $reference_id ),
  'frontpage_upsell_image' => get_field( 'frontpage_upsell_image', $reference_id ),
  'frontpage_upsell_title' => get_field( 'frontpage_upsell_title', $reference_id ),
  'frontpage_upsell_desc' => get_field( 'frontpage_upsell_desc', $reference_id ),
  'image_skew' => get_field( 'image_skew', $reference_id ),
); ?>

<section class="block block-references-one">
  <div class="container">

    <div class="cols cols-two">

      <div class="col col-content">
        <p class="block-pre-title" aria-describedby="<?php echo esc_html( sanitize_title( $reference['frontpage_upsell_title'] ) ); ?>"><?php echo esc_html( $reference['upper_title'] ); ?></p>
        <h2 class="block-title" id="<?php echo esc_html( sanitize_title( $reference['frontpage_upsell_title'] ) ); ?>"><?php echo esc_html( $reference['frontpage_upsell_title'] ); ?></h2>

        <div class="content">
          <?php echo wpautop( $reference['frontpage_upsell_desc'] ); // phpcs:ignore ?>
        </div>

        <p class="button-wrapper"><a href="<?php echo esc_html( $reference['permalink'] ) ?>" class="button button-glitch button-mint">Tutustu työhön<?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a></p>
      </div>

      <div class="col col-reference-image col-reference-image-main">
        <?php image_lazyload_div( $reference['image_skew']['ID'] ); ?>
      </div>

    </div>

  </div>
</section>
