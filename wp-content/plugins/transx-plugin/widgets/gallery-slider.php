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

class Transx_Gallery_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_gallery_slider';
    }

    public function get_title() {
        return esc_html__('Gallery Slider', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-slides';
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
                'label' => esc_html__('Gallery Slider', 'transx-plugin')
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => esc_html__('Add Images', 'transx-plugin'),
                'type' => Controls_Manager::GALLERY,
                'default' => []
            ]
        );

        $this->add_control(
            'title_type',
            [
                'label' => esc_html__('Image Title Type', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'title',
                'options' => [
                    'title' => esc_html__('Title', 'transx-plugin'),
                    'capture' => esc_html__('Capture', 'transx-plugin'),
                    'none' => esc_html__('None', 'transx-plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
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

        $images = $settings['images'];
        $title_type = $settings['title_type'];
        $full_mode = $settings['full_mode'];

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

        <div class="transx_gallery_slider_widget">
            <div class="transx_gallery_slider_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="transx_causes_slider_navigation_container">
                                <div class="transx_slider_arrows"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ($full_mode == 'yes') {
                    ?>
                    <div class="transx_offset_container">
                        <div class="transx_offset_container_wrapper">
                            <?php } ?>

                            <div class="transx_gallery_carousel transx_slider_slick" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                <?php
                                foreach ($images as $image) {
                                    $img_meta = transx_get_attachment_meta($image['id']);
                                    $image_title = $img_meta['title'];
                                    $image_caption = $img_meta['caption'];
                                    $image_alt = $img_meta['alt'];
                                    $image_src = aq_resize(esc_url($image['url']), 480, 585, true, true, true);

                                    if ($image_src == false) {
                                        $image_url = wp_get_attachment_url($image['id']);
                                        $image_src = aq_resize(esc_url($image_url), 480, 585, true, true, true);
                                    }
                                    ?>

                                    <div class="transx_gallery_slider_item">
                                        <div class="transx_gallery_slider_wrapper">
                                            <a href="<?php echo esc_url($image['url']) ?>" data-fancybox="gallery" data-elementor-open-lightbox="no">
                                                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($image_alt); ?>" />

                                                <?php
                                                if ($title_type !== 'none') {
                                                    if ($title_type == 'title' || $image_caption !== '') {
                                                        ?>
                                                        <div class="gallery-masonry__description">
                                                            <?php
                                                            if ($title_type == 'title') {
                                                                ?>
                                                                <span><?php echo esc_html($image_title); ?></span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span><?php echo esc_html($image_caption); ?></span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <?php if ($full_mode == 'yes') { ?>
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