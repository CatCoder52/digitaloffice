<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-04 08:57:24
 *
 * @package dude2019
 */

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}
?>

<section class="block block-hero-side-columns block-hero block-hero-frontpage block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content content-select-service">

      <div class="side-content-box selection">
        <ul>
          <li><a href="<?php echo get_page_link( 9 ); ?>">Haluan uudet verkkosivut</a></li>
          <li><a href="<?php echo get_page_link( 4485 ); ?>">Tarvitsen visuaalista suunnittelua</a></li>
          <li><a href="<?php echo get_page_link( 4493 ); ?>">Kunhan vaan kahtelen...</a></li>
        </ul>

        <p class="cta-link"><a href="<?php echo get_page_link( 4487 ); ?>">Ota yhteyttä</a></p>
      </div>
    </div>

    <div class="featured-image featured-image-side">
      <div class="shade"></div>

      <?php if ( $bg_image ) { ?>
        <div class="background-image preview lazyload" style="background-image: url('<?php echo $bg_image_tiny; ?>');" data-src="<?php echo esc_url( $bg_image ); ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"></div></noscript>
      <?php } ?>
    </div>

  </div>
</section>
