<?php
# One Click Demo Content Import
function transx_ocdi_import_files() {
    return array(
        array(
            'import_file_name'              => 'TransX',
            'categories'                    => array('With Images'),
            'import_file_url'               => trailingslashit(get_template_directory_uri()) . 'core/import/import.xml',
            'import_widget_file_url'        => trailingslashit(get_template_directory_uri()) . 'core/import/widgets.xml',
            'import_customizer_file_url'    => trailingslashit(get_template_directory_uri()) . 'core/import/customizer.xml',
            'import_preview_image_url'      => trailingslashit(get_template_directory_uri()) . 'screenshot.jpg',
            'preview_url'                   => 'https://demo.artureanec.com/themes/transx-new/',
        ),
    );
    #'import_notice'                => esc_attr__( 'After you import this demo, you will have to setup the slider separately. Slider Revolution > Import Slider. All the import files for the slider you will find in "Slider Revolution Import" folder.', 'transx' ),
}
add_filter( 'pt-ocdi/import_files', 'transx_ocdi_import_files' );

# Remove Branding Message
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

# Disable Regenerate for Thumbs
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

function transx_after_activation() {
    function transx_after_switch_theme_message() {
        echo '<div class="updated notice is-dismissible"><p>'.esc_attr__('After activating all the recommended plugins, you can import all demo content in one-touch. Appearance > Import Demo Data.', 'transx').'</p></div>';
    }

    add_action('admin_notices', 'transx_after_switch_theme_message');
}
add_action("after_switch_theme", "transx_after_activation", 10 ,  2);


function transx_ocdi_after_import_setup() {
    # Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
    $footer_menu_2 = get_term_by( 'name', 'Footer Menu 2', 'nav_menu' );
    $tagline_menu = get_term_by( 'name', 'Tagline menu', 'nav_menu' );
    $sidebar_menu = get_term_by( 'name', 'Side Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main' => $main_menu->term_id,
            'footer_menu' => $footer_menu->term_id,
            'footer_menu_2' => $footer_menu_2->term_id,
            'tagline_menu' => $tagline_menu->term_id,
            'sidebar_menu' => $sidebar_menu->term_id,
        )
    );

    # Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home Cargo' );
    # $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    # update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'transx_ocdi_after_import_setup' );