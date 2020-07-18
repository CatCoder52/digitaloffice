<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 19:18:00
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-18 18:57:01
 *
 * @package dude
 */

$current_dude = null;
if ( is_singular( 'person' ) ) {
  $current_dude = get_the_id();
}

$query = new WP_Query( array(
  'post_type'               => 'person',
  'post_status'             => 'publish',
  'order'                   => 'ASC',
  'orderby'                 => 'menu_order',
  'posts_per_page'          => 50,
  'no_found_rows'           => true,
  'cache_results'           => true,
  'update_post_term_cache'  => false,
  'update_post_meta_cache'  => false,
) );

if ( ! $query->have_posts() ) {
  return;
} ?>

<section class="block block-dudes">

  <h2 class="screen-reader-text">Henkilöt</h2>

  <div class="container">

    <div class="cols">
      <?php while ( $query->have_posts() ) : $query->the_post();
        if ( get_the_id() === $current_dude ) {
          continue;
        }

        $image = get_post_meta( get_the_id(), 'image_square', true );
        $title = get_post_meta( get_the_id(), 'title', true );

        if ( empty( $image ) ) {
          continue;
        } ?>

        <div class="col">
          <div class="image">
            <?php image_lazyload_div( $image ); ?>
          </div>
          <div class="content">
            <h3><?php the_title(); ?></h3>
            <?php if ( ! empty( $title ) ) : ?>
              <p class="person-title"><?php echo esc_html( $title ) ?></p>
            <?php endif; ?>

            <p class="arrow-link-wrapper"><span href="<?php the_permalink() ?>" class="arrow-link"><span class="screen-reader-text">Lue lisää tyypistä</span><span class="arrow"></span></span></p>
          </div>
          <a href="<?php the_permalink() ?>" class="global-link"><span class="screen-reader-text">Lue lisää tyypistä</span></a>
        </div>

      <?php endwhile; wp_reset_postdata(); ?>
    </div>

  </div>
</section>
