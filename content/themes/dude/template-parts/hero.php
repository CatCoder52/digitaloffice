<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:05:23
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 16:44:03
 *
 * @package dude2019
 */


if ( is_front_page() ) {
  include get_theme_file_path( 'template-parts/hero-fp.php' );
} else if ( 9 === get_the_id() ) {
  $logos = array(
    'bauermedia',
    'barexplosive',
    'blackbruin',
    'byemmi',
    'crmservice',
    'elonen',
  );

  include get_theme_file_path( 'template-parts/hero-service.php' );
} else {
  include get_theme_file_path( 'template-parts/hero-normal.php' );
}
