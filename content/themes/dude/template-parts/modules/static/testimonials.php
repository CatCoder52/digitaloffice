<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-13 11:45:07
 *
 * @package dude
 */

$args = array(
  'post_type'               => 'reference',
  'post_status'             => 'publish',
  'orderby'                 => 'rand',
  'posts_per_page'          => 50,
  'meta_key'                => '_thumbnail_id',
  'no_found_rows'           => true,
  'cache_results'           => true,
  'update_post_term_cache'  => false,
  'update_post_meta_cache'  => false,
  'fields'                  => 'ids',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
  while ( $query->have_posts() ) {
    $query->the_post();

    $references[] = array(
      'id'                => get_the_id(),
      'title'             => get_the_title(),
      'image_preload_url' => get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ),
      'image_url'         => get_the_post_thumbnail_url( get_the_id(), 'large' ),
      'image_url_mobile'  => get_the_post_thumbnail_url( get_the_id(), 'large' ),
      'excerpt'           => get_post_meta( get_the_id(), 'short_desc', true ),
      'permalink'         => get_the_permalink(),
      'quote'             => get_post_meta( get_the_id(), 'quote', true ),
      'quote_person'      => get_post_meta( get_the_id(), 'quote_person', true ),
    );
  }
}
?>

<section class="block block-our-services">
  <div class="container">

    <header class="block-head">
      <h2 class="block-title" id="block-title-our-services">Asiakkaidemme kokemuksia</h2>
    </header>

    <?php foreach ( $references as $reference ) : ?>

      <h3><a href="<?php echo esc_html( $reference['permalink'] ) ?>"><?php echo esc_html( $reference['quote_person'] ) ?></a></h3>
      <p><?php echo esc_html( $reference['quote'] ) ?></p>

    <?php endforeach; ?>

  </div>
</section>
