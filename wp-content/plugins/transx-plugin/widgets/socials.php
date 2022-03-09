<?php
/*
 * Created by Artureanec
*/

if (!class_exists('transx_socials_widget'))
{
    class transx_socials_widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'transx_socials_widget',
                'Socials Widget (TransX Theme)',
                array('description' => esc_html__('Display Your Logo and Social Icons from Customizer', 'transx-plugin'))
            );
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = esc_attr($new_instance['title']);
            $instance['align'] = esc_attr($new_instance['align']);
            $instance['logo'] = esc_attr($new_instance['logo']);
            $instance['logo_type'] = esc_attr($new_instance['logo_type']);
            $instance['logo_width'] = esc_attr($new_instance['logo_width']);
            $instance['logo_height'] = esc_attr($new_instance['logo_height']);
            $instance['address'] = esc_attr($new_instance['address']);
            $instance['phone_1'] = esc_attr($new_instance['phone_1']);
            $instance['phone_2'] = esc_attr($new_instance['phone_2']);
            $instance['email'] = esc_attr($new_instance['email']);
            $instance['time'] = esc_attr($new_instance['time']);
            $instance['info'] = esc_attr($new_instance['info']);
            $instance['socials'] = esc_attr($new_instance['socials']);

            return $instance;
        }

        public function form($instance)
        {
            $default_values = array(
                'title' => esc_html__('Socials', 'transx-plugin'),
                'align' => 'left',
                'logo' => 'enabled',
                'logo_type' => 'transparent',
                'logo_width' => 122,
                'logo_height' => 31,
                'address' => 'av. Washington 165, NY CA 54003',
                'phone_1' => '+31 85 964 47 25',
                'phone_2' => '+31 65 792 63 11',
                'email' => 'info@transx.com',
                'time' => '9:00 AM - 5:00 PM',
                'info' => '',
                'socials' => 'enabled'
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

                <label for="<?php echo esc_attr($this->get_field_id('align')); ?>">
                    <?php echo esc_html__('Content Alignment', 'transx-plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('align')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('align')); ?>">
                    <option value="left" <?php selected($instance['align'], 'left'); ?>><?php echo esc_html__('Left', 'transx-plugin'); ?></option>
                    <option value="center" <?php selected($instance['align'], 'center'); ?>><?php echo esc_html__('Center', 'transx-plugin'); ?></option>
                    <option value="right" <?php selected($instance['align'], 'right'); ?>><?php echo esc_html__('Right', 'transx-plugin'); ?></option>
                </select>

                <label for="<?php echo esc_attr($this->get_field_id('logo')); ?>">
                    <?php echo esc_html__('Logo Image', 'transx-plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('logo')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('logo')); ?>">
                    <option value="enabled" <?php selected($instance['logo'], 'enabled'); ?>><?php echo esc_html__('Enabled', 'transx-plugin'); ?></option>
                    <option value="disabled" <?php selected($instance['logo'], 'disabled'); ?>><?php echo esc_html__('Disabled', 'transx-plugin'); ?></option>
                </select>

                <label for="<?php echo esc_attr($this->get_field_id('logo_type')); ?>">
                    <?php echo esc_html__('Type of Logo Image', 'transx-plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('logo_type')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('logo_type')); ?>">
                    <option value="default" <?php selected($instance['logo_type'], 'default'); ?>><?php echo esc_html__('Default Logo Image', 'transx-plugin'); ?></option>
                    <option value="transparent" <?php selected($instance['logo_type'], 'transparent'); ?>><?php echo esc_html__('Transparent Header Logo Image', 'transx-plugin'); ?></option>
                </select>

                <label for="<?php echo esc_attr($this->get_field_id('logo_width')); ?>">
                    <?php echo esc_html__('Enter Logo Image Width', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('logo_width')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('logo_width')); ?>"
                       value="<?php echo esc_html($instance['logo_width']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('logo_height')); ?>">
                    <?php echo esc_html__('Enter Logo Image Height', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('logo_height')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('logo_height')); ?>"
                       value="<?php echo esc_html($instance['logo_height']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('address')); ?>">
                    <?php echo esc_html__('Address', 'transx-plugin'); ?>:
                </label>
                <textarea class="widefat"
                          id="<?php echo esc_attr($this->get_field_id('address')); ?>"
                          name="<?php echo esc_attr($this->get_field_name('address')); ?>"
                ><?php echo esc_attr($instance['address']); ?></textarea>

                <label for="<?php echo esc_attr($this->get_field_id('phone_1')); ?>">
                    <?php echo esc_html__('Phone Number 1', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('phone_1')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('phone_1')); ?>"
                       value="<?php echo esc_html($instance['phone_1']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('phone_2')); ?>">
                    <?php echo esc_html__('Phone Number 2', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('phone_2')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('phone_2')); ?>"
                       value="<?php echo esc_html($instance['phone_2']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('email')); ?>">
                    <?php echo esc_html__('Email', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('email')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('email')); ?>"
                       value="<?php echo esc_html($instance['email']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('time')); ?>">
                    <?php echo esc_html__('Opening hours', 'transx-plugin'); ?>:
                </label>
                <input class="widefat"
                       type="text"
                       id="<?php echo esc_attr($this->get_field_id('time')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('time')); ?>"
                       value="<?php echo esc_html($instance['time']); ?>"
                />

                <label for="<?php echo esc_attr($this->get_field_id('info')); ?>">
                    <?php echo esc_html__('Additional Information', 'transx-plugin'); ?>:
                </label>
                <textarea class="widefat"
                          id="<?php echo esc_attr($this->get_field_id('info')); ?>"
                          name="<?php echo esc_attr($this->get_field_name('info')); ?>"
                ><?php echo esc_attr($instance['info']); ?></textarea>

                <label for="<?php echo esc_attr($this->get_field_id('socials')); ?>">
                    <?php echo esc_html__('Social Icons', 'transx-plugin'); ?>:
                </label>
                <select name="<?php echo esc_attr($this->get_field_name('socials')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('socials')); ?>">
                    <option value="enabled" <?php selected($instance['socials'], 'enabled'); ?>><?php echo esc_html__('Enabled', 'transx-plugin'); ?></option>
                    <option value="disabled" <?php selected($instance['socials'], 'disabled'); ?>><?php echo esc_html__('Disabled', 'transx-plugin'); ?></option>
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

            echo '<div class="transx_socials_widget_wrapper content_align_' . $instance['align'] . '">';

                if ($instance['logo'] == 'enabled') {

                    if (transx_get_post_option('custom_logo_type') == 'custom') {
                        if (transx_get_post_option('alt_logo') !== false) {
                            if ($instance['logo_type'] == 'default') {
                                foreach (transx_get_post_option('alt_logo') as $key => $image) {
                                    $transx_logo_url = $image['full_url'];
                                }
                            } else {
                                foreach (transx_get_post_option('alt_transparent_logo') as $key => $image) {
                                    $transx_logo_url = $image['full_url'];
                                }
                            }
                        } else {
                            if ($instance['logo_type'] == 'default') {
                                $transx_logo_url = transx_get_theme_mod('logo_image');
                            } else {
                                $transx_logo_url = transx_get_theme_mod('logo_transparent_image');
                            }
                        }
                    } else {
                        if ($instance['logo_type'] == 'default') {
                            $transx_logo_url = transx_get_theme_mod('logo_image');
                        } else {
                            $transx_logo_url = transx_get_theme_mod('logo_transparent_image');
                        }
                    }

                    echo '
                        <div class="transx_socials_widget_logo">
                            <a href="' . esc_url(home_url('/')) . '">
                                <img src="' . esc_url($transx_logo_url) . '" alt="Footer Logo" width="' . absint($instance['logo_width']) . '" height="' . absint($instance['logo_height']) . '" />
                            </a>
                        </div>
                    ';
                }

                if ($instance['address'] !== '' || $instance['phone_1'] !== '' || $instance['phone_2'] !== '' || $instance['email'] !== '' || $instance['info'] !== '') {
                    echo '<div class="transx_additional_info">';

                        if ($instance['address'] !== '') {
                            echo '
                                <p class="transx_contacts_widget_address">
                                    <svg class="icon">
                                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 469.729c-55.847-66.338-152.035-197.217-152.035-284.301 0-83.834 68.202-152.036 152.035-152.036s152.035 68.202 152.035 152.035C408.034 272.515 311.861 403.37 256 469.729z"/><path d="M256 92.134c-51.442 0-93.292 41.851-93.292 93.293S204.559 278.72 256 278.72s93.291-41.851 93.291-93.293S307.441 92.134 256 92.134zm0 153.194c-33.03 0-59.9-26.871-59.9-59.901s26.871-59.901 59.9-59.901 59.9 26.871 59.9 59.901-26.871 59.901-59.9 59.901z"/></svg>
                                    </svg>
                                    ' . esc_html($instance['address']) . '
                                </p>
                            ';
                        }

                        if ($instance['phone_1'] !== '' || $instance['phone_2'] !== '') {
                            echo '
                                <p class="transx_contacts_widget_phone">
                                    <svg class="icon">
                                        <svg viewBox="0 0 384 384" xmlns="http://www.w3.org/2000/svg"><path d="M353.188 252.052c-23.51 0-46.594-3.677-68.469-10.906-10.906-3.719-23.323-.833-30.438 6.417l-43.177 32.594c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208 11.167-20.198 7.635-31.448-7.26-21.99-10.948-45.063-10.948-68.583C132.146 13.823 118.323 0 101.333 0H30.812C13.823 0 0 13.823 0 30.812 0 225.563 158.438 384 353.188 384c16.99 0 30.813-13.823 30.813-30.813v-70.323c-.001-16.989-13.824-30.812-30.813-30.812zm9.479 101.136c0 5.229-4.25 9.479-9.479 9.479-182.99 0-331.854-148.865-331.854-331.854 0-5.229 4.25-9.479 9.479-9.479h70.521c5.229 0 9.479 4.25 9.479 9.479 0 25.802 4.052 51.125 11.979 75.115 1.104 3.542.208 7.208-3.375 10.938L82.75 165.427a10.674 10.674 0 00-1 11.26c29.927 58.823 66.292 95.188 125.531 125.542 3.604 1.885 8.021 1.49 11.292-.979l49.677-37.635a9.414 9.414 0 019.667-2.25c24.156 7.979 49.479 12.021 75.271 12.021 5.229 0 9.479 4.25 9.479 9.479v70.323z"/></svg>
                                    </svg>';

                                    if ($instance['phone_1'] !== '') {
                                        echo '
                                            <a href="tel:' . esc_attr(str_replace(' ', '', $instance['phone_1'])) . '">
                                                ' . esc_html($instance['phone_1']) . '
                                            </a>
                                        ';
                                    }

                                    if ($instance['phone_2'] !== '') {
                                        echo '
                                            <a href="tel:' . esc_attr(str_replace(' ', '', $instance['phone_2'])) . '">
                                                ' . esc_html($instance['phone_2']) . '
                                            </a>
                                        ';
                                    }
                                echo '
                                </p>
                            ';
                        }

                        if ($instance['email'] !== '') {
                            echo '
                                <p class="transx_contacts_widget_email">
                                    <svg class="icon">
                                        <svg viewBox="0 0 479.058 479.058" xmlns="http://www.w3.org/2000/svg"><path d="M434.146 59.882H44.912C20.146 59.882 0 80.028 0 104.794v269.47c0 24.766 20.146 44.912 44.912 44.912h389.234c24.766 0 44.912-20.146 44.912-44.912v-269.47c0-24.766-20.146-44.912-44.912-44.912zm0 29.941c2.034 0 3.969.422 5.738 1.159L239.529 264.631 39.173 90.982a14.902 14.902 0 015.738-1.159zm0 299.411H44.912c-8.26 0-14.971-6.71-14.971-14.971V122.615l199.778 173.141c2.822 2.441 6.316 3.655 9.81 3.655s6.988-1.213 9.81-3.655l199.778-173.141v251.649c-.001 8.26-6.711 14.97-14.971 14.97z"/></svg>
                                    </svg>
                                    <a href="mailto:' . esc_attr($instance['email']) . '">
                                        ' . esc_html($instance['email']) . '
                                    </a>
                                </p>
                            ';
                        }

                        if ($instance['time'] !== '') {
                            echo '
                                <p class="transx_contacts_widget_time">
                                    <svg class="icon">
                                        <svg stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="aofeather aofeather-clock" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                    </svg>
                                    ' . esc_html($instance['time']) . '
                                </p>
                            ';
                        }

                        if ($instance['info'] !== '') {
                            echo '
                                <p class="transx_contacts_info">' . esc_html($instance['info']) . '</p>
                            ';
                        }

                    echo '</div>';
                }

                if ($instance['socials'] == 'enabled') {
                    echo transx_socials_output('transx_footer-socials');
                }

            echo '</div>';

            echo $after_widget;
        }
    }
}
