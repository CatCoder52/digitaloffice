<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-14 16:55:42
 *
 * @package dude
 */

$main_reference = array();
$main_reference_id = get_sub_field( 'main_reference' );
$small_references = wp_cache_get( get_the_id() . '_references', 'theme' );

if ( ! $small_references ) {
  $args = array(
    'post_type'               => 'reference',
    'post_status'             => 'publish',
    'orderby'                 => 'rand',
    'posts_per_page'          => 50,
    'meta_key'                => '_thumbnail_id',
    // 'post__not_in'            => array( $main_reference_id ),
    'no_found_rows'           => true,
    'cache_results'           => true,
    'update_post_term_cache'  => false,
    'update_post_meta_cache'  => false,
    'fields'                  => 'ids',
  );

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
      $query->the_post();

      $small_references[] = array(
        'id'                => get_the_id(),
        'title'             => get_the_title(),
        'image_preload_url' => get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ),
        'image_url'         => get_the_post_thumbnail_url( get_the_id(), 'large' ),
        'image_url_mobile'  => get_the_post_thumbnail_url( get_the_id(), 'large' ),
        'excerpt'           => get_post_meta( get_the_id(), 'short_desc', true ),
        'permalink'         => get_the_permalink(),
      );
    }
  }

  wp_reset_query();

  wp_cache_set( get_the_id() . '_references', $small_references, 'theme', DAY_IN_SECONDS );
}

// if ( ! empty( $main_reference_id ) ) {
//   $main_reference = array(
//     'id'                => $main_reference_id,
//     'title'             => get_the_title( $main_reference_id ),
//     'image_preload_url' => get_the_post_thumbnail_url( $main_reference_id, 'tiny-preload-thumbnail' ),
//     'image_url'         => get_the_post_thumbnail_url( $main_reference_id, 'full' ),
//     'image_url_mobile'  => get_the_post_thumbnail_url( $main_reference_id, 'large' ),
//     'excerpt'           => get_the_excerpt( $main_reference_id ),
//     'permalink'         => get_the_permalink( $main_reference_id ),
//     'logofile'          => get_post_meta( $main_reference_id, 'logo_svg', true ),
//     'quote'             => array(
//       'content'       => get_post_meta( $main_reference_id, 'quote', true ),
//       'person'        => get_post_meta( $main_reference_id, 'quote_person', true ),
//       'person_title'  => get_post_meta( $main_reference_id, 'quote_person_title', true ),
//     ),
//   );
// }

// if ( empty( $main_reference ) && empty( $small_references ) ) {
//   return;
// }
?>

<section class="block block-references">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title" id="block-title-our-services">Toteuttamiamme verkkopalveluita</h2>

      <div class="floating-actions">
        <div class="custom-arrows-references"></div>
      </div>
    </header>

    <div class="reference-slider">

    <?php if ( ! empty( $small_references ) ) : ?>
        <?php $count = 1; foreach ( $small_references as $reference ) :
        if ( $count % 3 == 1 ) : ?>
          <div class="reference-wrapper">
        <?php endif; ?>

          <div class="reference">

            <div class="reference-image">
              <a href="<?php echo $reference['permalink'] ?>" class="global-link"><span class="screen-reader-text"><?php echo esc_html( $reference['title'] ) ?></span></a>
              <div class="background-image preview lazyload" style="background-image: url('<?php echo $reference['image_preload_url']; ?>');" data-src="<?php echo $reference['image_url']; ?>" data-src-mobile="<?php echo $reference['image_url_mobile']; ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $reference['image_url']; ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo $reference['image_url']; ?>');"></div></noscript>
            </div>

            <div class="reference-content">
              <h3 class="reference-title"><a href="<?php echo esc_html( $reference['permalink'] ) ?>"><?php echo esc_html( $reference['title'] ) ?></a></h3>
              <p><?php echo esc_html( $reference['excerpt'] ) ?></p>
            </div>
          </div>

          <?php if ( $count % 3 == 0 ) : ?>
            </div>
          <?php endif; ?>
        <?php $count++; endforeach; ?>

      </div>
    <?php endif; ?>
    </div>

  </div>
</section>

