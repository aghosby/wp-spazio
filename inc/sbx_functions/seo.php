<?php

/**
 * SBX Starter Theme - SEO functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */


/**
 * Add SEO meta to HTML head
 * 
 * @hook wp_head, language_attributes
 * @hooked sbx_add_seo_meta_in_head, sbx_add_opengraph_doctype
 * @return void
 * @see https://www.wpbeginner.com/wp-themes/how-to-add-facebook-open-graph-meta-data-in-wordpress-themes/
 * @package SBX_Starter_Theme
 */
add_action('wp_head', 'sbx_add_seo_meta_in_head', 5);
add_filter('language_attributes', 'sbx_add_opengraph_doctype');

function sbx_add_seo_meta_in_head()
{
    /**
     * Adds Primary, Open Graph / Facebook, Twitter and
     * Dublin Core meta data (tags) to HTML head.
     * Also adds robots meta directives.
     */

    // Get meta data
    $meta = generate_seo_meta() ?: false;

    // Exit if no meta data
    if (!$meta) {
        return;
    }

    // Add Primary Meta Tags (default) meta tags to page
    echo '<!-- Primary Meta Tags -->' . "\n";
    echo '<meta name="title" content="' . $meta->title . '"/>' . "\n";
    echo '<meta name="description" content="' . $meta->description . '"/>' . "\n";
    // Disable default WP title first and use these ones instead
    // echo '<title>' . get_page_meta_title() . '</title>' . "\n"; 
    // echo '<meta name="title" content="' . get_page_meta_title() . '"/>' . "\n";
    // echo '<meta name="description" content="' . get_page_meta_description() . '"/>' . "\n";

    // Add Open Graph / Facebook (og:) meta tags to page
    echo '<!-- Open Graph / Facebook -->' . "\n";
    echo '<meta property="og:site_name" content="' . $meta->site_name . '"/>' . "\n";
    echo '<meta property="og:locale" content="' . $meta->locale . '"/>' . "\n";
    echo '<meta property="og:type" content="' . $meta->type . '"/>' . "\n";
    echo '<meta property="og:url" content="' . $meta->url . '"/>' . "\n";
    echo '<meta property="og:title" content="' . $meta->title . '"/>' . "\n";
    echo '<meta property="og:description" content="' . $meta->description . '"/>' . "\n";
    echo '<meta property="og:image" content="' . $meta->image . '"/>' . "\n";

    // Add Twitter (twitter:) meta tags to page
    echo '<!-- Twitter -->' . "\n";
    echo '<meta property="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta property="twitter:url" content="' . $meta->url . '"/>' . "\n";
    echo '<meta property="twitter:title" content="' . $meta->title . '"/>' . "\n";
    echo '<meta property="twitter:description" content="' . $meta->description . '"/>' . "\n";
    echo '<meta property="twitter:image" content="' . $meta->image . '"/>' . "\n";

    // Add Dublin Core (dc.) meta tags to page
    echo '<!-- Dublin Core -->' . "\n";
    echo '<meta name="dc.title" content="' . $meta->title . '"/>' . "\n";
    echo '<meta name="dc.description" content="' . $meta->description . '"/>' . "\n";
    echo '<meta name="dc.relation" content="' . $meta->url . '"/>' . "\n";
    echo '<meta name="dc.source" content="' . $meta->url . '"/>' . "\n";
    echo '<meta name="dc.language" content="' . $meta->locale . '"/>' . "\n";

    // Add robots meta directives
    echo '<!-- Robots meta directives -->' . "\n";
    echo '<meta name="robots" content="index, follow">' . "\n";
    echo '<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
    echo '<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";

    echo "
";
}



/**
 * SEO: Generate meta data
 * 
 * @return object SEO meta data
 * @package SBX_Starter_Theme
 */
