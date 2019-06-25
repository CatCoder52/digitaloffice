<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-07 14:52:34
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-25 13:50:50
 *
 * @package bauermedia
 */

if ( empty( $related_posts ) ) {
  return;
} ?>

<section class="block block-blog block-blog-relevant">
  <div class="container">

    <header class="block-head block-head-relevant">
      <p class="block-title-pre" aria-describedby="block-title-related">Aiheeseen liittyvää</p>
      <h1 class="block-title block-title-archive" id="block-title-related">Lue nämä seuraavaksi</h1>
    </header>

    <div class="cols">
      <?php foreach ( $related_posts as $related_post ) : ?>
        <div class="col">
          <div class="image has-lazyload">
            <a class="global-link" href="<?php echo get_the_permalink( $related_post ) ?>"><span class="screen-reader-text"><?php echo get_the_title( $related_post ) ?></span></a>
            <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( $related_post, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( $related_post, 'large' ) ?>" data-src-mobile="<?php echo get_the_post_thumbnail_url( $related_post, 'medium' ) ?>"></div>
            <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( $related_post, 'large' ) ?>');"<?php endif; ?>></div>
            <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( $related_post, 'large' ) ?>');"></div></noscript>
          </div>

          <h3><a href="<?php echo get_the_permalink( $related_post ) ?>"><?php echo get_the_title( $related_post ) ?></a></h3>
          <p class="date"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y', $related_post ) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
