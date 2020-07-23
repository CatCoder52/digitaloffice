<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:09:36
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
    'meta_key'                => 'reference_is_timang', // phpcs:ignore
    'no_found_rows'           => true,
    'cache_results'           => true,
    'update_post_term_cache'  => false,
    'update_post_meta_cache'  => false,
    'fields'                  => 'ids',
  );

  if ( isset( $big_reference_ids ) ) {
		$args['post__not_in'] = $big_reference_ids;
  }

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
      'alt_image_listings_preload' => get_field( 'alt_image_listings', get_the_id() )['sizes']['tiny-preload-thumbnail'],
      'alt_image_listings' => get_field( 'alt_image_listings', get_the_id() ),
		  );
			}
  }
  wp_reset_postdata();

  wp_cache_set( get_the_id() . '_references', $references, 'theme', DAY_IN_SECONDS );
} ?>

<section class="block block-references has-dark-bg">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title">Töitämme</h2>

      <div class="floating-actions">
        <div class="custom-arrows-references"></div>
      </div>
    </header>

    <div class="reference-wrapper reference-slider">

      <?php foreach ( $references as $reference ) :
          if ( ! empty( $reference['alt_image_listings'] ) ) :
            $feat_image_tiny = $reference['alt_image_listings_preload'];
            $feat_image = $reference['alt_image_listings']['url'];
          else :
            $feat_image_tiny = $reference['image_preload_url'];
            $feat_image = $reference['image_url'];
          endif;
        ?>
        <div class="reference">
          <a href="<?php echo $reference['permalink'] ?>" class="global-link"><span class="screen-reader-text"><?php echo esc_html( $reference['title'] ) ?></span></a>

          <div class="reference-image">
            <div class="image" aria-hidden="true">
              <div class="background-image preview lazyload" style="background-image: url('<?php echo $feat_image_tiny; ?>');" data-src="<?php echo $feat_image; ?>" data-src-mobile="<?php echo $feat_image_tiny; ?>" aria-hidden="true"></div>
              <div aria-hidden="true" class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo $feat_image; ?>');"<?php endif; ?>></div>
              <noscript><div aria-hidden="true" class="background-image full-image" style="background-image: url('<?php echo $feat_image; ?>');"></div></noscript>
            </div>

            <div class="reference-content">
              <p aria-describedby="reference-<?php echo esc_html( sanitize_title( $reference['title'] ) ) ?>"><?php echo esc_html( $reference['title'] ) ?></p>
              <h3 id="reference-<?php echo esc_html( sanitize_title( $reference['title'] ) ); ?>" class="reference-title"><?php echo esc_html( $reference['excerpt'] ) ?></h3>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

