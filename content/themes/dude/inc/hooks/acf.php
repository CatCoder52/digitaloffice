<?php
/**
 * ACF hooks.
 *
 * @package dude
 * @Author: Roni Laukkarinen
 * @Date: 2020-02-20 13:46:50
 * @Last Modified by: Roni Laukkarinen
 * @Last Modified time: 2020-07-03 15:48:50
 */

add_action( 'acf/input/admin_footer', 'add_module_preview' );
add_action( 'acf/input/admin_head', 'acf_admin_head_custom_js_css' );

// Modify ACF Flexible field title to show area title and module type.
add_filter( 'acf/fields/flexible_content/layout_title', 'flexible_content_layout_title', 10, 4 );

// Register theme options page
add_action( 'acf/init', 'register_theme_options_page' );

// Icon selector
add_filter( 'acf/load_field/type=select', 'dynamic_select_for_icon' );

// Save merch stock to our custom post meta instead of ACF's
add_filter( 'acf/save_post', 'dude_merch_stock_save', 5 );
function dude_merch_stock_save( $post_id ) {

  // Bail early if no ACF data
  if ( empty( $_POST['acf'] ) ) { // phpcs:ignore
		return;
  }

  $stock = array();

  if ( ! isset( $_POST['acf']['field_5ce9670017057'] ) ) { // phpcs:ignore
		return;
  }

  // Loop models
  foreach ( $_POST['acf']['field_5ce9670017057'] as $model ) { // phpcs:ignore

		// Continue to next if no stock
		if ( empty( $model['field_5ce967501705b'] ) || empty( $model['field_5ce9672317058'] ) ) {
		  continue;
			}

		$stock_key = sanitize_title( $model['field_5ce9672317058'] );

		// Loop stock
		foreach ( $model['field_5ce967501705b'] as $stock_item ) {
		  $stock[ $stock_key ][ $stock_item['field_5ce967681705c'] ] = $stock_item['field_5ce967731705d'];
			}
  }

  update_post_meta( $post_id, '_stock', $stock );

  // Unset the acf field and prevent it from saving
  unset( $_POST['acf']['field_5cb59e0006657'] ); // phpcs:ignore
} // End function dude_merch_stock_save

add_filter( 'acf/load_value/name=models', 'dude_merch_stock', 10, 3 );
function dude_merch_stock( $value, $post_id, $field ) {
  $stock = get_post_meta( $post_id, '_stock', true );
  $stock_acf = array();

  if ( empty( $stock ) ) {
		return;
  }

  foreach ( $value as $model_key => $model ) {
		$stock_key = sanitize_title( $model['field_5ce9672317058'] );

		if ( empty( $stock[ $stock_key ] ) ) {
		  continue;
			}

		$stock_items = array();
		foreach ( $stock[ $stock_key ] as $stock_item_name => $stock_item_value ) {
		  $stock_items[] = array(
			'field_5ce967681705c' => $stock_item_name,
			'field_5ce967731705d' => $stock_item_value,
		  );
			}

		$value[ $model_key ]['field_5ce967501705b'] = $stock_items;
  }

  return $value;
} // End function dude_merch_stock

/**
 * Better Flexible Content field with image previews, title and module name.
 */
