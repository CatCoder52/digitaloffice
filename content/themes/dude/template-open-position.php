<?php
/**
 * TODO: Add here the name and meaning of this file, template-open-position.php
 *
 * TODO: Add description here for this filefile called template-open-position.
 *
 * @Author:		Roni Laukkarinen
 * @Date:   		2021-10-12 15:47:41
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2022-05-09 15:05:32
 *
 * @package dude
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */


/**
 * Template Name: Työpaikka
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dude
 */

the_post();

$expectations = get_field( 'expectations' );
$bonuses = get_field( 'bonuses' );
$filled_position = get_field( 'filled_position' );

get_header(); ?>

<div class="content-area<?php if ( true === $filled_position ) : ?> filled-position<?php endif; ?>">
  <main id="main" class="site-main">

    <?php include get_theme_file_path( 'template-parts/hero-jobs.php' ); ?>

    <section class="block block-open-position has-light-bg">
      <div class="container">
        <div class="open-positions-description">
          <div class="content">
            <?php the_content() ?>
          </div>

          <div class="img">
            <?php
              // Junior application
              if ( is_page( 10156 ) ) : ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-alasivu-juniori.jpg' ); ?>" alt="Roni ja Tuomas">
              <figcaption>Tärkeintä on, että töissä viihtyy.</figcaption>
            <?php elseif ( is_page( 9515 ) ) : ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-alasivu-backend.jpg' ); ?>" alt="Kari ja Timi">
              <figcaption>Ajatustenvaihtoa työkaverin kanssa.</figcaption>
            <?php else : ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/images/rekry-kristian.jpg' ); ?>" alt="Kristian sohvalla läppärin kanssa">
              <figcaption>Toimitusjohtaja Kristian odottaa työhakemuksia.</figcaption>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <?php
    // Do not show these if open application page
    if ( ! is_page( 10160 ) ) : ?>
    <section class="block block-expectations has-light-bg">

      <div class="container">
        <?php if ( ! empty( $expectations ) ) : ?>
          <div class="col">
            <h2>Mitä odotamme sinulta</h2>
            <ul>
              <?php foreach ( $expectations as $expectation ) : ?>
                <li><?php include get_theme_file_path( '/svg/checkmark-round.svg' ); ?>
                <?php echo $expectation['list_item']; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php if ( ! empty( $bonuses ) ) : ?>
          <div class="col">
            <h2>Plussaa näistä</h2>
            <ul>
              <?php foreach ( $bonuses as $bonus ) : ?>
                <li><?php include get_theme_file_path( '/svg/checkmark-round.svg' ); ?>
                <?php echo $bonus['list_item']; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>

    </section>

    <?php
    // Do not show if designer position
    if ( 10510 !== get_the_ID() && 10687 !== get_the_ID() ) : ?>
      <section class="block has-light-bg block-logos block-logos-techniques">
        <div class="container">

          <header class="block-head block-head-small">
            <h2 class="block-title">Näitä käytämme päivittäin</h2>
          </header>

          <ul class="logo-wall">
          <li>
              <a href="https://www.apple.com/fi/macbook-pro-16/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-apple.svg' ); ?></a>
            </li>

            <li>
              <a href="https://gulpjs.com/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-gulp.svg' ); ?></a>
            </li>

            <li>
              <a href="https://webpack.js.org/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-webpack.svg' ); ?></a>
            </li>

            <li>
              <a href="https://codex.wordpress.org/Main_Page" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-wordpress.svg' ); ?></a>
            </li>

            <li>
              <a href="https://vuejs.org/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-vuejs.svg' ); ?></a>
            </li>

            <li>
              <a href="https://redis.io/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-redis.svg' ); ?></a>
            </li>

            <li>
              <a href="https://www.php.net/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-php.svg' ); ?></a>
            </li>

            <li>
              <a href="https://www.javascript.com/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-js.svg' ); ?></a>
            </li>

            <li>
              <a href="https://developer.mozilla.org/en-US/docs/Web/HTML" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-html.svg' ); ?></a>
            </li>

            <li>
              <a href="https://github.com/digitoimistodude/awesome-frontend" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-css.svg' ); ?></a>
            </li>

            <li>
              <a href="https://babeljs.io/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-babel.svg' ); ?></a>
            </li>

            <li>
              <a href="https://sass-lang.com/documentation/syntax#scss" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-sass.svg' ); ?></a>
            </li>

            <li>
              <a href="https://www.w3schools.com/js/js_es6.asp" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-es6.svg' ); ?></a>
            </li>

            <li>
              <a href="https://github.com/digitoimistodude" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-github.svg' ); ?></a>
            </li>

            <!-- <li>
              <a href="https://github.com/ronilaukkarinen/vscode-settings" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-vscode.svg' ); ?></a>
            </li> -->

            <li>
              <a href="https://www.nginx.com/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-nginx.svg' ); ?></a>
            </li>

            <li>
              <a href="https://www.gnu.org/software/bash/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-bash.svg' ); ?></a>
            </li>

            <li>
              <a href="https://getcomposer.org/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-composer.svg' ); ?></a>
            </li>

            <li>
              <a href="https://www.npmjs.com/" class="no-external-link-indicator no-text-link"><?php include get_theme_file_path( '/svg/stack-npm.svg' ); ?></a>
            </li>
          </div>
      </section>
    <?php endif; ?>
    <?php endif; ?>

    <?php include get_theme_file_path( 'template-parts/content-modular.php' ); ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
