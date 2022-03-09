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

class Transx_Content_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_content_slider';
    }

    public function get_title() {
        return esc_html__('Content Slider', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['content_slider_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content Slider', 'transx-plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('Type 1', 'transx-plugin'),
                    'type_2' => esc_html__('Type 2', 'transx-plugin'),
                    'type_4' => esc_html__('Type 3', 'transx-plugin'),
                    'type_6' => esc_html__('Type 4', 'transx-plugin'),
                ]
            ]
        );

        $this->add_control(
            'content_width_type',
            [
                'label' => esc_html__('Content Width Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'boxed',
                'options' => [
                    'boxed' => esc_html__('Boxed', 'transx-plugin'),
                    'full' => esc_html__('Fullwidth', 'transx-plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => esc_html__('Slider Height', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '900',
                    'unit' => 'px'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 2000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slide' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slide_name',
            [
                'label' => esc_html__('Slide Name', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Slide Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'heading_part_1',
            [
                'label' => esc_html__('Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter title', 'transx-plugin'),
                'default' => esc_html__('Title', 'transx-plugin')
            ]
        );

        $repeater->add_control(
            'heading_part_2',
            [
                'label' => esc_html__('Title Overlay', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter title overlay', 'transx-plugin'),
                'default' => esc_html__('Title Overlay', 'transx-plugin')
            ]
        );

        $repeater->add_responsive_control(
            'overlay_align',
            [
                'label' => esc_html__('Title Overlay Alignment', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'transx-plugin' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'transx-plugin' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'transx-plugin' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slide_wrapper' => 'justify-content: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Promo Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => '10',
                'default' => '',
                'placeholder' => esc_html__('Enter Promo Text', 'transx-plugin'),
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button', 'transx-plugin')
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'transx-plugin'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'http://your-link.com', 'transx-plugin' ),
            ]
        );

        $repeater->add_responsive_control(
            'content_max_width',
            [
                'label' => esc_html__('Content Container Max Width', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 2000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_container' => 'max-width: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Content Top Offset', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slide_wrapper' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__('Promo Text Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slider_promo_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__('Content Container Alignment', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'transx-plugin' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'transx-plugin' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'transx-plugin' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slide_wrapper' => 'justify-content: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_v_align',
            [
                'label' => esc_html__('Content Container Vertical Alignment', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'transx-plugin' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'transx-plugin' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'transx-plugin' ),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slide_wrapper' => 'align-items: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_text_align',
            [
                'label' => esc_html__('Content Container Text Align', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'transx-plugin' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'transx-plugin' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'transx-plugin' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_container' => 'text-align: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'divider_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slider_title'
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slider_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'divider_2',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_2_typography',
                'label' => esc_html__('Title Part 2 Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slider_title span'
            ]
        );

        $repeater->add_control(
            'title_2_color',
            [
                'label' => esc_html__('Title Part 2 Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slider_title span' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'text_color',
            [
                'label' => esc_html__('Promo Text Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_content_slider_promo_text' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->start_controls_tabs('button_settings_tabs');

        // ------------------------ //
        // ------ Normal Tab ------ //
        // ------------------------ //
        $repeater->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'transx-plugin')
            ]
        );

        $repeater->add_control(
            'button_color',
            [
                'label' => esc_html__('Button Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button' => 'color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'button_bg',
            [
                'label' => esc_html__('Button Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'button_border',
            [
                'label' => esc_html__('Button Border', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button',
            ]
        );

        $repeater->end_controls_tab();

        // ----------------------- //
        // ------ Hover Tab ------ //
        // ----------------------- //
        $repeater->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'transx-plugin')
            ]
        );

        $repeater->add_control(
            'button_color_hover',
            [
                'label' => esc_html__('Button Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'button_bg_hover',
            [
                'label' => esc_html__('Button Background Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'button_border_hover',
            [
                'label' => esc_html__('Button Border Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button:hover' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .transx_button:hover',
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{slide_name}}}',
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Additional Fields ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_fields',
            [
                'label' => esc_html__('Additional Fields', 'transx-plugin')
            ]
        );

        $this->add_control(
            'short_promo_status',
            [
                'label' => esc_html__('Content Slider Anchor', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'short_promo',
            [
                'label' => esc_html__('Enter Anchor Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Scroll Down', 'transx-plugin'),
                'label_block' => true,
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'anchor_link',
            [
                'label' => esc_html__('Enter Anchor ID', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_status',
            [
                'label' => esc_html__('Video', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__('Enter Video Link', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_image',
            [
                'label' => esc_html__('Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_text',
            [
                'label' => esc_html__('Play Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter Play Button Text', 'transx-plugin'),
                'default' => esc_html__('Watch Our Video', 'transx-plugin'),
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_1_title_status',
            [
                'label' => esc_html__('Additional Info Block', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'info_1_image',
            [
                'label' => esc_html__('Additional Info Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'info_1_title_status' => 'yes',
                    'view_type!' => ['type_1', 'type_2', 'type_4']
                ]
            ]
        );

        $this->add_control(
            'info_1_title',
            [
                'label' => esc_html__('Additional Info Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'info_1_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_1_text',
            [
                'label' => esc_html__('Additional Info Content', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'info_1_title_status' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'info_1_bg',
                'label' => esc_html__('Info Box Background', 'transx-plugin'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .transx_additional_info_container.first_cont',
                'condition' => [
                    'info_1_title_status' => 'yes',
                    'view_type!' => ['type_1', 'type_2', 'type_4']
                ]
            ]
        );

        $this->add_control(
            'info_2_title_status',
            [
                'label' => esc_html__('Additional Info Block', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'info_2_image',
            [
                'label' => esc_html__('Additional Info Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'info_2_title_status' => 'yes',
                    'view_type!' => ['type_1', 'type_2', 'type_4']
                ]
            ]
        );

        $this->add_control(
            'info_2_title',
            [
                'label' => esc_html__('Additional Info Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'info_2_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_2_text',
            [
                'label' => esc_html__('Additional Info Content', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'info_2_title_status' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'info_2_bg',
                'label' => esc_html__('Info Box Background', 'transx-plugin'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .transx_additional_info_container.second_cont',
                'condition' => [
                    'info_1_title_status' => 'yes',
                    'view_type!' => ['type_1', 'type_2', 'type_4']
                ]
            ]
        );

        $this->end_controls_section();

        // ---------------------------- //
        // ---------- Slider ---------- //
        // ---------------------------- //
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
                'default' => 1200,
                'separator' => 'before'
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

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Content Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Promo Text Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_content_slider_promo_text'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Promo Text Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_promo_text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label' => esc_html__('Space Before Promo Text', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_promo_text' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_button'
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

                $this->add_control(
                    'button_color',
                    [
                        'label' => esc_html__('Button Color', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_button' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_bg',
                    [
                        'label' => esc_html__('Button Background', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_button' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_border',
                    [
                        'label' => esc_html__('Button Border', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_button' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow',
                        'selector' => '{{WRAPPER}} .transx_button',
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

                $this->add_control(
                    'button_color_hover',
                    [
                        'label' => esc_html__('Button Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_button:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_bg_hover',
                    [
                        'label' => esc_html__('Button Background Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_button:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_border_hover',
                    [
                        'label' => esc_html__('Button Border Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_button:hover' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow_hover',
                        'selector' => '{{WRAPPER}} .transx_button:hover',
                    ]
                );

                $this->add_control(
                    'nav_hover',
                    [
                        'label' => esc_html__('Slider Buttons Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_slider_nav_button:hover' => 'color: {{VALUE}};'
                        ],
                        'separator' => 'before'
                    ]
                );

                $this->add_control(
                    'nav_bg_hover',
                    [
                        'label' => esc_html__('Slider Buttons Hover Background', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_slider_nav_button:hover' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'nav_border_hover',
                    [
                        'label' => esc_html__('Slider Buttons Border Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_slider_nav_button:hover' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Space Before Button', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_button' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'button_radius',
            [
                'label' => esc_html__('Border Radius', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Fields Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_fields_settings',
            [
                'label' => esc_html__('Additional Fields Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'fields_height',
            [
                'label' => esc_html__('Additional Fields Height', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 600
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_1 .transx_additional_fields_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_4 .transx_additional_fields_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_2 .transx_additional_fields_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_2 .transx_anchor_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_3 .transx_anchor_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_3 .transx_anchor_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_3 .transx_promo_video_container' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'fields_bg_color',
            [
                'label' => esc_html__('Additional Fields Container Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_1 .transx_additional_fields_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_2 .transx_additional_fields_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_2 .transx_anchor_container, {{WRAPPER}} .transx_content_slider_wrapper.transx_view_type_3 .transx_anchor_container' => 'background: {{VALUE}};'
                ]
            ]
        );

        // --- Slider Anchor --- //
        $this->add_control(
            'anchor_color',
            [
                'label' => esc_html__('Slider Anchor Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_anchor' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'short_promo_status' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'anchor_hover',
            [
                'label' => esc_html__('Slider Anchor Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_anchor:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'anchor_typography',
                'label' => esc_html__('Slider Anchor Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_anchor span',
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        // --- Video --- //
        $this->add_control(
            'video_overlay_color',
            [
                'label' => esc_html__('Video Overlay Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container:before' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'video_text_color',
            [
                'label' => esc_html__('Play Button Text Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container .transx_video_trigger' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_text_hover',
            [
                'label' => esc_html__('Play Button Text Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container .transx_video_trigger:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_color',
            [
                'label' => esc_html__('Play Button Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container .transx_video_trigger i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_hover',
            [
                'label' => esc_html__('Play Button Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container .transx_video_trigger:hover i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_bg_color',
            [
                'label' => esc_html__('Play Button Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container .transx_video_trigger i' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_bg_hover',
            [
                'label' => esc_html__('Play Button Background Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_content_slider_wrapper .transx_promo_video_container .transx_video_trigger:hover i' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        // --- Info Fields --- //
        $this->add_control(
            'info_title_color',
            [
                'label' => esc_html__('Info Titles Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_additional_info_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'before',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_title_typography',
                'label' => esc_html__('Info Titles Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_additional_info_title',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => esc_html__('Info Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_additional_info, {{WRAPPER}} .transx_additional_info a' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'info_hover',
            [
                'label' => esc_html__('Info Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_additional_info a:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'label' => esc_html__('Info Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_additional_info',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $content_width_type = $settings['content_width_type'];
        $slides = $settings['slides'];
        $short_promo_status = $settings['short_promo_status'];
        $short_promo = $settings['short_promo'];
        $anchor_link = $settings['anchor_link'];
        $video_status = $settings['video_status'];
        $video_link = $settings['video_link'];
        $video_image = $settings['video_image'];
        $video_button_text = $settings['video_button_text'];
        $info_1_title_status = $settings['info_1_title_status'];
        $info_1_image = $settings['info_1_image'];
        $info_1_title = $settings['info_1_title'];
        $info_1_text = $settings['info_1_text'];
        $info_2_title_status = $settings['info_2_title_status'];
        $info_2_image = $settings['info_2_image'];
        $info_2_title = $settings['info_2_title'];
        $info_2_text = $settings['info_2_text'];

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

        <div class="transx_content_slider_widget">
            <div class="transx_content_slider_wrapper transx_view_<?php echo esc_attr($view_type); ?>">

                <div class="transx_content_slider transx_slider_slick" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>" <?php echo (($settings['rtl_support'] == 'yes') ? 'dir="rtl"' : ''); ?>>
                    <?php
                    foreach ($slides as $slide) {
                        ?>
                        <div class="transx_content_slide elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>" style="background: url('<?php echo esc_attr($slide['image']['url']); ?>')">
                            <?php
                            if ($content_width_type == 'boxed') {
                                ?>
                                <div class="container transx_full_cont">
                                    <div class="row transx_full_cont">
                                        <div class="col-12 transx_full_cont">
                                            <?php
                                            }
                                            ?>

                                            <div class="transx_content_slide_wrapper">
                                                <div class="transx_content_container">
                                                    <?php
                                                    if ($slide['heading_part_1'] !== '' || $slide['heading_part_2'] !== '') {
                                                        ?>
                                                        <div class="transx_content_wrapper_1">
                                                            <?php
                                                            if ($slide['heading_part_2'] !== '') {
                                                                ?>
                                                                <div class="transx_up_heading_overlay transx_overlay_align_<?php echo esc_attr($slide['overlay_align']); ?>"><?php echo esc_html($slide['heading_part_2']); ?></div>
                                                                <?php
                                                            }
                                                            ?>

                                                            <h2 class="transx_content_slider_title">
                                                                <?php echo transx_output_code($slide['heading_part_1']); ?>
                                                            </h2>
                                                        </div>
                                                        <?php
                                                    }

                                                    if ($slide['text'] !== '') {
                                                        ?>
                                                        <div class="transx_content_wrapper_2">
                                                            <div class="transx_content_slider_promo_text"><?php echo transx_output_code($slide['text']); ?></div>
                                                        </div>
                                                        <?php
                                                    }

                                                    if ($slide['button_text'] !== '') {
                                                        if ($slide['button_link']['url'] !== '') {
                                                            $button_url = $slide['button_link']['url'];
                                                        } else {
                                                            $button_url = '#';
                                                        }

                                                        ?>
                                                        <div class="transx_content_wrapper_3">
                                                            <a class="transx_button transx_button--primary" href="<?php echo esc_url($button_url); ?>" <?php echo (($slide['button_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($slide['button_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($slide['button_text']); ?></a>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <?php
                                            if ($content_width_type == 'boxed') {
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Slider Navigation -->
                <?php
                if ($view_type !== 'type_3') {
                    if ($view_type == 'type_2' || $view_type == 'type_4' || $view_type == 'type_5') {
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                    }
                                    ?>

                                    <div class="transx_causes_slider_navigation_container">
                                        <div class="transx_slider_counter">
                                            <span class="transx_current_slide"></span>
                                            <span class="transx_separator">/</span>
                                            <span class="transx_all_slides"></span>
                                        </div>
                                        <div class="transx_slider_arrows"></div>
                                    </div>

                                    <?php
                                    if ($view_type == 'type_2' || $view_type == 'type_4' || $view_type == 'type_5') {
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                // ------------------------- //
                // --- Additional Fields --- //
                // ------------------------- //

                // ################### //
                // ### View Type 1 ### //
                // ################### //
                if ($view_type == 'type_1' || $view_type == 'type_4' || $view_type == 'type_6') {

                    if ($short_promo_status == 'yes' && $view_type == 'type_1') {
                        ?>
                        <div class="transx_anchor_container">
                            <a class="transx_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="transx_additional_fields_container">
                        <?php
                        if ($short_promo_status == 'yes' && $view_type !== 'type_1') {
                            ?>
                            <a class="transx_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                            <?php
                        }

                        if ($video_status == 'yes') {
                            ?>
                            <div class="transx_promo_video_container">
                                <img src="<?php echo esc_url($video_image['url']); ?>" alt="<?php echo esc_html__('Background', 'transx-plugin'); ?>" />

                                <a class="transx_video_trigger" href="<?php echo esc_url($video_link); ?>">
                                    <?php
                                    if ($video_button_text !== '') {
                                        ?>
                                        <span><?php echo esc_html($video_button_text); ?></span>
                                        <?php
                                    }
                                    ?>
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                            <?php
                        }

                        if ($view_type == 'type_1' || $view_type == 'type_4') {
                            if ($info_1_title_status == 'yes') {
                                ?>
                                <div class="transx_additional_info_container first_cont">
                                    <?php
                                    if ($info_1_title !== '') {
                                        ?>
                                        <div class="transx_additional_info_title"><?php echo esc_html($info_1_title); ?></div>
                                        <?php
                                    }

                                    if ($info_1_text !== '') {
                                        ?>
                                        <div class="transx_additional_info"><?php echo transx_output_code($info_1_text); ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }

                            if ($info_2_title_status == 'yes') {
                                ?>
                                <div class="transx_additional_info_container">
                                    <?php
                                    if ($info_2_title !== '') {
                                        ?>
                                        <div class="transx_additional_info_title"><?php echo esc_html($info_2_title); ?></div>
                                        <?php
                                    }

                                    if ($info_2_text !== '') {
                                        ?>
                                        <div class="transx_additional_info"><?php echo transx_output_code($info_2_text); ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        } else {
                            if ($info_1_title_status == 'yes') {
                                ?>
                                <div class="transx_additional_info_container first_cont">
                                    <div class="row align-items-center">
                                        <div class="col-3 transx_additional_info_image">
                                            <?php
                                            if ($info_1_image['url'] !== '') {
                                                ?>
                                                <img src="<?php echo esc_url($info_1_image['url']); ?>" alt="<?php echo esc_html__('Info Image', 'transx'); ?>" />
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="col-9 transx_additional_info_box">
                                            <?php
                                            if ($info_1_title !== '') {
                                                ?>
                                                <div class="transx_additional_info_title"><?php echo esc_html($info_1_title); ?></div>
                                                <?php
                                            }

                                            if ($info_1_text !== '') {
                                                ?>
                                                <div class="transx_additional_info"><?php echo transx_output_code($info_1_text); ?></div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                            if ($info_2_title_status == 'yes') {
                                ?>
                                <div class="transx_additional_info_container second_cont">
                                    <div class="row align-items-center">
                                        <div class="col-3 transx_additional_info_image">
                                            <?php
                                            if ($info_2_image['url'] !== '') {
                                                ?>
                                                <img src="<?php echo esc_url($info_2_image['url']); ?>" alt="<?php echo esc_html__('Info Image', 'transx'); ?>" />
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="col-9 transx_additional_info_box">
                                            <?php
                                            if ($info_2_title !== '') {
                                                ?>
                                                <div class="transx_additional_info_title"><?php echo esc_html($info_2_title); ?></div>
                                                <?php
                                            }

                                            if ($info_2_text !== '') {
                                                ?>
                                                <div class="transx_additional_info"><?php echo transx_output_code($info_2_text); ?></div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                }

                // ################################### //
                // ### View Type 2 and View Type 5 ### //
                // ################################### //
                if ($view_type == 'type_2' || $view_type == 'type_5') {
                    if ($view_type !== 'type_5') {
                        if ($short_promo_status == 'yes') {
                            ?>
                            <div class="transx_anchor_container">
                                <a class="transx_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="transx_additional_fields_container">
                        <?php
                        if ($info_1_title_status == 'yes') {
                            ?>
                            <div class="transx_additional_info_container info_container_1">
                                <?php
                                if ($info_1_title !== '') {
                                    ?>
                                    <div class="transx_additional_info_title"><?php echo transx_output_code($info_1_title); ?></div>
                                    <?php
                                }

                                if ($info_1_text !== '') {
                                    ?>
                                    <div class="transx_additional_info"><?php echo transx_output_code($info_1_text); ?></div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if ($info_2_title_status == 'yes') {
                            ?>
                            <div class="transx_additional_info_container info_container_2">
                                <?php
                                if ($info_2_title !== '') {
                                    ?>
                                    <div class="transx_additional_info_title"><?php echo transx_output_code($info_2_title); ?></div>
                                    <?php
                                }

                                if ($info_2_text !== '') {
                                    ?>
                                    <div class="transx_additional_info"><?php echo transx_output_code($info_2_text); ?></div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if ($video_status == 'yes') {
                            ?>
                            <div class="transx_promo_video_container">
                                <img src="<?php echo esc_url($video_image['url']); ?>" alt="<?php echo esc_html__('Background', 'transx-plugin'); ?>" />

                                <a class="transx_video_trigger" href="<?php echo esc_url($video_link); ?>">
                                    <?php
                                    if ($video_button_text !== '') {
                                        ?>
                                        <span><?php echo esc_html($video_button_text); ?></span>
                                        <?php
                                    }
                                    ?>
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                            <?php
                        }

                        if ($view_type == 'type_5') {
                            if ($short_promo_status == 'yes') {
                                ?>
                                <a class="transx_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                }

                // ################### //
                // ### View Type 3 ### //
                // ################### //
                if ($view_type == 'type_3') {
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="transx_additional_fields_container">
                                    <?php

                                    if ($video_status == 'yes') {
                                        ?>
                                        <div class="transx_promo_video_container">
                                            <img src="<?php echo esc_url($video_image['url']); ?>" alt="<?php echo esc_html__('Background', 'transx-plugin'); ?>" />

                                            <a class="transx_video_trigger" href="<?php echo esc_url($video_link); ?>">
                                                <?php
                                                if ($video_button_text !== '') {
                                                    ?>
                                                    <span><?php echo esc_html($video_button_text); ?></span>
                                                    <?php
                                                }
                                                ?>
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="transx_causes_slider_navigation_container">
                                        <div class="transx_slider_counter"></div>
                                        <div class="transx_slider_arrows"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
