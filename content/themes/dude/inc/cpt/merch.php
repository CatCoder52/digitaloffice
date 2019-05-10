<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:33:00
 * @Last Modified by:   Timi Wahalahti
 * @Last Modified time: 2019-05-10 16:40:19
 *
 * @package dude2019
 */

function dude_register_cpt_merch() {
  $labels = array(
    'name'               => _x( 'Merchit', 'post type general name', 'dude' ),
    'singular_name'      => _x( 'Merch', 'post type singular name', 'dude' ),
    'menu_name'          => _x( 'Merchit', 'admin menu', 'dude' ),
    'name_admin_bar'     => _x( 'Merch', 'add new on admin bar', 'dude' ),
    'add_new'            => _x( 'Lisää merch', 'example', 'dude' ),
    'add_new_item'       => __( 'Lisää uusi merch', 'dude' ),
    'new_item'           => __( 'Uusi merch', 'dude' ),
    'edit_item'          => __( 'Muokkaa merchä', 'dude' ),
    'view_item'          => __( 'Katsele merchä', 'dude' ),
    'all_items'          => __( 'Kaikki merchit', 'dude' ),
    'search_items'       => __( 'Etsi merchiä', 'dude' ),
    'parent_item_colon'  => __( 'Tyypin isäntä:', 'dude' ),
    'not_found'          => __( 'Merchejä ei löytynyt.', 'dude' ),
    'not_found_in_trash' => __( 'Merchejä ei löytynyt roskista.', 'dude' )
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
    'menu_icon'          => 'dashicons-palmtree',
    'supports'           => array(
      'title',
      'editor',
      'thumbnail',
      'page-attributes'
    )
  );

  register_post_type( 'merch', $args );
}

add_action( 'init', 'dude_register_cpt_merch' );
