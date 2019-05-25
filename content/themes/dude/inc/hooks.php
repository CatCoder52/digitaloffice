<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-25 17:40:42
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-25 18:19:40
 *
 * @package dude2019
 */

// show archives
add_filter( 'air_helper_disable_views_tag', '__return_false' );
add_filter( 'air_helper_disable_views_category', '__return_false' );
add_filter( 'air_helper_disable_views_author', '__return_false' );

// pre_get_posts for some archives
add_action( 'pre_get_posts', 'dude_pre_get_posts' );
function dude_pre_get_posts( $query ) {
  if ( $query->is_main_query() && $query->is_post_type_archive( 'reference' ) ) {
    $query->set( 'posts_per_page', 100 );
  }
}
