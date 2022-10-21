<!-- Display social media icons -->
<ul class="list-inline social-icons">

    <?php if (get_field('facebook', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('facebook', 'option'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
        </li>
    <?php endif; ?>

    <?php if (get_field('twitter', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('twitter', 'option'); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        </li>
    <?php endif; ?>

    <?php if (get_field('instagram', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('instagram', 'option'); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
        </li>
    <?php endif; ?>

    <?php if (get_field('whatsapp', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('whatsapp', 'option'); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </li>
    <?php endif; ?>

    <?php if (get_field('youtube', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('youtube', 'option'); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
        </li>
    <?php endif; ?>

    <?php if (get_field('linkedin', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('linkedin', 'option'); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </li>
    <?php endif; ?>

    <?php if (get_field('snapchat', 'option')) : ?>
        <li class="list-inline-item">
            <a href="<?= get_field('snapchat', 'option'); ?>" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        </li>
    <?php endif; ?>
</ul>