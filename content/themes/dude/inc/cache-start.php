<?php
/**
 * Cache-start part.
 *
 * Description for template.
 *
 * @Author:       Roni Laukkarinen, Digitoimisto Dude Oy (https://www.dude.fi)
 * @Date:         2019-10-04 14:17:58
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2019-10-04 15:04:14
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

// Cache settings
$hours = 72;
$cachetime = 3600 * $hours;
if ( file_exists( $cachefile ) && time() - $cachetime < filemtime( $cachefile ) ) {
  echo '<!-- Amazing hand crafted super cache by Dude, generated ' . date( 'H:i', filemtime( $cachefile ) ) . ' -->';

  // Without HTML minification:
  include( $cachefile );
  exit;
}
ob_start();
