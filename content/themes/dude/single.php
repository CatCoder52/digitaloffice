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

    <?php
      include get_theme_file_path( 'template-parts/hero.php' );
    ?>

    <section class="block block-single">
      <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <header class="block-head">
            <p class="block-title-pre" aria-describedby="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php echo ucfirst( date_i18n( 'l', get_the_date( 'U' ) ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
            <h1 class="block-title" id="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php the_title() ?></h1>
          </header>

          <div class="entry-content">
            <?php the_content(); ?>
          </div><!-- .entry-content -->

          <footer class="entry-footer">
            <?php dude_entry_footer(); ?>
          </footer><!-- .entry-footer -->

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

              <a href="<?php echo get_author_posts_url( $user_id ) ?>"><?php echo get_avatar( $user_id, '512' ); ?></a>
              <h3><?php echo get_the_author_meta( 'display_name' ); ?></h3>

              <?php if ( ! empty( $job_title ) ) : ?>
                <p class="job-title"><?php
                echo esc_html( $job_title ) ?></p>
              <?php endif;

              if ( ! empty( $desc ) ) : ?>
                <p class="person-description"><?php
                echo esc_html( $desc ) ?></p>
              <?php endif;

            endif; ?>
          </div>

        </article><!-- #post-## -->

      </div>
    </section>

    <?php if ( is_singular( 'post' ) && function_exists( 'relevanssi_the_related_posts' ) ) {
      relevanssi_the_related_posts();
    } ?>

    <section class="block block-cta-left-image">
      <div class="container">

        <div class="cols">
          <div class="col col-image">
            <div class="image has-lazyload">
              <div class="background-image preview lazyload" style="background-image: url('<?php echo wp_get_attachment_image_url( $newsletter_cta_bg_image_id, 'tiny-preload-thumbnail' ) ?>');" data-src="<?php echo wp_get_attachment_image_url( $newsletter_cta_bg_image_id, 'large' ) ?>" data-src-mobile="<?php echo wp_get_attachment_image_url( $newsletter_cta_bg_image_id, 'large' ) ?>"></div>
              <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo wp_get_attachment_image_url( $newsletter_cta_bg_image_id, 'large' ) ?>');"<?php endif; ?>></div>
              <noscript><div class="background-image full-image" style="background-image: url('<?php echo wp_get_attachment_image_url( $newsletter_cta_bg_image_id, 'large' ) ?>');"></div></noscript>
            </div>
          </div>

          <div class="col col-content">
            <div class="content">
              <h2 class="block-title">Pullopostia?</h2>
              <p>Koottuja kuulumisia sisältävä bittivirtojen pulloposti saapuu rantaasi noin kolmen kuukauden välein.</p>
              <form action="https://dude.us8.list-manage.com/subscribe/post?u=bda4635b58bba8d9716eb90a6&amp;id=efe9db80e6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
                <label for="mce-EMAIL" class="screen-reader-text">Sähköpostiosoite:</label>

                <div class="inputs">
                  <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Sähköpostiosoite">
                  <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bda4635b58bba8d9716eb90a6_efe9db80e6" tabindex="-1" value=""></div>
                  <input type="submit" value="Lähetä" name="subscribe" id="mc-embedded-subscribe" class="button">
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
