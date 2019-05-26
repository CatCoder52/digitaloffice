<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-20 21:21:40
 *
 * @package dude2019
 */

?>

<section class="block block-hero block-hero-frontpage block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content content-select-service">

      <div class="side-content-box selection">
        <ul>
          <li><a href="#">Haluan uudet verkkosivut</a></li>
          <li><a href="#">Tarvitsen visuaalista suunnittelua</a></li>
          <li><a href="#">Kunhan vaan kahtelen...</a></li>
        </ul>

        <p class="cta-link"><a href="#">Ota yhteyttä</a></p>
      </div>
    </div>

    <div class="featured-image featured-image-side">
      <div class="shade"></div>

      <div class="background-image preview lazyload" style="background-image: url('background-image: url('<?php echo get_template_directory_uri(); ?>/images/placeholder-tiny.png');" data-src="<?php echo get_template_directory_uri(); ?>/images/placeholder-tiny.png"></div>
      <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/placeholder.png');"<?php endif; ?>></div>
      <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/placeholder.png');"></div></noscript>

    </div>

  </div>
</section>
