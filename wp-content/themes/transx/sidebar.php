<?php
/*
 * Created by Artureanec
*/

if (class_exists('WooCommerce')) {
    if (is_shop()) {
        global $post;
        $page_id = wc_get_page_id('shop');
        $post = get_post($page_id);
    }
}

global $transx_sidebar_name;

if (is_home() || is_search()) {
    $sidebar_col_width = '4';
} else {
    if (transx_get_post_option('body_bg_type') == 'alt') {
        $sidebar_col_width = '4';
    } else {
        $sidebar_col_width = '3';
    }
}

if (class_exists('WooCommerce')) {
    if (is_woocommerce()) {
        if (is_shop()) {
            $transx_sidebar_position = transx_get_prefered_option('sidebar_position');
        } else {
            $transx_sidebar_position = transx_get_prefered_option('sidebar_position');
        }
    } else {
        $transx_sidebar_position = transx_get_prefered_option('sidebar_position');
    }
} else {
    $transx_sidebar_position = transx_get_prefered_option('sidebar_position');
}

if ($transx_sidebar_position !== 'none') {
    echo "<div class='transx_sidebar col-md-8 offset-md-2 col-lg-4 offset-lg-0 col-xl-" . $sidebar_col_width . "'>";
        dynamic_sidebar($transx_sidebar_name);
    echo "</div>";
}
