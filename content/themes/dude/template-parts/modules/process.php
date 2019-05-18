<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:42:04
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-18 17:42:53
 *
 * @package dude2019
 */

if ( 9 === get_the_id() ) {
  include get_theme_file_path( 'template-parts/modules/static/process-tech.php' );
}
