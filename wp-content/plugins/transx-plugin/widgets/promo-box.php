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

class Transx_Promo_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_promo_box';
    }

    public function get_title() {
        return esc_html__('Promo Box', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-image-box';
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
                'label' => esc_html__('Promo Box', 'transx-plugin')
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
            'image',
            [
                'label' => esc_html__('Image', 'transx-plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'count',
            [
                'label' => esc_html__('Count', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'info',
            [
                'label' => esc_html__('Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Information', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Custom Information', 'transx-plugin')
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button', 'transx-plugin'),
                'condition' => [
                    'view_type' => 'type_2'
                ]
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

        $this->end_controls_section();

        // ------------------------------ //
        // ---------- Settings ---------- //
        // ------------------------------ //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Promo Box Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'image_width',
            [
                'label' => esc_html__('Image Width', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => '%'
                ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 1000
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_promo_box_image img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => '%'
                ],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 1000
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_promo_box_image img' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $image = $settings['image'];
        $count = $settings['count'];
        $info = $settings['info'];
        $description = $settings['description'];
        $button_link = $settings['button_link'];

        if ($view_type == 'type_2') {
            $button_text = $settings['button_text'];
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_promo_box_widget">
            <div class="transx_promo_box_item transx_view_<?php echo esc_attr($view_type); ?>">
                <div class="transx_promo_box_image">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_html__('Icon', 'transx-plugin'); ?>" />
                </div>

                <div class="transx_promo_box_content">
                    <h6 class="transx_promo_box_title">
                        <span class="transx_promo_box_count"><?php echo esc_html($count); ?></span>
                        <?php echo esc_html($info); ?>
                    </h6>

                    <?php
                    if ($description !== '') {
                        ?>
                        <p class="transx_promo_box_description"><?php echo esc_html($description); ?></p>
                        <?php
                    }

                    if ($button_link['url'] !== '') {
                        if ($view_type == 'type_2') {
                            ?>
                            <a class="transx_button transx_button--primary" href="<?php echo esc_url($button_link['url']); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                                <span><?php echo esc_html($button_text); ?></span>
                                <svg class="icon">
                                    <svg viewBox="0 0 150 78.6" xmlns="http://www.w3.org/2000/svg"><path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"/></svg>
                                </svg>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo esc_url($button_link['url']); ?>"  <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                                <svg class="icon">
                                    <svg viewBox="0 0 150 78.6" xmlns="http://www.w3.org/2000/svg"><path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"/></svg>
                                </svg>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
