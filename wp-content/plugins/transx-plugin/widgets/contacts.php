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

class Transx_Contacts_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_contacts';
    }

    public function get_title() {
        return esc_html__('Contacts', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_contacts',
            [
                'label' => esc_html__('Contacts', 'transx-plugin')
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contacts', 'transx-plugin'),
                'placeholder' => esc_html__('Enter Your Title', 'transx-plugin')
            ]
        );

        $this->add_control(
            'address',
            [
                'label' => esc_html__('Address', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Address', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'phone',
            [
                'label' => esc_html__('Phone Number', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => esc_html__('Enter Phone Number', 'transx-plugin'),
            ]
        );

        $this->add_control(
            'phones',
            [
                'label' => esc_html__('Phones', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__('Email', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Email', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'schedule',
            [
                'label' => esc_html__('Working Hours', 'transx-plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Working Hours', 'transx-plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $title = $settings['title'];
        $address = $settings['address'];
        $phones = $settings['phones'];
        $email = $settings['email'];
        $schedule = $settings['schedule'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_contacts_widget">
            <div class="transx_contacts_wrapper">
                <?php
                if ($title !== '') {
                    ?>
                    <h6 class="transx_contacts_title"><?php echo wp_kses($title, 'post'); ?></h6>
                    <?php
                }
                ?>

                <div class="transx_contacts_details">
                    <?php
                    if ($address !== '') {
                        ?>
                        <p class="transx_contacts_address">
                            <strong><?php echo esc_html__('Location', 'transx-plugin') ?>: </strong>
                            <span><?php echo wp_kses($address, 'post'); ?></span>
                        </p>
                        <?php
                    }

                    if (is_array($phones) && !empty($phones)) {
                        ?>
                        <p class="transx_contacts_phones">
                            <strong><?php echo esc_html__('Phone', 'transx-plugin'); ?>: </strong>
                            <?php
                            foreach ($phones as $phone) {
                                ?>
                                <a href="tel:<?php echo esc_attr(str_ireplace(' ', '', $phone['phone'])); ?>"><?php echo esc_html($phone['phone']); ?></a>
                                <?php
                            }
                            ?>
                        </p>
                        <?php
                    }

                    if ($email !== '') {
                        ?>
                        <p class="transx_contacts_email">
                            <strong><?php echo esc_html__('Email', 'transx-plugin'); ?>: </strong>
                            <a href="mailto:<?php echo esc_attr(str_ireplace(' ', '', $email)); ?>"><?php echo esc_html($email); ?></a>
                        </p>
                        <?php
                    }

                    if ($schedule !== '') {
                        ?>
                        <p class="transx_contacts_schedule">
                            <strong><?php echo esc_html__('Opening hours', 'transx-plugin'); ?>: </strong>
                            <span><?php echo wp_kses($schedule, 'post'); ?></span>
                        </p>
                        <?php
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
