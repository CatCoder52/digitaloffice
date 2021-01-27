/**
 * Air theme JavaScript.
 */

// Import modules
import "./skip-link-focus-fix.js";
import "what-input";
import "./slick.custom.js";
// import "./navigation.js"; // Included inline at the end of initJs function
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

['swup:contentReplaced'].forEach( function(event) {
  document.addEventListener( event, initJs );
});

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

  // Will execute full glitch every 5 seconds
  var intervalID = window.setInterval(fullGlitchAdd, 3000);
  var intervalID2 = window.setInterval(fullGlitchRemove, 4000);

  function fullGlitchAdd() {
    const glitchItem = document.querySelector(".glitch");
    glitchItem.classList.add("glitch-fulltilt");
  }

  function fullGlitchRemove() {
    const glitchItem = document.querySelector(".glitch");
    glitchItem.classList.remove("glitch-fulltilt");
  }

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
  jQuery.fn.isInViewport = function isInViewport() {
    var elementTop = jQuery(this).offset().top;
    var elementBottom = elementTop + jQuery(this).outerHeight();

    var viewportTop = jQuery(window).scrollTop();
    var viewportBottom = viewportTop + jQuery(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
  };

  // Accessibility: Ensure back to top is right color on right background
  jQuery(window).on("resize scroll", function () {
    jQuery(".block").each(function () {
      if (jQuery(this).isInViewport()) {
        jQuery(".back-to-top")
        .removeClass("has-light-bg has-dark-bg")
        .addClass(
          jQuery(this).hasClass("has-light-bg") ? "has-light-bg" : "has-dark-bg"
        );
      }
    });
  });

  // Accessibility add "External link:" aria label for external links
  var currentHost = new RegExp(location.host);
  jQuery('a').each(function () {
    var attr = jQuery(this).attr('aria-label');
    if (!currentHost.test(jQuery(this).attr('href')) && !attr) {
      // A link that does not contain the current host
      var txt = jQuery(this).text();
      jQuery(this).addClass('is-external-link');
      jQuery(this).attr('aria-label', dude_screenReaderText.external_link + ' ' + txt);
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

  (function ($) {
    // Define nav stuff
    var menuContainer = jQuery(".nav-container");
    var menuToggle = menuContainer.find(".nav-toggle");
    var siteHeaderMenu = menuContainer.find("#main-navigation-wrapper");
    var siteNavigation = menuContainer.find("#nav");
    var menu = menuContainer.find("#nav");
    var animatedNav = document.querySelector(".nav-primary");
    var animatedHero = document.querySelector(".block-hero-enable-transition");
    var dropdownToggle = jQuery("<button />", {
      class: "dropdown-toggle",
      "aria-expanded": false,
    }).append(
      jQuery("<span />", {
        class: "screen-reader-text",
        text: dude_screenReaderText.expand,
      })
    );

    // Toggles the menu button
    (function () {
      if (!menuToggle.length) {
        return;
      }

      menuToggle.add(siteNavigation).attr("aria-expanded", "false");
      menuToggle.on("click", function () {

        jQuery("body").toggleClass("js-nav-active");

        // Change text to closed and vice versa
        var toggletext = jQuery(this).find(".toggle-text").text();
        if (toggletext == "Avaa valikko") {
          jQuery(this).find(".toggle-text").text("Sulje valikko");
        } else {
          jQuery(this).find(".toggle-text").text("Avaa valikko");
        }

        // Defer nav background image
        var navBg = "background-image: url({url})";
        document.getElementById("nav").setAttribute('style', navBg.replace("{url}", document.getElementById("nav").getAttribute('data-defer')));

        // jscs:disable
        jQuery(this)
          .add(siteNavigation)
          .attr(
            "aria-expanded",
            jQuery(this).add(siteNavigation).attr("aria-expanded") === "false"
              ? "true"
              : "false"
          );
        // jscs:enable
      });
    })();

    // Adds the dropdown toggle button
    jQuery(".menu-item-has-children > a").after(dropdownToggle);

    // Adds aria attribute
    siteHeaderMenu.find(".menu-item-has-children").attr("aria-haspopup", "true");

    // Toggles the sub-menu when dropdown toggle button clicked
    siteHeaderMenu.find(".dropdown-toggle").click(function (e) {
      screenReaderSpan = jQuery(this).find(".screen-reader-text");
      dropdownMenu = jQuery(this).nextAll(".sub-menu");

      e.preventDefault();
      jQuery(this).toggleClass("toggled-on");
      dropdownMenu.toggleClass("toggled-on");

      // jscs:disable
      jQuery(this).attr(
        "aria-expanded",
        jQuery(this).attr("aria-expanded") === "false" ? "true" : "false"
      );
      // jscs:enable
      screenReaderSpan.text(
        screenReaderSpan.text() === dude_screenReaderText.expand
          ? dude_screenReaderText.collapse
          : dude_screenReaderText.expand
      );
    });

    // Adds a class to sub-menus for styling
    jQuery(".sub-menu .menu-item-has-children")
      .parent(".sub-menu")
      .addClass("has-sub-menu");

    // Keyboard navigation
    jQuery(".menu-item a, button.dropdown-toggle").on("keydown", function (e) {

      if ([37, 38, 39, 40].indexOf(e.keyCode) == -1) {
        return;
      }

      switch (e.keyCode) {
        case 37: // left key
          e.preventDefault();
          e.stopPropagation();

          if (jQuery(this).hasClass("dropdown-toggle")) {
            jQuery(this).prev("a").focus();
          } else {
            if (
              jQuery(this).parent().prev().children("button.dropdown-toggle").length
            ) {
              jQuery(this).parent().prev().children("button.dropdown-toggle").focus();
            } else {
              jQuery(this).parent().prev().children("a").focus();
            }
          }

          if (jQuery(this).is("ul ul ul.sub-menu.toggled-on li:first-child a")) {
            jQuery(this)
              .parents("ul.sub-menu.toggled-on li")
              .children("button.dropdown-toggle")
              .focus();
          }

          break;

        case 39: // right key
          e.preventDefault();
          e.stopPropagation();

          if (jQuery(this).next("button.dropdown-toggle").length) {
            jQuery(this).next("button.dropdown-toggle").focus();
          } else {
            jQuery(this).parent().next().children("a").focus();
          }

          if (jQuery(this).is("ul.sub-menu .dropdown-toggle.toggled-on")) {
            jQuery(this).parent().find("ul.sub-menu li:first-child a").focus();
          }

          break;

        case 40: // down key
          e.preventDefault();
          e.stopPropagation();

          if (jQuery(this).next().length) {
            jQuery(this).next().find("li:first-child a").first().focus();
          } else {
            jQuery(this).parent().next().children("a").focus();
          }

          if (
            jQuery(this).is("ul.sub-menu a") &&
            jQuery(this).next("button.dropdown-toggle").length
          ) {
            jQuery(this).parent().next().children("a").focus();
          }

          if (
            jQuery(this).is("ul.sub-menu .dropdown-toggle") &&
            jQuery(this).parent().next().children(".dropdown-toggle").length
          ) {
            jQuery(this).parent().next().children(".dropdown-toggle").focus();
          }

          break;

        case 38: // up key
          e.preventDefault();
          e.stopPropagation();

          if (jQuery(this).parent().prev().length) {
            jQuery(this).parent().prev().children("a").focus();
          } else {
            jQuery(this)
              .parents("ul")
              .first()
              .prev(".dropdown-toggle.toggled-on")
              .focus();
          }

          if (
            jQuery(this).is("ul.sub-menu .dropdown-toggle") &&
            jQuery(this).parent().prev().children(".dropdown-toggle").length
          ) {
            jQuery(this).parent().prev().children(".dropdown-toggle").focus();
          }

          break;
      }
    });

    var html,
      body,
      container,
      button,
      menu,
      menuWrapper,
      links,
      subMenus,
      i,
      len,
      focusableElements,
      firstFocusableElement,
      lastFocusableElement;

    container = document.getElementById("nav");
    if (!container) {
      return;
    }

    container = document.getElementById("nav");
    if (!container) {
      return;
    }

    button = document.getElementById("nav-toggle");
    if ("undefined" === typeof button) {
      return;
    }

    // Set vars.
    html = document.getElementsByTagName("html")[0];
    body = document.getElementsByTagName("body")[0];
    menu = container.getElementsByTagName("ul")[0];
    menuWrapper = document.getElementById("main-navigation-wrapper");

    // Hide menu toggle button if menu is empty and return early.
    if ("undefined" === typeof menu) {
      button.style.display = "none";
      return;
    }

    menu.setAttribute("aria-expanded", "false");
    if (-1 === menu.className.indexOf("nav-menu")) {
      menu.className += " nav-menu";
    }

    // Accessibility: Init nav opened status
    var navOpened = false;

    button.onclick = function () {

      // Toggle boolean
      navOpened ^= true;

      if (-1 !== container.className.indexOf("is-active")) {
        closeMenu(); // Close menu.
      } else {
        body.className += " js-nav-active";
        container.className += " is-active";
        button.className += " is-active";
        button.setAttribute("aria-expanded", "true");
        menu.setAttribute("aria-expanded", "true");

        // Set focusable elements inside main navigation.
        focusableElements = container.querySelectorAll([
          "a[href]",
          "area[href]",
          "input:not([disabled])",
          "select:not([disabled])",
          "textarea:not([disabled])",
          "button:not([disabled])",
          "iframe",
          "object",
          "embed",
          "[contenteditable]",
          '[tabindex]:not([tabindex^="-"])',
        ]);
        //firstFocusableElement = focusableElements[0];
        firstFocusableElement = button;
        // lastFocusableElement = focusableElements[focusableElements.length - 1];
        lastFocusableElement = document.getElementById("lastfocusableitem");

        // Redirect last Tab to first focusable element.
        lastFocusableElement.addEventListener("keydown", function (e) {
          if (e.keyCode === 9 && !e.shiftKey) {

            if (navOpened === 1) {
              e.preventDefault();
              firstFocusableElement.focus(); // Set focus on first element - that's actually close menu button.
            }
          }
        });

        // Redirect first Shift+Tab to toggle button element.
        firstFocusableElement.addEventListener("keydown", function (e) {

          if (navOpened === 1) {
            if (e.keyCode === 9 && e.shiftKey) {

              e.preventDefault();
              lastFocusableElement.focus(); // Set focus on last element.
            }
          }
        });
      }
    };

    // Close menu using Esc key.
    document.addEventListener("keyup", function (event) {
      if (event.keyCode == 27) {
        var toggletext = jQuery(this).find(".toggle-text").text();
        if (toggletext == "Avaa valikko") {
          jQuery(this).find(".toggle-text").text("Sulje valikko");
        } else {
          jQuery(this).find(".toggle-text").text("Avaa valikko");
        }

        jQuery("body").removeClass("js-nav-active");

        if (-1 !== container.className.indexOf("is-active")) {
          closeMenu(); // Close menu.
        }
      }
    });

    // Close menu clicking menu wrapper area.
    menuWrapper.onclick = function (e) {
      if (
        e.target == menuWrapper &&
        -1 !== container.className.indexOf("is-active")
      ) {
        closeMenu(); // Close menu.
      }
    };

    // Close menu function.
    function closeMenu() {
      navOpened = 0;
      body.className = body.className.replace(" js-nav-active", "");
      container.className = container.className.replace(" is-active", "");
      button.className = button.className.replace(" is-active", "");
      button.setAttribute("aria-expanded", "false");
      document.getElementById("nav").setAttribute("aria-expanded", "false");
      button.focus();
    }

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName("a");
    subMenus = menu.getElementsByTagName("ul");

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
      links[i].addEventListener("focus", toggleFocus, true);
      links[i].addEventListener("blur", toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
      var self = this;

      // Move up through the ancestors of the current link until we hit .nav-menu.
      while (-1 === self.className.indexOf("nav-menu")) {
        // On li elements toggle the class .focus.
        if ("li" === self.tagName.toLowerCase()) {
          if (-1 !== self.className.indexOf("focus")) {
            self.className = self.className.replace(" focus", "");
          } else {
            self.className += " focus";
          }
        }

        self = self.parentElement;
      }
    }
  })(jQuery);
} // end initJs

initJs();
