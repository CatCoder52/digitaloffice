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

// Initiate Swup transitions
const swup = new Swup({
  linkSelector:
    'a[href^="' +
    window.location.origin +
    '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',
  animationSelector: '[class*="swup-transition-"]',
  plugins: [
    new SwupScriptsPlugin({
      head: true,
      body: true,
      optin: true,
    }),
    new SwupBodyClassPlugin(),
  ],
});

// Swup starts
swup.on("contentReplaced", function () {
  // Define Javascript is active by changing the body class
  document.body.classList.remove("no-js");
  document.body.classList.add("js");

  // Init lazyload
  let images = document.querySelectorAll(".lazyload");
  lazyload(images, {
    root: null,
    rootMargin: "0px",
    threshold: 0,
  });

  //navigation.js
  (function ($) {
    // Define nav stuff
    var menuContainer = $(".nav-container");
    var menuToggle = menuContainer.find(".nav-toggle");
    var siteHeaderMenu = menuContainer.find("#main-navigation-wrapper");
    var siteNavigation = menuContainer.find("#nav");
    var animatedNav = document.querySelector(".nav-primary");
    var animatedHero = document.querySelector(".block-hero-enable-transition");
    var dropdownToggle = $("<button />", {
      class: "dropdown-toggle",
      "aria-expanded": false,
    }).append(
      $("<span />", {
        class: "screen-reader-text",
        text: dude_screenReaderText.expand,
      })
    );

    // Transition end function
    function OnTransitionEndHero() {
      animatedHero.classList.remove("is-animatable");
    }

    function OnTransitionEndNav() {
      animatedNav.classList.remove("is-animatable");
    }

    if ($(".block-hero-enable-transition").length) {
      animatedHero.addEventListener(
        "transitionend",
        OnTransitionEndHero,
        false
      );
    }

    if ($(".nav-primary").length) {
      animatedNav.addEventListener("transitionend", OnTransitionEndNav, false);
    }

    // Toggles the menu button
    (function () {
      if (!menuToggle.length) {
        return;
      }

      menuToggle.add(siteNavigation).attr("aria-expanded", "false");
      menuToggle.on("click", function () {
        // $(this).add(siteHeaderMenu).toggleClass('toggled-on');
        // $(this).toggleClass('toggled-on');
        $("body").toggleClass("js-nav-active");

        // Add blur effect after one second from nav triggered open
        $(".block-hero-enable-transition").toggleClass("add-blur");

        // Change text to closed and vice versa
        var toggletext = $(this).find(".toggle-text").text();
        if (toggletext == "Lisää") {
          $(this).find(".toggle-text").text("Sulje");
        } else {
          $(this).find(".toggle-text").text("Lisää");
        }

        // The 60 FPS Smooth as Butter Solution
        // Source: https://medium.com/outsystems-experts/how-to-achieve-60-fps-animations-with-css3-db7b98610108
        $(".nav-primary").addClass("is-animatable");
        $(".block-hero-enable-transition").addClass("is-animatable");

        // jscs:disable
        $(this)
          .add(siteNavigation)
          .attr(
            "aria-expanded",
            $(this).add(siteNavigation).attr("aria-expanded") === "false"
              ? "true"
              : "false"
          );
        // jscs:enable
      });
    })();

    // Adds the dropdown toggle button
    $(".menu-item-has-children > a").after(dropdownToggle);

    // Adds aria attribute
    siteHeaderMenu
      .find(".menu-item-has-children")
      .attr("aria-haspopup", "true");

    // Toggles the sub-menu when dropdown toggle button clicked
    siteHeaderMenu.find(".dropdown-toggle").click(function (e) {
      screenReaderSpan = $(this).find(".screen-reader-text");
      dropdownMenu = $(this).nextAll(".sub-menu");

      e.preventDefault();
      $(this).toggleClass("toggled-on");
      dropdownMenu.toggleClass("toggled-on");

      // jscs:disable
      $(this).attr(
        "aria-expanded",
        $(this).attr("aria-expanded") === "false" ? "true" : "false"
      );
      // jscs:enable
      screenReaderSpan.text(
        screenReaderSpan.text() === dude_screenReaderText.expand
          ? dude_screenReaderText.collapse
          : dude_screenReaderText.expand
      );
    });

    // Adds a class to sub-menus for styling
    $(".sub-menu .menu-item-has-children")
      .parent(".sub-menu")
      .addClass("has-sub-menu");

    // Keyboard navigation
    $(".menu-item a, button.dropdown-toggle").on("keydown", function (e) {
      if ([37, 38, 39, 40].indexOf(e.keyCode) == -1) {
        return;
      }

      switch (e.keyCode) {
        case 37: // left key
          e.preventDefault();
          e.stopPropagation();

          if ($(this).hasClass("dropdown-toggle")) {
            $(this).prev("a").focus();
          } else {
            if (
              $(this).parent().prev().children("button.dropdown-toggle").length
            ) {
              $(this)
                .parent()
                .prev()
                .children("button.dropdown-toggle")
                .focus();
            } else {
              $(this).parent().prev().children("a").focus();
            }
          }

          if ($(this).is("ul ul ul.sub-menu.toggled-on li:first-child a")) {
            $(this)
              .parents("ul.sub-menu.toggled-on li")
              .children("button.dropdown-toggle")
              .focus();
          }

          break;

        case 39: // right key
          e.preventDefault();
          e.stopPropagation();

          if ($(this).next("button.dropdown-toggle").length) {
            $(this).next("button.dropdown-toggle").focus();
          } else {
            $(this).parent().next().children("a").focus();
          }

          if ($(this).is("ul.sub-menu .dropdown-toggle.toggled-on")) {
            $(this).parent().find("ul.sub-menu li:first-child a").focus();
          }

          break;

        case 40: // down key
          e.preventDefault();
          e.stopPropagation();

          if ($(this).next().length) {
            $(this).next().find("li:first-child a").first().focus();
          } else {
            $(this).parent().next().children("a").focus();
          }

          if (
            $(this).is("ul.sub-menu a") &&
            $(this).next("button.dropdown-toggle").length
          ) {
            $(this).parent().next().children("a").focus();
          }

          if (
            $(this).is("ul.sub-menu .dropdown-toggle") &&
            $(this).parent().next().children(".dropdown-toggle").length
          ) {
            $(this).parent().next().children(".dropdown-toggle").focus();
          }

          break;

        case 38: // up key
          e.preventDefault();
          e.stopPropagation();

          if ($(this).parent().prev().length) {
            $(this).parent().prev().children("a").focus();
          } else {
            $(this)
              .parents("ul")
              .first()
              .prev(".dropdown-toggle.toggled-on")
              .focus();
          }

          if (
            $(this).is("ul.sub-menu .dropdown-toggle") &&
            $(this).parent().prev().children(".dropdown-toggle").length
          ) {
            $(this).parent().prev().children(".dropdown-toggle").focus();
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

    container_desktop = document.getElementById("nav-desktop");
    if (!container_desktop) {
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

    button.onclick = function () {
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
        firstFocusableElement = focusableElements[0];
        lastFocusableElement = focusableElements[focusableElements.length - 1];

        // Redirect last Tab to first focusable element.
        lastFocusableElement.addEventListener("keydown", function (e) {
          if (e.keyCode === 9 && !e.shiftKey) {
            e.preventDefault();
            button.focus(); // Set focus on first element - that's actually close menu button.
          }
        });

        // Redirect first Shift+Tab to toggle button element.
        firstFocusableElement.addEventListener("keydown", function (e) {
          if (e.keyCode === 9 && e.shiftKey) {
            e.preventDefault();
            button.focus(); // Set focus on last element.
          }
        });

        // Redirect Shift+Tab from the toggle button to last focusable element.
        button.addEventListener("keydown", function (e) {
          if (e.keyCode === 9 && e.shiftKey) {
            e.preventDefault();
            lastFocusableElement.focus(); // Set focus on last element.
          }
        });
      }
    };

    // Close menu using Esc key.
    document.addEventListener("keyup", function (event) {
      if (event.keyCode == 27) {
        var toggletext = $(this).find(".toggle-text").text();
        if (toggletext == "Lisää") {
          $(this).find(".toggle-text").text("Sulje");
        } else {
          $(this).find(".toggle-text").text("Lisää");
        }

        $("body").removeClass("js-nav-active");

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
      body.className = body.className.replace(" js-nav-active", "");
      container.className = container.className.replace(" is-active", "");
      button.className = button.className.replace(" is-active", "");
      button.setAttribute("aria-expanded", "false");
      menu.setAttribute("aria-expanded", "false");
      button.focus();
    }

    // Close menu function.
    function closeMenu_desktop() {
      //body.className      = body.className.replace( ' js-nav-active', '' );
      //container.className = container.className.replace( ' is-active', '' );
      button.className = button.className.replace(" is-active", "");
      button.setAttribute("aria-expanded", "false");
      menu.setAttribute("aria-expanded", "false");
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

  // Always move scroll position to up when clicking a link
  var moveTo = new MoveTo({
    tolerance: 0,
    duration: 0,
    easing: "easeOutQuart",
    container: window,
  });

  var target = document.getElementById("swup");
  moveTo.move(target);
});
// Swup ends

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
        sessionStorage.getItem("chat_greeting_visits") >= 0 &&
        sessionStorage.getItem("chat_greeting_sent") === null
      ) {
        // send chat if user has visited over 0 pages and greeting still not sent
        setTimeout(function () {
          maybeSendChatGreeting();
        }, 1500);
      } else if (sessionStorage.getItem("chat_greeting_sent") === null) {
        // send greeting if not sent before

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
        .addClass("removed-item-chat")
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
        .addClass("removed-item-chat")
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
