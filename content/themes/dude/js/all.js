/*! dude2019 20-05-2019 18:19 - Digitoimisto Dude Oy (moro@dude.fi) */
/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var e,t=location.hash.substring(1);/^[A-z0-9_-]+$/.test(t)&&(e=document.getElementById(t))&&(/^(?:a|select|input|button|textarea)$/i.test(e.tagName)||(e.tabIndex=-1),e.focus())},!1);var MoveTo=function(){var e={tolerance:0,duration:800,easing:"easeOutQuart",container:window,callback:function(){}};function t(e,t,n,o){return e/=o,-n*(--e*e*e*e-1)+t}function n(e,t){var n={};return Object.keys(e).forEach(function(t){n[t]=e[t]}),Object.keys(t).forEach(function(e){n[e]=t[e]}),n}function o(e){return e instanceof HTMLElement?e.scrollTop:e.pageYOffset}function a(){var o=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.options=n(e,o),this.easeFunctions=n({easeOutQuart:t},a)}return a.prototype.registerTrigger=function(e,t){var o=this;if(e){var a=e.getAttribute("href")||e.getAttribute("data-target"),i=a&&"#"!==a?document.getElementById(a.substring(1)):document.body,s=n(this.options,function(e,t){var n={};return Object.keys(t).forEach(function(t){var o=e.getAttribute("data-mt-".concat(t.replace(/([A-Z])/g,function(e){return"-"+e.toLowerCase()})));o&&(n[t]=isNaN(o)?o:parseInt(o,10))}),n}(e,this.options));"function"==typeof t&&(s.callback=t);var r=function(e){e.preventDefault(),o.move(i,s)};return e.addEventListener("click",r,!1),function(){return e.removeEventListener("click",r,!1)}}},a.prototype.move=function(e){var t=this,a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};if(0===e||e){a=n(this.options,a);var i,s="number"==typeof e?e:e.getBoundingClientRect().top,r=o(a.container),d=null;s-=a.tolerance;window.requestAnimationFrame(function n(u){var c=o(t.options.container);d||(d=u-1);var l=u-d;if(i&&(s>0&&i>c||s<0&&i<c))return a.callback(e);i=c;var p=t.easeFunctions[a.easing](l,r,s,a.duration);a.container.scroll(0,p),l<a.duration?window.requestAnimationFrame(n):(a.container.scroll(0,s+r),a.callback(e))})}},a.prototype.addEaseFunction=function(e,t){this.easeFunctions[e]=t},a}();"undefined"!=typeof module?module.exports=MoveTo:window.MoveTo=MoveTo,function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define("whatInput",[],t):"object"==typeof exports?exports.whatInput=t():e.whatInput=t()}(this,function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var a=t[o]={exports:{},id:o,loaded:!1};return e[o].call(a.exports,a,a.exports,n),a.loaded=!0,a.exports}return n.m=e,n.c=t,n.p="",n(0)}([function(e,t){"use strict";e.exports=function(){if("undefined"==typeof document||"undefined"==typeof window)return{ask:function(){return"initial"},element:function(){return null},ignoreKeys:function(){},specificKeys:function(){},registerOnChange:function(){},unRegisterOnChange:function(){}};var e=document.documentElement,t=null,n="initial",o=n,a=Date.now();try{window.sessionStorage.getItem("what-input")&&(n=window.sessionStorage.getItem("what-input")),window.sessionStorage.getItem("what-intent")&&(o=window.sessionStorage.getItem("what-intent"))}catch(e){}var i=["button","input","select","textarea"],s=[],r=[16,17,18,91,93],d=[],u={keydown:"keyboard",keyup:"keyboard",mousedown:"mouse",mousemove:"mouse",MSPointerDown:"pointer",MSPointerMove:"pointer",pointerdown:"pointer",pointermove:"pointer",touchstart:"touch",touchend:"touch"},c=!1,l={x:null,y:null},p={2:"touch",3:"touch",4:"mouse"},f=!1;try{var g=Object.defineProperty({},"passive",{get:function(){f=!0}});window.addEventListener("test",null,g)}catch(e){}var m=function(){var e=!!f&&{passive:!0};window.PointerEvent?(window.addEventListener("pointerdown",h),window.addEventListener("pointermove",w)):window.MSPointerEvent?(window.addEventListener("MSPointerDown",h),window.addEventListener("MSPointerMove",w)):(window.addEventListener("mousedown",h),window.addEventListener("mousemove",w),"ontouchstart"in window&&(window.addEventListener("touchstart",h,e),window.addEventListener("touchend",h))),window.addEventListener(N(),w,e),window.addEventListener("keydown",h),window.addEventListener("keyup",h),window.addEventListener("focusin",y),window.addEventListener("focusout",b)},h=function(e){var t=e.which,a=u[e.type];"pointer"===a&&(a=x(e));var s=!d.length&&-1===r.indexOf(t),c=d.length&&-1!==d.indexOf(t),l="keyboard"===a&&t&&(s||c)||"mouse"===a||"touch"===a;if(E(a)&&(l=!1),l&&n!==a){n=a;try{window.sessionStorage.setItem("what-input",n)}catch(e){}v("input")}if(l&&o!==a){var p=document.activeElement;if(p&&p.nodeName&&-1===i.indexOf(p.nodeName.toLowerCase())||"button"===p.nodeName.toLowerCase()&&!C(p,"form")){o=a;try{window.sessionStorage.setItem("what-intent",o)}catch(e){}v("intent")}}},v=function(t){e.setAttribute("data-what"+t,"input"===t?n:o),k(t)},w=function(e){var t=u[e.type];if("pointer"===t&&(t=x(e)),L(e),!c&&!E(t)&&o!==t){o=t;try{window.sessionStorage.setItem("what-intent",o)}catch(e){}v("intent")}},y=function(n){n.target.nodeName?(t=n.target.nodeName.toLowerCase(),e.setAttribute("data-whatelement",t),n.target.classList&&n.target.classList.length&&e.setAttribute("data-whatclasses",n.target.classList.toString().replace(" ",","))):b()},b=function(){t=null,e.removeAttribute("data-whatelement"),e.removeAttribute("data-whatclasses")},x=function(e){return"number"==typeof e.pointerType?p[e.pointerType]:"pen"===e.pointerType?"touch":e.pointerType},E=function(e){var t=Date.now(),o="mouse"===e&&"touch"===n&&t-a<200;return a=t,o},N=function(){return"onwheel"in document.createElement("div")?"wheel":void 0!==document.onmousewheel?"mousewheel":"DOMMouseScroll"},k=function(e){for(var t=0,a=s.length;t<a;t++)s[t].type===e&&s[t].fn.call(void 0,"input"===e?n:o)},L=function(e){l.x!==e.screenX||l.y!==e.screenY?(c=!1,l.x=e.screenX,l.y=e.screenY):c=!0},C=function(e,t){var n=window.Element.prototype;if(n.matches||(n.matches=n.msMatchesSelector||n.webkitMatchesSelector),n.closest)return e.closest(t);do{if(e.matches(t))return e;e=e.parentElement||e.parentNode}while(null!==e&&1===e.nodeType);return null};return"addEventListener"in window&&Array.prototype.indexOf&&(u[N()]="mouse",m(),v("input"),v("intent")),{ask:function(e){return"intent"===e?o:n},element:function(){return t},ignoreKeys:function(e){r=e},specificKeys:function(e){d=e},registerOnChange:function(e,t){s.push({fn:e,type:t||"input"})},unRegisterOnChange:function(e){var t=function(e){for(var t=0,n=s.length;t<n;t++)if(s[t].fn===e)return t}(e);(t||0===t)&&s.splice(t,1)}}}()}])}),function(e){var t,n,o,a,i,s,r,d,u,c,l,p,f=e(".nav-container"),g=f.find(".nav-toggle"),m=f.find("#main-navigation-wrapper"),h=f.find("#nav"),v=e("<button />",{class:"dropdown-toggle","aria-expanded":!1}).append(e("<span />",{class:"screen-reader-text",text:dude_screenReaderText.expand}));if(g.length&&(g.add(h).attr("aria-expanded","false"),g.on("click",function(){e(this).add(m).toggleClass("toggled-on"),e(this).toggleClass("toggled-on"),e("body").toggleClass("js-nav-active"),e(this).add(h).attr("aria-expanded","false"===e(this).add(h).attr("aria-expanded")?"true":"false")})),e(".menu-item-has-children > a").after(v),m.find(".menu-item-has-children").attr("aria-haspopup","true"),m.find(".dropdown-toggle").click(function(t){screenReaderSpan=e(this).find(".screen-reader-text"),dropdownMenu=e(this).nextAll(".sub-menu"),t.preventDefault(),e(this).toggleClass("toggled-on"),dropdownMenu.toggleClass("toggled-on"),e(this).attr("aria-expanded","false"===e(this).attr("aria-expanded")?"true":"false"),screenReaderSpan.text(screenReaderSpan.text()===dude_screenReaderText.expand?dude_screenReaderText.collapse:dude_screenReaderText.expand)}),e(".sub-menu .menu-item-has-children").parent(".sub-menu").addClass("has-sub-menu"),e(".menu-item a, button.dropdown-toggle").on("keydown",function(t){if(-1!=[37,38,39,40].indexOf(t.keyCode))switch(t.keyCode){case 37:t.preventDefault(),t.stopPropagation(),e(this).hasClass("dropdown-toggle")?e(this).prev("a").focus():e(this).parent().prev().children("button.dropdown-toggle").length?e(this).parent().prev().children("button.dropdown-toggle").focus():e(this).parent().prev().children("a").focus(),e(this).is("ul ul ul.sub-menu.toggled-on li:first-child a")&&e(this).parents("ul.sub-menu.toggled-on li").children("button.dropdown-toggle").focus();break;case 39:t.preventDefault(),t.stopPropagation(),e(this).next("button.dropdown-toggle").length?e(this).next("button.dropdown-toggle").focus():e(this).parent().next().children("a").focus(),e(this).is("ul.sub-menu .dropdown-toggle.toggled-on")&&e(this).parent().find("ul.sub-menu li:first-child a").focus();break;case 40:t.preventDefault(),t.stopPropagation(),e(this).next().length?e(this).next().find("li:first-child a").first().focus():e(this).parent().next().children("a").focus(),e(this).is("ul.sub-menu a")&&e(this).next("button.dropdown-toggle").length&&e(this).parent().next().children("a").focus(),e(this).is("ul.sub-menu .dropdown-toggle")&&e(this).parent().next().children(".dropdown-toggle").length&&e(this).parent().next().children(".dropdown-toggle").focus();break;case 38:t.preventDefault(),t.stopPropagation(),e(this).parent().prev().length?e(this).parent().prev().children("a").focus():e(this).parents("ul").first().prev(".dropdown-toggle.toggled-on").focus(),e(this).is("ul.sub-menu .dropdown-toggle")&&e(this).parent().prev().children(".dropdown-toggle").length&&e(this).parent().prev().children(".dropdown-toggle").focus()}}),(o=document.getElementById("nav"))&&void 0!==(a=document.getElementById("nav-toggle")))if(t=document.getElementsByTagName("html")[0],n=document.getElementsByTagName("body")[0],i=o.getElementsByTagName("ul")[0],s=document.getElementById("main-navigation-wrapper"),void 0!==i)for(i.setAttribute("aria-expanded","false"),-1===i.className.indexOf("nav-menu")&&(i.className+=" nav-menu"),a.onclick=function(){-1!==o.className.indexOf("is-active")?w():(t.className+=" disable-scroll",n.className+=" js-nav-active",o.className+=" is-active",a.className+=" is-active",a.setAttribute("aria-expanded","true"),i.setAttribute("aria-expanded","true"),c=o.querySelectorAll(["a[href]","area[href]","input:not([disabled])","select:not([disabled])","textarea:not([disabled])","button:not([disabled])","iframe","object","embed","[contenteditable]",'[tabindex]:not([tabindex^="-"])']),l=c[0],p=c[c.length-1],console.log(c),p.addEventListener("keydown",function(e){9!==e.keyCode||e.shiftKey||(e.preventDefault(),a.focus())}),l.addEventListener("keydown",function(e){9===e.keyCode&&e.shiftKey&&(e.preventDefault(),a.focus())}),a.addEventListener("keydown",function(e){9===e.keyCode&&e.shiftKey&&(e.preventDefault(),p.focus())}))},document.addEventListener("keyup",function(e){27==e.keyCode&&-1!==o.className.indexOf("is-active")&&w()}),s.onclick=function(e){e.target==s&&-1!==o.className.indexOf("is-active")&&w()},r=i.getElementsByTagName("a"),i.getElementsByTagName("ul"),d=0,u=r.length;d<u;d++)r[d].addEventListener("focus",y,!0),r[d].addEventListener("blur",y,!0);else a.style.display="none";function w(){t.className=t.className.replace(" disable-scroll",""),n.className=n.className.replace(" js-nav-active",""),o.className=o.className.replace(" is-active",""),a.className=a.className.replace(" is-active",""),a.setAttribute("aria-expanded","false"),i.setAttribute("aria-expanded","false"),a.focus()}function y(){for(var e=this;-1===e.className.indexOf("nav-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}}(jQuery),document.body.classList.remove("no-js"),document.body.classList.add("js"),function(e){e(window).scroll(function(){e(this).scrollTop()>300?e(".top").addClass("is-visible"):e(".top").removeClass("is-visible"),e(this).scrollTop()>1200?e(".top").addClass("fade-out"):e(".top").removeClass("fade-out")}),e(function(){e(".dude-nav-more a").hover(function(){e(this).parent().parent().addClass("fade-out")},function(){e(this).parent().parent().removeClass("fade-out")}),setTimeout(function(){e(".opacity-on-load").addClass("fade-in")},500),e(".opacity-on-load-instant").addClass("fade-in");var t=new MoveTo,n=document.getElementById("target");t.move(n);var o=document.getElementsByClassName("js-trigger")[0];t.registerTrigger(o)})}(jQuery);