<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-19 14:24:20
 *
 * @package dude
 */

$title = 'Merch';
$content = '<p>Haluatko olla oman elämäsi Dude tai Dudette? Koetko vahvaa tunnesidettä  kulttiheimoon nimeltä Dude? Vai kaipaatko muuten vaan helevetin hyvännäköistä vaatetta, jota ei ihan joka Seppälästä löydy? Sama se meille, kunhan pidät niitä rinta rottingilla ja hyvällä asenteella.</p>

<p class="details">Dude maksaa postarit, jos lähetellään Suomen sisällä. Toimitusajat riippuu ihan siitä miten me jaksetaan näitä pakkailla ja postitella. Nämä on sen verran tyylikästä, että palautella ei tartte - eikä otettais vastaankaan. Jos kysyttävää niin heitä viestiä vaikka <a href="#" class="open-chat no-text-link">chatin avulla tästä</a> tai sähköpostilla <a href="mailto:moro@dude.fi" class="no-text-link">moro@dude.fi</a>.</p>';
?>

<section class="block block-hero-merch block-hero block-hero-reference is-centered">
  <div class="container">

    <div class="content">
      <h1><?php echo $title; ?></h1>

      <div class="hero-description">
        <?php if ( ! empty( $content ) ) {
          echo $content;
        }
        ?>
      </div>
    </div>

  </div>
</section>
