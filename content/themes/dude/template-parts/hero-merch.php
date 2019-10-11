<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-10-11 11:16:27
 *
 * @package dude2019
 */

// Featured image
$bg_image_tiny_default = get_template_directory_uri() . '/images/merch-tiny.jpg';
$bg_image_mobile = $bg_image_tiny_default;
$bg_image_tiny = $bg_image_tiny_default;
$bg_image = get_template_directory_uri() . '/images/merch.jpg';

$title = 'Merch';
$content = '<p>Haluatko olla oman elämäsi Dude tai Dudette? Koetko vahvaa tunnesidettä  kulttiheimoon nimeltä Dude? Vai kaipaatko muuten vaan helevetin hyvännäköistä vaatetta, jota ei ihan joka Seppälästä löydy? Sama se meille, kunhan pidät niitä rinta rottingilla ja hyvällä asenteella.</p>

<p class="details">Dude maksaa postarit, jos lähetellään Suomen sisällä. Toimitusajat riippuu ihan siitä miten me jaksetaan näitä pakkailla ja postitella. Nämä on niin hyvää tavaraa, että palautella ei tartte - eikä otettais vastaankaan. Jos kysyttävää niin heitä viestiä vaikka <a href="#" class="open-chat">chatin avulla tästä</a> tai sähköpostilla <a href="mailto:moro@dude.fi">moro@dude.fi</a>.</p>';
?>

<section class="block block-hero-merch block-hero block-hero-side-columns block-hero-enable-transition">
  <div class="container opacity-on-load-instant">

    <div class="content">
      <div class="side-content-box">
        <h1><?php echo $title; ?></h1>

        <div class="hero-description">
          <?php if ( ! empty( $content ) ) {
            echo $content;
          }
          ?>
        </div>

      </div>
    </div>

    <?php if ( $bg_image ) { ?>
    <div class="featured-image featured-image-side">
      <div class="shade"></div>
        <div class="background-image preview lazyload" style="background-image: url('<?php echo $bg_image_tiny; ?>');" data-src="<?php echo esc_url( $bg_image ); ?>" data-src-mobile="<?php echo esc_url( $bg_image_mobile[0] ); ?>"></div>
        <div class="background-image full-image"<?php if ( preg_match( '/Windows Phone|Lumia|iPad|Safari/i', $_SERVER['HTTP_USER_AGENT'] ) ) : ?> style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"<?php endif; ?>></div>
        <noscript><div class="background-image full-image" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');"></div></noscript>
    </div>
    <?php } ?>

  </div>
</section>
