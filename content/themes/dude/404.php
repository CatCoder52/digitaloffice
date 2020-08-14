<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dude
 */

get_header(); ?>

<div class="overlay overlay--scanline" aria-hidden="true"></div>
<div class="overlay overlay--vignette" aria-hidden="true"></div>

	<main role="main" id="main" class="site-main">
		<div class="container">

      <section class="block block-hero block-hero-404 has-dark-bg">
        <div class="container">

          <div class="content">
            <h1 class="screen-reader-text">Sivua ei löydy</h1>

            <div class="hero-description">
              <p><span class="dudefi">dude.fi</span></p>
              <p>Sivustolla on tapahtunut ongelma, virhe 404 kohdassa <?php echo esc_html( filter_input( INPUT_SERVER, 'REQUEST_URI' ) ); ?>. Etsimääsi sivua tai tiedostoa ei löydy, se on saatettu poistaa tai siirtää.</p>
              <p class="press-f5">Paina F5 jatkaaksesi <span class="blink">_</span></p>
            </div>
          </div>

        </div>
      </section>

		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();
