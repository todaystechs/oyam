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

class Transx_Testimonials_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_testimonials';
    }

    public function get_title() {
        return esc_html__('Testimonials', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['testimonials_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Testimonials', 'transx-plugin')
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
            'up_title',
            [
                'label' => esc_html__('Testimonials Up Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter Testimonials Up Title', 'transx-plugin'),
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'up_title_marker_text',
            [
                'label' => esc_html__('Enter Up Heading Overlay', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter up heading', 'transx-plugin' ),
                'default' => ''
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Testimonials Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter testimonials title', 'transx-plugin'),
                'default' => esc_html__('Testimonials Title', 'transx-plugin')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial',
            [
                'label' => esc_html__('Testimonial', 'transx-plugin'),
                'type' => Controls_Manager::WYSIWYG,
                'rows' => '10',
                'default' => '',
                'placeholder' => esc_html__('Enter Testimonial Text', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Author Name', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'position',
            [
                'label' => esc_html__('Author Position', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'testimonials_items',
            [
                'label' => esc_html__('Testimonials', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{name}}}',
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ---------------------------- //
        // ---------- Slider ---------- //
        // ---------------------------- //
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
                'default' => 500,
                'separator' => 'before'
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

        // ----------------------------------- //
        // ---------- Text Settings ---------- //
        // ----------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Testimonials Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'items_bg_color',
            [
                'label' => esc_html__('Testimonials Background Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_testimonials_item_wrapper' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_3'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_typography',
                'label' => esc_html__('Up Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_up_heading'
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .transx_up_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_1_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_heading'
            ]
        );

        $this->add_control(
            'title_1_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_heading' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_1 .transx_testimonials_widget_title_container, {{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_2 .transx_heading, {{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_3 .transx_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_marker_typography',
                'label' => esc_html__('Up Heading Overlay Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_up_heading_overlay'
            ]
        );

        $this->add_control(
            'up_title_marker_color',
            [
                'label' => esc_html__('Up Heading Overlay Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_up_heading_overlay' => '-webkit-text-stroke-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'markers_color',
            [
                'label' => esc_html__('Markers Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_1 .transx_author_container .transx_author_container_wrapper:before, {{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_2 .transx_offset_container:before, {{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_3 .transx_author_container_wrapper:before' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Space After Testimonial', 'transx-plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_1 .transx_testimonial, {{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_2 .transx_testimonial, {{WRAPPER}} .transx_testimonials_wrapper.transx_view_type_3 .transx_testimonial' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Testimonial Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_testimonial'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Testimonial Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_testimonial' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => esc_html__('Author Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_author_container'
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => esc_html__('Author Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_author_container' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'label' => esc_html__('Position Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_author_position'
            ]
        );

        $this->add_control(
            'position_color',
            [
                'label' => esc_html__('Position Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_author_position' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $up_title = $settings['up_title'];
        $up_title_marker_text = $settings['up_title_marker_text'];
        $heading = $settings['heading'];
        $testimonials_items = $settings['testimonials_items'];

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        $slidesToShow = 1;

        $slider_options = [
            'slidesToShow' => $slidesToShow,
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

        <div class="transx_testimonials_widget">
            <div class="transx_testimonials_wrapper transx_view_<?php echo esc_attr($view_type); ?>">
                <?php
                $slider_code = '';

                foreach ($testimonials_items as $item) {
                    $slider_code .= '
                        <div class="transx_testimonials_item">
                            <div class="transx_testimonials_item_wrapper">
                                <div class="transx_testimonials_content">
                                    <div class="transx_testimonial">' . transx_output_code($item['testimonial']) . '</div>

                                    <div class="transx_author_container">
                                        <div class="transx_author_container_wrapper">
                                            <div class="transx_author_name">' . esc_html($item['name']) . '</div>
                                            <div class="transx_author_position">' . esc_html($item['position']) . '</div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    ';
                }

                // ------------------- //
                // --- View Type 1 --- //
                // ------------------- //
                if ($view_type == 'type_1') {
                    ?>
                    <div class="transx_testimonials_widget_title_container">
                        <div class="row">
                            <div class="col-12">
                                <div class="transx_up_heading"><?php echo esc_html($up_title); ?></div>
                                <div class="transx_up_heading_overlay"><?php echo esc_html($up_title_marker_text); ?></div>
                                <h2 class="transx_heading"><?php echo transx_output_code($heading); ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="transx_testimonials_slider_container">
                        <div class="row">
                            <div class="col-12">
                                <div class="transx_testimonials_slider transx_slider_slick slider_<?php echo esc_attr($view_type); ?>" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                    <?php echo transx_output_code($slider_code); ?>
                                </div>
                            </div>
                        </div>

                        <div class="transx_slider_navigation_container transx_slider_arrows"></div>
                    </div>
                    <?php
                }

                // ------------------------------ //
                // --- View Type 2 and Type 3 --- //
                // ------------------------------ //
                if ($view_type == 'type_2' || $view_type == 'type_3') {
                    ?>
                    <div class="row">
                        <div class="<?php echo (($view_type == 'type_2') ? 'col-lg-5' : 'col-lg-6'); ?>">
                            <div class="row align-items-end">
                                <div class="col-xl-12">
                                    <div class="transx_up_heading"><?php echo esc_html($up_title); ?></div>
                                    <div class="transx_up_heading_overlay"><?php echo esc_html($up_title_marker_text); ?></div>
                                    <h2 class="transx_heading"><?php echo transx_output_code($heading); ?></h2>
                                </div>

                                <div class="col-xl-12">
                                    <div class="transx_slider_navigation_container transx_slider_arrows"></div>
                                </div>
                            </div>
                        </div>

                        <div class="<?php echo (($view_type == 'type_2') ? 'col-lg-7' : 'col-lg-6'); ?>">
                            <div class="transx_offset_container">
                                <div class="transx_testimonials_slider transx_slider_slick slider_<?php echo esc_attr($view_type); ?>" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                    <?php echo transx_output_code($slider_code); ?>
                                </div>
                            </div>
                        </div>
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