<?php
/**
 * @Author: 						Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:   						2019-06-03 12:04:02
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-25 13:46:41
 *
 * @package dude2019
 */

$hashtag = get_sub_field( 'hashtag' );

if ( empty( $hashtag ) ) {
  return;
}

$images = get_the_dude_img_hashfeed_raw( $hashtag );

if ( is_wp_error( $images ) || empty( $images ) ) {
  return;
} ?>

<section class="block block-instagram">
  <div class="container">

    <?php foreach ( $images as $image ) : ?>
      <div class="ig has-lazyload">
        <div class="background-image preview lazyload" style="background-image: url('<?php echo $image->display_url; ?>');" data-src="<?php echo $image->thumbnail_src; ?>" data-src-mobile="<?php echo $image->thumbnail_src; ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo $image->display_url; ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo $image->display_url; ?>');"></div></noscript>

        <div class="overlay">
          <span class="likes"><svg width="18" height="18" fill="#fff" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26t-55.5-65.5-68-97.5-53.5-121-23.5-138q0-220 127-344t351-124q62 0 126.5 21.5t120 58 95.5 68.5 76 68q36-36 76-68t95.5-68.5 120-58 126.5-21.5q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"/></svg><?php echo $image->likes->count; ?></span>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>
