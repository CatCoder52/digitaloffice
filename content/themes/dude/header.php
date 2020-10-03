<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dude
 */

$show_chat_greeting = true;
if ( is_singular( 'post' ) ) {
  $show_chat_greeting = get_post_meta( get_the_id(), 'show_chat_greeting', true );
}

if ( 'merch' === get_post_type() ) {
  $show_chat_greeting = false;
}

$body_class = 'no-js';

if ( $show_chat_greeting ) {
  $body_class .= ' send-chat-greeting';
}

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="XF8_bRTu-S4gCsZgA0J78vtv0S5dfIjIFa0Lfm7kO_Y" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<script>
/**
 *
 * 👋 Moi!
 *
 * Onpa mahtavaa, että sivustomme koodi on saanut sinut kiinnostumaan. Tuotannossa suurin osa on minifoituna,
 * mutta meidän kaikki tekeminen löytyy myös GitHubistamme: https://github.com/digitoimistodude
 *
 * Tämän sivuston anti löytyy osoitteesta https://github.com/digitoimistodude/dude - tutki rauhassa!
 *
 * Haluaisitko meille töihin? Lähetä sähköpostia osoitteeseen moro@dude.fi.
 * Avoimiin työpaikkoihimme voit tutustua osoitteessa https://www.dude.fi/tyopaikat
 *
 * Toivottavasti palaillaan!
 *
 *
 *                    `/shhyyyhhyy+:`
 *                 `+hh+.        `-+yds:
 *         :`  ./+omo`                -sdo`
 *         hd`dh/--.                    `+ms`
 *        ydsMN                           `om:
 *       +m` +m.                            -ms
 *       /N:`                                `dy
 *        -dNh+-..  :hyy+.                 -syyMs
 *       `dy.   sNhsN/ `/hh:                /M.-+.
 *       +N     mo -/     .sdo`             /M`
 *       om    +N`          `+dy:           `M:
 *       +m   -N:              -sds:`        +m.
 *       om  :N/````              -ohyo:`     om-
 *       ds +dhyysyyyyyyso/-.-:+oyyyyymNNmhs+:-/ms.
 *     .hd``.          `.-/oys+:.`     ``..:/ohNymNy:
 *     :/N+sN             :Nom+             /M.M: `.:/.
 *      `M/sM+           `ms /N`           `mM.yd
 *      /N`+MN:         -ms   sd-         -mdN .M-
 *      hy -M/dy/-..-:ohy-     :yhs+/::/ohh-yh  hy
 *     `M:  mo .:+ooo/-`         `.::///-` `N/  /N`
 *     +N   :N.    .:+sssso/-`-+syyyyyso:` yd   `M:
 *     mo    +m/-ohy+-.``.-/sho:.`    `-oddd`    mo
 *    -M.     .+y/`                       :      yh
 *    om                                         :M.
 *    hy                                          sm`
 *    N/.+                                       yyNd
 *   :MdMs                                       -Msys
 *   /-/N`                                        om-`
 *     mo `                                      dhdy:
 *    +Myhm                                      hy
 *    `.`/N                                 :s+:`/N`
 *       :M`-h                               +MoyhNo
 *       .MdNd  -h`                      :o` `M:  `.
 *       `y.my+hMo                        hNs:ds
 *         -so/:M./s              --     --hNyys
 *             -MdyM.   /:       ` ho`  .Mysyo.
 *              s- dy-odM- .    yh /Mmo./N
 *                 :Md::M+hM-  omsdyMs/ymy
 *                  y  sh+.om`+N.  .:/:  `
 *                          smN-
 *                           y:
 *
 */
</script>
  <?php wp_head();

  if ( is_singular( 'reference' ) ) :
    $custom_css = get_post_meta( get_the_id(), 'custom_css', true );

    if ( ! empty( $custom_css ) ) : ?>
      <style type="text/css"><?php echo $custom_css ?></style>
    <?php endif;
  endif;

  $chat_greeting_override = get_post_meta( get_the_id(), 'chat_greeting_override', true );
  if ( ! empty( $chat_greeting_override ) ) : ?>
    <script>var chat_greeting_override = '<?php echo esc_html( $chat_greeting_override ) ?>';</script>
  <?php endif; ?>
</head>

<body <?php body_class( $body_class ); ?>>
<div class="site" id="swup">

