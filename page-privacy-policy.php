<?php get_header() ?>

<!-- Feature section-->
<?php get_template_part('template-parts/section', 'feature'); ?>

<section class="default">
    <div class="container-md">
        <div class="content"><?= get_field('content'); ?></div>
    </div>
</section>

<?php get_footer() ?>