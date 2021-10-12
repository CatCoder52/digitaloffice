<?php
/**
 * @Author:             Roni Laukkarinen
 * @Date:               2021-10-11 16:08:55
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-10-12 12:34:34
 *
 * @package dude
 */
?>

<section class="block block-form-job has-light-bg">
  <div class="container">

    <h2>Lähetä meille hakemus</h2>

    <div class="description">
      <p>Voit lähettää hakemuksesi myös suoraan sähköpostitse <a href="https://www.dude.fi/dudet/roni">Ronille</a> osoitteeseen <a href="mailto:roni@dude.fi">roni@dude.fi</a> tai soitella paikasta puhelimitse <a href="https://www.dude.fi/dudet/kristian">Kristianille</a> numeroon <a href="tel:0408351033">040 835 1033</a>.
    </div>

    <?php gravity_form(
      $id = 11,
      $display_title = false,
      $display_description = false,
      $display_inactive = false,
      $field_values = null,
      $ajax = true,
      $echo = true
    ); ?>

  </div>
 </section>
