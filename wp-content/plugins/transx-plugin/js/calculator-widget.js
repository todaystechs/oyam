"use strict";

jQuery(window).on('elementor/frontend/init', function () {

    elementorFrontend.hooks.addAction('frontend/element_ready/transx_calculator.default', function ($scope) {
        $scope.find('.js-range-slider').ionRangeSlider();

        $scope.find('.transx_truckload_type_select').on('click', function () {
            jQuery(this).toggleClass('open');
        });

        jQuery(document).on('click', function(event) {
            if (jQuery(event.target).closest('.transx_truckload_type_select').length) return;

            $scope.find('.transx_truckload_type_select').removeClass('open');
            event.stopPropagation();
        });

        $scope.find('.transx_option').on('click', function () {
            let price = Number(jQuery(this).attr('data-price')),
                currency = jQuery(this).attr('data-currency'),
                value = jQuery(this).attr('data-title');

            jQuery(this).parent().find('.selected').removeClass('selected');
            jQuery(this).parent().find('.focus').removeClass('focus');
            jQuery(this).addClass('selected focus');

            jQuery(this).parents('.transx_truckload_type_select').attr('data-price', price).attr('data-currency', currency);
            jQuery(this).parents('.transx_truckload_type_select').find('.transx_current').html(value);
        });

        $scope.find('.transx_refrigerate_checkbox').on('click', function () {
            let refrigerate = jQuery(this).parent().attr('data-refrigerate');

            jQuery(this).toggleClass('active');

            if (refrigerate === 'no') {
                jQuery(this).parent().attr('data-refrigerate', 'yes');
            } else {
                jQuery(this).parent().attr('data-refrigerate', 'no');
            }

        });

        $scope.find('.transx_calc_button').on('click', function () {
            let form = jQuery(this).parents('.transx_calc_form'),
                price = Number(form.find('.transx_truckload_type_select').attr('data-price')),
                currency = form.find('.transx_truckload_type_select').attr('data-currency'),
                weight = Number(form.find('.transx_cargo_weight').val()),
                refrigerate = form.find('.transx_refrigerate_option_container').attr('data-refrigerate'),
                refprice = Number(form.find('.transx_refrigerate_option_container').attr('data-refprice')),
                distance = Number(form.find('.irs-single').html());

            if (weight === '') {
                weight = 0;
            }

            let cost = price * weight * distance;

            if (refrigerate === 'yes') {
                cost = cost + refprice;
            }

            form.find('.transx_cost').html(cost);
            form.find('.transx_cost_currency').html(currency);
        });
    });
});
