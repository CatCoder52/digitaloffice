<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 15:36:26
 *
 * @package dude
 */

?>

<section class="block block-hero block-hero-contact-thanks has-dark-bg">
  <div class="shade" aria-hidden="true"></div>
  <div class="vimeo-wrapper"><iframe data-no-lazy="1" style="min-width: 220.77vh;" src="https://www.youtube.com/embed/wTP2RUD_cL0?start=74&autoplay=1&modestbranding=1&showinfo=0&rel=0&iv_load_policy=3&fs=0&color=white&controls=0&disablekb=1" width="560" height="315" frameborder="0" allow='autoplay'></iframe></div>

  <div class="container">

    <h1><svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#2bc66d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
    Kiitti rahoista!</h1>

    <div class="contact-wrap">
      <div class="content">
        <p>Maksu meni läpi! Meillä rupee apinat pakkaamaan sinulle Dude-pakettia. Saat sähköpostiin lisää infoa pian.</p>

        <p><?php echo do_shortcode( '[simpay_payment_receipt]' ); ?></p>

      </div>

    </div>

  </div>
</section>
