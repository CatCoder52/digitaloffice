<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 19:33:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 14:55:23
 *
 * @package dude
 */

?>

<section class="block block-cta-with-phone-input"<?php if ( is_front_page() ) : ?> has-dark-bg<?php else : ?> has-light-bg<?php endif; ?><?php if ( is_page( 4487 ) ) : ?> id="cta"<?php endif; ?>>
  <div class="container">

    <div class="cols">
      <div class="col">
        <?php
        // If contact or FAQ page
        if ( is_page( 4487 ) || is_page( 6704 ) ) : ?>
          <h2>Jätä meille yhteydenottopyyntö</h2>
          <p>Haluatko tietää lisää palveluistamme ja Dudesta yrityksenä? Jätä puhelinnumerosi, niin olemme teihin pikimmiten yhteydessä.</p>
        <?php else : ?>
          <h2>Uskottava se on.</h2>
          <p>Jos tuntemukset ovat kutakuinkin tuota luokkaa, niin jätäthän meille soittopyynnön. Meidän Kristian soittaa pikimmiten perään.</p>
        <?php endif; ?>
      </div>

      <div class="col">
        <?php
          if ( function_exists( 'gravity_form' ) ) {
            gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, $echo = true );
          }
        ?>
      </div>
    </div>

  </div>
</section>
