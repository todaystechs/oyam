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
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Transx_Heading_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_heading';
    }

    public function get_title() {
        return esc_html__('Heading', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__('Heading', 'transx-plugin')
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
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => esc_html__( 'H1', 'transx-plugin' ),
                    'h2' => esc_html__( 'H2', 'transx-plugin' ),
                    'h3' => esc_html__( 'H3', 'transx-plugin' ),
                    'h4' => esc_html__( 'H4', 'transx-plugin' ),
                    'h5' => esc_html__( 'H5', 'transx-plugin' ),
                    'h6' => esc_html__( 'H6', 'transx-plugin' ),
                    'div' => esc_html__( 'div', 'transx-plugin' ),
                    'span' => esc_html__( 'span', 'transx-plugin' ),
                    'p' => esc_html__( 'p', 'transx-plugin' )
                ],
                'default' => 'h2'
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label' => esc_html__('Heading Alignment', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'transx-plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'transx-plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'transx-plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .transx_heading' => 'text-align: {{VALUE}};',
                ],
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
                'default' => esc_html__( 'Up Heading', 'transx-plugin' ),
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_align',
            [
                'label' => esc_html__('Up Heading Alignment', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'transx-plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'transx-plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'transx-plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading' => 'text-align: {{VALUE}};',
                ],
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

        $this->add_responsive_control(
            'up_title_marker_align',
            [
                'label' => esc_html__('Overlay Alignment', 'transx-plugin'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'transx-plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'transx-plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'transx-plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading_overlay' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'up_title_marker' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_marker_width',
            [
                'label' => esc_html__('Overlay Container Width', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 300
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading_overlay' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'up_title_marker' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Heading Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_heading_settings',
            [
                'label' => esc_html__('Heading Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Heading Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_heading'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'label' => esc_html__('Heading Text Shadow', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_heading'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Heading Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_heading' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
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
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_margin',
            [
                'label' => esc_html__('Space After Up Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_marker_size',
            [
                'label' => esc_html__('Up Heading Overlay Border Size', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading_overlay' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'up_title_marker' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_marker_typography',
                'label' => esc_html__('Up Heading Overlay Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_up_heading_overlay',
                'condition' => [
                    'up_title_marker' => 'yes'
                ]
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
                    'up_title_marker' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_marker_position',
            [
                'label' => esc_html__('Up Heading Overlay Vertical Position', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading_overlay' => 'top: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'up_title_marker' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $heading = $settings['heading'];
        $title_tag = $settings['title_tag'];
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

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_heading_widget">
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
                ?>

                <<?php echo $title_tag; ?> class="transx_heading">
                    <?php echo wp_kses($heading, 'post'); ?>
                </<?php echo $title_tag; ?>>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
