<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-09-26 10:06:13
 *
 * @package dude2019
 */

// Featured image
$bg_image_tiny_default = get_template_directory_uri() . '/images/merch-tiny.jpg';
$bg_image_mobile = $bg_image_tiny_default;
$bg_image_tiny = $bg_image_tiny_default;
$bg_image = get_template_directory_uri() . '/images/merch.jpg';

$title = 'Merch';
$content = 'Dudella on täällä kaikenlaista sinua varten. Pick your poison!';
?>

<section class="block block-hero-merch block-hero block-hero-side-columns block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content">
      <div class="side-content-box">
        <h1 class="animate animate-1"><?php echo $title; ?></h1>

        <div class="hero-description animate animate-2">
          <?php if ( ! empty( $content ) ) {
            echo wpautop( $content );
          }
          ?>
        </div>

      </div>
    </div>

    <?php if ( $bg_image ) { ?>
    <div class="featured-image featured-image-side">
      <div class="shade"></div>
        <div class="background-image preview lazyload" style="background-image: url('<?php echo $bg_image_tiny; ?>');" data-src="<?php echo esc_url( $bg_image ); ?>" data-src-mobile="<?php echo esc_url( $bg_image_mobile[0] ); ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"></div></noscript>
    </div>
    <?php } ?>

  </div>
</section>
