<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:30:53
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 13:39:09
 *
 * @package dude
 */
function dude_register_cpt_reference() {
  $labels = array(
    'name'               => _x( 'Työt', 'post type general name', 'dude' ),
    'singular_name'      => _x( 'Työ', 'post type singular name', 'dude' ),
    'menu_name'          => _x( 'Työt', 'admin menu', 'dude' ),
    'name_admin_bar'     => _x( 'Työ', 'add new on admin bar', 'dude' ),
    'add_new'            => _x( 'Lisää uusi', 'example', 'dude' ),
    'add_new_item'       => __( 'Lisää uusi työ', 'dude' ),
    'new_item'           => __( 'Uusi työ', 'dude' ),
    'edit_item'          => __( 'Muokkaa työtä', 'dude' ),
    'view_item'          => __( 'Katsele työtä', 'dude' ),
    'all_items'          => __( 'Kaikki työt', 'dude' ),
    'search_items'       => __( 'Etsi töitä', 'dude' ),
    'parent_item_colon'  => __( 'Työn isäntä:', 'dude' ),
    'not_found'          => __( 'Töitä ei löytynyt.', 'dude' ),
    'not_found_in_trash' => __( 'Töitä ei löytynyt roskista.', 'dude' ),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-portfolio',
    'show_in_rest'       => true,
    'supports'           => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt',
      'revisions',
      'page-attributes',
    ),
  );

  register_post_type( 'reference', $args );
}

add_action( 'init', 'dude_register_cpt_reference' );
