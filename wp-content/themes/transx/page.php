<?php
/*
 * Created by Artureanec
*/

the_post();
get_header();

$transx_sidebar_position = transx_get_prefered_option('sidebar_position');
$transx_sidebar_name = 'Sidebar';

if (transx_get_post_option('page_top_padding') == 'off') {
    $transx_top_padding_class = 'transx_page_without_top_padding';
} else {
    $transx_top_padding_class = '';
}

if (transx_get_post_option('page_bottom_padding') == 'off') {
    $transx_bottom_padding_class = 'transx_page_without_bottom_padding';
} else {
    $transx_bottom_padding_class = '';
}

if (transx_get_post_option('content_bg_image_type') == 'default') {
    $content_bg_image = transx_get_theme_mod('content_bg_image');
} else {
    if (is_array(transx_get_post_option('content_bg_image_alt'))) {
        foreach (transx_get_post_option('content_bg_image_alt') as $key => $image) {
            $content_bg_image = $image['full_url'];
        }
    } else {
        $content_bg_image = null;
    }
}

if (transx_get_post_option('body_bg_type') == 'alt') {
    $content_col_width = '8';
} else {
    $content_col_width = '9';
}

// --- Page Title Block --- //
if (transx_get_prefered_option('page_title_status') == 'show') {
    echo transx_page_title_block_output($transx_top_padding_class);
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="transx_page_content_container">
        <div class="transx_page_content_wrapper <?php echo esc_attr($transx_top_padding_class); ?> <?php echo esc_attr($transx_bottom_padding_class); ?> transx_page_title_<?php echo esc_attr(transx_get_prefered_option('page_title_status')); ?>">
            <div class="container">
                <div class="row transx_sidebar_<?php echo esc_attr($transx_sidebar_position); ?> transx_bg_color_<?php echo esc_attr(transx_get_post_option('body_bg_type')); ?>">
                    <!-- Content Container -->
                    <div class="col-lg-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '8' : '12'); ?> col-xl-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '' . $content_col_width . '' : '12'); ?>">

                        <div class="transx_content_wrapper">
                            <?php the_content(); ?>
                        </div>

                        <div class="transx_content_paging_wrapper">
                            <?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'transx') . ': ', 'after' => '</div>')); ?>
                        </div>

                        <?php comments_template(); ?>
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