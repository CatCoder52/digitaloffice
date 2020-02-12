<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 18:08:24
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-12 17:43:36
 *
 * @package dude
 */

$title_placeholder = get_sub_field( 'title_placeholder' );
$articles = get_sub_field( 'articles' );

if ( empty( $title_placeholder ) || empty( $articles ) ) {
  return;
} ?>

<section class="block block-blog-articles-upsell">
  <div class="container">

    <h2 class="block-title"><?php printf( 'Bloggauksia <span>%s</span>', $title_placeholder ) ?></h2>

    <div class="cols">
      <?php foreach ( $articles as $article ) :
        if ( ! post_exists_id( $article ) ) {
          continue;
        } ?>

        <div class="col">
          <h3><a href="<?php echo get_the_permalink( $article ) ?>"><?php echo get_the_title( $article ) ?></a></h3>

          <div class="excerpt">
            <?php echo wpautop( get_the_excerpt( $article ) ) ?>
          </div>

          <p><a class="cta-link" href="<?php echo get_the_permalink( $article ) ?>">Lue kirjoitus</a></p>
        </div>

      <?php endforeach; ?>
    </div>

  </div>
</section>
