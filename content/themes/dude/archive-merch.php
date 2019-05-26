<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

get_header(); ?>

<div id="content" class="content-area">
	<main role="main" id="main" class="site-main">

    <?php while( have_posts() ) : the_post(); ?>
      <section class="block block-merch-big">
        <div class="container">

          <div class="col col-image" style="background-image:url('<?php echo the_post_thumbnail_url( 'large' ); ?>')"></div>
          <style>.col-image { width: 750px; height: 500px; background-size: cover;  }</style>

          <div class="col col-content">
            <h2><?php the_title() ?></h2>
            <p class="price"><?php echo get_post_meta( get_the_id(), 'price', true ) ?>&euro;</p>
            <?php echo wpautop( get_post_meta( get_the_id(), 'description', true ) ) ?>

            <?php $models = get_field( 'models' );
            if ( ! empty( $models ) ) : ?>
              <p>Valitse malli</p>
              <select name="model">
                <?php foreach ( $models as $model ) : ?>
                  <option value="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>"><?php echo esc_html( $model['name'] ) ?></option>
                <?php endforeach; ?>
              </select>

            <?php endif; ?>

          </div>

        </div>
      </section>
    <?php break; endwhile; ?>

    <?php echo do_shortcode( '[simpay id="4535"]' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
