['swup:pageView', 'swup:contentReplaced'].forEach( function(event) {
  document.addEventListener( event, function() {
    var $text = document.querySelector(".button-glitch-active"),
    $filter = document.querySelector(".svg-sprite"),
    $turb = $filter.querySelector("#filter feTurbulence"),
    turbVal = {
      val: 1e-6
    },
    turbValX = {
      val: 1e-6
    },

    glitchTimeline = function () {
      var t = new TimelineMax({
        repeat: -1,
        repeatDelay: 2,
        paused: !0,
        onUpdate: function () {
          $turb.setAttribute("baseFrequency", turbVal.val + " " + turbValX.val)
        }
      });
      return t.to(turbValX, .1, {
        val: .5
      }).to(turbVal, .1, {
        val: .02
      }), t.set(turbValX, {
        val: 1e-6
      }).set(turbVal, {
        val: 1e-6
      }), t.to(turbValX, .2, {
        val: .4
      }, .4).to(turbVal, .2, {
        val: .002
      }, .4), t.set(turbValX, {
        val: 1e-6
      }).set(turbVal, {
        val: 1e-6
      }), {
        start: function () {
          t.play(0)
        },
        stop: function () {
          t.pause()
        }
      }
    };

    btnGlitch = new glitchTimeline, jQuery(".button-glitch").on("mouseenter", function () {
      jQuery(this).addClass("button-glitch-active"), btnGlitch.start()
    }).on("mouseleave", function () {
      var t = jQuery(this);
      t.hasClass("button-glitch-active") && (t.removeClass("button-glitch-active"), btnGlitch.stop())
    });
  });
});
