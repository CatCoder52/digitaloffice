<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-09-28 17:01:44
 *
 * @package dude
 */

include get_theme_file_path( '/svg/ouroboros.svg' );
?>

<section class="block block-hero-merch block-hero block-hero-merch-thanks block-hero-reference is-centered has-dark-bg">
  <div class="container">

    <h1 id="content"><svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#2bc66d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
    Kiitti rahoista!</h1>

    <div class="contact-wrap">
      <div class="content">
        <p>Maksu meni läpi! Meillä rupee apinat pakkaamaan sinulle Dude-pakettia. Saat sähköpostiin lisää infoa pian.</p>

        <p><?php echo do_shortcode( '[simpay_payment_receipt]' ); ?></p>

      </div>

    </div>

  </div>
</section>
