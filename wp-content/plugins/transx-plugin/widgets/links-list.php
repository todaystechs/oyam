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

class Transx_Links_List_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_links_list';
    }

    public function get_title() {
        return esc_html__('Links List', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-table-of-contents';
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
                'label' => esc_html__('Links List', 'transx-plugin')
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
                    'type_2' => esc_html__('View Type 2', 'transx-plugin')
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('List Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Link Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Background Image (Only for View Type 2)', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'links_list',
            [
                'label' => esc_html__('Links List', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $title = $settings['title'];
        $links_list = $settings['links_list'];

        $i = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_links_list_widget">
            <div class="transx_links_list_wrapper transx_view_<?php echo esc_attr($view_type); ?>">
                <h5 class="transx_links_list_title"><?php echo wp_kses($title, 'post'); ?></h5>

                <?php
                if (!empty($links_list)) {
                    if ($view_type == 'type_1') {
                        ?>
                        <ul class="transx_links_list">
                            <?php
                            foreach ($links_list as $item) {
                                if ($item['link']['url'] !== '') {
                                    $link_url = $item['link']['url'];
                                } else {
                                    $link_url = '#';
                                }

                                ?>
                                <li class="transx_links_list_item">
                                    <a href="<?php echo esc_url($link_url); ?>" <?php echo (($item['link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($item['link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($item['text']); ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } else {
                        foreach ($links_list as $item) {
                            if ($item['link']['url'] !== '') {
                                $link_url = $item['link']['url'];
                            } else {
                                $link_url = '#';
                            }
                            ?>
                            <a class="transx_links_list_item" href="<?php echo esc_url($link_url); ?>" <?php echo (($item['link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($item['link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                                <img class="transx_img--bg" src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_html__('Background Image', 'transx-plugin'); ?>" />
                                <h6><?php echo esc_html($item['text']); ?></h6>
                                <span class="transx_links_list_counter"><?php echo (($i < 10) ? '0' : ''); echo esc_html($i); ?></span>
                            </a>
                            <?php

                            $i++;
                        }
                    }
                    ?>
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
