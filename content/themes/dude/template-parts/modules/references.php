<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2020-07-14 13:59:16
 *
 * @package dude
 */

$references = wp_cache_get( get_the_id() . '_references', 'theme' );

if ( ! $references ) {
  $args = array(
    'post_type'               => 'reference',
    'post_status'             => 'publish',
    'orderby'                 => 'rand',
    'posts_per_page'          => 6,
    'meta_key'                => 'reference_is_timang',
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

      $references[] = array(
        'id'                => get_the_id(),
        'title'             => get_the_title(),
        'image_preload_url' => get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ),
        'image_url'         => get_the_post_thumbnail_url( get_the_id(), 'large' ),
        'image_url_mobile'  => get_the_post_thumbnail_url( get_the_id(), 'large' ),
        'excerpt'           => get_post_meta( get_the_id(), 'short_desc', true ),
        'permalink'         => get_the_permalink(),
      );
    }
  } wp_reset_query();

  wp_cache_set( get_the_id() . '_references', $references, 'theme', DAY_IN_SECONDS );
} ?>

<section class="block block-references">
  <div class="container">

    <div class="reference-slider">
      <div class="reference-wrapper">

        <?php foreach ( $references as $reference ) : ?>

          <div class="reference">
            <a href="<?php echo $reference['permalink'] ?>" class="global-link"><span class="screen-reader-text"><?php echo esc_html( $reference['title'] ) ?></span></a>

            <div class="reference-image">
              <div class="background-image preview lazyload" style="background-image: url('<?php echo $reference['image_preload_url']; ?>');" data-src="<?php echo $reference['image_url']; ?>" data-src-mobile="<?php echo $reference['image_url_mobile']; ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $reference['image_url']; ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo $reference['image_url']; ?>');"></div></noscript>
            </div>

            <div class="reference-content">
              <p aria-describedby="reference-<?php echo esc_attr( $reference['title'] ) ?>"><?php echo esc_html( $reference['title'] ) ?></p>
              <h3 id="reference-<?php echo esc_attr( $reference['title'] ) ?>" class="reference-title"><?php echo esc_html( $reference['excerpt'] ) ?></h3>
            </div>
          </div>

        <?php endforeach; ?>

      </div>
    </div>

  </div>
</section>

