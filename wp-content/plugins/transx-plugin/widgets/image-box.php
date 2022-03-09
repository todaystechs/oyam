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

class Transx_Image_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_image_box';
    }

    public function get_title() {
        return esc_html__('Image Box', 'transx-plugin');
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
                'label' => esc_html__('Image Box', 'transx-plugin')
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
            'info',
            [
                'label' => esc_html__('Information', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => ''
            ]
        );

        $this->end_controls_section();

        // ------------------------------ //
        // ---------- Settings ---------- //
        // ------------------------------ //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Image Box Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'info_bg',
                'label' => esc_html__('Info Box Background', 'transx-plugin'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .transx_image_box_info'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $image = $settings['image'];
        $info = $settings['info'];
        $image_meta = transx_get_attachment_meta($image['id']);
        $image_alt_text = $image_meta['alt'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_image_box_widget">
            <div class="transx_image_box_wrapper">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />

                <?php
                if ($info !== '') {
                    ?>
                    <div class="transx_image_box_info"><?php echo wp_kses($info, 'post'); ?></div>
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
