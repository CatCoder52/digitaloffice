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
        <p class="block-title-pre" aria-describedby="block-title-contact-details">Yhteydenotot</p>
        <h2 class="block-title" id="block-title-contact-details"><a href="mailto:moro@dude.fi">moro@dude.fi</a></h2>

        <p class="foot-note text-smaller">Meidät löytää myös <a href="http://www.facebook.com/digitoimistodude" target="_blank">Facebookista</a>, <a href="https://twitter.com/hashtag/digitoimistodude?f=tweets&amp;vertical=default&amp;src=hash" target="_blank">Twitteristä</a>, <a href="http://www.linkedin.com/company/digitoimisto-dude-oy" target="_blank">LinkedInistä</a>, <a href="https://www.youtube.com/channel/UC91UDU7HjbiZS9FN8tG7YlQ" target="_blank">YouTubesta</a>, <a href="https://github.com/digitoimistodude" target="_blank">GitHubista</a>, <a href="https://www.instagram.com/digitoimistodude/" target="_blank">Instagramista</a>, <a href="https://www.itewiki.fi/digitoimisto-dude" target="_blank">Ite wikistä</a> ja <a href="https://www.sohwi.fi" target="_blank">Sohwista</a>.</p>
        </div>
      </div>
    </div>

  </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script>CRISP_WEBSITE_ID = "-K90vfAnyk27kD-pZAep"</script>
<script async src="https://client.crisp.im/l.js"></script>

<script src="//instant.page/1.2.2" type="module" integrity="sha384-2xV8M5griQmzyiY3CDqh1dn4z3llDVqZDqzjzcY+jCBCk/a5fXJmuZ/40JJAPeoU"></script>

<!-- Hotjar Tracking Code for www.dude.fi -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:8741,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

</body>
</html>
