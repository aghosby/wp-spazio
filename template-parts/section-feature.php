<section class="feature container">

    <?php

    // Get args else use default fields

    $acf_image = $args['acf_image'] ?? (get_field('featured_image')['url'] ?? null);
    $title = $args['title'] ?? (get_field('title') ?: get_the_title());
    $lead_text = $args['lead_text'] ?? get_field('lead_text');

    // Set page featured image

    $wp_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');

    if ($wp_image && $acf_image) {
        $featured_image = $acf_image;
    } elseif (!$wp_image || $wp_image === '' || empty($wp_image)) {
        $featured_image = $acf_image;
    } else {
        $featured_image = $wp_image;
    }

    ?>

    <!-- SEO breadcrumbs -->
    <div class="feature__breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
        <?php if (function_exists('bcn_display')) {
            bcn_display();
        } ?>
    </div>

    <!-- Page title -->
    <h1 class="h1 feature__title"><?= $title; ?> </h1>

    <!-- Lead text -->
    <p class="feature__lead-text"><?= $lead_text; ?></p>

</section>