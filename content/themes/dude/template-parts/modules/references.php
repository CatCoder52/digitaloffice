<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-30 17:22:31
 *
 * @package dude2019
 */

$main_reference = array();
$main_reference_id = get_sub_field( 'main_reference' );
$small_references = wp_cache_get( get_the_id() . '_references', 'theme' );

if ( ! $small_references ) {
  $args = array(
    'post_type'               => 'reference',
    'post_status'             => 'publish',
    'orderby'                 => 'rand',
    'posts_per_page'          => 2,
    'meta_key'                => '_thumbnail_id',
    'post__not_in'            => array( $main_reference_id ),
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
        'excerpt'           => get_the_excerpt(),
        'permalink'         => get_the_permalink(),
      );
    }
  }

  wp_reset_query();

  wp_cache_set( get_the_id() . '_references', $small_references, 'theme', DAY_IN_SECONDS );
}

if ( ! empty( $main_reference_id ) ) {
  $main_reference = array(
    'id'                => $main_reference_id,
    'title'             => get_the_title( $main_reference_id ),
    'image_preload_url' => get_the_post_thumbnail_url( $main_reference_id, 'tiny-preload-thumbnail' ),
    'image_url'         => get_the_post_thumbnail_url( $main_reference_id, 'full' ),
    'excerpt'           => get_the_excerpt( $main_reference_id ),
    'permalink'         => get_the_permalink( $main_reference_id ),
    'logofile'          => get_post_meta( $main_reference_id, 'logo_svg', true ),
    'quote'             => array(
      'content'       => get_post_meta( $main_reference_id, 'quote', true ),
      'person'        => get_post_meta( $main_reference_id, 'quote_person', true ),
      'person_title'  => get_post_meta( $main_reference_id, 'quote_person_title', true ),
    ),
  );
}

if ( empty( $main_reference ) && empty( $small_references ) ) {
  return;
} ?>

<section class="block block-references">
  <div class="container">

    <header class="block-head">
      <p class="block-title-pre" aria-describedby="latest-works">Latest wörks</p>
      <h2 class="block-title" id="latest-works">Latest and greitest</h2>
    </header>

    <?php if ( ! empty( $main_reference ) ) : ?>
      <div class="background-image preview lazyload" style="background-image: url('<?php echo $main_reference['image_preload_url']; ?>');" data-src="<?php echo $main_reference['image_url']; ?>"></div>
      <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $main_reference['image_url']; ?>');"<?php endif; ?>></div>
      <noscript><div class="background-image full-image" style="background-image: url('<?php echo $main_reference['image_url']; ?>');"></div></noscript>

      <div class="cols">

        <div class="col has-grey-bg has-grey-bg-extend-left">
          <?php include get_theme_file_path( "svg/logos/{$main_reference['logofile']}.svg" ); ?>
          <h3 class="screen-reader-text"><?php echo esc_html( $main_reference['title'] ) ?></h3>
          <p><?php echo esc_html( $main_reference['excerpt'] ) ?></p>

          <p class="arrow-link-wrapper"><a href="<?php echo esc_html( $main_reference['permalink'] ) ?>" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
        </div>

        <div class="co col-quote">
          <blockquote><p><?php echo esc_html( $main_reference['quote']['content'] ) ?></p></blockquote>
          <footer><strong><?php echo esc_html( $main_reference['quote']['person'] ) ?></strong> <?php echo esc_html( $main_reference['quote']['person_title'] ) ?></footer>
        </div>

      </div>
    <?php endif;

    if ( ! empty( $small_references ) ) : ?>
      <div class="cols cols-references">

        <?php foreach ( $small_references as $reference ) : ?>
          <div class="col">
            <div class="background-image preview lazyload" style="background-image: url('<?php echo $reference['image_preload_url']; ?>');" data-src="<?php echo $reference['image_url']; ?>"></div>
            <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $reference['image_url']; ?>');"<?php endif; ?>></div>
            <noscript><div class="background-image full-image" style="background-image: url('<?php echo $reference['image_url']; ?>');"></div></noscript>

            <div class="col-content">
              <h3 class="block-title>"><?php echo esc_html( $reference['title'] ) ?></h3>
              <p><?php echo esc_html( $reference['excerpt'] ) ?></p>

              <p class="arrow-link-wrapper"><a href="<?php echo esc_html( $reference['permalink'] ) ?>" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    <?php endif; ?>

  </div>
</section>

