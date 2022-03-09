"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_linked_item.default', function ($scope) {
        $scope.find('.transx_linked_item_widget').each(function () {
            let container = jQuery(this).find('.transx_linked_item_wrapper'),
                cont_width = container.width(),
                cont_height = container.height();

            container.find('.transx_linked_item_up_title').width(cont_height).height(cont_width);
        });
    });
});
