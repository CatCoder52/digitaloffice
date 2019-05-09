<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

get_header();

get_template_part( 'template-parts/hero', get_post_type() ); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">

    <!-- partially variable dynamic hero -->

    <!-- static text-image -->

    <!-- dynamic gallery -->

    <!-- dynamic cta -->

    <!-- dynamic blog -->

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
