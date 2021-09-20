<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-09-20 16:05:33
 *
 * @package dude
 */

$title = 'Merch';
// $content = '<p>Haluatko olla oman elämäsi Dude tai Dudette? Koetko vahvaa tunnesidettä  kulttiheimoon nimeltä Dude? Vai kaipaatko muuten vaan helevetin hyvännäköistä vaatetta, jota ei ihan joka Seppälästä löydy? Sama se meille, kunhan pidät niitä rinta rottingilla ja hyvällä asenteella.</p>

// <p class="details">Dude maksaa postarit, jos lähetellään Suomen sisällä. Toimitusajat riippuu ihan siitä miten me jaksetaan näitä pakkailla ja postitella. Nämä on sen verran tyylikästä, että palautella ei tartte - eikä otettais vastaankaan. Jos kysyttävää niin heitä viestiä vaikka <a href="#" class="open-chat">chatin avulla tästä</a> tai sähköpostilla <a href="mailto:moro@dude.fi">moro@dude.fi</a>.</p>';

// $content = '<p>Halt! Kiitos kaikille tilaajille. Tällä hetkellä Duden merch on valitettavasti myyty loppuun, mutta tarkkaile sivua, ehkä saamme uutta kamaa myyntiin. Joskus.</p>';

$content = '<p>Uudet mystisen tyylikkäät rievut ovat saapuneet. Koska luonto on best ja halusimme pukea teidät laatuun, valitsimme tuotetoimittajaksemme vastuullisen kotimaisen <a href="https://www.purewaste.com/fi">Pure Wasten</a>. Kuvittaja <a href="https://www.simoheikkinen.fi/">Simo Heikkinen</a> suunnitteli ideoidemme pohjalta upean printin, jota kelpaa kantaa.</p>';
?>

<section class="block block-hero-merch block-hero block-hero-reference is-centered has-dark-bg">
  <div class="container">

    <div class="content">
      <h1 id="content"><?php echo $title; ?></h1>

      <?php if ( ! empty( $content ) ) { ?>
        <div class="hero-description swup-transition-fade">
          <?php echo wpautop( $content ); // phpcs:ignore ?>
        </div>
      <?php } ?>
    </div>

  </div>
</section>
