<?php

/**
 * SBX Starter Theme - Configuration functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */



/**
 * Disable automatic WordPress plugin updates.
 */
add_filter('auto_update_plugin', '__return_false');



/**
 * Disable automatic WordPress theme updates.
 */
add_filter('auto_update_theme', '__return_false');



/**
 * Ignore theme dependencies in All-in-One WP Migration
 * 
 * @hook ai1wm_exclude_themes_from_export
 * @hooked sbx_exclude_theme_dependencies
 * @return array Array of directories to ignore
 * @see https://wordpress.org/support/topic/excluding-node_modules-via-filter-not-working-anymore/
 * @package SBX_Starter_Theme
 */
add_filter('ai1wm_exclude_themes_from_export', 'sbx_exclude_theme_dependencies');
function sbx_exclude_theme_dependencies($exclude_filters)
{
    // Get the project's theme (directory) name (by default, this is wp-THEMENAME)
    $theme_name = get_template() ?: 'sbx-starter-theme';

    /**
     * Ignores the following files and directories 
     * .git
     * .vscode
     * node_modules
     * assets
     */
    $exclude_filters = array(
        $theme_name . '/.git',
        $theme_name . '/.vscode',
        $theme_name . '/node_modules',
        //$theme_name . '/vendor',
        $theme_name . '/assets',
    );
    return $exclude_filters;
}


/**
 * Uncomment to remove specific menus from dashboard 
 */

function wpdocs_remove_menus()
{

    // remove_menu_page( 'index.php' );                  //Dashboard
    // remove_menu_page( 'jetpack' );                    //Jetpack* 
    remove_menu_page('edit.php');                   //Posts
    // remove_menu_page( 'upload.php' );                 //Media
    // remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page('edit-comments.php');          //Comments
    // remove_menu_page( 'themes.php' );                 //Appearance
    // remove_menu_page( 'plugins.php' );                //Plugins
    // remove_menu_page( 'users.php' );                  //Users
    // remove_menu_page( 'tools.php' );                  //Tools
    // remove_menu_page( 'options-general.php' );        //Settings

}
add_action('admin_menu', 'wpdocs_remove_menus');


/**
 * Remove default content (WYSIWYG) editor from all pages 
 */

add_action('init', 'remove_content_editor');

function remove_content_editor()
{
    // Uncomment to remove WYSIWYG editor 
    remove_post_type_support('page', 'editor');
}


/**
 *  Add ACF Options page(s)
 */

if (function_exists('acf_add_options_page')) {

    // This is the default options page used across the website.
    // Use the same code to create other option pages if needed.
    acf_add_options_page(array(
        'page_title'     => 'Site Options',
        'menu_title'    => 'Site Options',
        'menu_slug'     => 'site-options',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));
}


/**
 * Set ACF field as post featured image 
 */
function acf_set_featured_image($value, $post_id, $field)
{

    if ($value != '') {
        // Add the value which is the image ID to the _thumbnail_id meta data for the current post
        add_post_meta($post_id, '_thumbnail_id', $value);
    }

    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=featured_image', 'acf_set_featured_image', 10, 3);


/**
 * Escape ACF URL fields
 * 
 * @hook acf/format_value/type=url
 * @hooked sbx_acf_escape_url
 * @return string ACF field value
 * @link http://hookr.io/plugins/advanced-custom-fields/4.4.9/filters/acf_format_value_type_type
 * @package SBX_Starter_Theme
 */
add_filter('acf/format_value/type=url', 'sbx_acf_escape_url', 10, 3);
function sbx_acf_escape_url($value, $post_id, $field)
{
    return esc_attr($value);
}


/**
 * Sanitize ACF text fields for allowed HTML tags 
 * 
 * @hook acf/format_value/type=text
 * @hooked sbx_acf_escape_text
 * @return string ACF field value
 * @link http://hookr.io/plugins/advanced-custom-fields/4.4.9/filters/acf_format_value_type_type
 * @package SBX_Starter_Theme
 */
add_filter('acf/format_value/type=text', 'sbx_acf_escape_text', 10, 3);
add_filter('acf/format_value/type=textarea', 'sbx_acf_escape_text', 10, 3);
function sbx_acf_escape_text($value, $post_id, $field)
{
    return wp_kses_post($value);
}



/**
 * Dequeue Styles 
 * 
 * Stops selected Wordpress and other plugin
 * styles from being loaded. (e.g. wp-block-library)
 * @hook wp_print_style
 * @hooked sbx_deregister_styles
 * @return void
 * @package SBX_Starter_Theme
 */
add_action('wp_print_styles', 'sbx_deregister_styles', 100);
function sbx_deregister_styles()
{
    wp_dequeue_style('wp-block-library'); // Removes WP Blocks styles
    wp_dequeue_style('sb_instagram_styles'); // Removes Instagram feed plugin styles
}
