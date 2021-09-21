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

// Notes
// To disable shop:
// 1) add this right after <div class="product-image">:
// <h2 class="sold-out">Loppuunmyyty</h2>
// 2) Add disabled attritubes and class to button:
// <button class="add-to-cart disabled" disabled="disabled">
get_header();
include get_theme_file_path( '/svg/ouroboros.svg' ); ?>

<div class="content-area">
	<main id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero-merch.php' ); ?>

    <section class="block block-merch has-dark-bg">
      <div class="container">

        <div class="cols">
        <?php while ( have_posts() ) : the_post(); ?>
          <div class="col col-product" data-price="<?php echo get_post_meta( get_the_id(), 'price', true ); ?>" data-product="<?php echo get_the_id() ?>" data-product-name="<?php echo get_the_title() ?>">

            <div class="product-image">
              <h2 class="sold-out">Loppuunmyyty</h2>
              <div class="image has-lazyload" aria-hidden="true">
                <div class="lazy" data-bg="<?php echo the_post_thumbnail_url( 'large' ); ?>" aria-hidden="true"></div>
              </div>
            </div>

            <div class="content">

              <header class="product-header">
                <h2 class="product-title"><?php the_title() ?></h2>
                <p class="product-price price"><?php echo get_post_meta( get_the_id(), 'price', true ) ?> &euro;</p>
              </header>

              <div class="product-description">
                <?php echo wpautop( get_post_meta( get_the_id(), 'description', true ) ) ?>
              </div>

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
                      <button data-size="<?php echo mb_strtolower( $stock['size'] ) ?>" data-instock="<?php echo (int) $stock['stock_amount'] ?>"<?php if ( empty( (int) $stock['stock_amount'] ) ) { echo ' disabled="disabled"'; } ?>><?php echo esc_html( $stock['size'] ) ?></button>
                    <?php endforeach; ?>
                  </div>
                <?php $x++; endforeach; ?>
              <?php endif; ?>

              <div class="add-to-cart-wrapper add-to-cart">
                <button class="add-to-cart">Lisää koriin</button>
              </div>

            </div><!-- .choices -->

            <p class="size-guide">
              <?php if ( sanitize_title( get_the_title() ) === 'kangaskassi' ) : ?>
                Pussin koko 41 x 45 cm. Pitkä kantokahva.
              <?php else : ?>
                <a href="https://www.purewaste.com/men-s-t-shirt?childSku=TSMB-XXL54">Koko-ohje & valmistusmateriaali</a>
              <?php endif; ?>
            </p>
          </div><!-- .content -->
        </div><!-- .col -->

        <?php endwhile; ?>
        </div><!-- .cols -->

        <div class="about-shipping">
          <div class="col col-title">
            <h2>Huom</h2>
          </div>

          <div class="col col-text">
            <p>Dude maksaa postikulut, jos lähetellään Suomen sisällä. Toimitusajat riippuu ihan siitä miten me ehditään näitä pakkailla ja postitella. Nämä ovat sen verran tyylikästä, että palautella ei tartte. Eikä tuotteilla ole myöskään palautusoikeutta. Jos epäröit, kysy ensin. Ota yhteyttä <button class="chat open-chat open-chat-contact" aria-label="Avaa chat" tabindex="0">chatin</button> avulla tai sähköpostilla <a href="mailto:moro@dude.fi">moro@dude.fi</a>.</p>

            <p>Muistahan pestä tuotteet nurinpäin 40 asteessa, niin printti ei kulahda ja materiaali ei kutistu.</p>
          </div>
        </div>

      </div><!-- .container -->
    </section>

    <section class="merch-gallery">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-1.jpg' ); ?>" alt="Valkoinen pellavapaita, jossa punainen Ouroboros-käärmekuvitus ja DUDE-teksti">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-2.jpg' ); ?>" alt="Musta huppari, jossa valkoinen Ouroboros-käärmekuvitus ja DUDE-teksti">
      <img class="bigger" src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-5.jpg' ); ?>" alt="Musta huppari, jossa valkoinen Ouroboros-käärmekuvitus ja DUDE-teksti">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-3.jpg' ); ?>" alt="Nainen seisoo edustalla kainalossaan DUDE-kangaskassi, jossa musta Ouroboros-kuvitus ja DUDE-logo, taustalla sumeana kaksi miestä nojaamassa seinään">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dudekult-merch-vaatteet-4.jpg' ); ?>" alt="Musta huppari, jossa valkoinen Ouroboros-käärmekuvitus ja DUDE-teksti">
    </section>

	</main><!-- #main -->
</div><!-- #primary -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js" integrity="sha256-7/yoZS3548fXSRXqc/xYzjsmuW3sFKzuvOCHd06Pmps=" crossorigin="anonymous"></script>

<?php get_footer();
