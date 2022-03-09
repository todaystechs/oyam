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

class Transx_Time_Line_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_time_line';
    }

    public function get_title() {
        return esc_html__('Timeline', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-time-line';
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
            'section_timeline',
            [
                'label' => esc_html__('Timeline', 'transx-plugin')
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Timeline Heading', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your heading', 'transx-plugin' ),
                'default' => esc_html__( 'This is heading', 'transx-plugin' )
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Timeline Up Heading', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter up heading', 'transx-plugin' ),
                'default' => esc_html__( 'Up Heading', 'transx-plugin' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'year',
            [
                'label' => esc_html__('Year', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'timeline',
            [
                'label' => esc_html__('Timeline Items', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{year}}}',
                'prevent_empty' => false,
                'separator' => 'before'
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
            'slides_to_show',
            [
                'label' => esc_html__('Slides To Show', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    2 => esc_html__('Two', 'transx-plugin'),
                    3 => esc_html__('Three', 'transx-plugin'),
                    4 => esc_html__('Four', 'transx-plugin'),
                    5 => esc_html__('Five', 'transx-plugin')
                ]
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
            'navigation',
            [
                'label' => esc_html__('Navigation', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => esc_html__('Hide', 'transx-plugin'),
                'label_on' => esc_html__('Show', 'transx-plugin'),
                'separator' => 'before'
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

        $this->add_control(
            'full_mode',
            [
                'label' => esc_html__('Fullwidth Mode', 'transx-plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Timeline Settings ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Timeline Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
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
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Heading Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_heading'
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_heading' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => esc_html__('Date Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_timeline_date'
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => esc_html__('Date Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_timeline_date' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_timeline_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_timeline_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_timeline_description'
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_timeline_description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $timeline = $settings['timeline'];
        $heading = $settings['heading'];
        $up_title = $settings['up_title'];
        $full_mode = $settings['full_mode'];

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        if ($settings['navigation'] == 'yes') {
            $nav = true;
        } else {
            $nav = false;
        }

        $slider_options = [
            'slides_to_show' => absint($settings['slides_to_show']),
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'infinite' => ('yes' === $settings['infinite']),
            'speed' => absint($settings['speed']),
            'nav' => $nav,
            'rtl' => $rtl
        ];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_time_line_widget">
            <div class="transx_time_line_wrapper">
                <div class="row align-items-end transx_timeline_heading_and_buttons_part">
                    <div class="col-lg-7">
                        <div class="transx_timeline_heading_container">
                            <?php
                            if ($up_title !== '') {
                                ?>
                                <div class="transx_up_heading"><?php echo esc_html($up_title); ?></div>
                                <?php
                            }

                            if ($heading !== '') {
                                ?>
                                <h2 class="transx_heading"><?php echo wp_kses($heading, 'post'); ?></h2>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="transx_slider_navigation_container transx_slider_arrows"></div>
                    </div>
                </div>

                <?php
                if ($full_mode == 'yes') {
                    ?>
                    <div class="transx_offset_container">
                        <div class="transx_offset_container_wrapper">
                            <?php
                            }
                            ?>

                            <div class="transx_blog_carousel transx_slider_slick" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                <?php
                                foreach ($timeline as $item) {
                                    ?>
                                    <div class="transx_timeline_item">
                                        <div class="transx_timeline_date_part">
                                            <div class="transx_timeline_date"><?php echo wp_kses($item['year'], 'post'); ?></div>
                                        </div>

                                        <div class="transx_timeline_info_part">
                                            <div class="transx_timeline_info_part_wrapper">
                                                <h6 class="transx_timeline_title"><?php echo esc_html($item['title']); ?></h6>
                                                <p class="transx_timeline_description"><?php echo esc_html($item['description']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <?php
                            if ($full_mode == 'yes') {
                            ?>
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
