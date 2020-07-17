<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 18:54:41
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-17 17:00:07
 *
 * @package dude
 */

?>

<section class="block block-timeline">
  <div class="container">

    <h2 class="block-title">Duden historia</h2>

    <div class="columns">
      <div class="column col col-timeline is-three-fifths is-multiline">

        <div class="row active">
          <h2 class="action" data-label="Alussa meitä oli vain kaksi ja vermeetkin oli lainavehkeitä. Ensimmäinen toimisto vanhan työnantajan tiloissa." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>">2013</h2>
          <button tabindex="0" class="action" data-label="Alussa meitä oli vain kaksi ja vermeetkin oli lainavehkeitä. Ensimmäinen toimisto vanhan työnantajan tiloissa." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>">Roni ja Juha perustavat yrityksen keväällä 2013 puolivahingossa kun alihankintasoppari ja omat asiakkuudet vaikuttivat tilaisuudelta, jota ei voinut olla käyttämättä. Pitkiä päiviä sekä opettelua yrittäjyyden ihmeelliseen maailmaan. <a href="https://www.dude.fi/firma-parahti-pystyyn">Lue ensimmäinen bloggaus koskaan</a>.</button>
        </div>

        <div class="row">
          <h2 class="action" data-label="Miehet kuin veistokset Laajavuoren kukkulalla. Kuva myös herona sivuilla back in the day 2015." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2015.jpg' ) ?>">2015</h2>
          <button tabindex="0" class="action" data-label="Miehet kuin veistokset Laajavuoren kukkulalla. Kuva myös herona sivuilla back in the day 2015." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2015.jpg' ) ?>">Pitkän linjan yrittäjä Kristian Hohkavaara ja Digitoimisto Dude Oy yhdistyvät. <a href="https://www.dude.fi/digitoimisto-dude-oy-ja-hohkavaara">Tapauksesta blogattiin, luonnollisesti</a>.</button>
        </div>

        <div class="row">
          <h2 class="action" data-label="Dudet aamupalaverissa toukokuussa 2016. Timi muutti muuten Jyväskylään Helsingistä asti." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2016.jpg' ) ?>">2016</h2>
          <button tabindex="0" class="action" data-label="Dudet aamupalaverissa toukokuussa 2016. Timi muutti muuten Jyväskylään Helsingistä asti." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2016.jpg' ) ?>">Timi tuli mukaan völjyyn yrityksen ensimmäisenä työntekijänä sekä back-end-kehittäjänä. Isompia ja vaativampia projekteja saadaan kotiutettua sekä kappas kummaa, myös tehtyä.</button>
        </div>

        <div class="row">
          <h2 class="action" data-label="Eräänä kesäisenä päivänä päätettiin hypätä Lillijunaan. Ja sepä olikin yllättävän kivaa!" data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2018.jpg' ) ?>">2018</h2>
          <button tabindex="0" class="action" data-label="Eräänä kesäisenä päivänä päätettiin hypätä Lillijunaan. Ja sepä olikin yllättävän kivaa!" data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2018.jpg' ) ?>">Liikevaihto ylitti 200 000. Soitettiin Get Lucky! Muutettiin isompiin tiloihin Kauppakadulle. Lue myös toimistoesittely ja muuttokuulumiset <a href="https://www.dude.fi/dude-nosti-tasoa-kerroksella-esittelyssa-uusi-kauppakadun-toimisto">tästä näin</a>.</button>
        </div>

        <div class="row">
          <h2 class="action" data-label="Aamupalaverit vietetään joka maanantai. Kauppakatu 14 tiloissa on tilaa useammallekin ihmiselle." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2019.jpg' ) ?>">2019</h2>
          <button tabindex="0" class="action" data-label="Aamupalaverit vietetään joka maanantai. Kauppakatu 14 tiloissa on tilaa useammallekin ihmiselle." data-image="<?php echo get_theme_file_uri( 'images/timeline/dude-2019.jpg' ) ?>"><a href="https://www.dude.fi/dudella-uusi-osakas-ja-valoisat-tulevaisuudennakymat">Timistä tuli osakas</a>. Palkattiin Henkka ja pari muutakin <a href="https://www.dude.fi/tyopaikat">rekryä tulilla</a>. To be continued...</button>
        </div>

      </div>

      <div class="column col col-image">
        <p class="label" id="dynamiclabel"><span>Alussa meitä oli vain kaksi ja vermeetkin oli lainavehkeitä. Ensimmäinen toimisto vanhan työnantajan tiloissa.</span></p>

        <div class="image has-lazyload">
          <div class="background-image preview lazyload" style="background-image: url('<?php echo get_theme_file_uri( 'images/timeline/dude-2013-tiny.jpg' ) ?>' ) ?>');" data-src="<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>" data-src-mobile="<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>"></div>
          <div id="dynamicimage" class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?> style="background-image: url('<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>');"<?php endif; ?>></div>
          <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_theme_file_uri( 'images/timeline/dude-2013.jpg' ) ?>');"></div></noscript>
        </div>
      </div>
    </div>

  </div>
</section>
