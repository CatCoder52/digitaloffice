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
            <div class="ama-header-logo" aria-hidden="true">
              <?php include get_theme_file_path( '/svg/ama-logo.svg' ); ?>
            </div>

            <div class="ama-header-text">
              <?php if ( ! empty( $form_title ) ) : ?>
                <h1 id="content"><?php echo $form_title; ?></h1>
              <?php endif; ?>

              <?php if ( ! empty( $hero_content ) ) : ?>
                <p class="ama-header-description"><?php echo $hero_content; ?></p>
              <?php endif; ?>
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
            <p class="disclaimer">Emme julkaise asiattomia kysymyksiä. Emme kerää tietoja käyttäjistä.</p>
          </div>
        </div>

        <?php if ( ! empty( $form_description ) ) : ?>
          <div class="container">
            <div class="infobox">
              <button class="info button-toggle"><svg version="1.1" class="has-solid " viewBox="0 0 36 36" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" role="img" width="128" height="128" fill="currentColor"><circle class="clr-i-outline clr-i-outline-path-1" cx="17.97" cy="10.45" r="1.4"/><path class="clr-i-outline clr-i-outline-path-2" d="M21,25H19V14.1H16a1,1,0,0,0,0,2h1V25H15a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2Z"/><path class="clr-i-outline clr-i-outline-path-3" d="M18,34A16,16,0,1,1,34,18,16,16,0,0,1,18,34ZM18,4A14,14,0,1,0,32,18,14,14,0,0,0,18,4Z"/><path class="clr-i-solid clr-i-solid-path-1" d="M18,2.1a16,16,0,1,0,16,16A16,16,0,0,0,18,2.1Zm-.1,5.28a2,2,0,1,1-2,2A2,2,0,0,1,17.9,7.38Zm3.6,21.25h-7a1.4,1.4,0,1,1,0-2.8h2.1v-9.2H15a1.4,1.4,0,1,1,0-2.8h4.4v12h2.1a1.4,1.4,0,1,1,0,2.8Z" style="display:none"/></svg>Mikä AmA?</button>
              <div class="info-content">
                <?php echo wpautop( $form_description ); // phpcs:ignore ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div id="dude-ama" class="container ama">

          <div class="ama-drafts hide-until-vue-loaded">
            <p v-if="drafts !== 0">Vastaamatta <span class="drafts-count hide-until-vue-loaded">{{drafts}}</span> kysymystä. Piä maitolasista kiinni ja odota uusia vastauksia!</p>
            <p v-else class="hide-until-vue-loaded">Oltiin nohevia ja vastattiin kaikkiin kysymyksiin!</p>
          </div>
          <div class="ama-updating hide-until-vue-loaded">
            <label for="update-rate">Automaattinen päivitys</label>
            <select name="update-rate" id="update-rate" v-model="updateRate" v-on:input="changeUpdateRate($event.target.value)">
              <option value="10000">10 sekuntia</option>
              <option selected value="20000">20 sekuntia</option>
              <option value="30000">30 sekuntia</option>
              <option value="60000">1 minuutti</option>
              <option value="0">Pois käytöstä</option>
            </select>
            <button type="button" v-if="parseInt(updateRate, 10) === 0" v-on:click="getPosts" :disabled="loadingPosts">Hae uudet vastaukset</button>
          </div>

          <div class="checking-for-updates hide-until-vue-loaded" v-if="loadingPosts">
            <div class="spinner">
            <svg version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">
              <circle cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke="#7effe1" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"/>
                <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"/>
                <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"/>
              </circle>
              </svg>
            </div>
          </div>

          <div class="ama-items post-loaded">
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

<script>
document.querySelector('.button-toggle').addEventListener('click', function(e) {
  [].map.call(document.querySelectorAll('.info-content'), function(el) {
    el.classList.toggle('toggled');
  });
});
</script>

</body>
</html>
