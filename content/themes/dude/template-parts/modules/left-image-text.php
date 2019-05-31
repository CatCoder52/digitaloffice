<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:34:24
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-31 14:13:08
 *
 * @package dude2019
 */

$bg_image = get_sub_field( 'image' );
$content = get_sub_field( 'content' );

if ( empty( $bg_image ) || empty( $content ) ) {
  return;
} ?>

<section class="block block-left-image-text">
  <div class="container">

    <div class="cols">
      <div class="col">
        <div class="image">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo $image ?>"></div>
          <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ) ?>');"></div></noscript>
        </div>
      </div>

      <div class="col has-grey-bg has-grey-bg-extend-right">
        <div class="content">
          <?php echo wpautop( $content ); ?>
        </div>
      </div>
    </div>

  </div>
</section>
