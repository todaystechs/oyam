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

class Transx_Location_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_location';
    }

    public function get_title() {
        return esc_html__('Location', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-google-maps';
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
                'label' => esc_html__('Location', 'transx-plugin')
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Location Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'location_name',
            [
                'label' => esc_html__('Location Name', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Location Link', 'transx-plugin'),
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
            'location_address',
            [
                'label' => esc_html__('Location Address', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => ''
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => esc_html__('Features Fields Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'feature_name',
            [
                'label' => esc_html__('Feature', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => esc_html__('Enter Text', 'transx-plugin'),
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->add_control(
            'schedule_title',
            [
                'label' => esc_html__('Work Schedule Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'schedule_name',
            [
                'label' => esc_html__('Work Hours', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '',
                'placeholder' => esc_html__('Enter Text', 'transx-plugin'),
            ]
        );

        $this->add_control(
            'schedule',
            [
                'label' => esc_html__('Work Schedule', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->add_control(
            'phones_title',
            [
                'label' => esc_html__('Phones Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'phone_title',
            [
                'label' => esc_html__('Phone Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => esc_html__('Enter Phone Title', 'transx-plugin'),
            ]
        );

        $repeater->add_control(
            'phone_number',
            [
                'label' => esc_html__('Phone Number', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => esc_html__('Enter Phone Number', 'transx-plugin'),
            ]
        );

        $this->add_control(
            'phones',
            [
                'label' => esc_html__('Phones', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Location Settings ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Location Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => esc_html__('Location Name Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_location_title'
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Location Name Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_location_title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'name_hover',
            [
                'label' => esc_html__('Location Name Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_location_title:hover a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'name_margin',
            [
                'label' => esc_html__('Space After Location Name', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_location_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'address_typography',
                'label' => esc_html__('Address Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_location_address'
            ]
        );

        $this->add_control(
            'address_color',
            [
                'label' => esc_html__('Address Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_location_address' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'address_margin',
            [
                'label' => esc_html__('Space After Address', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_location_address' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'label' => esc_html__('Features Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_features_title'
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__('Features Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_features_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'features_title_margin',
            [
                'label' => esc_html__('Space After Features Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_features_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_typography',
                'label' => esc_html__('Features Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_location_item ul li'
            ]
        );

        $this->add_control(
            'features_color',
            [
                'label' => esc_html__('Features Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_location_item ul li' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'features_margin',
            [
                'label' => esc_html__('Space After Features', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_location_item ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'schedule_title_typography',
                'label' => esc_html__('Schedule Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_schedule_title'
            ]
        );

        $this->add_control(
            'schedule_title_color',
            [
                'label' => esc_html__('Schedule Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_schedule_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'schedule_title_margin',
            [
                'label' => esc_html__('Space After Schedule Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_schedule_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'schedule_typography',
                'label' => esc_html__('Schedule Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_schedule_item'
            ]
        );

        $this->add_control(
            'schedule_color',
            [
                'label' => esc_html__('Schedule Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_schedule_item' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'schedule_margin',
            [
                'label' => esc_html__('Space After Schedule', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_schedule_item' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'phone_title_typography',
                'label' => esc_html__('Phone Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_phones_title'
            ]
        );

        $this->add_control(
            'phone_title_color',
            [
                'label' => esc_html__('Phone Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_phones_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'phone_title_margin',
            [
                'label' => esc_html__('Space After Phone Title', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_phones_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'phone_typography',
                'label' => esc_html__('Phone Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_phone_item'
            ]
        );

        $this->add_control(
            'phone_color',
            [
                'label' => esc_html__('Phone Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_phone_item a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'phone_hover',
            [
                'label' => esc_html__('Phone Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_phone_item a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'phone_margin',
            [
                'label' => esc_html__('Space After Phone', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_phone_item' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $image = $settings['image'];
        $location_name = $settings['location_name'];
        $link = $settings['link'];
        $location_address = $settings['location_address'];
        $features_title = $settings['features_title'];
        $features = $settings['features'];
        $schedule_title = $settings['schedule_title'];
        $schedule = $settings['schedule'];
        $phones_title = $settings['phones_title'];
        $phones = $settings['phones'];

        if ($link['url'] !== '') {
            $link_url = $link['url'];
        } else {
            $link_url = '#';
        }

        $image_src = aq_resize(esc_url($image['url']), 570, 320, true, true, true);

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_location_widget">
            <div class="transx_location_item">
                <div class="transx_location_image_container">
                    <img src="<?php echo esc_url($image_src); ?>" class="transx_img--bg" alt="<?php echo esc_html__('Location Image', 'transx-plugin'); ?>" />
                </div>

                <div class="transx_location_content_container">
                    <h4 class="transx_location_title">
                        <a href="<?php echo esc_url($link_url); ?>" <?php echo (($link['is_external'] == true) ? '$link="_blank"' : ''); echo (($link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo wp_kses($location_name, 'post'); ?></a>
                    </h4>

                    <div class="transx_location_address"><?php echo wp_kses($location_address, 'post'); ?></div>

                    <h6 class="transx_features_title"><?php echo wp_kses($features_title, 'post'); ?></h6>

                    <?php
                    if (!empty($features)) {
                        ?>
                        <ul class="transx_features_list">
                            <?php
                            foreach ($features as $feature) {
                                ?>
                                <li class="transx_features_list_item"><?php echo esc_html($feature['feature_name']); ?></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="transx_schedule_title"><?php echo esc_html($schedule_title); ?></h6>

                            <div class="transx_schedule">
                                <?php
                                foreach ($schedule as $item) {
                                    ?>
                                    <div class="transx_schedule_item"><?php echo wp_kses($item['schedule_name'], 'Featured Code'); ?></div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <h6 class="transx_phones_title"><?php echo esc_html($phones_title); ?></h6>
                            <?php
                            foreach ($phones as $phone){
                                ?>
                                <div class="transx_phone_item">
                                    <a class="transx_phone_link" href="tel:<?php echo esc_attr(str_replace(' ', '', $phone['phone_number'])); ?>">
                                        <?php echo esc_html($phone['phone_title']); ?>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}

