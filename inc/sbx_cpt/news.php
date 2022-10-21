<?php

/**
 *
 * All custom post types and taxonomies for this website go here
 *
 */


/**
 * Custom post type (Client news) 
 */

function wp_spazio_register_my_cpts_news()
{

    $labels = [
        "name" => __("News", "wp-spazio"),
        "singular_name" => __("News", "wp-spazio"),
        "menu_name" => __("News", "wp-spazio"),
        "all_items" => __("All News", "wp-spazio"),
        "add_new" => __("Add new", "wp-spazio"),
        "add_new_item" => __("Add new News", "wp-spazio"),
        "edit_item" => __("Edit News", "wp-spazio"),
        "new_item" => __("New News", "wp-spazio"),
        "view_item" => __("View News", "wp-spazio"),
        "view_items" => __("View News", "wp-spazio"),
        "search_items" => __("Search News", "wp-spazio"),
        "not_found" => __("No News found", "wp-spazio"),
        "not_found_in_trash" => __("No News found in trash", "wp-spazio"),
        "parent" => __("Parent News:", "wp-spazio"),
        "featured_image" => __("Featured image for this News", "wp-spazio"),
        "set_featured_image" => __("Set featured image for this News", "wp-spazio"),
        "remove_featured_image" => __("Remove featured image for this News", "wp-spazio"),
        "use_featured_image" => __("Use as featured image for this News", "wp-spazio"),
        "archives" => __("News", "wp-spazio"),
        "insert_into_item" => __("Insert into News", "wp-spazio"),
        "uploaded_to_this_item" => __("Upload to this News", "wp-spazio"),
        "filter_items_list" => __("Filter News list", "wp-spazio"),
        "items_list_navigation" => __("News list navigation", "wp-spazio"),
        "items_list" => __("News list", "wp-spazio"),
        "attributes" => __("News attributes", "wp-spazio"),
        "name_admin_bar" => __("News", "wp-spazio"),
        "item_published" => __("News published", "wp-spazio"),
        "item_published_privately" => __("News published privately.", "wp-spazio"),
        "item_reverted_to_draft" => __("News reverted to draft.", "wp-spazio"),
        "item_scheduled" => __("News scheduled", "wp-spazio"),
        "item_updated" => __("News updated.", "wp-spazio"),
        "parent_item_colon" => __("Parent News:", "wp-spazio"),
    ];

    $args = [
        "label" => __("News", "wp-spazio"),
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
        "rewrite" => ["slug" => "news", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-megaphone",
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
        "view_items" => __("View News", "wp-spazio"),
    ];

    register_taxonomy('news_category', array('news'), array(
        "hierarchical" => true,
        "labels" => $labels,
        "singular_label" => "news_category",
        "all_items" => "Category",
        "query_var" => true,
        "rewrite" => ["slug" => "news-category", "with_front" => true],
    ));

    register_post_type("news", $args);
    flush_rewrite_rules();
}

add_action('init', 'wp_spazio_register_my_cpts_news');



// Custom options page for ACF in archive

function wp_spazio_register_acf_options_news()
{

    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(array(
            'page_title'      => 'News Archive Page Options',
            'parent_slug'     => 'edit.php?post_type=News',
            'capability' => 'manage_options'
        ));
    }
}

add_action('init', 'wp_spazio_register_acf_options_news');


// Pre get News post types


function wp_spazio_pre_get_news($query)
{

    // do not modify queries in the admin
    if (is_admin()) {

        return $query;
    }

    // only modify queries for 'news' post type
    if (
        isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'news'
    ) {

        $query->set('post_status', 'publish');
        //$query->set('meta_key', 'featured_news');
        $args = array('meta_value' => 'DESC', 'modified' => 'DESC');
        $query->set('orderby', $args);


        // Set pagination for news archive page
        if (is_post_type_archive('news')) {

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

add_action('pre_get_posts', 'wp_spazio_pre_get_news');
