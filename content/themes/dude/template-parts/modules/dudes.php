<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 19:18:00
 * @Last Modified by:   sippis
 * @Last Modified time: 2021-07-19 14:59:26
 *
 * @package dude
 */

$current_dude = null;
if ( is_singular( 'person' ) ) {
  $current_dude = get_the_id();
}

$query = new WP_Query( array(
  'post_type'               => 'person',
  'post_status'             => 'publish',
  'order'                   => 'ASC',
  'orderby'                 => 'menu_order',
  'posts_per_page'          => 50,
  'no_found_rows'           => true,
  'cache_results'           => true,
  'update_post_term_cache'  => false,
  'update_post_meta_cache'  => false,
) );

$show_tel_for = [
  '4469'  => true, // Kristian
  '4468'  => false, // Juha
];

if ( ! $query->have_posts() ) {
  return;
} ?>

<section class="block has-light-bg block-dudes">

  <h2 class="screen-reader-text">Henkilöt</h2>

  <div class="container">

    <div class="cols">
      <?php while ( $query->have_posts() ) : $query->the_post();
        if ( get_the_id() === $current_dude ) {
          continue;
        }

        $image = get_post_meta( get_the_id(), 'image_square', true );
        $title = get_post_meta( get_the_id(), 'title', true );
        $tel = get_post_meta( get_the_id(), 'tel', true );
        $email = get_post_meta( get_the_id(), 'email', true );
        $social = get_field( 'social_media' );

        if ( empty( $image ) ) {
          continue;
        } ?>

        <div class="col">
          <div class="image">
            <a href="<?php the_permalink(); ?>" class="global-link"><span class="screen-reader-text">Lue lisää tyypistä</span></a>
            <?php vanilla_lazyload_div( $image ); ?>
          </div>

          <div class="content" data-id="<?php echo get_the_id(); ?>">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if ( ! empty( $title ) ) : ?>
              <p class="person-title"><?php echo esc_html( $title ); ?><br />
              <a class="no-text-link" href="mailto:<?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a><br />
              <?php if ( array_key_exists( get_the_id(), $show_tel_for ) && $show_tel_for[ get_the_id() ] ) : ?><a class="no-text-link" href="tel:<?php echo esc_attr( str_replace( ' ', '', $tel ) ) ?>"><?php echo esc_html( $tel ); ?></a><?php endif; ?>
              </p>
            <?php endif; ?>

            <?php if ( ! empty( $social ) ) : ?>
              <ul class="social">
                <?php foreach ( $social as $item ) :
                  $icon = sanitize_title( $item['name'] ); ?>
                  <li class="<?php echo $icon; ?>"><a class="contact-detail" href="<?php echo esc_url( $item['value'] ) ?>"><?php include get_theme_file_path( "svg/social/{$icon}.svg" ) ?><span class="screen-reader-text"><?php echo esc_html( $item['name'] ) ?></span></a></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <p class="arrow-link-wrapper"><span href="<?php the_permalink(); ?>" class="arrow-link"><span class="screen-reader-text">Lue lisää tyypistä</span><span class="arrow"></span></span></p>
          </div>

        </div>

      <?php endwhile; wp_reset_postdata(); ?>
    </div>

  </div>
</section>
