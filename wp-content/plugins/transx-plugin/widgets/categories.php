<?php
/*
 * Created by Artureanec
*/

if (!class_exists('transx_categories_widget'))
{
    class transx_categories_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'transx_categories_widget',
                'Categories (TransX Theme)',
                array('description' => esc_html__('Show Categories of Your Custom Post Types', 'transx-plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['taxonomy'] = esc_attr($new_instance['taxonomy']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => '',
                'taxonomy' => 'events-category'
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

                <label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>">
                    <?php echo esc_html__('Select Post Type', 'transx-plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>">
                    <option value="events-category" <?php selected($instance['taxonomy'], 'events-category'); ?>>Events</option>
                    <option value="donations-category" <?php selected($instance['taxonomy'], 'donations-category'); ?>>Donations</option>
                    <option value="animals-category" <?php selected($instance['taxonomy'], 'animals-category'); ?>>Animals</option>
                    <option value="tours-category" <?php selected($instance['taxonomy'], 'tours-category'); ?>>Tours</option>
                </select>
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


            $terms = get_terms($instance['taxonomy']);

            echo '
                <ul>';

                    foreach ($terms as $term) {
                        echo '
                            <li>
                                <a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>
                                (' . $term->count . ')
                            </li>
                        ';
                    }

                    echo '
                </ul>
            ';

            echo $after_widget;
        }
    }
}
