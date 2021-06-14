<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dude
 */

the_post();

// Fields
$guest_post = get_field( 'guest_post' );
$guest_post_author = get_field( 'guest_post_author' );
$guest_post_author_description = get_field( 'guest_post_author_description' );
$guest_post_author_avatar = get_field( 'guest_post_author_avatar' );

get_header(); ?>

<div class="content-area">
	<main id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero.php' ); ?>

    <?php
      // Variables
      $post_year = get_the_time( 'Y' );
      $now_year = gmdate( 'Y' );
      $user_id = get_the_author_meta( 'ID' );
    ?>

    <section class="block has-light-bg block-single<?php if ( $post_year <= $now_year - 2 ) : ?> is-old<?php endif; ?>">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( true === $guest_post ) : ?>
          <div class="author-card">
            <p><span class="author"><img src="<?php echo esc_url( $guest_post_author_avatar['sizes']['thumbnail'] ); ?>" class="avatar avatar-100" alt="<?php echo esc_html( $guest_post_author ); ?>"><span><span class="writtenby">Vieraskynän kirjoittanut</span> <?php echo esc_html( $guest_post_author ); ?></span></span></p>
          </div>
        <?php else : ?>
          <div class="author-card">
            <p><a class="no-text-link author" href="<?php echo get_author_posts_url( $user_id ) ?>" rel="author"><?php echo get_avatar( $user_id, '100' ); ?><span><span class="writtenby">Kirjoittanut</span> <?php echo get_the_author_meta( 'display_name' ); ?></a></span></p>
          </div>
        <?php endif; ?>

        <div class="gutenberg-content">
          <?php the_content(); ?>

          <?php if ( true === $guest_post ) : ?>
            <div class="guest-post-author-card">
              <img src="<?php echo esc_url( $guest_post_author_avatar['sizes']['thumbnail'] ); ?>" class="avatar avatar-100" alt="<?php echo esc_html( $guest_post_author ); ?>">

              <div class="guest-post-author-card-content">
                <h3><?php echo esc_html( $guest_post_author ); ?></h3>
                <?php echo wp_kses_post( wpautop( $guest_post_author_description ) ); ?>
              </div>
            </div>
          <?php endif; ?>

          <footer class="entry-footer">
            <?php dude_entry_footer(); ?>
          </footer><!-- .entry-footer -->
        </div>

        <?php if ( 5635 !== get_the_id() && false === $guest_post ) : ?>
          <div class="entry-author">
            <?php
            // Get big author image
            $author_image_big = get_field( 'author_image_big', 'user_' . $user_id );

            // Get author and person corresponding author
            $person_id = $wpdb->get_results( // phpcs:ignore
              $wpdb->prepare(
                "SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = %s AND meta_value = %s",
                  'email', get_the_author_meta( 'email' )
              )
            );

            if ( ! is_wp_error( $person_id ) && ! empty( $person_id ) ) :
              $job_title = get_post_meta( $person_id[0]->post_id, 'title', true );
              $desc = get_post_meta( $person_id[0]->post_id, 'short_desc_blog', true ); ?>

              <div class="author-image">
                <?php if ( ! empty( $author_image_big ) ) : ?><a href="<?php echo get_author_posts_url( $user_id ); ?>" class="author-image-big"><img src="<?php echo esc_url( $author_image_big['url'] ); ?>" alt="<?php echo get_the_author_meta( 'display_name' ); ?>, <?php
                    echo esc_html( $job_title ) ?>" /></a>
                <?php endif; ?>
              </div>

              <div class="author-info">
                <div class="info-container">
                  <h3><?php echo get_the_author_meta( 'display_name' ); ?></h3>

                  <?php if ( ! empty( $job_title ) ) : ?>
                    <p class="job-title"><?php echo esc_html( $job_title ) ?></p>
                  <?php endif;

                  if ( ! empty( $desc ) ) : ?>
                    <p class="person-description"><?php echo esc_html( $desc ) ?></p>
                    <p class="cta-link-wrapper"><a class="cta-link" href="<?php echo esc_url( get_home_url() ); ?>/dudet/<?php echo strtolower( get_the_author_meta( 'first_name' ) ); ?>">Lue lisää</a></p>
                  <?php endif; ?>
                </div>
              </div>

            <?php endif; ?>

            </div>
        <?php endif; ?>

      </article><!-- #post-## -->
    </section>

    <?php
      if ( is_singular( 'post' ) && function_exists( 'relevanssi_the_related_posts' ) ) {
      relevanssi_the_related_posts();
      }
    ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
