<?php
/**
 * General hooks.
 *
 * @package dude
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by: Roni Laukkarinen
 * @Last Modified time: 2020-07-03 15:48:50
 */

/**
 * Gravity forms tabindex reset
 * Ensures tabindex attribute values are not greater than 0 for better accessibility
 */
add_filter( 'gform_tabindex', '__return_false' );

/**
 * Disable native lazyload.
 */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

/**
 * Fix some old images being mixed case
 */
add_filter( 'wp_get_attachment_url', 'dude_wp_get_attachment_url' );
function dude_wp_get_attachment_url( $url ) {
  return mb_strtolower( $url );
}

add_filter( 'the_content', 'dude_the_content_fix_image_url' );
function dude_the_content_fix_image_url( $content ) {
  return preg_replace_callback(
    '#\<img(.+?)src="https:\/\/(.+?)\/tiedostot(.+?)\/\>#s',
    function( $matches ) {
      return '<img' . $matches[1]
        . 'src="https://'
        . $matches[2] . '/tiedostot'
        . mb_strtolower( $matches[3] )
        . '/>';
    },
    $content
  );
}

// Fix relevanssi related posts thumbnail breakage
add_action( 'pre_relevanssi_related', function() {
remove_filter( 'update_post_metadata_cache', '__return_true' ); }, 11 );

/**
 * We use Mailgun
 */
add_filter( 'air_helper_sendgrid', '__return_false' );

/**
 * Show archives
 */
add_filter( 'air_helper_disable_views_tag', '__return_false' );
add_filter( 'air_helper_disable_views_category', '__return_false' );
add_filter( 'air_helper_disable_views_author', '__return_false' );

// Disable emojis
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

// Pre_get_posts for some archives
add_action( 'pre_get_posts', 'dude_pre_get_posts' );
function dude_pre_get_posts( $query ) {
  if ( $query->is_main_query() && $query->is_post_type_archive( 'reference' ) ) {
		$query->set( 'posts_per_page', 100 );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
  }
}

// Dude gform submit
// add_filter( 'gform_submit_button', 'dude_gform_submit_button', 10, 2 );
function dude_gform_submit_button( $button, $form ) {

  $arrow_dom = new DOMDocument();
  $arrow = $arrow_dom->createElement( 'span' );
  $arrow->setAttribute( 'class', 'arrow' );

  $dom = new DOMDocument( '1.0', 'UTF-8' );

  $dom->loadHTML( '<?xml encoding="UTF-8">' . $button );
  $new_arrow = $dom->importNode( $arrow );
  $input = $dom->getElementsByTagName( 'input' )->item( 0 );
  $new_button = $dom->createElement( 'button' );
  $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
  $new_button->appendChild( $new_arrow );
  $input->removeAttribute( 'value' );

  foreach ( $input->attributes as $attribute ) {
		$new_button->setAttribute( $attribute->name, $attribute->value );
  }

  $input->parentNode->replaceChild( $new_button, $input ); // phpcs:ignore

  return $dom->saveHtml( $new_button );
}

function dude_get_custom_excerpt_length( $excerpt = '', $length = 3 ) {
  $split = preg_split( '/(\. |\!|\?)/', $excerpt, $length, PREG_SPLIT_DELIM_CAPTURE );
  $new_excerpt = implode( '', array_slice( $split, 0, $length + 1 ) );

  return $new_excerpt;
} // end function dude_get_custom_excerpt_length

add_filter( 'get_the_excerpt', 'dude_get_the_excerpt', 10, 2 );
function dude_get_the_excerpt( $excerpt, $post = null ) {
  global $blog_latest_excerpt_override;

  if ( isset( $blog_latest_excerpt_override ) ) {
		if ( $blog_latest_excerpt_override === $post->ID ) {
		  return $excerpt;
			}
  }

  if ( 'post' !== $post->post_type ) {
		return $excerpt;
  }

  return dude_get_custom_excerpt_length( $excerpt );
} // end function dude_get_the_excerpt

add_filter( 'wp_calculate_image_srcset', 'dude_disable_srcset' );
function dude_disable_srcset( $sources ) {
  return false;
}

add_shortcode( 'checkmark', 'dude_shortcode_checkmark' );
function dude_shortcode_checkmark() {
  return trim( file_get_contents( get_theme_file_path( 'svg/checkmark.svg' ) ) ); // phpcs:ignore
}

// Swup reload gravity forms for ajax send to work
add_filter( 'gform_init_scripts_footer', '__return_false' );
add_filter( 'gform_get_form_filter', function( $form_string, $form ) {
  return $form_string = str_replace( '<script', '<script data-swup-reload-script data-swup-ignore-script', $form_string );
}, 10, 2);

// Scroll back to form if not sent with ajax
add_filter( 'gform_confirmation_anchor', '__return_true' );
