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

            <h1 class="screen-reader-text">Blogi</h1>

            <div class="cols">
              <div class="col col-image has-lazyload">
                <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
                <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
                <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
              </div>

              <div class="col col-content">

                <header class="block-head">
                  <p class="block-title-pre" aria-describedby="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php echo ucfirst( date_i18n( 'l' ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
                  <h2 class="block-title" id="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                </header>

                <div class="description">
                  <?php the_excerpt() ?>
                </div>

                <p class="arrow-link-wrapper"><a href="<?php the_permalink() ?>" class="arrow-link">Lue artikkeli<span class="arrow"></span></a></p>
              </div>
            </div>

          </div>
        </section>
      <?php break; endwhile; ?>
    <?php else :
      include get_theme_file_path( 'template-parts/hero.php' );
    endif; ?>

    <section class="block block-blog">
      <div class="container">

        <header class="block-head">
          <p class="block-title-pre" aria-describedby="block-title-block-blog">Tekijöiden ajatuksia</p>
          <h2 class="block-title" id="block-title-block-blog">Blogin kaikki jorinat</h2>
        </header>

        <div class="cols">
          <?php while( have_posts() ) : the_post(); ?>
            <div class="col">
              <div class="image has-lazyload">
                <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
                <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
                <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
              </div>

              <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
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
