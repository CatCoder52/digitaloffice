<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-06-01 16:14:58
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-01 16:20:14
 *
 * @package dude2019
 */

$content = get_sub_field( 'content' );

if ( empty( $content ) ) {
  return;
} ?>

<section class="block block-wide-text">
  <div class="container">

    <?php echo wpautop( $content ); ?>

  </div>
</section>
