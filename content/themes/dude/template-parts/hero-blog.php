<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:14:20
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-02-12 17:43:38
 *
 * @package dude
 */

$title = get_the_archive_title();

if ( is_home() ) {
  $title = 'Blogi';
}

?>
