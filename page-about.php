<?php get_header() ?>

<!-- Hero section -->
<section class="hero__wrap">
    <div class="container">
        <div class="hero">
            <div class="hero__item">
                <video autoplay controls muted loop>
                    <source src="<?= get_field('featured_video'); ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</section>

<section class="about">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-7">
                <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromLeft"><?= get_field('about_caption'); ?></div>
            </div>
        </div>

        <div class="row justify-content-center align-items-center">
            <div class="col-lg-7">
                <?php if (have_rows('about_spazio')) : ?>
                    <?php $count = 0; ?>
                    <div class="pillar__wrap">
                        <?php while (have_rows('about_spazio')) : the_row(); ?>
                            <?php $count = $count + 1 ;?>
                            <div class="pillar__hld">
                                <div class="photo" style="background-image: url('<?= get_sub_field('photo')['sizes']['large']; ?>')"></div>
                                <div class="info">
                                    <div class="count">0<?= $count; ?>.</div>
                                    <div class="title"><?= get_sub_field('title'); ?></div>
                                    <div class="preamble"><?= get_sub_field('preamble'); ?></div>
                                    <div class="section-text m-clr font-rd"><?= get_sub_field('content'); ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<!-- Team Section -->
<section class="team grey-sec">
    <div class="container">
        <div class="section-hdr center lg s-clr gs__reveal gs__reveal--fromBottom"><?= get_field('team_section_heading'); ?></div>
        <?php if (have_rows('team')) : ?>
            <div class="team__wrap">
                <?php while (have_rows('team')) : the_row(); ?>
                    <div class="team__hld">
                        <div class="photo" style="background-image: url('<?= get_sub_field('photo')['sizes']['large']; ?>')"></div>
                        <div class="name"><?= get_sub_field('name'); ?></div>
                        <div class="role"><?= get_sub_field('role'); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer() ?>