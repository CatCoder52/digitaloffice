<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:05:23
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-10 16:14:06
 *
 * @package dude2019
 */


if ( is_front_page() ) {
  include get_theme_file_path( 'template-parts/hero-fp.php' );
} else if ( 10 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/hero-fp.php' );
} else {
  include get_theme_file_path( 'template-parts/hero-normal.php' );
}
