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

class Transx_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_button';
    }

    public function get_title() {
        return esc_html__('Button', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-button';
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
                'label' => esc_html__('Button', 'transx-plugin')
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button', 'transx-plugin')
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'transx-plugin'),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .transx_button_container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'full_status',
            [
                'label' => esc_html__('Fullwidth Button', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'transx-plugin'),
                'label_on' => esc_html__('Yes', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Button Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_settings',
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

        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];

        if ($button_link['url'] !== '') {
            $button_url = $button_link['url'];
        } else {
            $button_url = '#';
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_button_widget">
            <div class="transx_button_container">
                <a class="transx_button transx_button--primary <?php echo (($settings['full_status'] == 'yes') ? 'transx_fullwidth_button' : ''); ?>" href="<?php echo esc_url($button_url); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                    <span><?php echo esc_html($button_text); ?></span>
<!--                    <svg class="icon">-->
<!--                        <svg viewBox="0 0 150 78.6" xmlns="http://www.w3.org/2000/svg"><path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"/></svg>-->
<!--                    </svg>-->
                </a>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
