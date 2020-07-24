/*
An accessible menu for WordPress

https://github.com/theme-smith/accessible-nav-wp
Kirsten Smith (kirsten@themesmith.co.uk)
Licensed GPL v.2 (http://www.gnu.org/licenses/gpl-2.0.html)

This work derived from:
https://github.com/WordPress/twentysixteen (GPL v.2)
https://github.com/wpaccessibility/a11ythemepatterns/tree/master/menu-keyboard-arrow-nav (GPL v.2)
*/

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

  // Transition end function
  function OnTransitionEndHero() {
    animatedHero.classList.remove("is-animatable");
  }

  function OnTransitionEndNav() {
    animatedNav.classList.remove("is-animatable");
  }

  if (jQuery(".block-hero-enable-transition").length) {
    animatedHero.addEventListener("transitionend", OnTransitionEndHero, false);
  }

  if (jQuery(".nav-primary").length) {
    animatedNav.addEventListener("transitionend", OnTransitionEndNav, false);
  }

  // Toggles the menu button
  (function () {
    if (!menuToggle.length) {
      return;
    }

    menuToggle.add(siteNavigation).attr("aria-expanded", "false");
    menuToggle.on("click", function () {

      jQuery("body").toggleClass("js-nav-active");

      // Add blur effect after one second from nav triggered open
      jQuery(".block-hero-enable-transition").toggleClass("add-blur");

      // Change text to closed and vice versa
      var toggletext = jQuery(this).find(".toggle-text").text();
      if (toggletext == "Avaa valikko") {
        jQuery(this).find(".toggle-text").text("Sulje valikko");
      } else {
        jQuery(this).find(".toggle-text").text("Avaa valikko");
      }

      // The 60 FPS Smooth as Butter Solution
      // Source: https://medium.com/outsystems-experts/how-to-achieve-60-fps-animations-with-css3-db7b98610108
      jQuery(".nav-primary").addClass("is-animatable");
      jQuery(".block-hero-enable-transition").addClass("is-animatable");

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
  navOpened = false;

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
