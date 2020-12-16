<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-07 14:52:34
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:10:48
 *
 * @package dude
 */

if ( empty( $related_posts ) ) {
  return;
} ?>

<section class="block block-blog-relevant block-latest-selected-mustread has-light-bg">
  <div class="container">

    <header class="block-head block-head-relevant block-head-small screen-reader-text">
      <h2 class="block-title block-title-archive">Lue myös nämä</h2>
    </header>

    <div class="cols row row-mustread">
      <?php foreach ( $related_posts as $related_post ) : ?>
        <div class="col post">
          <div class="content">
            <h3><a href="<?php echo esc_url( get_the_permalink( $related_post ) ); ?>"><?php echo esc_html( get_the_title( $related_post ) ); ?></a></h3>
            <?php echo wpautop( get_the_excerpt( $related_post ) ); // phpcs:ignore ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
