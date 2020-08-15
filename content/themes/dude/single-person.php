<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dude
 */

the_post();

get_header(); ?>

<div class="content-area">
	<main role="main" id="main" class="site-main">

    <?php get_template_part( 'template-parts/hero', get_post_type() );
    get_template_part( 'template-parts/modules/dudes' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
