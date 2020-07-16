<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 16:13:00
 *
 * @package dude
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'title_alt', true );
$content = get_post_meta( get_the_id(), 'hero_content', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
}
?>

<section class="block block-hero block-hero-light">
  <div class="container">

    <div class="content">
      <h1><?php echo $title ?></h1>

      <div class="hero-description">
        <?php if ( ! empty( $content ) ) {
          echo wpautop( $content ); // phpcs:ignore
        }
        ?>
      </div>

    </div>

  </div>
</section>
