<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-18 17:23:46
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-12 17:43:36
 *
 * @package dude
 */

if ( 9 === get_the_id() ) { // tech page
  include get_theme_file_path( 'template-parts/modules/static/content-side-switch-tech.php' );
}
