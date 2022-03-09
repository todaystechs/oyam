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

class Transx_Price_Item_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_price_item';
    }

    public function get_title() {
        return esc_html__('Price Item', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-price-table';
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
                'label' => esc_html__('Price Item', 'transx-plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical' => esc_html__('Vertical', 'transx-plugin'),
                    'horizontal' => esc_html__('Horizontal', 'transx-plugin')
                ],
                'separator' => 'after'
            ]
        );

//        $this->add_control(
//            'svg_icon_status',
//            [
//                'label' => esc_html__('SVG Icon', 'transx-plugin'),
//                'type' => Controls_Manager::SWITCHER,
//                'label_off' => esc_html__('Off', 'transx-plugin'),
//                'label_on' => esc_html__('On', 'transx-plugin'),
//                'default' => 'no',
//                'condition' => [
//                    'view_type' => 'vertical'
//                ]
//            ]
//        );
//
//        $this->add_control(
//            'svg_icon',
//            [
//                'label' => esc_html__('SVG Icon Code', 'transx-plugin'),
//                'description' => esc_html__('Enter svg code', 'transx-plugin'),
//                'type' => Controls_Manager::TEXTAREA,
//                'default' => '',
//                'condition' => [
//                    'svg_icon_status' => 'yes'
//                ]
//            ]
//        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '$',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'currency_position',
            [
                'label' => esc_html__('Currency Position', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__('Before Price', 'transx-plugin'),
                    'after' => esc_html__('After Price', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

//        $this->add_control(
//            'period',
//            [
//                'label' => esc_html__('Period', 'transx-plugin'),
//                'type' => Controls_Manager::TEXT,
//                'placeholder' => esc_html__('month', 'transx-plugin')
//            ]
//        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'transx-plugin' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => esc_html__('Enter Text', 'transx-plugin'),
            ]
        );

        $repeater->add_control(
            'active_field_status',
            [
                'name' => 'active_field_status',
                'label' => esc_html__( 'Active Field', 'transx-plugin' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'transx-plugin'),
                'label_on' => esc_html__('Yes', 'transx-plugin'),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'custom_fields',
            [
                'label' => esc_html__('Custom Fields', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{text}}}',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'horizontal'
                ]
            ]
        );

        $this->add_control(
            'price_button_text',
            [
                'label' => esc_html__('Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'transx-plugin'),
                'placeholder' => esc_html__('Button Text', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'transx-plugin'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '#',
                ]
            ]
        );

        $this->add_control(
            'best_offer_status',
            [
                'label' => esc_html__('Best Offer', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'transx-plugin'),
                'label_on' => esc_html__('Yes', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ----------------------------------------- //
        // ---------- Price Item Settings ---------- //
        // ----------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Price Item Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Price Item Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_price_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'item_bg',
            [
                'label' => esc_html__('Price Item Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_price_item' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'best_offer_bg',
            [
                'label' => esc_html__('Best Offer Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_price_item.transx_best_offer_yes' => 'background-color: {{VALUE}};'
                ]
            ]
        );

//        $this->add_control(
//            'icon_color',
//            [
//                'label' => esc_html__('Icon Color', 'transx-plugin'),
//                'type' => Controls_Manager::COLOR,
//                'selectors' => [
//                    '{{WRAPPER}} .transx_price_icon_container' => 'color: {{VALUE}};'
//                ],
//                'separator' => 'before',
//                'condition' => [
//                    'view_type' => 'vertical'
//                ]
//            ]
//        );
//
//        $this->add_control(
//            'icon_bg',
//            [
//                'label' => esc_html__('Icon Box Background', 'transx-plugin'),
//                'type' => Controls_Manager::COLOR,
//                'selectors' => [
//                    '{{WRAPPER}} .transx_price_icon_container' => 'background-color: {{VALUE}};'
//                ],
//                'condition' => [
//                    'view_type' => 'vertical'
//                ]
//            ]
//        );
//
//        $this->add_control(
//            'divider_color',
//            [
//                'label' => esc_html__('Button Block Dividers Color', 'transx-plugin'),
//                'type' => Controls_Manager::COLOR,
//                'selectors' => [
//                    '{{WRAPPER}} .transx_price_button_container' => 'border-top-color: {{VALUE}};',
//                    '{{WRAPPER}} .transx_price_item_top:before, {{WRAPPER}} .transx_price_item_top:after' => 'background-color: {{VALUE}};'
//                ],
//                'separator' => 'before',
//                'condition' => [
//                    'view_type' => 'vertical'
//                ]
//            ]
//        );

        $this->add_control(
            'item_radius',
            [
                'label' => esc_html__('Price Item Border Radius', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_price_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'border_status',
            [
                'label' => esc_html__('Price Item Border', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'transx-plugin'),
                'label_on' => esc_html__('Yes', 'transx-plugin'),
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'vertical'
                ]

            ]
        );

        $this->add_control(
            'border_size',
            [
                'label' => esc_html__('Border Size', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_price_border_container' => 'padding: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_price_border_container' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__( 'Price Item Border', 'transx-plugin' ),
                'placeholder' => '2px',
                'default' => '2px',
                'selector' => '{{WRAPPER}} .transx_price_item',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'horizontal'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_shadow',
                'selector' => '{{WRAPPER}} .transx_price_item',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'horizontal'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Content Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
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
                    '{{WRAPPER}} .transx_price_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_price_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_price_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'price_margin',
            [
                'label' => esc_html__('Space After Price', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_price_container' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__('Price Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_price, {{WRAPPER}} .transx_currency'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'label' => esc_html__('Currency Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_currency'
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Price Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_price_wrapper' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'fields_margin',
            [
                'label' => esc_html__('Space Between Custom Fields', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_custom_field' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fields_typography',
                'label' => esc_html__('Custom Fields Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_custom_field',
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'fields_color',
            [
                'label' => esc_html__('Custom Fields Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_custom_field' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'active_fields_color',
            [
                'label' => esc_html__('Active Fields Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_custom_field.transx_active_field' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'marker_margin',
            [
                'label' => esc_html__('Space After Marker', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_custom_field:before' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_price_description',
                'condition' => [
                    'view_type' => 'horizontal'
                ]
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('description Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_price_description' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'horizontal'
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

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Space Before Button', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_price_button_container' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
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
                    '{{WRAPPER}} .transx_price_button_container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
//        $svg_icon_status = $settings['svg_icon_status'];
        $title = $settings['title'];
        $currency = $settings['currency'];
        $currency_position = $settings['currency_position'];
        $price = $settings['price'];
//        $period = $settings['period'];
        $custom_fields = $settings['custom_fields'];
        $description = $settings['description'];
        $price_button_text = $settings['price_button_text'];
        $button_link = $settings['button_link'];

        if ($view_type == 'vertical') {
            if ($settings['border_status'] == 'yes') {
                $border_status = $settings['border_status'];
            } else {
                $border_status = 'no';
            }
        } else {
            $border_status = 'no';
        }

//        if ($svg_icon_status == 'yes') {
//            $svg_icon = $settings['svg_icon'];
//        } else {
//            $svg_icon = '';
//        }

        if ($button_link['url'] !== '') {
            $button_url = $button_link['url'];
        } else {
            $button_url = '#';
        }

        if ($settings['best_offer_status'] == 'yes') {
            $best_offer_status = 'yes';
        } else {
            $best_offer_status = 'no';
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_price_item_widget">
            <?php
            if ($border_status == 'yes') {
                ?>
                <div class="transx_price_border_container">
                <?php
            }
            ?>

            <div class="transx_price_item transx_type_<?php echo esc_attr($view_type); ?> transx_best_offer_<?php echo esc_attr($best_offer_status); ?>">
                <?php
                // -------------------------- //
                // --- View Type Vertical --- //
                // -------------------------- //

                if ($view_type == 'vertical') {

                    if ($best_offer_status == 'yes') {
                        ?>
                        <div class="transx_price_overlay"></div>
                        <?php
                    }

                    ?>
                    <div class="transx_price_item_top">
                        <?php
//                        if ($svg_icon_status == 'yes') {
//                            ?>
<!--                            <div class="transx_price_icon_container">-->
<!--                                --><?php //echo transx_output_code($svg_icon); ?>
<!--                            </div>-->
<!--                            --><?php
//                        }

                        if ($title !== '') {
                            ?>
                            <h5 class="transx_price_title"><?php echo wp_kses($title, 'post'); ?></h5>
                            <?php
                        }

                        if ($price !== '') {
                            ?>
                            <div class="transx_price_container transx_currency_position_<?php echo esc_attr($currency_position); ?>">
                                <span class="transx_price_wrapper">
                                    <?php
                                    if ($currency !== '') {
                                        if ($currency_position == 'before') {
                                            ?>
                                            <span class="transx_currency"><?php echo esc_html($currency); ?></span>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <span class="transx_price"><?php echo esc_html($price); ?></span>

                                    <?php
                                    if ($currency !== '') {
                                        if ($currency_position == 'after') {
                                            ?>
                                            <span class="transx_currency"><?php echo esc_html($currency); ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </span>

                                <?php
//                                if ($period !== '') {
//                                    ?>
<!--                                    <span class="transx_period">--><?php //echo esc_html($period); ?><!--</span>-->
<!--                                    --><?php
//                                }
                                ?>
                            </div>
                            <?php
                        }

                        if (!empty($custom_fields)) {
                            ?>
                            <div class="transx_custom_fields_container">
                                <?php
                                foreach ($custom_fields as $field) {
                                    if ($field['active_field_status'] == 'yes') {
                                        $field_status_class = 'transx_active_field';
                                    } else {
                                        $field_status_class = '';
                                    }
                                    ?>

                                    <div class="transx_custom_field <?php echo esc_attr($field_status_class); ?>"><?php echo esc_html($field['text']); ?></div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="transx_price_button_container">
                        <a class="transx_button transx_button--primary" href="<?php echo esc_url($button_url); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($price_button_text); ?></a>
                    </div>
                    <?php
                }

                // ---------------------------- //
                // --- View Type Horizontal --- //
                // ---------------------------- //
                if ($view_type == 'horizontal') {
                    ?>
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <?php
                            if ($title !== '') {
                                ?>
                                <h5 class="transx_price_title"><?php echo esc_html($title); ?></h5>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-5">
                            <?php
                            if ($description !== '') {
                                ?>
                                <span class="transx_price_description"><?php echo esc_html($description); ?></span>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-2">
                            <?php
                            if ($price !== '') {
                                ?>
                                <div class="transx_price_container transx_currency_position_<?php echo esc_attr($currency_position); ?>">
                                    <span class="transx_price_wrapper">
                                        <?php
                                        if ($currency !== '') {
                                            if ($currency_position == 'before') {
                                                ?>
                                                <span class="transx_currency"><?php echo esc_html($currency); ?></span>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <span class="transx_price"><?php echo esc_html($price); ?></span>

                                        <?php
                                        if ($currency !== '') {
                                            if ($currency_position == 'after') {
                                                ?>
                                                <span class="transx_currency"><?php echo esc_html($currency); ?></span>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </span>

                                    <?php
//                                    if ($period !== '') {
//                                        ?>
<!--                                        <span class="transx_period">--><?php //echo esc_html($period); ?><!--</span>-->
<!--                                        --><?php
//                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-3">
                            <div class="transx_price_button_container">
                                <?php
                                if ($price_button_text !== '') {
                                    ?>
                                    <a class="transx_button transx_button--primary" href="<?php echo esc_url($button_url); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($price_button_text); ?></a>
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php
            if ($border_status == 'yes') {
                ?>
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