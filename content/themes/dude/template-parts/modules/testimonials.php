<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:48:37
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-10-12 19:37:03
 *
 * @package dude
 */

$args = array(
  'post_type'               => 'reference',
  'post_status'             => 'publish',
  'orderby'                 => 'rand',
  'posts_per_page'          => 50,
  'meta_key'                => '_thumbnail_id', // phpcs:ignore
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
		'id'                            => get_the_id(),
		'permalink'                     => get_the_permalink(),
		'quote'                         => get_post_meta( get_the_id(), 'quote_short', true ),
		'quote_company'                 => get_the_title(),
		'quote_person'                  => get_post_meta( get_the_id(), 'quote_person', true ),
		'quote_person_image'            => get_post_meta( get_the_id(), 'quote_person_image', true ),
		'created_date_y'                => get_the_date( 'Y' ),
		'created_date_m'                => get_the_date( 'm' ),
		'created_date_writtenmonth'     => get_the_date( 'F' ),
		);
  }
}
?>

<section class="block block-testimonials block-testimonials-slider has-dark-bg">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title screen-reader-text" id="block-title-our-services">Asiakkaidemme kokemuksia</h2>

      <div class="floating-actions">
        <div class="custom-arrows"></div>
        <div class="slide-numbering"><span class="current"></span>/<span class="total"></span></div>
      </div>
    </header>

    <?php if ( ! empty( $references ) ) : ?>
    <div class="testimonials slider">
      <?php foreach ( $references as $reference ) :

          // There has to be quote, so let's check that first
          if ( ! empty( $reference['quote'] ) ) : ?>

      <div class="hreview testimonial">
        <?php if ( ! empty( $reference['quote_person_image'] ) ) : ?>
        <div class="testimonial-avatar" aria-hidden="true"><div aria-hidden="true" data-defer="<?php echo esc_url( wp_get_attachment_image_url( $reference['quote_person_image'], 'medium' ) ); ?>" class="background-image"></div></div>

        <?php endif; ?>

        <div class="testimonial-content">
          <div class="description">
            <?php echo wpautop( $reference['quote'] ); // phpcs:ignore ?>
          </div>

          <abbr class="rating screen-reader-text" title="5">*****</abbr>
          <p class="reviewer vcard"><span class="screen-reader-text">Review by</span>
            <a class="url fn" href="<?php echo esc_html( $reference['permalink'] ); ?>"><?php if ( ! empty( $reference['quote_person'] ) ) : ?><?php echo esc_html( $reference['quote_person'] ) ?>, <?php endif; ?><?php echo esc_html( $reference['quote_company'] ); ?></a>
            <abbr class="dtreviewed screen-reader-text" title="<?php echo esc_html( $reference['created_date_y'] ); ?>-<?php echo esc_html( $reference['created_date_m'] ); ?>"><?php echo esc_html( $reference['created_date_writtenmonth'] ) ?> <?php echo esc_html( $reference['created_date_y'] ); ?></abbr>
          </p>
        </div>
      </div>

      <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>
