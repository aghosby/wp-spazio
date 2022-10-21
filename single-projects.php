<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SBX_Starter_Theme
 */

get_header();
?>

    <?php while ( have_posts() ) : the_post(); ?>

	<!-- Hero section -->
    <section class="hero__wrap">
        <div class="container">
            <div class="hero">
                <div class="hero__item" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
                <div class="project-info">
                    <div class="project-name">Project <?php echo the_title(); ?></div>
                    <div class="project-summary"><?= get_field('project_short_description'); ?></div>
                    <div class="project-details">
                        <div class="item"><span class="hdr">Year:</span><?= get_field('year'); ?></div>
                        <div class="item"><span class="hdr">Location:</span><?= get_field('location'); ?></div>
                        <div class="item"><span class="hdr">Client:</span><?= get_field('client'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Details Section -->
    <section class="c-pad">
        <div class="container">
            <div class="row section-pt justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromRight">Project Brief</div>
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="<?php echo site_url('/our-projects'); ?>">Back to Projects</a>
                            </li>
                            <?php if (get_field('project_type')) : ?>
                                <li><?= get_field('project_type'); ?></li>
                            <?php endif; ?>
                            <?php if (get_field('scope')) : ?>
                                <li><?= get_field('scope'); ?></li>
                            <?php endif; ?>
                            <li class="share-icons gs__reveal gs__reveal--fromLeft">
                                <span>Share this project</span>
                                <?php get_template_part('template-parts/social', 'share'); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="section-text m-clr gs__reveal gs__reveal--fromRight">
                        <?= get_field('project_details'); ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="pb-lg-3">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-12">

                    <!-- <div class="section-hdr clr lg gs__reveal gs__reveal--fromRight">See Other Services</div> -->
                    <?php $images = get_field('project_gallery'); ?>
                    <div class="gallery-wrap">
                        <div class="gallery-cont">
                            <?php if( $images ): ?>
                                <?php foreach( $images as $image ): ?>
                                    <a class="gallery-hld grid-item" href="<?php echo $image['url']; ?>" data-fancybox="gallery" data-caption="<?php echo the_title(); ?>">
                                        <img class="js-anime xflip" src="<?php echo $image['url']; ?>" alt="" />
                                    </a>
                                    <!-- <div class="gallery-hld grid-item <?php echo strtolower($filter); ?>" style="background-image: url('<?php echo $image['url']; ?>');"></div> -->
                                <?php endforeach; ?>
                            <?php
                            endif;?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
    </section>


    <section class="c-pad grey-sec">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-12">

                    <!-- <div class="section-hdr clr lg gs__reveal gs__reveal--fromRight">See Other Services</div> -->
                    <div class="col-wrap">
                        <?php
                            // Create query
                            $query_args = array(
                                'post_type' => 'projects',
                                'posts_per_page' => 3,
                                'post__not_in' => array( $post->ID )
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

                </div>
            </div>
        </div>
        
    </section>

    <?php
	    endwhile; // End of the loop.
	?>


<?php get_footer(); ?>
