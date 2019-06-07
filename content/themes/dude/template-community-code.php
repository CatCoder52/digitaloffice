<?php
/**
 * Template Name: Yhteisö & koodi
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

the_post();
get_header(); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero.php' ); ?>

    <div class="block block-community">
      <div class="container">

        <div class="cols">
          <div class="col col-content">

            <header class="block-head">
              <p class="block-title-pre" aria-describedby="block-title-wordpress">WordPress & Dude</p>
              <h2 class="block-title" id="block-title-wordpress">Duden osallistuminen WordPress-yhteisön toimintaan</h2>
            </header>

            <div class="content">
              <p>WordPress on avoimen lähdekoodin julkaisujärjestelmä, jota kehitetään yhteisön vapaaehtoistyön voimin. Dude on ollut WordPressin yhteisön toiminnassa mukana alusta asti ei ainoastaan koodipuolella, mutta myös esimerkiksi järjestämässä <a href="https://www.meetup.com/topics/wordpress">WordPress Meetuppeja</a> ja <a href="https://central.wordcamp.org/">WordCampeja</a> Suomessa.</p>

              <p><small>Dude on ansainnut seuraavat WordPress-maailman viralliset <a href="https://make.wordpress.org/meta/handbook/documentation/profile-badges/">ansiomerkit</a> WordPress-kontribuutioistaan (käyttäjät <a href="https://profiles.wordpress.org/digitoimistodude">digitoimistodude</a>, <a href="https://profiles.wordpress.org/rolle">rolle</a>, <a href="https://profiles.wordpress.org/sippis">sippis</a>):</small></p>

              <ul class="item-list" role="main">
                <li>
                  <span class="screen-reader-text">Theme Developer</span>
                  <svg class="badge item dashicons badge-themes dashicons-admin-appearance" title="Theme Developer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24"><rect x="0" fill="none" width="20" height="20"/><g><path d="M14.48 11.06L7.41 3.99l1.5-1.5c.5-.56 2.3-.47 3.51.32 1.21.8 1.43 1.28 2.91 2.1 1.18.64 2.45 1.26 4.45.85zm-.71.71L6.7 4.7 4.93 6.47c-.39.39-.39 1.02 0 1.41l1.06 1.06c.39.39.39 1.03 0 1.42-.6.6-1.43 1.11-2.21 1.69-.35.26-.7.53-1.01.84C1.43 14.23.4 16.08 1.4 17.07c.99 1 2.84-.03 4.18-1.36.31-.31.58-.66.85-1.02.57-.78 1.08-1.61 1.69-2.21.39-.39 1.02-.39 1.41 0l1.06 1.06c.39.39 1.02.39 1.41 0z"/></g></svg>
                  Theme Developer
                </li>
                <li>
                  <span class="screen-reader-text">Plugin Developer</span>
                  <svg class="badge item dashicons badge-plugins dashicons-admin-plugins" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="Plugin Developer"><rect x="0" fill="none" width="20" height="20"/><g><path d="M13.11 4.36L9.87 7.6 8 5.73l3.24-3.24c.35-.34 1.05-.2 1.56.32.52.51.66 1.21.31 1.55zm-8 1.77l.91-1.12 9.01 9.01-1.19.84c-.71.71-2.63 1.16-3.82 1.16H6.14L4.9 17.26c-.59.59-1.54.59-2.12 0-.59-.58-.59-1.53 0-2.12l1.24-1.24v-3.88c0-1.13.4-3.19 1.09-3.89zm7.26 3.97l3.24-3.24c.34-.35 1.04-.21 1.55.31.52.51.66 1.21.31 1.55l-3.24 3.25z"/></g></svg>
                  Plugin Developer
                </li>
                <li>
                  <span class="screen-reader-text">Translation Contributor</span>
                  <svg class="badge item dashicons badge-translation-contributor dashicons-translation" title="Translation Contributor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24"><rect x="0" fill="none" width="20" height="20"/><g><path d="M11 7H9.49c-.63 0-1.25.3-1.59.7L7 5H4.13l-2.39 7h1.69l.74-2H7v4H2c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h7c1.1 0 2 .9 2 2v2zM6.51 9H4.49l1-2.93zM10 8h7c1.1 0 2 .9 2 2v7c0 1.1-.9 2-2 2h-7c-1.1 0-2-.9-2-2v-7c0-1.1.9-2 2-2zm7.25 5v-1.08h-3.17V9.75h-1.16v2.17H9.75V13h1.28c.11.85.56 1.85 1.28 2.62-.87.36-1.89.62-2.31.62-.01.02.22.97.2 1.46.84 0 2.21-.5 3.28-1.15 1.09.65 2.48 1.15 3.34 1.15-.02-.49.2-1.44.2-1.46-.43 0-1.49-.27-2.38-.63.7-.77 1.14-1.77 1.25-2.61h1.36zm-3.81 1.93c-.5-.46-.85-1.13-1.01-1.93h2.09c-.17.8-.51 1.47-1 1.93l-.04.03s-.03-.02-.04-.03z"/></g></svg>
                  Translation Contributor
                </li>
                <li>
                  <span class="screen-reader-text">Translation Editor</span>
                  <svg class="badge item dashicons badge-translation-editor dashicons-translation" title="Translation Editor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24"><rect x="0" fill="none" width="20" height="20"/><g><path d="M11 7H9.49c-.63 0-1.25.3-1.59.7L7 5H4.13l-2.39 7h1.69l.74-2H7v4H2c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h7c1.1 0 2 .9 2 2v2zM6.51 9H4.49l1-2.93zM10 8h7c1.1 0 2 .9 2 2v7c0 1.1-.9 2-2 2h-7c-1.1 0-2-.9-2-2v-7c0-1.1.9-2 2-2zm7.25 5v-1.08h-3.17V9.75h-1.16v2.17H9.75V13h1.28c.11.85.56 1.85 1.28 2.62-.87.36-1.89.62-2.31.62-.01.02.22.97.2 1.46.84 0 2.21-.5 3.28-1.15 1.09.65 2.48 1.15 3.34 1.15-.02-.49.2-1.44.2-1.46-.43 0-1.49-.27-2.38-.63.7-.77 1.14-1.77 1.25-2.61h1.36zm-3.81 1.93c-.5-.46-.85-1.13-1.01-1.93h2.09c-.17.8-.51 1.47-1 1.93l-.04.03s-.03-.02-.04-.03z"/></g></svg>
                  Translation Editor
                </li>
                <li>
                  <span class="screen-reader-text">WordCamp Speaker</span>
                  <svg class="badge item dashicons badge-speaker dashicons-megaphone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="WordCamp Speaker"><rect x="0" fill="none" width="20" height="20"/><g><path d="M18.15 5.94c.46 1.62.38 3.22-.02 4.48-.42 1.28-1.26 2.18-2.3 2.48-.16.06-.26.06-.4.06-.06.02-.12.02-.18.02-.06.02-.14.02-.22.02h-6.8l2.22 5.5c.02.14-.06.26-.14.34-.08.1-.24.16-.34.16H6.95c-.1 0-.26-.06-.34-.16-.08-.08-.16-.2-.14-.34l-1-5.5H4.25l-.02-.02c-.5.06-1.08-.18-1.54-.62s-.88-1.08-1.06-1.88c-.24-.8-.2-1.56-.02-2.2.18-.62.58-1.08 1.06-1.3l.02-.02 9-5.4c.1-.06.18-.1.24-.16.06-.04.14-.08.24-.12.16-.08.28-.12.5-.18 1.04-.3 2.24.1 3.22.98s1.84 2.24 2.26 3.86zm-2.58 5.98h-.02c.4-.1.74-.34 1.04-.7.58-.7.86-1.76.86-3.04 0-.64-.1-1.3-.28-1.98-.34-1.36-1.02-2.5-1.78-3.24s-1.68-1.1-2.46-.88c-.82.22-1.4.96-1.7 2-.32 1.04-.28 2.36.06 3.72.38 1.36 1 2.5 1.8 3.24.78.74 1.62 1.1 2.48.88zm-2.54-7.08c.22-.04.42-.02.62.04.38.16.76.48 1.02 1s.42 1.2.42 1.78c0 .3-.04.56-.12.8-.18.48-.44.84-.86.94-.34.1-.8-.06-1.14-.4s-.64-.86-.78-1.5c-.18-.62-.12-1.24.02-1.72s.48-.84.82-.94z"/></g></svg>
                  WordCamp Speaker
                </li>
                <li>
                  <span class="screen-reader-text">Community Contributor</span>
                  <svg class="badge item dashicons badge-community-contributor dashicons-groups" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="Community Contributor"><rect x="0" fill="none" width="20" height="20"/><g><path d="M8.03 4.46c-.29 1.28.55 3.46 1.97 3.46 1.41 0 2.25-2.18 1.96-3.46-.22-.98-1.08-1.63-1.96-1.63-.89 0-1.74.65-1.97 1.63zm-4.13.9c-.25 1.08.47 2.93 1.67 2.93s1.92-1.85 1.67-2.93c-.19-.83-.92-1.39-1.67-1.39s-1.48.56-1.67 1.39zm8.86 0c-.25 1.08.47 2.93 1.66 2.93 1.2 0 1.92-1.85 1.67-2.93-.19-.83-.92-1.39-1.67-1.39-.74 0-1.47.56-1.66 1.39zm-.59 11.43l1.25-4.3C14.2 10 12.71 8.47 10 8.47c-2.72 0-4.21 1.53-3.44 4.02l1.26 4.3C8.05 17.51 9 18 10 18c.98 0 1.94-.49 2.17-1.21zm-6.1-7.63c-.49.67-.96 1.83-.42 3.59l1.12 3.79c-.34.2-.77.31-1.2.31-.85 0-1.65-.41-1.85-1.03l-1.07-3.65c-.65-2.11.61-3.4 2.92-3.4.27 0 .54.02.79.06-.1.1-.2.22-.29.33zm8.35-.39c2.31 0 3.58 1.29 2.92 3.4l-1.07 3.65c-.2.62-1 1.03-1.85 1.03-.43 0-.86-.11-1.2-.31l1.11-3.77c.55-1.78.08-2.94-.42-3.61-.08-.11-.18-.23-.28-.33.25-.04.51-.06.79-.06z"/></g></svg>
                  Community Contributor
                </li>
                <li>
                  <span class="screen-reader-text">Community Team</span>
                  <svg class="badge item dashicons badge-community dashicons-groups" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="Community Team"><rect x="0" fill="none" width="20" height="20"/><g><path d="M8.03 4.46c-.29 1.28.55 3.46 1.97 3.46 1.41 0 2.25-2.18 1.96-3.46-.22-.98-1.08-1.63-1.96-1.63-.89 0-1.74.65-1.97 1.63zm-4.13.9c-.25 1.08.47 2.93 1.67 2.93s1.92-1.85 1.67-2.93c-.19-.83-.92-1.39-1.67-1.39s-1.48.56-1.67 1.39zm8.86 0c-.25 1.08.47 2.93 1.66 2.93 1.2 0 1.92-1.85 1.67-2.93-.19-.83-.92-1.39-1.67-1.39-.74 0-1.47.56-1.66 1.39zm-.59 11.43l1.25-4.3C14.2 10 12.71 8.47 10 8.47c-2.72 0-4.21 1.53-3.44 4.02l1.26 4.3C8.05 17.51 9 18 10 18c.98 0 1.94-.49 2.17-1.21zm-6.1-7.63c-.49.67-.96 1.83-.42 3.59l1.12 3.79c-.34.2-.77.31-1.2.31-.85 0-1.65-.41-1.85-1.03l-1.07-3.65c-.65-2.11.61-3.4 2.92-3.4.27 0 .54.02.79.06-.1.1-.2.22-.29.33zm8.35-.39c2.31 0 3.58 1.29 2.92 3.4l-1.07 3.65c-.2.62-1 1.03-1.85 1.03-.43 0-.86-.11-1.2-.31l1.11-3.77c.55-1.78.08-2.94-.42-3.61-.08-.11-.18-.23-.28-.33.25-.04.51-.06.79-.06z"/></g></svg>
                  Community Team
                </li>
                <li>
                  <span class="screen-reader-text">Core Contributor</span>
                  <svg class="badge item dashicons badge-code dashicons-editor-code" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="Core Contributor"><rect x="0" fill="none" width="20" height="20"/><g><path d="M9 6l-4 4 4 4-1 2-6-6 6-6zm2 8l4-4-4-4 1-2 6 6-6 6z"/></g></svg>
                  Core Contributor
                </li>
                <li>
                  <span class="screen-reader-text">Meta Contributor</span>
                  <svg class="badge item dashicons badge-meta-contributor dashicons-networking" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="Meta Contributor"><rect x="0" fill="none" width="20" height="20"/><g><path d="M18 13h1c.55 0 1 .45 1 1.01v2.98c0 .56-.45 1.01-1 1.01h-4c-.55 0-1-.45-1-1.01v-2.98c0-.56.45-1.01 1-1.01h1v-2h-5v2h1c.55 0 1 .45 1 1.01v2.98c0 .56-.45 1.01-1 1.01H8c-.55 0-1-.45-1-1.01v-2.98c0-.56.45-1.01 1-1.01h1v-2H4v2h1c.55 0 1 .45 1 1.01v2.98C6 17.55 5.55 18 5 18H1c-.55 0-1-.45-1-1.01v-2.98C0 13.45.45 13 1 13h1v-2c0-1.1.9-2 2-2h5V7H8c-.55 0-1-.45-1-1.01V3.01C7 2.45 7.45 2 8 2h4c.55 0 1 .45 1 1.01v2.98C13 6.55 12.55 7 12 7h-1v2h5c1.1 0 2 .9 2 2v2z"/></g></svg>
                  Meta Contributor
                </li>
                <li>
                  <span class="screen-reader-text">WordCamp Organizer</span>
                  <svg class="badge item dashicons badge-organizer dashicons-tickets" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" title="WordCamp Organizer"><rect x="0" fill="none" width="20" height="20"/><g><path d="M20 5.38L18.99 8.2v-.01c-1.04-.37-2.19.18-2.57 1.22-.37 1.04.17 2.19 1.22 2.56v.01l-1.01 2.82L1.57 9.42l.99-2.79c1.04.38 2.19-.17 2.56-1.21s-.17-2.18-1.21-2.55L4.93 0zm-5.45 3.37c.74-2.08-.34-4.37-2.42-5.12-2.08-.74-4.37.35-5.11 2.42-.74 2.08.34 4.38 2.42 5.12 2.07.74 4.37-.35 5.11-2.42zm-2.56-4.74c.89.32 1.57.94 1.97 1.71-.01-.01-.02-.01-.04-.02-.33-.12-.67.09-.78.4-.1.28-.03.57.05.91.04.27.09.62-.06 1.04-.1.29-.33.58-.65 1l-.74 1.01.08-4.08.4.11c.19.04.26-.24.08-.29 0 0-.57-.15-.92-.28-.34-.12-.88-.36-.88-.36-.18-.08-.3.19-.12.27 0 0 .16.08.34.16l.01 1.63L9.2 9.18l.08-4.11c.2.06.4.11.4.11.19.04.26-.23.07-.29 0 0-.56-.15-.91-.28-.07-.02-.14-.05-.22-.08.93-.7 2.19-.94 3.37-.52zM7.4 6.19c.17-.49.44-.92.78-1.27l.04 5c-.94-.95-1.3-2.39-.82-3.73zm4.04 4.75l2.1-2.63c.37-.41.57-.77.69-1.12.05-.12.08-.24.11-.35.09.57.04 1.18-.17 1.77-.45 1.25-1.51 2.1-2.73 2.33zm-.7-3.22l.02 3.22c0 .02 0 .04.01.06-.4 0-.8-.07-1.2-.21-.33-.12-.63-.28-.9-.48zm1.24 6.08l2.1.75c.24.84 1 1.45 1.91 1.45H16v3H0v-2.96c1.1 0 2-.89 2-2 0-1.1-.9-2-2-2V9h1.05l-.28.8 4.28 1.52C4.4 12.03 4 12.97 4 14c0 2.21 1.79 4 4 4s4-1.79 4-4c0-.07-.02-.13-.02-.2zm-6.53-2.33l1.48.53c-.14.04-.15.27.03.28 0 0 .18.02.37.03l.56 1.54-.78 2.36-1.31-3.9c.21-.01.41-.03.41-.03.19-.02.17-.31-.02-.3 0 0-.59.05-.96.05-.07 0-.15 0-.23-.01.13-.2.28-.38.45-.55zM4.4 14c0-.52.12-1.02.32-1.46l1.71 4.7C5.23 16.65 4.4 15.42 4.4 14zm4.19-1.41l1.72.62c.07.17.12.37.12.61 0 .31-.12.66-.28 1.16l-.35 1.2zM11.6 14c0 1.33-.72 2.49-1.79 3.11l1.1-3.18c.06-.17.1-.31.14-.46l.52.19c.02.11.03.22.03.34zm-4.62 3.45l1.08-3.14 1.11 3.03c.01.02.01.04.02.05-.37.13-.77.21-1.19.21-.35 0-.69-.06-1.02-.15z"/></g></svg>
                  WordCamp Organizer
                </li>
                <li>
                  <span class="screen-reader-text">Meetup Organizer</span>
                  <svg class="badge item dashicons badge-organizer dashicons-nametag" width="24" height="24" title="Meetup Organizer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M12 5V2c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v3c0 .55.45 1 1 1h2c.55 0 1-.45 1-1zm-2-3c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm8 13V7c0-1.1-.9-2-2-2h-3v.33C13 6.25 12.25 7 11.33 7H8.67C7.75 7 7 6.25 7 5.33V5H4c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-1-6v6H3V9h14zm-8 2c0-.55-.22-1-.5-1s-.5.45-.5 1 .22 1 .5 1 .5-.45.5-1zm3 0c0-.55-.22-1-.5-1s-.5.45-.5 1 .22 1 .5 1 .5-.45.5-1zm-5.96 1.21c.92.48 2.34.79 3.96.79s3.04-.31 3.96-.79c-.21 1-1.89 1.79-3.96 1.79s-3.75-.79-3.96-1.79z"/></g></svg>
                  Meetup Organizer
                </li>
              </ul>
            </div>

          </div>

          <div class="col col-image">

            <div class="image has-lazyload">
              <div class="background-image preview lazyload" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/community-tiny.jpg');" data-src="<?php echo get_template_directory_uri(); ?>/images/community.jpg"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/community.jpg');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/community.jpg');"></div></noscript>
            </div>

          </div>
        </div>

      </div>

    </div>

    <div class="block block-open-source">
      <div class="container">

        <header class="block-head">
          <p class="block-title-pre" aria-describedby="block-title-opensource">Avoin lähdekoodi</p>
          <h2 class="block-title" id="block-title-opensource">Open source intohimona</h2>
        </header>

        <div class="content">
          <p>Dudelle on perustamishetkestä lähtien ollut tärkeää tuottaa laadukasta koodia, käyttää elämää helpottavia tekniikoita ja kehittyä koko ajan paremmaksi. Käyttämällä moderneja tekniikoita saa aikaan myös moderneja verkkosivuja, eikä aikaa tarvitse tuhlata toistuviin, puuduttaviin ja hitaisiin toimenpiteisiin. Käytämme työssämme mm. seuraavia työkaluja ja tekniikoita: SASS/SCSS, Capistrano, HTML, Gulp, NPM, jQuery, JavaScript, Git, NGINX, Vue.js, SVG, Composer, PHP, Mithril.js.</p>

          <p>Alla muutamia ylpeyden aiheitamme. Lisää voit selata <a href="https://github.com/digitoimistodude">GitHubimme</a> alta.</p>
        </div>

        <div class="repos">
          <div class="repo">
            <h3><a class="github-link" href="https://github.com/digitoimistodude/air-light"><svg class="octicon octicon-repo mr-2 text-gray" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>air-light</a></h3>
            <p>WordPress starter theme - designed to be minimal, lightweight and easy for all kinds of WordPress projects.</p>
            <ul>
              <li><span class="screen-reader-text">Language:</span><span class="circle css"></span>CSS</li>
              <li><span class="screen-reader-text">Stars:</span><svg aria-label="stars" class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" role="img"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path></svg>119</li>
              <li><span class="screen-reader-text">Forks:</span><svg aria-label="forks" class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16" role="img"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>23</li>
            </ul>
          </div>
          <div class="repo">
            <h3><a class="github-link" href="https://github.com/digitoimistodude/dude-most-read-posts"><svg class="octicon octicon-repo mr-2 text-gray" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>dude-most-read-posts</a></h3>
            <p>A developer-friendly plugin to count post reads and list most read content.</p>
            <ul>
              <li><span class="screen-reader-text">Language:</span><span class="circle css"></span>PHP</li>
              <li><span class="screen-reader-text">Stars:</span><svg aria-label="stars" class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" role="img"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path></svg>9</li>
              <li><span class="screen-reader-text">Forks:</span><svg aria-label="forks" class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16" role="img"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>2</li>
            </ul>
          </div>
          <div class="repo">
            <h3><a class="github-link" href="https://github.com/digitoimistodude/image-hashtag-feed"><svg class="octicon octicon-repo mr-2 text-gray" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>image-hashtag-feed</a></h3>
            <p>WordPress plugin to get Instagram hashtag feeds working again by bypassing the API.</p>
            <ul>
              <li><span class="screen-reader-text">Language:</span><span class="circle css"></span>PHP</li>
              <li><span class="screen-reader-text">Stars:</span><svg aria-label="stars" class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" role="img"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path></svg>25</li>
              <li><span class="screen-reader-text">Forks:</span><svg aria-label="forks" class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16" role="img"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>7</li>
            </ul>
          </div>
        </div>

      </div>
    </div>

    <?php include get_theme_file_path( 'template-parts/content-modular.php' ); ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
