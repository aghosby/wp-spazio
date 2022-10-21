<?php

/**
 *
 * All custom post types and taxonomies for this website go here
 * 
 * *********************** HOW TO USE *******************************
 * Use VS Code Find and Replace feature to replace 'mycpt' with the 
 * singular name of your custom post type e.g. 'service'.
 * Please ensure that you select the 'Preserve Case' setting (Alt + P)
 * when doing the find and replace. You may need to manually replace 
 * post type names that don't follow standard English plural/singular 
 * rules e.g. 'news'. 
 *
 */


/**
 * Custom post type (My Custom Post Type Name) 
 */

function wp_tsw_register_my_cpts_mycpts()
{

    $labels = [
        "name" => __("Mycpts", "wp-tsw"),
        "singular_name" => __("Mycpt", "wp-tsw"),
        "menu_name" => __("Mycpts", "wp-tsw"),
        "all_items" => __("All Mycpts", "wp-tsw"),
        "add_new" => __("Add new", "wp-tsw"),
        "add_new_item" => __("Add new Mycpt", "wp-tsw"),
        "edit_item" => __("Edit Mycpt", "wp-tsw"),
        "new_item" => __("New Mycpt", "wp-tsw"),
        "view_item" => __("View Mycpt", "wp-tsw"),
        "view_items" => __("View Mycpts", "wp-tsw"),
        "search_items" => __("Search Mycpts", "wp-tsw"),
        "not_found" => __("No Mycpts found", "wp-tsw"),
        "not_found_in_trash" => __("No Mycpts found in trash", "wp-tsw"),
        "parent" => __("Parent Mycpt:", "wp-tsw"),
        "featured_image" => __("Featured image for this Mycpt", "wp-tsw"),
        "set_featured_image" => __("Set featured image for this Mycpt", "wp-tsw"),
        "remove_featured_image" => __("Remove featured image for this Mycpt", "wp-tsw"),
        "use_featured_image" => __("Use as featured image for this Mycpt", "wp-tsw"),
        "archives" => __("Mycpts", "wp-tsw"),
        "insert_into_item" => __("Insert into Mycpt", "wp-tsw"),
        "uploaded_to_this_item" => __("Upload to this Mycpt", "wp-tsw"),
        "filter_items_list" => __("Filter Mycpts list", "wp-tsw"),
        "items_list_navigation" => __("Mycpts list navigation", "wp-tsw"),
        "items_list" => __("Mycpts list", "wp-tsw"),
        "attributes" => __("Mycpts attributes", "wp-tsw"),
        "name_admin_bar" => __("Mycpt", "wp-tsw"),
        "item_published" => __("Mycpt published", "wp-tsw"),
        "item_published_privately" => __("Mycpt published privately.", "wp-tsw"),
        "item_reverted_to_draft" => __("Mycpt reverted to draft.", "wp-tsw"),
        "item_scheduled" => __("Mycpt scheduled", "wp-tsw"),
        "item_updated" => __("Mycpt updated.", "wp-tsw"),
        "parent_item_colon" => __("Parent Mycpt:", "wp-tsw"),
    ];

    $args = [
        "label" => __("Mycpts", "wp-tsw"),
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
        "rewrite" => ["slug" => "mycpts", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-format-quote",
        "supports" => ["title", "thumbnail"],
        "show_in_graphql" => false,
    ];

    register_post_type("mycpts", $args);
}

add_action('init', 'wp_tsw_register_my_cpts_mycpts');



/**
 * Custom options page for ACF in archive
 * 
 * This adds an ACF options page for the custom post type (CPT).
 * We can use this page as a walk around to set ACF fields
 * in the CPT archive page.
 */

function wp_tsw_register_acf_options_mycpts()
{

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title'      => 'Mycpts Archive Page Options',
            'parent_slug'     => 'edit.php?post_type=mycpts',
            'capability' => 'manage_options'
        ));
    }
}

add_action('init', 'wp_tsw_register_acf_options_mycpts');



/**
 *  Pre get mycpt post types
 * 
 * This function improves site performance by preloading a set amount
 * of posts for display on a page. Change the 'posts_per_page' setting
 * to the number of posts to be displayed on the page by default.
 * 
 * @hook pre_get_posts
 * @hooked wp_tsw_pre_get_mycpts
 * @return void
 * @package SBX_Starter_Theme
 */

function wp_tsw_pre_get_mycpts($query)
{

    // do not modify queries in the admin
    if (is_admin()) {

        return $query;
    }

    // only modify queries for 'mycpts' post type
    if (
        isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'mycpts'
    ) {

        $query->set('post_status', 'publish');
        $query->set('meta_key', 'featured_mycpt');
        $args = array('meta_value' => 'DESC', 'modified' => 'DESC');
        $query->set('orderby', $args);


        // Set pagination for mycpts archive page
        if (is_post_type_archive('mycpts')) {

            if (get_query_var('paged')) {
                $paged = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }

            $query->set('nopaging', false);
            $query->set('paged', $paged);
            $query->set('posts_per_page', 6); // Change this to the number of posts to be displayed on the page by default
        }
    }

    return $query;
}

add_action('pre_get_posts', 'wp_tsw_pre_get_mycpts');
