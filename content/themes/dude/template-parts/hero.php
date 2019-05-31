<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:05:23
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-05-31 09:56:44
 *
 * @package dude2019
 */

if ( is_front_page() ) {
  include get_theme_file_path( 'template-parts/hero-fp.php' );
} else if ( 9 === get_the_id() ) { // tech page
  $logos = array(
    'bauermedia',
    'barexplosive',
    'blackbruin',
    'byemmi',
    'crmservice',
    'elonen',
  );

  include get_theme_file_path( 'template-parts/hero-service.php' );
} else if ( 4485 === get_the_id() ) { // visual page
  $logos = array(
    'bauermedia',
    'barexplosive',
    'blackbruin',
    'byemmi',
    'crmservice',
    'elonen',
  );

  include get_theme_file_path( 'template-parts/hero-service.php' );
} else if ( 4487 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-contact.php' );
} else if ( 4491 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-jobs.php' );
} else if ( is_home() || is_category() || is_tag() || is_author() ) {
  include get_theme_file_path( 'template-parts/hero-blog.php' );
} else {
  include get_theme_file_path( 'template-parts/hero-normal.php' );
}
