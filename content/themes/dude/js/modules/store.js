/* eslint-disable vars-on-top, max-len, operator-assignment, func-names, no-use-before-define, camelcase, no-undef, block-scoped-var, no-plusplus, no-redeclare, no-var */
/*
* @Author: Timi Wahalahti
* @Date:   2019-06-03 22:07:25
* @Last Modified by:   Timi Wahalahti
* @Last Modified time: 2021-09-24 14:34:11
*/

// jQuery start
(function ($) {
  // Document ready start
  $(() => {
    const cart = [];

    // Automatically fill hidden state based on the city field
    $('input[name="simpay_billing_address_city"]').keyup(function () {
      $('input[name="simpay_billing_address_state"]').val($(this).val());
    });

    // Disable autocomplete
    $('.simpay-form-4535').attr('autocomplete', 'off');
    $('.simpay-form-4535 input').attr('autocomplete', 'off');

    // # LISTENERS
    // Model select
    $('.col-product .models button').on('click', function (e) {
      e.preventDefault();
      const modelslug = $(this).data('model-slug');

      // Set this model as active
      $(this).closest('.models').find('button').removeClass('active');
      $(this).addClass('active');

      // Change model image
      const productimage = $(this).data('image');
      var changethis = $(this).parent().parent().prev()
        .children()
        .find('.lazy');

      $(changethis).css('background-image', `url('${productimage}')`);

      // Set this model sizes visible
      $(this).closest('.col-product').find('.sizes').removeClass('visible');
      $(this).closest('.col-product').find(`.sizes[data-model-slug="${modelslug}"]`).addClass('visible');

      // If model is changed again and sizes are disabled, disable add to cart button
      if ($(this).closest('.col-product').find(`.sizes.visible[data-model-slug="${modelslug}"] button`).length > 0) {
        $(this).closest('.col-product').find('.add-to-cart').removeClass('active');
        $(this).closest('.col-product').find('.add-to-cart').prop('disabled', true);
      } else {
        $(this).closest('.col-product').find('.add-to-cart').addClass('active');
        $(this).closest('.col-product').find('.add-to-cart').prop('disabled', false);
      }
    });

    // Size select
    $('.col-product .sizes button').on('click', function (e) {
      e.preventDefault();
      const instock = $(this).data('instock');

      // Set this size as active
      $(this).closest('.sizes').find('button').removeClass('active');
      $(this).addClass('active');

      // Maybe activate the cart button
      if (!instock) {
        $(this).closest('.col-product').find('button.add-to-cart').addClass('disabled');
        $(this).closest('.col-product').find('button.add-to-cart').attr('disabled', 'true');
      } else {
        $(this).closest('.col-product').find('button.add-to-cart').removeClass('disabled');
        $(this).closest('.col-product').find('button.add-to-cart').prop('disabled', false);
      }
    });

    // Add to cart
    $('body').on('click', '.col-product button.add-to-cart', function (e) {
      e.preventDefault();
      addToCart($(this));
      $('.cart').addClass('show');
    });

    // # FUNCTIONS
    function addToCart(element) {
      const product = element.closest('.col-product').data('product');
      const price = element.closest('.col-product').data('price');
      const productname = escape(element.closest('.col-product').data('product-name'));
      const modelname = element.closest('.col-product').find('.models button.active').data('model-name');
      const modelslug = element.closest('.col-product').find('.models button.active').data('model-slug');
      const size = element.closest('.col-product').find('.sizes.visible button.active').data('size');
      const size_instock = element.closest('.col-product').find('.sizes.visible button.active').data('instock');

      // Check if similar item is already in cart
      const cart_index = _.findIndex(cart, {
        product,
        modelslug,
        size,
      });

      if (cart_index !== -1) {
      // Is in cart, check tha we have enough in stock
        if (cart[cart_index].qty < size_instock) {
        // Add qty to cart
          cart[cart_index].qty = cart[cart_index].qty + 1;
        }
      } else {
      // Add product to cart
        cart.push({
          product,
          productname,
          modelname,
          modelslug,
          size,
          stock: size_instock,
          price,
          qty: 1,
        });
      }

      // Get total quantities
      let totals = 0;
      for (var i = 0; i < cart.length; i++) {
        totals += cart[i].qty;
      }

      // Get total prices
      let pricetotals = 0;
      for (var i = 0; i < cart.length; i++) {
        pricetotals += cart[i].price * cart[i].qty;
      }

      // Get total products
      let products = '';
      for (var i = 0; i < cart.length; i++) {
        products += `<span class="products">${cart[i].qty} x <b>${cart[i].productname}</b>, malli: ${cart[i].modelname} <span class="size">${cart[i].size}</span></span><span class="comma">, </span>`;
      }

      // Add item labels to cart
      document.getElementById('totals').innerHTML = totals;
      document.getElementById('price').innerHTML = pricetotals;
      document.getElementById('products').innerHTML = products;

      // Hide empty cart text, show cart
      $('span.cart-text').css('display', 'inline');
      $('.empty-cart-text').hide();
      $('.full-cart').show();

      // Hide textual brackets
      // $("span.cart-text:contains('(')").hide();
      // $("span.cart-text:contains(')')").hide();

      // Add to cart modal input fields
      const plaintext = $('.full-cart').text();

      // Input inside div class="simpay-text-wrap simpay-field-wrap"
      // THIS SHOULD BE THE SAME AS "Tuotteet", make sure of it
      const productsTextareaField = document.getElementById('simpay-form-4535-field-8');
      productsTextareaField.value = plaintext;

      // Make element read only (not editable)
      productsTextareaField.readOnly = true;

      const cartJson = [];
      _.forEach( cart, function(value, key) {
        cartJson.push({
          product: value.product,
          modelname: value.modelname,
          size: value.size,
          qty: value.qty
        });
      });

      // Input inside div class="simpay-text-wrap simpay-field-wrap"
      // THIS SHOULD BE THE SAME AS "Tuotteet koneluettava", make sure of it
      const productsJsonTextareaField = document.getElementById('simpay-form-4535-field-10');
      productsJsonTextareaField.value = JSON.stringify( cartJson );

      // Make element read only (not editable)
      productsJsonTextareaField.readOnly = true;

      document.getElementsByName('simpay_custom_price_amount')[0].value = pricetotals;
      // document.getElementById("simpay-custom-amount-4535").focus({preventScroll: true});
      // document.getElementById("simpay-4535-customer-name-4").focus({preventScroll: true});
      $('#simpay-form-4535').find('[name="simpay_custom_price_amount"]').click();
    }

    // Launch Overlay from Other Buttons or Links
    // Source: https://docs.wpsimplepay.com/articles/launch-overlay-externally/

    // Custom Overlay forms
    $('#buy').click((e) => {
      e.preventDefault();
      // Input name="simpay_custom_amount"
      document.getElementsByName('simpay_custom_price_amount')[0].focus({ preventScroll: true });

      // Input name="simpay_customer_name"
      document.getElementById('simpay-form-4535-field-4').focus({ preventScroll: true });
      simpayAppPro.toggleOverlayForm(4535);
    });

    // Stripe Checkout forms
    $('#buy').click((e) => {
      e.preventDefault();
      $('#simpay-form-4535').find('.simpay-payment-btn').click();

      // Input name="simpay_custom_amount"
      $('#simpay-form-4535').find('[name="simpay_custom_price_amount"]').click();
    });
  });
}(jQuery));
