<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php if ( ! is_paged() && ! is_category() && ! is_tag() && ! is_author() ) :
      while( have_posts() ) : the_post(); ?>
        <section class="block block-blog-big">
          <div class="container">

            <div class="col col-image" style="background-image:url('<?php echo the_post_thumbnail_url( 'large' ); ?>')"></div>

            <div class="col col-content">
              <p class="date"><?php echo ucfirst( date_i18n( 'l' ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
              <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
              <?php the_excerpt() ?>

              <p class="arrow-link-wrapper"><a href="<?php the_permalink() ?>" class="arrow-link">Lue ploki<span class="arrow"></span></a></p>
            </div>

          </div>
        </section>
      <?php break; endwhile; ?>
    <?php else :
      include get_theme_file_path( 'template-parts/hero.php' );
    endif; ?>

    <section class="block block-blog">
      <div class="container">

        <div class="cols">
          <?php while( have_posts() ) : the_post(); ?>
            <div class="col">
              <div class="image" style="background-image:url('<?php echo the_post_thumbnail_url( 'medium' ); ?>')"></div>
              <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
              <p class="date"><?php echo ucfirst( date_i18n( 'l' ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
            </div>
          <?php endwhile; ?>
        </div>

        <p class="button-wrapper"><?php echo previous_posts_link(); ?><?php echo next_posts_link(); ?></p>

      </div>
    </section>

    <?php if ( ! is_paged() ) : ?>
      <section class="block block-cta-left-image">
        <div class="container">

          <div class="cols">
            <div class="col">
              <div class="image" style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'images/placeholder.png' ) ) ?>');"></div>
            </div>

            <div class="col">
              <div class="content">
                <h2 class="block-title">Pullopostia?</h2>
                <p>Koottuja kuulumisia sisältävä bittivirtojen pulloposti saapuu rantaasi noin kolmen kuukauden välein.</p>
                <form action="https://dude.us8.list-manage.com/subscribe/post?u=bda4635b58bba8d9716eb90a6&amp;id=efe9db80e6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
                  <label for="mce-EMAIL" class="screen-reader-text">Sähköpostiosoite:</label>

                  <div class="inputs">
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Sähköpostiosoite">
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bda4635b58bba8d9716eb90a6_efe9db80e6" tabindex="-1" value=""></div>
                    <input type="submit" value="Lähetä" name="subscribe" id="mc-embedded-subscribe" class="button">
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </section>
    <?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
