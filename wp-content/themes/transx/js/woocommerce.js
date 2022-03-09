"use strict";

jQuery(document).ready(function () {
    jQuery('.transx_single_product_page .quantity').prepend('<div class="transx_minus_button">-</div>').append('<div class="transx_plus_button">+</div>');
    jQuery('.woocommerce-cart-form .product-quantity .quantity').prepend('<div class="transx_minus_button">-</div>').append('<div class="transx_plus_button">+</div>');
});

jQuery(window).on('load', function () {
    jQuery('.woocommerce ul.products li.product .button.product_type_variable').prepend('<svg class="icon">\n' +
        '        <svg viewBox="0 0 488.878 488.878" id="check" xmlns="http://www.w3.org/2000/svg"><path d="M143.294 340.058l-92.457-92.456L0 298.439l122.009 122.008.14-.141 22.274 22.274L488.878 98.123l-51.823-51.825z"/></svg>\n' +
        '    </svg>'
    );

    jQuery('.woocommerce ul.products li.product').each(function () {
        let rating = jQuery(this).find('.star-rating').detach();

        jQuery(this).find('.woocommerce-loop-product__title').before(rating);
    });

    jQuery(document).on('click', '.transx_minus_button', function () {
        let input_value = jQuery(this).parent().find('.qty').val();

        if (input_value > 1) {
            input_value--;

            jQuery(this).parent().find('.qty').change().val(input_value);
        }
    });

    jQuery(document).on('click', '.transx_plus_button', function () {
        let input_value = jQuery(this).parent().find('.qty').val();

        input_value++;

        jQuery(this).parent().find('.qty').change().val(input_value);
    });

    jQuery(window).on('scroll', function () {
        if (jQuery('div').is('.transx_minus_button')){} else {
            jQuery('.woocommerce-cart-form .product-quantity .quantity').prepend('<div class="transx_minus_button">-</div>').append('<div class="transx_plus_button">+</div>');

            jQuery('.transx_minus_button').on('click', function () {
                var input_value = jQuery(this).parent().find('.qty').val();

                if (input_value > 1) {
                    input_value--;

                    jQuery(this).parent().find('.qty').val(input_value);
                }
            });

            jQuery('.transx_plus_button').on('click', function () {
                var input_value = jQuery(this).parent().find('.qty').val();

                input_value++;

                jQuery(this).parent().find('.qty').val(input_value);
            });
        }
    });

    jQuery('.tagged_as a').each(function () {
        let link = jQuery(this);

        jQuery(link.prop('nextSibling')).remove();
    });
});