function generate_seo_meta()
{

    global $post;

    // Set the default site title and description for all pages
    $title = wp_title('&ndash;', false, 'right') . get_bloginfo('name');
    // $title = get_page_meta_title('&ndash;');
    $title = truncate($title, 57); // Trim to Google specs of 60 chars (excludes ellipses)

    $description = get_search_item_excerpt();
    $description = truncate($description, 197); // Trim to Google specs of 60 chars (excludes ellipses)

    // Override the site title and description if it's a WooCommerce product page
    if (class_exists('WooCommerce')) {
        if (is_product()) {
            // Set the site title and description if it's a WooCommerce product page
            $product = wc_get_product();
            $title = 'Shop ' . $product->get_title() . ' at ' . get_bloginfo('name');
            $description = $product->get_short_description() ?: $product->get_description();
            $description = strip_tags($description);
            $description = truncate($description, 197); // Trim to Google specs of 200 chars (excludes ellipses)
        }
    }

    // Set page image    
    if (!has_post_thumbnail()) {
        // If the post does not have featured image, use a default image (Site logo)
        $custom_logo_id = get_theme_mod('custom_logo');
        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
        $image = ($image[0]) ? esc_attr($image[0]) : null;
    } else {
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
        $image = esc_attr($thumbnail_src[0]);
    }

    // Set the site name
    $site_name = get_bloginfo('name');
    // Set page url
    $url = get_permalink();
    // Set locale
    $locale = get_locale() ?: 'en_NG';
    // Set website type
    $type = 'website'; // Others are 'article', 'blog', 'company', 'food'

    // Return meta data
    return (object)array(
        'title' => $title,
        'description' => $description,
        'image' => $image,
        'site_name' => $site_name,
        'url' => $url,
        'locale' => $locale,
        'type' => $type,
    );
}



/**
 * SEO: Add Open Graph in the Language Attributes
 * 
 * @return string HTML doctype
 * @package SBX_Starter_Theme
 */
function sbx_add_opengraph_doctype($output)
{
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}



/**
 * SEO: Find the nearest title for a searched item
 * 
 * @return string Page/post title
 * @package SBX_Starter_Theme
 */
function get_search_item_title()
{
    // Builds the archive page ACF title query in the format 'postTypeLabel_title'
    $post_type = get_post_type_object(get_post_type());
    $post_type_name = lcfirst(esc_html($post_type->labels->name));
    $archive_title_acf_query = $post_type_name . '_title';

    // Checks if the page is an archive page with an ACF title
    if (is_archive() && get_field($archive_title_acf_query, 'options')) {
        return strip_tags(get_field($archive_title_acf_query, 'options'));
    }
    // Checks if the page has an ACF title
    elseif (get_field('title')) {
        return strip_tags(get_field('title'));
    }
    // Checks if the page has a default WP title
    elseif (get_the_title()) {
        return strip_tags(get_the_title());
    }
    // Uses the post type label with a prefix 'In' if no titles exist
    elseif (get_post_type_object(get_post_type())) {
        $post_type = get_post_type_object(get_post_type());
        $post_type_name = ucfirst(esc_html($post_type->labels->name));
        return 'In ' . $post_type_name;
    }
}



/**
 * SEO: Find the nearest excerpt for a searched item
 * 
 * @return string Page/post excerpt
 * @package SBX_Starter_Theme
 */
function get_search_item_excerpt()
{
    // Checks if the post has the 'lead_text' ACF field
    if (get_field('lead_text')) {
        return truncate(strip_tags(get_field('lead_text')), 200);
    }
    // Checks if the post has the 'highlight_text' ACF field
    elseif (get_field('highlight_text')) {
        return truncate(strip_tags(get_field('highlight_text')));
    }
    // Checks if the post has the 'content' ACF field
    elseif (get_field('content')) {
        return truncate(strip_tags(get_field('content')), 200);
    }
    // Checks if the post has a default WP excerpt
    elseif (get_the_excerpt()) {
        return strip_tags(get_the_excerpt());
    }
    // Checks if the post has a default WP content 
    elseif (get_the_content()) {
        return truncate(strip_tags(get_the_content(), 200));
    }
    // Uses its post type label with a prefix if no excerpts exist
    elseif (get_post_type_object(get_post_type())) {
        $post_type = get_post_type_object(get_post_type());
        $post_type_name = lcfirst(esc_html($post_type->labels->name));
        return 'Read more from ' . $post_type_name;
    }
}



/**
 * SEO: Get current page meta title
 * 
 * @return string Page meta title
 * @package SBX_Starter_Theme
 */
function get_page_meta_title(
    string $sep = '&verbar;',
    string $site_title = null,
    string $site_tagline = null

) {
    // Retrieve site title
    $site_title = get_bloginfo('name');

    // Retrieve site tagline
    $site_tagline = get_bloginfo('description');

    // Add space around separator
    $sep = ' ' . $sep . ' ';

    if (is_front_page()) {
        // Return format 'Site Title | Site Tagline' for the home page
        return $site_title . $sep . $site_tagline;
    } else {
        // Return format 'Page Title | Site Title | Site Tagline' for all other pages
        return get_search_item_title() . $sep . $site_title . $sep . $site_tagline;
    }
}



/**
 * SEO: Get current page meta description
 * 
 * @return string Page meta description
 * @package SBX_Starter_Theme
 */
function get_page_meta_description()
{
    // Uses get_search_item_excerpt() to return an excerpt for the page description
    return get_search_item_excerpt();
}
