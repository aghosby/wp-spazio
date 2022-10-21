<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package SBX_Starter_Theme
 */
?>

<?php get_header() ?>

<section class="default page-404">
    <div class="container-md">

        <h1 class="h1 page-404__title">We <span>couldn’t</span> find the page...</h1>

        <p class="page-404__message">Sorry, the page you are looking for was either not found or does not exist. Try refreshing the page, or try searching for it below. If you have found an issue we should be aware of, we’d be grateful if you could report it to us by emailing
            <a href="mailto:<?= get_field('emails', 'option')[0]['email']; ?>">
                <?= get_field('emails', 'option')[0]['email']; ?>
            </a>
        </p>

        <!-- Form -->
        <div class="page-404__search-form">
            <?= get_search_form(); ?>
        </div>

        <!-- Go back home -->
        <div class="page-404__back-home">
            <a href="<?= site_url('home'); ?>" class="btn btn-primary">
                <span>Back to homepage</span>
                <i class="fal fa-home"></i>
            </a>
        </div>

    </div>
</section>

<?php get_footer() ?>