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

class Transx_Blockquote_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_blockquote';
    }

    public function get_title() {
        return esc_html__('Blockquote', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-blockquote';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_blockquote',
            [
                'label' => esc_html__('Blockquote', 'transx-plugin')
            ]
        );

        $this->add_control(
            'blockquote',
            [
                'label' => esc_html__('Blockquote', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your text', 'transx-plugin' )
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('Blockquote View Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('View Type 1', 'transx-plugin'),
                    'type_2' => esc_html__('View Type 2', 'transx-plugin')
                ]
            ]
        );

        $this->end_controls_section();

        // ----------------------------------------- //
        // ---------- Blockquote Settings ---------- //
        // ----------------------------------------- //
        $this->start_controls_section(
            'section_blockquote_settings',
            [
                'label' => esc_html__('Blockquote Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blockquote_typography',
                'label' => esc_html__('Blockquote Typography', 'transx-plugin'),
                'selector' => '{{WRAPPER}} .transx_blockquote'
            ]
        );

        $this->add_control(
            'blockquote_color',
            [
                'label' => esc_html__('Blockquote Color', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blockquote' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'blockquote_bg',
            [
                'label' => esc_html__('Blockquote Background', 'transx-plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .transx_blockquote.transx_view_type_2' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'blockquote_padding',
            [
                'label' => esc_html__('Blockquote Padding', 'transx-plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .transx_blockquote.transx_view_type_2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $blockquote = $settings['blockquote'];
        $view_type = $settings['view_type'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_blockquote_widget">
            <div class="transx_blockquote transx_view_<?php echo esc_attr($view_type); ?>">
                <?php echo transx_output_code($blockquote); ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
