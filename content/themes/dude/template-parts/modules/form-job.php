<?php
/**
 * @Author:             Roni Laukkarinen
 * @Date:               2021-10-11 16:08:55
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-10-12 10:54:13
 *
 * @package dude
 */
?>

<section class="block block-form-job has-light-bg">
  <div class="container">

    <h2>Lähetä meille hakemus</h2>

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
