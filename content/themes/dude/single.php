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

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php
      include get_theme_file_path( 'template-parts/hero.php' );
    ?>

    <section class="block block-single">
      <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <header class="block-head">
            <p class="block-title-pre" aria-describedby="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php echo ucfirst( date_i18n( 'l' ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
            <h1 class="block-title" id="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php the_title() ?></h1>
          </header>

          <div class="entry-content">
            <?php the_content(); ?>
          </div><!-- .entry-content -->

          <div class="entry-author">
            <?php // get author and person corresponding author
            $user_id = get_the_author_meta( 'ID' );
            $person_id = $wpdb->get_results(
              $wpdb->prepare(
                "SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = %s AND meta_value = %s",
                "email", get_the_author_meta( 'email' )
              )
            );

            if ( ! is_wp_error( $person_id ) && ! empty( $person_id ) ) :
              $job_title = get_post_meta( $person_id[0]->post_id, 'title', true );
              $desc = get_post_meta( $person_id[0]->post_id, 'short_desc_blog', true ); ?>

              <a href="<?php echo get_the_permalink( $user_id ) ?>"><?php echo get_avatar( $user_id, '512' ); ?></a>
              <h3><?php echo get_the_author_meta( 'display_name' ); ?></h3>

              <?php if ( ! empty( $job_title ) ) : ?>
                <p><?php echo esc_html( $job_title ) ?></p>
              <?php endif;

              if ( ! empty( $desc ) ) : ?>
                <p><?php echo esc_html( $desc ) ?></p>
              <?php endif;

            endif; ?>
          </div>

        </article><!-- #post-## -->

      </div>
    </section>

    <?php if ( is_singular( 'post' ) && function_exists( 'relevanssi_the_related_posts' ) ) {
      relevanssi_the_related_posts();
    } ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
