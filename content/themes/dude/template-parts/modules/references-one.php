<?php
/**
 * @Author:             Roni Laukkarinen, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2020-07-14 14:28:13
 *
 * @package dude
 */

$reference = [];
$reference_id = get_sub_field( 'selected_reference' );

if ( empty( $reference_id ) || ! post_exists_id( $reference_id ) ) {
  return;
}

$thumbnail_id = get_post_meta( $reference_id, 'frontpage_upsell_image', true );
$title = get_post_meta( $reference_id, 'frontpage_upsell_title', true );
$description = get_post_meta( $reference_id, 'frontpage_upsell_desc', true );

if ( empty( $thumbnail_id ) ) {
  return;
}

/**
 * NB! This is needed in case references.php module is in the same page.
 * $big_reference_ids variable is used there to prevent showing same reference
 * twice on the same page.
 */
$big_reference_ids[] = $reference_id;

$reference = array(
  'id'                => $reference_id,
  'upper_title'       => get_the_title( $reference_id ),
  'title'             => ( ! empty( $title ) ) ? $title : get_the_title( $reference_id ),
  'thumbnail_id'      => $thumbnail_id,
  'excerpt'           => ( ! empty( $description ) ) ? $description : get_the_excerpt( $reference_id ),
  'permalink'         => get_the_permalink( $reference_id ),
); ?>

<section class="block block-references-one">
  <div class="container">

    <header class="block-head screen-reader-text">
      <h2 class="block-title" id="block-title-our-services">Referenssit</h2>
    </header>

    <div class="cols cols-two">

      <div class="col col-content">
        <p aria-describedby="$reference['title']"><?php echo esc_html( $reference['upper_title'] ); ?></p>
        <h3 id="<?php echo esc_attr( $reference['title'] ) ?>"><?php echo esc_html( $reference['title'] ); ?></h3>
        <p><?php echo $reference['excerpt']; // phpcs:ignore ?></p>
        <p class="arrow-link-wrapper"><a href="<?php echo esc_html( $reference['permalink'] ) ?>" class="arrow-link">Tutustu työhön<span class="arrow"></span></a></p>
      </div>

      <div class="col col-reference-image col-reference-image-main">
        <?php image_lazyload_div( $reference['thumbnail_id'] ); ?>
      </div>

    </div>

  </div>
</section>

