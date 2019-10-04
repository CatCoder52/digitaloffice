<?php
/**
 * Cache-end part.
 *
 * Description for template.
 *
 * @Author:       Roni Laukkarinen, Digitoimisto Dude Oy (https://www.dude.fi)
 * @Date:         2019-10-04 14:17:58
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-10-04 15:04:24
 *
 * @package dude
 */

// Define content path
if ( getenv( 'WP_ENV' ) === 'development' ) :
  $content_path = '/var/www/dude/content';
else :
  $content_path = '/var/www/dude.fi/deploy/releases/20170125090439/content';
endif;

// Define cache location
$cachefile = $content_path . '/themes/dude/cache/' . sanitize_title( get_permalink() ) . '.html';

// Open cached file
$fp = fopen( $cachefile, 'w' );

// Without HTML minification:
fwrite( $fp, ob_get_contents() );

fclose( $fp );
ob_end_flush();
