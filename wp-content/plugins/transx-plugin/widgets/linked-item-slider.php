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

class Transx_Linked_Item_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_linked_item_slider';
    }

    public function get_title() {
        return esc_html__('Linked Item Slider', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['causes_slider_widget'];
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

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Item Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Item Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Research Now', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Item Link', 'transx-plugin'),
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
            'items_list',
            [
                'label' => esc_html__('Linked Items List', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'title_field' => '',
                'prevent_empty' => false
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Slider Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_slider',
            [
                'label' => esc_html__('Slider Settings', 'transx-plugin')
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Animation Speed', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'transx-plugin'),
                    'no' => esc_html__('No', 'transx-plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'transx-plugin'),
                    'no' => esc_html__('No', 'transx-plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'transx-plugin'),
                    'no' => esc_html__('No', 'transx-plugin'),
                ],
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'rtl_support',
            [
                'label' => esc_html__('Rtl Support', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $items_list = $settings['items_list'];

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        $slider_options = [
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'infinite' => ('yes' === $settings['infinite']),
            'speed' => absint($settings['speed']),
            'rtl' => $rtl
        ];

        if ($settings['autoplay'] == 'yes') {
            $slider_options['autoplaySpeed'] = absint( $settings['autoplay_speed'] );
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_linked_item_slider_widget">
            <div class="transx_linked_items_carousel transx_slider_slick" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                <?php
                foreach ($items_list as $item) {

                    if ($item['button_link']['url'] !== '') {
                        $button_url = $item['button_link']['url'];
                    } else {
                        $button_url = '#';
                    }
                    ?>
                    <div class="transx_linked_slider_item">
                        <div class="transx_linked_slider_item_wrapper">
                            <img class="transx_img--bg" src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_html__('Featured Item', 'transx-plugin'); ?>" />

                            <div class="transx_linked_slider_item_content">
                                <?php
                                if ($item['title'] !== '') {
                                    ?>
                                    <h4 class="transx_linked_slider_item_title"><?php echo wp_kses($item['title'], 'post'); ?></h4>
                                    <?php
                                }
                                ?>

                                <a class="transx_item_link" href="<?php echo esc_url($button_url); ?>" <?php echo (($item['button_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($item['button_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                                    <span><?php echo esc_html($item['button_text']); ?></span>

                                    <svg class="icon">
                                        <svg viewBox="0 0 150 78.6" xmlns="http://www.w3.org/2000/svg"><path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"/></svg>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="transx_causes_slider_navigation_container">
                <div class="transx_slider_arrows"></div>
            </div>
        </div>

        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
