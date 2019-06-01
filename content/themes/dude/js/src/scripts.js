/**
 * Air theme JavaScript.
 */

// Define Javascript is active by changing the body class
document.body.classList.remove('no-js');
document.body.classList.add('js');

// jQuery start
( function( $ ) {

    // Gallery
    $('a.gallery-item[href$=jpg], a.gallery-item[href$=gif], a.gallery-item[href$=png], .gallery-item a[href$=jpg], .gallery-item a[href$=png], .gallery-item a[href$=gif]').magnificPopup({
      type: 'image',
      removalDelay: 600, // Delay removal by X to allow out-animation
      gallery: {
        enabled : true,
        tCounter: '<span class="mfp-counter">%curr% / %total%</span>'
      },
      callbacks: {

        beforeClose: function() {
          var self = this;
          self.wrap.addClass('mfp-animate');
        },

        close: function() {
          var self = this;
          self.wrap.removeClass('mfp-animate');
        },

        open: function() {

          // Add as bg image
          this.wrap.css('background-image', 'url(' + this.currItem.src + ')');

          // Overwrite default prev + next function. Add timeout for CSS3 crossfade animation
          $.magnificPopup.instance.next = function() {
            var self = this;
            self.wrap.removeClass('mfp-image-loaded');
            setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);

            // Add as bg image
            this.wrap.css('background-image', 'url(' + this.currItem.src + ')');

          }
          $.magnificPopup.instance.prev = function() {
            var self = this;
            self.wrap.removeClass('mfp-image-loaded');
            setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);

            // Add as bg image
            this.wrap.css('background-image', 'url(' + this.currItem.src + ')');
          }

          // Add custom CSS class for different styling
          if( this.st.el && this.st.el.data('mfp-dudestyles') ) {
            this.wrap.addClass( this.currItem.el.data('mfp-dudestyles') );
          }

        },

        imageLoadComplete: function() {
          var self = this;
          setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
        },

        change: function() {
          var img = this.content.find('img');
          img.css('max-height', parseFloat(img.css('max-height')) -200);
          if (this.isOpen) {
            this.wrap.addClass('mfp-open');
          }
        },

        resize: function() {
          var img = this.content.find('img');
          img.css('max-height', parseFloat(img.css('max-height')) -200);
        }

      },
      image : {
        markup : '<div class="please-rotate-nag"><div class="phone"></div><div class="message">' + dude_screenReaderText.rotatedevice + '</div></div><div class="mfp-figure">' +
        '<div class="mfp-close"></div>' +
        '<div class="mfp-img"></div>' +
        '<div class="mfp-bottom-bar">' +
        '<div class="mfp-title"></div>' +
        '<div class="mfp-counter"></div>' +
        '</div>' +
        '</div>'
      }
    });

    // Check if gallery is portrait and show/hide notification accordingly
    if(window.innerHeight < window.innerWidth) {
      $('.please-rotate-nag').addClass('is-landscape');
    } else {
      $('.please-rotate-nag').removeClass('is-landscape');
    }

    // The same on resize
    jQuery( window ).resize(function() {
      if(window.innerHeight < window.innerWidth) {
        $('.please-rotate-nag').addClass('is-landscape');
      } else {
        $('.please-rotate-nag').removeClass('is-landscape');
      }
    });

	// Hide or show the "back to top" link
	$(window).scroll(function() {

    // Back to top
  	var offset = 300; // Browser window scroll (in pixels) after which the "back to top" link is shown
  	var offset_opacity = 1200; // Browser window scroll (in pixels) after which the link opacity is reduced
  	var scroll_top_duration = 700; // Duration of the top scrolling animation (in ms)
    var link_class = '.top';

		if( $(this).scrollTop() > offset ) {
      $( link_class ).addClass('is-visible');
    } else {
      $( link_class ).removeClass('is-visible');
    }

		if( $(this).scrollTop() > offset_opacity ) {
			$( link_class ).addClass('fade-out');
		} else {
      $( link_class ).removeClass('fade-out');
    }

  });

  // Document ready start
  $(function() {

  // Timeline
  $('.col-timeline .row .action').on('click', function() {
    $('.col-timeline .row').removeClass('active');

    var dynamicimage = $(this).attr('data-image');
    var dynamiclabel = $(this).attr('data-label');
    $(this).parent().addClass('active');
    document.getElementById("dynamicimage").style.backgroundImage = "url(" + dynamicimage + ")";
    $('#dynamiclabel span').animate({'opacity': 0}, 500, function () {
      $(this).text(dynamiclabel);
    }).animate({'opacity': 1}, 500);
  });

  // Linkable accordion sections
  $('.accordion').each(function() {
    var $t = $(this);
    var hash = location.hash;

    if($t.attr("data-href") == hash) {
      if($t.next('.accordion-content').is(':hidden')) {
        $('.accordion-content').stop(true, false).slideUp(225);
        $t.next('.accordion-content').stop(true, false).slideDown(250, function() {
          $(this).css({
            display: "grid"
          });
          $('html, body').animate({ scrollTop: $t.offset().top - 100 }, 200);
        });

        $t.addClass('open-accordion');
        $('.accordion').children('.arr').removeClass('open');
        $t.children('.arr').addClass('open');
        window.location.hash = $t.attr("data-href");

      } else {
        $t.removeClass('open-accordion');
        $('.accordion').children('.arr').removeClass('open');
        $('.accordion-content').stop(true, false).slideUp(250);

        var slug = $(this).attr("data-href");
        window.location.hash = $t.attr("data-href");
      }

      return false;
    }
  });

  // Accordions
  $('.accordion').on('click', function() {
    var $t = $(this);

    // Remove all open-accordion classes by default when clicking
    $('.accordion').removeClass('open-accordion');

    if($t.next('.accordion-content').is(':hidden')) {
      $('.accordion-content').stop(true, false).slideUp(225);
      $t.next('.accordion-content').stop(true, false).slideDown(250, function() {
        $(this).css({
          display: "grid"
        });
        $('html, body').animate({ scrollTop: $t.offset().top - 100 }, 200);
      });

      $t.addClass('open-accordion');
      $('.accordion').children('.arr').removeClass('open');
      $t.children('.arr').addClass('open');
      window.location.hash = $t.attr("data-href");

      } else {
        $t.removeClass('open-accordion');
        $('.accordion').children('.arr').removeClass('open');
        $('.accordion-content').stop(true, false).slideUp(250);

        var slug = $(this).attr("data-href");
        window.location.hash = $t.attr("data-href");
      }
    });

    // Gutter and switch effect in content-side-switch module
    var doc = document;
    if ( $( '#service-switcher' ).length) {

      var anchors = doc.getElementById('service-switcher').getElementsByTagName('button');
      var highlight = doc.getElementById('highlight');

      // Loop through buttons
      for (var i = 0, len = anchors.length; i < len; i++) {

        // When mouse overing, move tha ball to target position
        anchors[i].addEventListener('mouseover', function(e) {
          var target = e.target;
          var init = doc.getElementById('init');
          highlight.style.top = target.offsetTop + 'px';
        });

        // When mouse out, move back to original position, or position where clicked
        anchors[i].addEventListener('mouseout', function(e) {
          var target = e.target;
          var init = doc.getElementById('init');
          var getClicked = document.getElementsByClassName('clicked');

          // Let's check if there's clicked position
          if ( typeof getClicked !== 'undefined') {
            var clickedElement = getClicked[0];
            var clickedPosition = clickedElement.offsetTop + 'px';
          }

          // If there's clicked position, move ball to content
          if ( target.classList.contains('clicked') ) {
            highlight.style.top = clickedPosition;
            target.classList.add('has-focus');
          } else {

            // If no clicked position, move back to start
            if ( typeof clickedPosition !== 'undefined') {
              highlight.style.top = clickedPosition;
            } else {
              highlight.style.top = 0;
              init.classList.add('has-focus');
            }

            // Let's make sure there's no clicked items if clicked position undefined
            target.classList.remove('clicked');
          }
        });

        // What happens when we click the list item
        anchors[i].addEventListener('click', function(e) {
          var target = e.target;

          // Let's remove classes from all other list items
          jQuery('.service-switcher button').removeClass('has-focus clicked');

          // Adding classes to clicked item
          target.classList.add('clicked');
          target.classList.add('has-focus');

          // Moving to position
          highlight.style.top = target.offsetTop + 'px';

          // Getting right content to show
          var tabId = target.getAttribute('data-tab');

          // Fade out old content
          jQuery('.content-tab').fadeOut(600, function() {
            $(this).removeClass('is-visible');
          });

          // Add class to the content that is corresponding to the clicked item
          jQuery('#' + tabId).addClass('animating');
          jQuery('#' + tabId).fadeIn(600, function() {
            $(this).addClass('is-visible');
            $(this).removeClass('animating');
          });
        });
      }
    }

    // Morph logo when hovered
    // var svgMorpheus = new SVGMorpheus('.loader');
    // var icons = ['step1', 'step2'];
    // var current = 0;

    // function changeIcon() {
    //   svgMorpheus.to(icons[current++ % 2], {rotation: 'none', duration: 1000});
    // }

    // $( '.site-title a' ).hover(
    //   function() {
    //     $(this).find('svg').removeAttr('viewBox');;
    //     $(this).find('svg')[0].setAttribute('viewBox', '0 0 386 627');
    //     changeIcon();
    //   }, function() {
    //     $(this).find('svg').removeAttr('viewBox');
    //     $(this).find('svg')[0].setAttribute('viewBox', '0 0 10000 2602');
    //     changeIcon();
    //   }
    // );

    // Fade out other menu items when selected more-item
    $( '.dude-nav-more a' ).hover(
      function() {
        $( this ).parent().parent().addClass('fade-out');
      }, function() {
        $( this ).parent().parent().removeClass('fade-out');
      }
    );

    // Apple.com fade in all content that have opacity-on-load class
    setTimeout(function() {
      $('.opacity-on-load').addClass('fade-in');
    }, 500);

    // Add transition class after all animations are completed
    setTimeout(function() {
      $('.block-hero').addClass('block-hero-enable-transition');
    }, 3000);

    // Instant fade in
    $('.opacity-on-load-instant').addClass('fade-in');

    // Show selection only until loaded
    $('.block-hero-enable-transition .content').addClass('has-loaded');

    // Set up back to top link
    var moveTo = new MoveTo();
    var target = document.getElementById('target');
    moveTo.move(target);

    // Register a back to top trigger
    var trigger = document.getElementsByClassName('js-trigger')[0];
    moveTo.registerTrigger(trigger);

    // Chat
    if ( typeof( Storage ) !== 'undefined' ) {
      if( localStorage.getItem( 'chat_greeting_sent' ) == null ) {
        // show message on every else page than blog or singular post, but allow on singular when explicity setted as so
        if ( ! $('body').hasClass('blog') && ( ! $('body').hasClass('single-post') || $('body').hasClass('send-chat-greeting') ) ) {
          // init timer
          TimeMe.initialize({
            currentPageName: document.title ,
            idleTimeoutInSeconds: 10
          });

          TimeMe.callAfterTimeElapsedInSeconds( 30, function() {
            // do nothing if
            if( ! $crisp.is('session:ongoing') && ! $crisp.is('chat:opened') ) {

              localStorage.setItem( 'chat_greeting_sent', new Date().toLocaleString() );
            }
          });
        } // end chat allowed check
      } // end chat already sent check
    } // end storage check

  });

} )( jQuery );
