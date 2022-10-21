<?php get_header() ?>

<!-- Hero section -->
<section class="hero__wrap">
    <div class="container">
        <div class="hero">
            <div class="hero__item" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
        </div>
    </div>
</section>

<section class="about">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-7">
                <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromLeft"><?= get_field('title'); ?></div>
                <div class="section-text l-clr gs__reveal gs__reveal--fromLeft"><?= get_field('lead_text'); ?></div>
            </div>
        </div>
    </div>
</section>


<?php get_footer() ?>