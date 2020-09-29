<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

get_header(); ?>

<div class="content-area">
	<main role="main" id="main" class="site-main">

    <?php
    get_template_part( 'template-parts/hero' );

    if ( have_posts() ) : ?>
      <section class="block block-references block-references-archive has-dark-bg">
        <div class="container">

          <h2 class="screen-reader-text">Referenssit</h2>

          <div class="reference-wrapper reference-wrapper-cols">
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="reference swup-transition-fade">
                <a href="<?php the_permalink() ?>" class="global-link"><span class="screen-reader-text"><?php the_title() ?></span></a>

                <div class="reference-image" aria-hidden="true">
                  <div class="image" aria-hidden="true">
                    <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>" data-src-mobile="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>" aria-hidden="true"></div>
                    <div aria-hidden="true" class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
                  </div>

                  <div class="reference-content">
                    <p aria-describedby="reference-<?php echo esc_html( sanitize_title( get_the_title() ) ) ?>"><?php echo esc_html( get_the_title() ) ?></p>
                    <h3 id="reference-<?php echo esc_html( sanitize_title( get_the_title() ) ) ?>" class="reference-title"><?php echo get_post_meta( get_the_id(), 'short_desc', true ) ?></h3>
                  </div>
                </div>

              </div>
            <?php endwhile; ?>
          </div>

        </div>
      </section>
    <?php endif; ?>

    <?php include get_theme_file_path( 'template-parts/content-modular.php' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
