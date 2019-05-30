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

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class( 'no-js' ); ?>>
  <!-- TODO: Move .has-dark-hero class to body -->
  <div id="page" class="site has-dark-hero">
   <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dude' ); ?></a>

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

        <div class="nav-items">
          <div class="content">
            <h2>Palvelumme</h2>
            <ul class="menu-items nav-menu" aria-expanded="false">
              <li class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-18"><a href="<?php echo get_page_link( 9 ); ?>">Verkkosivut</a></li>
              <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-19"><a href="<?php echo get_page_link( 4485 ); ?>">Visuaalinen suunnittelu</a></li>
            </ul>
          </div>

          <div class="content">
            <h2>Refut ja koodit</h2>
            <ul class="menu-items nav-menu" aria-expanded="false">
              <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4482"><a href="<?php echo get_page_link( 4493 ); ?>">Työt</a></li>
              <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4480"><a href="<?php echo get_page_link( 4489 ); ?>">Nörteille</a></li>
            </ul>
          </div>

          <div class="content">
            <h2>Meistä lisää</h2>
            <ul class="menu-items nav-menu" aria-expanded="false">
              <li class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-4478"><a href="<?php echo get_page_link( 4449 ); ?>">Yritys</a></li>
              <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4481"><a href="<?php echo get_page_link( 4491 ); ?>">Työpaikat</a></li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-4479"><a href="<?php echo get_page_link( 11 ); ?>">Blogi</a></li>
            </ul>
          </div>

          <div class="content">
            <h2>Yhteydet</h2>

            <ul class="menu-items nav-menu" aria-expanded="false">
              <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-22"><a href="<?php echo get_page_link( 4487 ); ?>">Yhteystiedot</a></li>
            </ul>

            <p class="contact-details">Kauppakatu 14<br />
              40100 Jyväskylä<br />
              <a href="https://maamerkit.dude.fi" target="_blank"><svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 60"><path d="M25.9.6C11.5-.6-.6 11.5.6 25.9c.9 11.4 10.1 20.6 21.5 21.5 14.5 1.2 26.5-10.9 25.3-25.3C46.5 10.7 37.3 1.5 25.9.6zM28.6 4c.9.2 1.8.5 2.7.8.5.3 1 .6 1.6.7 2.5 1.2 4.8 2.9 6.6 5 .1.1.2.3.2.5.1.4 0 .9-.1 1.3-.1.3-.2.5-.2.8 0 .5.5.9.9 1 .3.1.8.1 1.2.1.3 0 .6.2.7.5.2.5.5 1.3.7 1.5.9 2.2 1.4 4.5 1.5 6.9 0 .3-.1.7-.3.9-.4.4-.8 1-1.1 1.5-.7 1.4-1.3 3-2.3 4.2-.5.6-1.1 1.1-1.3 1.9-.2.5-.1 1.1-.2 1.6 0 .2-.4.2-.6.1-.8-1.2-1.4-2.5-1.7-3.9-.2-1-.4-2-.7-3-.3-1-.9-1.9-1.8-2.4-1-.5-2.1-.4-3.2-.5-1.1 0-2.3-.2-3-1.1-.3-.4-.5-.9-.5-1.4-.5-2.6.9-5.4 3.2-6.6.3-.2.6-.3.9-.5.6-.5.9-1.3.7-2.1 0-.2-.3-.3-.4-.2-.6.2-1.2.4-1.7.7-.3.1-.6-.1-.5-.3 0-.9.1-2 .4-3 .3-1.1.6-2.3.1-3.2-.1-.2-.4-.4-.6-.4H27c-.1 0-.1-.1-.1-.1.5-.3.9-.7 1.3-1.1.1-.1.3-.2.4-.2zm-10.1.3c.2-.1.4 0 .5.2.3.5.5 1 .8 1.6.5 1.3.8 2.7.2 3.9-.7 1.4-2.3 2-3.6 2.7-2.7 1.4-5 3.5-6.7 6-.1.1-.2.3-.3.3-.2.1-.4 0-.5-.2-.3-.2-.6-.4-.8-.7-.1-.1-.4.1-.4.3-.4 1.4.3 2.9 1.5 3.6.2.1.4.2.6.4.4.5 0 1.2.1 1.8.1.8 1.1 1.3 2 1.2s1.6-.5 2.4-.8c1.8-.6 3.9-.4 5.4.7.8.5 1.5 1.3 2.3 1.8.7.5 1.6.9 2.4.8.2 0 .4.1.5.2.3.8 0 1.8-.5 2.5-.6.8-1.5 1.4-2.2 2.1-1.7 1.9-2.1 4.8-3.5 6.9-.3.4-.6.8-.8 1.3-.3.7-.2 1.4-.2 2.1 0 .1-.1.3-.2.2-.3-.1-.7-.2-1-.4-.2-.1-.4-.3-.4-.5-.5-2.9-1.5-5.7-2.9-8.3-.6-1-1.2-2.1-2.2-2.7-.3-.2-.6-.4-.7-.7-.1-.2 0-.5 0-.7.4-2.7-.9-5.5-3.1-7.1-.4-.3-.8-.5-1-.9-.2-.4-.2-1-.4-1.4-.2-.4-1-.9-1.4-1.2-.2-.1-.2-.3-.2-.5 1.7-6.9 7.3-12.6 14.3-14.5z"/></svg>Maamerkit kartalla</a>
            </p>

              <p>
                <a class="email" href="mailto:moro@dude.fi">moro@dude.fi</a><br />
                <a class="phone" href="tel:0408351033">040 835 1033</a>
              </p>
          </div>
        </div>

        </nav>

        <nav id="nav-desktop" class="nav-primary-desktop" role="navigation">

          <ul class="menu-items nav-menu">
            <li class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-18"><a href="<?php echo get_page_link( 9 ); ?>">Verkkosivut</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-19"><a href="<?php echo get_page_link( 4485 ); ?>">Visuaalinen suunnittelu</a></li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-22"><a href="<?php echo get_page_link( 4487 ); ?>">Ota yhteyttä</a></li>
            <li class="dude-nav-more nav-toggle menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4477"><button>Lisää <span class="plus-cross">+</span></button></li>
          </ul>

        </nav><!-- #nav -->
      </div>
    </header>
  </div><!-- .nav-container -->

  <div class="site-content">
