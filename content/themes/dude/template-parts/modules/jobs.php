<?php
/**
 * @Author: 						Roni Laukkarinen
 * @Date:   						2020-07-18 19:03:51
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-10-11 16:12:46
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
        <a class="job-link" href="<?php echo esc_url( get_page_link( 9515 ) ); ?>">
          <span class="job-title">
            WordPress back-end/JS-kehittäjä
            <?php include get_theme_file_path( '/svg/arrow-right-short.svg' ); ?>
          </span>
          <span class="job-location">Jyväskylä, etätoimipiste</span>
        </a>
      </li>
      <li class="job">
        <a class="job-link" href="<?php echo esc_url( get_page_link( 9515 ) ); ?>">
          <span class="job-title">
            Junior-kehittäjä / Harjoittelija
            <?php include get_theme_file_path( '/svg/arrow-right-short.svg' ); ?>
          </span>
          <span class="job-location">Jyväskylä, etätoimipiste</span>
        </a>
      </li>
      <li class="job">
        <a class="job-link" href="<?php echo esc_url( get_page_link( 9515 ) ); ?>">
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
      <p>Dudella työskennellään rennosti, mutta tosissaan. Pääasia on, että aamulla ei v*tuta lähteä töihin.</p>

      <p class="link-wrapper">
        <a class="no-text-link no-external-link-indicator" href="https://handbook.dude.fi/tyoskenteleminen-dudella">Lue lisää työntekijän handbookista</a>
      </p>
    </div>

    <div class="box-mint">
      <p>Toimintaamme ohjaavat arvot ovat Läpinäkyvyys, laatu, vastuullisuus, rohkeus, kehitys ja välittäminen.</p>

      <p class="link-wrapper">
        <a class="no-text-link no-external-link-indicator" href="https://www.dude.fi/yritys">Lue lisää Dudesta yrityksenä</a>
      </p>
    </div>

    <div class="box-mint">
      <p>Aidosti avointa on keskustelukulttuurin lisäksi myös koodi niin GitHubissa kuin WordPress-yhteisössäkin.</p>

      <p class="link-wrapper">
        <a class="no-text-link no-external-link-indicator" href="https://www.dude.fi/yhteiso-ja-koodi">Lue lisää yhteisöstä ja koodista</a>
      </p>
    </div>

  </div>
</section>

<section class="block-general-gallery has-dark-bg">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-1-2.jpg' ); ?>" alt="Valkoinen pellavapaita, jossa punainen Ouroboros-käärmekuvitus ja DUDE-teksti">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-2-2.jpg' ); ?>" alt="Musta huppari, jossa valkoinen Ouroboros-käärmekuvitus ja DUDE-teksti">
  <img class="bigger" src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-5-2.jpg' ); ?>" alt="Musta huppari, jossa valkoinen Ouroboros-käärmekuvitus ja DUDE-teksti">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-3-2.jpg' ); ?>" alt="Nainen seisoo edustalla kainalossaan DUDE-kangaskassi, jossa musta Ouroboros-kuvitus ja DUDE-logo, taustalla sumeana kaksi miestä nojaamassa seinään">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-4-2.jpg' ); ?>" alt="Musta huppari, jossa valkoinen Ouroboros-käärmekuvitus ja DUDE-teksti">
</section>
