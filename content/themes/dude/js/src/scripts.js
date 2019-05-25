/**
 * Air theme JavaScript.
 */

// Define Javascript is active by changing the body class
document.body.classList.remove('no-js');
document.body.classList.add('js');

// jQuery start
( function( $ ) {

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

    // Gutter and switch effect in content-side-switch module
    var doc = document;
    var anchors = doc.getElementById('service-switcher').getElementsByTagName('button');
    var highlight = doc.getElementById('highlight');

    for(var i = 0, len = anchors.length; i < len; i++) {
      anchors[i].addEventListener('mouseover', function(e) {
        var target = e.target;
        var init = doc.getElementById('init');

        jQuery('.service-switcher button').removeClass('has-focus');
        target.classList.remove('clicked');
        target.classList.add('has-focus');
        highlight.style.top = target.offsetTop + 'px';
      });

      anchors[i].addEventListener('mouseout', function(e) {
        var target = e.target;
        var init = doc.getElementById('init');

        if ( target.classList.contains('clicked') ) {
          console.log('clicked');
        } else {
          highlight.style.top = 0;
          init.classList.add('has-focus');
          target.classList.remove('has-focus');
          target.classList.remove('clicked');
        }
      });

      anchors[i].addEventListener('click', function(e) {
        var target = e.target;
        jQuery('.service-switcher button').removeClass('has-focus clicked');
        target.classList.add('clicked');
        target.classList.add('has-focus');
        highlight.style.top = target.offsetTop + 'px';
      });

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

    // Set up back to top link
    var moveTo = new MoveTo();
    var target = document.getElementById('target');
    moveTo.move(target);

    // Register a back to top trigger
    var trigger = document.getElementsByClassName('js-trigger')[0];
    moveTo.registerTrigger(trigger);

  });

} )( jQuery );
