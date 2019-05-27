<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-27 22:34:46
 *
 * @package dude2019
 */

$title = get_the_archive_title();

if ( is_home() ) {
  $title = 'Blogi';
}

?>

<section class="block block-hero block-hero-normal block-hero-enable-transition">
  <div class="container">

    <div class="content">
      <?php if ( is_category() && ! is_tag() && ! is_author() ) : ?>
        <p class="blog-title-pre" aria-describedby="blog-title">Blogi</p>
        <h1 id="blog-title"><?php echo $title ?></h1>
      <?php else : ?>
        <h1><?php echo $title ?></h1>
      <?php endif; ?>

      <p>Kirjoitusten kautta löydät tiesi Duden sielunmaisemaan ja arkeen. Näiden avulla ehkä ymmärrät meitä paremmin.</p>
    </div>

  </div>
</section>
