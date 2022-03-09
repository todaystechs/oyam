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

class Transx_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_gallery';
    }

    public function get_title() {
        return esc_html__('Gallery', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-inner-section';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['causes_grid_widget'];
    }

    protected function _register_controls() {
        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Gallery', 'transx-plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('Gallery Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('Masonry', 'transx-plugin'),
                    'type_2' => esc_html__('Grid', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'items_in_row',
            [
                'label' => esc_html__('Items In Row', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    2 => esc_html__('Two', 'transx-plugin'),
                    3 => esc_html__('Three', 'transx-plugin'),
                    4 => esc_html__('Four', 'transx-plugin')
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'title_type',
            [
                'label' => esc_html__('Image Title Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'title',
                'options' => [
                    'title' => esc_html__('Title', 'transx-plugin'),
                    'capture' => esc_html__('Capture', 'transx-plugin'),
                    'none' => esc_html__('None', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => esc_html__('Add Images', 'transx-plugin'),
                'type' => Controls_Manager::GALLERY,
                'default' => []
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Gallery Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Gallery Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('button_settings_tabs');

        // ------------------------ //
        // ------ Normal Tab ------ //
        // ------------------------ //
        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'transx-plugin')
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => esc_html__('Overlay Color', 'elementory'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .gallery-masonry__item .transx_overlay'
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'elementory'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-masonry__item .transx_overlay' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-masonry__item .gallery-masonry__description span' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_tab();

        // ----------------------- //
        // ------ Hover Tab ------ //
        // ----------------------- //
        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'transx-plugin')
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_hover',
                'label' => esc_html__('Overlay Color', 'elementory'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .gallery-masonry__item:hover .transx_overlay'
            ]
        );

        $this->add_control(
            'overlay_hover_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'elementory'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-masonry__item:hover .transx_overlay' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__('Title Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gallery-masonry__item:hover .gallery-masonry__description span' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .gallery-masonry__description span'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $title_type = $settings['title_type'];
        $images = $settings['images'];

        $i = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_gallery_widget">
            <div class="transx_gallery_wrapper view_<?php echo esc_attr($view_type); ?>">
                <div class="row no-gutters gallery-masonry">
                    <?php
                    foreach ($images as $image) {
                        $img_meta = transx_get_attachment_meta($image['id']);
                        $image_title = $img_meta['title'];
                        $image_caption = $img_meta['caption'];

                        if ($view_type == 'type_1') {
                            if ($i == 3 || $i == 4 || $i == 5 || $i == 6) {
                                $item_class = 'col-md-6 col-lg-6';
                            } else {
                                $item_class = 'col-md-6 col-lg-3';
                            }

                            if ($i == 3 || $i == 5) {
                                $height_class = 'gallery-masonry__item--height-1';
                            }

                            if ($i == 1 || $i == 2 || $i == 7 || $i == 8) {
                                $height_class = 'gallery-masonry__item--height-2';
                            }

                            if ($i == 4 || $i == 6) {
                                $height_class = 'gallery-masonry__item--height-3';
                            }
                        } else {
                            if ($settings['items_in_row'] == 2) {
                                $item_class = 'col-6';
                            }

                            if ($settings['items_in_row'] == 3) {
                                $item_class = 'col-md-6 col-lg-4';
                            }

                            if ($settings['items_in_row'] == 4) {
                                $item_class = 'col-md-6 col-lg-3';
                            }
                            $height_class = 'gallery-masonry__item--height-1';
                        }
                        ?>

                        <div class="<?php echo esc_attr($item_class); ?> gallery-masonry__item transx_item_<?php echo esc_attr($i); ?>">
                            <div class="gallery_masonry_item_wrapper">
                                <a class="gallery-masonry__img <?php echo esc_attr($height_class); ?>" href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-elementor-open-lightbox="no">
                                    <div class="transx_overlay"></div>
                                    <img class="transx_img--bg" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_html__('Image', 'transx-plugin'); ?>" />
                                </a>

                                <?php
                                if ($title_type !== 'none') {
                                    ?>
                                    <div class="gallery-masonry__description">
                                        <?php
                                        if ($title_type == 'title') {
                                            ?>
                                            <span><?php echo esc_html($image_title); ?></span>
                                            <?php
                                        } else {
                                            ?>
                                            <span><?php echo esc_html($image_caption); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php

                        if ($i < 11) {
                            $i++;
                        } else {
                            $i = 1;
                        }
                    }
                    ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}