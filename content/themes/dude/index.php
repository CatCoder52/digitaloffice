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

<div class="content-area">
	<main id="main" class="site-main">

    <?php if ( ! is_paged() && ! is_category() && ! is_tag() && ! is_author() && ! is_date() ) :
      global $blog_latest_excerpt_override;

      while ( have_posts() ) : the_post();
      $blog_latest_excerpt_override = get_the_id(); ?>

      <?php if ( ! is_archive() || ! is_paged() ) : ?>
        <section class="block block-hero block-hero-light block-hero-blog block-hero-basic is-centered has-light-bg">
          <div class="container">
            <h1 id="content">Tarinoita Dudelta</h1>
            <div class="hero-description">
              <p>Duden blogi sisältää tekijöiden ajatuksia WordPressistä, verkkosivujen suunnittelusta ja kaikkea siltä väliltä.</p>
            </div>
          </div>
        </section>
        <?php endif; ?>

        <section class="block block-cta-with-image block-latest-blog-post has-light-bg">
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

    <?php break; endwhile; rewind_posts(); ?>
    <?php else :
      include get_theme_file_path( 'template-parts/hero.php' );
    endif; ?>

    <section class="block block-blog has-light-bg block-blog-archive<?php if ( is_archive() || is_paged() ) : ?> is-archive<?php endif; ?>">
      <div class="container">

        <header class="archive-head block-head<?php if ( is_category() || is_tag() || is_author() || is_date() ) : ?> block-head-archive<?php endif; ?>">

          <?php if ( is_tag() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo single_tag_title(); ?></h1>
          <?php elseif ( is_category() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo single_cat_title(); ?></h1>
          <?php elseif ( is_day() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo ucfirst( date_i18n( 'l', get_the_time( 'U' ) ) ) ?>, <?php the_time( 'j.' ) ?> <?php the_time( 'F' ) ?>ta <?php the_time( 'Y' ) ?></h1>
          <?php elseif ( is_month() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo ucfirst( date_i18n( 'F', get_the_time( 'U' ) ) ) ?>, <?php the_time( 'Y' ) ?></h1>
          <?php elseif ( is_year() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php the_time( 'Y' ); ?></h1>
          <?php elseif ( is_search() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php $cat = get_the_category(); $cat = $cat[0]; echo $cat->category_count; ?> löytyi</h2>
          <?php elseif ( is_author() ) : ?>
            <h1 class="block-title block-title-archive" id="block-title-block-blog"><?php echo get_the_author(); ?></h1>
          <?php else : ?>
            <h2 class="block-title block-title-archive">Uusimmat kirjoitukset</h2>
          <?php endif; ?>

          <p class="filter-label">Selaa kirjoituksia aiheittain</p>
            <ul class="filters filter-category">
              <?php wp_list_categories( [
                'title_li'  => null,
                'orderby'   => 'order',
              ] ); ?>
            </ul>
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
                  <div class="shade" aria-hidden="true"></div>
                  <div class="vimeo-wrapper vimeo-wrapper-upsell">
                    <iframe src="https://player.vimeo.com/video/<?php echo str_replace( array( 'http:', 'https:', 'vimeo.com', '/' ), '', $video_bg ) ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
                      frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
						      <?php endif; ?>

                  <?php image_lazyload_div( get_post_thumbnail_id( $post->ID ) ); ?>
                </div>

              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

              <div class="text-content">
                <?php the_excerpt(); ?>
              </div>

              <p class="date"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
            </div>
          <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(); ?>

      </div>
    </section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
