<?php
/*
 * Created by Artureanec
*/

namespace Transx\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
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

class Transx_Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_icon_box';
    }

    public function get_title() {
        return esc_html__('Icon Box', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-icon-box';
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
                'label' => esc_html__('Icon Box', 'transx-plugin')
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
                    'type_2' => esc_html__('View Type 2', 'transx-plugin'),
                    'type_3' => esc_html__('View Type 3', 'transx-plugin'),
                    'type_4' => esc_html__('View Type 4', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Type of Icon', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default Icon', 'transx-plugin'),
                    'svg' => esc_html__('SVG Icon', 'transx-plugin'),
                    'text' => esc_html__('Custom Text', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'default_icon',
            [
                'label' => esc_html__('Icon', 'transx-plugin'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'condition' => [
                    'icon_type' => 'default'
                ]
            ]
        );

        $this->add_control(
            'svg_icon',
            [
                'label' => esc_html__('SVG Icon', 'transx-plugin'),
                'description' => esc_html__('Enter svg code', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'icon_type' => 'svg'
                ]
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Custom Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter Custom Text', 'transx-plugin'),
                'condition' => [
                    'icon_type' => 'text'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Icon Box Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Title', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Icon Box Title', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'info_type',
            [
                'label' => esc_html__('Type of Icon Box Information', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'info',
                'label_block' => true,
                'options' => [
                    'info' => esc_html__('Custom Information', 'transx-plugin'),
                    'socials' => esc_html__('Social Icons', 'transx-plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'info',
            [
                'label' => esc_html__('Icon Box Information', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Custom Information', 'transx-plugin'),
                'condition' => [
                    'info_type' => 'info'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Icon', 'transx-plugin'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'social',
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'brand'
                ]
            ]
        );

        $repeater->add_control(
            'social_link',
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

        $this->add_control(
            'socials',
            [
                'label' => esc_html__('Social Icons', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{elementor.helpers.renderIcon(this, social_icon, {}, "i", "panel")}}}',
                'prevent_empty' => false,
                'condition' => [
                    'info_type' => 'socials'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_box_align',
            [
                'label' => esc_html__('Icon Box Alignment', 'transx-plugin'),
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
                    '{{WRAPPER}} .transx_icon_box_item' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'additional_title_status',
            [
                'label' => esc_html__('Additional Title', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'additional_title',
            [
                'label' => esc_html__('Additional Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Additional Title', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Additional Title', 'transx-plugin'),
                'condition' => [
                    'additional_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'count_status',
            [
                'label' => esc_html__('Count Number', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'count_number',
            [
                'label' => esc_html__('Count Number', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'min' => '1',
                'condition' => [
                    'count_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Icon Box Settings ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Icon Box Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Icon Box Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_box_item.transx_view_type_4' => 'background: {{VALUE}};'
                ],
                'separator' => 'after',
                'condition' => [
                    'view_type' => 'type_4'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__('Price Item Border', 'transx-plugin'),
                'placeholder' => '2px',
                'default' => '2px',
                'selector' => '{{WRAPPER}} .transx_icon_box_item.transx_view_type_2',
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Icon Box Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_box_item.transx_view_type_2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_container i, {{WRAPPER}} .transx_icon_container .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .transx_icon_container svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .transx_icon_container .transx_svg_icon' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'icon_type!' => 'text'
                ]
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_container i, {{WRAPPER}} .transx_icon_container .icon' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'icon_type!' => 'text'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Text Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_icon_box_text',
                'condition' => [
                    'icon_type' => 'text'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Space After Icon', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_container' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_box_text' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'icon_type' => 'text'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_box_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_icon_box_title'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Space Between Icon and Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_box_title' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type!' => 'type_4'
                ]
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => esc_html__('Information Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_info_container, {{WRAPPER}} .transx_info_container a' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'label' => esc_html__('Information Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_info_container',
                'condition' => [
                    'info_type' => 'info'
                ]
            ]
        );

        $this->add_responsive_control(
            'socials_size',
            [
                'label' => esc_html__('Social Icons Size', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_icon_box_socials li a' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'info_type' => 'socials'
                ]
            ]
        );

        $this->add_responsive_control(
            'info_margin',
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
                    '{{WRAPPER}} .transx_info_container' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'additional_title_margin',
            [
                'label' => esc_html__('Space Between Icon and Additional Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_info_box_additional_title' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before',
                'condition' => [
                    'additional_title_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $icon_type = $settings['icon_type'];
        $default_icon = $settings['default_icon'];
        $svg_icon = $settings['svg_icon'];
        $text = $settings['text'];
        $title = $settings['title'];
        $info_type = $settings['info_type'];
        $info = $settings['info'];
        $socials = $settings['socials'];
        $additional_title_status = $settings['additional_title_status'];
        $additional_title = $settings['additional_title'];
        $count_status = $settings['count_status'];
        $count_number = $settings['count_number'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_icon_box_widget">
            <div class="transx_icon_box_item transx_view_<?php echo esc_attr($view_type); ?>">
                <?php
                if ($view_type !== 'type_4') {
                    ?>
                    <div class="transx_icon_container">
                        <?php
                        if ($icon_type == 'default') {
                            if (is_array($default_icon['value'])) {
                                ?>
                                <img class="transx_svg_icon" src="<?php echo esc_url($default_icon['value']['url']); ?>" alt="<?php echo esc_html__('SVG Icon', 'transx-plugin') ?>" />
                                <?php
                            } else {
                                ?>
                                <i class="<?php echo esc_attr($default_icon['value']); ?>"></i>
                                <?php
                            }
                        }

                        if ($icon_type == 'svg') {
                            echo transx_output_code($svg_icon);
                        }

                        if ($icon_type == 'text') {
                            ?>
                            <span class="transx_icon_box_text"><?php echo esc_html($text); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>

                <?php
                if ($view_type == 'type_2' || $view_type == 'type_3') {
                    ?>
                    <div class="transx_icon_box_content_cont">
                    <?php
                }

                    if ($additional_title_status == 'yes' && $additional_title !== '') {
                        ?>
                        <h2 class="transx_info_box_additional_title"><?php echo esc_html($additional_title); ?></h2>
                        <?php
                    }

                    if ($title !== '') {
                        if ($view_type !== 'type_4') {
                            ?>
                            <h5 class="transx_icon_box_title">
                                <?php
                                if ($count_status == 'yes' && $count_number !== '') {
                                    ?>
                                    <span class="transx_count_number">
                                        <?php
                                        if ($count_number < 10) {
                                            $additional_simbol = 0;
                                        } else {
                                            $additional_simbol = '';
                                        }

                                        echo esc_html($additional_simbol) . esc_html($count_number);
                                        ?>
                                    </span>
                                    <?php
                                }
                                ?>

                                <?php echo transx_output_code($title); ?>
                            </h5>
                            <?php
                        } else {
                            ?>
                            <h4 class="transx_icon_box_title"><?php echo transx_output_code($title); ?></h4>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    if ($info !== '' || !empty($socials)) {
                        ?>
                        <div class="transx_info_container">
                            <?php
                            if ($info_type == 'info') {
                                if ($info !== '') {
                                    ?>
                                    <p><?php echo transx_output_code($info); ?></p>
                                    <?php
                                }
                            } else {
                                if (!empty($socials)) {
                                    ?>
                                    <ul class="transx_icon_box_socials">
                                        <?php
                                        foreach ($socials as $social) {
                                            if ($social['social_link']['url'] !== '') {
                                                $social_url = $social['social_link']['url'];
                                            } else {
                                                $social_url = '#';
                                            }
                                            ?>

                                            <li>
                                                <a href="<?php echo esc_url($social_url); ?>" <?php echo (($social['social_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($social['social_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><i class="<?php echo esc_attr($social['social_icon']['value']); ?>"></i></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }

                    if ($view_type == 'type_4') {
                        ?>
                        <div class="transx_icon_container">
                            <?php
                            if ($icon_type == 'default') {
                                if (is_array($default_icon['value'])) {
                                    ?>
                                    <img class="transx_svg_icon" src="<?php echo esc_url($default_icon['value']['url']); ?>" alt="<?php echo esc_html__('SVG Icon', 'transx-plugin') ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <i class="<?php echo esc_attr($default_icon['value']); ?>"></i>
                                    <?php
                                }
                            }

                            if ($icon_type == 'svg') {
                                echo transx_output_code($svg_icon);
                            }

                            if ($icon_type == 'text') {
                                ?>
                                <span class="transx_icon_box_text"><?php echo esc_html($text); ?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }

                if ($view_type == 'type_2' || $view_type == 'type_3') {
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