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
<html <?php language_attributes(); ?>><script>
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
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <noscript><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/noscript.css"></noscript>

  <?php wp_head();

  if ( is_singular( 'reference' ) ) :
    $custom_css = get_post_meta( get_the_id(), 'custom_css', true );

    if ( ! empty( $custom_css ) ) : ?>
      <style type="text/css"><?php echo $custom_css ?></style>
    <?php endif;
  endif;

  $chat_greeting_override = get_post_meta( get_the_id(), 'chat_greeting_override', true );
  if ( ! empty( $chat_greeting_override ) ) : ?>
    <script type="text/javascript">var chat_greeting_override = '<?php echo esc_html( $chat_greeting_override ) ?>';</script>
  <?php endif; ?>
</head>

<body <?php body_class( $body_class ); ?>>

  <?php if ( is_page( 4485 ) ) : ?>
    <div id="blueimp-gallery" class="blueimp-gallery" aria-hidden="true">
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
      <div class="numbers"><span id="pos"></span> / <span id="count"></span></div>
      <div class="please-rotate-nag"><div class="content"><div class="phone"></div><div class="message">Käännä älylaitteesi vaakatasoon</div></div></div>
    </div>
  <?php endif; ?>

  <div id="page" class="site">
   <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'dude' ); ?></a>

   <div class="nav-container">
    <header class="site-header opacity-on-load" role="banner">

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
          <p class="site-description screen-reader-text"><?php echo $description; /* WPCS: xss ok. */ ?></p>
        <?php endif; ?>
      </div><!-- .site-branding -->

      <p class="call-me-maybe"><a href="tel:0408351033"><?php include get_theme_file_path( '/svg/phone.svg' ); ?> <span>Kilauta</span></a></p>

      <div class="main-navigation-wrapper opacity-on-load" id="main-navigation-wrapper">

        <button id="nav-toggle" class="nav-toggle nav-toggle-mobile hamburger" type="button" aria-label="<?php esc_attr_e( 'Menu', 'dude' ); ?>">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
          <span id="nav-toggle-label" class="screen-reader-text" aria-label="<?php esc_attr_e( 'Menu', 'dude' ); ?>"><?php esc_attr_e( 'Menu', 'dude' ); ?></span>
        </button>

        <nav id="nav" class="nav-primary" role="navigation" aria-expanded="false">
          <div class="top-button-holder">
            <a href="<?php get_the_permalink( 6357 ) ?>" class="button">Aloitetaan projektisi</a>
          </div>
          <div class="cols">
            <div class="col col-secondary-nav">
              <ul class="menu-items nav-menu">
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_post_type_archive_link( 'post' ); ?>">Blogi</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_the_permalink( 4489 ); ?>">Koodi & yhteisö</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_the_permalink( 4449 ); ?>">Yritys & kulttuuri</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_the_permalink( 4491 ); ?>">Rekry</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_post_type_archive_link( 'merch' ); ?>">Merch</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="https://handbook.dude.fi">Handbook</a></li>
              </ul>

              <div class="contact-cols">
                <div class="col">
                  <p class="title">Asiakkuudet</p>
                  <p>Kristian Hohkavaara<br/>
                    <a href="tel:0408351033">040 835 1033</a><br/>
                    <a href="mailto:kristian@dude.fi">kristian@dude.fi</a>
                  </p>
                </div>
                <div class="col">
                  <p class="title">Yhteys</p>
                  <p>
                    <a href="mailto:moro@dude.fi">moro@dude.fi</a><br/>
                    <button class="open-chat">Avaa chat!</button>
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
                <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item"><a href="<?php echo get_the_permalink( 4487 ); ?>">Yhteys</a></li>
              </ul>
            </div>
          </div>
        </nav>

        <nav id="nav-desktop" class="nav-primary-desktop" role="navigation">
          <ul class="menu-items nav-menu">
            <li class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-18"><a href="<?php echo get_the_permalink( 9 ); ?>">Verkkosivut</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-19"><a href="<?php echo get_the_permalink( 4485 ); ?>">Visuaalinen suunnittelu</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4482"><a href="<?php echo get_the_permalink( 4493 ); ?>">Töitämme</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-22"><a href="<?php echo get_the_permalink( 4487 ); ?>">Ota yhteyttä</a></li>
          </ul>
        </nav><!-- #nav -->
      </div>

      <button id="nav-toggle-desktop" class="nav-toggle-desktop hamburger">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
        <span id="nav-toggle-label" class="screen-reader-text" aria-label="<?php esc_attr_e( 'Menu', 'dude' ); ?>" class="toggle-text"><?php esc_attr_e( 'Lisää', 'dude' ); ?></span>
      </button>

    </header>
  </div><!-- .nav-container -->

  <div class="site-content">
