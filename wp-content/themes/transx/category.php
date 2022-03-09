<?php
/*
 * Created by Artureanec
*/

get_header();

$transx_sidebar_position = transx_get_theme_mod('sidebar_position');
$transx_sidebar_name = 'Sidebar';
$transx_top_padding_class = '';

// --- Page Title Block --- //
if (transx_get_theme_mod('page_title_status') == 'show') {
    echo transx_page_title_block_output($transx_top_padding_class);
}
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="transx_page_content_container">
            <div class="transx_page_content_wrapper">
                <div class="container">
                    <div class="row transx_sidebar_<?php echo esc_attr($transx_sidebar_position); ?>">
                        <!-- Content Container -->
                        <div class="col-lg-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '8' : '12'); ?> col-xl-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '9' : '12'); ?>">
                            <div class="transx_content_wrapper">

                                <div class="transx_standard_blog_listing">
                                    <div class="transx_standard_blog_listing_wrapper">
                                        <?php
                                        while (have_posts()) : the_post();
                                            get_template_part('standard-listing');
                                        endwhile;
                                        ?>
                                    </div>

                                    <div class="transx_pagination">
                                        <?php
                                        echo get_the_posts_pagination(array(
                                            'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>' . esc_html__('Back', 'transx'),
                                            'next_text' => esc_html__('Next', 'transx') . '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                                        ));
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Sidebar Container -->
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
