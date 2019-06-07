<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-25 17:01:29
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-06-07 11:29:16
 *
 * @package dude2019
 */

$persons = get_sub_field( 'persons' );

if ( empty( $persons ) ) {
  return;
}

foreach ( $persons as $key => $person_id ) {
  $persons[ $key ] = array(
    'id'    => $person_id,
    'name'  => get_the_title( $person_id ),
    'title' => get_post_meta( $person_id, 'title', true ),
    'tel'   => get_post_meta( $person_id, 'tel', true ),
    'email' => get_post_meta( $person_id, 'email', true ),
  );
} ?>

<section class="block block-contact-list">
  <div class="container">
    <h2 class="block-title">Dudes of summer</h2>

    <div class="cols">
      <?php $x = 0; foreach ( $persons as $person ) : ?>
        <div class="col<?php if ( 0 === $x ) { echo ' col-go-to'; } ?>">
          <?php if ( 0 === $x ) : ?>
            <p class="name-pre" aria-describedby="your-go-to">Asikkuudet</p>
            <h3 id="your-go-to"><?php echo esc_html( $person['name'] ) ?></h3>
          <?php else : ?>
            <h3><?php echo esc_html( $person['name'] ) ?></h3>
          <?php endif; ?>

          <p class="job-title"><?php echo esc_html( $person['title'] ) ?></p>

          <p class="contact">
            <a href="mailto:<?php echo esc_attr( $person['email'] ) ?>"><?php echo esc_html( $person['email'] ) ?></a>
            <?php if ( 0 === $x ) : ?>
              <br/><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $person['tel'] ) ) ?>"><?php echo esc_html( $person['tel'] ) ?></a>
            <?php endif; ?>
          </p>
        </div>
      <?php $x++; endforeach; ?>
    </div>

  </div>
</section>
