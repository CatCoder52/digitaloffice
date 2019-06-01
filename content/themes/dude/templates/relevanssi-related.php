<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-07 14:52:34
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-01 19:14:23
 *
 * @package bauermedia
 */

if ( empty( $related_posts ) ) {
  return;
} ?>

<section class="block block-blog">
  <div class="container">

    <?php foreach ( $related_posts as $related_post ) : ?>
      <div class="col">
        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( $related_post, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo get_the_post_thumbnail_url( $related_post, 'large' ) ?>"></div>
          <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( $related_post, 'large' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( $related_post, 'large' ) ?>');"></div></noscript>
        </div>

        <h3><a href="<?php the_permalink( $related_post ) ?>"><?php echo get_the_title( $related_post ) ?></a></h3>
        <p class="date"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y', $related_post ) ?></p>
      </div>
    <?php endforeach; ?>

  </div>
</section>
