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

class Transx_Person_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_person';
    }

    public function get_title() {
        return esc_html__('Person', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-person';
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
                'label' => esc_html__('Person', 'transx-plugin')
            ]
        );

//        $this->add_control(
//            'view_type',
//            [
//                'label' => esc_html__('View Type', 'transx-plugin'),
//                'type' => Controls_Manager::SELECT,
//                'default' => 'type_1',
//                'options' => [
//                    'type_1' => esc_html__('View Type 1', 'transx-plugin'),
//                    'type_2' => esc_html__('View Type 2', 'transx-plugin'),
//                    'type_3' => esc_html__('View Type 3', 'transx-plugin'),
//                ],
//                'separator' => 'after'
//            ]
//        );

        $this->add_control(
            'person_name',
            [
                'label' => esc_html__('Person Name', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'person_position',
            [
                'label' => esc_html__('Person Position', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'person_image',
            [
                'label' => esc_html__('Person Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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

        $repeater->add_control(
            'social_color',
            [
                'label' => esc_html__('Social Color', 'pm-eps'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'social_hover',
            [
                'label' => esc_html__('Social Hover', 'pm-eps'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
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
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Person Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Person Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

//        $this->add_control(
//            'image_size',
//            [
//                'label' => esc_html__('Image Size', 'transx-plugin'),
//                'type' => Controls_Manager::SELECT,
//                'default' => 'default',
//                'options' => [
//                    'default' => esc_html__('Default', 'transx-plugin'),
//                    'custom' => esc_html__('Custom', 'transx-plugin')
//                ]
//            ]
//        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Image Custom Size', 'transx-plugin'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes'
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
            'divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'info_bg_color',
            [
                'label' => esc_html__('Info Container Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_info_container' => 'background: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => esc_html__('Person Name Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_person_name'
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Person Name Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_name' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'name_hover',
            [
                'label' => esc_html__('Person Name Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_wrapper:hover .transx_person_name' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'label' => esc_html__('Person Position Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_person_position'
            ]
        );

        $this->add_control(
            'position_color',
            [
                'label' => esc_html__('Person Position Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_position' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'position_hover',
            [
                'label' => esc_html__('Person Position Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_wrapper:hover .transx_person_position' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'socials_color',
            [
                'label' => esc_html__('Socials Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_socials a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'socials_hover',
            [
                'label' => esc_html__('Socials Hover', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .transx_person_socials a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

//        $view_type = $settings['view_type'];
        $person_name = $settings['person_name'];
        $person_position = $settings['person_position'];
        $person_image = $settings['person_image'];
        $socials = $settings['socials'];
        $image_meta = transx_get_attachment_meta($person_image['id']);
        $image_alt_text = $image_meta['alt'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_person_widget">
            <div class="transx_person_wrapper">
                <?php
                // ------------------- //
                // --- View Type 1 --- //
                // ------------------- //
//                if ($view_type == 'type_1') {
                    if ($settings['image_size'] == 'yes') {
                        $image_width = $settings['image_width'];
                        $image_height = $settings['image_height'];
                    } else {
                        $image_width = 540;
                        $image_height = 740;
                    }

                    $person_image_src = aq_resize(esc_url($person_image['url']), $image_width, $image_height, true, true, true);

                    ?>
                    <div class="transx_person_image_container">
                        <img class="transx_img--bg" src="<?php echo esc_url($person_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                    </div>
                    <?php

                    if ($person_name !== '' || $person_position !== '' || !empty($socials)) {
                        ?>
                        <div class="transx_person_info_container">
                            <?php
                            if ($person_name !== '' || $person_position !== '') {
                                ?>
                                <div class="transx_person_description_container">
                                    <?php
                                    if ($person_name !== '') {
                                        ?>
                                        <div class="transx_person_name"><?php echo esc_html($person_name); ?></div>
                                        <?php
                                    }

                                    if ($person_position !== '') {
                                        ?>
                                        <div class="transx_person_position"><?php echo esc_html($person_position); ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }

                            if (!empty($socials)) {
                                ?>
                                <ul class="transx_person_socials">
                                    <?php
                                    foreach ($socials as $social) {
                                        if ($social['social_link']['url'] !== '') {
                                            $social_url = $social['social_link']['url'];
                                        } else {
                                            $social_url = '#';
                                        }

                                        ?>
                                        <li class="elementor-repeater-item-<?php echo esc_attr($social['_id']); ?>">
                                            <a href="<?php echo esc_url($social_url); ?>" <?php echo (($social['social_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($social['social_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><i class="<?php echo esc_attr($social['social_icon']['value']); ?>"></i></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
//                }


                ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
