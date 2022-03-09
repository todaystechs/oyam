<?php
/*
 * Created by Artureanec
*/

get_header();

if (is_shop()) {
    global $post;
    $page_id = wc_get_page_id('shop');
    $post = get_post($page_id);
    $transx_sidebar_position = esc_attr(transx_get_prefered_option('sidebar_position'));
} else {
    $transx_sidebar_position = esc_attr(transx_get_prefered_option('sidebar_position'));
}

$transx_sidebar_name = 'Sidebar WooCommerce';

if (transx_get_post_option('page_top_padding') == 'off') {
    $transx_top_padding_class = 'transx_page_without_top_padding';
} else {
    $transx_top_padding_class = '';
}

// --- Page Title Block --- //
if (transx_get_prefered_option('page_title_status') == 'show') {
    echo transx_page_title_block_output($transx_top_padding_class);
}
?>

<div id="post-<?php the_ID(); ?>" class="transx_page_content_container">
    <div class="transx_page_content_wrapper transx_woocommerce_wrapper">
        <div class="container">
            <div class="row transx_sidebar_<?php echo esc_attr($transx_sidebar_position); ?>">
                <!-- Content Container -->
                <div class="col-lg-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '8' : '12'); ?> col-xl-<?php echo ((is_active_sidebar('sidebar') && $transx_sidebar_position !== 'none') ? '9' : '12'); ?>">
                    <div class="transx_content_wrapper">
                        <?php
                        $shop_loop = false;
                        if (is_shop() || is_product_taxonomy() || is_product_tag() || is_product_category()) {
                            $shop_loop = true;
                        }
                        if ($shop_loop) {
                            echo '<div class="transx_shop_loop">';
                        }
                        woocommerce_content();
                        if ($shop_loop) {
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="transx_content_paging_wrapper">
                        <?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'transx') . ': ', 'after' => '</div>')); ?>
                    </div>
                </div>

                <!-- Sidebar Container -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
