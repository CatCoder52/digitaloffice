<?php
/**
 * @Author:             Timi Wahalahti, Digitoimisto Dude Oy (https://dude.fi)
 * @Date:               2019-05-10 16:33:00
 * @Last Modified by: Niku Hietanen
 * @Last Modified time: 2021-01-13 11:11:03
 *
 * @package dude
 */
function dude_register_cpt_ama() {
  $labels = array(
    'name'               => _x( 'Kysymykset', 'post type general name', 'dude' ),
    'singular_name'      => _x( 'Kysymys', 'post type singular name', 'dude' ),
    'menu_name'          => _x( 'Kysymykset', 'admin menu', 'dude' ),
    'name_admin_bar'     => _x( 'Kysymys', 'add new on admin bar', 'dude' ),
    'add_new'            => _x( 'Lisää kysymys', 'example', 'dude' ),
    'add_new_item'       => __( 'Lisää uusi kysymys', 'dude' ),
    'new_item'           => __( 'Uusi kysymys', 'dude' ),
    'edit_item'          => __( 'Muokkaa kysymystä', 'dude' ),
    'view_item'          => __( 'Katsele kysymystä', 'dude' ),
    'all_items'          => __( 'Kaikki kysymykset', 'dude' ),
    'search_items'       => __( 'Etsi kysymyksiä', 'dude' ),
    'parent_item_colon'  => __( 'Tyypin isäntä:', 'dude' ),
    'not_found'          => __( 'Kysymyksiä ei löytynyt.', 'dude' ),
    'not_found_in_trash' => __( 'Kysymyksiä ei löytynyt roskista.', 'dude' ),
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
    'show_in_rest'       => true,
    'menu_icon'          => 'dashicons-editor-help',
    'supports'           => array(
      'title',
      'editor',
      'revisions',
    ),
  );

  register_post_type( 'ama', $args ); // phpcs:ignore
}

add_action( 'init', 'dude_register_cpt_ama' );
