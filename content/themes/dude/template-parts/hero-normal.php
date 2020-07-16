<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 16:14:36
 *
 * @package dude
 */

$title = get_the_title();
$title_alt = get_post_meta( get_the_id(), 'title_alt', true );
$content = get_post_meta( get_the_id(), 'hero_content', true );

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
}

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$bg_image = null;
if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}
?>

<section class="block block-hero block-hero-light">
  <div class="container">

    <div class="content">
      <h1><?php echo esc_html( $title ); ?></h1>

      <div class="hero-description">
        <?php if ( ! empty( $content ) ) {
          echo wpautop( $content ); // phpcs:ignore
        }
        ?>
      </div>

      <?php if ( 4449 === get_the_id() ) : ?>
        <p class="cta-link"><a href="<?php echo get_post_type_archive_link( 'reference' ) ?>">Mitä helevettiä? Missä työnäytteet?</a></p>
      <?php endif; ?>

      <?php if ( 4489 === get_the_id() ) : ?>
        <p><a class="cta-link cta-link-white" href="https://handbook.dude.fi">Lue Duden handbookia</a></p>
      <?php endif; ?>
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
