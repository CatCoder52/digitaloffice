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

      <div class="main-navigation-wrapper" id="main-navigation-wrapper">

        <button id="nav-toggle" class="nav-toggle nav-toggle-mobile hamburger" type="button" aria-label="<?php esc_attr_e( 'Menu', 'dude' ); ?>">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
          <span id="nav-toggle-label" class="screen-reader-text" aria-label="<?php esc_attr_e( 'Menu', 'dude' ); ?>"><?php esc_attr_e( 'Menu', 'dude' ); ?></span>
        </button>

        <nav id="nav" class="nav-primary" role="navigation">
          <?php
          wp_nav_menu( array(
            'theme_location'    => 'primary',
            'container'         => false,
            'depth'             => 4,
            'menu_class'        => 'menu-items',
            'menu_id'           => 'main-menu',
            'echo'              => true,
            'fallback_cb'       => 'Air_Light_Navwalker::fallback',
            'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
            'walker'            => new Air_Light_Navwalker(),
          ) );
          ?>
        </nav>

        <nav id="nav-desktop" class="nav-primary-desktop" role="navigation">

          <ul class="menu-items nav-menu"><li id="menu-item-18" class="menu-item menu-item-type-post_type menu-item-object-page dude-menu-item menu-item-18"><a href="//192.168.2.108:3000/verkkosivut">Verkkosivut</a></li>
            <li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-19"><a href="#">Visuaalinen suunnittelu</a></li>
            <li id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-22"><a href="#">Ota yhteyttä</a></li>
            <li id="menu-item-4477" class="dude-nav-more nav-toggle menu-item menu-item-type-custom menu-item-object-custom dude-menu-item menu-item-4477"><button>Lisää <span class="plus-cross">+</span></button></li>
          </ul>

        </nav><!-- #nav -->
      </div>
    </header>
  </div><!-- .nav-container -->

  <div class="site-content">
