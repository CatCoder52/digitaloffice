<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-03 20:31:05
 *
 * @package dude2019
 */

?>

<section class="block block-hero block-hero-side-columns block-hero-contact block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content content-contact">

      <div class="side-content-box contact-information">
        <h1>Yhteystiedot</h1>
        <p class="contact-details">Digitoimisto Dude Oy<br />
        Y-tunnus: <a href="https://www.asiakastieto.fi/yritykset/FI/digitoimisto-dude-oy/25480215/yleiskuva">2548021-5</a></p>

        <p class="contact-details">Kauppakatu 14<br />
        40100 Jyväskylä<br />
          <a href="https://maamerkit.dude.fi" target="_blank"><svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 60"><path d="M25.9.6C11.5-.6-.6 11.5.6 25.9c.9 11.4 10.1 20.6 21.5 21.5 14.5 1.2 26.5-10.9 25.3-25.3C46.5 10.7 37.3 1.5 25.9.6zM28.6 4c.9.2 1.8.5 2.7.8.5.3 1 .6 1.6.7 2.5 1.2 4.8 2.9 6.6 5 .1.1.2.3.2.5.1.4 0 .9-.1 1.3-.1.3-.2.5-.2.8 0 .5.5.9.9 1 .3.1.8.1 1.2.1.3 0 .6.2.7.5.2.5.5 1.3.7 1.5.9 2.2 1.4 4.5 1.5 6.9 0 .3-.1.7-.3.9-.4.4-.8 1-1.1 1.5-.7 1.4-1.3 3-2.3 4.2-.5.6-1.1 1.1-1.3 1.9-.2.5-.1 1.1-.2 1.6 0 .2-.4.2-.6.1-.8-1.2-1.4-2.5-1.7-3.9-.2-1-.4-2-.7-3-.3-1-.9-1.9-1.8-2.4-1-.5-2.1-.4-3.2-.5-1.1 0-2.3-.2-3-1.1-.3-.4-.5-.9-.5-1.4-.5-2.6.9-5.4 3.2-6.6.3-.2.6-.3.9-.5.6-.5.9-1.3.7-2.1 0-.2-.3-.3-.4-.2-.6.2-1.2.4-1.7.7-.3.1-.6-.1-.5-.3 0-.9.1-2 .4-3 .3-1.1.6-2.3.1-3.2-.1-.2-.4-.4-.6-.4H27c-.1 0-.1-.1-.1-.1.5-.3.9-.7 1.3-1.1.1-.1.3-.2.4-.2zm-10.1.3c.2-.1.4 0 .5.2.3.5.5 1 .8 1.6.5 1.3.8 2.7.2 3.9-.7 1.4-2.3 2-3.6 2.7-2.7 1.4-5 3.5-6.7 6-.1.1-.2.3-.3.3-.2.1-.4 0-.5-.2-.3-.2-.6-.4-.8-.7-.1-.1-.4.1-.4.3-.4 1.4.3 2.9 1.5 3.6.2.1.4.2.6.4.4.5 0 1.2.1 1.8.1.8 1.1 1.3 2 1.2s1.6-.5 2.4-.8c1.8-.6 3.9-.4 5.4.7.8.5 1.5 1.3 2.3 1.8.7.5 1.6.9 2.4.8.2 0 .4.1.5.2.3.8 0 1.8-.5 2.5-.6.8-1.5 1.4-2.2 2.1-1.7 1.9-2.1 4.8-3.5 6.9-.3.4-.6.8-.8 1.3-.3.7-.2 1.4-.2 2.1 0 .1-.1.3-.2.2-.3-.1-.7-.2-1-.4-.2-.1-.4-.3-.4-.5-.5-2.9-1.5-5.7-2.9-8.3-.6-1-1.2-2.1-2.2-2.7-.3-.2-.6-.4-.7-.7-.1-.2 0-.5 0-.7.4-2.7-.9-5.5-3.1-7.1-.4-.3-.8-.5-1-.9-.2-.4-.2-1-.4-1.4-.2-.4-1-.9-1.4-1.2-.2-.1-.2-.3-.2-.5 1.7-6.9 7.3-12.6 14.3-14.5z"/></svg>Maamerkit kartalla</a>
        </p>

        <p class="contact-details">
          <a class="email" href="mailto:moro@dude.fi">moro@dude.fi</a><br />
          <a class="phone" href="tel:0408351033">040 835 1033</a><br />
          <button class="chat open-chat open-chat-contact" aria-label="Avaa chat"><?php include get_theme_file_path( '/svg/chat.svg' ); ?>Avaa chat</button>
        </p>

        <div class="form-box">
          <button class="arrow-link-wrapper scroll-to-form"><span class="arrow-link">Miten voimme auttaa?<span class="arrow"></span></span></button>
          <p>Kerro lyhyesti projektin tavoitteista niin jutellaan lisää</p>
        </div>

      </div>

    </div>

    <div class="featured-image featured-image-side">

      <div class="shade"></div>

      <div class="background-image preview lazyload" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/dude-map-tiny.jpg');" data-src="<?php echo get_template_directory_uri(); ?>/images/dude-map.jpg"></div>
      <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/dude-map.jpg');"<?php endif; ?>></div>
      <noscript><div class="background-image full-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/dude-map.jpg');"></div></noscript>

    </div>

  </div>
</section>
