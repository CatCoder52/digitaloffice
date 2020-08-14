<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:33:00
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2020-07-23 13:38:50
 *
 * @package dude
 */
function dude_register_cpt_person() {
  $labels = array(
    'name'               => _x( 'Tyypit', 'post type general name', 'dude' ),
    'singular_name'      => _x( 'Tyyppi', 'post type singular name', 'dude' ),
    'menu_name'          => _x( 'Tyypit', 'admin menu', 'dude' ),
    'name_admin_bar'     => _x( 'Tyyppi', 'add new on admin bar', 'dude' ),
    'add_new'            => _x( 'Lisää tyyppi', 'example', 'dude' ),
    'add_new_item'       => __( 'Lisää uusi tyyppi', 'dude' ),
    'new_item'           => __( 'Uusi tyyppi', 'dude' ),
    'edit_item'          => __( 'Muokkaa tyyppiä', 'dude' ),
    'view_item'          => __( 'Katsele tyyppiä', 'dude' ),
    'all_items'          => __( 'Kaikki tyypit', 'dude' ),
    'search_items'       => __( 'Etsi tyyppejä', 'dude' ),
    'parent_item_colon'  => __( 'Tyypin isäntä:', 'dude' ),
    'not_found'          => __( 'Tyyppejä ei löytynyt.', 'dude' ),
    'not_found_in_trash' => __( 'Tyyppejä ei löytynyt roskista.', 'dude' ),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => __( 'dudet', 'dude' ) ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-nametag',
    'show_in_rest'       => true,
    'supports'           => array(
      'title',
      'editor',
      'thumbnail',
      'page-attributes',
      'revisions',
    ),
  );

  register_post_type( 'person', $args );
}

add_action( 'init', 'dude_register_cpt_person' );
