<?php
/*
Plugin Name: TransX Plugin
Plugin URI: https://demo.artureanec.com/
Description: Register Custom Widgets for TransX Theme.
Version: 1.3
Author: Artureanec
Author URI: https://demo.artureanec.com/
Text Domain: transx-plugin
*/

// --- Register Custom Widgets --- //
if (!function_exists('transx_widgets_load')) {
    function transx_widgets_load() {
        require_once(__DIR__ . "/widgets/socials.php");
        require_once(__DIR__ . "/widgets/address.php");
        require_once(__DIR__ . "/widgets/featured-posts.php");
        require_once(__DIR__ . "/widgets/working-hours.php");
    }
}
add_action('plugins_loaded', 'transx_widgets_load');

if (!function_exists('transx_add_custom_widget')) {
    function transx_add_custom_widget($name) {
        register_widget($name);
    }
}

/**
 * Title         : Aqua Resizer
 * Description   : Resizes WordPress images on the fly
 * Version       : 1.2.0
 * Author        : Syamil MJ
 * Author URI    : http://aquagraphite.com
 * License       : WTFPL - http://sam.zoy.org/wtfpl/
 * Documentation : https://github.com/sy4mil/Aqua-Resizer/
 *
 * @param string  $url      - (required) must be uploaded using wp media uploader
 * @param int     $width    - (required)
 * @param int     $height   - (optional)
 * @param bool    $crop     - (optional) default to soft crop
 * @param bool    $single   - (optional) returns an array if false
 * @param bool    $upscale  - (optional) resizes smaller images
 * @uses  wp_upload_dir()
 * @uses  image_resize_dimensions()
 * @uses  wp_get_image_editor()
 *
 * @return str|array
 */

if(!class_exists('Aq_Resize')) {
    class Aq_Resize
    {
        /**
         * The singleton instance
         */
        static private $instance = null;

        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        /**
         * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Run, forest.
         */
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
            // Validate inputs.
            if ( ! $url || ( ! $width && ! $height ) ) return false;

            // Caipt'n, ready to hook.
            if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

            // Define upload path & dir.
            $upload_info = wp_upload_dir();
            $upload_dir = $upload_info['basedir'];
            $upload_url = $upload_info['baseurl'];

            $http_prefix = "http://";
            $https_prefix = "https://";

            /* if the $url scheme differs from $upload_url scheme, make them match
               if the schemes differe, images don't show up. */
            if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
                $upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
            }
            elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
                $upload_url = str_replace($https_prefix,$http_prefix,$upload_url);
            }


            // Check if $img_url is local.
            if ( false === strpos( $url, $upload_url ) ) return false;

            // Define path of image.
            $rel_path = str_replace( $upload_url, '', $url );
            $img_path = $upload_dir . $rel_path;

            // Check if img path exists, and is an image indeed.
            if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

            // Get image info.
            $info = pathinfo( $img_path );
            $ext = $info['extension'];
            list( $orig_w, $orig_h ) = getimagesize( $img_path );

            // Get image size after cropping.
            $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
            $dst_w = $dims[4];
            $dst_h = $dims[5];

            // Return the original image only if it exactly fits the needed measures.
            if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                $img_url = $url;
                $dst_w = $orig_w;
                $dst_h = $orig_h;
            } else {
                // Use this to check if cropped image already exists, so we can return that instead.
                $suffix = "{$dst_w}x{$dst_h}";
                $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                    // Can't resize, so return false saying that the action to do could not be processed as planned.
                    return false;
                }
                // Else check if cache exists.
                elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                    $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                }
                // Else, we resize the image and return the new resized image url.
                else {

                    $editor = wp_get_image_editor( $img_path );

                    if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
                        return false;

                    $resized_file = $editor->save();

                    if ( ! is_wp_error( $resized_file ) ) {
                        $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                        $img_url = $upload_url . $resized_rel_path;
                    } else {
                        return false;
                    }

                }
            }

            // Okay, leave the ship.
            if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

            // Return the output.
            if ( $single ) {
                // str return.
                $image = $img_url;
            } else {
                // array return.
                $image = array (
                    0 => $img_url,
                    1 => $dst_w,
                    2 => $dst_h
                );
            }

            return $image;
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
        }
    }
}

if(!function_exists('aq_resize')) {
    /**
     * This is just a tiny wrapper function for the class above so that there is no
     * need to change any code in your own WP themes. Usage is still the same :)
     */
    function aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
        $aq_resize = Aq_Resize::getInstance();
        return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
    }
}

// Init Custom Widgets for Elementor
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

