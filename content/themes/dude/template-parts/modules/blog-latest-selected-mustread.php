<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 15:26:12
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-03-11 15:38:59
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

<section class="block block-latest-selected-mustread block-mint">
  <div class="container">

    <div class="rows">

      <div class="row row-latest">
        <h2 class="block-title">Tarinoita Dudelta <a class="read-more" href="<?php echo get_option( 'page_for_posts' ); ?>">Katso kaikki</a></h2>

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
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
            </div>

            <div class="content">
              <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
              <?php the_excerpt(); ?>
            </div>
          </div>

        <?php endwhile; wp_reset_query(); wp_reset_postdata(); ?>
      </div>

      <div class="row row-mustread">

        <?php foreach ( $mustread as $post ) : ?>
          <div class="post">
            <div class="image">

              <?php
              $video_bg = get_post_meta( get_the_id(), 'article_video', true );
              if ( $video_bg ) : ?>
                <div class="shade"></div>
                <div class="vimeo-wrapper vimeo-wrapper-upsell-small">
                  <iframe src="https://player.vimeo.com/video/<?php echo str_replace( array( 'http:', 'https:', 'vimeo.com', '/' ), '', $video_bg ) ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
                    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
              <?php endif; ?>

              <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( $post, 'large' ) ?>" data-src-mobile="<?php echo get_the_post_thumbnail_url( $post, 'medium' ) ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( $post, 'medium' ) ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post, 'medium' ) ?>');"></div></noscript>
            </div>

            <div class="content">
              <h3><a href="<?php echo get_the_permalink( $post ) ?>"><?php echo get_the_title( $post ) ?></a></h3>
              <?php echo wpautop( get_the_excerpt( $post ) ) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="newsletter has-grey-bg has-grey-bg-extend-right">
      <form action="https://dude.us8.list-manage.com/subscribe/post?u=bda4635b58bba8d9716eb90a6&amp;id=efe9db80e6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
        <h2 class="block-title">Tilaa bittivirtojen pulloposti</h2>
        <p>Koottuja kuulumisia sisältävä bittivirtojen pulloposti saapuu rantaasi noin kolmen kuukauden välein.</p>
        <label for="mce-EMAIL" class="screen-reader-text">Sähköpostiosoite:</label>

        <div class="inputs">
          <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Sähköpostiosoite">
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bda4635b58bba8d9716eb90a6_efe9db80e6" tabindex="-1" value=""></div>
          <input type="submit" value="Lähetä" name="subscribe" id="mc-embedded-subscribe" class="button">
        </div>
      </form>
    </div>

  </div>
</section>