function acf_admin_head_custom_js_css() { ?>
  <style>
    /* style edit links on relation fields */
    .acf-postbox .acf-relationship .values span.acf-rel-item a.edit-link {
      font-style: italic;
      font-size: 12px;
    }

    .acf-postbox .acf-relationship .selection .values span.acf-rel-item:hover a.edit-link {
      color: #fff;
    }

    .acf-flexible-content .acf-fc-layout-handle::before {
      background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.8365721288515406) 37%, rgba(255,255,255,1) 100%);
      content: '';
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 0;
    }

    .acf-flexible-content .acf-fc-layout-handle::after {
      background-size: 100% auto;
      position: relative;
      z-index: 1;
      content: '';
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
    }

    .acf-flexible-content .acf-fc-layout-handle {
      background-image: none !important;
    }

    .acf-module-preview-small {
      position: absolute;
      right: 5px;
      top: 50px;
      z-index: 100;
      height: auto;
      width: 700px;
      opacity: 0;
      visibility: hidden;
      transition: none;
      background-color: #fff;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      transform: translateY(-180px) translateX(-100px);
    }

    .acf-flexible-content .acf-fc-layout-handle .acf-module-preview-small {
      position: absolute;
      z-index: 99;
    }

    .acf-module-preview-small img {
      width: calc(100% - 10px);
      height: auto;
      border: 6px solid #fff;
      border-radius: 3px;
    }

    .acf-module-preview-small.show {
      opacity: 1;
      visibility: visible;
    }

    .acf-flexible-content .acf-fc-layout-handle * {
      position: relative;
      z-index: 1;
    }

    .acf-flexible-content .acf-fields {
      background: rgba(255, 255, 255, .95);
    }

    /* Custom colors */
    div[data-name="bg_color"] .acf-button-group label:nth-of-type(1):before {
      content: ' ';
      position: relative;
      width: 10px;
      height: 10px;
      background: #fff;
      margin-right: 5px;
      display: inline-block;
    }

    div[data-name="bg_color"] .acf-button-group label:nth-of-type(2):before {
      content: ' ';
      position: relative;
      width: 10px;
      height: 10px;
      background: #f7f8f9;
      margin-right: 5px;
      display: inline-block;
    }

    div[data-name="bg_color"] .acf-button-group label:nth-of-type(3):before {
      content: ' ';
      position: relative;
      width: 10px;
      height: 10px;
      background: #fcf7f2;
      margin-right: 5px;
      display: inline-block;
    }

    /* do not show flexible content fields if it is not collapsed */
    .acf-flexible-content .acf-fields.-collapse {
      display: none;
    }
    /* do not show repeter fields if not collapsed */
    .acf-repeater.-row .acf-row > .acf-row-handle .acf-icon.-collapse {
      display: block;
    }
    /* better styiling? */
    .acf-postbox .acf-field.separator {
      padding-bottom: 0;
    }
    .acf-postbox .acf-field.separator .acf-label {
      margin: 0;
    }
    .acf-postbox .acf-field.separator label {
      font-size: 14px;
    }
    .acf-postbox .acf-field.separator + .acf-field {
      border-top: none;
    }

    .acf-flexible-content .layout .acf-fc-layout-controls .acf-icon[data-name="collapse-layout"] {
      float: right;
    }

    .acf-flexible-content .acf-fc-layout-handle .module-title {
      background: #2e363e;
      color: #fff;
      border-radius: 5px;
      padding: 2px 6px;
      font-weight: 500;
      font-size: 11px;
      margin-left: 10px;
      font-style: normal;
      display: inline-flex;
      align-items: center;
      position: absolute;
      top: 6px;
      font-weight: 300;
      text-align: center;
      transition: all .66s;
      opacity: 0;
    }

    .acf-flexible-content .acf-fc-layout-handle:hover .module-title {
      opacity: 1;
    }

    .module-title svg {
      width: 12px;
      height: 12px;
      margin-right: 5px;
      margin-left: -2px;
    }

    /* style edit links on relation fields */
    .acf-postbox .acf-relationship .values  span.acf-rel-item a.edit-link {
      font-style: italic;
      font-size: 14px;
    }
    .acf-postbox .acf-relationship .selection .values  span.acf-rel-item:hover a.edit-link {
      color: #fff;
    }

    /* module preview styles */
    .acf-module-preview {
      display: none;
      position: fixed;
      left: 170px;
      top: 40px;
      z-index: 100;
      height: 300px;
      max-height: 300px;
      width: 900px;
      max-width: 900px;
      z-index: 99;
    }

    .acf-module-preview img {
      border: solid 10px #fff;
      width: 100%;
      border: 6px solid #fff;
      border-radius: 3px;
    }

    .acf-module-preview.show {
      display: block;
    }
  </style>

  <script type="text/javascript">
    jQuery(function($) {

      /*
      var preview = document.querySelectorAll('.acf-module-preview-small');

      document.addEventListener('mousemove', fn, false);

      function fn(e) {
          for (var i=preview.length; i--;) {
              preview[i].style.left = e.pageX + 'px';
              // preview[i].style.top = e.pageY + 'px';
          }
      }

      var images_path = '<?php echo esc_url( get_stylesheet_directory_uri() ); ?>';

      // Add images to little thumbnails
      jQuery('.acf-flexible-content .layout').each(function() {
        layout = jQuery(this).attr('data-layout');
        jQuery(this).find('.acf-fc-layout-handle').css({'background-image':'url(' + images_path + '/images/acf-modules/' + layout + '.jpg)'});
      });

      jQuery('.acf-fc-layout-handle').mouseover(function() {
          layout_preview_small = jQuery(this).parent().attr('data-layout');
          jQuery(this).find('.acf-module-preview-small').html( '<img src="' + images_path + '/images/acf-modules/' + layout_preview_small + '.jpg">' );
          jQuery(this).find('.acf-module-preview-small').addClass('show');
          jQuery('body.wp-admin').css('overflow-x', 'hidden');
        }).mouseleave(function() {
          jQuery(this).find('.acf-module-preview-small').removeClass('show');
          jQuery('body.wp-admin').css('overflow-x', 'auto');
      });
      */

      var timer;

      // do not show flexible content or row field before opening, excluding new items
      $('.acf-flexible-content .layout:not(.acf-clone)').addClass('-collapsed');
      $('#acf-flexible-content-collapse').detach();

      // show module preview image when module name is hovered
      /*
      jQuery(document).on({
        'mouseover': function () {

          timer = setTimeout(function () {
            layout = jQuery('.acf-tooltip.acf-fc-popup li a:hover').attr('data-layout')
            jQuery('.acf-module-preview').html( '<img src="' + images_path + '/images/acf-modules/' + layout + '.jpg">' );
            jQuery('.acf-module-preview').addClass('show');
          }, 100);
        },
        'mouseout' : function () {
          clearTimeout(timer);
          jQuery('.acf-module-preview').removeClass('show');
        }
      }, '.acf-tooltip.acf-fc-popup li a' );
      // hide module preview when module is added
      acf.addAction('append', function( $el ){
        jQuery('.acf-module-preview').removeClass('show');
      });
      */
    });
  </script>
<?php }

function add_module_preview() {
  echo '<div class="acf-module-preview"></div>';
}

/**
 * Modify ACF Flexible field title to show area title and module type.
 */
function flexible_content_layout_title( $title, $field, $layout, $i ) {
  $new_title = get_sub_field( 'area_title' );

  if ( empty( $new_title ) ) {
		if ( ! empty( get_sub_field( 'title' ) ) ) {
		  $new_title = get_sub_field( 'title' );
			} else {
		  $new_title = $title;
			}
  }

  $old_title = $title;
  if ( ! empty( $new_title ) ) {
		$title = '<b>' . $new_title . '</b>';
		$title .= ' <span class="module-title"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-3 -2 24 24" width="18" height="18" preserveAspectRatio="xMinYMin" class="jam jam-layout" fill="currentColor"><path d="M9 18h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4V8H2V6h14v2H9v10zM3 0h12a3 3 0 0 1 3 3v14a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3V3a3 3 0 0 1 3-3z"/></svg>' . $old_title . '</span><div class="acf-module-preview-small"></div>';
  }

  return $title;
}
