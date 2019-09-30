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

    <?php include get_theme_file_path( 'template-parts/hero-merch.php' ); ?>

    <section class="block block-merch">
      <div class="container">

        <div class="cols">
        <?php while ( have_posts() ) : the_post(); ?>
          <div class="col col-product" data-price="<?php echo get_post_meta( get_the_id(), 'price', true ); ?>" data-product="<?php echo get_the_id() ?>" data-product-name="<?php echo get_the_title() ?>">

            <div class="product-image">
              <h2 class="sold-out">Loppuunmyyty</h2>

              <div class="image has-lazyload">
                <div class="background-image preview lazyload" style="background-image: url('<?php echo the_post_thumbnail_url( 'tiny-preload-thumbnail' ); ?>');" data-src="<?php echo the_post_thumbnail_url( 'large' ); ?>" data-src-mobile="<?php echo the_post_thumbnail_url( 'large' ); ?>"></div>
                <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo the_post_thumbnail_url( 'large' ); ?>');"<?php endif; ?>></div>
                <noscript><div class="background-image full-image" style="background-image: url('<?php echo the_post_thumbnail_url( 'large' ); ?>');"></div></noscript>
              </div>
            </div>

            <div class="content">

              <header class="product-header">
                <h2><?php the_title() ?></h2>
                <p class="price"><?php echo get_post_meta( get_the_id(), 'price', true ) ?> &euro;</p>
              </header>

              <?php echo wpautop( get_post_meta( get_the_id(), 'description', true ) ) ?>

                <?php $models = get_field( 'models' );
                if ( ! empty( $models ) ) :
                  if ( count( $models ) > 0 ) : ?>
                    <div class="models models-<?php echo count( $models ); ?>">
                      <?php $y = 0; foreach ( $models as $model ) : ?>
                      <button<?php if ( 0 === $y ) { echo ' class="active"'; } ?> data-price="<?php echo get_post_meta( get_the_id(), 'price', true ); ?>" data-image="<?php echo wp_get_attachment_url( $model['image'] ); ?>" data-model-slug="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>" data-model-name="<?php echo $model['name']; ?>"><?php echo esc_html( $model['name'] ) ?></button>
                      <?php $y++; endforeach; ?>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>

              <div class="choices">
                <?php if ( ! empty( $models ) ) : $x = 0; ?>
                  <?php foreach ( $models as $model ) : ?>
                  <div class="sizes<?php if ( 0 === $x ) { echo ' visible'; } ?>" data-price="<?php echo get_post_meta( get_the_id(), 'price', true ); ?>" data-model-slug="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>" data-model-name="<?php echo $model['name']; ?>">

                    <?php foreach ( $models[0]['stock'] as $stock ) : ?>
                      <button data-size="<?php echo mb_strtolower( $stock['size'] ) ?>" data-instock="<?php echo (int) $stock['stock_amount'] ?>"<?php if ( empty( (int) $stock['stock_amount'] ) ) { echo ' style="disabled" disabled="disabled"'; } ?>><?php echo esc_html( $stock['size'] ) ?></button>
                    <?php endforeach; ?>
                  </div>
                <?php $x++; endforeach; ?>
              <?php endif; ?>

              <div class="add-to-cart"><button class="add-to-cart disabled" disabled="disabled">Koriin +</button></div>

            </div><!-- .choices -->
          </div><!-- .content -->
        </div><!-- .col -->

        <?php endwhile; ?>
        </div><!-- .cols -->

      </div><!-- .container -->
    </section>

	</main><!-- #main -->
</div><!-- #primary -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js" integrity="sha256-7/yoZS3548fXSRXqc/xYzjsmuW3sFKzuvOCHd06Pmps=" crossorigin="anonymous"></script>

<?php get_footer();
