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

  <div class="shade" aria-hidden="true">
    <div class="background-image preview lazyload" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/footer-20.jpg');" data-src="<?php echo get_template_directory_uri(); ?>/images/footer.jpg" data-src-mobile="<?php echo get_template_directory_uri(); ?>/images/footer.jpg"></div>
    <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) :  // phpcs:ignore ?> style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/footer.jpg');"<?php endif; ?>></div>
    <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/footer.jpg');"></div></noscript>
  </div>

  <div class="container">

    <p class="large-text">Dude on ollut WordPressin yhteisön toiminnassa mukana alusta asti ei ainoastaan koodipuolella, mutta myös esimerkiksi järjestämässä WordPress Meetuppeja ja WordCampeja Suomessa.</p>

    <div class="cols cols-four">

      <div class="col">
        <h3>Digitoimisto Dude Oy</h3>
        <p>Kauppakatu 14<br/>
          40100 Jyväskylä<br/>
          <a class="no-text-link" href="mailto:moro@dude.fi">moro@dude.fi</a><br/>
          <button class="chat open-chat open-chat-contact" aria-label="Avaa chat" tabindex="0">Avaa chat!</button>
        </p>
      </div>

      <div class="col">
        <h3>Asiakkuudet</h3>
        <p>Kristian Hohkavaara<br/>
          <a class="no-text-link" href="tel:0408351033">040 835 1033</a><br/>
          <a class="no-text-link" href="mailto:kristian@dude.fi">kristian@dude.fi</a></p>
      </div>

      <div class="col">
        <ul class="menu-items nav-menu">
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_post_type_archive_link( 'post' ); ?>">Blogi</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_the_permalink( 4489 ); ?>">Koodi & yhteisö</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_the_permalink( 4449 ); ?>">Yritys & kulttuuri</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_the_permalink( 4491 ); ?>">Rekry</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_post_type_archive_link( 'merch' ); ?>">Merch</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="https://handbook.dude.fi">Handbook</a></li>
        </ul>
      </div>

      <div class="col">
        <ul class="menu-items nav-menu">
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="http://www.facebook.com/digitoimistodude" target="_blank">Facebook</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="https://twitter.com/dudetoimisto" target="_blank">Twitter</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="http://www.linkedin.com/company/digitoimisto-dude-oy" target="_blank">LinkedIn</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="https://www.instagram.com/digitoimistodude/" target="_blank">Instagram</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="https://github.com/digitoimistodude" target="_blank">Github</a></li>
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="https://www.itewiki.fi/digitoimisto-dude" target="_blank">IteWiki</a></li>
        </ul>
      </div>

    </div>

    <div class="main-links">
      <ul class="menu-items nav-menu">
        <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_the_permalink( 9 ); ?>">Verkkosivut</a></li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_the_permalink( 4485 ); ?>">Suunnittelu</a></li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_post_type_archive_link( 'reference' ); ?>">Töitämme</a></li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a class="no-text-link" href="<?php echo get_the_permalink( 6357 ); ?>">Aloitetaan projekti</a></li>
      </ul>
    </div>

  </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script>CRISP_WEBSITE_ID = "-K90vfAnyk27kD-pZAep"</script>
<script async src="https://client.crisp.im/l.js"></script>

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

</div><!-- .site -->
</body>
</html>
