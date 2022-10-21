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
            </div>
        </div>
    </section>


    <!-- Details Section -->
    <section class="c-pad">
        <div class="container">
            <div class="row section-pt justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="section-hdr xl s-clr gs__reveal gs__reveal--fromRight"><?php echo the_title(); ?></div>
                    <div class="breadcrumb">
                        <?php $date = get_post_meta(get_the_ID(), 'date', true)?>
                        <ul>
                            <li>
                                <a href="<?php echo site_url('/media'); ?>"><?= get_field('media_type'); ?></a>
                            </li>
                            <li><?php echo date('d F, Y', strtotime($date)); ?></li>
                            <li class="share-icons gs__reveal gs__reveal--fromLeft">
                                <span>Share this article</span>
                                <?php get_template_part('template-parts/social', 'share'); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="section-text m-clr gs__reveal gs__reveal--fromRight">
                        <?= get_field('content'); ?>
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
                    <div class="col-wrap ">
                        <?php
                            // Create query
                            $query_args = array(
                                'post_type' => 'news',
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

    <?php
	    endwhile; // End of the loop.
	?>


<?php get_footer(); ?>
