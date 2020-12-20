/**
 * Air theme JavaScript.
 */

// Import modules
import "./skip-link-focus-fix.js";
import "what-input";
import "./slick.custom.js";
import "./navigation.js";
import "./tweenmax.min.js";
import "./buttons.js";
import MoveTo from "moveto";
import Swup from 'swup';
import SwupScriptsPlugin from '@swup/scripts-plugin';
import SwupBodyClassPlugin from '@swup/body-class-plugin';
import SwupHeadPlugin from '@swup/head-plugin';
import LazyLoad from "vanilla-lazyload";

// Initiate Swup transitions
const swup = new Swup({
 linkSelector:
   'a[href^="' +
   window.location.origin +
   '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',
 animationSelector: '[class*="swup-transition-"]',
 plugins: [
   new SwupHeadPlugin(),
   new SwupScriptsPlugin({
     head: true,
     body: true,
     optin: true,
   }),
   new SwupBodyClassPlugin(),
 ],
});

swup.on( 'pageView', initJs );
swup.on( 'contentReplaced', initJs );

function initJs() {
  // Define Javascript is active by changing the body class
  document.body.classList.remove("no-js");
  document.body.classList.add("js");

  // Increase session page visits count
  sessionStorage.setItem(
    "chat_greeting_visits",
    Number(sessionStorage.getItem("chat_greeting_visits")) + 1
  );

  // Init lazyload
  var dude_LazyLoad = new LazyLoad();
  dude_LazyLoad.update();

  // Glitch improvements for main title
  setInterval(function(){
    // toggle the class every X seconds
    $('.glitch').toggleClass('glitch-fulltilt');
    setTimeout(function(){
      // toggle back after X seconds
      $('.glitch').toggleClass('glitch-fulltilt');
    }, 1000);
  }, 4000);

  // Accessibility: Ensure back to top is right color on right background
  var stickyOffset = jQuery(".back-to-top").offset();
  var $contentDivs = jQuery(".block");
  jQuery(document).scroll(function() {
    $contentDivs.each(function(k) {
      var _thisOffset = jQuery(this).offset();
      var _actPosition = _thisOffset.top - jQuery(window).scrollTop();
      if (_actPosition < stickyOffset.top && _actPosition + jQuery(this).height() > 0) {
        jQuery(".back-to-top").removeClass("has-light-bg has-dark-bg").addClass(jQuery(this).hasClass("has-light-bg") ? "has-light-bg" : "has-dark-bg");
        return false;
      }
    });
  });

  // Accessibility: Ensure back to top is right color on right background
  // Detect Visible section on viewport from bottom
  // @link https://codepen.io/BoyWithSilverWings/pen/MJgQqR
  $.fn.isInViewport = function () {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
  };

  // Accessibility: Ensure back to top is right color on right background
  $(window).on("resize scroll", function () {
    $(".block").each(function () {
      if ($(this).isInViewport()) {
        $(".back-to-top")
        .removeClass("has-light-bg has-dark-bg")
        .addClass(
          $(this).hasClass("has-light-bg") ? "has-light-bg" : "has-dark-bg"
        );
      }
    });
  });

  // Accessibility add "External link:" aria label for external links
  var currentHost = new RegExp(location.host);
  $('a').each(function () {
    var attr = $(this).attr('aria-label');
    if (!currentHost.test($(this).attr('href')) && !attr) {
      // A link that does not contain the current host
      var txt = $(this).text();
      $(this).addClass('is-external-link');
      $(this).attr('aria-label', dude_screenReaderText.external_link + ' ' + txt);
    }
  });

  // Hide or show the "back to top" link
  jQuery(window).scroll(function() {
    // Back to top
    var offset = 300; // Browser window scroll (in pixels) after which the "back to top" link is shown
    var offset_opacity = 1200; // Browser window scroll (in pixels) after which the link opacity is reduced
    var scroll_top_duration = 700; // Duration of the top scrolling animation (in ms)
    var link_class = '.back-to-top';

    if( jQuery(this).scrollTop() > offset ) {
      jQuery( link_class ).addClass('is-visible');
    } else {
      jQuery( link_class ).removeClass('is-visible');
    }

    if(jQuery(this).scrollTop() > offset_opacity ) {
      jQuery( link_class ).addClass('fade-out');
    } else {
      jQuery( link_class ).removeClass('fade-out');
    }
  });

  // MoveTo triggers
  const easeFunctions = {
    easeInQuad: function (t, b, c, d) {
      t /= d;
      return c * t * t + b;
    },
    easeOutQuad: function (t, b, c, d) {
      t /= d;
      return -c * t * (t - 2) + b;
    },
  };
  const moveTo = new MoveTo({
    ease: 'easeInQuad',
  }, easeFunctions );
  const triggers = document.getElementsByClassName('js-trigger');
  for (var i = 0; i < triggers.length; i++) {
    moveTo.registerTrigger(triggers[i]);
  }

  // Always move scroll position to up when clicking a link
  var moveToSwup = new MoveTo({
    tolerance: 0,
    duration: 0,
    easing: "easeOutQuart",
    container: window,
  });

  var target = document.getElementById("swup");
  moveToSwup.move(target);

  // Timeline
  jQuery(".col-timeline .row .action").on("click", function () {
    jQuery(".col-timeline .row").removeClass("active");

    var dynamicimage = jQuery(this).attr("data-image");
    var dynamiclabel = jQuery(this).attr("data-label");
    jQuery(this).parent().addClass("active");
    document.getElementById("dynamicimage").style.backgroundImage = "url(" + dynamicimage + ")";
    jQuery("#dynamiclabel span").animate({ opacity: 0 }, 200, function () {
      jQuery(this).text(dynamiclabel);
    }).animate({ opacity: 1 }, 200);
  });

  // Slide numbering
  var $gallery = jQuery(".testimonials");
  var slideCount = null;

  $gallery.on("init", function (event, slick) {
    slideCount = slick.slideCount;
    setSlideCount();
    setCurrentSlideNumber(slick.currentSlide);
  });

  $gallery.on("beforeChange", function (event, slick, currentSlide, nextSlide) {
    setCurrentSlideNumber(nextSlide);
  });

  function setSlideCount() {
    var $el = jQuery(".slide-numbering").find(".total");
    $el.text(slideCount);
  }

  function setCurrentSlideNumber(currentSlide) {
    var $el = jQuery(".slide-numbering").find(".current");
    $el.text(currentSlide + 1);
  }

  // Testimonial slider
  jQuery(".testimonials").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: false,
    fade: false,
    adaptiveHeight: true,
    variableWidth: true,
    centerMode: true,
    appendArrows: jQuery(".custom-arrows"),
    prevArrow: '<button class="button-prev button-reset"><span class="screen-reader-text">Edellinen</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M46.148 8.228H1.852m0 0L9.08 1M1.852 8.228l7.228 7.228" /></svg></button>',
    nextArrow: '<button class="button-next button-reset"><span class="screen-reader-text">Seuraava</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.852 8.228h44.296m0 0L38.92 1m7.228 7.228l-7.228 7.228"/></svg></button>',
  });

  // Reference slider
  jQuery(".reference-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: false,
    fade: false,
    adaptiveHeight: true,
    variableWidth: true,
    centerMode: false,
    appendArrows: jQuery(".custom-arrows-references"),
    prevArrow: '<button class="button-prev button-reset"><span class="screen-reader-text">Edellinen</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M46.148 8.228H1.852m0 0L9.08 1M1.852 8.228l7.228 7.228" /></svg></button>',
    nextArrow: '<button class="button-next button-reset"><span class="screen-reader-text">Seuraava</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.852 8.228h44.296m0 0L38.92 1m7.228 7.228l-7.228 7.228"/></svg></button>',
  });

  // Person image hack
  jQuery(".col-person-image").height(jQuery(".col-person-image img").height());

  // 404 easter egg
  if ( jQuery("body").hasClass("error404") === true ) {
    jQuery(document).bind('keydown keyup', function(e) {
      if ( e.which === 116 ) {
        window.location.href = dude_screenReaderText.homeurl;
      }
      if ( e.which === 82 && e.ctrlKey ) {
        window.location.href = dude_screenReaderText.homeurl;
      }
    });
  }

  // Chat
  // Crisp:start
   // Prevent Swup from resetting social media embeds
   if (typeof window.instgrm !== "undefined") {
     window.instgrm.Embeds.process();
   }

   if (typeof twttr !== "undefined") {
     twttr.widgets.load();
   }

   if (typeof Storage !== "undefined" && typeof $crisp !== "undefined") {
     setTimeout(function () {
       maybeSendChatGreeting();
     }, 5000);
   }

   function maybeSendChatGreeting() {
     // Don't show greeting on contact page
     if (jQuery("body").hasClass("page-id-4487")) {
       return;
     }

     // Alter greetings based on page
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
         "Tarvitsetko uudet, uskottavat verkkosivut? Me voimme auttaa! 🚀",
         "Verkkosivut uudistuksen tarpeessa? Pistä viestiä niin kerron vähän lisää meidän palveluista. 🙂",
         "Moro! 👋  Voisimmeko me olla oikea tekijä seuraavassa projektissanne? ",
       ];
     } else {
       // defaults / fallbacks
       var greetings = [
         "Moi! Verkkosivut uudistuksen tarpeessa? Uutta ilmettä putiikille? Kysy lisää chatissa.",
         "Moro! 👋  Onko verkkosivustosi tai yritysilmeesi uudistuksen tarpeessa? Laita viestiä!",
         "Terve! Pistä viestiä niin kerron vähän lisää meidän palveluista. 👋",
       ];
     }

     var greeters = [
       {
         name: "Kristian",
         image: dude.theme_base + "/images/chat-kristian.jpg",
       },
     ];

     // Do nothing if session is ongoing or user has opened the chat
     if (
       $crisp.is("website:available") &&
       !$crisp.is("session:ongoing") &&
       !$crisp.is("chat:opened")
     ) {
       // Get random greeting and greeter
       if (typeof chat_greeting_override !== "undefined") {
         var greeting = chat_greeting_override;
       } else {
         var greeting =
           greetings[Math.floor(Math.random() * greetings.length)];
       }

       var greeter = greeters[Math.floor(Math.random() * greeters.length)];

       // Convert closed time to unix timestamp
       if (sessionStorage.getItem("chat_greeting_closed") !== null) {
         var dateStringClosed = sessionStorage.getItem("chat_greeting_closed");
         var dateTimePartsClosed = dateStringClosed.split(', ');
         var timePartsClosed = dateTimePartsClosed[1].split(':');
         var datePartsClosed = dateTimePartsClosed[0].split('/');
         var saveddateClosed = new Date(datePartsClosed[2], parseInt(datePartsClosed[1], 10) - 1, datePartsClosed[0], timePartsClosed[0], timePartsClosed[1]);
         var newtimeClosed = new Date(saveddateClosed).getTime();

         // Add X milliseconds
         var unixstampClosed = newtimeClosed + 180000;
         var dateClosed = Date(unixstampClosed).toLocaleString();
       }

       // Convert opened time to unix timestamp
       if (sessionStorage.getItem("chat_greeting_sent") !== null) {
         var dateStringSent = sessionStorage.getItem("chat_greeting_sent");
         var dateTimePartsSent = dateStringSent.split(', ');
         var timePartsSent = dateTimePartsSent[1].split(':');
         var datePartsSent = dateTimePartsSent[0].split('/');
         var saveddateSent = new Date(datePartsSent[2], parseInt(datePartsSent[1], 10) - 1, datePartsSent[0], timePartsSent[0], timePartsSent[1]);
         var newtimeSent = new Date(saveddateSent).getTime();

         // Add X milliseconds
         var unixstampSent = newtimeSent + 180000;
         var dateWillSend = new Date(unixstampSent).toLocaleString();
       }

       // If both not defined, then we'll just send the greeting
       if (sessionStorage.getItem("chat_greeting_sent") === null && sessionStorage.getItem("chat_greeting_closed") === null) {
         var unixstampSent = Date.now() - 100;
         var unixstampClosed = Date.now() - 100;
       }

       // If it has passed X minutes from last time sent or if not sent at all
       if (Date.now() > unixstampSent) {

           // Show greeting
           jQuery("body").append(
             '<div class="chat-greeting"><button class="open-chat" aria-label="Avaa chat"></button><div class="avatar" style="background-image:url(\'' +
             greeter.image +
             '\')"></div><div class="message"><p class="head">Viesti henkilöltä ' +
             greeter.name +
             "</p><p>" +
             greeting +
             '</p></div><button class="close-chat close" aria-label="Sulje ilmoitus"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="32" height="32" fill="currentColor"><path class="clr-i-outline clr-i-outline-path-1" d="M19.41 18l8.29-8.29a1 1 0 0 0-1.41-1.41L18 16.59l-8.29-8.3a1 1 0 0 0-1.42 1.42l8.3 8.29-8.3 8.29A1 1 0 1 0 9.7 27.7l8.3-8.29 8.29 8.29a1 1 0 0 0 1.41-1.41z"/></svg></button></div>'
           );

           console.log('Greeting sent at ' + sessionStorage.getItem("chat_greeting_sent") + '. Next time will send ' + dateWillSend);

           // Save that we have shown the greeting
           sessionStorage.setItem(
             "chat_greeting_sent",
             new Date().toLocaleString()
           );

           // Crisp triggers
           $crisp.push([
             "on",
             "chat:opened",
             function () {
               $crisp.push(["do", "message:show", ["text", greeting]]);
               $crisp.push(["off", "chat:opened"]);
             },
           ]);

         // If closed is defined
         } else {

           // Cool off 5 minutes from closed time
           if (Date.now() > unixstampClosed && Date.now() > unixstampSent) {

             // Show greeting
             jQuery("body").append(
               '<div class="chat-greeting"><button class="open-chat" aria-label="Avaa chat"></button><div class="avatar" style="background-image:url(\'' +
               greeter.image +
               '\')"></div><div class="message"><p class="head">Viesti henkilöltä ' +
               greeter.name +
               "</p><p>" +
               greeting +
               '</p></div><button class="close-chat close" aria-label="Sulje ilmoitus"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="32" height="32" fill="currentColor"><path class="clr-i-outline clr-i-outline-path-1" d="M19.41 18l8.29-8.29a1 1 0 0 0-1.41-1.41L18 16.59l-8.29-8.3a1 1 0 0 0-1.42 1.42l8.3 8.29-8.3 8.29A1 1 0 1 0 9.7 27.7l8.3-8.29 8.29 8.29a1 1 0 0 0 1.41-1.41z"/></svg></button></div>'
             );

             console.log('Greeting sent at ' + sessionStorage.getItem("chat_greeting_sent") + '. Next time will send ' + dateWillSend);

             // Save that we have shown the greeting
             sessionStorage.setItem(
               "chat_greeting_sent",
               new Date().toLocaleString()
             );

             // Crisp triggers
             $crisp.push([
               "on",
               "chat:opened",
               function () {
                 $crisp.push(["do", "message:show", ["text", greeting]]);
                 $crisp.push(["off", "chat:opened"]);
               },
             ]);

           } else {
             if (typeof dateClosed === "undefined") {
               console.log('Greeting not sent, because now is ' + Date() + ' and next greeting sending time is at ' + dateWillSend + ' and chat was never closed.');
             } else {
               console.log('Greeting not sent, because now is ' + Date() + ' and next greeting sending time is at ' + dateWillSend + ' and chat was closed at ' + dateClosed);
           }
       }

         }
     }
   }

   // What happens if chat is closed
   jQuery("body").on("click", ".chat-greeting button.close", function (event) {

     // Set timestamp for closed chat
     sessionStorage.setItem(
       "chat_greeting_closed",
       new Date().toLocaleString()
     );

     console.log('Greeting closed at ' + sessionStorage.getItem("chat_greeting_closed"));

     jQuery("body").removeClass("chat-box-visible");

     jQuery(".chat-greeting")
       .addClass("removed-item-chat")
       .one(
         "webkitAnimationEnd oanimationend msAnimationEnd animationend",
         function (e) {
           jQuery(".chat-greeting").remove();
         }
       );
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
   // Crisp:end

  // Open chat if element is clicked
  jQuery("body").on("click", ".open-chat", function (event) {
    event.preventDefault();

    jQuery(".chat-greeting")
      .addClass("removed-item-chat")
      .one( "webkitAnimationEnd oanimationend msAnimationEnd animationend", function (e) {
        jQuery(".chat-greeting").remove();
      });

    $crisp.push(["do", "chat:show"]);
    $crisp.push(["do", "chat:open"]);
  });
} // end initJs
