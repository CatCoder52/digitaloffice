/**
 * Air theme JavaScript.
 */

// Define Javascript is active by changing the body class
document.body.classList.remove("no-js");
document.body.classList.add("js");

// Increase session page visits count
sessionStorage.setItem(
  "chat_greeting_visits",
  Number(sessionStorage.getItem("chat_greeting_visits")) + 1
);

// Init lazyload
let images = document.querySelectorAll(".lazyload");
lazyload(images, {
  root: null,
  rootMargin: "0px",
  threshold: 0,
});

// jQuery start
(function ($) {
  // Slide numbering
  var $gallery = $(".testimonials");
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
    var $el = $(".slide-numbering").find(".total");
    $el.text(slideCount);
  }

  function setCurrentSlideNumber(currentSlide) {
    var $el = $(".slide-numbering").find(".current");
    $el.text(currentSlide + 1);
  }

  // Testimonial slider
  $(".testimonials").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: false,
    fade: false,
    adaptiveHeight: true,
    variableWidth: true,
    centerMode: true,
    appendArrows: $(".custom-arrows"),
    prevArrow:
      '<button class="button-prev button-reset"><span class="screen-reader-text">Edellinen</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M46.148 8.228H1.852m0 0L9.08 1M1.852 8.228l7.228 7.228" /></svg></button>',
    nextArrow:
      '<button class="button-next button-reset"><span class="screen-reader-text">Seuraava</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.852 8.228h44.296m0 0L38.92 1m7.228 7.228l-7.228 7.228"/></svg></button>',
  });

  // Reference slider
  $(".reference-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: false,
    fade: false,
    adaptiveHeight: true,
    variableWidth: true,
    centerMode: false,
    appendArrows: $(".custom-arrows-references"),
    prevArrow:
      '<button class="button-prev button-reset"><span class="screen-reader-text">Edellinen</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M46.148 8.228H1.852m0 0L9.08 1M1.852 8.228l7.228 7.228" /></svg></button>',
    nextArrow:
      '<button class="button-next button-reset"><span class="screen-reader-text">Seuraava</span><svg xmlns="http://www.w3.org/2000/svg" width="48" height="17" viewBox="0 0 48 17"><path fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.852 8.228h44.296m0 0L38.92 1m7.228 7.228l-7.228 7.228"/></svg></button>',
  });

  // Hide or show the "back to top" link
  $(window).scroll(function () {
    // Back to top
    var offset = 300; // Browser window scroll (in pixels) after which the "back to top" link is shown
    var offset_opacity = 1200; // Browser window scroll (in pixels) after which the link opacity is reduced
    var scroll_top_duration = 700; // Duration of the top scrolling animation (in ms)
    var link_class = ".top";

    if ($(this).scrollTop() > offset) {
      $(link_class).addClass("is-visible");
    } else {
      $(link_class).removeClass("is-visible");
    }

    if ($(this).scrollTop() > offset_opacity) {
      $(link_class).addClass("fade-out");
    } else {
      $(link_class).removeClass("fade-out");
    }
  });

  // Document ready start
  $(function () {
    // Timeline
    $(".col-timeline .row .action").on("click", function () {
      $(".col-timeline .row").removeClass("active");

      var dynamicimage = $(this).attr("data-image");
      var dynamiclabel = $(this).attr("data-label");
      $(this).parent().addClass("active");
      document.getElementById("dynamicimage").style.backgroundImage =
        "url(" + dynamicimage + ")";
      $("#dynamiclabel span")
        .animate({ opacity: 0 }, 500, function () {
          $(this).text(dynamiclabel);
        })
        .animate({ opacity: 1 }, 500);
    });

    // Set up back to top link
    var moveTo = new MoveTo();
    var target = document.getElementById("target");
    moveTo.move(target);

    // Register a back to top trigger
    var trigger = document.getElementsByClassName("js-trigger")[0];
    moveTo.registerTrigger(trigger);

    // Chat greeting
    if (typeof Storage !== "undefined") {
      if (
        sessionStorage.getItem("chat_greeting_visits") >= 3 &&
        sessionStorage.getItem("chat_greeting_sent") === null
      ) {
        // send chat if user has visited over 3 pages and greeting still not sent
        setTimeout(function () {
          maybeSendChatGreeting();
        }, 1500);
      } else if (sessionStorage.getItem("chat_greeting_sent") === null) {
        // send greeting if not send before

        // init timer
        TimeMe.initialize({
          currentPageName: document.title,
          idleTimeoutInSeconds: 10,
        });

        // trigger chat after X seconds
        TimeMe.callAfterTimeElapsedInSeconds(5, function () {
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
          "Moro! Voisimmeko auttaa jotenkin? 🙂",
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
        $("body").append(
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

    $("body").on("click", ".chat-greeting button.close", function (event) {
      $(".chat-greeting")
        .addClass("removed-item")
        .one(
          "webkitAnimationEnd oanimationend msAnimationEnd animationend",
          function (e) {
            $(".chat-greeting").remove();
          }
        );

      sessionStorage.setItem("chat_greeting_sent", new Date().toLocaleString());
    });

    // Open chat if element is clicked
    $("body").on("click", ".open-chat", function (event) {
      event.preventDefault();

      $(".chat-greeting")
        .addClass("removed-item")
        .one(
          "webkitAnimationEnd oanimationend msAnimationEnd animationend",
          function (e) {
            $(".chat-greeting").remove();
          }
        );

      $crisp.push(["do", "chat:show"]);
      $crisp.push(["do", "chat:open"]);
    });
  });

  var daysBetween = function (d1, d2) {
    var diff = Math.abs(d1.getTime() - d2.getTime());
    return diff / (1000 * 60 * 60 * 24);
  };

  var moreThanGreetingThresholdAgo = function (date) {
    var toCheckAgainst = 900000; // 15 minutes in milliseconds
    var anAgo = Date.now() - toCheckAgainst;

    return date < anAgo;
  };
})(jQuery);

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
