<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dude
 */

the_post();

$quote_pre_title = get_post_meta( get_the_id(), 'quote_pre_title', true );
$quote = get_post_meta( get_the_id(), 'quote', true );
$quote_company = get_post_meta( get_the_id(), 'quote_company', true );
$quote_person = get_post_meta( get_the_id(), 'quote_person', true );
$quote_person_title = get_post_meta( get_the_id(), 'quote_person_title', true );
$quote_person_image = get_post_meta( get_the_id(), 'quote_person_image', true );

$small_references = wp_cache_get( get_the_id() . '_references', 'theme' );

if ( ! $small_references ) {
  $args = array(
    'post_type'               => 'reference',
    'post_status'             => 'publish',
    'orderby'                 => 'rand',
    'posts_per_page'          => 3,
    'meta_key'                => '_thumbnail_id', // phpcs:ignore
    'post__not_in'            => array( get_the_id() ),
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
        'image_url'         => get_the_post_thumbnail_url( get_the_id(), 'large' ),
        'image_url_mobile'  => get_the_post_thumbnail_url( get_the_id(), 'large' ),
        'image_preload_url' => get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ),
        'excerpt'           => get_post_meta( get_the_id(), 'short_desc', true ),
        'permalink'         => get_the_permalink(),
      );
    }
  }

  wp_reset_postdata();

  wp_cache_set( get_the_id() . '_references', $small_references, 'theme', DAY_IN_SECONDS );
}

get_header(); ?>

<div class="content-area">
	<main role="main" id="main" class="site-main">

    <?php get_template_part( 'template-parts/hero', get_post_type() ); ?>

    <section class="block block-single block-single-reference has-dark-bg">

      <div class="gutenberg-content swup-transition-fade">
        <?php the_content() ?>
      </div>

    </section>

    <?php if ( ! empty( $quote ) && ! empty( $quote_person ) && ! empty( $quote_person_title ) ) : ?>
      <section class="block block-testimonials block-reference-quote has-dark-bg">
        <div class="container">

          <h2 class="screen-reader-text">Asiakkaan palaute</h2>

          <div class="hreview testimonial">

              <?php if ( ! empty( $quote_person_image ) ) : ?>
                <div class="testimonial-avatar" aria-hidden="true" style="background-image: url('<?php echo wp_get_attachment_image_url( $quote_person_image, 'medium' ) ?>')"></div>
              <?php endif; ?>

              <div class="testimonial-content">
                <div class="description">
                  <?php echo wpautop( $quote ); ?>
                </div>

                <abbr class="rating screen-reader-text" title="5">*****</abbr>
                <p class="reviewer vcard"><span class="screen-reader-text">Review by</span>
                  <a class="url fn" href="<?php echo esc_html( get_the_permalink() ); ?>"><?php if ( ! empty( $quote_person ) ) : ?><?php echo esc_html( $quote_person ) ?>, <?php echo esc_html( strtolower( $quote_person_title ) ) ?><?php endif; ?><?php echo esc_html( $quote_company ); ?></a><abbr class="dtreviewed screen-reader-text" title="<?php echo esc_html( get_the_date( 'Y' ) ); ?>-<?php echo esc_html( get_the_date( 'm' ) ); ?>"><?php echo esc_html( get_the_date( 'F' ) ) ?> <?php echo esc_html( get_the_date( 'Y' ) ); ?></abbr>
                </p>

              </div>

            </div>

        </div>
      </section>
    <?php endif; ?>

    <?php if ( ! empty( $small_references ) ) : ?>
      <section class="block block-references block-references-archive block-references-related has-dark-bg">
        <div class="container">

          <h2 class="block-title block-title-large">Katso myös nämä</h2>

          <div class="reference-wrapper reference-wrapper-cols">
            <?php foreach ( $small_references as $reference ) : ?>
              <div class="reference">
                <a href="<?php echo esc_html( $reference['permalink'] ) ?>" class="global-link"><span class="screen-reader-text"><?php the_title() ?></span></a>

                  <div class="reference-image" aria-hidden="true">
                    <div class="image" aria-hidden="true">
                      <div class="background-image preview lazyload" style="background-image: url('<?php echo $reference['image_url_mobile']; ?>');" data-src="<?php echo $reference['image_url']; ?>" data-src-mobile="<?php echo $reference['image_url']; ?>" aria-hidden="true"></div>
                      <div aria-hidden="true" class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo $reference['image_url']; ?>');"<?php endif; ?>></div>
                      <noscript><div aria-hidden="true" class="background-image full-image" style="background-image: url('<?php echo $reference['image_url']; ?>');"></div></noscript>
                    </div>
                  </div>

                  <div class="reference-content">
                    <p aria-describedby="reference-<?php echo esc_html( sanitize_title( $reference['title'] ) ) ?>"><?php echo esc_html( $reference['title'] ) ?></p>
                    <h3 id="reference-<?php echo esc_html( sanitize_title( $reference['title'] ) ) ?>" class="reference-title"><?php echo get_post_meta( $reference['id'], 'short_desc', true ) ?></h3>
                  </div>

              </div>
            <?php endforeach; ?>
          </div>

        </div>
      </section>
    <?php endif; ?>

    <?php include get_theme_file_path( 'template-parts/modules/cta-with-phone-input.php' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
