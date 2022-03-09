<?php
/*
 * Created by Artureanec
*/

the_post();
get_header();

$transx_sidebar_position = transx_get_prefered_option('sidebar_position');
$transx_sidebar_name = 'Sidebar';
$transx_top_padding_class = '';

if (transx_get_post_option('content_bg_image_type') == 'default') {
    $content_bg_image = transx_get_theme_mod('content_bg_image');
} else {
    if (is_array(transx_get_post_option('content_bg_image_alt'))) {
        foreach (transx_get_post_option('content_bg_image_alt') as $key => $image) {
            $content_bg_image = $image['full_url'];
        }
    } else {
        $content_bg_image = transx_get_theme_mod('content_bg_image');
    }
}

// --- Page Title Block --- //
if (transx_get_prefered_option('page_title_status') == 'show') {
    echo transx_page_title_block_output($transx_top_padding_class);
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="transx_blog_content_container">
        <div class="transx_blog_content_wrapper">
            <div class="container">
                <div class="row transx_sidebar_<?php echo esc_attr($transx_sidebar_position); ?> transx_bg_color_<?php echo esc_attr(transx_get_post_option('body_bg_type')); ?>">
                    <!-- Content Container -->
                    <div class="col-lg-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '8' : '12'); ?> col-xl-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '8' : '12'); ?>">
                        <?php
                        if (transx_get_prefered_option('media_output_status') == 'show') {
                            echo transx_post_media_output();
                        }

                        if (transx_get_post_option('body_bg_type') == 'alt') {
                        ?>
                        <div class="transx_color_bg_container">
                            <?php
                            }

                            if (transx_get_prefered_option('post_meta_status') == 'show') {
                                ?>
                                <div class="transx_post_meta_container">
                                    <div class="row">
                                        <div class="col-6 transx_post_author_container">
                                            <?php
                                            if (transx_get_prefered_option('media_output_status') !== 'show' || transx_get_featured_image_url() == false) {
                                                $categories = get_the_category();

                                                if (!empty($categories)) {
                                                    ?>
                                                    <span class="transx_blog_listing_category"><?php the_category(', '); ?></span>
                                                    <span class="divider">/</span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <span class="transx_post_date"><?php echo get_the_date(); ?></span>
                                            <span class="divider">/</span>
                                            <span><?php echo esc_html__('by ', 'transx'); the_author(); ?></span>
                                        </div>

                                        <div class="col-6 text-right transx_comments_counter_container">
                                            <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="transx_content_wrapper <?php echo ((empty(get_the_content())) ? 'transx_empty_content_cont' : ''); ?>">
                                <?php the_content(); ?>
                            </div>

                            <div class="transx_content_paging_wrapper">
                                <?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'transx') . ': ', 'after' => '</div>')); ?>
                            </div>

                            <?php


                            if (transx_get_prefered_option('after_content_panel_status') == 'show') {
                                ?>
                                <div class="transx_post_details_container">
                                    <div class="row align-items-center">
                                        <div class="col-6 transx_post_details_tag_cont">
                                            <?php the_tags('<ul><li>#', '</li> <li>#', '</li></ul>'); ?>
                                        </div>

                                        <div class="col-6 transx_post_details_socials_cont">
                                            <?php echo transx_socials_output('transx_blog-post__socials'); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                        if (transx_get_post_option('body_bg_type') == 'alt') {
                            ?>
                            </div>
                            <?php
                        }

                        if (transx_get_prefered_option('comments_status') == 'show') {
                            comments_template();
                        }
                        ?>
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
