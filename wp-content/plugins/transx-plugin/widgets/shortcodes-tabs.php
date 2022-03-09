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

class Transx_Shortcodes_Tabs_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_shortcodes_tabs';
    }

    public function get_title() {
        return esc_html__('Shortcodes Tabs', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['tabs_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Tabs', 'transx-plugin')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Tab Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tab', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Tab Title', 'transx-plugin')
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Tab Shortcode', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => ''
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__('Tabs', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
                'prevent_empty' => false
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $tabs = $settings['tabs'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_shortcodes_tabs_widget">
            <div class="transx_tabs_titles_container">
                <?php
                $i = 1;

                foreach ($tabs as $tab) {
                    ?>
                    <div class="transx_tab_title_item" data-id="transx_tab_id_<?php echo esc_attr($this->get_id()); ?>_<?php echo esc_attr($i); ?>">
                        <a href="<?php echo esc_js('javascript:void(0)'); ?>"><?php echo esc_html($tab['title']); ?></a>
                    </div>
                    <?php

                    $i++;
                }
                ?>
            </div>

            <div class="transx_tabs_content_container">
                <?php
                $i = 1;

                foreach ($tabs as $tab) {
                    ?>
                    <div class="transx_tab_content_item" id="transx_tab_id_<?php echo esc_attr($this->get_id()); ?>_<?php echo esc_attr($i); ?>">
                        <div class="transx_tab_text_container">
<!--                            --><?php //echo do_shortcode($tab['text']); ?>
                            <?php echo $tab['text']; ?>
                        </div>
                    </div>
                    <?php

                    $i++;
                }
                ?>
            </div>
        </div>

        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
