<?php
get_header();
?>

    <div class="transx_404_error_container">
        <div class="transx_404_error_inner">
            <div class="transx_404_error_align_container">
                <div class="container">
                    <div class="row align-items-center align-lg-end">
                        <div class="col-md-6 col-xl-5">
                            <div class="transx_404_content">
                                <span class="transx_404_error_info_text"><?php echo esc_html(transx_get_theme_mod('404_title')); ?></span>

                                <h2 class="transx_404_error_subtitle"><?php echo esc_html__('Ooops', 'transx'); ?><br><?php echo esc_html__('Page Not Found', 'transx'); ?></h2>

                                <?php
                                if (transx_get_theme_mod('404_text') !== '') {
                                    ?>
                                    <p class="transx_404_error_text"><?php echo esc_html(transx_get_theme_mod('404_text')) ?></p>
                                    <?php
                                }
                                ?>

                                <a class="transx_404_home_button transx_button transx_button--primary" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(transx_get_theme_mod('404_button_text')); ?></a>
                            </div>
                        </div>

                        <div class="d-none d-md-block col-md-6 col-xl-7 text-right">
                            <h1 class="transx_404_error_title"><?php echo esc_html('404', 'transx'); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
