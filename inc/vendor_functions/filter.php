<?php
// Ajax Filter (ADD TO SEPERATE INCLUDES FILE)
add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

function misha_filter_function()
{

    $args = array(
        'orderby' => 'date', // we will sort posts by date
        'order' => $_POST['date'],
        'posts_per_page' => 6,
        'post_type' => 'news', // Fliter news category
        's' => sanitize_text_field($_POST['input'])
    );

    // for taxonomies / categories
    if (isset($_POST['categoryfilter']))
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category', // Taxonomy name
                'field' => 'id', // Field to query
                'terms' => $_POST['categoryfilter'], // Get taxonomy terms
            )
        );


    $query = new WP_Query($args);


    // Start posts loop

    // if ($query->have_posts()) :
    // 	while ($query->have_posts()) : $query->the_post();
    // 		get_template_part('template-parts', my_news_article());
    // 	endwhile;
    // else :
    // 	echo '<div class="no-posts-found">No posts found lol</div>';
    // endif;
    // wp_reset_postdata();

    // End posts loop

    die();
}
