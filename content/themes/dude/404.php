<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dude
 */

get_header(); ?>

	<main role="main" id="main" class="site-main">
		<div class="container">

<section class="block block-hero block-hero-enable-transition block-hero-404">
  <div class="container opacity-on-load-instant">

    <div class="content">
      <div class="side-content-box contact-information">
        <h1 class="animate animate-1">Voi prkl! 404! 666!</h1>

        <div class="hero-description animate animate-2">
          <p>Sivua tai tiedostoa ei löydy, eikä täällä ei ole mitään nähtävää, sori!</p>
        </div>

          <p><a class="cta-link cta-link-white animate animate-3" href="<?php echo get_home_url(); ?>">Takaisin etusivulle</a></p>
      </div>
    </div>

  </div>
</section>

		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();
