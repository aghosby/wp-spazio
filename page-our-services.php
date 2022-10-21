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
                <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromLeft"><?= get_field('services_caption'); ?></div>
                <div class="section-text m-clr"><?= get_field('services_preamble'); ?></div>
            </div>
        </div>
    </div>
</section>


<!-- Service Areas Section -->
<section class="service-areas grey-sec">
    <div class="container">
        <div class="section-hdr center lg s-clr gs__reveal gs__reveal--fromBottom"><?= get_field('service_areas_heading'); ?></div>
        <?php if (have_rows('service_areas')) : ?>
            <div class="col-wrap col-sec-5 mt-3">
                <?php while (have_rows('service_areas')) : the_row(); ?>
                    <div class="col-hld media js-anime xflip">
                        <div class="cont">
                            <div class="col-photo" style="background-image: url('<?= get_sub_field('photo')['sizes']['large']; ?>');"></div>
                            <div class="details">
                                <div class="col-title"><?= get_sub_field('title'); ?></div>
                            </div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Process Section -->
<section class="c-sec">
    <div class="container">
        <div class="section-hdr center lg s-clr gs__reveal gs__reveal--fromBottom"><?= get_field('process_section_heading'); ?></div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
                <img class="main" src="<?= get_field('process_image')['sizes']['large']; ?>" alt="<?= get_field('director_name'); ?>"/>
            </div>
        </div>
    </div>
</section>

<!-- Director Section -->
<section class="c-sec c-pad grey-sec">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <img class="main" src="<?= get_field('director_photo')['sizes']['large']; ?>" alt="<?= get_field('director_name'); ?>"/>
                    </div>
                    <div class="col-lg-5 col-md-12 mt-lg-0 mt-2 details">
                        <div class="section-hdr lg wht gs__reveal gs__reveal--fromLeft"><?= get_field('director_quote'); ?></div>
                        <img class="sign" src="<?= get_field('director_signature')['sizes']['large']; ?>" alt="<?= get_field('director_name'); ?>"/>
                        <div class="name gs__reveal gs__reveal--fromLeft"><?= get_field('director_name'); ?></div>
                        <div class="role l-clr"><?= get_field('director_role'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>