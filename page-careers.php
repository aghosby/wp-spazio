<?php get_header() ?>

<!-- Hero section -->
<section class="hero__wrap">
    <div class="container">
        <div class="hero">
            <div class="hero__item" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
        </div>
    </div>
</section>


<!-- Team Section -->
<section class="c-sec c-pad">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-11">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-12 mt-lg-0 mt-2 r-align">
                        <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromLeft"><?= get_field('team_section_caption'); ?></div>
                        <div class="section-text m-clr"><?= get_field('team_section_preamble'); ?></div>
                    </div>
                    <div class="col-lg-5 col-md-12 mt-lg-0 mt-2 details">
                        <img class="main" src="<?= get_field('team_section_photo')['sizes']['large']; ?>" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Work Section -->
<section class="c-sec c-pad grey-sec">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-11">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-12 mt-lg-0 mt-2 details order-lg-2">
                        <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromLeft"><?= get_field('work_section_caption'); ?></div>
                        <div class="section-text m-clr"><?= get_field('work_section_preamble'); ?></div>
                    </div>
                    <div class="col-lg-5 col-md-12 mt-lg-0 mt-2 details order-lg-1">
                        <img class="main" src="<?= get_field('work_section_photo')['sizes']['large']; ?>" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>