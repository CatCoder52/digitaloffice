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
    'meta_key'                => '_thumbnail_id',
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
        'image_preload_url' => get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ),
        'excerpt'           => get_post_meta( get_the_id(), 'short_desc', true ),
        'permalink'         => get_the_permalink(),
      );
    }
  }

  wp_reset_query();

  wp_cache_set( get_the_id() . '_references', $small_references, 'theme', DAY_IN_SECONDS );
}

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php get_template_part( 'template-parts/hero', get_post_type() ); ?>

    <section class="block block-single block-single-reference">
      <div class="container">

        <div class="entry-content">
          <?php the_content() ?>
        </div><!-- .entry-content -->

      </div>
    </section>

    <?php if ( ! empty( $quote ) && ! empty( $quote_person ) && ! empty( $quote_person_title ) ) : ?>
      <section class="block block-reference-quote">
        <div class="container">

          <?php if ( ! empty( $quote_pre_title ) ) : ?>
            <h2><?php echo esc_html( $quote_pre_title ) ?></h2>
          <?php endif; ?>

          <blockquote>
            <?php echo wpautop( $quote ); ?>
          </blockquote>

          <div class="quote-author-info">
            <?php if ( ! empty( $quote_person_image ) ) : ?>
              <div class="avatar" style="background-image: url('<?php echo wp_get_attachment_image_url( $quote_person_image, 'medium' ) ?>')"></div>
            <?php endif; ?>
            <p><span class="quote-person"><?php echo esc_html( $quote_person ) ?></span>
            <span class="quote-person-title"><?php echo esc_html( $quote_person_title ) ?></span></p>
          </div>

        </div>
      </section>
    <?php endif; ?>

    <section class="block block-cta-text block-cta-text-single-reference">
      <div class="container">

        <h2 class="block-title">Kova meno. Olen vakuuttunut, haluan ottaa yhteyttä.</h2>
        <p><a class="cta-link" href="/yhteystiedot">Ota yhteyttä</a></p>

      </div>
    </section>

    <?php if ( ! empty( $small_references ) ) : ?>
      <section class="block block-references block-references-related">
        <div class="container">

         <header class="block-head block-head-related">
          <p class="block-title-pre" aria-describedby="block-title-related-references">Muita töitämme</p>
          <h2 class="block-title" id="block-title-related-references">Tsekkaa myös nämä</h2>
        </header>

          <div class="cols cols-references">
            <?php foreach ( $small_references as $reference ) : ?>
              <div class="col">
                <div class="reference-image">
                  <a href="<?php echo esc_html( $reference['permalink'] ) ?>" class="global-link"><span class="screen-reader-text"><?php the_title() ?></span></a>
                  <div class="background-image preview lazyload" style="background-image: url('<?php echo $reference['image_preload_url']; ?>');" data-src="<?php echo $reference['image_url']; ?>"></div>
                  <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $reference['image_url']; ?>');"<?php endif; ?>></div>
                  <noscript><div class="background-image full-image" style="background-image: url('<?php echo $reference['image_url']; ?>');"></div></noscript>
                </div>

                <div class="col-content">
                  <h3 class="block-title>"><a href="<?php echo esc_html( $reference['permalink'] ) ?>"><?php echo esc_html( $reference['title'] ) ?></a></h3>
                  <p><?php echo esc_html( $reference['excerpt'] ) ?></p>

                  <p class="arrow-link-wrapper"><a href="<?php echo esc_html( $reference['permalink'] ) ?>" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

        </div>
      </section>
    <?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
