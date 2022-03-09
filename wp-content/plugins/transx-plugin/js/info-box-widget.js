"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_info_box.default', function ($scope) {
        jQuery($scope).find('.transx_info_box_item.view_type_2').each(function () {
            let description_height = jQuery(this).find('.transx_info_box_content').height();

            jQuery(this).find('.transx_info_box_content_cont').css({'transform':'translateY(' + description_height + 'px)'});
        });
    });
});
