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
          <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a data-no-swup class="no-text-link" href="<?php echo get_post_type_archive_link( 'merch' ); ?>">Merch</a></li>
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

    <div class="disclaimer">
      <p>Kaikki oikeudet pidätetään. <a class="no-text-link" href="<?php echo esc_url( get_page_link(3) ); ?>">Lue tietosuojaseloste</a>.</p>
    </div>

  </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script data-swup-reload-script>CRISP_WEBSITE_ID = "-K90vfAnyk27kD-pZAep"</script>
<script data-swup-reload-script async src="https://client.crisp.im/l.js"></script>

<script data-swup-reload-script>
  // Chat greeting
  var daysBetween = function (d1, d2) {
    var diff = Math.abs(d1.getTime() - d2.getTime());
    return diff / (1000 * 60 * 60 * 24);
  };

  var moreThanGreetingThresholdAgo = function (date) {
    var toCheckAgainst = 300000; // 5 minutes in milliseconds
    var anAgo = Date.now() - toCheckAgainst;

    return date < anAgo;
  };

  if (typeof Storage !== "undefined") {
    if (
      sessionStorage.getItem("chat_greeting_visits") >= 2 &&
      sessionStorage.getItem("chat_greeting_sent") === null
    ) {
      // send chat if user has visited over 2 pages and greeting still not sent
      jQuery("body").addClass("chat-box-visible");
      setTimeout(function () {
        maybeSendChatGreeting();
      }, 4500);
    } else if (sessionStorage.getItem("chat_greeting_sent") === null) {
      // send greeting if not sent before

      // init timer
      TimeMe.initialize({
        currentPageName: document.title,
        idleTimeoutInSeconds: 10,
      });

      // trigger chat after X seconds
      TimeMe.callAfterTimeElapsedInSeconds(5, function () {
        jQuery("body").addClass("chat-box-visible");
        maybeSendChatGreeting();
      });
    } else if (
      moreThanGreetingThresholdAgo(
        new Date(sessionStorage.getItem("chat_greeting_sent"))
      )
    ) {
      // send chat if last time over day ago

      // init timer
      TimeMe.initialize({
        currentPageName: document.title,
        idleTimeoutInSeconds: 10,
      });

      // trigger chat after X seconds
      TimeMe.callAfterTimeElapsedInSeconds(5, function () {
        maybeSendChatGreeting();
      });
    } else {
      // Send if none of above apply
      // ...if chat box is not visible of course
      if ( jQuery("body").hasClass("chat-box-visible") === false ) {
        setTimeout(function () {
          jQuery("body").addClass("chat-box-visible");
          maybeSendChatGreeting();
        }, 4500);
      }
      
    } // end if send chat check
  } // end storage check

  function maybeSendChatGreeting() {
    
    // don't show greeting on contact page
    if (jQuery("body").hasClass("page-id-4487")) {
      return;
    }

    // alter greetings based on page
    if (jQuery("body").hasClass("page-id-4485")) {
      // visuaalinen suunnittelu page
      var greetings = [
        "Uutta ilmettä putiikille? Kysy lisää chatissa.",
        "Moi! Mille työn jälki vaikuttaa? 🙂",
        "Moro! Voisimmeko auttaa jotenkin? 👋",
      ];
    } else if (jQuery("body").hasClass("page-id-9")) {
      // verkkosivut- ja palvelut page
      var greetings = [
        "Moottoritie on kuuma, mutta webisivut pitäs saada? 🚀",
        "Verkkosivut uudistuksen tarpeessa? Pistä viestiä niin kerron vähän lisää meidän palveluista. 🙂",
        "Moro! Voisimmeko auttaa jotenkin? 👋",
      ];
    } else {
      // defaults / fallbacks
      var greetings = [
        "Moi! Verkkosivut uudistuksen tarpeessa? Uutta ilmettä putiikille? Kysy lisää chatissa.",
        "Moro! 👋 Onko verkkosivustosi tai yritysilmeesi uudistuksen tarpeessa? Laita viestiä!",
        "Terve! Pistä viestiä niin kerron vähän lisää meidän palveluista. 👋",
      ];
    }

    var greeters = [
      {
        name: "Roni",
        image: dude.theme_base + "/images/chat-roni.jpg",
      },
      {
        name: "Timi",
        image: dude.theme_base + "/images/chat-timi.jpg",
      },
    ];

    // do nothing if session is ongoing or user has opened the chat
    if (
      $crisp.is("website:available") &&
      !$crisp.is("session:ongoing") &&
      !$crisp.is("chat:opened")
    ) {
      // get random greeting and greeter
      if (typeof chat_greeting_override !== "undefined") {
        var greeting = chat_greeting_override;
      } else {
        var greeting =
          greetings[Math.floor(Math.random() * greetings.length)];
      }

      var greeter = greeters[Math.floor(Math.random() * greeters.length)];

      // show greeting
      jQuery("body").append(
        '<div class="chat-greeting"><button class="open-chat" aria-label="Avaa chat"></button><div class="avatar" style="background-image:url(\'' +
          greeter.image +
          '\')"></div><div class="message"><p class="head">Viesti henkilöltä ' +
          greeter.name +
          "</p><p>" +
          greeting +
          '</p></div><button class="close-chat close" aria-label="Sulje ilmoitus"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="32" height="32" fill="currentColor"><path class="clr-i-outline clr-i-outline-path-1" d="M19.41 18l8.29-8.29a1 1 0 0 0-1.41-1.41L18 16.59l-8.29-8.3a1 1 0 0 0-1.42 1.42l8.3 8.29-8.3 8.29A1 1 0 1 0 9.7 27.7l8.3-8.29 8.29 8.29a1 1 0 0 0 1.41-1.41z"/></svg></button></div>'
      );

      $crisp.push([
        "on",
        "chat:opened",
        function () {
          $crisp.push(["do", "message:show", ["text", greeting]]);
          $crisp.push(["off", "chat:opened"]);
        },
      ]);

      // save that we have shown the greeting multiple times
      sessionStorage.setItem(
        "chat_greeting_sent",
        new Date().toLocaleString()
      );
    }
  }

  jQuery("body").on("click", ".chat-greeting button.close", function (event) {
    jQuery("body").removeClass("chat-box-visible");

    jQuery(".chat-greeting")
      .addClass("removed-item-chat")
      .one(
        "webkitAnimationEnd oanimationend msAnimationEnd animationend",
        function (e) {
          jQuery(".chat-greeting").remove();
        }
      );

    sessionStorage.setItem("chat_greeting_sent", new Date().toLocaleString());
  });

  // Open chat if element is clicked
  jQuery("body").on("click", ".open-chat", function (event) {
    event.preventDefault();

    jQuery(".chat-greeting")
      .addClass("removed-item-chat")
      .one(
        "webkitAnimationEnd oanimationend msAnimationEnd animationend",
        function (e) {
          jQuery(".chat-greeting").remove();
        }
      );

    $crisp.push(["do", "chat:show"]);
    $crisp.push(["do", "chat:open"]);
  });

  // If there is unread posts, show the chat
  window.CRISP_READY_TRIGGER = function () {
    setTimeout(function () {
      // Hide chat circle by default unless there is unread messages or session is ongoing
      if ($crisp.get("chat:unread:count") > 0 || $crisp.is("session:ongoing")) {
        $crisp.push(["do", "chat:show"]);
      } else {
        $crisp.push(["do", "chat:hide"]);
      }
    }, 25);
  };
</script>

<!-- Hotjar Tracking Code for www.dude.fi -->
<script data-swup-reload-script>
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
