<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:05:23
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-10-04 01:44:13
 *
 * @package dude
 */

if ( is_front_page() ) {
  include get_theme_file_path( 'template-parts/hero-fp.php' );
} else if ( 9 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-service.php' );
} else if ( 4485 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-service.php' );
} else if ( 4449 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-company.php' );
} else if ( 4491 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-jobs.php' );
} else if ( is_home() || is_category() || is_tag() || is_author() ) {
  include get_theme_file_path( 'template-parts/hero-blog.php' );
} else if ( is_singular( 'post' ) ) {
  include get_theme_file_path( 'template-parts/hero-single.php' );
} else if ( 4737 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-contact-thanks.php' );
} else if ( 5973 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-merch-thanks.php' );
} else if ( 6357 === get_the_id() ) { // phpcs:ignore
// include get_theme_file_path( 'template-parts/hero-start-project.php' );
} else if ( 5975 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-merch-fail.php' );
} else if ( is_post_type_archive( 'reference' ) ) {
  include get_theme_file_path( 'template-parts/hero-reference-archive.php' );
} else {
  include get_theme_file_path( 'template-parts/hero-normal.php' );
}
