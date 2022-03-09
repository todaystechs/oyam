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

class Transx_Linked_Item_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_linked_item';
    }

    public function get_title() {
        return esc_html__('Linked Item', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-link';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['linked_item_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Linked Item', 'transx-plugin')
            ]
        );

        $this->add_control(
            'image_bg',
            [
                'label' => esc_html__('Background Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Up Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Up Title', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Up Title', 'transx-plugin')
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Title', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Title', 'transx-plugin')
            ]
        );

        $this->add_control(
            'counter',
            [
                'label' => esc_html__('Counter', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Count', 'transx-plugin')
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label' => esc_html__('Link Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('Linked All Item', 'transx-plugin'),
                    'title' => esc_html__('Linked Title', 'transx-plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'transx-plugin'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'http://your-link.com', 'transx-plugin' )
            ]
        );

        $this->add_responsive_control(
            'item_align',
            [
                'label' => esc_html__('Info Box Alignment', 'transx-plugin'),
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
                    '{{WRAPPER}} .transx_linked_item' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------------ //
        // ---------- Linked Item Settings ---------- //
        // ------------------------------------------ //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Linked Item Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Linked Item Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_linked_item .transx_linked_item_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_overlay' => 'background: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
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
                ]
            ]
        );

        $this->add_control(
            'up_title_margin',
            [
                'label' => esc_html__('Space After Up Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_linked_item_up_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_typography',
                'label' => esc_html__('Up Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_linked_item_up_title'
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_linked_item_up_title' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .transx_linked_item_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_linked_item_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_linked_item_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Space After Description', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_linked_item_text' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Description Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_linked_item_text'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Description Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_linked_item_text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Button Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_button_settings',
            [
                'label' => esc_html__('Button Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
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

            $this->end_controls_tab();

        $this->end_controls_tabs();

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
    }

    protected function render() {
        $settings = $this->get_settings();

        $image_bg = $settings['image_bg'];
        $up_title = $settings['up_title'];
        $title = $settings['title'];
        $counter = $settings['counter'];
        $link_type = $settings['link_type'];
        $link = $settings['link'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        if ($link['url'] !== '') {
            $link_url = $link['url'];
        } else {
            $link_url = '#';
        }
        ?>

        <div class="transx_linked_item_widget">
            <div class="transx_linked_item">
                <?php
                if ($link_type == 'all') {
                    ?>
                    <a class="transx_linked_item_wrapper" href="<?php echo esc_url($link_url); ?>" <?php echo (($link['is_external'] == true) ? 'target="_blank"' : ''); echo (($link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                    <?php
                } else {
                    ?>
                    <div class="transx_linked_item_wrapper">
                    <?php
                }
                    ?>
                    <img class="transx_img--bg" src="<?php echo esc_url($image_bg['url']); ?>" alt="<?php echo esc_html__('Background Image', 'transx-plugin'); ?>" />
                    <div class="transx_overlay"></div>

                    <?php
                    if ($up_title !== '') {
                        ?>
                        <div class="transx_linked_item_up_title"><div><?php echo wp_kses($up_title, 'post'); ?></div></div>
                        <?php
                    }
                    ?>

                    <div class="transx_action_block_inner">
                        <?php
                        if ($title !== '') {
                            ?>
                            <h5>
                                <?php
                                if ($link_type == 'title') {
                                    ?>
                                    <a class="transx_linked_title" href="<?php echo esc_url($link_url); ?>" <?php echo (($link['is_external'] == true) ? 'target="_blank"' : ''); echo (($link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                                    <?php
                                    }
                                    ?>

                                    <span class="transx_linked_item_title"><?php echo wp_kses($title, 'post'); ?></span>

                                    <?php
                                    if ($link_type == 'title') {
                                    ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </h5>
                            <?php
                        }

                        if ($counter !== '') {
                            ?>
                            <span class="transx_linked_item_counter"><?php echo esc_html($counter); ?></span>
                            <?php
                        }
                        ?>
                    </div>

                    <?php
                if ($link_type == 'all') {
                    ?>
                    </a>
                    <?php
                } else {
                    ?>
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