<!-- Glitch effects for buttons -->
<?php if ( ! preg_match( '/11.1.2 Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : // phpcs:ignore ?>
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="svg-sprite">
    <defs>
        <filter id="filter">
            <feTurbulence aria-hidden="true" type="fractalNoise" baseFrequency="0.000001 0.000001" numOctaves="1" result="warp" seed="1"></feTurbulence>
            <feDisplacementMap aria-hidden="true" xChannelSelector="R" yChannelSelector="G" scale="30" in="SourceGraphic" in2="warp"></feDisplacementMap>
        </filter>
    </defs>
</svg>
<?php endif; ?>

  <div id="page" class="site">
   <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Hyppää sisältöön', 'dude' ); ?></a>

   <div class="nav-container">
    <header class="site-header" role="banner">

      <div class="site-branding">
        <?php if ( is_front_page() && is_home() ) : ?>
        <h1 class="site-title">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
            <?php include get_theme_file_path( '/svg/logo.svg' ); ?>
          </a>
        </h1>
        <?php else : ?>
          <p class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
              <span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
              <?php include get_theme_file_path( '/svg/logo.svg' ); ?>
            </a>
          </p>
        <?php endif;

        $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
          <p class="site-description screen-reader-text"><?php echo $description; // phpcs:ignore ?></p>
        <?php endif; ?>
      </div><!-- .site-branding -->

      <p class="call-me-maybe"><a href="tel:0408351033"><?php include get_theme_file_path( '/svg/phone.svg' ); ?> <span>Kilauta</span></a></p>

      <div class="main-navigation-wrapper" id="main-navigation-wrapper">

      <nav class="nav-primary-desktop" style="display: none;" aria-label="Työpöydän päävalikko">
          <ul class="menu-items nav-menu">
            <li class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-18"><a href="<?php echo get_the_permalink( 9 ); ?>" data-text="Verkkosivut">Verkkosivut</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-19"><a href="<?php echo get_the_permalink( 4485 ); ?>" data-text="Suunnittelu">Suunnittelu</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4482"><a href="<?php echo get_the_permalink( 4493 ); ?>" data-text="Töitämme">Töitämme</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-22"><a href="<?php echo get_the_permalink( 6357 ); ?>" data-text=">Ota yhteyttä">Ota yhteyttä</a></li>
          </ul>
        </nav><!-- #nav -->

        <button id="nav-toggle" class="nav-toggle nav-toggle-desktop hamburger firstfocusableitem">
          <span class="hamburger-box" aria-hidden="true">
            <span class="hamburger-inner" aria-hidden="true"></span>
          </span>
          <span id="nav-toggle-label" class="screen-reader-text toggle-text"><?php esc_attr_e( 'Avaa valikko', 'dude' ); ?></span>
        </button>

        <nav id="nav" class="nav-primary" aria-expanded="false" aria-label="Mobiilivalikko" tabindex="-1">
          <p class="top-button-holder">
            <a href="<?php echo esc_url( get_the_permalink( 6357 ) ); ?>" class="button button-glitch start-project">Ota yhteyttä<?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a>
          </p>

          <div class="container">

            <div class="cols cols-navs">
              <div class="col col-secondary-nav">
                <ul class="menu-items nav-menu">
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">Blogi</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo esc_url( get_the_permalink( 4489 ) ); ?>">Koodi & yhteisö</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo esc_url( get_the_permalink( 4449 ) ); ?>">Yritys & kulttuuri</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo esc_url( get_the_permalink( 4491 ) ); ?>">Työpaikat</a></li>
                  <li style="display: none" class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo esc_url( get_the_permalink( 6704 ) ); ?>">UKK</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a data-no-swup href="<?php echo get_post_type_archive_link( 'merch' ); ?>">Merch</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="https://handbook.dude.fi">Handbook</a></li>
                </ul>

                <div class="cols cols-contact">
                  <div class="col">
                    <h3 class="contact-title">Asiakkuudet</h3>
                    <p>Kristian Hohkavaara<br/>
                      <a href="tel:0408351033">040 835 1033</a><br/>
                      <a href="mailto:kristian@dude.fi">kristian@dude.fi</a>
                    </p>
                  </div>

                  <div class="col">
                    <h3 class="contact-title">Yhteystiedot</h3>
                    <p>
                      <a href="mailto:moro@dude.fi">moro@dude.fi</a><br/>
                      <button class="chat open-chat open-chat-contact" aria-label="Avaa chat" tabindex="0">Avaa chat!</button>
                    </p>
                  </div>
                </div>

              </div>

              <div class="col col-primary-nav">
                <ul class="menu-items nav-menu">
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_home_url(); ?>">Etusivu</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_the_permalink( 9 ); ?>">Verkkosivut</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_the_permalink( 4485 ); ?>">Suunnittelu</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_post_type_archive_link( 'reference' ); ?>">Töitämme</a></li>
                  <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a id="lastfocusableitem" href="<?php echo get_the_permalink( 4487 ); ?>">Yhteystiedot</a></li>
                </ul>
              </div>
            </div>

            <p class="top-button-holder show-on-mobile">
              <a href="<?php echo esc_url( get_the_permalink( 6357 ) ); ?>" class="button button-glitch">Ota yhteyttä<?php include get_theme_file_path( '/svg/arrow-right.svg' ); ?></a>
            </p>

            <div class="cols cols-contact show-on-mobile">
              <div class="col">
                <h3 class="contact-title contact-title-mobile">Asiakkuudet</h3>
                <p>Kristian Hohkavaara<br/>
                  <a href="tel:0408351033">040 835 1033</a><br/>
                  <a href="mailto:kristian@dude.fi">kristian@dude.fi</a>
                </p>
              </div>

              <div class="col">
                <h3 class="contact-title contact-contact-mobile">Yhteystiedot</h3>
                <p>
                  <a href="mailto:moro@dude.fi">moro@dude.fi</a><br/>
                  <button class="chat open-chat open-chat-contact" aria-label="Avaa chat" tabindex="0">Avaa chat!</button>
                </p>
              </div>
            </div>

          </div>

        </nav>
      </div>

    </header>
  </div><!-- .nav-container -->

  <div class="site-content">
