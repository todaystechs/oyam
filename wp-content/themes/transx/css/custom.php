<?php
/*
 * Created by Artureanec
*/

global $transx_custom_css;
    // ---------------------- //
    // ------ Tag Line ------ //
    // ---------------------- //
    $transx_custom_css .= '
        .transx_page-header__top {
            font-family: ' . esc_attr(transx_get_theme_mod('tagline_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('tagline_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('tagline_line_height')) . ';
            font-weight: ' . esc_attr(transx_get_theme_mod('tagline_font_wight')) . ';
            text-transform: ' . (transx_get_theme_mod('tagline_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (transx_get_theme_mod('tagline_italic') == true ? 'italic' : 'normal') . ';
        }
        
        .transx_page-header__top .transx_header_socials li a {
            font-size: ' . esc_attr(transx_get_theme_mod('tagline_socials_font_size')) . ';
        }
    ';

    // -------------------- //
    // ------ Header ------ //
    // -------------------- //
    $transx_custom_css.= '
        
    
        header.transx_transparent_header_on .transx_dropdown-trigger__item,
        header.transx_transparent_header_on .transx_dropdown-trigger__item:after,
        header.transx_transparent_header_on .transx_dropdown-trigger__item:before {
            background: #ffffff;
        }
        
        header.transx_transparent_header_on .transx_dropdown-trigger:hover .transx_dropdown-trigger__item,
        header.transx_transparent_header_on .transx_dropdown-trigger:hover .transx_dropdown-trigger__item:after,
        header.transx_transparent_header_on .transx_dropdown-trigger:hover .transx_dropdown-trigger__item:before {
            background: #ffffff;
        }
        
        .transx_main-menu > li > a,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li > a,
        .quadmenu-navbar-nav > li > a,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li > a,
        .transx_mobile_menu_container ul.transx_mobile_menu > li a {
            font-family: ' . esc_attr(transx_get_theme_mod('header_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('header_menu_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('header_menu_line_height')) . ';
            font-weight: ' . esc_attr(transx_get_theme_mod('header_menu_font_weight')) . ';
            text-transform: ' . (transx_get_theme_mod('header_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (transx_get_theme_mod('header_menu_italic') == true ? 'italic' : 'normal') . ';
        }
        
        header.transx_transparent_header_on .transx_main-menu > li > a,
        header.transx_transparent_header_on .quadmenu-navbar-nav > li > a {
            color: ' . esc_attr(transx_get_theme_mod('transparent_header_menu_color')) . ';
        }
        
        header.transx_transparent_header_on .transx_main-menu > li:hover > a,
        header.transx_transparent_header_on .quadmenu-navbar-nav > li:hover > a,
        header.transx_transparent_header_on .transx_main-menu > li.current-menu-ancestor > a,
        header.transx_transparent_header_on .quadmenu-navbar-nav > li.current-menu-ancestor > a {
            color: ' . esc_attr(transx_get_theme_mod('transparent_header_menu_hover')) . ';
        }
        
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li:hover > a,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li:hover > a {
            color: ' . esc_attr(transx_get_theme_mod('header_menu_hover')) . ';
        }
        
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children > a:before,
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children > a:after,
        body header.transx_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        body header.transx_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after,
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children > a:before, 
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children > a:after {
            background: ' . esc_attr(transx_get_theme_mod('transparent_header_menu_color')) . ';
        }
        
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:before,
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:after,
        body header.transx_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children.current-menu-ancestor > a:before,
        body header.transx_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children.current-menu-ancestor > a:after,
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:before, 
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children.current-menu-ancestor > a:after {
            background: ' . esc_attr(transx_get_theme_mod('transparent_header_menu_hover')) . ';
        }
        
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children:hover > a:before,
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children:hover > a:after,
        body header.transx_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children:hover > a:before,
        body header.transx_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children:hover > a:after,
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children:hover > a:before, 
        header.transx_transparent_header_on .transx_main-menu > li.menu-item-has-children:hover > a:after {
            background: ' . esc_attr(transx_get_theme_mod('transparent_header_menu_hover')) . ';
        }
        
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:before,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:after,
        body header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        body header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:before,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:after,
        body header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        body header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:before, 
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children > a:after {
            background: ' . esc_attr(transx_get_theme_mod('header_menu_color')) . ';
        }
        
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children:hover > a:before,
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children:hover > a:after,
        body header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li.quadmenu-item-has-children:hover > a:before,
        body header.transx_transparent_header_on.transx_visible_transparent_on_scroll .quadmenu-navbar-nav > li.quadmenu-item-has-children:hover > a:after
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children:hover > a:before, 
        header.transx_transparent_header_on.transx_visible_transparent_on_scroll .transx_main-menu > li.menu-item-has-children:hover > a:after {
            background: ' . esc_attr(transx_get_theme_mod('header_menu_hover')) . ';
        }
        
        .transx_main-menu > li ul.sub-menu,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu {
            background: ' . esc_attr(transx_get_theme_mod('header_sub_menu_bg')) . ';
        }
        
        .transx_main-menu > li ul.sub-menu:before,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu:before {
            border-top-color: ' . esc_attr(transx_get_theme_mod('header_sub_menu_bg')) . ';
        }
        
        .transx_main-menu > li ul.sub-menu > li > a,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a,
        .transx_mobile_menu_container ul.transx_mobile_menu > li .sub-menu li a {
            font-family: ' . esc_attr(transx_get_theme_mod('header_sub_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('header_sub_menu_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('header_sub_menu_line_height')) . ';
            font-weight: ' . esc_attr(transx_get_theme_mod('header_sub_menu_font_weight')) . ';
            text-transform: ' . (transx_get_theme_mod('header_sub_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (transx_get_theme_mod('header_sub_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(transx_get_theme_mod('header_sub_menu_color')) . ';
        }
        
        .transx_main-menu > li ul.sub-menu > li > a:hover,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a:hover {
            color: ' . esc_attr(transx_get_theme_mod('header_sub_menu_hover')) . ';
        }
    ';

    // ------------------------ //
    // ------ Side Panel ------ //
    // ------------------------ //
    $transx_custom_css.= '
        .transx_aside-dropdown__inner {
            background: ' . esc_attr(transx_get_theme_mod('side_panel_bg')) . ';
            font-family: ' . esc_attr(transx_get_theme_mod('side_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('side_menu_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('side_menu_line_height')) . ';
            font-weight: ' . esc_attr(transx_get_theme_mod('side_menu_font_weight')) . ';
            text-transform: ' . (transx_get_theme_mod('side_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (transx_get_theme_mod('side_menu_italic') == true ? 'italic' : 'normal') . ';
        }
        
        .transx_aside-dropdown__close {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_close_color')) . ';
        }
        
        .transx_aside-dropdown__close:hover {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_close_hover')) . ';
        }
        
        .transx_aside-dropdown__inner .transx_aside-menu a {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_menu_color')) . ';
        }
        
        .transx_aside-dropdown__inner .transx_aside-menu a:hover {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_menu_hover')) . ';
        }
        
        .transx_aside-dropdown__inner .transx_aside-inner a {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_info_color')) . ';
        }
        
        .transx_aside-dropdown__inner .transx_aside-inner a:hover {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_info_hover')) . ';
        }
        
        body .transx_aside-dropdown__inner .transx_aside-socials a {
            font-size: ' . esc_attr(transx_get_theme_mod('side_panel_socials_size')) . ';
            color: ' . esc_attr(transx_get_theme_mod('side_panel_socials_color')) . ';
        }
        
        body .transx_aside-dropdown__inner .transx_aside-socials a:hover {
            color: ' . esc_attr(transx_get_theme_mod('side_panel_socials_hover')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('side_panel_socials_hover')) . ';
        }
    ';

    // ------------------------ //
    // ------ Typography ------ //
    // ------------------------ //
    if (transx_get_theme_mod('button_bg_color') !== '') {
        $button_bg_color = transx_get_theme_mod('button_bg_color');
    } else {
        $button_bg_color = 'transparent';
    }

    $transx_custom_css .= '
        body,
        body .elementor-widget-text-editor {
            font-family: ' . esc_attr(transx_get_theme_mod('main_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('main_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('main_line_height')) . ';
            font-weight: ' . esc_attr(transx_get_theme_mod('main_font_weight')) . ';
            color: ' . esc_attr(transx_get_theme_mod('main_font_color')) . ';
        }
        
        .transx_icon_box_item.transx_view_type_3 .transx_info_container,
        mark {
            color: ' . esc_attr(transx_get_theme_mod('main_font_color')) . ';
        }
        
        body .transx_content_wrapper .elementor-widget-text-editor {
            font-family: ' . esc_attr(transx_get_theme_mod('main_font_family')) . ', sans-serif;
        }
        
        .transx_button,
        .woocommerce .widget_price_filter .price_slider_amount .button,
        .woocommerce .widget_shopping_cart .buttons a,
        .woocommerce.widget_shopping_cart .buttons a {
            font-family: ' . esc_attr(transx_get_theme_mod('buttons_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('buttons_font_size')) . ';
            font-weight: ' . esc_attr(transx_get_theme_mod('buttons_font_weight')) . ';
            text-transform: ' . (transx_get_theme_mod('buttons_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (transx_get_theme_mod('buttons_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(transx_get_theme_mod('button_color')) . ';
            background: ' . esc_attr($button_bg_color) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('button_border_color')) . ';
        }
        
        .transx_button:hover,
        .wp-block-button__link:hover,
        .woocommerce .widget_price_filter .price_slider_amount .button:hover,
        .woocommerce .widget_shopping_cart .buttons a:hover,
        .woocommerce.widget_shopping_cart .buttons a:hover {
            color: ' . esc_attr(transx_get_theme_mod('button_hover')) . ';
            background: ' . esc_attr(transx_get_theme_mod('button_bg_hover')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('button_border_hover')) . ';
        }
        
        h1, h2, h3, h4, h5, h6,
        body .elementor-widget-heading .elementor-heading-title {
            font-family: ' . esc_attr(transx_get_theme_mod('headings_font_family')) . ', sans-serif;
            font-weight: ' . esc_attr(transx_get_theme_mod('headings_font_weight')) . ';
            text-transform: ' . (transx_get_theme_mod('headings_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (transx_get_theme_mod('headings_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(transx_get_theme_mod('headings_color')) . ';
        }
        
        h1,
        body .elementor-widget-heading h1.elementor-heading-title {
            font-size: ' . esc_attr(transx_get_theme_mod('h1_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('h1_line_height')) . ';
        }
        
        h2,
        body .elementor-widget-heading h2.elementor-heading-title {
            font-size: ' . esc_attr(transx_get_theme_mod('h2_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('h2_line_height')) . ';
        }
        
        h3,
        body .elementor-widget-heading h3.elementor-heading-title {
            font-size: ' . esc_attr(transx_get_theme_mod('h3_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('h3_line_height')) . ';
        }
        
        h4,
        body .elementor-widget-heading h4.elementor-heading-title {
            font-size: ' . esc_attr(transx_get_theme_mod('h4_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('h4_line_height')) . ';
        }
        
        h5,
        body .elementor-widget-heading h5.elementor-heading-title {
            font-size: ' . esc_attr(transx_get_theme_mod('h5_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('h5_line_height')) . ';
        }
        
        h6,
        body .elementor-widget-heading h6.elementor-heading-title {
            font-size: ' . esc_attr(transx_get_theme_mod('h6_font_size')) . ';
            line-height: ' . esc_attr(transx_get_theme_mod('h6_line_height')) . ';
        }
        
        b, 
        strong {
            color: ' . esc_attr(transx_get_theme_mod('headings_color')) . ';
        }
    ';

    // -------------------- //
    // ------ Footer ------ //
    // -------------------- //
    $transx_custom_css .= '
        .transx_footer_container {
            background-color: ' . esc_attr(transx_get_theme_mod('footer_bg')) . ';
        }
    
        .footer_widget {
            font-family: ' . esc_attr(transx_get_theme_mod('main_font_family')) . ', sans-serif;
        }
    ';

    // ------------------------ //
    // ------ Page Title ------ //
    // ------------------------ //
    $transx_custom_css .= '
        .transx_page_title_container {
            min-height: ' . absint(transx_get_theme_mod('title_height')) . 'px;
            background-color: ' . esc_attr(transx_get_theme_mod('post_title_bg_color')) . ';
            background-image: url("'. esc_url(transx_get_theme_mod('post_title_bg')) .'");
        }
        
        .transx_site_title_container {
            -webkit-text-stroke-color: rgba(' . transx_hex2rgb(esc_attr(transx_get_theme_mod('site_title_color'))) . ', .25);
            font-family: ' . esc_attr(transx_get_theme_mod('site_title_font_family')) . ', cursive;
            font-size: ' . esc_attr(transx_get_theme_mod('site_title_font_size')) . ';
        }
        
        .transx_page_title {
            color: ' . esc_attr(transx_get_theme_mod('page_title_color')) . ';
            font-family: ' . esc_attr(transx_get_theme_mod('page_title_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(transx_get_theme_mod('page_title_font_size')) . ';
        }
    ';

    // ------------------------- //
    // ------ Single Post ------ //
    // ------------------------- //
    $transx_custom_css .= '
        .transx_blog-post__socials a {
            color: ' . esc_attr(transx_get_theme_mod('post_socials_color')) . ';
        }
        
        .transx_blog-post__socials a:hover {
            color: ' . esc_attr(transx_get_theme_mod('post_socials_hover')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('post_socials_hover')) . ';
        }
        
        .form__field,
        .transx_sidebar .widget.widget_search .transx_icon_search,
        .transx_sidebar .widget.widget_categories select,
        body #give_checkout_user_info p input,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div p input[type="text"],
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div p input[type="email"],
        .wp-block-search input[type="search"],
        input[type="password"],
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        textarea,
        .transx_sidebar .widget_product_search input[type="search"],
        .transx_header_search_container .transx_icon_search {
            color: ' . esc_attr(transx_get_theme_mod('form_field_color')) . ';
            background: ' . esc_attr(transx_get_theme_mod('form_field_bg')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('form_field_border')) . ';
        }
        
        .form__field:focus,
        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        textarea:focus,
        body #give_checkout_user_info p input:focus {
            background: ' . esc_attr(transx_get_theme_mod('active_form_field_bg')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('active_form_field_border')) . ';
        }
        
        input[type="submit"],
        .wp-block-search button[type="submit"],
        #cancel-comment-reply-link {
            color: ' . esc_attr(transx_get_theme_mod('form_button_color')) . ';
            background: ' . esc_attr(transx_get_theme_mod('form_button_bg')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('form_button_border_color')) . ';
        }
        
        input[type="submit"]:hover,
        .wp-block-search button[type="submit"]:hover,
        #cancel-comment-reply-link:hover {
            color: ' . esc_attr(transx_get_theme_mod('form_button_hover')) . ';
            background: ' . esc_attr(transx_get_theme_mod('form_button_bg_hover')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('form_button_border_hover')) . ';
        }
        
        .footer_widget .mc4wp-form input[type="submit"]:hover {
            background: ' . esc_attr(transx_get_theme_mod('form_button_bg_hover')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('form_button_border_hover')) . ';
        }
        
        .transx_comments__item-name {
            color: ' . esc_attr(transx_get_theme_mod('headings_color')) . ';
        }
        
        .comment-respond .logged-in-as a {
            color: ' . esc_attr(transx_get_theme_mod('main_font_color')) . ';
        }
        
        .comment-respond .logged-in-as a:hover {
            color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        nody .transx_content_paging_wrapper .page-link span,
        body .transx_content_paging_wrapper .page-link a:hover,
        body .transx_pagination nav.pagination span.current,
        body .transx_pagination nav.pagination a:hover,
        body.woocommerce nav.woocommerce-pagination ul li span.current,
        body.woocommerce nav.woocommerce-pagination ul li a:hover {
            background: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
            border-color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
    ';

    // ---------------------------- //
    // ------ 404 Error Page ------ //
    // ---------------------------- //
    $transx_custom_css .= '
        .transx_404_error_container {
            background-image: url(' . esc_url(transx_get_theme_mod('404_bg_image')) . ');
            background-color: ' . esc_attr(transx_get_theme_mod('404_bg_color')) . ';
        }
    ';

    // ------------------------------------------ //
    // ------ TransX Widgets for Elementor ------ //
    // ------------------------------------------ //
    $transx_custom_css .= '
        .transx_standard_blog_listing .transx_category_container {
            background: #F36F8F;
        }
        
        .transx_info_field a,
        .transx_phone_item a,
        .transx_shortcodes_tabs_widget .transx_tabs_titles_container .transx_tab_title_item.active a {
            color: ' . esc_attr(transx_get_theme_mod('main_font_color')) . ';
        }
        
        body .transx_content_wrapper .elementor-widget-text-editor ul li,
        body .transx_content_wrapper .elementor-widget-text-editor ol li,
        body .elementor-widget-counter .elementor-counter-title,
        .transx_person_position,
        body .elementor-widget-progress .elementor-title,
        body .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title,
        body .transx_view_type_1 .elementor-alert .elementor-alert-title,
        body .transx_view_type_2 .elementor-alert .elementor-alert-title,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-content,
        .widget.widget_recent_entries .post-date {
            font-family: ' . esc_attr(transx_get_theme_mod('main_font_family')) . ', sans-serif;
        }
        
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-title a,
        body .elementor-widget-toggle .elementor-toggle .elementor-tab-title a,
        body .elementor-widget-accordion .elementor-active .elementor-accordion-icon, 
        body .elementor-widget-accordion .elementor-active a,
        body .elementor-widget-accordion .elementor-accordion-icon,
        body .elementor-widget-accordion a,
        .transx_causes_listing_wrapper .transx_post_title a,
        .transx_causes_slider_wrapper .transx_post_title a,
        .transx_content_slider_wrapper.transx_view_type_1 .transx_anchor,
        .transx_content_slider_wrapper.transx_view_type_2 .transx_anchor,
        .transx_content_slider_wrapper.transx_view_type_4 .transx_anchor,
        .transx_standard_blog_listing .transx_post_title a,
        body .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title,
        .transx_blockquote.transx_view_type_2,
        .transx_filter li a,
        .transx_blog_listing_date_box span,
        body .transx_calc_distance_container .irs-single,
        .transx_price_item .transx_custom_fields_container .transx_custom_field.transx_active_field,
        .transx_download_doc_widget.view_type_3 .transx_dd_title a,
        .transx_location_content_container .transx_location_title a,
        .transx_price_item .transx_price_wrapper,
        .gallery-masonry__description,
        .transx_testimonials_wrapper .transx_author_container,
        .transx_icon_box_item.transx_view_type_3 .transx_info_container {
            color: ' . esc_attr(transx_get_theme_mod('headings_color')) . ';
        }
        
        .transx_links_list li a:before {
            border-color: ' . esc_attr(transx_get_theme_mod('headings_color')) . ';
        }
        
        body .elementor-widget-counter .elementor-counter-number-wrapper,
        .transx_person_name,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-title,
        body .elementor-widget-toggle .elementor-toggle .elementor-tab-title,
        .transx_sidebar .widget.widget_categories ul li,
        .transx_sidebar .widget.widget_transx_categories_widget ul li,
        .transx_sidebar .widget.widget_recent_entries ul li,
        .transx_sidebar .widget.widget_archive ul li,
        .transx_sidebar .widget.widget_pages ul li,
        .transx_sidebar .widget.widget_meta ul li,
        .transx_sidebar .widget.widget_recent_comments ul li,
        .transx_sidebar .widget.widget_product_categories ul li,
        .transx_sidebar .widget.widget_layered_nav ul li,
        .transx_sidebar .widget.widget_rating_filter ul li,
        .transx_sidebar .recent-posts__item-link,
        body .elementor-widget-image-carousel .swiper-container .swiper-slide figure figcaption,
        .transx_tours_item_price,
        .transx_event_calendar_date span,
        .transx_calendar_item_time,
        .transx_price_item .transx_price_container .transx_price {
            font-family: ' . esc_attr(transx_get_theme_mod('headings_font_family')) . ', sans-serif;
        }
        
        body .transx_causes_slider_widget .transx_slider_nav_button,
        body .transx_testimonials_wrapper .transx_slider_nav_button,
        body .transx_content_slider_wrapper .transx_slider_nav_button,
        body .transx_donation_wrapper.view_type_1 .transx_donations_item_link,
        body .transx_donation_wrapper.view_type_1 .transx_donations_item_link:hover,
        body .transx_donation_wrapper.view_type_2 .transx_donations_item_link,
        body .transx_donation_wrapper.view_type_2 .transx_donations_item_link:hover,
        body .transx_events_listing_wrapper.view_type_2 .transx_event_item_link,
        body .transx_events_listing_wrapper.view_type_2 .transx_event_item_link:hover,
        body .transx_info_box_button,
        body .transx_info_box_button:hover {
            border-color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        .transx_causes_slider_widget .transx_slider_nav_button,
        .transx_testimonials_wrapper .transx_slider_nav_button,
        .transx_content_slider_wrapper .transx_slider_nav_button,
        .transx_blog_listing_widget .transx_post_title a,
        .transx_recent_posts_widget .transx_post_title a,
        .transx_sidebar .recent-posts__item-link,
        .transx_sidebar .widget.widget_categories ul li a,
        .transx_sidebar .widget.widget_transx_categories_widget ul li a,
        .transx_sidebar .widget.widget_recent_entries ul li a,
        .transx_sidebar .widget.widget_archive ul li a,
        .transx_sidebar .widget.widget_tag_cloud .tagcloud a,
        .transx_standard_blog_listing .transx_blog_listing_categories a,
        .footer_widget.widget_tag_cloud .tagcloud a,
        .transx_sidebar .widget.widget_pages ul li a,
        .transx_sidebar .widget.widget_meta ul li a,
        .transx_sidebar .widget.widget_recent_comments ul li a,
        .transx_sidebar .widget.widget_rss .widget_title a,
        .transx_sidebar .widget.widget_rss ul li a,
        .transx_sidebar .widget.widget_nav_menu ul li a,
        .transx_sidebar .widget.widget_product_categories ul li a,
        .transx_sidebar .widget.widget_layered_nav ul li a,
        .transx_sidebar .widget.widget_rating_filter ul li a,
        .transx_sidebar .widget_calendar table a,
        .transx_sidebar .widget_calendar nav a,
        .wp-block-archives-list li a,
        .wp-block-calendar table a,
        .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta a,
        .transx_events_wrapper .transx_event_title a,
        .transx_no_result_search_form .transx_icon_search,
        .wp-block-latest-comments .wp-block-latest-comments__comment a,
        .wp-block-latest-posts li a,
        .wp-block-rss li a,
        .page-link,
        .page-link a,
        .page-link:hover,
        .transx_page_content_container table td a,
        .transx_page_content_container table th a,
        .transx_blog_content_container table th a,
        .transx_sidebar .widget_calendar caption,
        .transx_event_listing_item_title a,
        .transx_event_listing_item_title a:hover,
        .transx_blog_listing_title a,
        .transx_donation_item_title a,
        .transx_blog_listing_title a:hover,
        .transx_donation_item_title a:hover,
        .wp-block-tag-cloud a,
        .transx_content_slider_wrapper.transx_view_type_1 .transx_additional_info {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_color')) . ';
        }
        
        .transx_causes_slider_widget .transx_slider_nav_button:hover,
        .transx_testimonials_wrapper .transx_slider_nav_button:hover,
        .transx_content_slider_wrapper .transx_slider_nav_button:hover,
        .transx_blog_listing_widget .transx_post_title a:hover,
        .transx_recent_posts_widget .transx_post_title a:hover,
        .transx_sidebar .recent-posts__item-link:hover,
        .transx_sidebar .widget.widget_categories ul li:hover,
        .transx_sidebar .widget.widget_transx_categories_widget ul li:hover,
        .transx_sidebar .widget.widget_categories ul li:hover a,
        .transx_sidebar .widget.widget_transx_categories_widget ul li:hover a,
        .transx_sidebar .widget.widget_categories ul li a:hover,
        .transx_sidebar .widget.widget_transx_categories_widget ul li a:hover,
        .transx_sidebar .widget.widget_recent_entries ul li a:hover,
        .transx_sidebar .widget.widget_archive ul li a:hover,
        .transx_sidebar .widget.widget_pages ul li a:hover,
        .transx_sidebar .widget.widget_meta ul li a:hover,
        .transx_sidebar .widget.widget_recent_comments ul li a:hover,
        .transx_sidebar .widget.widget_rss .widget_title a:hover,
        .transx_sidebar .widget.widget_rss ul li a:hover,
        .transx_sidebar .widget.widget_nav_menu ul li a:hover,
        .transx_sidebar .widget.widget_product_categories ul li a:hover,
        .transx_sidebar .widget.widget_layered_nav ul li a:hover,
        .transx_sidebar .widget.widget_rating_filter ul li a:hover,
        .transx_sidebar .widget_calendar table a:hover,
        .transx_sidebar .widget_calendar nav a:hover,
        .transx_events_wrapper .transx_event_title a:hover,
        .transx_causes_slider_wrapper.transx_view_type_3 .transx_slider_nav_button:hover,
        .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta a:hover,
        .wp-block-latest-comments .wp-block-latest-comments__comment a:hover,
        .wp-block-latest-posts li a:hover,
        .wp-block-rss li a:hover,
        .transx_sidebar .widget.widget_recent_comments ul li .comment-author-link a:hover {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_hover')) . ';
        }
        
        .transx_events_wrapper.transx_view_type_2 .transx_event_item .icon {
            stroke: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        .transx_standard_blog_listing .transx_standard_blog_item .transx_button:hover {
            background: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        .transx_sidebar .widget.widget_categories ul li:hover:before,
        .transx_sidebar .widget_product_categories ul li:hover:before,
        .transx_sidebar .widget_archive ul li:hover:before {
            border-color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
    ';

    // --------------------------- //
    // ------- WooCommerce ------- //
    // --------------------------- //
    $transx_custom_css .= '
        .transx_shop_loop select.orderby {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_color')) . ';
        }
        
        .transx_single_product_page .transx_page_title_container {
            background-color: ' . esc_attr(transx_get_theme_mod('post_title_bg_color')) . ';
            background-image: url("'. esc_url(transx_get_theme_mod('woo_title_bg_image')) .'"); 
        }
        
        .transx_single_product_page .price,
        .transx_single_product_page .transx_minus_button:hover,
        .transx_single_product_page .transx_plus_button:hover,
        .woocommerce-account .lost_password a:hover,
        .woocommerce div.product form.cart .reset_variations:hover,
        .transx_sidebar .widget.widget_rating_filter ul li a .star-rating span,
        .transx_sidebar .widget_products .star-rating span,
        .transx_sidebar .widget_top_rated_products .star-rating span,
        .transx_sidebar .widget_recent_reviews .star-rating span,
        .transx_sidebar .widget.widget_product_tag_cloud .tagcloud a:hover,
        .transx_single_product_page .product_meta span a:hover,
        .comment-form-cookies-consent input[type="checkbox"]:checked + label:before,
        .woocommerce-form-login__rememberme input[type="checkbox"]:checked + span:before {
            color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        .transx_header_cart .transx_header_cart_counter,
        .woocommerce .widget_price_filter .price_slider_amount .button:hover,
        .woocommerce .widget_shopping_cart .buttons a:hover,
        .woocommerce.widget_shopping_cart .buttons a:hover,
        /*.woocommerce ul.products li.product .button,
        .woocommerce ul.products li.product .added_to_cart,*/
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:before,
        #ebe9eb.woocommerce #respond input#submit, 
        .woocommerce #review_form #respond .form-submit input:hover,
        .woocommerce table.shop_table tbody td.actions .button:hover,
        .woocommerce-page .cart-collaterals .wc-proceed-to-checkout .button:hover,
        .woocommerce-checkout .checkout_coupon .button:hover,
        .woocommerce #payment #place_order:hover, 
        .woocommerce-page #payment #place_order:hover,
        .woocommerce .woocommerce-MyAccount-content button.button:hover,
        .woocommerce .woocommerce-form-login .button:hover,
        .woocommerce-MyAccount-content .edit:hover,
        .woocommerce .return-to-shop .button:hover,
        .woocommerce .woocommerce-message .button:hover,
        .woocommerce .woocommerce-Message .button:hover,
        .transx_single_product_page .transx_minus_button:hover:before,
        .transx_single_product_page .transx_plus_button:hover:before,
        .transx_single_product_page .transx_plus_button:hover:after,
        .woocommerce table.shop_table tbody .quantity .transx_minus_button:hover:before,
        .woocommerce table.shop_table tbody .quantity .transx_plus_button:hover:before,
        .woocommerce table.shop_table tbody .quantity .transx_plus_button:hover:after,
        .woocommerce .lost_reset_password .button:hover,
        .transx_sidebar .widget_product_categories a:after,
        body.transx_single_product_page.woocommerce div.product form.cart .button:hover {
            background: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        .transx_sidebar .widget.widget_product_tag_cloud .tagcloud a,
        .woocommerce ul.product_list_widget li a,
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--description table td,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-reply-title,
        .woocommerce-checkout .woocommerce-info a,
        .woocommerce-MyAccount-navigation ul li a,
        .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta .woocommerce-review__author {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_color')) . ';
        }
        
        .woocommerce ul.product_list_widget li a:hover {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_hover')) . ';
        }
        
        .woocommerce .widget_shopping_cart .cart_list li a.remove,
        .woocommerce.widget_shopping_cart .cart_list li a.remove {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_color')) . ' !important;
        }
        
        .woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
        .woocommerce.widget_shopping_cart .cart_list li a.remove:hover {
            color: ' . esc_attr(transx_get_theme_mod('listing_titles_hover')) . ' !important;
        }
        
        .woocommerce .widget_price_filter .price_slider_amount .button,
        .woocommerce .widget_shopping_cart .buttons a,
        .woocommerce.widget_shopping_cart .buttons a,
        body.woocommerce #review_form #respond .form-submit input,
        body .woocommerce table.shop_table tbody td.actions .button,
        body .woocommerce .cart-collaterals .wc-proceed-to-checkout .button,
        body.woocommerce-page .cart-collaterals .wc-proceed-to-checkout .button,
        body.woocommerce-checkout .checkout_coupon .button,
        body .woocommerce #payment #place_order, 
        body.woocommerce-page #payment #place_order,
        body .woocommerce .woocommerce-MyAccount-content button.button,
        body .woocommerce .woocommerce-form-login .button,
        body .woocommerce-MyAccount-content .edit,
        body .woocommerce .return-to-shop .button,
        body .woocommerce .woocommerce-message .button,
        body .woocommerce .woocommerce-Message .button,
        body.woocommerce .woocommerce-message .button,
        body .woocommerce .lost_reset_password .button,
        body.transx_single_product_page.woocommerce div.product form.cart .button,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .comment-form-cookies-consent input[type="checkbox"]:checked + label:before,
        .woocommerce-form-login__rememberme input[type="checkbox"]:checked + span:before {
            border-color: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
        
        .transx_single_product_page .product_meta span,
        .transx_single_product_page .product_meta span a,
        .woocommerce table.shop_table thead,
        .woocommerce table.shop_table tbody td.product-name a,
        .woocommerce table.shop_table tbody td.product-price,
        .woocommerce table.shop_table tbody td.product-subtotal,
        .woocommerce table.shop_table tbody td.actions .coupon label,
        .woocommerce .cart-collaterals table.shop_table th,
        .woocommerce-page .cart-collaterals table.shop_table th,
        .woocommerce .cart-collaterals table.shop_table td,
        .woocommerce-page .cart-collaterals table.shop_table td,
        .woocommerce-checkout .woocommerce table.shop_table tbody td,
        .woocommerce-checkout .woocommerce table.shop_table tfoot th,
        .woocommerce-checkout .woocommerce table.shop_table tfoot td,
        .woocommerce div.product form.cart .variations td.label,
        .woocommerce-MyAccount-content a,
        .woocommerce-account .lost_password a {
            color: ' . esc_attr(transx_get_theme_mod('headings_color')) . ';
        }
        
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews input,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews textarea {
            color: ' . esc_attr(transx_get_theme_mod('form_field_color')) . ';
            background: ' . esc_attr(transx_get_theme_mod('form_field_bg')) . ';
        }
        
        .woocommerce div.product p.price ins,
        .woocommerce div.product span.price ins {
            font-family: ' . esc_attr(transx_get_theme_mod('headings_font_family')) . ', sans-serif;
        }
        
        .transx_header_cart:hover .icon {
            stroke: ' . esc_attr(transx_get_theme_mod('main_color')) . ';
        }
    ';

