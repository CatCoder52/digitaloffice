<?php
/**
 * Template Name: AMA
 *
 * @package dude
 */

the_post();

$form_id = get_field( 'form_id' );
$form_title = get_field( 'form_title' );
$form_description = get_field( 'form_description' );
$hero_content = get_field( 'hero_content' );

$drafts = dude_get_ama_drafts();
$questions = [];
$questions_query = new WP_Query( [
  'post_type'       => 'ama',
  'post_status'     => 'publish',
  'posts_per_page'  => 1,
  'order'           => 'ASC',
] );

if ( $questions_query->have_posts() ) {
  while ( $questions_query->have_posts() ) {
    $questions_query->the_post();
    $questions[] = dude_get_ama_entry( get_the_id() );
  }
} wp_reset_postdata();

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php
  wp_head();
  do_action( 'dude_ama_enqueue_scripts' );
  // Disable default scripts
  wp_dequeue_script( 'scripts' );
  ?>
  <script>
    amaDrafts = <?php echo esc_attr( $drafts ); ?>;
  </script>
</head>

<body class="template-ama">

  <div id="page" class="site">
   <div class="site-content">

      <main id="main" class="site-main">

        <header class="ama-header">
          <div class="container">
            <div class="ama-header-text">
              <?php if ( ! empty( $form_title ) ) : ?>
                <h1 id="content"><?php echo $form_title; ?></h1>
              <?php endif; ?>

              <?php if ( ! empty( $hero_content ) ) : ?>
                <p class="ama-header-description"><?php echo $hero_content; ?></p>
              <?php endif; ?>
            </div>

            <div class="ama-header-logo">
              <?php include get_theme_file_path( '/svg/ama-logo.svg' ); ?>
            </div>
          </div>
        </header>

        <div class="form">
          <div class="container">
            <?php
              $id_or_title = $form_id;
              $display_title = false;
              $display_description = false;
              $display_inactive = false;
              $field_values = null;
              $ajax = false;
              $tabindex = 1;
              $echo = true;

              gravity_form( $id_or_title, $display_title, $display_description, $display_inactive, $field_values, $ajax, $tabindex, $echo );
            ?>
          </div>
        </div>

        <?php if ( ! empty( $form_description ) ) : ?>
          <div class="container">
            <?php echo wpautop( $form_description ); // phpcs:ignore ?>
          </div>
        <?php endif; ?>
        <div id="dude-ama" class="container ama">
          <div class="ama-drafts hide-until-vue-loaded">
            <p v-if="drafts !== 0">Vastaamatta <span class="drafts-count hide-until-vue-loaded">{{drafts}}</span> kysymystä. Piä maitolasista kiinni ja odota uusia vastauksia!</p>
            <p v-else class="hide-until-vue-loaded">Oltiin nohevia ja vastattiin kaikkiin kysymyksiin!</p>
          </div>
          <div class="checking-for-updates" v-if="loadingPosts">
            TODO: Tähän joku latausanimaatio
          </div>
          <div class="ama-items post-loaded" >
            <div class="ama-item" :class="post.state" v-for="post in posts" v-html="post.meta.rendered_listing">
            </div>
          </div>
          <?php if ( ! empty( $questions ) ) : ?>
            <div class="ama-items pre-loaded">
              <?php foreach ( $questions as $question ) : ?>
              <div class="ama-item">
                <?php echo $question; ?>
              </div>
              <?php endforeach ?>
            </div>
          <?php endif; ?>
        </div>

      </main><!-- #main -->
    </div><!-- #primary -->

  </div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
