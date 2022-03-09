<?php
$featured_image_url = transx_get_featured_image_url();
$image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

if (function_exists('aq_resize')) {
    $featured_image_src = aq_resize(esc_url($featured_image_url), 1200, 625, true, true, true);
} else {
    $featured_image_src = $featured_image_url;
}

$transx_excerpt = transx_excerpt_truncate(get_the_excerpt(), 330, '...');
?>

<div class="transx_blog_listing_item <?php echo ((is_sticky()) ? 'transx_sticky_post' : ''); ?>">
    <?php
    if (transx_get_featured_image_url() !== false) {
        ?>
        <div class="transx_blog_listing_image_container">
            <?php
            $attachment_ID = get_post_thumbnail_id(get_the_ID());
            $attachment_array = wp_get_attachment_metadata($attachment_ID);

            $attachment_width = $attachment_array['width'];
            $attachment_height = $attachment_array['height'];
            $image_width = 1200;
            $image_height = 625;

            if ($attachment_width > 1200) {
                if ($attachment_width / $attachment_height > 1) {
                    if (function_exists('aq_resize')) {
                        $featured_image_url = aq_resize(transx_get_featured_image_url(), $image_width, $image_height, true, true, true);
                    } else {
                        $featured_image_url = transx_get_featured_image_url();
                    }
                } else {
                    if (function_exists('aq_resize')) {
                        $featured_image_url = aq_resize(transx_get_featured_image_url(), $image_width, '', true, true, true);
                    } else {
                        $featured_image_url = transx_get_featured_image_url();
                    }
                }
            } else {
                $featured_image_url = transx_get_featured_image_url();
            }
            ?>

            <img src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Featured Image', 'transx'); ?>" />
        </div>
        <?php
    }
    ?>

    <div class="transx_blog_listing_content_wrapper">
        <div class="transx_blog_listing_meta">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                ?>
                <span class="transx_blog_listing_category"><?php the_category(', '); ?></span>
                <?php
            }
            ?>
            <span class="transx_separator">/</span>
            <span class="transx_blog_listing_date"><?php echo esc_html(get_the_date()); ?></span>
            <span class="transx_separator">/</span>
            <span class="transx_blog_listing_author"><?php echo esc_html__('by ', 'transx');  the_author(); ?></span>
        </div>
        <?php


        if (get_the_title() !== '') {
            ?>
            <h3 class="transx_blog_listing_title">
                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo wp_kses(get_the_title(), 'post'); ?></a>
            </h3>
            <?php
        }

        if ($transx_excerpt !== '') {
            ?>
            <p class="transx_blog_listing_excerpt"><?php echo wp_kses($transx_excerpt, 'post'); ?></p>
            <?php
        }
        ?>

        <div class="transx_blog_listing_tags">
            <?php the_tags('<div>', ' ', '</div>'); ?>
        </div>

        <a class="transx_button transx_button--primary" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html__('Explore More', 'transx'); ?></a>
    </div>
</div>
