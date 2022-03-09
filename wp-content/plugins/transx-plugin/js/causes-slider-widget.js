"use strict";

jQuery(window).on('elementor/frontend/init', function () {

    // ----------------------------- //
    // ------ Timeline Widget ------ //
    // ----------------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_time_line.default', function ($scope) {
        let causesSlider = $scope.find('.transx_slider_slick'),
            slider_options = causesSlider.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows');

        if (!causesSlider.length) return;

        $scope.find('.transx_offset_container').width(jQuery(window).width());

        causesSlider.slick({
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: slider_options['slides_to_show'],
            arrows: false,
            dots: slider_options['nav'],
            appendDots: dots_container,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }]
        });
    });

    // ---------------------------------- //
    // ------ Blog Carousel Widget ------ //
    // ---------------------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_blog_slider.default', function ($scope) {
        let causesSlider = $scope.find('.transx_slider_slick'),
            slider_options = causesSlider.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows'),
            prev = $scope.find('.transx_causes_slider_navigation_container .transx_prev'),
            next = $scope.find('.transx_causes_slider_navigation_container .transx_next');

        if (!causesSlider.length) return;

        $scope.find('.transx_offset_container').width(jQuery(window).width());

        causesSlider.slick({
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: 3,
            arrows: false,
            dots: true,
            appendDots: dots_container,
            responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }]
        });
    });

    // ----------------------------------- //
    // ------ Gallery Slider Widget ------ //
    // ----------------------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_gallery_slider.default', function ($scope) {
        let causesSlider = $scope.find('.transx_slider_slick'),
            slider_options = causesSlider.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows'),
            prev = $scope.find('.transx_causes_slider_navigation_container .transx_prev'),
            next = $scope.find('.transx_causes_slider_navigation_container .transx_next');

        if (!causesSlider.length) return;

        $scope.find('.transx_offset_container').width(jQuery(window).width());

        causesSlider.slick({
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: 4,
            arrows: false,
            dots: true,
            appendDots: dots_container,
            responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }]
        });
    });

    // ----------------------------------------- //
    // ------ Linked Item Carousel Widget ------ //
    // ----------------------------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_linked_item_slider.default', function ($scope) {
        let causesSlider = $scope.find('.transx_slider_slick'),
            slider_options = causesSlider.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows'),
            prev = $scope.find('.transx_causes_slider_navigation_container .transx_prev'),
            next = $scope.find('.transx_causes_slider_navigation_container .transx_next');

        if (!causesSlider.length) return;

        $scope.find('.transx_offset_container').width(jQuery(window).width());

        causesSlider.slick({
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            centerMode: true,
            centerPadding: "0px",
            rtl: slider_options['rtl'],
            slidesToShow: 3,
            // prevArrow: prev,
            // nextArrow: next,
            arrows: false,
            dots: true,
            appendDots: dots_container,
            responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }]
        });
    });

    // -------------------------------------- //
    // ------ Info Box Carousel Widget ------ //
    // -------------------------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/transx_info_box_slider.default', function ($scope) {
        let causesSlider = $scope.find('.transx_slider_slick'),
            slider_options = causesSlider.data('slider-options'),
            dots_container = $scope.find('.transx_slider_arrows'),
            window_width = jQuery(window).width(),
            prev = $scope.find('.transx_causes_slider_navigation_container .transx_prev'),
            next = $scope.find('.transx_causes_slider_navigation_container .transx_next');

        if (!causesSlider.length) return;

        $scope.find('.transx_offset_container').width(window_width - 52);

        causesSlider.slick({
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
            responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 3,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 568,
                settings: {
                    slidesToShow: 1,
                }
            }]
        });

        jQuery($scope).find('.transx_info_box_item.view_type_2').each(function () {
            let description_height = jQuery(this).find('.transx_info_box_content').height();

            jQuery(this).find('.transx_info_box_content_cont').css({'transform':'translateY(' + description_height + 'px)'});
        });
    });
});
