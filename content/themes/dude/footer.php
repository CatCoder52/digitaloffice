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

<?php if ( 'merch' === get_post_type() ) : ?>
  <?php echo do_shortcode( '[simpay id="4535"]' ); ?>

  <div class="cart" id="cart" data-product-id="null">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>

    <div class="cart-body">
      <p class="full-cart"><span class="cart-text">Korissa </span><span class="cart-text">yhteensä</span> <span class="qty cart-text" id="totals">0</span> <span class="cart-text">kpl</span><span class="cart-text">, </span><span class="qty cart-text" id="price">0</span><span class="cart-text"> &euro; </span> <span class="cart-text">(</span><i class="products" id="products"></i><span class="cart-text">)</span></p>

      <p class="empty-cart-text">Ostoskori on tyhjä.</p>

      <div class="buttons">
        <button class="empty-cart" onClick="emptyCart()">Tyhjennä ostoskori</button>
        <button class="buy" id="buy">Maksa pois kuleksimasta</button>
      </div>
    </div>
  </div>

  <script>
    function emptyCart(){
      window.location.reload();
    }
  </script>
<?php endif; ?>

<footer role="contentinfo" id="colophon" class="block block-footer site-footer">

  <div class="container">

    <div class="logo-square">
      <?php include get_theme_file_path( '/svg/logo.svg' ); ?>
    </div>

    <div class="contact-details">
      <div class="block-head">
        <p class="block-title-pre" aria-describedby="block-title-contact-details">Yhteydenotot</p>
        <h2 class="block-title" id="block-title-contact-details"><a href="mailto:moro@dude.fi">moro@dude.fi</a></h2>

        <p class="foot-note text-smaller">Meidät löytää myös <a href="http://www.facebook.com/digitoimistodude" target="_blank">Facebookista</a>, <a href="https://twitter.com/dudetoimisto" target="_blank">Twitteristä</a>, <a href="http://www.linkedin.com/company/digitoimisto-dude-oy" target="_blank">LinkedInistä</a>, <a href="https://www.youtube.com/channel/UC91UDU7HjbiZS9FN8tG7YlQ" target="_blank">YouTubesta</a>, <a href="https://github.com/digitoimistodude" target="_blank">GitHubista</a>, <a href="https://www.instagram.com/digitoimistodude/" target="_blank">Instagramista</a>, <a href="https://www.itewiki.fi/digitoimisto-dude" target="_blank">Ite wikistä</a> ja <a href="https://www.sohwi.fi" target="_blank">Sohwista</a>.</p>
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

<?php
// Cache start is in the header
if ( ! is_page( 4487 ) ) :
  include get_theme_file_path( 'inc/cache-end.php' );
endif;
?>

</body>
</html>
