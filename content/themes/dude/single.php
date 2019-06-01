<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dude
 */

get_header(); ?>


<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php
      include get_theme_file_path( 'template-parts/hero.php' );
    ?>

    <div class="block block-single">
      <div class="container">
        <?php while ( have_posts() ) {
      	 the_post();
				  get_template_part( 'template-parts/content', get_post_type() );
			   }
       ?>
      </div>
    </div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
