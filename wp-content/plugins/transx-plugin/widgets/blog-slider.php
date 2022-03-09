<?php
/*
 * Created by Artureanec
*/

namespace Transx\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\REPEATER;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Transx_Blog_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_blog_slider';
    }

    public function get_title() {
        return esc_html__('Blog Slider', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['causes_slider_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Blog Slider', 'transx-plugin')
            ]
        );

        $this->add_control(
            'showed_items',
            [
                'label' => esc_html__('Showed Items', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Showed Default Items', 'transx-plugin'),
                    'custom' => esc_html__('Showed Custom Items', 'transx-plugin')
                ]
            ]
        );

        $args = array('post_type' => 'post', 'numberposts' => '-1');
        $all_posts = get_posts($args);
        $post_list = array();

        if ($all_posts > 0) {
            foreach ($all_posts as $post) {
                setup_postdata($post);
                $post_list[$post->ID] = $post->post_title;
            }
        } else {
            $post_list = array(
                'no_posts' => esc_html__('No Posts Were Found', 'transx-plugin')
            );
        }

        $this->add_control(
            'blog_items_list',
            [
                'label' => esc_html__('Choose Items', 'transx-plugin'),
                'type' => Controls_Manager::SELECT2,
                'options' => $post_list,
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'showed_items' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'post_order_by',
            [
                'label' => esc_html__('Order By', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Post Date', 'transx-plugin'),
                    'rand' => esc_html__('Random', 'transx-plugin'),
                    'ID' => esc_html__('Post ID', 'transx-plugin'),
                    'title' => esc_html__('Post Title', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => esc_html__('Order', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('Descending', 'transx-plugin'),
                    'asc' => esc_html__('Ascending', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'full_mode',
            [
                'label' => esc_html__('Fullwidth Mode', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_status',
            [
                'label' => esc_html__('Promo Button', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Promo Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Blog', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Donate Popup Button Text', 'transx-plugin'),
                'label_block' => true,
                'condition' => [
                    'button_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Promo Button Link', 'transx-plugin'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'http://your-link.com', 'transx-plugin' ),
                'condition' => [
                    'button_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Slider Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_slider',
            [
                'label' => esc_html__('Slider Settings', 'transx-plugin')
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Animation Speed', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'transx-plugin'),
                    'no' => esc_html__('No', 'transx-plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'transx-plugin'),
                    'no' => esc_html__('No', 'transx-plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'transx-plugin'),
                    'no' => esc_html__('No', 'transx-plugin'),
                ],
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'rtl_support',
            [
                'label' => esc_html__('Rtl Support', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Title Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title Part', 'transx-plugin')
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Heading', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your heading', 'transx-plugin' ),
                'default' => esc_html__( 'This is heading element', 'transx-plugin' )
            ]
        );

        $this->add_control(
            'up_title_status',
            [
                'label' => esc_html__('Up Heading', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Enter Up Heading', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter up heading', 'transx-plugin' ),
                'default' => esc_html__( 'Blog', 'transx-plugin' ),
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'up_title_marker',
            [
                'label' => esc_html__('Up Heading Overlay', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'up_title_marker_text',
            [
                'label' => esc_html__('Enter Up Heading Overlay', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter up heading', 'transx-plugin' ),
                'default' => '',
                'block_label' => true,
                'condition' => [
                    'up_title_marker' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- General Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_general_settings',
            [
                'label' => esc_html__('Blog Slider Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label' => esc_html__('Content Block Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_details_container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'content_bg_color',
            [
                'label' => esc_html__('Content Block Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_details_container' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => esc_html__('Meta Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blog_slider_meta'
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => esc_html__('Meta Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_slider_meta' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blog_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blog_excerpt'
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_excerpt' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- General Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_title_part_settings',
            [
                'label' => esc_html__('Title Part Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Heading Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_heading'
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_heading' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_typography',
                'label' => esc_html__('Up Heading Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_up_heading',
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Heading Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'up_title_status' => 'yes'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'up_title_marker_color',
            [
                'label' => esc_html__('Up Heading Overlay Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading_overlay' => '-webkit-text-stroke-color: {{VALUE}};'
                ],
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $showed_items = $settings['showed_items'];
        $posts_per_page = $settings['posts_per_page'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
        $full_mode = $settings['full_mode'];
        $button_status = $settings['button_status'];
        $heading = $settings['heading'];
        $up_title_status = $settings['up_title_status'];
        $up_title_marker = $settings['up_title_marker'];
        $up_title_marker_text = $settings['up_title_marker_text'];

        if ($up_title_status == 'yes') {
            $up_title = $settings['up_title'];
        } else {
            $up_title = '';
        }

        if ($up_title_marker_text == '') {
            $up_title_marker_text = $up_title;
        }

        if ($showed_items == 'custom') {
            $blog_items_list = $settings['blog_items_list'];
        }

        if ($button_status == 'yes') {
            $button_text = $settings['button_text'];
            $button_link = $settings['button_link'];

            if ($button_link['url'] !== '') {
                $button_url = $button_link['url'];
            } else {
                $button_url = '#';
            }
        } else {
            $button_text = '';
            $button_link = '';
        }

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        $slider_options = [
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'infinite' => ('yes' === $settings['infinite']),
            'speed' => absint($settings['speed']),
            'rtl' => $rtl
        ];

        if ($settings['autoplay'] == 'yes') {
            $slider_options['autoplaySpeed'] = absint( $settings['autoplay_speed'] );
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_blog_carousel_widget">
            <div class="transx_blog_carousel_wrapper">

                <div class="row">
                    <div class="col-xl-4">
                        <?php
                        if ($heading !== '') {
                            if ($up_title_status == 'yes') {
                                ?>
                                <div class="transx_up_heading"><?php echo esc_html($up_title); ?></div>
                                <?php
                            }

                            if ($up_title_marker == 'yes') {
                                ?>
                                <div class="transx_up_heading_overlay"><?php echo esc_html($up_title_marker_text); ?></div>
                                <?php
                            }
                        }
                        ?>
                        <h2 class="transx_heading"><?php echo wp_kses($heading, 'post'); ?></h2>

                        <?php
                        if ($button_status == 'yes') {
                            ?>
                            <a class="transx_button" href="<?php echo esc_url($button_url); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($button_text); ?></a>
                            <?php
                        }
                        ?>

                        <div class="transx_causes_slider_navigation_container">
                            <div class="transx_slider_arrows"></div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <?php
                        if ($full_mode == 'yes') {
                            ?>
                            <div class="transx_offset_container">
                                <div class="transx_offset_container_wrapper">
                                    <?php
                                    }
                                    ?>

                                    <div class="transx_blog_carousel transx_slider_slick" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                        <?php
                                        $args = array(
                                            'post_type' => 'post',
                                            'posts_per_page' => $posts_per_page,
                                            'orderby' => $post_order_by,
                                            'order' => $post_order
                                        );

                                        if ($showed_items == 'custom') {
                                            $args['post__in'] = $blog_items_list;
                                        }

                                        query_posts($args);

                                        while (have_posts()) {
                                            the_post();

                                            $featured_image_url = transx_get_featured_image_url();
                                            $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                            $featured_image_src = aq_resize(esc_url($featured_image_url), 582, 640, true, true, true);
                                            $transx_excerpt = transx_excerpt_truncate(get_the_excerpt(), 110, '...');

                                            $links = array_map(function ($category) {
                                                return sprintf(
                                                    '<a href="%s" class="link link_text">%s</a>',
                                                    esc_url(get_category_link($category)),
                                                    esc_html($category->name)
                                                );
                                            }, get_the_category() );
                                            ?>

                                            <div class="transx_blog_slider_item">
                                                <div class="transx_blog_slider_item_wrapper">
                                                    <?php
                                                    if ($featured_image_src !== false) {
                                                        ?>
                                                        <div class="transx_blog_slider_image_cont">
                                                            <img class="transx_img--bg" src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"/>

                                                            <div class="transx_post_cat_cont">
                                                                <div class="transx_post_cat_wrapper"><?php echo implode(', ', $links); ?></div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="transx_blog_details_container">
                                                        <div class="transx_blog_slider_meta">
                                                            <span class="transx_blog_date"><?php echo get_the_date(); ?></span>
                                                            <span class="transx_separator">/</span>
                                                            <span class="transx_blog_slider_author"><?php echo esc_html__('by ', 'transx-plugin'); the_author(); ?></span>
                                                        </div>

                                                        <h5 class="transx_blog_title">
                                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo wp_kses(get_the_title(), 'post'); ?></a>
                                                        </h5>

                                                        <p class="transx_blog_excerpt"><?php echo esc_html($transx_excerpt); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    if ($full_mode == 'yes') {
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        wp_reset_query();
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
