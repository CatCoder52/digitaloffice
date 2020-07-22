<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-21 12:19:43
 *
 * @package dude
 */

$title = get_the_title();
$post_id = get_the_id();

if ( ! empty( $title_alt ) ) {
  $title = $title_alt;
}

// Featured image
$bg_image_tiny_default = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tiny-preload-thumbnail' );
$bg_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$bg_image_tiny = $bg_image_tiny_default[0];
$bg_image = null;
$video_bg = get_post_meta( $post_id, 'article_video', true );

// Variables
$post_year = get_the_time( 'Y' );
$now_year = gmdate( 'Y' );

if ( has_post_thumbnail() ) {
  $bg_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}
?>

<section class="block block-hero is-centered block-hero-single<?php if ( $video_bg ) : ?> has-video<?php endif; ?><?php if ( $post_year <= $now_year - 2 ) : ?> is-old<?php endif; ?>">

  <div class="shade"></div>
  <div class="featured-image">
    <?php image_lazyload_div( get_post_thumbnail_id( $post->ID ) ); ?>
    <?php if ( $video_bg ) : ?>
      <div class="vimeo-wrapper">
      <iframe src="https://player.vimeo.com/video/<?php echo str_replace( array( 'http:', 'https:', 'vimeo.com', '/' ), '', $video_bg ) ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
          frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
      </div>
    <?php endif; ?>
  </div>

  <div class="container">
    <div class="content">
      <p class="block-title-pre" aria-describedby="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>

      <h1 id="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php the_title() ?></h1>

      <div class="hero-description">
        <?php echo wpautop( get_the_excerpt() ) ?>
      </div>
    </div>
  </div>

  <?php if ( is_singular( 'post' ) ) :
    $post_year = get_the_time( 'Y' );
    $now_year = gmdate( 'Y' );
    ?>
    <?php if ( $post_year <= $now_year - 2 ) : ?>
      <div class="notification-box old">
        <div class="container">
          <div class="box">
            <p><svg version="1.1" width="22" height="22" viewBox="0 0 16 16" class="octicon octicon-issue-opened" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor"><path fill-rule="evenodd" d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8zm9 3a1 1 0 11-2 0 1 1 0 012 0zm-.25-6.25a.75.75 0 00-1.5 0v3.5a.75.75 0 001.5 0v-3.5z"/></svg>Tämä kirjoitus saattaa sisältää vanhentunutta tietoa, sillä se on julkaistu yli <?php echo esc_attr( $now_year ) - esc_attr( $post_year ); ?> vuotta sitten.</p>
          </div>
        </div>
      </div>
      <?php endif; ?>
  <?php endif; ?>
</section>
