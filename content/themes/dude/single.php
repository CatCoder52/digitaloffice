<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dude
 */

$newsletter_cta_bg_image_id = 4435;

the_post();

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero.php' ); ?>

    <?php
      $post_year = get_the_time( 'Y' );
      $now_year = gmdate( 'Y' );
    ?>

    <section class="block block-single<?php if ( $post_year <= $now_year - 2 ) : ?> is-old<?php endif; ?>">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <div class="gutenberg-content">
            <?php the_content(); ?>

            <footer class="entry-footer">
              <?php dude_entry_footer(); ?>
            </footer><!-- .entry-footer -->
          </div>

          <?php if ( 5635 !== get_the_id() ) : ?>
            <div class="entry-author">
              <?php // get author and person corresponding author
              $user_id = get_the_author_meta( 'ID' );
              $person_id = $wpdb->get_results( // phpcs:ignore
                $wpdb->prepare(
                  "SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = %s AND meta_value = %s",
                  'email', get_the_author_meta( 'email' )
                )
              );

              if ( ! is_wp_error( $person_id ) && ! empty( $person_id ) ) :
                $job_title = get_post_meta( $person_id[0]->post_id, 'title', true );
                $desc = get_post_meta( $person_id[0]->post_id, 'short_desc_blog', true ); ?>

                <a href="<?php echo get_author_posts_url( $user_id ) ?>"><?php echo get_avatar( $user_id, '512' ); ?></a>
                <h3><?php echo get_the_author_meta( 'display_name' ); ?></h3>

                <?php if ( ! empty( $job_title ) ) : ?>
                  <p class="job-title"><?php
                  echo esc_html( $job_title ) ?></p>
                <?php endif;

                if ( ! empty( $desc ) ) : ?>
                  <p class="person-description"><?php echo esc_html( $desc ) ?></p>
									<?php endif;

              endif; ?>
            </div>
          <?php endif; ?>

      </article><!-- #post-## -->
    </section>

    <?php
      // if ( is_singular( 'post' ) && function_exists( 'relevanssi_the_related_posts' ) ) {
      // relevanssi_the_related_posts();
      // }
      ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
