/*
* @Author: Timi Wahalahti
* @Date:   2019-06-03 22:07:25
* @Last Modified by:   Roni Laukkarinen
* @Last Modified time: 2019-06-07 09:11:10
*/

( function( $ ) {

  var cart = [];

  // # LISTENERS
  // model select
  $('.col-product .models button').on( 'click', function() {
    var model = $(this).data('model');

    // set this model as active
    $(this).closest('.models').find('button').removeClass('active');
    $(this).addClass('active');

    // set this model sizes visible
    $(this).closest('.col-product').find('.sizes').removeClass('visible');
    $(this).closest('.col-product').find('.sizes[data-model="' + model + '"]').addClass('visible');
  } );

  // size select
  $('.col-product .sizes button').on( 'click', function() {
    var instock = $(this).data('instock');

    // set this size as active
    $(this).closest('.sizes').find('button').removeClass('active');
    $(this).addClass('active');

    // maybe activate the cart button
    if ( ! instock ) {
      $(this).closest('.col-product').find('button.add-to-cart').addClass('disabled');
      $(this).closest('.col-product').find('button.add-to-cart').attr('disabled', 'true');
    } else {
      $(this).closest('.col-product').find('button.add-to-cart').removeClass('disabled');
      $(this).closest('.col-product').find('button.add-to-cart').prop('disabled', false);
    }
  } );

  // add to cart
  $('body').on( 'click', '.col-product button.add-to-cart', function() {
    addToCart( $(this) );
  } );

  // # FUNCTIONS
  function addToCart( element ) {
    var product = element.closest('.col-product').data('product');
    var model = element.closest('.col-product').find('.models button.active').data('model');
    var size = element.closest('.col-product').find('.sizes.visible button.active').data('size');
    var size_instock = element.closest('.col-product').find('.sizes.visible button.active').data('instock');

    // check if similar item is already in cart
    var cart_index = _.findIndex( cart, { 'product': product, 'model': model, 'size': size } );
    if ( cart_index !== -1 ) {
      // is in cart, check tha we have enough in stock
      if ( cart[ cart_index ].qty < size_instock ) {
        // add qty to cart
        cart[ cart_index ].qty = cart[ cart_index ].qty + 1;
      }
    } else {
      // add product to cart
      cart.push( {
        'product': product,
        'model': model,
        'size': size,
        'qty': 1
      } );
    }

    // console.log( element.closest('.col-product').data('product') );
    // console.log( cart );
  }

} )( jQuery );
