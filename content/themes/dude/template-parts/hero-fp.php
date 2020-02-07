<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-07 15:00:13
 *
 * @package dude2019
 */

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}
?>

<section class="block block-hero-side-columns block-hero block-hero-frontpage block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content">
      <h1>Verkkosivustoja ja visuaalista suunnittelua ihmisiltä ihmisille.</h1>
      <p>Rakkaudesta työhön. Parhaimmillamme olemme jalostaessamme asiakkaillemme tavoitteita tukevia kokonaisuuksia.</p>
    </div>

    <div class="featured-image featured-image-side">
      <div class="shade"></div>

      <?php if ( $bg_image ) { ?>
        <div class="background-image preview lazyload" style="background-image: url('<?php echo $bg_image_tiny; ?>');" data-src="<?php echo esc_url( $bg_image ); ?>" data-src-mobile="<?php echo esc_url( $bg_image_mobile[0] ); ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"></div></noscript>
      <?php } ?>
    </div>

  </div>
</section>
