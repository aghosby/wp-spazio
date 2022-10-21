<?php

/**
 *
 * All custom post types and taxonomies for this website go here
 *
 */


/**
 * Custom post type (Client projects) 
 */

function wp_spazio_register_my_cpts_projects()
{

    $labels = [
        "name" => __("Projects", "wp-spazio"),
        "singular_name" => __("Project", "wp-spazio"),
        "menu_name" => __("Projects", "wp-spazio"),
        "all_items" => __("All Projects", "wp-spazio"),
        "add_new" => __("Add new", "wp-spazio"),
        "add_new_item" => __("Add new Project", "wp-spazio"),
        "edit_item" => __("Edit Project", "wp-spazio"),
        "new_item" => __("New Project", "wp-spazio"),
        "view_item" => __("View Project", "wp-spazio"),
        "view_items" => __("View Projects", "wp-spazio"),
        "search_items" => __("Search Projects", "wp-spazio"),
        "not_found" => __("No Projects found", "wp-spazio"),
        "not_found_in_trash" => __("No Projects found in trash", "wp-spazio"),
        "parent" => __("Parent Project:", "wp-spazio"),
        "featured_image" => __("Featured image for this Project", "wp-spazio"),
        "set_featured_image" => __("Set featured image for this Project", "wp-spazio"),
        "remove_featured_image" => __("Remove featured image for this Project", "wp-spazio"),
        "use_featured_image" => __("Use as featured image for this Project", "wp-spazio"),
        "archives" => __("Projects", "wp-spazio"),
        "insert_into_item" => __("Insert into Project", "wp-spazio"),
        "uploaded_to_this_item" => __("Upload to this Project", "wp-spazio"),
        "filter_items_list" => __("Filter Projects list", "wp-spazio"),
        "items_list_navigation" => __("Projects list navigation", "wp-spazio"),
        "items_list" => __("Projects list", "wp-spazio"),
        "attributes" => __("Projects attributes", "wp-spazio"),
        "name_admin_bar" => __("Project", "wp-spazio"),
        "item_published" => __("Project published", "wp-spazio"),
        "item_published_privately" => __("Project published privately.", "wp-spazio"),
        "item_reverted_to_draft" => __("Project reverted to draft.", "wp-spazio"),
        "item_scheduled" => __("Project scheduled", "wp-spazio"),
        "item_updated" => __("Project updated.", "wp-spazio"),
        "parent_item_colon" => __("Parent Project:", "wp-spazio"),
    ];

    $args = [
        "label" => __("Projects", "wp-spazio"),
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
        "rewrite" => ["slug" => "projects", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-businessman",
        "supports" => ["title", "thumbnail"],
        "show_in_graphql" => false,
    ];

    $labels = [
        "name" => __("Category", "wp-spazio"),
        "singular_name" => __("Category", "wp-spazio"),
        "search_items" => __("Search", "wp-spazio"),
        "popular_items" => __("More Used", "wp-spazio"),
        "all_items" => __("All Categories", "wp-spazio"),
        "parent_item" => null,
        "parent_item_colon" => null,
        "add_new" => __("Add new", "wp-spazio"),
        "add_new_item" => __("Add new Category", "wp-spazio"),
        "edit_item" => __("Edit Category", "wp-spazio"),
        "new_item" => __("New Category", "wp-spazio"),
        "view_item" => __("View Category", "wp-spazio"),
        "update_item" => __("Update", "wp-spazio"),
        "view_items" => __("View Projects", "wp-spazio"),
    ];

    register_taxonomy('project_category', array('projects'), array(
        "hierarchical" => true,
        "labels" => $labels,
        "singular_label" => "project_category",
        "all_items" => "Category",
        "query_var" => true,
        "rewrite" => ["slug" => "project-category", "with_front" => true],
    ));

    register_post_type("projects", $args);
    flush_rewrite_rules();
}

add_action('init', 'wp_spazio_register_my_cpts_projects');



// Custom options page for ACF in archive

function wp_spazio_register_acf_options_projects()
{

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title'      => 'Projects Archive Page Options',
            'parent_slug'     => 'edit.php?post_type=Projects',
            'capability' => 'manage_options'
        ));
    }
}

add_action('init', 'wp_spazio_register_acf_options_projects');


// Pre get Project post types


function wp_spazio_pre_get_projects($query)
{

    // do not modify queries in the admin
    if (is_admin()) {

        return $query;
    }

    // only modify queries for 'projects' post type
    if (
        isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'projects'
    ) {

        $query->set('post_status', 'publish');
        //$query->set('meta_key', 'featured_project');
        $args = array('meta_value' => 'DESC', 'modified' => 'DESC');
        $query->set('orderby', $args);


        // Set pagination for projects archive page
        if (is_post_type_archive('projects')) {

            if (get_query_var('paged')) {
                $paged = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }

            $query->set('nopaging', false);
            $query->set('paged', $paged);
            $query->set('posts_per_page', 5);
        }
    }

    return $query;
}

add_action('pre_get_posts', 'wp_spazio_pre_get_projects');
