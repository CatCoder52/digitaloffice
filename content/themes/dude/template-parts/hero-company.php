<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-16 16:05:31
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

<section class="block block-hero">
  <div class="container">

    <div class="content">
      <div class="side-content-box">
        <h1><?php echo $title ?></h1>

        <div class="hero-description">
          <?php if ( ! empty( $content ) ) {
            echo wpautop( $content );
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
    </div>

  </div>
</section>
