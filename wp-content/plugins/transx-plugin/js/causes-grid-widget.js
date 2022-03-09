"use strict";

jQuery(window).load(function () {
    // Isotope Activation
    if (jQuery('div').is('.transx_isotope_trigger')) {
        jQuery('.transx_isotope_trigger').isotope();
    }

    jQuery('.transx_filter li').eq(0).find('a').click();

    jQuery('.transx_filter li a').on('click', function(){
        jQuery('.transx_filter li a').removeClass('is-checked');
        jQuery('.transx_filter li').removeClass('is-checked');
        jQuery(this).addClass('is-checked');
        jQuery(this).parent().addClass('is-checked');
        var filterSelector = jQuery(this).attr('data-category');

        jQuery('.transx_isotope_trigger').isotope({
            filter: filterSelector
        });
        setTimeout("jQuery('.transx_filter li a.is-checked').click();", 500);
        return false;
    });
});

jQuery(window).on('elementor/frontend/init', function () {

    // ---------------------- //
    // --- Gallery Widget --- //
    // ---------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_gallery.default', function ($scope) {
        if (jQuery('div').is('.gallery-masonry')) {
            jQuery('.gallery-masonry').each(function () {
                jQuery(this).isotope({
                    itemSelector: '.gallery-masonry__item',
                    percentPosition: true,
                });
            });
        }
    });

    // ---------------------- //
    // --- Animals Widget --- //
    // ---------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_animals_listing.default', function ($scope) {
        if (jQuery('div').is('.transx_animal_listing_container')) {
            jQuery('.transx_animal_listing_container').each(function () {
                jQuery(this).isotope();
            });
        }
    });
});
