<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-06-01 16:14:58
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-24 11:18:35
 *
 * @package dude
 */

$content = get_sub_field( 'content' );

if ( empty( $content ) && ! is_page( 4487 ) ) {
  return;
} ?>

<section class="block has-light-bg block-wide-text"<?php if ( is_page( 6357 ) ) : ?> id="lomake"<?php endif; ?>>
  <div class="container">

    <?php echo wpautop( $content ); ?>

    <?php if ( is_page( 4487 ) ) : ?>
      <div class="col-image" aria-hidden="true">
        <div class="image has-lazyload" aria-hidden="true">
          <div class="lazy" data-bg="<?php echo get_template_directory_uri(); ?>/images/contact.jpg" aria-hidden="true"></div>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>
