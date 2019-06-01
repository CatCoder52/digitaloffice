<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="block-head">
      <p class="block-title-pre" aria-describedby="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><?php echo ucfirst( date_i18n( 'l' ) ) ?>na, <?php echo get_the_date( 'j.n.Y' ) ?></p>
      <h1 class="block-title" id="block-title-<?php echo sanitize_title( get_the_title() ) ?>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
    </header>

    <div class="entry-content">
      <?php
      the_content( sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dude' ),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        get_the_title()
      ) );

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dude' ),
        'after'  => '</div>',
      ) );
      ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
      <?php dude_entry_footer(); ?>
    </footer><!-- .entry-footer -->
  </article><!-- #post-## -->
