<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-06-01 16:14:58
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-07 13:22:11
 *
 * @package dude2019
 */

$content = get_sub_field( 'content' );

if ( empty( $content ) && ! is_page(4487) ) {
  return;
} ?>

<section class="block block-wide-text<?php if ( is_page(4487) ) : ?> block-wide-text-contact<?php endif; ?>">
  <div class="container">

    <?php if ( is_page(4487) ) :
      echo gravity_form( 2, false, false, false, null, true, 49, true );
    else :
      echo wpautop( $content );
    endif;
    ?>

    <?php if ( is_page(4487) ) : ?>
      <div class="col-image">
        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/contact-tiny.jpg');" data-src="<?php echo get_template_directory_uri(); ?>/images/contact.jpg"></div>
          <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/contact.jpg');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/contact.jpg');"></div></noscript>
        </div>
      </div>
    <?php endif; ?>
    

  </div>
</section>