final class Transx_Custom_Widgets
{
    const  VERSION = '1.0.0';
    const  MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const  MINIMUM_PHP_VERSION = '5.4';
    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function i18n()
    {
        load_plugin_textdomain('transx-plugin', false, plugin_basename(dirname(__FILE__)) . '/languages');
    }

    public function init()
    {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'transx_admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'transx_admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'transx_admin_notice_minimum_php_version']);
            return;
        }

        // Include Additional Files
        add_action('elementor/init', [$this, 'transx_include_additional_files']);

        // Add new Elementor Categories
        add_action('elementor/init', [$this, 'transx_add_elementor_category']);

        // Register Widget Scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'transx_register_widget_scripts']);

        add_action('wp_enqueue_scripts', function () {
            wp_localize_script('ajax_query_products', 'transx_ajaxurl',
                array(
                    'url' => admin_url('admin-ajax.php')
                )
            );
        });

        // Register Widget Styles
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'transx_register_widget_styles']);

        // Register New Widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'transx_widgets_register']);

        // Register Editor Styles
        add_action('elementor/editor/before_enqueue_scripts', function () {
            wp_register_style('transx_elementor_admin', plugins_url('transx-plugin/css/transx_plugin_admin.css'));
            wp_enqueue_style('transx_elementor_admin');
        });
    }


    public function transx_admin_notice_missing_main_plugin() {
        $message = sprintf(
        /* translators: 1: TransX Plugin 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'transx-plugin'),
            '<strong>' . esc_html__('TransX Plugin', 'transx-plugin') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'transx-plugin') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function transx_admin_notice_minimum_elementor_version() {
        $message = sprintf(
        /* translators: 1: TransX Plugin 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'transx-plugin'),
            '<strong>' . esc_html__('TransX Plugin', 'transx-plugin') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'transx-plugin') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function transx_admin_notice_minimum_php_version() {
        $message = sprintf(
        /* translators: 1: Press Elements 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'transx-plugin'),
            '<strong>' . esc_html__('Press Elements', 'transx-plugin') . '</strong>',
            '<strong>' . esc_html__('PHP', 'transx-plugin') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function transx_include_additional_files() {

    }

    public function transx_add_elementor_category() {
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'transx_widgets',
            [
                'title' => esc_html__('TransX Widgets', 'transx-plugin'),
                'icon' => 'fa fa-plug',
            ],
            5 // position
        );

    }

    public function transx_register_widget_scripts() {
        // Lib
        wp_register_script('irslider', plugins_url('transx-plugin/js/lib/ion.rangeSlider.min.js'), array('jquery'));
        wp_register_script('fancybox', plugins_url('transx-plugin/js/lib/jquery.fancybox.min.js'), array('jquery'));
        wp_register_script('slick_slider', plugins_url('transx-plugin/js/lib/slick.min.js'), array('jquery'));
        wp_register_script('isotope', plugins_url('transx-plugin/js/lib/isotope.pkgd.min.js'), array('jquery', 'imagesloaded'));

        // Scripts
        wp_register_script('calculator_widget', plugins_url('transx-plugin/js/calculator-widget.js'), array('jquery', 'irslider'));
        wp_register_script('causes_grid_widget', plugins_url('transx-plugin/js/causes-grid-widget.js'), array('jquery', 'isotope', 'fancybox'));
        wp_register_script('causes_listing_widget', plugins_url('transx-plugin/js/causes-listing-widget.js'), array('jquery'));
        wp_register_script('causes_slider_widget', plugins_url('transx-plugin/js/causes-slider-widget.js'), array('jquery', 'slick_slider'));
        wp_register_script('content_slider_widget', plugins_url('transx-plugin/js/content-slider-widget.js'), array('jquery', 'slick_slider', 'fancybox'));
        wp_register_script('info_box_widget', plugins_url('transx-plugin/js/info-box-widget.js'), array('jquery'));
        wp_register_script('linked_item_widget', plugins_url('transx-plugin/js/linked-item-widget.js'), array('jquery'));
        wp_register_script('tabs_widget', plugins_url('transx-plugin/js/tabs-widget.js'), array('jquery', 'fancybox'));
        wp_register_script('testimonials_widget', plugins_url('transx-plugin/js/testimonials-widget.js'), array('jquery', 'slick_slider'));
        wp_register_script('video_widget', plugins_url('transx-plugin/js/video-widget.js'), array('jquery', 'fancybox'));
    }

    public function transx_register_widget_styles() {
        // Main Widgets Styles
        wp_register_style('transx_styles', plugins_url('transx-plugin/css/transx_plugin.css'));
        wp_enqueue_style('transx_styles');

        wp_register_style('fancybox_styles', plugins_url('transx-plugin/css/jquery.fancybox.min.css'));
        wp_enqueue_style('fancybox_styles');

        wp_register_style('irslider_styles', plugins_url('transx-plugin/css/ion.rangeSlider.min.css'));
        wp_enqueue_style('irslider_styles');
    }

    public function transx_widgets_register() {

        // --- Include Widget Files --- //
        require_once __DIR__ . '/widgets/blockquote.php';
        require_once __DIR__ . '/widgets/blog.php';
        require_once __DIR__ . '/widgets/blog-slider.php';
        require_once __DIR__ . '/widgets/button.php';
        require_once __DIR__ . '/widgets/calculator.php';
        require_once __DIR__ . '/widgets/contacts.php';
        require_once __DIR__ . '/widgets/content-slider.php';
        require_once __DIR__ . '/widgets/download-doc.php';
        require_once __DIR__ . '/widgets/gallery.php';
        require_once __DIR__ . '/widgets/gallery-slider.php';
        require_once __DIR__ . '/widgets/heading.php';
        require_once __DIR__ . '/widgets/icon-box.php';
        require_once __DIR__ . '/widgets/image-box.php';
        require_once __DIR__ . '/widgets/linked-item.php';
        require_once __DIR__ . '/widgets/linked-item-slider.php';
        require_once __DIR__ . '/widgets/links-list.php';
        require_once __DIR__ . '/widgets/location.php';
        require_once __DIR__ . '/widgets/person.php';
        require_once __DIR__ . '/widgets/price-item.php';
        require_once __DIR__ . '/widgets/promo-box.php';
        require_once __DIR__ . '/widgets/shortcodes-tabs.php';
        require_once __DIR__ . '/widgets/tabs.php';
        require_once __DIR__ . '/widgets/testimonials.php';
        require_once __DIR__ . '/widgets/time-line.php';
        require_once __DIR__ . '/widgets/video.php';

        // --- Register Widgets --- //
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Blockquote_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Blog_Listing_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Blog_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Button_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Calculator_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Contacts_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Content_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Download_Doc_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Gallery_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Gallery_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Heading_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Icon_Box_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Image_Box_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Linked_Item_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Linked_Item_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Links_List_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Location_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Person_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Price_Item_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Promo_Box_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Shortcodes_Tabs_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Tabs_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Testimonials_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Time_Line_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Transx\Widgets\Transx_Video_Widget());
    }
}

Transx_Custom_Widgets::instance();

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'alert' && $section_id == 'section_alert' ){
        $section->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'transx-plugin'),
                    'type_1' => esc_html__('View Type 1', 'transx-plugin'),
                    'type_2' => esc_html__('View Type 2', 'transx-plugin')
                ],
                'prefix_class' => 'transx_view_'
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'accordion' && $section_id == 'section_title_style' ){
        $section->add_control(
            'view_type',
            [
                'label' => esc_html__('Background Color', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-accordion-item' => 'background: {{VALUE}};'
                ]
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'counter' && $section_id == 'section_counter' ){
        $section->add_control(
            'figure_corner',
            [
                'label' => esc_html__('Figure Corner', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'transx-plugin'),
                'label_on' => esc_html__('On', 'transx-plugin'),
                'default' => 'no',
                'prefix_class' => 'transx_figure_corner_',
                'separator' => 'before'
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'counter' && $section_id == 'section_number' ){
        $section->add_control(
            'count_align',
            [
                'label' => esc_html__('Counter Alignment', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'transx-plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'transx-plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'transx-plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'center',
                'prefix_class' => 'transx_counter_align_'
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'counter' && $section_id == 'section_title' ){
        $section->add_control(
            'title_align',
            [
                'label' => esc_html__('Title Alignment', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'transx-plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'transx-plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'transx-plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-title' => 'text-align: {{VALUE}};',
                ]
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'accordion' && $section_id == 'section_title' ){
        $section->add_control(
            'title_align',
            [
                'label' => esc_html__('View Type', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('View Type 1', 'transx-plugin'),
                    'type_2' => esc_html__('View Type 2', 'transx-plugin')
                ],
                'prefix_class' => 'transx_view_',
                'separator' => 'before'
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'toggle' && $section_id == 'section_toggle' ){
        $section->add_control(
            'title_align',
            [
                'label' => esc_html__('View Type', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('View Type 1', 'transx-plugin'),
                    'type_2' => esc_html__('View Type 2', 'transx-plugin')
                ],
                'prefix_class' => 'transx_view_',
                'separator' => 'before'
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'counter' && $section_id == 'section_number' ){
        $section->add_responsive_control(
            'number_size',
            [
                'label' => esc_html__('Counter Numbers Size', 'transx-plugin'),
                'type' => Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 500
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-wrapper .elementor-counter-number' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
    }
}, 10, 3);
