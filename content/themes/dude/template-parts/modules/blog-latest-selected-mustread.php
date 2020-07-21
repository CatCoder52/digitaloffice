<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 15:26:12
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-21 16:11:32
 *
 * @package dude
 */

$args = array(
  'post_type'   => 'post',
  'post_status' => 'publish',
  'posts_per_page'         => 1,
  'no_found_rows'          => true,
  'cache_results'          => true,
  'update_post_term_cache' => false,
  'update_post_meta_cache' => false,
);

$query = new WP_Query( $args );
$mustread = get_sub_field( 'mustread' );

if ( ! $query->have_posts() || empty( $mustread ) ) {
  return;
}

global $blog_latest_excerpt_override; ?>

<section class="block block-latest-selected-mustread">
  <div class="container">

    <header class="block-head block-head-small">
      <h2 class="block-title">Tarinoita Dudelta</h2>
      <p class="read-more"><a class="cta-link" href="<?php echo get_option( 'page_for_posts' ); ?>">Katso kaikki</a></p>
    </header>

    <div class="rows">
      <div class="row row-latest">
        <?php while ( $query->have_posts() ) : $query->the_post();
          $blog_latest_excerpt_override = get_the_id();
          $video_bg = get_post_meta( get_the_id(), 'article_video', true );
        ?>

          <div class="post">
            <div class="image has-lazyload">

              <?php if ( $video_bg ) : ?>
                <div class="shade"></div>
                <div class="vimeo-wrapper vimeo-wrapper-upsell-front-page">
                  <iframe src="https://player.vimeo.com/video/<?php echo str_replace( array( 'http:', 'https:', 'vimeo.com', '/' ), '', $video_bg ) ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
                    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
              <?php endif; ?>

              <a href="<?php the_permalink() ?>" class="global-link"><span class="screen-reader-text"><?php the_title() ?></span></a>
              <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>" data-src-mobile="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
            </div>

            <div class="content">
              <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
              <?php the_excerpt(); ?>

              <p class="button-wrapper"><a class="button button-glitch button-white" href="<?php echo esc_url( get_the_permalink() ); ?>">Lue kirjoitus</a></p>

            </div>
          </div>

        <?php endwhile; wp_reset_postdata(); wp_reset_postdata(); ?>
      </div>

      <div class="row row-mustread">

        <?php foreach ( $mustread as $post ) : ?>
          <div class="post">
            <div class="content">
              <h3><a href="<?php echo get_the_permalink( $post ) ?>"><?php echo get_the_title( $post ) ?></a></h3>
              <?php echo wpautop( get_the_excerpt( $post ) ) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
