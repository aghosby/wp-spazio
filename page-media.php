<?php get_header() ?>

<!-- Hero section -->
<section class="hero__wrap">
    <div class="container">
        <div class="hero">
            <div class="hero__item" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
        </div>
    </div>
</section>


<!-- News Section -->
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <div class="filter-section">
                    <div class="button-group filter-button-group">
                        <button data-filter="*">All News</button>
                        <button data-filter=".article">Articles</button>
                        <button data-filter=".press">In the press</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="news-wrap grid">
                    <?php
                        // Create query
                        $query_args = array(
                            'post_type' => 'news',
                            'posts_per_page' => -1
                        );

                        $query = new WP_Query($query_args); 

                        //var_dump($query);
                    ?>

                    <!-- Start posts loop -->
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post();?>
                            <?php $str = get_post_meta(get_the_ID(), 'media_type', true);  ?>
                            <div class="col-hld media grid-item <?php echo strtolower($str); ?> js-anime xflip">
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
            </div>
        </div>
    </div>
</section>


<?php get_footer() ?>