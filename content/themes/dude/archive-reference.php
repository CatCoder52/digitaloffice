<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

get_header();

get_template_part( 'template-parts/hero' ); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php if ( have_posts() ) : ?>
      <section class="block block-references">
        <div class="container">

          <div class="cols cols-references">
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="col">
                <div class="col-featured-image">
                  <div class="image" style="background-image: url('<?php echo the_post_thumbnail_url( 'large' ) ?>');"></div>
                </div>

                <div class="content">
                  <h3 class="block-title>"><?php the_title() ?></h3>
                  <p><?php the_excerpt() ?></p>

                  <p class="arrow-link-wrapper"><a href="<?php the_permalink() ?>" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
                </div>
              </div>
            <?php endwhile; ?>
          </div>

        </div>
      </section>
    <?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
