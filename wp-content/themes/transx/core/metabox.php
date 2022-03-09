<?php
/*
 * Created by Artureanec
*/

if (!class_exists('RWMB_Loader')) {
    return;
}

if (!function_exists('transx_custom_meta_boxes')) {
    add_filter('rwmb_meta_boxes', 'transx_custom_meta_boxes');

    function transx_custom_meta_boxes($meta_boxes) {
        # Image Post Format
        $meta_boxes[] = array(
            'title' => esc_attr__('Image Post Format Settings', 'transx'),
            'post_types' => array('post'),
            'fields' => array(
                array(
                    'id' => 'transx_pf_images',
                    'name' => esc_attr__('Select Images', 'transx'),
                    'type' => 'image_advanced',
                ),
                array(
                    'id' => 'transx_pf_images_crop_status',
                    'name' => esc_attr__('Crop Images', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'yes' => esc_attr__('Yes', 'transx'),
                        'no' => esc_attr__('No', 'transx'),
                    ),
                ),
                array(
                    'id' => 'transx_pf_images_width',
                    'name' => esc_attr__('Image Width', 'transx'),
                    'type' => 'text',
                    'desc' => esc_attr__('In pixels.', 'transx'),
                    'std' => '1200',
                    'attributes' => array(
                        'data-dependency-id' => 'transx_pf_images_crop_status',
                        'data-dependency-val' => 'yes'
                    ),
                ),
                array(
                    'id' => 'transx_pf_images_height',
                    'name' => esc_attr__('Image Height', 'transx'),
                    'type' => 'text',
                    'desc' => esc_attr__('In pixels.', 'transx'),
                    'std' => '738',
                    'attributes' => array(
                        'data-dependency-id' => 'transx_pf_images_crop_status',
                        'data-dependency-val' => 'yes'
                    ),
                ),
            ),
        );

        # Video Post Format
        $meta_boxes[] = array(
            'title' => esc_attr__('Video Post Format Settings', 'transx'),
            'post_types' => array('post'),
            'fields' => array(
                array(
                    'id' => 'transx_pf_video_url',
                    'name' => esc_attr__('Video URL', 'transx'),
                    'type' => 'oembed',
                    'desc' => esc_attr__('Copy link to the video from YouTube or other video-sharing website.', 'transx'),
                ),
                array(
                    'id' => 'transx_pf_video_height',
                    'name' => esc_attr__('Video Height', 'transx'),
                    'type' => 'text',
                    'desc' => esc_attr__('In pixels.', 'transx'),
                    'std' => '500',
                ),
            ),
        );

        # Content Output Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Content Output Settings', 'transx'),
            'post_types' => array('post'),
            'fields' => array(
                array(
                    'id' => 'media_output_status',
                    'name' => esc_html__('Media Output Container', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'post_meta_status',
                    'name' => esc_html__('Post Meta Container', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'after_content_panel_status',
                    'name' => esc_html__('Panel After Post Content', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'comments_status',
                    'name' => esc_html__('Post Comments', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'post_nav',
                    'name' => esc_html__('Post Navigation', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_html__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),
            )
        );

        # Only Pages Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Page Padding Settings', 'transx'),
            'post_types' => array('page'),
            'fields' => array(
                array(
                    'id' => 'page_top_padding',
                    'name' => esc_html__('Content Area Top Padding', 'transx'),
                    'type' => 'select',
                    'std' => 'on',
                    'options' => array(
                        'off' => esc_attr__('Off', 'transx'),
                        'on' => esc_attr__('On', 'transx')
                    )
                ),

                array(
                    'id' => 'page_bottom_padding',
                    'name' => esc_html__('Content Area Bottom Padding', 'transx'),
                    'type' => 'select',
                    'std' => 'on',
                    'options' => array(
                        'off' => esc_attr__('Off', 'transx'),
                        'on' => esc_attr__('On', 'transx')
                    )
                )
            )
        );

        # Post and Page Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Page Settings', 'transx'),
            'post_types' => array('post', 'page'),
            'fields' => array(
                # Body Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Body Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'body_bg_type',
                    'name' => esc_html__('Body Background Color Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default Color', 'transx'),
                        'alt' => esc_attr__('Alternative Color', 'transx')
                    )
                ),

                array(
                    'id' => 'body_alt_bg_color',
                    'name' => esc_html__('Body Background Color', 'transx'),
                    'type' => 'color',
                    'alpha_channel' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'body_bg_type',
                        'data-dependency-val' => 'alt'
                    )
                ),

                # Header Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Header Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'header_style',
                    'name' => esc_html__('Header Style', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'type_1' => esc_attr__('Style Type 1', 'transx'),
                        'type_2' => esc_attr__('Style Type 2', 'transx'),
                        'type_3' => esc_attr__('Style Type 3', 'transx'),
                        'type_4' => esc_attr__('Style Type 4', 'transx'),
                        'type_5' => esc_attr__('Style Type 5', 'transx'),
                        'type_6' => esc_attr__('Style Type 6', 'transx')
                    )
                ),

                array(
                    'id' => 'transparent_header',
                    'name' => esc_attr__('Transparent Header', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'on' => esc_attr__('On', 'transx'),
                        'off' => esc_attr__('Off', 'transx')
                    )
                ),

                array(
                    'id' => 'sticky_header',
                    'name' => esc_attr__('Sticky Header', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'on' => esc_attr__('On', 'transx'),
                        'off' => esc_attr__('Off', 'transx')
                    )
                ),

                array(
                    'id' => 'header_tagline',
                    'name' => esc_html__('Header Tagline', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'on' => esc_attr__('On', 'transx'),
                        'off' => esc_attr__('Off', 'transx')
                    )
                ),

                array(
                    'id' => 'number_of_phones',
                    'name' => esc_html__('Number of Phones', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        '1' => esc_attr__('One', 'transx'),
                        '2' => esc_attr__('Two', 'transx')
                    )
                ),

                array(
                    'id' => 'header_cart_status',
                    'name' => esc_html__('Header Shop Cart', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'header_search',
                    'name' => esc_html__('Header Search', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                # Title Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Title Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'page_title_status',
                    'name' => esc_html__('Page Title', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'page_title_image_type',
                    'name' => esc_html__('Page Title Image Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'alt' => esc_attr__('Alternative', 'transx')
                    )
                ),

                array(
                    'id' => 'page_title_alt_image',
                    'name' => esc_html__('Alternative Page Title Image', 'transx'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_image_type',
                        'data-dependency-val' => 'alt'
                    )
                ),

                array(
                    'id' => 'page_title_settings',
                    'name' => esc_html__('Page Title Settings', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'custom' => esc_attr__('Custom', 'transx'),
                    )
                ),

                array(
                    'id' => 'title_height',
                    'name' => esc_html__('Page Title Height', 'transx'),
                    'type' => 'number',
                    'std' => '750',
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_settings',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'title_bg_color',
                    'name' => esc_html__('Page Title Background Color', 'transx'),
                    'placeholder' => '#000000',
                    'type' => 'color',
                    'alpha_channel' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_settings',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'site_title_status',
                    'name' => esc_html__('Site Title', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                # Sidebar Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Sidebar Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'sidebar_position',
                    'name' => esc_html__('Sidebar Position', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'left' => esc_attr__('Left', 'transx'),
                        'right' => esc_attr__('Right', 'transx'),
                        'none' => esc_attr__('None', 'transx')
                    )
                ),

                #Footer Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Footer Options', 'transx'),
                    'desc' => ''
                ),

                array(
                    'id' => 'bottom_image_status',
                    'name' => esc_html__('Footer Background', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'bottom_image_type',
                    'name' => esc_html__('Footer Image Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'custom' => esc_attr__('Custom', 'transx')
                    )
                ),

                array(
                    'id' => 'custom_bottom_image',
                    'name' => esc_attr__('Select First Image', 'transx'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'bottom_image_type',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'custom_bottom_image_2',
                    'name' => esc_attr__('Select Second Image', 'transx'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'bottom_image_type',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'prefooter_status',
                    'name' => esc_html__('Footer Widgets Section', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'prefooter_type',
                    'name' => esc_html__('Footer Widgets Section Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'type_1' => esc_attr__('Type 1', 'transx'),
                        'type_2' => esc_attr__('Type 2', 'transx'),
                        'type_3' => esc_attr__('Type 3', 'transx'),
                        'type_4' => esc_attr__('Type 4', 'transx'),
                        'type_5' => esc_attr__('Type 5', 'transx')
                    )
                ),

                array(
                    'id' => 'footer_status',
                    'name' => esc_html__('Footer', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'footer_type',
                    'name' => esc_html__('Footer Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'type_1' => esc_attr__('Type 1', 'transx'),
                        'type_2' => esc_attr__('Type 2', 'transx'),
                        'type_3' => esc_attr__('Type 3', 'transx')
                    )
                )
            ),
        );

        # Product Settings
        $meta_boxes[] = array(
            'title' => esc_attr__('Page Settings', 'transx'),
            'post_types' => array('product'),
            'fields' => array(
                # Body Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Body Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'body_bg_type',
                    'name' => esc_html__('Body Background Color Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default Color', 'transx'),
                        'alt' => esc_attr__('Alternative Color', 'transx')
                    )
                ),

                array(
                    'id' => 'body_alt_bg_color',
                    'name' => esc_html__('Body Background Color', 'transx'),
                    'type' => 'color',
                    'alpha_channel' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'body_bg_type',
                        'data-dependency-val' => 'alt'
                    )
                ),

                # Header Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Header Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'header_style',
                    'name' => esc_html__('Header Style', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'type_1' => esc_attr__('Style Type 1', 'transx'),
                        'type_2' => esc_attr__('Style Type 2', 'transx'),
                        'type_3' => esc_attr__('Style Type 3', 'transx'),
                        'type_4' => esc_attr__('Style Type 4', 'transx'),
                        'type_5' => esc_attr__('Style Type 5', 'transx'),
                        'type_6' => esc_attr__('Style Type 6', 'transx')
                    )
                ),

                array(
                    'id' => 'transparent_header',
                    'name' => esc_attr__('Transparent Header', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'on' => esc_attr__('On', 'transx'),
                        'off' => esc_attr__('Off', 'transx')
                    )
                ),

                array(
                    'id' => 'sticky_header',
                    'name' => esc_attr__('Sticky Header', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'on' => esc_attr__('On', 'transx'),
                        'off' => esc_attr__('Off', 'transx')
                    )
                ),

                array(
                    'id' => 'header_tagline',
                    'name' => esc_html__('Header Tagline', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'on' => esc_attr__('On', 'transx'),
                        'off' => esc_attr__('Off', 'transx')
                    )
                ),

                array(
                    'id' => 'header_cart_status',
                    'name' => esc_html__('Header Shop Cart', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                # Title Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Title Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'page_title_status',
                    'name' => esc_html__('Page Title', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'page_title_settings',
                    'name' => esc_html__('Page Title Settings', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'custom' => esc_attr__('Custom', 'transx'),
                    )
                ),

                array(
                    'id' => 'title_height',
                    'name' => esc_html__('Page Title Height', 'transx'),
                    'type' => 'number',
                    'std' => '750',
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_settings',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'title_bg_color',
                    'name' => esc_html__('Page Title Background Color', 'transx'),
                    'placeholder' => '#000000',
                    'type' => 'color',
                    'alpha_channel' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'page_title_settings',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'site_title_status',
                    'name' => esc_html__('Site Title', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                # Sidebar Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Sidebar Options', 'transx'),
                    'desc' => '',
                ),

                array(
                    'id' => 'sidebar_position',
                    'name' => esc_html__('Sidebar Position', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'left' => esc_attr__('Left', 'transx'),
                        'right' => esc_attr__('Right', 'transx'),
                        'none' => esc_attr__('None', 'transx')
                    )
                ),

                #Footer Options
                array(
                    'type' => 'heading',
                    'name' => esc_attr__('Footer Options', 'transx'),
                    'desc' => ''
                ),

                array(
                    'id' => 'bottom_image_status',
                    'name' => esc_html__('Footer Background', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'one' => esc_attr__('One Footer Background', 'transx'),
                        'two' => esc_attr__('Two Footer Backgrounds', 'transx')
                    )
                ),

                array(
                    'id' => 'bottom_image_type',
                    'name' => esc_html__('Footer Image Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'custom' => esc_attr__('Custom', 'transx')
                    )
                ),

                array(
                    'id' => 'custom_bottom_image',
                    'name' => esc_attr__('Select First Image', 'transx'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'bottom_image_type',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'custom_bottom_image_2',
                    'name' => esc_attr__('Select Second Image', 'transx'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => '1',
                    'max_status' => false,
                    'attributes' => array(
                        'data-dependency-id' => 'bottom_image_type',
                        'data-dependency-val' => 'custom'
                    )
                ),

                array(
                    'id' => 'prefooter_status',
                    'name' => esc_html__('Footer Widgets Section', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'prefooter_type',
                    'name' => esc_html__('Footer Widgets Section Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'type_1' => esc_attr__('Type 1', 'transx'),
                        'type_2' => esc_attr__('Type 2', 'transx'),
                        'type_3' => esc_attr__('Type 3', 'transx'),
                        'type_4' => esc_attr__('Type 4', 'transx')
                    )
                ),

                array(
                    'id' => 'footer_status',
                    'name' => esc_html__('Footer', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'show' => esc_attr__('Show', 'transx'),
                        'hide' => esc_attr__('Hide', 'transx')
                    )
                ),

                array(
                    'id' => 'footer_type',
                    'name' => esc_html__('Footer Type', 'transx'),
                    'type' => 'select',
                    'options' => array(
                        'default' => esc_attr__('Default', 'transx'),
                        'type_1' => esc_attr__('Type 1', 'transx'),
                        'type_2' => esc_attr__('Type 2', 'transx'),
                        'type_3' => esc_attr__('Type 3', 'transx')
                    )
                )
            ),
        );

        return $meta_boxes;
    }
}
