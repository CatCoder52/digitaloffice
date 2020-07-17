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

$newsletter_cta_bg_image_id = 4435;

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php if ( ! is_paged() && ! is_category() && ! is_tag() && ! is_author() && ! is_date() ) :
      global $blog_latest_excerpt_override;

      while ( have_posts() ) : the_post();
			$blog_latest_excerpt_override = get_the_id(); ?>
        <section class="block block-cta-with-image block-latest-blog-post">
          <div class="container">

            <h1 class="screen-reader-text">Uusin kirjoitus</h1>

            <div class="cols">
              <div class="col col-image has-lazyload">
                <?php image_lazyload_div( get_post_thumbnail_id( $post->ID ) ); ?>

								<?php $video_bg = get_post_meta( get_the_id(), 'article_video', true );
                if ( $video_bg ) : ?>

                  <div class="vimeo-wrapper vimeo-wrapper-upsell">
                    <iframe src="https://player.vimeo.com/video/<?php echo str_replace( array( 'http:', 'https:', 'vimeo.com', '/' ), '', $video_bg ) ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
                      frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                  </div>
                <?php endif; ?>
              </div>

              <div class="col col-content">

                <div class="content">
                  <p class="blog-post-time" aria-describedby="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>

                  <h2 class="block-title" id="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

                  <div class="text-content">
                    <?php the_excerpt(); ?>
                  </div>

                  <p class="button-wrapper"><a class="button button-glitch button-white" href="<?php echo esc_url( get_the_permalink() ); ?>">Lue kirjoitus<?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a></p>
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

        <header class="block-head<?php if ( is_category() || is_tag() || is_author() || is_date() ) : ?> block-head-archive<?php endif; ?>">

          <?php if ( is_tag() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Avainsana</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo single_tag_title(); ?></h1>

          <?php elseif ( is_category() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Kategoria</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo single_cat_title(); ?></h1>

          <?php elseif ( is_day() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Päivä</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo ucfirst( date_i18n( 'l', get_the_time( 'U' ) ) ) ?>, <?php the_time( 'j.' ) ?> <?php the_time( 'F' ) ?>ta <?php the_time( 'Y' ) ?></h1>

          <?php elseif ( is_month() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Kuukausi</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo ucfirst( date_i18n( 'F', get_the_time( 'U' ) ) ) ?>, <?php the_time( 'Y' ) ?></h1>

          <?php elseif ( is_year() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Vuosi</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php the_time( 'Y' ); ?></h1>

          <?php elseif ( is_search() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Hakutulokset</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php $cat = get_the_category(); $cat = $cat[0]; echo $cat->category_count; ?> löytyi</h2>

          <?php elseif ( is_author() ) : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Kirjoittaja</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo get_the_author(); ?></h1>

          <?php else : ?>

            <p class="block-title-pre" aria-describedby="block-title-block-blog">Tekijöiden ajatuksia</p>
            <h1 class="block-title block-title-archive" id="block-title-block-blog">Blogin kaikki jorinat</h1>

          <?php endif; ?>
        </header>

        <div class="cols">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="col">
              <div class="image has-lazyload">
                <a class="global-link" href="<?php the_permalink() ?>"><span class="screen-reader-text"><?php the_title() ?></span></a>

                 <?php
                  $video_bg = get_post_meta( get_the_id(), 'article_video', true );
                  if ( $video_bg ) :
						?>
                  <div class="shade"></div>
                  <div class="vimeo-wrapper vimeo-wrapper-upsell">
                    <iframe src="https://player.vimeo.com/video/<?php echo str_replace( array( 'http:', 'https:', 'vimeo.com', '/' ), '', $video_bg ) ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
                      frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
						<?php endif; ?>

                <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>" data-src-mobile="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
                <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
                <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
              </div>

              <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
              <p class="date"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
            </div>
          <?php endwhile; ?>
        </div>

        <p class="next-prev"><span class="prev"><?php echo previous_posts_link( 'Edellinen' ); ?></span><span class="next"><?php echo next_posts_link( 'Seuraava' ); ?></span></p>

      </div>
    </section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
