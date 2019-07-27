<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php
    get_template_part( 'template-parts/hero' );

    if ( have_posts() ) : ?>
      <section class="block block-references block-references-archive">
        <div class="container">

          <h2 class="screen-reader-text">Referenssit</h2>

          <div class="cols cols-references">
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="col">
                <div class="col-featured-image">
                  <a href="<?php the_permalink() ?>" class="global-link"><span class="screen-reader-text"><?php the_title() ?></span></a>
                  <div class="reference-image has-lazyload">
                    <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>" data-src-mobile="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
                    <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
                    <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
                  </div>
                </div>

                <div class="content">
                  <h3 class="block-title>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                  <p><?php echo get_post_meta( get_the_id(), 'short_desc', true ) ?></p>

                  <p class="arrow-link-wrapper"><a href="<?php the_permalink() ?>" class="arrow-link">Tsekkaa työnäyte<span class="arrow"></span></a></p>
                </div>
              </div>
            <?php endwhile; ?>
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

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
