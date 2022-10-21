<?php get_header() ?>

<!-- Hero section -->
<section class="hero__wrap">
    <div class="container">
        <div class="hero">
            <div class="flexslider">
                <?php if (have_rows('banner')) : ?>
                    <ul class="slides">
                        <?php while (have_rows('banner')) : the_row(); ?>
                            <li style="background-image: url('<?= get_sub_field('photo')['sizes']['large']; ?>')">
                                <div class="container">
                                    <div class="flex-caption">
                                        <div class="slide_header slideInLeft"><?= get_sub_field('title'); ?></div>
                                        <div class="slide_desc slideInLeft"><?= get_sub_field('lead_text'); ?></div>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <div class="row section-pt justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="section-hdr lg s-clr gs__reveal gs__reveal--fromLeft"><?= get_field('testimonial_section_heading'); ?></div>
                <?php if (have_rows('testimonials')) : ?>
                    <div class="accordion__wrap light-bkg gs__reveal gs__reveal--fromBottom">
                        <?php while (have_rows('testimonials')) : the_row(); ?>
                            <div class="accordion__hld">
                                <div class="intro">
                                    <div class="author">
                                        <div class="name"><?= get_sub_field('name'); ?></div>
                                        <div class="role"><?= get_sub_field('role'); ?></div>
                                    </div>
                                    <div class="icon">
                                        <i class="fal fa-chevron-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="content"><?= get_sub_field('content'); ?></div>
                            </div>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-6">
                <div class="section-image js-anime yflip">
                    <img src="<?= get_field('testimonial_section_image')['sizes']['large']; ?>" alt=""/>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Stats Section -->
<section class="company-stats grey-sec">
    <div class="container">
        <?php if (have_rows('company_stats')) : ?>
            <div class="counter__wrap">
                <?php while (have_rows('company_stats')) : the_row(); ?>
                    <div class="counter__hld">
                        <div class="count">
                            <span class="counter"><?= get_sub_field('stat_no'); ?></span>
                            <span>+</span>
                        </div>
                        <div class="title"><?= get_sub_field('stat_title'); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Clients Section -->
<section class="clients">
    <div class="container">
        <div class="section-hdr center lg s-clr gs__reveal gs__reveal--fromBottom"><?= get_field('client_section_heading'); ?></div>
        <div class="section-hdr center md t-clr gs__reveal gs__reveal--fromBottom"><?= get_field('client_section_lead_text'); ?></div>
        <?php if (have_rows('clients')) : ?>
            <div class="client__wrap">
                <?php while (have_rows('clients')) : the_row(); ?>
                    <div class="client__hld">
                        <img src="<?= get_sub_field('logo')['sizes']['large']; ?>" alt=""/>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Projects Section -->
<section class="projects">
    <div class="container">
        <div class="col-wrap col-sec-5 video">
            <div class="col-hld">
                <div class="video-cont"><?php echo get_field('project_video'); ?></div>
            </div>
            <?php
                // Create query
                $query_args = array(
                    'post_type' => 'projects',
                    'posts_per_page' => 4
                );

                $query = new WP_Query($query_args); 

                //var_dump($query);
            ?>

            <!-- Start posts loop -->
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post();?>
                    <div class="col-hld js-anime xflip">
                        <a href="<?php echo the_permalink(); ?>">
                            <div class="col-photo" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
                            <div class="details">
                                <div class="col-title"><?php echo the_title(); ?></div>
                            </div>
                            <div class="overlay"></div>
                        </a>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            <?php endif; ?>
            <!-- End posts loop -->

        </div>
        <div class="btn-hld gs__reveal gs__reveal--fromBottom">
            <a href="<?= get_field('projects_section_link')['url']; ?>" class="btn-1"><?= get_field('projects_section_link')['title']; ?></a>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news grey-sec">
    <div class="container">
        <div class="section-hdr center lg s-clr gs__reveal gs__reveal--fromBottom mb-2"><?= get_field('news_section_heading'); ?></div>
        <div class="col-wrap ">
            <?php
                // Create query
                $query_args = array(
                    'post_type' => 'news',
                    'posts_per_page' => 3
                );

                $query = new WP_Query($query_args); 

                //var_dump($query);
            ?>

            <!-- Start posts loop -->
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post();?>
                    <div class="col-hld media m-news js-anime xflip">
                        <a href="<?php echo the_permalink(); ?>">
                            <div class="col-photo" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
                            <div class="details">
                                <?php $date = get_post_meta(get_the_ID(), 'date', true)?>
								<div class="date"><?php echo date('d F, Y', strtotime($date)); ?></div>
                                <div class="col-title"><?php echo the_title(); ?></div>
                            </div>
                            <div class="overlay"></div>
                        </a>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            <?php endif; ?>
            <!-- End posts loop -->

        </div>
        <div class="btn-hld gs__reveal gs__reveal--fromBottom">
            <a href="<?= get_field('news_section_link')['url']; ?>" class="btn-1"><?= get_field('news_section_link')['title']; ?></a>
        </div>
    </div>
</section>

<?php get_footer() ?>