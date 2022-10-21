<?php

/**
 * SBX Starter Theme - Dashboard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */


/**
 * Dashboard Widget - Support 
 */
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets()
{

    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_help_widget', 'StarBoxTech Support', 'custom_dashboard_help');
}

function custom_dashboard_help()
{
    if (wp_get_current_user()->user_login) {
        $name = wp_get_current_user()->user_login;
    } elseif (wp_get_current_user()->display_name) {
        $name = wp_get_current_user()->display_name;
    } elseif (wp_get_current_user()->first_name) {
        $name = wp_get_current_user()->first_name;
    } else {
        $name = 'User';
    }

    $site_name = get_bloginfo() ?: 'your awesome';
?>

    <p style="font-size: 32px; font-weight: bold; margin:0;">
        Hello <?php echo $name; ?>!
        <img src="<?= get_stylesheet_directory_uri() . '/dist/img/waving_hand.gif' ?>" alt="Hello" style="width:72px; height:72px; margin-bottom: -10px;">
    </p>

    <p style="font-size: 20px;">Welcome to <?= $site_name; ?> website!</p>

    <p>Need any help? Contact us via email <a href="mailto:hello@starboxtech.com">here</a>.</p>

    <p>You can also submit a ticket <a href="mailto:hello@starboxtech.com">here</a>.</p>

<?php
}

/**
 * Change Default Admin Footer
 * 
 * @hook admin_footer_text
 * @hooked sbx_change_admin_footer
 * @return void
 * @package SBX_Starter_Theme 
 */
function sbx_change_admin_footer()
{
    echo '<span id="footer-note">Thank you for choosing <a href="https://starboxtech.com/" target="_blank">StarBox Technologies</a>.</span>';
}
add_filter('admin_footer_text', 'sbx_change_admin_footer');
