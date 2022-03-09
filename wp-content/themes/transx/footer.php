<?php
    $bottom_image_status = transx_get_prefered_option('bottom_image_status');
?>

            <?php
            if (transx_get_theme_mod('back_to_top_button') == 'show') {
                ?>
                <div class="transx_back_to_top_button">
                    <svg class="icon">
                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path id="Rectangle_8_copy_2" class="st0" d="M5.9,0h2v30h-2V0z M0,23l1.4-1.4L7.8,28l-1.4,1.4L0,23z M13.8,23l-1.4-1.4L6,28 l1.4,1.4L13.8,23z"/><rect x="6.6" y="25.8" class="st0" width="1.2" height="3.8"/></svg>
                    </svg>
                </div>
                <?php
            }
            ?>

            <div class="transx_footer_container <?php echo (($bottom_image_status == 'show') ? 'transx_block_have_bg_image' : ''); ?>">
                <?php

                if (transx_get_prefered_option('prefooter_status') == 'show') {
                    if (transx_get_prefered_option('prefooter_type') == 'type_1') {
                        $footer_sidebar = 'sidebar-footer';
                    }

                    if (transx_get_prefered_option('prefooter_type') == 'type_2') {
                        $footer_sidebar = 'sidebar-footer-2';
                    }

                    if (transx_get_prefered_option('prefooter_type') == 'type_3') {
                        $footer_sidebar = 'sidebar-footer-3';
                    }

                    if (transx_get_prefered_option('prefooter_type') == 'type_4') {
                        $footer_sidebar = 'sidebar-footer-4';
                    }

                    if (is_active_sidebar($footer_sidebar)) {
                        ?>
                        <div class="transx_prefooter_container">
                            <div class="container">
                                <div class="transx_prefooter_wrapper transx_prefooter_<?php echo esc_attr(transx_get_prefered_option('prefooter_type')); ?>">
                                    <?php dynamic_sidebar($footer_sidebar); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                if (transx_get_prefered_option('footer_status') == 'show') {
                    $transx_menu_locations = get_nav_menu_locations();
                    $transx_footer_type = transx_get_prefered_option('footer_type');

                    // --------------------- //
                    // --- Footer Type 1 --- //
                    // --------------------- //
                    if ($transx_footer_type == 'type_1') {
                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show' || transx_get_theme_mod('copyright_status') == 'show' && transx_get_theme_mod('copyright') !== '') {
                            ?>
                            <footer class="transx_footer footer_<?php echo esc_attr($transx_footer_type); ?>">
                                <div class="container">
                                    <div class="row">
                                        <?php
                                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show') {
                                            ?>
                                            <div class="<?php echo ((transx_get_theme_mod('copyright') !== '' && transx_get_theme_mod('copyright_status') == 'show') ? 'col-lg-6' : 'col-sm-12'); ?> text-sm-center text-lg-left">
                                                <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'transx_footer_menu', 'depth' => '1', 'container' => '')); ?>
                                            </div>
                                            <?php
                                        }

                                        if (transx_get_theme_mod('copyright_status') == 'show' && transx_get_theme_mod('copyright_status') !== '') {
                                            ?>
                                            <div class="<?php echo ((isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show') ? 'col-lg-6' : 'col-sm-12'); ?> text-sm-center text-lg-right">
                                                <div class="transx_footer_copyright"><?php echo wp_kses(transx_get_theme_mod('copyright'), 'default'); ?></div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                            </footer>
                            <?php
                        }
                    }

                    // --------------------- //
                    // --- Footer Type 2 --- //
                    // --------------------- //
                    if ($transx_footer_type == 'type_2') {
                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show' || transx_get_theme_mod('copyright_status') == 'show' && transx_get_theme_mod('copyright') !== '' || transx_get_theme_mod('footer_socials_status') == 'show' && transx_socials_output('transx_footer_socials') !== false) {
                            ?>

                            <footer class="transx_footer footer_<?php echo esc_attr($transx_footer_type); ?>">
                                <div class="container">
                                    <div class="row flex-sm-row">
                                        <?php

                                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show') {
                                            ?>
                                            <div class="col-sm-6 col-lg-4 top-20 top-sm-0 text-center text-sm-left">
                                                <div class="transx_footer_copyright"><?php echo wp_kses(transx_get_theme_mod('copyright'), 'default'); ?></div>
                                            </div>
                                            <?php
                                        }

                                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show' || transx_get_theme_mod('footer_socials_status') == 'show' && transx_socials_output('transx_footer_socials') !== false) {
                                            ?>
                                            <div class="col-sm-6 col-lg-8 d-flex justify-content-center justify-content-sm-end">
                                                <?php
                                                if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show') {
                                                    ?>
                                                    <div class="transx_footer_menu_cont d-none d-lg-block">
                                                        <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'transx_footer_menu', 'depth' => '1', 'container' => '')); ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </footer>
                            <?php
                        }
                    }

                    if ($transx_footer_type == 'type_3') {
                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show' || isset($transx_menu_locations['footer_menu_2']) && transx_get_theme_mod('footer_menu_2_status') == 'show') {
                            ?>
                            <footer class="transx_footer footer_<?php echo esc_attr($transx_footer_type); ?>">
                                <div class="container">
                                    <div class="transx_footer_3_wrapper">
                                    <div class="row flex-sm-row">
                                        <?php
                                        if (isset($transx_menu_locations['footer_menu_2']) && transx_get_theme_mod('footer_menu_2_status') == 'show') {
                                            ?>
                                            <div class="col-sm-12 col-lg-7 col-xl-8 top-20 top-sm-0 text-center text-sm-left">
                                                <div class="transx_footer_menu_2_cont">
                                                    <?php wp_nav_menu(array('theme_location' => 'footer_menu_2', 'menu_class' => 'transx_footer_menu_2', 'depth' => '1', 'container' => '')); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                        if (isset($transx_menu_locations['footer_menu']) && transx_get_theme_mod('footer_menu_status') == 'show') {
                                            ?>
                                            <div class="col-sm-12 col-lg-5 col-xl-4 top-20 top-sm-0 text-center text-sm-right">
                                                <div class="transx_footer_menu_cont">
                                                    <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'transx_footer_menu', 'depth' => '1', 'container' => '')); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    </div>
                                </div>
                            </footer>
                            <?php
                        }
                    }
                }

                ?>
            </div>
        </div>
        <?php
        wp_footer(); ?>
    </body>
</html>
