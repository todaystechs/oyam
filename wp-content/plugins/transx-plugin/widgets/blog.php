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

class Transx_Blog_Listing_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_blog_listing';
    }

    public function get_title() {
        return esc_html__('Blog Listing', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-gallery-justified';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Blog Listing', 'transx-plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('View Type 1', 'transx-plugin'),
                    'type_2' => esc_html__('View Type 2', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5
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
                ],
                'separator' => 'before'
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
            'pagination',
            [
                'label' => esc_html__('Pagination', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => esc_html__('Show', 'transx-plugin'),
                    'hide' => esc_html__('Hide', 'transx-plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------------- //
        // ---------- Blog Listing Settings ---------- //
        // ------------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Blog Listing Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'items_margin',
            [
                'label' => esc_html__('Spaces After Items', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_item' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'image_margin',
            [
                'label' => esc_html__('Space After Image', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_image_container' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'content_bg_color',
            [
                'label' => esc_html__('Content Area Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_view_type_2 .transx_item_type_2 .transx_blog_listing_content' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blog_listing_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__('Title Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'meta_margin',
            [
                'label' => esc_html__('Space After Post Meta', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_meta' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Post Meta Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blog_listing_meta, {{WRAPPER}} .transx_blog_listing_meta a'
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Post Meta Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_meta, {{WRAPPER}} .transx_blog_listing_meta a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'meta_hover',
            [
                'label' => esc_html__('Post Meta Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_meta a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'excerpt_margin',
            [
                'label' => esc_html__('Space After Excerpt', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blog_listing_excerpt'
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blog_listing_excerpt' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $posts_per_page = $settings['posts_per_page'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
        $pagination = $settings['pagination'];
        $i = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_blog_listing_widget">
            <div class="transx_blog_listing_wrapper transx_view_<?php echo esc_attr($view_type); ?>">
                <?php

                if ($view_type == 'type_2') {
                    ?>
                    <div class="row">
                    <?php
                }

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $post_order_by,
                    'order' => $post_order,
                    'paged' => esc_attr($paged)
                );

                query_posts($args);

                while (have_posts()) {
                    the_post();

                    // ------------------- //
                    // --- View Type 1 --- //
                    // ------------------- //
                    if ($view_type == 'type_1') {
                        $links = array_map(function ($category) {
                            return sprintf(
                                '<a href="%s" class="link link_text">%s</a>',
                                esc_url(get_category_link($category)),
                                esc_html($category->name)
                            );
                        }, get_the_category() );

                        ?>
                        <div class="transx_blog_listing_item">
                            <?php
                            $transx_excerpt = transx_excerpt_truncate(get_the_excerpt(), 260, '...');

                            if (transx_get_featured_image_url() !== false) {
                                ?>
                                <div class="transx_blog_listing_image_container">
                                    <?php
                                    $featured_image_url = aq_resize(transx_get_featured_image_url(), 1200, 598, true, true, true);
                                    ?>

                                    <img class="transx_img--bg" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Featured Image', 'transx-plugin'); ?>" />
                                    <div class="transx_post_cat_cont">
                                        <div class="transx_post_cat_wrapper"><?php echo implode(', ', $links); ?></div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="transx_blog_listing_content_wrapper">
                                <div class="transx_blog_listing_meta">
                                    <span class="transx_blog_listing_date"><?php echo esc_html(get_the_date()); ?></span>
                                    <span class="transx_separator">/</span>
                                    <span class="transx_blog_listing_author"><?php echo esc_html__('by ', 'transx-plugin');  the_author(); ?></span>
                                </div>

                                <?php
                                if (get_the_title() !== '') {
                                    ?>
                                    <h3 class="transx_blog_listing_title">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                    </h3>
                                    <?php
                                }

                                if ($transx_excerpt !== '') {
                                    ?>
                                    <p class="transx_blog_listing_excerpt"><?php echo esc_html($transx_excerpt); ?></p>
                                    <?php
                                }
                                ?>

                                <a class="transx_button transx_button--primary" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html__('Explore More', 'transx-plugin'); ?></a>
                            </div>
                        </div>
                        <?php
                    }

                    // ------------------- //
                    // --- View Type 2 --- //
                    // ------------------- //
                    else {

                        if ($i == 1) {
                            $item_class = 'col-lg-6 col-xl-8 transx_item_type_1';
                        } else {
                            $item_class = 'col-lg-6 col-xl-4 transx_item_type_2';
                        }

                        $featured_image_url = transx_get_featured_image_url();
                        ?>

                        <div class="<?php echo esc_attr($item_class); ?>">
                            <div class="transx_blog_listing_item">
                                <div class="transx_blog_listing_item_wrapper">
                                    <?php
                                    if ($i == 1) {
                                        ?>
                                        <img class="transx_img--bg" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Featured Image', 'transx-plugin'); ?>" />
                                        <div class="transx_overlay"></div>

                                        <div class="transx_blog_listing_meta">
                                            <span class="transx_blog_listing_date"><?php echo esc_html(get_the_date()); ?></span>
                                            <span class="transx_separator">/</span>
                                            <span class="transx_blog_listing_author"><?php echo esc_html__('by ', 'transx-plugin');  the_author(); ?></span>
                                        </div>
                                        <?php

                                        if (get_the_title() !== '') {
                                            ?>
                                            <h4 class="transx_blog_listing_title">
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                            </h4>
                                            <?php
                                        }

                                        if (get_the_excerpt() !== '') {
                                            $transx_excerpt = transx_excerpt_truncate(get_the_excerpt(), 280, '...');
                                            ?>
                                            <p class="transx_blog_listing_excerpt"><?php echo esc_html($transx_excerpt); ?></p>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="transx_blog_listing_image_container">
                                            <img class="transx_img--bg" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Featured Image', 'transx-plugin'); ?>" />
                                        </div>

                                        <div class="transx_blog_listing_content">
                                            <div class="transx_blog_listing_meta">
                                                <span class="transx_blog_listing_date"><?php echo esc_html(get_the_date()); ?></span>
                                                <span class="transx_separator">/</span>
                                                <span class="transx_blog_listing_author"><?php echo esc_html__('by ', 'transx-plugin');  the_author(); ?></span>
                                            </div>

                                            <?php
                                            if (get_the_title() !== '') {
                                                ?>
                                                <h5 class="transx_blog_listing_title">
                                                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                                </h5>
                                                <?php
                                            }

                                            if (get_the_excerpt() !== '') {
                                                $transx_excerpt = transx_excerpt_truncate(get_the_excerpt(), 115, '...');
                                                ?>
                                                <p class="transx_blog_listing_excerpt"><?php echo esc_html($transx_excerpt); ?></p>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        if ($i < 5) {
                            $i++;
                        } else {
                            $i = 1;
                        }
                    }
                }

                if ($view_type == 'type_2') {
                    ?>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php
            if ($pagination == 'show') {
                ?>
                <div class="transx_pagination">
                    <?php
                    echo get_the_posts_pagination(array(
                        'prev_text' => esc_html__('Back', 'transx-plugin'),
                        'next_text' => esc_html__('Next', 'transx-plugin')
                    ));
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        wp_reset_query();
    }

    protected function content_template() {}

    public function render_plain_content() {}
}