"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_testimonials.default', function ($scope) {
        let testimonials = $scope.find('.transx_slider_slick'),
            slider_options = testimonials.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows'),
            prev = $scope.find('.transx_causes_slider_navigation_container .transx_prev'),
            next = $scope.find('.transx_causes_slider_navigation_container .transx_next');

        testimonials.slick({
            fade: slider_options['fade'],
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: slider_options['slidesToShow'],
            // prevArrow: prev,
            // nextArrow: next,
            arrows: false,
            dots: true,
            appendDots: dots_container,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }],
        });
    });
});
