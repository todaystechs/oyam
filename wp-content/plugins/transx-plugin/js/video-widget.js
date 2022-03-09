"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_video.default', function ($scope) {
        let button = $scope.find('.transx_video_trigger_button'),
            video_popup = $scope.find('.transx_video_container'),
            video_container = $scope.find('.transx_video_wrapper'),
            close_popup_layer = $scope.find('.transx_close_popup_layer'),
            video_src = jQuery(video_container).attr('data-src'),
            video_height,
            video_width,
            k = 16/9;

        button.fancybox();
    });
});
