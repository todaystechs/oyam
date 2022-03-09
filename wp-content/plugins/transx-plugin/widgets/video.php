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

class Transx_Video_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_video';
    }

    public function get_title() {
        return esc_html__('Video', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-play';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['video_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Video', 'transx-plugin')
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
                    'type_2' => esc_html__('Type 2', 'transx-plugin')
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__('Enter Video Link', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '',
                'default' => '',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Play Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter Play Button Text', 'transx-plugin'),
                'default' => esc_html__('Watch Our Video', 'transx-plugin'),
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => esc_html__('Button Alignment', 'transx-plugin'),
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
                    '{{WRAPPER}} .transx_preview_container' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Video Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Video Widget Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Image Custom Size', 'transx-plugin'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control(
            'image_width',
            [
                'label' => esc_html__('Image Width', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 1,
                'condition' => [
                    'image_size' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 1,
                'condition' => [
                    'image_size' => 'yes'
                ]
            ]
        );

        $this->end_popover();

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_overlay' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_1'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_overlay' => 'opacity: {{SIZE}};'
                ],
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'icon_button_size',
            [
                'label' => esc_html__('Trigger Button Size', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_button_icon, {{WRAPPER}} .transx_button_icon:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .transx_button_icon i' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_button_icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__('Space After Icon', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_button_icon' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'animation_status',
            [
                'label' => esc_html__('Animation', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'default' => 'yes',
                'separator' => 'after',
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Text Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_button_text'
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
                    'icon_color',
                    [
                        'label' => esc_html__('Icon Color', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button .transx_button_icon' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'icon_bg',
                    [
                        'label' => esc_html__('Icon Background', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button .transx_button_icon' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'icon_border',
                    [
                        'label' => esc_html__('Icon Border', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button .transx_button_icon' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_text_color',
                    [
                        'label' => esc_html__('Button Text Color', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button .transx_button_text' => 'color: {{VALUE}};'
                        ]
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
                    'icon_hover',
                    [
                        'label' => esc_html__('Icon Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button:hover .transx_button_icon' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'icon_bg_hover',
                    [
                        'label' => esc_html__('Icon Background Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button:hover .transx_button_icon' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'icon_border_hover',
                    [
                        'label' => esc_html__('Icon Border Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button:hover .transx_button_icon' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_text_hover',
                    [
                        'label' => esc_html__('Button Text Hover', 'transx-plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .transx_video_trigger_button:hover .transx_button_text' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_video_trigger_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'button_bg_hover',
            [
                'label' => esc_html__('Button Background Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_video_trigger_button' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $video_link = $settings['video_link'];
        $image = $settings['image'];
        $button_text = $settings['button_text'];
        $animation_status = $settings['animation_status'];

        if ($settings['image_size'] == 'yes') {
            $image_width = $settings['image_width'];
            $image_height = $settings['image_height'];
        } else {
            $image_width = 1170;
            $image_height = 550;
        }

        $image_src = aq_resize(esc_url($image['url']), $image_width, $image_height, true, true, true);

        if ($image_src == false) {
            $image_src = $image['url'];
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        $image_meta = transx_get_attachment_meta($image['id']);
        $image_alt = $image_meta['alt'];

        ?>

        <div class="transx_video_widget">
            <div class="transx_preview_container view_<?php echo esc_attr($view_type); ?>">
                <?php
                if ($view_type == 'type_1') {
                    ?>
                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                    <div class="transx_overlay"></div>
                    <?php
                }
                ?>

                <a class="transx_video_trigger_button transx_animation_<?php echo esc_attr($animation_status); ?>" href="<?php echo esc_url($video_link); ?>">
                    <span class="transx_button_icon"><i class="fa fa-play"></i></span>
                    <?php
                    if ($button_text !== '') {
                        ?>
                        <span class="transx_button_text"><?php echo esc_html($button_text); ?></span>
                        <?php
                    }
                    ?>
                </a>
            </div>

            <?php
            if ($video_link !== '') {
                ?>
                <div class="transx_video_container">
                    <div class="transx_close_popup_layer">
                        <div class="transx_close_button">
                            <svg viewBox="0 0 40 40"><path d="M10,10 L30,30 M30,10 L10,30"></path></svg>
                        </div>
                    </div>
                    <div class="transx_video_wrapper" data-src="<?php echo esc_url($video_link); ?>"></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
