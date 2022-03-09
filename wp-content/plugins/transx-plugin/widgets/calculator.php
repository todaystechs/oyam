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

class Transx_Calculator_Widget extends Widget_Base {

    public function get_name() {
        return 'transx_calculator';
    }

    public function get_title() {
        return esc_html__('Calculator', 'transx-plugin');
    }

    public function get_icon() {
        return 'eicon-product-price';
    }

    public function get_categories() {
        return ['transx_widgets'];
    }

    public function get_script_depends() {
        return ['calculator_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Person', 'transx-plugin')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Transport Type', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'transport_list',
            [
                'label' => esc_html__('Transport Types List', 'transx-plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{type}}}',
                'prevent_empty' => false,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'distance',
            [
                'label' => esc_html__('Max Distance', 'transx-plugin'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('Enter Maximum Distance', 'transx-plugin'),
                'default' => '',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'distance_unit',
            [
                'label' => esc_html__('Units of Distance', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'weight_unit',
            [
                'label' => esc_html__('Units of Weight', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'refrigerate_price',
            [
                'label' => esc_html__('Refrigerate price', 'transx-plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ----------------------------------------- //
        // ---------- Calculator Settings ---------- //
        // ----------------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Calculator Settings', 'transx-plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'currency_position',
            [
                'label' => esc_html__('Ccurrency Position', 'transx-plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'after' => esc_html__('After Price', 'transx-plugin'),
                    'before' => esc_html__('Before Price', 'transx-plugin'),
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $transport_list = $settings['transport_list'];
        $distance = $settings['distance'];
        $distance_unit = $settings['distance_unit'];
        $weight_unit = $settings['weight_unit'];
        $refrigerate_price = $settings['refrigerate_price'];
        $currency_position = $settings['currency_position'];

        $uniqid = $this->get_id();

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="transx_calculator_widget">
            <div class="transx_calculator_wrapper">
                <form id="calculator_form_<?php echo esc_attr($uniqid); ?>" class="transx_calc_form">
                    <h5 class="transx_calc_form_title"><?php echo esc_html__('Calculated Data', 'transx-plugin'); ?></h5>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="transx_truckload_type_select" data-price="0" data-currency="">
                                <span class="transx_current"><?php echo esc_html__('Truckload Type', 'transx-plugin'); ?></span>

                                <ul class="transx_truckload_list">
                                    <li class="transx_option selected focus" data-price="0" data-currency="" data-title="<?php echo esc_attr('Truckload Type'); ?>"><?php echo esc_html__('Truckload Type', 'transx-plugin'); ?></li>
                                    <?php
                                    if (!empty($transport_list)) {
                                        foreach ($transport_list as $item) {
                                            if ($item['price'] !== '') {
                                                $price = (real)$item['price'];
                                            } else {
                                                $price = 0;
                                            }
                                            ?>

                                            <li class="transx_option" data-price="<?php echo esc_attr($price); ?>" data-currency="<?php echo esc_attr($item['currency']); ?>" data-title="<?php echo esc_attr($item['type']); ?>">
                                                <?php echo esc_html($item['type']);

                                                if ($item['price'] !== '') {
                                                    echo ' (' . esc_html__('Price: ', 'transx-plugin');

                                                    if ($currency_position == 'before') {
                                                        echo esc_html($item['currency']) . ' ';
                                                    }

                                                    echo esc_html($item['price']);

                                                    if ($currency_position == 'after') {
                                                        echo ' ' . esc_html($item['currency']);
                                                    }

                                                    echo ')';
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <?php
                            $placeholder = esc_html__('Weight', 'transx-plugin');

                            if ($weight_unit !== '') {
                                $placeholder .= ' (' . esc_attr($weight_unit) . ')';
                            }
                            ?>
                            <input type="text" class="transx_cargo_weight" form="calculator_form_<?php echo esc_attr($uniqid); ?>" placeholder="<?php echo esc_attr($placeholder); ?>">
                        </div>
                    </div>

                    <?php
                    if ($refrigerate_price !== '') {
                        ?>
                        <div class="transx_refrigerate_option_container" data-refrigerate="no" data-refprice="<?php echo esc_attr($refrigerate_price); ?>">
                            <span class="transx_refrigerate_checkbox"><?php echo esc_html__('Refrigerate', 'transx-plugin'); ?></span>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-7 col-lg-6">
                            <div class="transx_calc_distance_container">
                                <h5 class="transx_distance_title"><?php echo esc_html__('Distance', 'transx-plugin'); ?> <?php echo (($distance_unit !== '') ? ' (' . esc_html($distance_unit) . ')' : ''); ?></h5>
                                <input type="text" class="js-range-slider" name="distance" value="" data-min="0" data-max="<?php echo esc_attr($distance); ?>">
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-6 text-md-right">
                            <div class="transx_calculate_cost">
                                <?php
                                if ($currency_position == 'before' && $item['currency'] !== '') {
                                    ?>
                                    <span class="transx_cost_currency"></span>
                                    <?php
                                    echo ' ';
                                }
                                ?>

                                <span class="transx_cost">0</span>

                                <?php
                                if ($currency_position == 'after' && $item['currency'] !== '') {
                                    echo ' ';
                                    ?>
                                    <span class="transx_cost_currency"></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <button class="transx_button transx_calc_button" form="calculator_form_<?php echo esc_attr($uniqid); ?>" type="button"><?php echo esc_html__('Calculate', 'transx-plugin'); ?></button>
                </form>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
