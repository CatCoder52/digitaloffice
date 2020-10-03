<?php
/**
 * Template Name: Yritys
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

the_post();

get_header(); ?>

<div class="content-area">
  <main id="main" class="site-main">

    <?php
      include get_theme_file_path( 'template-parts/hero.php' );
      include get_theme_file_path( 'template-parts/content-modular.php' );
    ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
