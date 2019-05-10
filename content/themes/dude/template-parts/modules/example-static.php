<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:19:09
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-10 16:20:01
 *
 * @package dude2019
 */

if ( is_front_page() ) {
  include get_theme_file_path( 'template-parts/modules/static/example-static-fp.php' );
} else {
  include get_theme_file_path( 'template-parts/modules/static/example-static.php' );
}
