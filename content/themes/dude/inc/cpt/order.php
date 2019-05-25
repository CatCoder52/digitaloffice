<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:33:00
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-25 18:49:20
 *
 * @package dude2019
 */

function dude_register_cpt_order() {
  $labels = array(
    'name'               => _x( 'Tilaukset', 'post type general name', 'dude' ),
    'singular_name'      => _x( 'Tilaus', 'post type singular name', 'dude' ),
    'menu_name'          => _x( 'Tilaukset', 'admin menu', 'dude' ),
    'name_admin_bar'     => _x( 'Tilaus', 'add new on admin bar', 'dude' ),
    'add_new'            => _x( 'Lisää tilaus', 'example', 'dude' ),
    'add_new_item'       => __( 'Lisää uusi tilaus', 'dude' ),
    'new_item'           => __( 'Uusi tilaus', 'dude' ),
    'edit_item'          => __( 'Muokkaa tilausta', 'dude' ),
    'view_item'          => __( 'Katsele tilausta', 'dude' ),
    'all_items'          => __( 'Kaikki tilaukset', 'dude' ),
    'search_items'       => __( 'Etsi tilauksia', 'dude' ),
    'parent_item_colon'  => __( 'Tyypin isäntä:', 'dude' ),
    'not_found'          => __( 'Tilauksia ei löytynyt.', 'dude' ),
    'not_found_in_trash' => __( 'Tilauksia ei löytynyt roskista.', 'dude' )
  );

  $args = array(
    'labels'             => $labels,
    'public'             => false,
    'publicly_queryable' => false,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => false,
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-clipboard',
    'capabilities'       => array(
      'create_posts' => false,
    ),
    'supports'           => array(
      'title',
      'revisions'
    )
  );

  register_post_type( 'order', $args );
}

add_action( 'init', 'dude_register_cpt_order' );
