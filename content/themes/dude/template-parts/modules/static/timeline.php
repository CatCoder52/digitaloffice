<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 18:54:41
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-06-04 10:29:37
 *
 * @package dude2019
 */
?>

<section class="block block-timeline">
  <div class="container">

    <div class="columns">
      <div class="column col col-timeline is-three-fifths is-multiline">

        <div class="row">
          <h2>2013</h2>
          <button tabindex="0" class="action" data-label="Vanha toimisto irtisanomisajalla. Kuvan Macbook ja iPad eivät ole edes omia." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>">Roni ja Juha perustavat yrityksen keväällä 2013 puolivahingossa kun alihankintasoppari ja omat asiakkuudet vaikuttivat tilaisuudelta, jota ei voinut olla käyttämättä. Pitkiä päiviä sekä opettelua yrittäjyyden ihmeelliseen maailmaan. <a href="https://www.dude.fi/firma-parahti-pystyyn">Lue ensimmäinen bloggaus koskaan</a>.</button>
        </div>

        <div class="row">
          <h2>2015</h2>
          <button tabindex="0" class="action" data-label="Kristian virittelee nyrkkiä hanuriin. Kuva vänäriltä." data-image="<?php echo get_theme_file_uri( 'images/timeline/placeholder.png' ) ?>">Pitkän linjan yksityisyrittäjä Kristian Hohkavaara ja Digitoimisto Dude Oy yhdistyvät. <a href="https://www.dude.fi/digitoimisto-dude-oy-ja-hohkavaara">Tapauksesta blogattiin, luonnollisesti</a>.</button>
        </div>

        <div class="row">
          <h2>2016</h2>
          <button tabindex="0" class="action" data-label="Kristian virittelee nyrkkiä hanuriin. Kuva vänäriltä." data-image="<?php echo get_theme_file_uri( 'images/timeline/risella.png' ) ?>">Timi tulee mukaan völjyyn. Isompia ja vaativampia projekteja saadaan kotiutettua sekä kappas kummaa, myös tehtyä.</button>
        </div>

        <div class="row">
          <h2>2018</h2>
          <button tabindex="0" class="action" data-label="Kristian virittelee nyrkkiä hanuriin. Kuva vänäriltä." data-image="<?php echo get_theme_file_uri( 'images/timeline/risella.png' ) ?>">Liikevaihto ylitti 200 000. Soitettiin Get Lucky! Muutettiin Kauppakadulle.</button>
        </div>

        <div class="row active">
          <h2>2019</h2>
          <button tabindex="0" class="action" data-label="Kristian virittelee nyrkkiä hanuriin. Kuva vänäriltä." data-image="<?php echo get_theme_file_uri( 'images/timeline/risella.png' ) ?>">Rekryttiin <a href="#">Henkka</a> ja pari muutakin rekryä tulilla. To be continued...</button>
        </div>

      </div>

      <div class="column col col-image">
        <p class="label" id="dynamiclabel"><span>Kristian virittelee nyrkkiä hanuriin. Kuva vänäriltä.</span></p>

        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo get_theme_file_uri( 'images/timeline/risella-tiny.png' ) ?>');" data-src="<?php echo get_theme_file_uri( 'images/timeline/risella.png' ) ?>"></div>
          <div id="dynamicimage" class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_theme_file_uri( 'images/timeline/risella.png' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_theme_file_uri( 'images/timeline/risella.png' ) ?>');"></div></noscript>
        </div>
      </div>
    </div>

  </div>
</section>
