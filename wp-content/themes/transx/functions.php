<?php
/*
 * Created by Artureanec
*/

# General
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('post-formats', array('image', 'video'));

# Hex 2 RGB
if (!function_exists('transx_hex2rgb')) {
    function transx_hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return $r . "," . $g . "," . $b;
    }
}

# Custom get_theme_mod
if (!function_exists('transx_get_theme_mod')) {
    function transx_get_theme_mod($name) {
        if (func_num_args() > 1) {
            die(esc_html__('The transx_get_theme_mod("', 'transx') . $name . esc_html__('") function takes only one argument. Define default values in core/customizer.php.', 'transx'));
        }

        global $transx_customizer_default_values;

        if (!isset($transx_customizer_default_values[$name])) {
            die(esc_html__('Error! You did not add the default value for the "', 'transx') .$name. esc_html__('" option! core/customizer.php.', 'transx'));
        }
        return get_theme_mod($name, $transx_customizer_default_values[$name]);
    }
}

# ADD Localization Folder
add_action('after_setup_theme', 'transx_pomo');
if (!function_exists('transx_pomo')) {
    function transx_pomo()
    {
        load_theme_textdomain('transx', get_template_directory() . '/languages');
    }
}

require_once(get_template_directory() . "/core/init.php");

# Register CSS/JS
add_action('wp_enqueue_scripts', 'transx_css_js');
if (!function_exists('transx_css_js')) {
    function transx_css_js()
    {
        # CSS
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
        wp_enqueue_style('transx-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
        wp_enqueue_style('transx-theme', get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');

        if (class_exists('WooCommerce')) {
            wp_enqueue_style('transx-woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
        }

        # JS
        wp_enqueue_script('transx-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false	, true);
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', true, false, true);

        if (class_exists('WooCommerce')) {
            wp_enqueue_script('transx-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', true, false, true);
        }

        if (is_singular() && comments_open()) {
            wp_enqueue_script('comment-reply');
        }

        global $transx_custom_css;

        // --------------------- //
        // ------ General ------ //
        // --------------------- //
        if (transx_get_post_option('body_bg_type') == 'alt') {
            $transx_custom_css .= '
                .transx_page_content_wrapper,
                .transx_blog_content_wrapper {
                    background: ' . esc_attr(transx_get_post_option('body_alt_bg_color')) . ';
                }
            ';
        } else {
            $transx_custom_css .= '
                .transx_page_content_wrapper,
                .transx_blog_content_wrapper {
                    background: ' . esc_attr(transx_get_theme_mod('site_bg_color')) . ';
                }
            ';
        }

        // ------------------ //
        // ------ Logo ------ //
        // ------------------ //
        $transx_logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(transx_get_theme_mod('logo_image')));
        $transx_transparent_logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(transx_get_theme_mod('logo_transparent_image')));
        $transx_logo_width = (isset($transx_logo_metadata['width']) ? $transx_logo_metadata['width'] : '308');
        $transx_logo_height = (isset($transx_logo_metadata['height']) ? $transx_logo_metadata['height'] : '76');
        $transx_transparent_logo_width = (isset($transx_transparent_logo_metadata['width']) ? $transx_transparent_logo_metadata['width'] : '308');
        $transx_transparent_logo_height = (isset($transx_transparent_logo_metadata['height']) ? $transx_transparent_logo_metadata['height'] : '76');
        $transx_logo_url = transx_get_theme_mod('logo_image');
        $transx_transparent_logo_url = transx_get_theme_mod('logo_transparent_image');

        $transx_custom_css .= '
            header.transx_header .transx_logo,
            header.transx_header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_logo,
            .transx_preloader_logo {
                width: ' . absint($transx_logo_width) . 'px;
                height: ' . absint($transx_logo_height) . 'px;
                background: url("' . esc_url($transx_logo_url) . '") 0 0 no-repeat transparent;
                background-size: ' . absint($transx_logo_width) . 'px ' . absint($transx_logo_height) . 'px;
            }
            
            header.transx_header.transx_transparent_header_on .transx_logo,
            .footer_type_3 .transx_footer_logo {
                width: ' . absint($transx_transparent_logo_width) . 'px;
                height: ' . absint($transx_transparent_logo_height) . 'px;
                background: url("' . esc_url($transx_transparent_logo_url) . '") 0 0 no-repeat transparent;
                background-size: ' . absint($transx_transparent_logo_width) . 'px ' . absint($transx_transparent_logo_height) . 'px;
            }
            
            @media only screen and (max-width: 1025px) {
                header.transx_header .transx_logo,
                header.transx_header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_logo {
                    width: ' . absint($transx_logo_width - 5) . 'px;
                    height: ' . absint($transx_logo_height - 5) . 'px;
                    background-size: ' . absint($transx_logo_width - 5) . 'px ' . absint($transx_logo_height - 5) . 'px;
                }
            
                header.transx_header.transx_transparent_header_on .transx_logo,
                .footer_type_3 .transx_footer_logo {
                    width: ' . absint($transx_transparent_logo_width - 5) . 'px;
                    height: ' . absint($transx_transparent_logo_height - 5) . 'px;
                    background-size: ' . absint($transx_transparent_logo_width - 5) . 'px ' . absint($transx_transparent_logo_height - 5) . 'px;
                }
            }
        ';

        if (transx_get_theme_mod('logo_retina') == true) {
            $transx_logo_width = $transx_logo_width / 2;
            $transx_logo_height = $transx_logo_height / 2;
            $transx_transparent_logo_width = $transx_transparent_logo_width / 2;
            $transx_transparent_logo_height = $transx_transparent_logo_height / 2;

            $transx_custom_css .= '
                header.transx_header .transx_logo.transx_retina_on,
                header.transx_header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_logo.transx_retina_on,
                .transx_preloader_logo {
                    width: ' . absint($transx_logo_width) . 'px;
                    height: ' . absint($transx_logo_height) . 'px;
                    background-size: ' . absint($transx_logo_width) . 'px ' . absint($transx_logo_height) . 'px;
                }
                
                header.transx_header.transx_transparent_header_on .transx_logo.transx_retina_on,
                .footer_type_3 .transx_footer_logo.transx_retina_on {
                    width: ' . absint($transx_transparent_logo_width) . 'px;
                    height: ' . absint($transx_transparent_logo_height) . 'px;
                    background-size: ' . absint($transx_transparent_logo_width) . 'px ' . absint($transx_transparent_logo_height) . 'px;
                }
                
                @media only screen and (max-width: 1025px) {
                    header.transx_header .transx_logo.transx_retina_on,
                    header.transx_header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_logo.transx_retina_on {
                        width: ' . absint($transx_logo_width) . 'px;
                        height: ' . absint($transx_logo_height) . 'px;
                        background-size: ' . absint($transx_logo_width) . 'px ' . absint($transx_logo_height) . 'px;
                    }
                    
                    header.transx_header.transx_transparent_header_on .transx_logo.transx_retina_on,
                    .footer_type_3 .transx_footer_logo.transx_retina_on {
                        width: ' . absint($transx_transparent_logo_width) . 'px;
                        height: ' . absint($transx_transparent_logo_height) . 'px;
                        background-size: ' . absint($transx_transparent_logo_width) . 'px ' . absint($transx_transparent_logo_height) . 'px;
                    }
                }
            ';
        }

        // ---------------------- //
        // --- Default Colors --- //
        // ---------------------- //
        $transx_custom_css .= '
            .transx_header_button,
            .transx_alt_header_button {
                color: ' . esc_attr(transx_get_theme_mod('header_button_color')) . ';
                background: ' . esc_attr(transx_get_theme_mod('header_button_bg')) . ';
            }
            
            .transx_header_button:hover,
            .transx_alt_header_button:hover {
                color: ' . esc_attr(transx_get_theme_mod('header_button_hover')) . ';
                background: ' . esc_attr(transx_get_theme_mod('header_button_bg_hover')) . ';
            }
            
            .transx_page-header__top {
                background: ' . esc_attr(transx_get_theme_mod('tadline_bg')) . ';
                color: ' . esc_attr(transx_get_theme_mod('tagline_link_color')) . ';
            }
            
            .transx_page-header__top a,
            header.transx_transparent_header_on .transx_page-header__top a:hover {
                color: ' . esc_attr(transx_get_theme_mod('tagline_link_color')) . ';
            }
            
            .transx_page-header__top a:hover {
                color: ' . esc_attr(transx_get_theme_mod('tagline_link_hover')) . ';
            }
            
            .transx_page-header__top .transx_header_socials li a {
                font-size: ' . esc_attr(transx_get_theme_mod('tagline_socials_font_size')) . ';
                color: ' . esc_attr(transx_get_theme_mod('tagline_socials_color')) . ';
            }
            
            .transx_header,
            .transx_header.transx_transparent_header_on.transx_page-header--fixed {
                background: ' . esc_attr(transx_get_theme_mod('header_bg')) . ';
            }
            
            .transx_header.transx_transparent_header_on {
                background: transparent;
            }
            
            .transx_main-menu > li > a,
            header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li > a,
            .quadmenu-navbar-nav > li > a,
            header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li > a,
            .transx_mobile_menu_container ul.transx_mobile_menu > li a,
            .transx_page-header_4 .transx_tagline_phones_container a {
                color: ' . esc_attr(transx_get_theme_mod('header_menu_color')) . ';
            }
            
            header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:before, 
            header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:after {
                background: ' . esc_attr(transx_get_theme_mod('header_menu_color')) . ';
            }
            
            header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children:hover > a:before, 
            header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children:hover > a:after {
                background: ' . esc_attr(transx_get_theme_mod('header_menu_hover')) . ';
            }
            
            .transx_main-menu > li.menu-item-has-children > a:before,
            .transx_main-menu > li.menu-item-has-children > a:after,
            .transx_mobile_menu_container .transx_mobile_menu > li.menu-item-has-children > a:before,
            .transx_mobile_menu_container .transx_mobile_menu > li.menu-item-has-children > a:after,
            header.transx_transparent_header_on.transx_transparent_header_with_color .transx_main-menu > li.menu-item-has-children > a:before,
            header.transx_transparent_header_on.transx_transparent_header_with_color .transx_main-menu > li.menu-item-has-children > a:after,
            .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
            .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after,
            header.transx_transparent_header_on.transx_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
            header.transx_transparent_header_on.transx_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after {
                background: ' . esc_attr(transx_get_theme_mod('header_menu_color')) . ';
            }
            
            .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:before,
            .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:after,
            .transx_mobile_menu_container .transx_mobile_menu > li.menu-item-has-children.current-menu-ancestor > a:before,
            .transx_mobile_menu_container .transx_mobile_menu > li.menu-item-has-children.current-menu-ancestor > a:after,
            header.transx_transparent_header_on.transx_transparent_header_with_color .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:before,
            header.transx_transparent_header_on.transx_transparent_header_with_color .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:after,
            .quadmenu-navbar-nav > li.quadmenu-item-has-children.current-menu-ancestor > a:before,
            .quadmenu-navbar-nav > li.quadmenu-item-has-children.current-menu-ancestor > a:after,
            header.transx_transparent_header_on.transx_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children.current-menu-ancestor > a:before,
            header.transx_transparent_header_on.transx_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children.current-menu-ancestor > a:after {
                background: ' . esc_attr(transx_get_theme_mod('header_menu_hover')) . ';
            }
            
            .transx_main-menu > li:hover > a,
            .quadmenu-navbar-nav > li:hover > a,
            .transx_main-menu > li.current-menu-ancestor > a,
            .quadmenu-navbar-nav > li.current-menu-ancestor > a {
                color: ' . esc_attr(transx_get_theme_mod('header_menu_hover')) . ';
            }
            
            .transx_main-menu > li.menu-item-has-children:hover > a:before,
            .transx_main-menu > li.menu-item-has-children:hover > a:after {
                background: ' . esc_attr(transx_get_theme_mod('header_menu_hover')) . ';
            }
            
            .transx_main-menu > li:before,
            .quadmenu-navbar-nav > li:before,
            .transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li:before,
            .transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li:before,
            .transx_lower-menu li a:after,
            .transx_main-menu > li ul.sub-menu > li > a::after,
            .transx_mobile_menu > li ul.sub-menu > li > a::after,
            .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a:after {
                background: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            .transx_transparent_header_on .transx_main-menu > li:before,
            .transx_transparent_header_on .quadmenu-navbar-nav > li:before {
                background: #ffffff;
            }
            
            .footer_widget,
            .footer_widget a {
                color:  ' . esc_attr(transx_get_theme_mod('prefooter_color')) . ';
            }
            
            .footer_widget a:hover {
                color:  ' . esc_attr(transx_get_theme_mod('prefooter_hover')) . ';
            }
            
            .transx_footer-socials a,
            footer.transx_footer .transx_footer_socials a {
                color:  ' . esc_attr(transx_get_theme_mod('prefooter_socials')) . ';
            }
            
            .transx_footer-socials a:hover,
            footer.transx_footer .transx_footer_socials a:hover {
                color:  ' . esc_attr(transx_get_theme_mod('prefooter_socials_hover')) . ';
                border-color: ' . esc_attr(transx_get_theme_mod('prefooter_socials_hover')) . ';
            }
            
            .transx_footer_widget_title {
                color: ' . esc_attr(transx_get_theme_mod('prefooter_widget_title_color')) . ';
            }
            
            footer.transx_footer,
            footer.transx_footer a,
            .footer_widget.widget_custom_html .transx_footer_menu,
            .footer_widget.widget_custom_html a {
                color: ' . esc_attr(transx_get_theme_mod('footer_color')) . ';
            }
            
            footer.transx_footer a:hover,
            .footer_widget.widget_custom_html a:hover {
                color: ' . esc_attr(transx_get_theme_mod('footer_hover')) . ';
            }
        ';

        // ------------------ //
        // --- Main Color --- //
        // ------------------ //
        $transx_custom_css .= '
            a,
            a:hover,
            .transx_prefooter_type_2 .footer_widget:nth-of-type(3).widget_nav_menu ul.menu li a,
            .transx_footer_schedule li span:last-of-type,
            body .elementor-widget-text-editor.elementor-drop-cap-view-default .elementor-drop-cap,
            body .transx_content_wrapper .elementor-widget-text-editor ol li:before,
            .transx_person_socials li a:hover,
            body .transx_content_wrapper .elementor-widget-text-editor a:hover strong,
            body .transx_skills_info .elementor-widget-text-editor a:hover,
            .transx_testimonials_wrapper.transx_view_type_1 .transx_testimonials_icon,
            .transx_testimonials_wrapper.transx_view_type_2 .transx_testimonials_icon,
            .transx_testimonials_wrapper.transx_view_type_3 .transx_testimonials_icon,
            .transx_causes_slider_wrapper.transx_view_type_2 .transx_post_title a:hover,
            .transx_causes_grid_wrapper .projects-masonry__title a:hover,
            .transx_cause_item_wrapper .projects-masonry__title a:hover,
            .transx_events_listing_wrapper .icon,
            .transx_person_wrapper.transx_view_type_2 .transx_person_socials li a:hover,
            .transx_person_item_type_3 .transx_person_socials li a:hover,
            .transx_person_wrapper.transx_view_type_1 .transx_person_socials li a:hover,
            .transx_page_content_container table td a:hover,
            .transx_page_content_container table th a:hover,
            .transx_blog_content_container table th a:hover,
            .transx_sidebar .widget.widget_tag_cloud .tagcloud a:hover,
            .transx_standard_blog_listing .transx_blog_listing_categories a:hover,
            .transx_destination_widget .transx_destination_item:hover h6,
            .transx_tours_item_price,
            form.give-form .give-hidden:after, 
            form[id*=give-form] .give-hidden:after,
            #give-payment-mode-select .give-payment-mode-label:after,
            .transx_video_widget .transx_video_trigger_button:hover .transx_button_text,
            .transx_tabs_widget .transx_video_trigger_button:hover .transx_button_text,
            .transx_event_calendar_item.view_type_1 .transx_calendar_item:hover .transx_calendar_item_title a:hover,
            .transx_person_item_type_2:hover .transx_person_name,
            .transx_person_item_type_3:hover .transx_person_name,
            .transx_content_slider_wrapper .transx_additional_info a:hover,
            .transx_contacts_banner p a:hover,
            .transx_contacts_banner_mobile p a:hover,
            .transx_content_slider_wrapper .transx_socials_container li a:hover,
            .transx_content_slider_wrapper.transx_view_type_5 .transx_additional_info_container .transx_additional_info a,
            .transx_content_slider_wrapper.transx_view_type_5 .transx_additional_info_container .transx_additional_info a:hover,
            .transx_custom_products_list.view_type_2 .star-rating span:before,
            .wp-block-calendar .wp-calendar-nav a:hover,
            .transx_sidebar .widget_calendar nav a:hover,
            .transx_tours_carousel_widget .transx_tour_link,
            .woocommerce-checkout #payment .payment_method_paypal .about_paypal:hover,
            .woocommerce-page #payment .woocommerce-privacy-policy-text a:hover,
            .transx_sidebar .widget_calendar .wp-calendar-nav span.wp-calendar-nav-prev a:hover:before,
            .transx_sidebar .widget_calendar .wp-calendar-nav span.wp-calendar-nav-next a:hover:after,
            .wp-block-calendar .wp-calendar-nav span.wp-calendar-nav-prev a:hover:before,
            .wp-block-calendar .wp-calendar-nav span.wp-calendar-nav-next a:hover:after,
            .transx_aside-dropdown__inner .transx_aside_insta_container a:hover h3,
            .transx_page-header_4 .transx_tagline_phones_container a:hover,
            .transx_cart-trigger:hover .icon,
            .transx_post_details_tag_cont ul li:hover,
            .transx_post_details_tag_cont ul li:hover a,
            .transx_heading span,
            h1 span, body .elementor-widget-heading h1.elementor-heading-title span,
            h2 span, body .elementor-widget-heading h2.elementor-heading-title span,
            h3 span, body .elementor-widget-heading h3.elementor-heading-title span,
            h4 span, body .elementor-widget-heading h4.elementor-heading-title span,
            h5 span, body .elementor-widget-heading h5.elementor-heading-title span,
            h6 span, body .elementor-widget-heading h6.elementor-heading-title span,
            .transx_blockquote.transx_view_type_1:before,
            .transx_testimonials_wrapper.transx_view_type_1 .transx_author_container .transx_author_container_wrapper:before,
            .transx_testimonials_wrapper.transx_view_type_2 .transx_offset_container:before,
            .transx_testimonials_wrapper.transx_view_type_3 .transx_author_container_wrapper:before,
            .transx_icon_box_item .transx_icon_box_text,
            .transx_linked_item .transx_linked_item_counter,
            .transx_download_doc_widget.view_type_1 .transx_dd_link:hover,
            .transx_download_doc_widget.view_type_2 .transx_dd_link:hover,
            .transx_download_doc_widget.view_type_3 .transx_dd_title a:hover,
            .elementor-widget-image-box .elementor-image-box-title a:hover,
            .transx_links_list li a:hover,
            .transx_location_content_container .transx_location_title a:hover,
            .transx_phone_item a:hover,
            .transx_icon_box_item.transx_view_type_3 .transx_info_container a:hover,
            .transx_blog_listing_meta a:hover,
            .transx_blog_carousel_widget .transx_blog_title a:hover,
            .transx_content_slider_wrapper.transx_view_type_2 .transx_slider_counter .transx_all_slides,
            .transx_content_slider_wrapper .transx_additional_info a:hover,
            .transx_content_slider_wrapper.transx_view_type_1 .transx_additional_info a:hover,
            .footer_widget.widget_custom_html .transx_offices_list p a.transx_services_link,
            .footer_widget.widget_custom_html .transx_offices_list p a.transx_services_link:hover,
            .transx_standard_blog_listing .transx_blog_listing_tags a:hover,
            body ol.wp-block-latest-comments:not(.has-avatars) .wp-block-latest-comments__comment-author:hover,
            .wp-block-archives-list li a:hover,
            .wp-block-latest-posts li a:hover,
            .wp-block-rss li a:hover,
            .wp-block-calendar table td a:hover,
            .transx_back_to_top_button,
            .transx_post_meta_container a:hover,
            .transx_comments__item-action a:hover,
            .transx_comment_reply_cont a.comment-edit-link:hover,
            .transx_promo_box_item .transx_promo_box_content a:hover,
            .woocommerce ul.products li.product .button,
            .woocommerce ul.products li.product .added_to_cart {
                color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            .footer_widget.widget_nav_menu ul.menu li a:after,
            .transx_donate_box_item .transx_button:hover,
            .transx_price_item .transx_price_button_container .transx_button:hover,
            .transx_causes_listing_wrapper.transx_view_type_1 .transx_featured_image_container .transx_category_container,
            .transx_causes_listing_wrapper.transx_view_type_1 .transx_donate_button_container .transx_button:hover,
            .transx_causes_listing_wrapper.transx_view_type_2 .transx_category_container,
            .transx_causes_listing_wrapper.transx_view_type_3 .transx_category_container,
            body .transx_causes_slider_widget .transx_slider_nav_button:hover,
            body .transx_testimonials_wrapper .transx_slider_nav_button:hover,
            body .transx_content_slider_wrapper .transx_slider_nav_button:hover,
            .transx_causes_slider_wrapper.transx_view_type_1 .transx_donate_button_container .transx_button:hover,
            .transx_content_slider_wrapper .transx_button:hover,
            .transx_standard_blog_listing .transx_blog_listing_categories a,
            .transx_causes_grid_wrapper .projects-masonry__badge,
            .transx_cause_item_wrapper .projects-masonry__badge,
            .transx_events_listing_wrapper .upcoming-item__date,
            .transx_stories_wrapper .transx_button:hover,
            .transx_causes_slider_wrapper.transx_view_type_3 .transx_button:hover,
            .transx_sidebar .widget_calendar table td a:after,
            .wp-block-calendar table td a:after,
            .footer_widget.widget_calendar table td a:after,
            body .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet:hover:before,
            body .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
            .transx_testimonials_wrapper .slick-dots li.slick-active:before,
            .transx_slider_arrows .slick-dots li.slick-active:before,
            .transx_tours_item_link:after,
            .transx_filter li:after,
            .transx_event_date_box,
            .transx_blog_listing_date_box,
            body form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-before,
            .transx_up_heading_marker,
            .transx_tabs_widget .transx_video_trigger_button:hover .transx_button_icon,
            .transx_testimonials_wrapper.transx_view_type_1 .transx_testimonials_featured_image:after,
            .transx_testimonials_wrapper.transx_view_type_3 .transx_testimonials_featured_image:after,
            .transx_testimonials_wrapper.transx_view_type_2 .transx_testimonials_icon,
            .transx_testimonials_wrapper.transx_view_type_2:before,
            .transx_linked_icon_box_item,
            .transx_slider_arrows .slick-dots li:hover:before,
            .transx_about_donate a:after,
            .transx_content_slider_wrapper.transx_view_type_3 .transx_promo_video_container .transx_video_trigger i,
            .footer_widget .mc4wp-form input[type="submit"]:hover,
            .transx_content_slider_wrapper.transx_view_type_5 .transx_additional_info_container .transx_additional_info a:after,
            .transx_blog_carousel_widget .transx_tour_link:after,
            .transx_video_widget .view_type_2 .transx_video_trigger_button .transx_button_icon,
            .transx_custom_products_list.view_type_2 .transx_custom_product_image_cont .add_to_cart_button,
            .transx_mobile_menu_container .quadmenu-navbar-nav > li.current-menu-ancestor > a:after,
            .transx_mobile_menu_container .transx_main-menu > li.current-menu-ancestor > a:after,
            body .transx_causes_slider_widget .transx_button:hover,
            .transx_tours_carousel_widget .transx_tour_link:after,
            .transx_lower-menu li:after,
            .transx_aside-dropdown__inner .transx_aside-menu a:after,
            .transx_cart-trigger__count,
            .transx_testimonials_wrapper .slick-dots li.slick-active button,
            .transx_slider_arrows .slick-dots li.slick-active button,
            .transx_testimonials_wrapper .slick-dots li:hover button,
            .transx_slider_arrows .slick-dots li:hover button,
            body .transx_calc_distance_container .irs--flat .irs-bar,
            body .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet:before,
            .transx_tabs_titles_container .transx_tab_title_item:before,
            .transx_footer_menu_2 li a:after,
            .transx_back_to_top_button:hover,
            .transx_tagline_info_cont:before,
            .transx_tagline_socials_title:after,
            .transx_shipping_form_container input[type="submit"] {
                background: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            .transx_events_listing_wrapper .icon {
                stroke: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            .transx_neon_counter .elementor-counter-number-wrapper {
                -webkit-text-stroke: 2px ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            .transx_blockquote.transx_view_type_1 {
                border-left: solid 4px ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            body .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active,
            .transx_testimonials_wrapper .slick-dots li.slick-active,
            .transx_slider_arrows .slick-dots li.slick-active,
            body form[id*=give-form] #give-donation-level-radio-list li input[type="radio"]:checked + label:before,
            body form[id*=give-form] #give-gateway-radio-list li input[type="radio"]:checked + label:before,
            body form[id*=give-form] .give-donation-levels-wrap li input[type="radio"]:checked + label:before,
            body form[id*=give-form] .give-donation-levels-wrap + fieldset ul li input[type="radio"]:checked + label:before,
            body .transx_causes_slider_widget .transx_button,
            .footer_widget .mc4wp-form input[type="submit"],
            .footer_widget .mc4wp-form input[type="submit"]:hover,
            body .transx_video_widget .view_type_2 .transx_video_trigger_button .transx_button_icon,
            .transx_sidebar .widget_calendar table td#today:after,
            .wp-block-calendar table td#today:after,
            .footer_widget.widget_calendar table td#today:after,
            .transx_sidebar .widget_calendar table td a:after,
            .wp-block-calendar table td a:after,
            .footer_widget.widget_calendar table td a:after,
            body .transx_content_wrapper .elementor-widget-text-editor ul li:before,
            body .transx_content_wrapper .transx_location_item ul li:before,
            body .transx_refrigerate_option_container span:after,
            body .transx_price_item .transx_custom_fields_container .transx_custom_field:before,
            body .transx_content_wrapper .elementor-tab-content ul li:before,
            .transx_checkbox_label .transx_checkbox_mask:after,
            .wpcf7-checkbox label span:after,
            body .transx_content_paging_wrapper .page-link span, 
            body .transx_content_paging_wrapper .page-link a, 
            body .transx_pagination nav.pagination span, 
            body .transx_pagination nav.pagination a, 
            .woocommerce nav.woocommerce-pagination ul li a, 
            .woocommerce nav.woocommerce-pagination ul li span, 
            .woocommerce nav.woocommerce-pagination ul li span.current,
            body.woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--description ul li:before,
            body .transx_back_to_top_button,
            .transx_links_list li a:hover:before,
            body.woocommerce ul.products li.product .button,
            body.woocommerce ul.products li.product .added_to_cart {
                border-color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
            
            .transx_causes_slider_widget .transx_event_slider_item_wrapper:before {
                background: rgba(' . transx_hex2rgb(esc_attr(transx_get_theme_mod('main_color'))) . ', .2);
            }
            
            .transx_causes_slider_widget .transx_event_slider_item_wrapper:hover:before {
                background: rgba(' . transx_hex2rgb(esc_attr(transx_get_theme_mod('main_color'))) . ', .5);
            }
            
            body.woocommerce ul.products li.product .button:hover,
            body.woocommerce ul.products li.product .added_to_cart:hover {
                background-color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            }
        ';

        // -------------------------- //
        // ------ Main Color 2 ------ //
        // -------------------------- //
        $transx_custom_css .= '
            .recent_posts_post_meta span,
            .widget.widget_recent_entries .post-date,
            p a, 
            body .elementor p a,
            .transx_post_meta_container,
            .transx_post_meta_container a,
            .transx_comments__item-date,
            .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta time,
            .transx_blog_listing_meta,
            .transx_blog_listing_meta a,
            body .elementor-accordion .elementor-tab-title .elementor-accordion-icon .elementor-accordion-icon-closed,
            body .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon-opened,
            body .elementor-toggle .elementor-tab-title .elementor-toggle-icon .elementor-toggle-icon-closed,
            body .elementor-toggle .elementor-tab-title.elementor-active .elementor-toggle-icon-opened,
            body .elementor-widget-counter .elementor-counter-number-wrapper,
            .transx_icon_box_item.transx_view_type_3 .transx_icon_container {
                color: ' . esc_attr(transx_get_theme_mod('main_color_2')) . ';
            }
            
            .transx_blockquote.transx_view_type_2,
            .transx_post_cat_wrapper,
            body .transx_view_type_2 .elementor-accordion .elementor-tab-title.elementor-active span.elementor-accordion-icon-opened,
            body .transx_view_type_2 .elementor-toggle .elementor-tab-title.elementor-active span.elementor-toggle-icon-opened,
            .transx_content_slider_wrapper.transx_view_type_6 .transx_additional_info_container {
                background: ' . esc_attr(transx_get_theme_mod('main_color_2')) . ';
            }
            
            body .transx_view_type_2 .elementor-accordion .elementor-tab-title .elementor-accordion-icon .elementor-accordion-icon-closed,
            body .transx_view_type_2 .elementor-accordion .elementor-tab-title.elementor-active span.elementor-accordion-icon-opened,
            body .transx_view_type_2 .elementor-toggle .elementor-tab-title .elementor-toggle-icon .elementor-toggle-icon-closed,
            body .transx_view_type_2 .elementor-toggle .elementor-tab-title.elementor-active span.elementor-toggle-icon-opened,
            body .transx_icon_box_item.transx_view_type_3 .transx_icon_container {
                border-color: ' . esc_attr(transx_get_theme_mod('main_color_2')) . ';
            }
        ';

        // -------------------- //
        // ------ Footer ------ //
        // -------------------- //

        if (transx_get_post_option('bottom_image_type') == 'default') {
            if (transx_get_prefered_option('bottom_image_status') == 'show') {
                $transx_custom_css .= '
                    .transx_block_have_bg_image {
                        background-image: url(' . esc_url(transx_get_theme_mod('bottom_image')) . ');
                    }
                ';
            }
        } else {
            if (transx_get_prefered_option('bottom_image_status') == 'show') {
                if (transx_get_post_option('custom_bottom_image') !== false) {
                    foreach (transx_get_post_option('custom_bottom_image') as $key => $image) {
                        $transx_alt_footer_bg = $image['full_url'];
                    }
                } else {
                    $transx_alt_footer_bg = '';
                }
                $transx_custom_css .= '
                    .transx_block_have_bg_image {
                        background-image: url(' . $transx_alt_footer_bg . ');
                    }
                ';
            }
        }

        wp_add_inline_style('transx-theme', $transx_custom_css);
    }
}

# Register CSS/JS for Admin Settings
add_action('admin_enqueue_scripts', 'transx_admin_css_js');
if (!function_exists('transx_admin_css_js')) {
    function transx_admin_css_js()
    {
        # CSS
        wp_enqueue_style('transx-admin', get_template_directory_uri() . '/css/admin.css');
        # JS
        wp_enqueue_script('transx-admin', get_template_directory_uri() . '/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'), false, true);
    }
}

# Register Menu
add_action('init', 'transx_register_menu');
if (!function_exists('transx_register_menu')) {
    function transx_register_menu()
    {
        register_nav_menus(
            array(
                'main' => esc_attr__('Main menu', 'transx')
            )
        );

        register_nav_menus(
            array(
                'tagline_menu' => esc_attr__('Tagline menu', 'transx')
            )
        );

        register_nav_menus(
            array(
                'sidebar_menu' => esc_html__('Side Menu', 'transx')
            )
        );

        register_nav_menus(
            array(
                'footer_menu' => esc_html__('Footer Menu', 'transx')
            )
        );

        register_nav_menus(
            array(
                'footer_menu_2' => esc_html__('Footer Menu 2', 'transx')
            )
        );
    }
}


# Register Sidebars
add_action('widgets_init', 'transx_widgets_init');
if (!function_exists('transx_widgets_init')) {
    function transx_widgets_init()
    {
        register_sidebar(
            array(
                'name' => esc_attr__('Sidebar', 'transx'),
                'id' => 'sidebar',
                'description' => esc_attr__('Widgets in this area will be shown on all posts and pages.', 'transx'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 1', 'transx'),
                'id' => 'sidebar-footer',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'transx'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="transx_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 2', 'transx'),
                'id' => 'sidebar-footer-2',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'transx'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="transx_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 3', 'transx'),
                'id' => 'sidebar-footer-3',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'transx'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="transx_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 4', 'transx'),
                'id' => 'sidebar-footer-4',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'transx'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="transx_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        if (class_exists('WooCommerce')) {
            register_sidebar(
                array(
                    'name' => esc_attr__('Sidebar WooCommerce', 'transx'),
                    'id' => 'sidebar-woocommerce',
                    'description' => esc_attr__('Widgets in this area will be shown on Woocommerce Pages.', 'transx'),
                    'before_widget' => '<div id="%1$s" class="widget wooсommerce_widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h5 class="widget_title">',
                    'after_title' => '</h5>',
                )
            );
        }
    }
}

# RWMB check
if (!function_exists('transx_post_options')) {
    function transx_post_options()
    {
        if (class_exists('RWMB_Loader')) {
            return true;
        } else {
            return false;
        }
    }
}

# RWMB get option
if (!function_exists('transx_get_post_option')) {
    function transx_get_post_option($name, $default = false)
    {
        if (class_exists('RWMB_Loader')) {
            if (rwmb_meta($name)) {
                return rwmb_meta($name);
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

# Get Preffered Option
if (!function_exists('transx_get_prefered_option')) {
    function transx_get_prefered_option($name)
    {
        if (func_num_args() > 1) {
            die (esc_html__('The transx_get_prefered_option("', 'transx') . $name . esc_html__('") function may takes only one argument.', 'transx'));
        }

        global $transx_customizer_default_values;

        if (!isset($transx_customizer_default_values[$name])) {
            die (esc_html__('Error! You did not add the default value for the "', 'transx') . $name . esc_html__('" option! core/customizer.php.', 'transx'));
        }

        if (transx_get_post_option($name) && transx_get_post_option($name) !== 'default') {
            return transx_get_post_option($name, $transx_customizer_default_values[$name]);
        } else {
            return transx_get_theme_mod($name);
        }
    }
}

# Get Featured Image Url
if (!function_exists('transx_get_featured_image_url')) {
    function transx_get_featured_image_url()
    {
        $featured_image_full_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if (isset($featured_image_full_url[0]) && strlen($featured_image_full_url[0]) > 0) {
            return $featured_image_full_url[0];
        } else {
            return false;
        }
    }
}

if (!function_exists('transx_get_attachment_meta')) {
    function transx_get_attachment_meta($attachment_id)
    {
        $attachment = get_post($attachment_id);
        return array(
            'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink($attachment->ID),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );
    }
}

# PRE
if (!function_exists('transx_pre')) {
    function transx_pre($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}

# Admin Footer
add_filter('admin_footer', 'transx_admin_footer');
if (!function_exists('transx_admin_footer')) {
    function transx_admin_footer()
    {
        if (strlen(get_page_template_slug())>0) {
            echo "<input type='hidden' name='' value='" . (get_page_template_slug() ? get_page_template_slug() : '') . "' class='transx_this_template_file'>";
        }
    }
}

if (!function_exists('transx_remove_post_format_parameter')) {
    function transx_remove_post_format_parameter($url) {
        $url = remove_query_arg('post_format', $url);
        return $url;
    }
    add_filter('preview_post_link', 'transx_remove_post_format_parameter', 9999);
}

if (!function_exists('transx_objectToArray')) {
    function transx_objectToArray ($object) {
        if(!is_object($object) && !is_array($object))
            return $object;

        return array_map('transx_objectToArray', (array) $object);
    }
}

# Social Links Output
if (!function_exists('transx_socials_output')) {
    function transx_socials_output($container_class) {

        if (transx_get_theme_mod('socials_facebook') !== '' || transx_get_theme_mod('socials_twitter') !== '' || transx_get_theme_mod('socials_linkedin') !== '' || transx_get_theme_mod('socials_youtube') !== '' || transx_get_theme_mod('socials_instagram') !== '' || transx_get_theme_mod('socials_pinterest') !== '' || transx_get_theme_mod('socials_tumbl') !== '' || transx_get_theme_mod('socials_flickr') !== '' || transx_get_theme_mod('socials_vk') !== '' || transx_get_theme_mod('socials_dribbble') !== '' || transx_get_theme_mod('socials_vimeo') !== '' || transx_get_theme_mod('socials_500px') !== '' || transx_get_theme_mod('socials_xing') !== '') {

            $socials_output = '<ul class="' . $container_class . '">';

                if (transx_get_theme_mod('socials_target')) {
                    $socials_target = '_blank';
                } else {
                    $socials_target = '_self';
                }

                # YouTube
                if (transx_get_theme_mod('socials_youtube') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_youtube" href="' . esc_url(transx_get_theme_mod('socials_youtube')) . '" target="' . $socials_target . '">
                                <i class="fa fa-youtube-play"></i>
                            </a>
                        </li>
                    ';
                }

                # Facebook
                if (transx_get_theme_mod('socials_facebook') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_facebook" href="' . esc_url(transx_get_theme_mod('socials_facebook')) . '" target="' . $socials_target . '">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    ';
                }

                # Twitter
                if (transx_get_theme_mod('socials_twitter') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_twitter" href="' . esc_url(transx_get_theme_mod('socials_twitter')) . '" target="' . $socials_target . '">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                    ';
                }

                # LinkedIn
                if (transx_get_theme_mod('socials_linkedin') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_linkedin" href="' . esc_url(transx_get_theme_mod('socials_linkedin')) . '" target="' . $socials_target . '">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    ';
                }

                # Instagram
                if (transx_get_theme_mod('socials_instagram') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_instagram" href="' . esc_url(transx_get_theme_mod('socials_instagram')) . '" target="' . $socials_target . '">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    ';
                }

                # Pinterest
                if (transx_get_theme_mod('socials_pinterest') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_pinterest" href="' . esc_url(transx_get_theme_mod('socials_pinterest')) . '" target="' . $socials_target . '">
                                <i class="fa fa-pinterest-p"></i>
                            </a>
                        </li>
                    ';
                }

                # Tumblr
                if (transx_get_theme_mod('socials_tumbl') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_tumblr" href="' . esc_url(transx_get_theme_mod('socials_tumbl')) . '" target="' . $socials_target . '">
                                <i class="fa fa-tumblr"></i>
                            </a>
                        </li>
                    ';
                }

                # Flickr
                if (transx_get_theme_mod('socials_flickr') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_flickr" href="' . esc_url(transx_get_theme_mod('socials_flickr')) . '" target="' . $socials_target . '">
                                <i class="fa fa-flickr"></i>
                            </a>
                        </li>
                    ';
                }

                # VK
                if (transx_get_theme_mod('socials_vk') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_vk" href="' . esc_url(transx_get_theme_mod('socials_vk')) . '" target="' . $socials_target . '">
                                <i class="fa fa-vk"></i>
                            </a>
                        </li>
                    ';
                }

                # Dribbble
                if (transx_get_theme_mod('socials_dribbble') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_dribbble" href="' . esc_url(transx_get_theme_mod('socials_dribbble')) . '" target="' . $socials_target . '">
                                <i class="fa fa-dribbble"></i>
                            </a>
                        </li>
                    ';
                }

                # Vimeo
                if (transx_get_theme_mod('socials_vimeo') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_vimeo" href="' . esc_url(transx_get_theme_mod('socials_vimeo')) . '" target="' . $socials_target . '">
                                <i class="fa fa-vimeo"></i>
                            </a>
                        </li>
                    ';
                }

                # 500px
                if (transx_get_theme_mod('socials_500px') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_500px" href="' . esc_url(transx_get_theme_mod('socials_500px')) . '" target="' . $socials_target . '">
                                <i class="fa fa-500px"></i>
                            </a>
                        </li>
                    ';
                }

                # XING
                if (transx_get_theme_mod('socials_xing') !== '') {
                    $socials_output .= '
                        <li>
                            <a class="hs_xing" href="' . esc_url(transx_get_theme_mod('socials_xing')) . '" target="' . $socials_target . '">
                                <i class="fa fa-xing"></i>
                            </a>
                        </li>
                    ';
                }

            $socials_output .= '</ul>';

            return $socials_output;
        } else {
            return false;
        }
    }
}

if (!function_exists('transx_title')) {
    function transx_title($title) {
        $transx_words_array = explode(' ', $title);
        $transx_words = count($transx_words_array);
        $transx_different_words = floor($transx_words/2);

        $transx_temp = $transx_words - $transx_different_words;

        if ($transx_words !== 1) {
            $transx_words_array[$transx_temp] = "<span>".wp_kses($transx_words_array[$transx_temp], 'post');
            $transx_html = implode(" ", $transx_words_array)."</span>";
        } else {
            $transx_html = implode(" ", $transx_words_array);
        }

        return $transx_html;
    }
}

// Disable QuadMenu Styles
if (class_exists('QuadMenu')) {

    function transx_custom_dequeue() {
        wp_dequeue_style('quadmenu-normalize');
        wp_deregister_style('quadmenu-normalize');
        wp_dequeue_style('quadmenu-widgets');
        wp_deregister_style('quadmenu-widgets');
        wp_dequeue_style('quadmenu');
        wp_deregister_style('quadmenu');
        wp_dequeue_style('quadmenu-locations');
        wp_deregister_style('quadmenu-locations');
    }

    add_action('wp_enqueue_scripts', 'transx_custom_dequeue', 9999);
}

// Init Custom Widgets
if (function_exists('transx_add_custom_widget')) {
    transx_add_custom_widget('transx_socials_widget');
    transx_add_custom_widget('transx_address_widget');
    transx_add_custom_widget('transx_featured_posts_widget');
    transx_add_custom_widget('transx_working_hours_widget');
}

// Output Code
if (!function_exists('transx_output_code')) {
    function transx_output_code($code) {
        return $code;
    }
}

// Page Title Block
if (!function_exists('transx_page_title_block_output')) {
    function transx_page_title_block_output($transx_top_padding_class) {
        if (is_home() || is_archive() || is_tag() || is_search()) {
            if (class_exists('WooCommerce')) {
                if (is_woocommerce()) {
                    if (transx_get_post_option('page_title_image_type') == 'alt') {
                        if (transx_get_post_option('page_title_alt_image') !== false) {
                            foreach (transx_get_post_option('page_title_alt_image') as $key => $image) {
                                $data_bg_image = 'data-background="' . $image['full_url'] . '"';
                            }
                            $transx_js_bg_image_class = 'transx_js_bg_image';
                        } else {
                            if (transx_get_featured_image_url()) {
                                $transx_js_bg_image_class = 'transx_js_bg_image';
                                $data_bg_image = 'data-background="' . transx_get_featured_image_url() . '"';
                            } else {
                                $transx_js_bg_image_class = '';
                                $data_bg_image = '';
                            }
                        }
                    } else {
                        if (transx_get_featured_image_url()) {
                            if (is_product_category()) {
                                global $wp_query;
                                $cat = $wp_query->get_queried_object();
                                $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                                $thumbnail_url = wp_get_attachment_url($thumbnail_id);

                                $transx_js_bg_image_class = 'transx_js_bg_image';

                                if ($thumbnail_url !== false) {
                                    $data_bg_image = 'data-background="' . $thumbnail_url . '"';
                                } else {
                                    $data_bg_image = 'data-background="' . transx_get_theme_mod('woo_title_bg_image') . '"';
                                }
                            } else {
                                $transx_js_bg_image_class = 'transx_js_bg_image';
                                $data_bg_image = 'data-background="' . transx_get_featured_image_url() . '"';
                            }
                        } else {
                            $transx_js_bg_image_class = '';
                            $data_bg_image = '';
                        }
                    }
                } else {
                    $transx_js_bg_image_class = '';
                    $data_bg_image = '';
                }
            } else {
                $transx_js_bg_image_class = '';
                $data_bg_image = '';
            }
        } else {
            if (class_exists('WooCommerce')) {
                if (is_product()) {
                    $transx_js_bg_image_class = '';
                    $data_bg_image = '';
                } else {
                    if (transx_get_post_option('page_title_image_type') == 'alt') {
                        if (transx_get_post_option('page_title_alt_image') !== false) {
                            foreach (transx_get_post_option('page_title_alt_image') as $key => $image) {
                                $data_bg_image = 'data-background="' . $image['full_url'] . '"';
                            }
                            $transx_js_bg_image_class = 'transx_js_bg_image';
                        } else {
                            if (transx_get_featured_image_url()) {
                                $transx_js_bg_image_class = 'transx_js_bg_image';
                                $data_bg_image = 'data-background="' . transx_get_featured_image_url() . '"';
                            } else {
                                $transx_js_bg_image_class = '';
                                $data_bg_image = '';
                            }
                        }
                    } else {
                        if (transx_get_featured_image_url()) {
                            $transx_js_bg_image_class = 'transx_js_bg_image';
                            $data_bg_image = 'data-background="' . transx_get_featured_image_url() . '"';
                        } else {
                            $transx_js_bg_image_class = '';
                            $data_bg_image = '';
                        }
                    }
                }
            } else {
                if (transx_get_post_option('page_title_image_type') == 'alt') {
                    if (transx_get_post_option('page_title_alt_image') !== false) {
                        foreach (transx_get_post_option('page_title_alt_image') as $key => $image) {
                            $data_bg_image = 'data-background="' . $image['full_url'] . '"';
                        }
                        $transx_js_bg_image_class = 'transx_js_bg_image';
                    } else {
                        if (transx_get_featured_image_url()) {
                            $transx_js_bg_image_class = 'transx_js_bg_image';
                            $data_bg_image = 'data-background="' . transx_get_featured_image_url() . '"';
                        } else {
                            $transx_js_bg_image_class = '';
                            $data_bg_image = '';
                        }
                    }
                } else {
                    if (transx_get_featured_image_url()) {
                        $transx_js_bg_image_class = 'transx_js_bg_image';
                        $data_bg_image = 'data-background="' . transx_get_featured_image_url() . '"';
                    } else {
                        $transx_js_bg_image_class = '';
                        $data_bg_image = '';
                    }
                }
            }
        }

        if (transx_get_post_option('page_title_settings') == 'custom') {
            $transx_js_min_height_class = 'transx_js_min_height';
            $transx_js_bg_color_class = 'transx_js_bg_color';
            $data_min_height = 'data-min-height=' . esc_attr(absint(transx_get_post_option('title_height'))) . '';
            $data_bg_color = 'data-bg-color=' . esc_attr(transx_get_post_option('title_bg_color')) . '';
        } else {
            $transx_js_min_height_class = '';
            $transx_js_bg_color_class = '';
            $data_min_height = '';
            $data_bg_color = '';
        }

        $transx_title_block = '
            <div class="transx_page_title_container ' . esc_attr($transx_js_bg_image_class) . ' ' . esc_attr($transx_js_min_height_class) . ' ' . esc_attr($transx_js_bg_color_class) . ' ' . esc_attr($transx_top_padding_class) . '" ' . esc_attr($data_bg_image) . ' ' . esc_attr($data_min_height) . ' ' . esc_attr($data_bg_color) . '>
                <div class="container">
                    <div class="transx_page_title_wrapper">';

                        if (transx_get_prefered_option('site_title_status') == 'show') {
                            if (transx_get_theme_mod('site_title_type') == 'custom') {
                                $transx_title_block .= '
                                    <div class="transx_site_title_container">
                                        ' . esc_html(transx_get_theme_mod('alt_site_title')) . '
                                    </div>
                                ';
                            } else {
                                $transx_title_block .= '
                                    <div class="transx_site_title_container">
                                        ' . esc_html(get_bloginfo()) . '
                                    </div>
                                ';
                            }
                        }

                        if (class_exists('WooCommerce')) {
                            if (is_product()) {
                                if (transx_get_theme_mod('woo_prod_title') !== '') {
                                    $page_title = esc_html(transx_get_theme_mod('woo_prod_title'));
                                } else {
                                    $page_title = esc_html__('Product Single', 'transx');
                                }
                            } else {
                                if (is_home()) {
                                    $page_title = esc_html__('Home', 'transx');
                                } elseif (is_archive()) {
                                    if (is_tag()) {
                                        $page_title = esc_html__('Archive by Tag ', 'transx') . esc_html(single_tag_title('', false));
                                    } elseif (is_woocommerce()) {
                                        if (is_product_category()) {
                                            global $wp_query;
                                            $cat = $wp_query->get_queried_object();

                                            $page_title = esc_html__('Shop Category', 'transx') . ' ' . $cat->name;
                                        } else {
                                            $page_title = wp_kses(get_the_title(), 'post');
                                        }
                                    } else {
                                        $page_title = esc_html__('Archive', 'transx');
                                    }
                                } elseif (is_search()) {
                                    $page_title = esc_html__('Search Results By ', 'transx') . esc_html(get_search_query());
                                } else {
                                    $page_title = get_the_title();
                                }
                            }
                        } else {
                            if (is_home()) {
                                $page_title = esc_html__('Home', 'transx');
                            } elseif (is_archive()) {
                                if (is_tag()) {
                                    $page_title = esc_html__('Archive by Tag ', 'transx') . esc_html(single_tag_title('', false));
                                } else {
                                    $page_title = esc_html__('Archive', 'transx');
                                }
                            } elseif (is_search()) {
                                $page_title = esc_html__('Search Results By ', 'transx') . esc_html(get_search_query());
                            } else {
                                $page_title = wp_kses(get_the_title(), 'post');
                            }
                        }

                        if (get_the_title() !== '') {
                            $transx_title_block .= '
                                <h1 class="transx_page_title">' . transx_output_code($page_title) . '</h1>
                            ';
                        } else {
                            $transx_title_block .= '
                                <h1 class="transx_page_title">' . esc_html__('No Title Post', 'transx') . '</h1>
                            ';
                        }

                        $transx_title_block .= '
                    </div>
                </div>';

                if (transx_get_post_option('title_subtitle') !== '') {
                    $transx_title_block .= '
                        <div class="transx_page_subtitle">';
                            if (class_exists('WooCommerce')) {
                                if (is_product()) {
                                    $transx_title_block .= '
                                        <span>' . esc_html(transx_get_theme_mod('woo_prod_subtitle')) . '</span>
                                    ';
                                } else {
                                    $transx_title_block .= '
                                        <span>' . esc_html(transx_get_post_option('title_subtitle')) . '</span>
                                    ';
                                }
                            } else {
                                $transx_title_block .= '
                                    <span>' . esc_html(transx_get_post_option('title_subtitle')) . '</span>
                                ';
                            }

                            $transx_title_block .= '
                        </div>
                    ';
                }

                $transx_title_block .= '
            </div>
        ';

        return $transx_title_block;
    }
}

// Single Post Media Output
if (!function_exists('transx_post_media_output')) {
    function transx_post_media_output()
    {
        if (transx_post_options()) {
            if (!empty($args)) {
                extract($args);
            }

            $transx_post_format = get_post_format();
            if (empty($transx_post_format)) {
                $transx_post_format = 'standard';
            }

            $links = array_map(function ($category) {
                return sprintf(
                    '<a href="%s" class="link link_text">%s</a>',
                    esc_url(get_category_link($category)),
                    esc_html($category->name)
                );
            }, get_the_category());

            if ($transx_post_format == 'image') {
                if (is_array(transx_get_post_option('transx_pf_images'))) {
                    $transx_empty_class = '';
                } else {
                    $transx_empty_class = 'transx_media_output_empty';
                }
            }

            if ($transx_post_format == 'video') {
                if (transx_get_post_option('transx_pf_video_url') == '') {
                    $transx_empty_class = 'transx_media_output_empty';
                } else {
                    $transx_empty_class = '';
                }
            }

            if ($transx_post_format == 'standard') {
                if (transx_get_featured_image_url() !== false) {
                    $transx_empty_class = '';
                } else {
                    $transx_empty_class = 'transx_media_output_empty';
                }
            }

            $transx_media_output_code = '
                <div class="transx_media_output_container transx_post_format_' . esc_attr($transx_post_format) . ' ' . esc_attr($transx_empty_class) . '">';
                    if (transx_get_featured_image_url() !== false) {
                        $transx_media_output_code .= '
                            <div class="transx_post_cat_cont">
                                <div class="transx_post_cat_wrapper">' . implode(', ', $links) . '</div>
                            </div>
                        ';
                    }

                    // ------------------------- //
                    // --- Post Format Image --- //
                    // ------------------------- //
                    if ($transx_post_format == 'image') {
                        if (is_array(transx_get_post_option('transx_pf_images'))) {
                            $transx_media_output_code .= '
                                <div class="transx_media_output_wrapper">
                                    <div class="transx_owlCarousel owl-carousel owl-theme">';

                                        foreach (transx_get_post_option('transx_pf_images') as $key => $image) {
                                            if (transx_get_post_option('transx_pf_images_crop_status', 'yes') == 'yes') {
                                                if (function_exists('aq_resize')) {
                                                    $transx_media_output_code .= '<div class="item"><img src="' . aq_resize(esc_url($image['full_url']), transx_get_post_option('transx_pf_images_width', '1200'), transx_get_post_option('transx_pf_images_height', '738'), true, true, true) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                                } else {
                                                    $transx_media_output_code .= '<div><img src="' . esc_url($image['full_url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                                }
                                            } else {
                                                $transx_media_output_code .= '<div><img src="' . esc_url($image['full_url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                            }
                                        }

                                        $transx_media_output_code .='
                                    </div>
                                </div>
                            ';
                        } else {
                            $transx_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

                            if (function_exists('aq_resize')) {
                                $transx_media_output_code .= '<div class="transx_media_output_wrapper"><img class="transx_standard_featured_image" src="' . aq_resize(esc_url(transx_get_featured_image_url()), 1200, '') . '" alt="' . esc_attr($transx_alt_text) . '"></div>';
                            } else {
                                $transx_media_output_code .= '<div class="transx_media_output_wrapper"><img class="transx_standard_featured_image" src="' . esc_url(transx_get_featured_image_url()) . '" alt="' . esc_attr($transx_alt_text) . '"></div>';
                            }
                        }
                    }

                    // ------------------------- //
                    // --- Post Format Video --- //
                    // ------------------------- //
                    if ($transx_post_format == 'video') {
                        $transx_media_output_code .= '
                            <div class="transx_media_output_wrapper">
                                <div class="transx_post_format_video_container" style="height: ' . transx_get_post_option('transx_pf_video_height', '500') . 'px;">
                                    ' . transx_get_post_option('transx_pf_video_url') . '
                                </div>
                            </div>
                        ';
                    }

                    // ---------------------------- //
                    // --- Post Format Standard --- //
                    // ---------------------------- //
                    if ($transx_post_format == 'standard') {
                        $transx_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

                        if (transx_get_featured_image_url() !== false) {
                            if (function_exists('aq_resize')) {
                                $transx_media_output_code .= '<div class="transx_media_output_wrapper"><img class="transx_standard_featured_image" src="' . aq_resize(esc_url(transx_get_featured_image_url()), 1200, '', true, true, true) . '" alt="' . esc_attr($transx_alt_text) . '"></div>';
                            } else {
                                $transx_media_output_code .= '<div class="transx_media_output_wrapper"><img class="transx_standard_featured_image" src="' . esc_url(transx_get_featured_image_url()) . '" alt="' . esc_attr($transx_alt_text) . '"></div>';
                            }
                        }
                    }

                    $transx_media_output_code .= '
                </div>
            ';

            return $transx_media_output_code;
        } else {
            $transx_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
            $transx_post_format = get_post_format();
            if (empty($transx_post_format)) {
                $transx_post_format = 'standard';
            }

            $transx_media_output_code = '
                <div class="transx_media_output_container transx_post_format_' . esc_attr($transx_post_format) . '">';

                    if (transx_get_featured_image_url() !== false) {
                        if (transx_get_featured_image_url() !== false) {
                            if (function_exists('aq_resize')) {
                                $transx_media_output_code .= '<div class="transx_media_output_wrapper"><img class="transx_standard_featured_image" src="' . aq_resize(esc_url(transx_get_featured_image_url()), 1200, '', true, true, true) . '" alt="' . esc_attr($transx_alt_text) . '"></div>';
                            } else {
                                $transx_media_output_code .= '<div class="transx_media_output_wrapper"><img class="transx_standard_featured_image" src="' . esc_url(transx_get_featured_image_url()) . '" alt="' . esc_attr($transx_alt_text) . '"></div>';
                            }
                        }
                    }

                    $transx_media_output_code .= '
                </div>
            ';

            return $transx_media_output_code;
        }
    }
}

# Excerpt Truncate
if (!function_exists('transx_excerpt_truncate')) {
    function transx_excerpt_truncate($transx_string, $transx_length = 80, $transx_etc = '... ', $transx_break_words = false, $transx_middle = false)
    {
        if ($transx_length == 0)
            return '';

        if (mb_strlen($transx_string, 'utf8') > $transx_length) {
            $transx_length -= mb_strlen($transx_etc, 'utf8');
            if (!$transx_break_words && !$transx_middle) {
                $transx_string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($transx_string, 0, $transx_length + 1, 'utf8'));
            }
            if (!$transx_middle) {
                return mb_substr($transx_string, 0, $transx_length, 'utf8') . $transx_etc;
            } else {
                return mb_substr($transx_string, 0, $transx_length / 2, 'utf8') . $transx_etc . mb_substr($transx_string, -$transx_length / 2, utf8);
            }
        } else {
            return $transx_string;
        }
    }
}

// Custom Sort Fields in Comment Form
function transx_sort_comment_fields($fields){
    $new_fields = array();
    $myorder = array('author','email','comment');

    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }

    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;
    return $new_fields;
}
add_filter('comment_form_fields', 'transx_sort_comment_fields' );

// Recent Posts
if (!function_exists('transx_recent_posts_output')) {
    function transx_recent_posts_output($args = array('orderby' => 'rand', 'numberposts' => '2', 'post_type' => 'post', 'order' => 'desc', 'title' => 'You May Also Like', 'subtitle' => ''))
    {
        extract($args);

        $currentID = get_the_ID();
        $args = array(
            'post_type' => esc_attr($post_type),
            'post__not_in' => array($currentID),
            'post_status' => 'publish',
            'orderby' => esc_attr($orderby),
            'order' => esc_attr($order),
            'posts_per_page' => absint($numberposts),
            'ignore_sticky_posts' => 1
        );

        query_posts($args);

        if (have_posts()) {
            echo '
                <div class="transx_recent_posts_container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="transx_recent_posts_title_container">
                                    <span class="transx_recent_posts_subtitle">' . esc_html($subtitle) . '</span>
                                    <h3 class="transx_recent_posts_container_title">' . transx_title($title) . '</h3>
                                </div>
                                
                                <div class="transx_recent_posts_wrapper transx_columns_' . esc_attr($numberposts) . '">';

                                    while (have_posts()) {
                                        the_post();

                                        $featured_image_url = transx_get_featured_image_url();

                                        echo '
                                            <div class="transx_recent_post">
                                                <div class="transx_recent_post_wrapper">
                                                    <div class="transx_tours_item_img">
                                                        <img class="transx_img--bg" src="' . esc_url($featured_image_url) . '" alt="' . esc_html__('Featured Image', 'transx') . '" />
                                                    </div>
                                                    
                                                    <div class="transx_tours_item_details">
                                                        <h4 class="transx_tours_item_title">' . transx_title(get_the_title()) . '</h4>
                                                        
                                                        <div class="transx_tours_item_price">' . esc_html(transx_get_post_option('tour_price')) . '</div>
                                                        
                                                        <div class="transx_tours_item_info">' . esc_html(transx_get_post_option('tour_info')) . '</div>
                                                        
                                                        <a class="transx_tours_item_link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More', 'transx') . '</a>
                                                    </div>
                                                </div>
                                            </div>
                                        ';

                                    }

                                    wp_reset_query();

                                    echo '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    }
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function transx_pingback_header() {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url' )), '">';
    }
}
add_action('wp_head', 'transx_pingback_header');

# Shop Classes
if (!function_exists('transx_shop_classes')) {
    function transx_shop_classes($transx_classes)
    {

        if (class_exists('WooCommerce')) {
            if (is_shop()) {
                $transx_classes[] = 'transx_shop_list_page';
            } elseif (is_product()) {
                $transx_classes[] = 'transx_single_product_page';
            }
        }

        return $transx_classes;
    }
}

add_filter('body_class', 'transx_shop_classes');

# Post Classes
if (!function_exists('transx_post_classes')) {
    function transx_post_classes($transx_post_classes) {
        return $transx_post_classes;
    }
}

add_filter('post_class', 'transx_post_classes');

# WooCommerce
if (class_exists('WooCommerce')) {
    add_theme_support('woocommerce');
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-zoom' );

    # Update the Header Cart
    add_filter('woocommerce_add_to_cart_fragments', 'transx_header_add_to_cart_fragment');

    function transx_header_add_to_cart_fragment ($fragments) {
        ob_start();
        ?>

        <a class="transx_cart-trigger" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo ((WC()->cart->get_cart_contents_count() == 0) ? '' . esc_html__('Cart is empty', 'transx') . '' : '' . sprintf(_n('%s item', '%s items', WC()->cart->get_cart_contents_count(), 'transx'), WC()->cart->get_cart_contents_count()) . ''); ?>">
            <svg class="icon">
                <svg viewBox="-35 0 512 512.001" id="bag" xmlns="http://www.w3.org/2000/svg"><path d="M443.055 495.172L404.14 124.598c-.817-7.758-7.356-13.649-15.157-13.649h-73.14V94.273C315.844 42.293 273.55 0 221.57 0c-51.984 0-94.277 42.293-94.277 94.273v16.676h-73.14c-7.801 0-14.34 5.89-15.157 13.649L.082 495.172a15.263 15.263 0 003.832 11.789A15.25 15.25 0 0015.238 512h412.657c4.32 0 8.437-1.832 11.324-5.04a15.236 15.236 0 003.836-11.788zM157.77 94.273c0-35.175 28.62-63.796 63.8-63.796 35.176 0 63.797 28.62 63.797 63.796v16.676H157.77zM32.16 481.523l35.715-340.097h59.418v33.582c0 8.414 6.824 15.238 15.238 15.238s15.239-6.824 15.239-15.238v-33.582h127.597v33.582c0 8.414 6.824 15.238 15.238 15.238 8.415 0 15.239-6.824 15.239-15.238v-33.582h59.418l35.715 340.097zm0 0"/></svg>
            </svg>

            <?php
            if (WC()->cart->get_cart_contents_count() !== 0) {
                ?>
                <span class="transx_cart-trigger__count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                <?php
            } else {
                ?>
                <span class="transx_cart-trigger__count">0</span>
                <?php
            }
            ?>
        </a>

        <?php
        $fragments['a.transx_cart-trigger'] = ob_get_clean();

        return $fragments;
    }
}
