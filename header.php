<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SBX_Starter_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Custom Project Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">

        <header id="masthead" class="site-header">

            <!-- Header content here (Uses WP Bootstrap Navwalker) -->
            <nav class="navbar navbar-expand-lg navbar-dark" role="navigation">
                <div class="container">

                    <div class="navbar__logo">
                        <div class="logo-container">
                            <!-- First icon group (Mobile-only) -->
                            <div class="navbar__top--start">
                                <!-- Navbar toggler -->
                                <button class="navbar-toggler navbar__icon dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">   
                                    <i class="fal fa-bars"></i>
                                </button>
                            </div>

                            <!-- Header logo -->
                            <div class="navbar-brand">
                                <a href="<?php echo home_url(); ?>">

                                    <?php
                                        $custom_logo_id = get_theme_mod('custom_logo');
                                        $logo = wp_get_attachment_image_src($custom_logo_id); 
                                    ?>

                                    <?php $footer_logo = get_theme_mod('my_custom_footer_logo');?>

                                    <div class="navbar-brand--image">
                                        <img src="<?php bloginfo('template_directory'); ?>/dist/img/spazio-logo.png"/>
                                    </div>

                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Menu Navigation -->

                    <div class="navbar__menu">

                        <div class="container nav">

                            <div class="mobile-menu-hdr">
                                <div class="navbar-brand--image">
                                    <img src="<?php bloginfo('template_directory'); ?>/dist/img/spazio-logo.png"/>
                                </div>
                                <button class="navbar-toggler navbar__icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fal fa-times"></i>
                                </button>
                            </div>

                            <?php
                            wp_nav_menu(array(
                                'theme_location'    => 'primary',
                                'depth'             => 1, // 1 = no dropdowns, 2 = with dropdowns.
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse',
                                'container_id'      => 'navbarNav',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'add_a_class'       => 'nav-link',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ));
                            ?>

                        </div>

                    </div>

                </div>

            </nav>

        </header>