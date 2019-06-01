<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 15:26:12
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-01 13:21:24
 *
 * @package dude2019
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
} ?>

<section class="block block-latest-selected-mustread">
  <div class="container">

    <div class="cols">

      <div class="col col-latest">
        <h2 class="block-title">Latest & greatest</h2>

        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

          <div class="post">
            <div class="image">
              <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
            </div>

            <div class="content">
              <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
              <?php the_excerpt(); ?>
            </div>
          </div>

        <?php endwhile; wp_reset_query(); wp_reset_postdata(); ?>
      </div>

      <div class="col col-mustread">
        <h2 class="block-title">Must read</h2>

        <?php foreach ( $mustread as $post ) : ?>
          <div class="post">
            <div class="image">
              <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( $post, 'large' ) ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( $post, 'large' ) ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post, 'large' ) ?>');"></div></noscript>
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
