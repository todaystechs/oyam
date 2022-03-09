<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">

        <?php
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

        if (is_single()) {
            $excerpt = get_the_excerpt();
            $excerpt = substr($excerpt, 0, 160);
            $excerpt = substr($excerpt, 0, strrpos($excerpt, ' ')) . '...';
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>

        <!-- Facebook meta -->
        <meta property="og:title" content="<?php echo get_the_title(); ?>"/>
        <meta property="og:image" content="<?php echo esc_attr($thumbnail_src[0]); ?>"/>
        <meta property="og:description" content="<?php echo esc_attr($excerpt); ?>"/>
        <meta property="og:type" content="article" />

        <!-- Twitter meta -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:url" content="<?php echo get_permalink(); ?>" />
        <meta name="twitter:title" content="<?php echo get_the_title(); ?>" />
        <meta name="twitter:description" content="<?php echo esc_attr($excerpt); ?>" />
        <meta name="twitter:image" content="<?php echo esc_attr($thumbnail_src[0]); ?>" />

        <?php wp_head(); ?>
    </head>

    <?php
    if (!isset($content_width)) $content_width = 1200;
    ?>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>

        <!-- Preloader -->
        <?php
        if (transx_get_theme_mod('preloader') == 'show') {
            ?>
            <div class="transx_preloader_container">
                <div class="transx_preloader_logo"></div>
            </div>
            <?php
        }
        ?>

        <div class="transx_page-wrapper">

            <!-- Side Panel -->
            <div class="transx_aside-dropdown">
                <div class="transx_aside-dropdown__inner">
                    <span class="transx_aside-dropdown__close">
                        <svg class="icon">
                            <svg viewBox="0 0 47.971 47.971" id="close" xmlns="http://www.w3.org/2000/svg"><path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 000-4.242 2.998 2.998 0 00-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 00-4.242 0 2.998 2.998 0 000 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 104.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 000-4.242L28.228 23.986z"/></svg>
                        </svg>
                    </span>

                    <div class="transx_aside-dropdown__item transx_mobile_menu_container d-lg-none d-block"></div>

                    <?php
                    if (transx_get_theme_mod('side_panel') == 'on') {
                        ?>
                        <div class="transx_aside-dropdown__item">
                            <?php
                            $transx_menu_locations = get_nav_menu_locations();

                            if (isset($transx_menu_locations['sidebar_menu']) && $transx_menu_locations['sidebar_menu'] !== 0) {
                                wp_nav_menu(array('theme_location' => 'sidebar_menu', 'menu_class' => 'transx_aside-menu', 'depth' => '1', 'container' => ''));
                            }
                            ?>

                            <?php
                            if (transx_get_theme_mod('side_panel_info') == 'show') {
                                if (transx_get_theme_mod('tagline_email') !== '') {
                                    ?>
                                    <div class="transx_aside-inner">
                                        <span class="transx_aside-inner__title"><?php echo esc_html__('Email', 'transx') ?></span>

                                        <a class="transx_aside-inner__link" href="mailto:<?php echo esc_attr(transx_get_theme_mod('tagline_email')); ?>">
                                            <?php echo esc_html(transx_get_theme_mod('tagline_email')); ?>
                                        </a>
                                    </div>
                                    <?php
                                }

                                if (transx_get_theme_mod('tagline_phone_1') !== '' || transx_get_theme_mod('tagline_phone_2') !== '') {
                                    ?>
                                    <div class="transx_aside-inner">
                                        <?php
                                        if (transx_get_theme_mod('number_of_phones') == '2') {
                                            ?>
                                            <span class="transx_aside-inner__title">
                                            <?php echo esc_html__('Phone Numbers', 'transx'); ?>
                                        </span>

                                            <a class="transx_aside-inner__link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_1'))); ?>">
                                                <?php echo esc_html(transx_get_theme_mod('tagline_phone_1')); ?>
                                            </a>

                                            <a class="transx_aside-inner__link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_2'))); ?>">
                                                <?php echo esc_html(transx_get_theme_mod('tagline_phone_2')); ?>
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="transx_aside-inner__title">
                                            <?php echo esc_html__('Phone Number', 'transx'); ?>
                                        </span>

                                            <a class="transx_aside-inner__link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_1'))); ?>">
                                                <?php echo esc_html(transx_get_theme_mod('tagline_phone_1')); ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }

                            if (transx_get_theme_mod('side_panel_socials') == 'show') {
                                echo transx_socials_output('transx_aside-socials');
                            }
                            ?>
                        </div>

                        <?php
                        if (transx_get_theme_mod('side_panel_button') == 'show') {
                            ?>
                            <div class="transx_aside-dropdown__item">
                                <a href="<?php echo esc_url(transx_get_theme_mod('header_button_link')); ?>" class="transx_header_button transx_button--filled"><?php echo esc_html(transx_get_theme_mod('header_button_text')); ?></a>
                            </div>
                            <?php
                        }

                        if (transx_get_theme_mod('side_panel_instagram') == 'show' && transx_get_theme_mod('side_panel_insta_shortcode') !== '') {
                            ?>
                            <div class="transx_aside_insta_container">
                                <h4 class="transx_aside_insta_title"><?php echo esc_html__('Instagram', 'transx'); ?></h4>
                                <?php echo transx_output_code(do_shortcode(transx_get_theme_mod('side_panel_insta_shortcode'))); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Header -->
            <?php
            if (transx_get_prefered_option('header_style') == 'type_1') {
                $header_type_class = 'transx_page-header';
            }

            if (transx_get_prefered_option('header_style') == 'type_2') {
                $header_type_class = 'transx_page-header_2';
            }

            if (transx_get_prefered_option('header_style') == 'type_3') {
                $header_type_class = 'transx_page-header_3';
            }

            if (transx_get_prefered_option('header_style') == 'type_4') {
                $header_type_class = 'transx_page-header_4';
            }

            if (transx_get_prefered_option('header_style') == 'type_5') {
                $header_type_class = 'transx_shop-header';
            }

            if (transx_get_prefered_option('header_style') == 'type_6') {
                $header_type_class = 'transx_page-header_6';
            }

            if (transx_get_prefered_option('transparent_header') == 'off') {
                $transparent_header_class = 'transx_transparent_header_off';
            } else {
                $transparent_header_class = 'transx_transparent_header_on';
            }

            if (transx_get_prefered_option('sticky_header') !== 'off') {
                $sticky_header_class = '';
            } else {
                $sticky_header_class = 'transx_sticky_header_off';
            }

            $transx_menu_locations = get_nav_menu_locations();
            ?>

            <header class="transx_header <?php echo esc_attr($header_type_class); ?> <?php echo esc_attr($transparent_header_class); ?> <?php echo esc_attr($sticky_header_class); ?> transx_header_view_<?php echo esc_attr(transx_get_prefered_option('header_style')); ?> transx_tagline_<?php echo esc_attr(transx_get_prefered_option('header_tagline')); ?> transx_header_button_<?php echo esc_attr(transx_get_theme_mod('header_button')); ?> transx_side_panel_<?php echo esc_attr(transx_get_theme_mod('side_panel')); ?>">

                <!-- Tag Line -->
                <?php
                if (transx_get_prefered_option('header_style') == 'type_2' || transx_get_prefered_option('header_style') == 'type_6') {
                    if (transx_get_prefered_option('header_tagline') == 'on') {
                        ?>
                        <div class="transx_page-header__top d-none d-xl-block">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-xl-8">
                                        <?php
                                        if (transx_get_theme_mod('tagline_address') !== '') {
                                            ?>
                                            <span class="transx_tagline_info_cont transx_tagline_address_cont">
                                                <span class="transx_tagline_info_title"><?php echo esc_html__('Visit Us', 'transx'); ?>: </span>
                                                <?php echo esc_html(transx_get_theme_mod('tagline_address')); ?>
                                            </span>
                                            <?php
                                        }

                                        if (transx_get_theme_mod('tagline_phone_1') !== '' || transx_get_theme_mod('tagline_phone_2') !== '') {
                                            ?>
                                            <span class="transx_tagline_info_cont transx_tagline_phones_container">
                                                <span class="transx_tagline_info_title"><?php echo esc_html__('Call Us', 'transx'); ?>: </span>
                                                <?php
                                                if (transx_get_prefered_option('number_of_phones') == '2') {
                                                    ?>
                                                    <a class="transx_top_bar_link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_1'))); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_phone_1')); ?></a>
                                                    <a class="transx_top_bar_link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_2'))); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_phone_2')); ?></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="transx_top_bar_link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_1'))); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_phone_1')); ?></a>
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                            <?php
                                        }

                                        if (transx_get_theme_mod('tagline_email') !== '') {
                                            ?>
                                            <span class="transx_tagline_info_cont transx_tagline_email_container">
                                                <span class="transx_tagline_info_title"><?php echo esc_html__('Mail Us', 'transx'); ?>: </span>
                                                <a class="transx_top_bar_link" href="mailto:<?php echo esc_attr(transx_get_theme_mod('tagline_email')); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_email')); ?></a>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="col-xl-4 text-right">
                                        <?php
                                        if (transx_get_prefered_option('header_style') == 'type_2') {
                                            ?>
                                            <span class="transx_tagline_socials_title"><?php echo esc_html__('Follow Us', 'transx'); ?>: </span>
                                            <?php
                                            echo transx_socials_output('transx_tagline_socials list--reset');
                                        } else {
                                            $transx_menu_locations = get_nav_menu_locations();

                                            if (transx_get_theme_mod('tagline_menu') == 'on') {
                                                if (isset($transx_menu_locations['tagline_menu']) && $transx_menu_locations['tagline_menu'] !== 0) {
                                                    wp_nav_menu(array('theme_location' => 'tagline_menu', 'menu_class' => 'transx_lower-menu list--reset', 'depth' => '1', 'container' => ''));
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                // Header
                if (transx_get_prefered_option('header_style') == 'type_2' ||
                    transx_get_prefered_option('header_style') == 'type_5' ||
                    transx_get_prefered_option('header_style') == 'type_6') {
                    ?>
                    <div class="transx_page-header__lower">
                        <?php
                        }

                        ?>
                        <div class="container-fluid">
                            <div class="row align-items-center">

                                <?php
                                // ----------------------- //
                                // ------ Logo Part ------ //
                                // ----------------------- //
                                if (transx_get_prefered_option('header_style') == 'type_5') {
                                    $transx_logo_container_class = 'col-7 col-md-6 col-lg-3 d-flex align-items-center';
                                } else {
                                    $transx_logo_container_class = 'col-8 col-md-6 col-lg-3 d-flex align-items-center';
                                }
                                ?>

                                <div class="<?php echo esc_attr($transx_logo_container_class); ?>">
                                    <?php
                                    if (transx_get_theme_mod('side_panel') == 'on') {
                                        ?>
                                        <div class="transx_side_panel_button transx_dropdown-trigger d-none d-md-inline-block">
                                            <div class="transx_side_panel_button_point transx_point_1"></div>
                                            <div class="transx_side_panel_button_point transx_point_2"></div>
                                            <div class="transx_side_panel_button_point transx_point_3"></div>
                                            <div class="transx_side_panel_button_point transx_point_4"></div>
                                            <div class="transx_side_panel_button_point transx_point_5"></div>
                                            <div class="transx_side_panel_button_point transx_point_6"></div>
                                            <div class="transx_side_panel_button_point transx_point_7"></div>
                                            <div class="transx_side_panel_button_point transx_point_8"></div>
                                            <div class="transx_side_panel_button_point transx_point_9"></div>
                                        </div>
                                        <?php
                                    }

                                    if (transx_get_theme_mod('logo_retina') == true) {
                                        $transx_retina_class = 'transx_retina_on';
                                    } else {
                                        $transx_retina_class = 'transx_retina_off';
                                    }
                                    ?>
                                    <a class="transx_logo <?php echo esc_attr($transx_retina_class); ?>" href="<?php echo esc_url(home_url('/')); ?>"></a>
                                </div>

                                <?php
                                // ----------------------- //
                                // ------ Menu Part ------ //
                                // ----------------------- //
                                if (transx_get_prefered_option('header_style') == 'type_2') {
                                    $transx_main_menu_container_class = 'col-lg-5 d-none d-lg-block';
                                } elseif (transx_get_prefered_option('header_style') == 'type_4') {
                                    $transx_main_menu_container_class = 'col-lg-4 d-none d-lg-block transx_z_index_10';
                                } elseif (transx_get_prefered_option('header_style') == 'type_1') {
                                    if (transx_get_theme_mod('header_button') == 'on') {
                                        $transx_main_menu_container_class = 'col-lg-5 d-none d-lg-flex justify-content-center';
                                    } else {
                                        $transx_main_menu_container_class = 'col-lg-9 d-none d-lg-flex justify-content-center';
                                    }
                                } elseif (transx_get_prefered_option('header_style') == 'type_6') {
                                    $transx_main_menu_container_class = 'col-lg-6 d-none d-lg-flex justify-content-center';
                                } else {
                                    $transx_main_menu_container_class = 'col-lg-5 d-none d-lg-flex justify-content-center';
                                }
                                ?>

                                <div class="<?php echo esc_attr($transx_main_menu_container_class); ?>">
                                    <div class="transx_main_menu_container">
                                        <?php
                                        if (isset($transx_menu_locations['main']) && $transx_menu_locations['main'] !== 0) {
                                            wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'transx_main-menu', 'depth' => '3', 'container' => ''));
                                        } else {
                                            if (current_user_can('manage_options')) {
                                                echo '<div class="transx_menu_notify">' . esc_html__('Please create and select menu in Appearance (Menus)', 'transx') . ' <a href="'.get_admin_url(null, 'nav-menus.php').'"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <?php
                                // ------------------------- //
                                // ------ Button Part ------ //
                                // ------------------------- //
                                if (transx_get_prefered_option('header_style') == 'type_4') {
                                    $transx_header_button_container_class = 'col-4 col-md-6 col-lg-5 d-flex justify-content-end align-items-center';
                                } elseif (transx_get_prefered_option('header_style') == 'type_6') {
                                    $transx_header_button_container_class = 'col-4 col-md-6 col-lg-3 d-flex justify-content-end align-items-center';
                                } else {
                                    $transx_header_button_container_class = 'col-4 col-md-6 col-lg-4 d-flex justify-content-end align-items-center';
                                }
                                ?>

                                <div class="<?php echo esc_attr($transx_header_button_container_class); ?>">
                                    <?php
                                    if (transx_get_prefered_option('header_style') == 'type_4') {
                                        if (transx_get_theme_mod('tagline_phone_1') !== '' || transx_get_theme_mod('tagline_phone_2') !== '') {
                                            ?>
                                            <span class="transx_tagline_phones_container">
                                                <span class="transx_tagline_phone_marker_cont">
                                                    <span class="transx_tagline_phone_marker">
                                                        <svg class="icon">
                                                                <svg viewBox="0 0 384 384" class="svg_phone" xmlns="http://www.w3.org/2000/svg"><path d="M353.188 252.052c-23.51 0-46.594-3.677-68.469-10.906-10.906-3.719-23.323-.833-30.438 6.417l-43.177 32.594c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208 11.167-20.198 7.635-31.448-7.26-21.99-10.948-45.063-10.948-68.583C132.146 13.823 118.323 0 101.333 0H30.812C13.823 0 0 13.823 0 30.812 0 225.563 158.438 384 353.188 384c16.99 0 30.813-13.823 30.813-30.813v-70.323c-.001-16.989-13.824-30.812-30.813-30.812zm9.479 101.136c0 5.229-4.25 9.479-9.479 9.479-182.99 0-331.854-148.865-331.854-331.854 0-5.229 4.25-9.479 9.479-9.479h70.521c5.229 0 9.479 4.25 9.479 9.479 0 25.802 4.052 51.125 11.979 75.115 1.104 3.542.208 7.208-3.375 10.938L82.75 165.427a10.674 10.674 0 00-1 11.26c29.927 58.823 66.292 95.188 125.531 125.542 3.604 1.885 8.021 1.49 11.292-.979l49.677-37.635a9.414 9.414 0 019.667-2.25c24.156 7.979 49.479 12.021 75.271 12.021 5.229 0 9.479 4.25 9.479 9.479v70.323z"/></svg>
                                                            </svg>
                                                    </span>
                                                </span>

                                                <span class="transx_tagline_phones_cont">
                                                    <span class="transx_tagline_phone_title"><?php echo esc_html__('Have any Questions?', 'transx'); ?></span>

                                                    <?php
                                                    if (transx_get_prefered_option('number_of_phones') == '2') {
                                                        ?>
                                                        <a class="transx_top_bar_link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_1'))); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_phone_1')); ?></a>
                                                        <a class="transx_top_bar_link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_2'))); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_phone_2')); ?></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a class="transx_top_bar_link" href="tel:<?php echo esc_attr(str_replace(' ', '', transx_get_theme_mod('tagline_phone_1'))); ?>"><?php echo esc_html(transx_get_theme_mod('tagline_phone_1')); ?></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </span>
                                            </span>
                                            <?php
                                        }
                                    }

                                    if (class_exists('WooCommerce')) {
                                        if (is_shop() || is_product() || transx_get_prefered_option('header_cart_status') == 'show') {
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
                                        }
                                    }

                                    if (transx_get_theme_mod('header_button') == 'on') {
                                        if (transx_get_prefered_option('header_style') == 'type_1' ||
                                            transx_get_prefered_option('header_style') == 'type_4' ||
                                            transx_get_prefered_option('header_style') == 'type_6') {
                                            ?>
                                            <div class="transx_header_button transx_button--filled">
                                                <a href="<?php echo esc_url(transx_get_theme_mod('header_button_link')); ?>" class="transx_alt_header_button transx_header_button_mobile"><?php echo esc_html(transx_get_theme_mod('header_button_text')); ?></a>

                                                <?php
                                                if (transx_get_prefered_option('header_style') == 'type_6' && transx_get_prefered_option('header_tagline') == 'on') {
                                                    ?>
                                                    <a href="<?php echo esc_url(transx_get_theme_mod('header_button_link')); ?>" class="transx_alt_header_button"><?php echo esc_html(transx_get_theme_mod('header_button_text')); ?></a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?php echo esc_url(transx_get_theme_mod('header_button_link')); ?>" class="transx_header_button transx_button--filled"><?php echo esc_html(transx_get_theme_mod('header_button_text')); ?></a>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="transx_hamburger transx_dropdown-trigger d-inline-block d-md-none <?php echo ((transx_get_theme_mod('side_panel') == 'off') ? 'transx_side_panel_off' : ''); ?>">
                                        <div class="transx_hamburger-inner"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (transx_get_prefered_option('header_style') == 'type_2' ||
                            transx_get_prefered_option('header_style') == 'type_5' ||
                            transx_get_prefered_option('header_style') == 'type_6') {
                        ?>
                    </div>
                    <?php
                }

                    if (transx_get_theme_mod('header_button') == 'on') {
                        if (transx_get_prefered_option('header_style') !== 'type_2' || transx_get_prefered_option('header_style') == 'type_6') {
                            if (transx_get_prefered_option('header_tagline') !== 'on') {
                                ?>
                                <a href="<?php echo esc_url(transx_get_theme_mod('header_button_link')); ?>" class="transx_alt_header_button transx_header_button_desktop"><?php echo esc_html(transx_get_theme_mod('header_button_text')); ?></a>
                                <?php
                            } else {
                                if (transx_get_prefered_option('header_style') == 'type_2' ||
                                    transx_get_prefered_option('header_style') == 'type_3' ||
                                    transx_get_prefered_option('header_style') == 'type_5') {
                                    echo 'Yes <br>';
                                    ?>
                                    <a href="<?php echo esc_url(transx_get_theme_mod('header_button_link')); ?>" class="transx_alt_header_button transx_header_button_desktop"><?php echo esc_html(transx_get_theme_mod('header_button_text')); ?></a>
                                    <?php
                                }
                            }
                        }
                    }

                    if (transx_get_prefered_option('header_search') == 'show') {
                        ?>
                        <div class="transx_header_search_button">
                            <svg class="icon">
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.19 0a8.19 8.19 0 016.47 13.212l5.04 5.04a1.024 1.024 0 11-1.448 1.448l-5.04-5.04A8.19 8.19 0 118.19 0zm0 2.048a6.143 6.143 0 100 12.285 6.143 6.143 0 000-12.285z"/></svg>
                            </svg>
                        </div>
                        <?php
                    }
                ?>
            </header>

            <?php
            if (transx_get_prefered_option('header_search') == 'show') {
                $header_search_rand = mt_rand(0, 999);
                ?>
                <div class="transx_header_search_overlay"></div>

                <div class="transx_header_search_container">
                    <form name="header_search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="transx_search_form" id="search-<?php echo esc_attr($header_search_rand); ?>">
                                    <span class="transx_icon_search" onclick="javascript:document.getElementById('search-<?php echo esc_attr($header_search_rand); ?>').submit();">
                                        <svg class="icon">
                                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.19 0a8.19 8.19 0 016.47 13.212l5.04 5.04a1.024 1.024 0 11-1.448 1.448l-5.04-5.04A8.19 8.19 0 118.19 0zm0 2.048a6.143 6.143 0 100 12.285 6.143 6.143 0 000-12.285z"/></svg>
                                        </svg>
                                    </span>
                        <input type="text" name="s" value="" placeholder="<?php echo esc_attr__('Search', 'transx'); ?>" title="<?php esc_html_e('Search the site...', 'transx'); ?>" class="form__field">
                        <div class="clear"></div>
                    </form>
                </div>
                <?php
            }
