<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:50:23
 * @Last Modified by:   sippis
 * @Last Modified time: 2020-10-20 18:56:25
 *
 * @package dude
 */

$references = wp_cache_get( 'references_page_' . get_the_id(), 'theme' );

if ( ! $references ) {
  $args = array(
    'post_type'               => 'reference',
    'post_status'             => 'publish',
    'orderby'                 => 'rand',
    'posts_per_page'          => 8,
    'meta_key'                => 'reference_is_timang', // phpcs:ignore
    'meta_value'              => true,
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
        'image_id'          => get_post_thumbnail_id( get_the_id() ),
  			'excerpt'           => get_post_meta( get_the_id(), 'short_desc', true ),
        'permalink'         => get_the_permalink(),
		  );
		}
  } wp_reset_postdata();

  wp_cache_set( 'references_page_' . get_the_id(), $references, 'theme', DAY_IN_SECONDS );
} ?>

<?php if ( is_page( '4485_disabled' ) ) : ?>
  <section class="block block-references has-dark-bg">
    <div class="container">

      <header class="block-head">
        <h2 class="block-title">Suunnittelemiamme logoja</h2>
      </header>

    </div>
  </section>
<?php endif; ?>

<section class="block block-references has-dark-bg">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title">Töitämme</h2>

      <div class="floating-actions">
        <div class="custom-arrows-references"></div>
      </div>
    </header>

    <div class="reference-wrapper reference-slider">

      <?php foreach ( $references as $reference ) : ?>
        <div class="reference">
          <a href="<?php echo $reference['permalink'] ?>" class="global-link"><span class="screen-reader-text"><?php echo esc_html( $reference['title'] ) ?></span></a>

          <div class="reference-image">
            <div class="image" aria-hidden="true">
              <?php vanilla_lazyload_div( $reference['image_id'] ); ?>
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

