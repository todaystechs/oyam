"use strict";

// ---------------------- //
// --- Document Ready --- //
// ---------------------- //
jQuery(document).ready(function () {

    // aside dropdown
    function asideDropdown() {
        var dropdown = jQuery('.transx_aside-dropdown');

        if (!dropdown.length) return;

        var trigger = jQuery('.transx_dropdown-trigger');
        var	close = jQuery('.transx_aside-dropdown__close');
        var introLink = jQuery('.transx_aside-dropdown .main-menu__link--scroll');

        trigger.on('click', function(){
            dropdown.addClass('transx_aside-dropdown--active');
            trigger.addClass('is-active');
        });

        close.on('click', function(){
            dropdown.removeClass('transx_aside-dropdown--active');
            trigger.removeClass('is-active');
        });

        introLink.on('click', function(){
            dropdown.removeClass('transx_aside-dropdown--active');
            trigger.removeClass('is-active');
        });

        jQuery(document).on('click', function(event) {
            if (jQuery(event.target).closest('.transx_dropdown-trigger, .transx_aside-dropdown__inner').length) return;
            dropdown.removeClass('transx_aside-dropdown--active');
            trigger.removeClass('is-active');
            event.stopPropagation();
        });
    }

    asideDropdown();

    // Background Image CSS From JS
    if (jQuery('.transx_js_bg_image').length) {
        jQuery('.transx_js_bg_image').each(function(){
            jQuery(this).css('background-image', 'url('+jQuery(this).attr('data-background')+')');
        });
    }

    // Background Color CSS From JS
    if (jQuery('.transx_js_bg_color').length) {
        jQuery('.transx_js_bg_color').each(function(){
            jQuery(this).css('background-color', jQuery(this).attr('data-bg-color'));
        });
    }

    // Min Height CSS From JS
    if (jQuery('.transx_js_min_height').length) {
        jQuery('.transx_js_min_height').each(function(){
            jQuery(this).css('min-height', jQuery(this).attr('data-min-height')+'px');
        });
    }

    jQuery('.elementor-widget-alert.transx_view_type_1 .elementor-alert-success, .elementor-widget-alert.transx_view_type_2 .elementor-alert-success').each(function () {
        jQuery(this).prepend('<div class="transx_alert_icon"><svg class="icon">\n' +
            '        <svg viewBox="0 0 488.878 488.878" id="check" xmlns="http://www.w3.org/2000/svg"><path d="M143.294 340.058l-92.457-92.456L0 298.439l122.009 122.008.14-.141 22.274 22.274L488.878 98.123l-51.823-51.825z"/></svg>\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.transx_view_type_1 .elementor-alert-info, .elementor-widget-alert.transx_view_type_2 .elementor-alert-info').each(function () {
        jQuery(this).prepend('<div class="transx_alert_icon"><svg class="icon">\\n\' +\n' +
            '     <svg viewBox="0 0 31.357 31.357" id="question" xmlns="http://www.w3.org/2000/svg"><path d="M15.255 0c5.424 0 10.764 2.498 10.764 8.473 0 5.51-6.314 7.629-7.67 9.62-1.018 1.481-.678 3.562-3.475 3.562-1.822 0-2.712-1.482-2.712-2.838 0-5.046 7.414-6.188 7.414-10.343 0-2.287-1.522-3.643-4.066-3.643-5.424 0-3.306 5.592-7.414 5.592-1.483 0-2.756-.89-2.756-2.584C5.339 3.683 10.084 0 15.255 0zm-.211 24.406a3.492 3.492 0 013.475 3.476 3.49 3.49 0 01-3.475 3.476 3.49 3.49 0 01-3.476-3.476 3.491 3.491 0 013.476-3.476z"/></svg>\\n\' +\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.transx_view_type_1 .elementor-alert-warning, .elementor-widget-alert.transx_view_type_2 .elementor-alert-warning').each(function () {
        jQuery(this).prepend('<div class="transx_alert_icon"><svg class="icon">\\n\' +\n' +
            '    <svg viewBox="0 0 489.418 489.418" id="warning" xmlns="http://www.w3.org/2000/svg"><path d="M244.709 389.496c18.736 0 34.332-14.355 35.91-33.026l24.359-290.927a60.493 60.493 0 00-15.756-46.011C277.783 7.09 261.629 0 244.709 0s-33.074 7.09-44.514 19.532a60.485 60.485 0 00-15.755 46.011l24.359 290.927c1.578 18.671 17.174 33.026 35.91 33.026zm0 21.412c-21.684 0-39.256 17.571-39.256 39.256 0 21.683 17.572 39.254 39.256 39.254s39.256-17.571 39.256-39.254c0-21.685-17.572-39.256-39.256-39.256z"/></svg>\\n\' +\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.transx_view_type_1 .elementor-alert-danger, .elementor-widget-alert.transx_view_type_2 .elementor-alert-danger').each(function () {
        jQuery(this).prepend('<div class="transx_alert_icon"><svg class="icon">\n' +
            '        <svg viewBox="0 0 47.971 47.971" id="close" xmlns="http://www.w3.org/2000/svg"><path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 000-4.242 2.998 2.998 0 00-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 00-4.242 0 2.998 2.998 0 000 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 104.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 000-4.242L28.228 23.986z"/></svg>\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.transx_view_type_1 .elementor-alert-dismiss, .elementor-widget-alert.transx_view_type_2 .elementor-alert-dismiss').each(function () {
        jQuery(this).html('<svg class="icon">\n' +
            '        <svg viewBox="0 0 47.971 47.971" id="close" xmlns="http://www.w3.org/2000/svg"><path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 000-4.242 2.998 2.998 0 00-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 00-4.242 0 2.998 2.998 0 000 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 104.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 000-4.242L28.228 23.986z"/></svg>\n' +
            '    </svg>'
        );
    });

    if (jQuery('.transx_donation_excerpt_container').length) {
        let donation_excerpt = jQuery('.transx_donation_excerpt_container').detach();

        if (jQuery('.give-display-onpage').length) {
            jQuery('.give-form-title').after(donation_excerpt);
        }
    }

    let label = jQuery('.give-total-wrap').find('label').detach();

    jQuery('.give-total-wrap').before(label);

    jQuery('.transx_blog_listing_excerpt').each(function () {
        let excerpt = jQuery(this).html();

        if (excerpt === '&nbsp;') {
            jQuery(this).css('display', 'none');
        }
    });
});

// ------------------- //
// --- Window Load --- //
// ------------------- //
jQuery(window).on('load', function () {
    let window_width = jQuery(window).width();

    jQuery('body').css('opacity', '1');
    setTimeout(function () {
        jQuery('.transx_preloader_container').addClass('invisible');
    }, 500);

    setTimeout(function () {
        jQuery('.transx_preloader_container').css('display', 'none');
    }, 1200);

    if (jQuery('.transx_single_post_donation_form_container .give-progress-bar').length) {
        let progress_bar = jQuery('.transx_single_post_donation_form_container .give-progress-bar'),
            progress_bar_value = jQuery(progress_bar).attr('aria-valuenow');

        jQuery(progress_bar).find('span').append('<span class="transx_progress_bar_marker">' + progress_bar_value + '%</span>');
    }

    if (jQuery('.transx_donation_item_form_cont').length) {
        jQuery('.transx_donation_item_form_cont').each(function () {
            let progress_bar = jQuery(this).find('.give-progress-bar'),
                progress_bar_value = jQuery(progress_bar).attr('aria-valuenow');

            jQuery(progress_bar).find('span').append('<span class="transx_progress_bar_marker">' + progress_bar_value + '%</span>');
        });
    }

    jQuery('.transx_mobile_menu_container .transx_mobile_menu li.menu-item-has-children > a').on('click', function () {
        jQuery(this).parent().toggleClass('open');
        jQuery(this).parent().children('.sub-menu').stop().slideToggle(300);
    });

    if (jQuery('nav').is('#quadmenu')) {
        if (window_width < 991) {
            let quadmenu = jQuery('#quadmenu').detach();

            jQuery('.transx_mobile_menu_container').prepend(quadmenu);
        }
    }

    if (jQuery('ul').is('.transx_main-menu')) {
        if (window_width < 991) {
            let main_menu = jQuery('.transx_main-menu');

            jQuery('.transx_mobile_menu_container').prepend(main_menu);
        }
    }

    jQuery('.transx_main-menu .menu-item-has-children').on('click', function () {
        jQuery(this).toggleClass('open');
    });

    if (window_width < 569) {
        jQuery('#wpadminbar').css('position', 'fixed');
    }

    jQuery('.transx_mobile_menu_container > ul > .menu-item-has-children > a').each(function () {
        jQuery(this).on('click', function (event) {
            event.preventDefault();
        });
    });

    jQuery('.widget select').wrap('<div class="transx_widget_select_wrapper"></div>');

    jQuery('.footer_widget .sb_instagram, .widget .sb_instagram').each(function () {
        let image_item = jQuery(this).find('.sbi_item'),
            image_width = jQuery(image_item).width();

        jQuery(image_item).height(image_width);
    });

    jQuery('.elementor-widget-html').each(function () {
        if (jQuery(this).find('.transx_truckload_type_select').length) {
            let select = jQuery(this).find('.transx_truckload_type_select');

            jQuery(select).on('click', function () {
                jQuery(this).toggleClass('open');
            });

            jQuery(select).find('.transx_option').on('click', function () {
                let value = jQuery(this).html();

                jQuery(this).parent().find('.selected').removeClass('selected');
                jQuery(this).parent().find('.focus').removeClass('focus');
                jQuery(this).addClass('selected focus');

                jQuery(this).parents('.transx_truckload_type_select').find('.transx_current').html(value);
            });
        }
    });

    jQuery('.transx_shortcodes_tabs_widget').each(function () {
        if (jQuery(this).find('.transx_truckload_type_select').length) {
            let select = jQuery(this).find('.transx_truckload_type_select');

            jQuery(select).on('click', function () {
                jQuery(this).toggleClass('open');
            });

            jQuery(select).find('.transx_option').on('click', function () {
                let value = jQuery(this).html();

                jQuery(this).parent().find('.selected').removeClass('selected');
                jQuery(this).parent().find('.focus').removeClass('focus');
                jQuery(this).addClass('selected focus');

                jQuery(this).parents('.transx_truckload_type_select').find('.transx_current').html(value);
            });
        }
    });

    jQuery('.elementor-section-full_width').each(function () {
        let container = jQuery(this),
            parent = container.parent(),
            window_width = jQuery(window).width(),
            parent_width = parent.width(),
            left = (window_width - parent_width) / 2;

        container.css('left', -left + 'px');
    });

    if (jQuery('.transx_front_about').length) {
        let container = jQuery('.transx_front_about'),
            window_width = jQuery(window).width();


        if (window_width > 1366) {
            let a = window_width - 1170,
                b = window_width - 1660,
                left = (a - b) / 2;

            container.css('left', -left + 'px');
        } else {
            let left = (window_width - 1170) / 2;

            container.css('left', -left + 'px');
        }
    }

    if (jQuery('.transx_about_video').length) {
        let container = jQuery('.transx_about_video').detach();

        jQuery('.transx_front_about').prepend(container);
    }

    // Back to Top
    var transx_scrollTrigger = 600, // px
        transx_backToTop = function () {
            var transx_scrollTop = jQuery(window).scrollTop();
            if (transx_scrollTop > transx_scrollTrigger) {
                jQuery('.transx_back_to_top_button').addClass('show');
            } else {
                jQuery('.transx_back_to_top_button').removeClass('show');
            }
        };
    transx_backToTop();
    jQuery(window).on('scroll', function () {
        transx_backToTop();
    });
    jQuery('.transx_back_to_top_button').on('click', function (e) {
        e.preventDefault();
        jQuery('html,body').animate({
            scrollTop: 0
        }, 200);
    });

    jQuery(".transx_owlCarousel").css("opacity", "1");
    jQuery(".transx_owlCarousel").owlCarousel(
        {
            items:1,
            lazyLoad:true,
            loop:true,
            dots:false,
            nav:true,
            navText:["", ""],
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            autoHeight:true
        }
    );

    let header_height = jQuery('header').innerHeight();

    jQuery('header').find('.transx_header_button_desktop').css('line-height', header_height + 'px');

    jQuery('.transx_header_search_button').on('click', function () {
        jQuery('.transx_header_search_overlay').addClass('visible');
        jQuery('.transx_header_search_container').addClass('active');
    });

    jQuery('.transx_header_search_overlay').on('click', function () {
        jQuery(this).removeClass('visible');
        jQuery('.transx_header_search_container').removeClass('active');
    });
});

// --------------------- //
// --- Window Resize --- //
// --------------------- //
jQuery(window).on('resize', function () {
    let window_width = jQuery(window).width();

    if (jQuery('nav').is('#quadmenu')) {
        if (window_width < 991) {
            let quadmenu = jQuery('#quadmenu').detach();

            jQuery('.transx_mobile_menu_container').prepend(quadmenu);
        } else {
            let quadmenu = jQuery('#quadmenu').detach();

            jQuery('.transx_main_menu_container').prepend(quadmenu);
        }
    }

    if (jQuery('ul').is('.transx_main-menu')) {
        if (window_width < 991) {
            let main_menu = jQuery('.transx_main-menu');

            jQuery('.transx_mobile_menu_container').prepend(main_menu);
        } else {
            let main_menu = jQuery('.transx_main-menu');

            jQuery('.transx_main_menu_container').prepend(main_menu);
        }
    }

    jQuery('.elementor-section-full_width').each(function () {
        let container = jQuery(this),
            parent = container.parent(),
            window_width = jQuery(window).width(),
            parent_width = parent.width(),
            left = (window_width - parent_width) / 2;

        container.css('left', -left + 'px');
    });

    if (jQuery('.transx_front_about').length) {
        let container = jQuery('.transx_front_about'),
            window_width = jQuery(window).width();


        if (window_width > 1366) {
            let a = window_width - 1170,
                b = window_width - 1660,
                left = (a - b) / 2;

            container.css('left', -left + 'px');
        } else {
            let left = (window_width - 1170) / 2;

            container.css('left', -left + 'px');
        }
    }

    let header_height = jQuery('header').innerHeight();

    jQuery('header').find('.transx_header_button_desktop').css('line-height', header_height + 'px');
});

// --------------------- //
// --- Window Scroll --- //
// --------------------- //
jQuery(window).on('scroll', function (e) {
    let header = jQuery('header'),
        scroll_position = jQuery(window).scrollTop();

    if (header.is('.transx_sticky_header_off')) {} else {
        if (scroll_position > 1) {
            let header_height = header.innerHeight();

            header.addClass('transx_page-header--fixed transx_visible_transparent_on_scroll');
            header.find('.transx_header_button_desktop').css('line-height', header_height + 'px');
        } else {
            setTimeout(function () {
                let header_height = header.innerHeight();

                header.find('.transx_header_button_desktop').css('line-height', header_height + 'px');
            }, 300);

            header.removeClass('transx_page-header--fixed transx_visible_transparent_on_scroll');
        }
    }
});

jQuery('a[href="#"]').on('click', function(event){
    event.preventDefault();
});

if (jQuery(window).width() < 737) {
    jQuery('.transx_hamburger').on('click', function () {
        jQuery(this).toggleClass('is-active');
        jQuery('.transx_aside-dropdown').toggleClass('transx_aside_dropdown_open');
    });

    jQuery('.transx_aside-dropdown__close').on('click', function () {
        jQuery(this).parents('.transx_aside-dropdown').removeClass('transx_aside_dropdown_open');
        jQuery('.transx_hamburger.is-active').removeClass('is-active');
    });
}

jQuery('.transx_sidebar .widget_nav_menu ul li.menu-item-has-children a').on('click', function () {
    jQuery(this).parent().toggleClass('open');
    jQuery(this).next().slideToggle(300);
});

jQuery('.footer_widget.widget_nav_menu ul li.menu-item-has-children a').on('click', function () {
    jQuery(this).parent().toggleClass('open');
    jQuery(this).next().slideToggle(300);
});
