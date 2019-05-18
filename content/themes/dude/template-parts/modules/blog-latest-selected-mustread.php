<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 15:26:12
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 15:54:50
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

    <div class="col col-latest">
      <h2>Latest & greatest</h2>

      <?php while ( $query->have_posts() ) : $query->the_post(); ?>

        <div class="post">
          <img src="<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>" alt="<?php get_the_post_thumbnail_caption( get_the_id() ) ?>" />
          <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
          <?php the_excerpt(); ?>
        </div>

      <?php endwhile; wp_reset_query(); wp_reset_postdata(); ?>
    </div>

    <div class="col col-mustread">
      <h2>Must read</h2>

      <?php foreach ( $mustread as $post ) : ?>
        <div class="post">
          <div class="image" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post ) ) ?>')"></div>
          <div class="content">
            <h4><a href="<?php echo get_the_permalink( $post ) ?>"><?php echo get_the_title( $post ) ?></a></h4>
            <?php echo get_the_excerpt( $post ) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="newsletter">
      <form action="https://dude.us8.list-manage.com/subscribe/post?u=bda4635b58bba8d9716eb90a6&amp;id=efe9db80e6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
        <h2>Tilaa bittivirtojen pulloposti</h2>
        <label for="mce-EMAIL" class="screen-reader-text">Virtuaalisen satamasi osoite:</label>
        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Virtuaalisen satamasi osoite">
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bda4635b58bba8d9716eb90a6_efe9db80e6" tabindex="-1" value=""></div>
        <input type="submit" value="Lähetä" name="subscribe" id="mc-embedded-subscribe" class="button">
        <p class="note">Spämmätään vain 3kk välein. Myö luvataan.</p>
      </form>
    </div>

  </div>
</section>
