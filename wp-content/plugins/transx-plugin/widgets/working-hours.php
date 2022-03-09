<?php
/*
 * Created by Artureanec
*/

if (!class_exists('transx_working_hours_widget'))
{
    class transx_working_hours_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'transx_working_hours_widget',
                'Working Hours (TransX Theme)',
                array('description' => esc_html__('Display Working Hours of Your Company', 'transx-plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['mon'] = esc_attr($new_instance['mon']);
            $instance['tue'] = esc_attr($new_instance['tue']);
            $instance['wed'] = esc_attr($new_instance['wed']);
            $instance['thu'] = esc_attr($new_instance['thu']);
            $instance['fri'] = esc_attr($new_instance['fri']);
            $instance['sat'] = esc_attr($new_instance['sat']);
            $instance['sun'] = esc_attr($new_instance['sun']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => esc_html__('Working Hours', 'transx-plugin'),
                'mon' => '9:00am-6:00pm',
                'tue' => '9:00am-6:00pm',
                'wed' => '9:00am-6:00pm',
                'thu' => '9:00am-6:00pm',
                'fri' => '9:00am-6:00pm',
                'sat' => '10:00am-0:00pm',
                'sun' => 'Closed',
            );

            $instance = wp_parse_args((array)$instance, $default_values);
            ?>
            <p class="transx_widget">
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php echo esc_html__('Title', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php echo esc_html($instance['title']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('mon')); ?>">
                    <?php echo esc_html__('Monday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('mon')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('mon')); ?>"
                       value="<?php echo esc_html($instance['mon']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('tue')); ?>">
                    <?php echo esc_html__('Tuesday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('tue')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('tue')); ?>"
                       value="<?php echo esc_html($instance['tue']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('wed')); ?>">
                    <?php echo esc_html__('Wednesday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('wed')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('wed')); ?>"
                       value="<?php echo esc_html($instance['wed']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('thu')); ?>">
                    <?php echo esc_html__('Thursday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('thu')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('thu')); ?>"
                       value="<?php echo esc_html($instance['thu']); ?>"
                />
                <label for="<?php echo esc_attr($this->get_field_id('fri')); ?>">
                    <?php echo esc_html__('Friday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('fri')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('fri')); ?>"
                       value="<?php echo esc_html($instance['fri']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('sat')); ?>">
                    <?php echo esc_html__('Saturday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('sat')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('sat')); ?>"
                       value="<?php echo esc_html($instance['sat']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('sun')); ?>">
                    <?php echo esc_html__('Sunday', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('sun')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('sun')); ?>"
                       value="<?php echo esc_html($instance['sun']); ?>"
                />
            </p>
            <?php
        }

        public function widget($args, $instance)
        {
            extract($args);

            echo $before_widget;

            if ($instance['title']) {
                echo $before_title;
                echo apply_filters('widget_title', $instance['title']);
                echo $after_title;
            }

            if ($instance['mon'] !== '' || $instance['tue'] !== '' || $instance['wed'] !== '' || $instance['thu'] !== '' || $instance['fri'] !== '' || $instance['sat'] !== '' || $instance['sun'] !== '') {
                echo '
                    <ul class="transx_footer_schedule">';

                        if ($instance['mon'] !== '') {
                            echo '<li><span>' . esc_html__('Monday', 'transx-plugin') . '</span><span>' . esc_html($instance['mon']) . '</span></li>';
                        }

                        if ($instance['tue'] !== '') {
                            echo '<li><span>' . esc_html__('Tuesday', 'transx-plugin') . '</span><span>' . esc_html($instance['tue']) . '</span></li>';
                        }

                        if ($instance['wed'] !== '') {
                            echo '<li><span>' . esc_html__('Wednesday', 'transx-plugin') . '</span><span>' . esc_html($instance['wed']) . '</span></li>';
                        }

                        if ($instance['thu'] !== '') {
                            echo '<li><span>' . esc_html__('Thursday', 'transx-plugin') . '</span><span>' . esc_html($instance['thu']) . '</span></li>';
                        }

                        if ($instance['fri'] !== '') {
                            echo '<li><span>' . esc_html__('Friday', 'transx-plugin') . '</span><span>' . esc_html($instance['fri']) . '</span></li>';
                        }

                        if ($instance['sat'] !== '') {
                            echo '<li><span>' . esc_html__('Saturday', 'transx-plugin') . '</span><span>' . esc_html($instance['sat']) . '</span></li>';
                        }

                        if ($instance['sun'] !== '') {
                            echo '<li><span>' . esc_html__('Sunday', 'transx-plugin') . '</span><span>' . esc_html($instance['sun']) . '</span></li>';
                        }

                        echo '
                    </ul>
                ';
            }

            echo $after_widget;
        }
    }
}
