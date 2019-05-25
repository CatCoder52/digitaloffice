<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:49:22
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-25 15:34:53
 *
 * @package dude2019
 */

?>

<section class="block block-references">
  <div class="container">

    <header class="block-head">
      <p class="block-title-pre" aria-describedby="latest-works">Latest wörks</p>
      <h2 class="block-title" id="latest-works">Latest and greitest</h2>
    </header>

    <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder-reference.png" alt="Reference alt" />

    <div class="cols">

      <div class="col has-grey-bg has-grey-bg-extend-left">
        <?php include get_theme_file_path( '/svg/logo-sievo.svg' ); ?>
        <h3 class="screen-reader-text">Sievo</h3>
        <p>Kuten kaikki hyvät tarinat, alkaa tämäkin yhdestä twiitistä. Twiitistä joka johti Skype-palaveriin, reissuun isolle kirkolle ja lopulta jatkuvasti kehittyvän WordPress -sivuston toteuttamiseen...</p>

        <p class="arrow-link-wrapper"><a href="#" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
      </div>

      <div class="co col-quote">
        <blockquote><p>Sievo edustaa kansainvälisesti huipputason IT-osaamista. Suunnitellessamme uusia verkkosivuja haimme kumppania, jolta löytyy sekä kivenkovaa WordPress-osaamista että selkeän suomalaista visuaalista jälkeä. Duden kanssa suunnittelu, toteutus ja tuki on onnistunut asiakaslähtöisesti ja tehokkaasti. Kaikilla mittareilla mitattuna uudet verkkosivut ovat toimineet entistä paremmin ja myös asiakkaamme ovat huomanneet eron.</p></blockquote>
        <footer><strong>Lari Numminen</strong> Product owner</footer>
      </div>

    </div>

    <div class="cols cols-references">

      <div class="col">
        <div class="col-featured-image">
          <div class="image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/placeholder-nodeon.png');"></div>
        </div>

        <div class="content">
          <h3 class="block-title>">Nodeon</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta condimentum tortor at fermentum. Donec sodales in massa in volutpat.</p>

          <p class="arrow-link-wrapper"><a href="#" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
        </div>
      </div>

      <div class="col">
        <div class="col-featured-image">
          <div class="image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/placeholder-blackbruin.png');"></div>
        </div>

        <div class="content">
          <h3 class="block-title>">Black Bruin</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porta condimentum tortor at fermentum. Donec sodales in massa in volutpat.</p>

          <p class="arrow-link-wrapper"><a href="#" class="arrow-link">Tsekkaa case<span class="arrow"></span></a></p>
        </div>
      </div>

    </div>

  </div>
</section>
