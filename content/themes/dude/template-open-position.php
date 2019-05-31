<?php
/**
 * Template Name: Työpaikka
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

the_post();

$sidebar = get_post_meta( get_the_id(), 'sidebar_content', true );

get_header(); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero.php' ); ?>

    <section class="block block-open-position">
      <div class="container">

        <div class="col col-sidebar">
          <?php echo wpautop( $sidebar ) ?>
        </div>

        <div class="col col-content">
          <?php the_content() ?>
        </div>

      </div>
    </section>


    <?php include get_theme_file_path( 'template-parts/content-modular.php' ); ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
