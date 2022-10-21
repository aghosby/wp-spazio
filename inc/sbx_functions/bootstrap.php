<?php

/**
 * SBX Starter Theme - Bootstrap functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */


/**
 * Register Bootstrap Nav Walker Class 
 */
require(SBX_FUNC_PATH_VENDOR . '/class_wp_bootstrap_navwalker.php');

function wpb_theme_setup()
{
    // Nav Menus
    register_nav_menus(array(
        'primary' => _('Primary Menu')
    ));
}

add_action('after_setup_theme', 'wpb_theme_setup');


/**
 * Wordpress 5.4 Bootstrap 4.4 Pagination 
 */

/* 
 * UPDATE for Bootstrap 5.0: https://gist.github.com/mtx-z/af85d3abd4c19a84a9713e69956e1507
 * 
 * INSTALLATION:
 * add this file content to your theme function.php or equivalent
 *
 * USAGE:
 *     <?php echo bootstrap_pagination(); ?> //uses global $wp_query
 * or with custom WP_Query():
 *     <?php
 *      $query = new \WP_Query($args);
 *       ... while(have_posts()), $query->posts stuff ... endwhile() ...
 *       echo bootstrap_pagination($query);
 *     ?>
 */

function bootstrap_pagination(\WP_Query $wp_query = null, $echo = true, $params = [])
{
    if (null === $wp_query) {
        global $wp_query;
    }

    $add_args = [];

    //add query (GET) parameters to generated page URLs
    /*if (isset($_GET[ 'sort' ])) {
        $add_args[ 'sort' ] = (string)$_GET[ 'sort' ];
    }*/

    $pages = paginate_links(
        array_merge([
            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format'       => '?paged=%#%',
            'current'      => max(1, get_query_var('paged')),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => __('<i class="fal fa-angle-left"></i> <span>Prev</span>'),
            'next_text'    => __('<span>Next</span> <i class="fal fa-angle-right"></i>'),
            'add_args'     => $add_args,
            'add_fragment' => ''
        ], $params)
    );

    if (is_array($pages)) {
        $current_page = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        $pagination = '<div class="pagination"><ul class="pagination">';

        foreach ($pages as $page) {
            $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
        }

        $pagination .= '</ul></div>';

        if ($echo) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }

    return null;
}
