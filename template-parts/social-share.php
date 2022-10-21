<?php

/**
 * Social Share Buttons template for Wordpress
 * 
 * @package SBX_Starter_Theme
 */

// Generate page meta data
$meta = generate_seo_meta() ?: false;

// Use default title and url if no meta data
if (!$meta) {
    $post_url = get_permalink(); // Post URL
    $post_title = get_the_title(); // Post title
} else {
    $post_url = $meta->url; // Post URL
    $post_title = $meta->title; // Post title
}

?>

<div class="social-share">

    <!-- Facebook -->
    <a target="_blank" class="share share-facebook" href="https://www.facebook.com/sharer.php?u=<?= $post_url; ?>" title="<?= $post_title; ?>">
        <i class="fab fa-facebook-f"></i>
    </a>

    <!-- Twitter -->
    <a target="_blank" class="share share-twitter" href="https://twitter.com/intent/tweet?url=<?= $post_url; ?>&text=<?= $post_title; ?>&via=<?= the_author_meta('twitter'); ?>" title="<?= $post_title; ?>">
        <i class="fab fa-twitter"></i>
    </a>

    <!-- LinkedIn -->
    <a target="_blank" class="share share-linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $post_url; ?>" title="<?= $post_title; ?>">
        <i class="fab fa-linkedin-in"></i>
    </a>

    <!-- Whatsapp 
    <a target="_blank" class="share share-whatsapp" href="whatsapp://send?text=<?= $post_title . '%20' . $post_url; ?>" data-action="share/whatsapp/share" title="<?= $post_title; ?>">
        <i class="fab fa-whatsapp"></i>
        <span>Share on WhatsApp</span>
    </a>
    -->

    <!-- Google+ -->
    <!-- <a target="_blank" class="share share-googleplus" href="https://plus.google.com/share?url=<?= $post_url; ?>" title="<?= $post_title; ?>">
        <i class="fab fa-google-plus"></i>
        <span>Share on Google+</span>
    </a> -->

</div>