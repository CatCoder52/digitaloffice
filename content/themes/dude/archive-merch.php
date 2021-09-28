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

$products = [];

while ( have_posts() ) {
  the_post();

  $product = [
    'id'          => get_the_id(),
    'title'       => get_the_title(),
    'thumbnail'   => get_the_post_thumbnail_url( get_the_id(), 'large' ),
    'price'       => get_post_meta( get_the_id(), 'price', true ),
    'description' => get_post_meta( get_the_id(), 'description', true ),
    'coming_soon' => get_post_meta( get_the_id(), 'coming_soon', true ),
    'models'      => get_field( 'models' ),
    'in_stock'    => false,
  ];

  /**
   * MERCHTHINGS enable/disable
   *
   * To disable shop for all products:
   * 1) Comment the few lines marked below
   * 2) Deactivate Simple Pay plugin from wp-admin
   */
  if ( ! empty( $product['models'] ) ) {
    foreach ( $product['models'] as $model_key => $model ) {
      foreach ( $model['stock'] as $stock_key => $stock ) {

        // To disable; uncomment the following two lines
        // $product['models'][ $model_key ]['stock'][ $stock_key ]['stock_amount'] = null;
        // $stock['stock_amount'] = null;

        // Make the main product in stock if any model has size
        if ( ! empty( (int) $stock['stock_amount'] ) ) {
          $product['in_stock'] = true;
        }
      }
    }
  }

  $products[] = $product;
}

get_header();

include get_theme_file_path( '/svg/ouroboros.svg' ); ?>

<div class="content-area">
	<main id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero-merch.php' ); ?>

    <section class="block block-merch has-dark-bg">
      <div class="container">

        <div class="cols">
          <?php foreach ( $products as $product ) : ?>
            <div class="col col-product" data-price="<?php echo esc_html( $product['price'] ); ?>" data-product="<?php echo esc_html( $product['id'] ); ?>" data-product-name="<?php echo esc_html( $product['title'] ); ?>">

              <div class="product-image">

                <?php if ( $product['coming_soon'] ) : ?>
                  <h2 class="sold-out">Tulossa pian!</h2>

                <?php else : ?>

                  <?php if ( ! $product['in_stock'] ) : ?>
                    <h2 class="sold-out">Loppuunmyyty</h2>
                  <?php endif; ?>

                <?php endif; ?>

                <div class="image has-lazyload" aria-hidden="true">
                  <div class="lazy" data-bg="<?php echo esc_url( $product['thumbnail'] ); ?>" aria-hidden="true"></div>
                </div>
              </div>

              <div class="content">

                <header class="product-header">
                  <h2 class="product-title">
                    <?php echo esc_html( $product['title'] ); ?>
                  </h2>

                  <p class="product-price price">
                    <?php echo esc_html( $product['price'] ); ?> &euro;
                  </p>
                </header>

                <div class="product-description">
                  <?php echo wpautop( $product['´description'] ); ?>
                </div>

                  <?php if ( ! empty( $product['models'] ) && count( $product['models'] ) > 0 ) : ?>
                    <div class="models models-<?php echo count( $models ); ?>">
                      <?php $y = 0; foreach ( $product['models'] as $model ) : ?>
                        <button
                          <?php if ( 0 === $y ) {
                            echo ' class="active"';
                          } ?>
                          data-price="<?php echo esc_html( $product['price'] ); ?>"
                          data-image="<?php echo esc_url( wp_get_attachment_url( $model['image'] ) ); ?>"
                          data-model-slug="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>"
                          data-model-name="<?php echo esc_html( $model['name'] ); ?>"
                        >
                          <?php echo esc_html( $model['name'] ) ?>
                        </button>
                      <?php $y++; endforeach; ?>
                    </div>
                  <?php endif; ?>

                  <div class="choices">
                    <?php if ( ! empty( $product['models'] ) ) :
                      $x = 0; foreach ( $product['models'] as $model ) : ?>
                        <div
                          class="sizes <?php if ( 0 === $x ) { echo 'visible'; } ?>"
                          data-price="<?php echo esc_html( $product['price'] ); ?>"
                          data-model-slug="<?php echo esc_attr( sanitize_title( $model['name'] ) ) ?>"
                          data-model-name="<?php echo esc_html( $model['name'] ); ?>"
                        >

                          <?php foreach ( $model['stock'] as $stock ) : ?>
                            <button
                              data-size="<?php echo mb_strtolower( $stock['size'] ) ?>"
                              data-instock="<?php echo (int) $stock['stock_amount'] ?>"
                              <?php if ( empty( (int) $stock['stock_amount'] ) ) {
                                echo ' disabled="disabled"';
                              } ?>
                            >
                              <?php echo esc_html( $stock['size'] ) ?>
                            </button>
                          <?php endforeach; ?>
                        </div>
                      <?php $x++; endforeach; ?>
                    <?php endif; ?>

                    <div class="add-to-cart-wrapper add-to-cart">
                      <button class="add-to-cart disabled" disabled="disabled">
                        Lisää koriin
                      </button>
                    </div>
                  </div><!-- .choices -->

              <p class="size-guide">
                <?php if ( sanitize_title( $product['title'] ) === 'kangaskassi' ) : ?>
                  Pussin koko 41 x 45 cm. Pitkä kantokahva.
                <?php else : ?>
                  <a href="https://www.purewaste.com/men-s-t-shirt?childSku=TSMB-XXL54">Koko-ohje & valmistusmateriaali</a>
                <?php endif; ?>
              </p>
            </div><!-- .content -->
          </div><!-- .col -->

          <?php endforeach; ?>
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
