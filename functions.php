<?php

/**
 * SBX Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */

/**
 * Define directory location constants
 */
define('SBX_FUNC_PATH_MAIN', get_template_directory() . '/inc/sbx_functions');
define('SBX_FUNC_PATH_WOO', get_template_directory() . '/inc/sbx_woo_functions');
define('SBX_FUNC_PATH_CPT', get_template_directory() . '/inc/sbx_cpt');
define('SBX_FUNC_PATH_VENDOR', get_template_directory() . '/inc/vendor_functions');


/**
 * Load Environment Variables
 */
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(get_template_directory());
$dotenv->safeLoad();



if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.2.0');
}

if (!function_exists('sbx_starter_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function sbx_starter_theme_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SBX Starter Theme, use a find and replace
		 * to change 'sbx-starter-theme' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('sbx-starter-theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        // add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');


        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        // add_theme_support(
        //     'html5',
        //     array(
        //         'search-form',
        //         'comment-form',
        //         'comment-list',
        //         'gallery',
        //         'caption',
        //         'style',
        //         'script',
        //     )
        // );

        /**
         *  Set up the WordPress core custom background feature.
         */
        // add_theme_support(
        //     'custom-background',
        //     apply_filters(
        //         'sbx_starter_theme_custom_background_args',
        //         array(
        //             'default-color' => 'ffffff',
        //             'default-image' => '',
        //         )
        //     )
        // );

        /**
         * Add theme support for selective refresh for widgets. 
         */
        // add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core (Header) custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );


        /**
         * Add support for secondary (Footer) custom logo. 
         */
        function footer_logo_theme_support($wp_customize) // Custom function for footer logo
        {
            $wp_customize->add_setting('my_custom_footer_logo');

            // Add control to upload the footer logo
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'my_custom_footer_logo', array(
                'label' => 'Upload Footer Logo',
                'section' => 'title_tagline', // place in same section where the WP custom-logo is
                'settings' => 'my_custom_footer_logo',
                'priority' => 8 // show it just below the custom-logo
            )));
        }
        add_action('customize_register', 'footer_logo_theme_support');
    }
endif;
add_action('after_setup_theme', 'sbx_starter_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sbx_starter_theme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('sbx_starter_theme_content_width', 640);
}
add_action('after_setup_theme', 'sbx_starter_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// function sbx_starter_theme_widgets_init()
// {
//     register_sidebar(
//         array(
//             'name'          => esc_html__('Sidebar', 'sbx-starter-theme'),
//             'id'            => 'sidebar-1',
//             'description'   => esc_html__('Add widgets here.', 'sbx-starter-theme'),
//             'before_widget' => '<section id="%1$s" class="widget %2$s">',
//             'after_widget'  => '</section>',
//             'before_title'  => '<h2 class="widget-title">',
//             'after_title'   => '</h2>',
//         )
//     );
// }
// add_action('widgets_init', 'sbx_starter_theme_widgets_init');



/**
 * Enqueue custom & vendor styles 
 */

function sbx_starter_theme_styles()
{
    // Slick
    // wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    // wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    // Slick Lightbox
    // wp_enqueue_style('slick-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css');

    // Fancy Box
    wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');

    // Main stylesheet
    if ($_ENV['PROJECT_ENV'] == 'development') {
        wp_enqueue_style('sbx-starter-theme-custom-style', get_template_directory_uri() . '/dist/css/style.css');
    } else {
        wp_enqueue_style('sbx-starter-theme-custom-style', get_template_directory_uri() . '/dist/css/style.min.css');
    }


    // wp_style_add_data('sbx-starter-theme-custom-style', 'rtl', 'replace');
}
add_action('wp_enqueue_scripts', 'sbx_starter_theme_styles');



/**
 * Enqueue custom & vendor scripts 
 */
function sbx_starter_theme_scripts()
{
    // jQuery
    wp_enqueue_script('jquery');

    // Popper JS
    wp_enqueue_script('sbx-starter-theme-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '', true);

    // Vendor Scripts (e.g. Bootstrap)
    // wp_enqueue_script('sbx-starter-theme-vendor-scripts', get_template_directory_uri() . '/dist/js/vendor.js', array('jquery'), '', true); // Change to minified JS 

    // Bootstrap 5
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array('jquery'), '', true);

    // Flexslider JS
    wp_enqueue_script('flexslider', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js', array('jquery'), '', true);
    
    // Slick
    // wp_enqueue_script('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '', true);

    // Slick Lightbox
    // wp_enqueue_script('slick-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js', array('jquery'), '', true);

    //Isotope Filter Plugin
    wp_enqueue_script('isotope-filter', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array('jquery'), '', true);

    //Fancybox
    wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), '', true);

    // Stats Counter
    wp_enqueue_script('counter', 'https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js', array('jquery'), '', true);
    wp_enqueue_script('waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array('jquery'), '', true);

    //Fixed Header on Scroll
    wp_enqueue_script('scrolltofixed', get_template_directory_uri() . '/dist/js/jquery-scrolltofixed.js', array('jquery', 'customize-preview'), '', true);

    // GSAP (Animation)
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js', array('jquery'), '', true);

    // ScrollTrigger (GSAP Animation Plugin)
    wp_enqueue_script('scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js', array('jquery'), '', true);

     // Main Script
     if ($_ENV['PROJECT_ENV'] == 'development') {
        wp_enqueue_script('sbx-starter-theme-custom-scripts', get_template_directory_uri() . '/dist/js/custom.js', array('jquery', 'customize-preview'), '', true);
    } else {
        wp_enqueue_script('sbx-starter-theme-custom-scripts', get_template_directory_uri() . '/dist/js/custom.min.js', array('jquery', 'customize-preview'), '', true);
    }


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'sbx_starter_theme_scripts');


/**
 * Load SBX functions 
 */
require(SBX_FUNC_PATH_MAIN . '/config.php');
require(SBX_FUNC_PATH_MAIN . '/bootstrap.php');
require(SBX_FUNC_PATH_MAIN . '/utils.php');
require(SBX_FUNC_PATH_MAIN . '/notifications.php');
require(SBX_FUNC_PATH_MAIN . '/dashboard.php');
require(SBX_FUNC_PATH_MAIN . '/seo.php');


/**
 * Load SBX Woocommerce functions 
 */
// require(SBX_FUNC_PATH_WOO . '/woo.php');


/**
 * Load custom post types and taxonomies 
 */
// require(SBX_FUNC_PATH_CPT . '/your_cpt_and_taxonomy.php');
require(SBX_FUNC_PATH_CPT . '/projects.php');
require(SBX_FUNC_PATH_CPT . '/services.php');
require(SBX_FUNC_PATH_CPT . '/news.php');



/**
 * Load AJAX filter 
 */
include(SBX_FUNC_PATH_VENDOR . '/filter.php'); // Comment out if having issues with login



/**
 * Load template parts 
 */
include('template-parts/template_parts.php');
include('template-parts/helper_functions.php');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
