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

class Transx_Download_Doc_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_download_doc';
    }

    public function get_title() {
        return esc_html__('Download Document', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-document-file';
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
                'label' => esc_html__('Download Document', 'transx-plugin')
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
                    'type_3' => esc_html__('Type 3', 'transx-plugin')
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Document Link', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'separator' => 'before'
            ]
        );

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
            'description',
            [
                'label' => esc_html__('Description', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true
            ]
        );

        $this->add_control(
            'excerpt',
            [
                'label' => esc_html__('Excerpt', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'default_icon',
            [
                'label' => esc_html__('Preview Icon', 'transx-plugin'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'condition' => [
                    'view_type!' => 'type_1'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------------- //
        // ---------- Download Docs Settings ---------- //
        // -------------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Download Documents Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_dd_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_dd_title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Description Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_dd_description'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Description Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_dd_description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_dd_excerpt'
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_dd_excerpt' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $link = $settings['link'];
        $title = $settings['title'];
        $description = $settings['description'];
        $excerpt = $settings['excerpt'];
        $default_icon = $settings['default_icon'];

        if ($link == '') {
            $link = '#';
        }

        if ($title !== '') {
            $doc_name = $title;
        } else {
            $doc_name = 'Download';
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_download_doc_widget">
            <div class="transx_download_doc_widget view_<?php echo esc_attr($view_type); ?>">
                <?php
                // --- View Type 1 --- //
                if ($view_type == 'type_1') {
                    if ($title !== '') {
                        ?>
                        <h3 class="transx_dd_title"><?php echo wp_kses($title, 'post'); ?></h3>
                        <?php
                    }
                    ?>

                    <a class="transx_dd_link" href="<?php echo esc_url($link) ?>" download="<?php echo esc_html($doc_name); ?>">
                        <svg class="icon">
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M472 313v139c0 11.028-8.972 20-20 20H60c-11.028 0-20-8.972-20-20V313H0v139c0 33.084 26.916 60 60 60h392c33.084 0 60-26.916 60-60V313h-40z"/><path d="M352 235.716l-76 76V0h-40v311.716l-76-76L131.716 264 256 388.284 380.284 264z"/></svg>
                        </svg>
                    </a>
                    <?php

                    if ($excerpt !== '') {
                        ?>
                        <p class="transx_dd_excerpt"><?php echo esc_html($excerpt); ?></p>
                        <?php
                    }

                    if ($description !== '') {
                        ?>
                        <div class="transx_dd_description"><?php echo esc_html($description); ?></div>
                        <?php
                    }
                }

                // --- View Type 2 --- //
                if ($view_type == 'type_2') {
                    ?>
                    <div class="transx_dd_image_cont">
                        <?php
                        if (is_array($default_icon['value'])) {
                            ?>
                            <img class="transx_svg_icon" src="<?php echo esc_url($default_icon['value']['url']); ?>" alt="<?php echo esc_html__('SVG Icon', 'transx-plugin') ?>" />
                            <?php
                        } else {
                            ?>
                            <i class="<?php echo esc_attr($default_icon['value']); ?>"></i>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="transx_dd_content_cont">
                        <?php
                        if ($title !== '') {
                            ?>
                            <h6 class="transx_dd_title"><?php echo wp_kses($title, 'post'); ?></h6>
                            <?php
                        }

                        if ($description !== '') {
                            ?>
                            <div class="transx_dd_description"><?php echo esc_html($description); ?></div>
                            <?php
                        }
                        ?>
                    </div>

                    <a class="transx_dd_link" href="<?php echo esc_url($link) ?>" download="<?php echo esc_html($doc_name); ?>">
                        <svg class="icon">
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M472 313v139c0 11.028-8.972 20-20 20H60c-11.028 0-20-8.972-20-20V313H0v139c0 33.084 26.916 60 60 60h392c33.084 0 60-26.916 60-60V313h-40z"/><path d="M352 235.716l-76 76V0h-40v311.716l-76-76L131.716 264 256 388.284 380.284 264z"/></svg>
                        </svg>
                    </a>
                    <?php
                }

                // --- View Type 3 --- //
                if ($view_type == 'type_3') {
                    ?>
                    <div class="transx_dd_image_cont">
                        <?php
                        if (is_array($default_icon['value'])) {
                            ?>
                            <img class="transx_svg_icon" src="<?php echo esc_url($default_icon['value']['url']); ?>" alt="<?php echo esc_html__('SVG Icon', 'transx-plugin') ?>" />
                            <?php
                        } else {
                            ?>
                            <i class="<?php echo esc_attr($default_icon['value']); ?>"></i>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="transx_dd_content_cont">
                        <?php
                        if ($title !== '') {
                            ?>
                            <h6 class="transx_dd_title">
                                <a class="transx_dd_link" href="<?php echo esc_url($link) ?>" download="<?php echo esc_html($doc_name); ?>"><?php echo wp_kses($title, 'post'); ?></a>
                            </h6>
                            <?php
                        }

                        if ($description !== '') {
                            ?>
                            <div class="transx_dd_description"><?php echo esc_html($description); ?></div>
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
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
