<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-08-14 22:43:53
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

<section class="block block-hero block-hero-light block-company is-centered has-light-bg">
  <div class="container">

    <div class="content">
      <h1 id="content"><?php echo esc_html( $title ); ?></h1>

      <?php if ( ! empty( $content ) ) { ?>
        <div class="hero-description swup-transition-fade">
          <?php echo wpautop( $content ); // phpcs:ignore ?>
        </div>
      <?php } ?>
    </div>

  </div>

  <div class="visual" aria-hidden="true">
    <div class="lazy" data-bg="<?php echo get_template_directory_uri(); ?>/images/dude-visual.jpg" aria-hidden="true"></div>
  </div>

</section>
