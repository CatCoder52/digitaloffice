<?php
/**
 * @Author: 						Roni Laukkarinen
 * @Date:   						2020-07-18 19:03:51
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-10-12 15:53:01
 *
 * @package dude
 */
?>
<section class="block block-open-positions has-light-bg" id="avoimet-paikat">
  <div class="container">
    <div class="head">
      <h2>Avoimet työpaikat</h2>
      <p class="open-positions-description">
        Oletko sinä seuraava dude? Kiinnostaako työ, joka parhaimmillaan ei tunnu hiki hatussa paiskomiselta? Tsekkaa avoimet paikkamme:
      </p>
    </div>

    <ul class="jobs">
      <li class="job">
        <a data-no-swup class="job-link" href="<?php echo esc_url( get_page_link( 9515 ) ); ?>">
          <span class="job-title">
            WordPress back-end/JS-kehittäjä
            <?php include get_theme_file_path( '/svg/arrow-right-short.svg' ); ?>
          </span>
          <span class="job-location">Jyväskylä, etätoimipiste</span>
        </a>
      </li>
      <li class="job">
        <a data-no-swup class="job-link" href="<?php echo esc_url( get_page_link( 10156 ) ); ?>">
          <span class="job-title">
            Junior-kehittäjä / Harjoittelija
            <?php include get_theme_file_path( '/svg/arrow-right-short.svg' ); ?>
          </span>
          <span class="job-location">Jyväskylä, etätoimipiste</span>
        </a>
      </li>
      <li class="job">
        <a data-no-swup class="job-link" href="<?php echo esc_url( get_page_link( 10160 ) ); ?>">
          <span class="job-title">
            Jätä avoin hakemus!
            <?php include get_theme_file_path( '/svg/arrow-right-short.svg' ); ?>
          </span>
          <span class="job-location">Jyväskylä, etätoimipiste</span>
        </a>
      </li>
    </ul>
  </div>
</section>

<section class="block block-jobs-upsells has-light-bg">
  <div class="container">

    <div class="box-mint">
      <p>Dudella työskennellään rennosti, mutta tosissaan. Pääasia on, että aamulla ei potuta lähteä töihin.</p>

      <p class="link-wrapper">
        <a class="no-text-link no-external-link-indicator" href="https://handbook.dude.fi/tyoskenteleminen-dudella">Lue lisää työntekijän handbookista</a>
      </p>
    </div>

    <div class="box-mint">
      <p>Toimintaamme ohjaavat arvot ovat läpinäkyvyys, laatu, vastuullisuus, rohkeus, kehitys ja välittäminen.</p>

      <p class="link-wrapper">
        <a class="no-text-link no-external-link-indicator" href="https://www.dude.fi/yritys">Lue lisää Dudesta yrityksenä</a>
      </p>
    </div>

    <div class="box-mint">
      <p>Olemme aidosti avoimia osallistumalla avoimen lähdekoodin projekteihin ja WordPress-yhteisön toimintaan.</p>

      <p class="link-wrapper">
        <a class="no-text-link no-external-link-indicator" href="https://www.dude.fi/yhteiso-ja-koodi">Lue lisää yhteisöstä ja koodista</a>
      </p>
    </div>

  </div>
</section>

<section class="block-general-gallery has-dark-bg">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-2021-1.jpg' ); ?>" alt="">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-2021-2.jpg' ); ?>" alt="">
  <img class="bigger" src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-2021-3.jpg' ); ?>" alt="">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-2021-4.jpg' ); ?>" alt="">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-2021-5.jpg' ); ?>" alt="">
</section>
