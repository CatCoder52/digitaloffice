<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dude
 */

?>

</div><!-- #content -->

<footer role="contentinfo" id="colophon" class="block block-footer site-footer">

  <div class="container">


    <div class="logo-square">
      <?php include get_theme_file_path( '/svg/logo.svg' ); ?>
    </div>

    <div class="contact-details">
      <div class="block-head">
        <p class="block-title-pre" aria-describedby="block-title-our-services">Yhteydenotot</p>
        <h2 class="block-title" id="block-title-our-services"><a href="mailto:moro@dude.fi">moro@dude.fi</a></h2>

        <p class="foot-note text-smaller">Meidät löytää myös <a href="http://www.facebook.com/digitoimistodude" target="_blank">Facebookista</a>, <a href="https://twitter.com/hashtag/digitoimistodude?f=tweets&amp;vertical=default&amp;src=hash" target="_blank">Twitteristä</a>, <a href="http://www.linkedin.com/company/digitoimisto-dude-oy" target="_blank">LinkedInistä</a>, <a href="https://www.youtube.com/channel/UC91UDU7HjbiZS9FN8tG7YlQ" target="_blank">YouTubesta</a>, <a href="https://github.com/digitoimistodude" target="_blank">GitHubista</a>, <a href="https://www.instagram.com/digitoimistodude/" target="_blank">Instagramista</a>, <a href="https://www.itewiki.fi/digitoimisto-dude" target="_blank">Ite wikistä</a> ja <a href="https://www.sohwi.fi" target="_blank">Sohwista</a>.</p>
        </div>
      </div>
    </div>

  </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
