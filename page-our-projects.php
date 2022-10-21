<?php get_header() ?>

<!-- Hero section -->
<section class="hero__wrap">
    <div class="container">
        <div class="hero">
            <div class="hero__item" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
        </div>
    </div>
</section>


<!-- Projects Section -->
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="filter-section">
                    <div class="button-group filter-button-group">
                        <button data-filter="*">All Projects</button>
                        <button data-filter=".commercial">Commercial</button>
                        <button data-filter=".residential">Residential</button>
                        <button data-filter=".hospitality">Hospitality</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="news-wrap grid">
                    <?php
                        // Create query
                        $query_args = array(
                            'post_type' => 'projects',
                            'posts_per_page' => -1
                        );

                        $query = new WP_Query($query_args); 

                        //var_dump($query);
                    ?>

                    <!-- Start posts loop -->
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post();?>
                            <?php $str = get_post_meta(get_the_ID(), 'project_type', true);  ?>
                            <div class="col-hld grid-item <?php echo strtolower($str); ?>  js-anime xflip">
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
            </div>
        </div>
    </div>
</section>


<?php get_footer() ?>