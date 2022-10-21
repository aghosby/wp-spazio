<?php

/**
 *
 * All custom post types and taxonomies for this website go here
 *
 */


/**
 * Custom post type (Services) 
 */

function wp_lbf_register_my_cpts_Services()
{

    $labels = [
        "name" => __("Services", "wp-lbf"),
        "singular_name" => __("Service", "wp-lbf"),
        "menu_name" => __("Services", "wp-lbf"),
        "all_items" => __("All Services", "wp-lbf"),
        "add_new" => __("Add new", "wp-lbf"),
        "add_new_item" => __("Add new Service", "wp-lbf"),
        "edit_item" => __("Edit Service", "wp-lbf"),
        "new_item" => __("New Service", "wp-lbf"),
        "view_item" => __("View Service", "wp-lbf"),
        "view_items" => __("View Services", "wp-lbf"),
        "search_items" => __("Search Services", "wp-lbf"),
        "not_found" => __("No Services found", "wp-lbf"),
        "not_found_in_trash" => __("No Services found in trash", "wp-lbf"),
        "parent" => __("Parent Service:", "wp-lbf"),
        "featured_image" => __("Featured image for this Service", "wp-lbf"),
        "set_featured_image" => __("Set featured image for this Service", "wp-lbf"),
        "remove_featured_image" => __("Remove featured image for this Service", "wp-lbf"),
        "use_featured_image" => __("Use as featured image for this Service", "wp-lbf"),
        "archives" => __("Services", "wp-lbf"),
        "insert_into_item" => __("Insert into Service", "wp-lbf"),
        "uploaded_to_this_item" => __("Upload to this Service", "wp-lbf"),
        "filter_items_list" => __("Filter Services list", "wp-lbf"),
        "items_list_navigation" => __("Services list navigation", "wp-lbf"),
        "items_list" => __("Services list", "wp-lbf"),
        "attributes" => __("Services attributes", "wp-lbf"),
        "name_admin_bar" => __("Service", "wp-lbf"),
        "item_published" => __("Service published", "wp-lbf"),
        "item_published_privately" => __("Service published privately.", "wp-lbf"),
        "item_reverted_to_draft" => __("Service reverted to draft.", "wp-lbf"),
        "item_scheduled" => __("Service scheduled", "wp-lbf"),
        "item_updated" => __("Service updated.", "wp-lbf"),
        "parent_item_colon" => __("Parent Service:", "wp-lbf"),
    ];

    $args = [
        "label" => __("Services", "wp-lbf"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "Services", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-businessman",
        "supports" => ["title", "thumbnail"],
        "show_in_graphql" => false,
    ];

    register_post_type("Services", $args);
}

add_action('init', 'wp_lbf_register_my_cpts_Services');



// Custom options page for ACF in archive

function wp_lbf_register_acf_options_Services()
{

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title'      => 'Services Archive Page Options',
            'parent_slug'     => 'edit.php?post_type=Services',
            'capability' => 'manage_options'
        ));
    }
}

add_action('init', 'wp_lbf_register_acf_options_Services');
