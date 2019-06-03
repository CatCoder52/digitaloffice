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

    <section class="block block-merch">
      <div class="container">

        <?php while( have_posts() ) : the_post(); ?>
          <div class="col col-product" data-product="<?php get_the_id() ?>">

            <div class="col col-image" style="background-image:url('<?php echo the_post_thumbnail_url( 'large' ); ?>')"></div>
            <style>.col-image { width: 750px; height: 500px; background-size: cover;  }</style>

            <div class="col col-content">

              <h2><?php the_title() ?></h2>
              <p class="price"><?php echo get_post_meta( get_the_id(), 'price', true ) ?>&euro;</p>

              <?php echo wpautop( get_post_meta( get_the_id(), 'description', true ) ) ?>

              <?php $models = get_field( 'models' );
              if ( ! empty( $models ) ) : ?>
                <div class="models">
                  <?php if ( count( $models ) > 1 ) :
                    foreach ( $models as $model ) : ?>
                      <button data-model="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>"><?php echo esc_html( $model['name'] ) ?></button>
                    <?php endforeach;
                  endif; ?>
                </div>

                <?php $x = 0; foreach ( $models as $model ) : ?>
                  <div class="sizes<?php if ( $x === 0 ) { echo ' visible'; } ?>" data-model="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>">
                    <?php foreach ( $models[0]['stock'] as $stock ) : ?>
                      <button data-size="<?php echo mb_strtolower( $stock['size'] ) ?>" data-instock="<?php echo (int) $stock['stock_amount'] ?>"<?php if ( empty( (int) $stock['stock_amount'] ) ) { echo ' style="disabled" disabled'; } ?>><?php echo esc_html( $stock['size'] ) ?></button>
                    <?php endforeach; ?>
                  </div>
                <?php $x++; endforeach; ?>
              <?php endif; ?>

              <div class="add-to-cart"><button class="add-to-cart">Koriin +</button></div>

            </div>

          </div>
        <?php endwhile; ?>

      </div>
    </section>

    <?php echo do_shortcode( '[simpay id="4535"]' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
