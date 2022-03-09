"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_content_slider.default', function ($scope) {
        let trigger = $scope.find('.transx_video_trigger'),
            slider = $scope.find('.transx_slider_slick'),
            slider_options = slider.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows'),
            prev = $scope.find('.transx_causes_slider_navigation_container .transx_prev'),
            next = $scope.find('.transx_causes_slider_navigation_container .transx_next'),
            status = $scope.find('.transx_slider_counter'),
            current_cont = status.find('.transx_current_slide'),
            all_cont = status.find('.transx_all_slides');

        trigger.fancybox();

        slider.on('init afterChange', function (event, slick, currentSlide, nextSlide) {
            var i = (currentSlide ? currentSlide : 0) + 1,
                n, b;

            if (i < 10) {
                n = '0';
            } else {
                n = '';
            }

            if (slick.slideCount < 10) {
                b = '0';
            } else {
                b = '';
            }

            current_cont.text(n + i);
            all_cont.text(b + slick.slideCount);
        });

        slider.slick({
            fade: true,
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: 1,
            // prevArrow: prev,
            // nextArrow: next,
            arrows: false,
            dots: true,
            appendDots: dots_container,
            adaptiveHeight: true
        });
    });
});
