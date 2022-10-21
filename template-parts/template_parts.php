<?php
// Article Template Part
function article()
{ ?>
    <article class="row single-article mb-4">
        <div class="col-lg-5">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large', array('class' => 'img-fluid')) ?>
            </a>
        </div>
        <div class="col-lg-7 single-article-content">
            <a href="<?php the_permalink(); ?>">
                <h2><?= the_title(); ?></h2>
            </a>
            <div class="the-excerpt mb-20">
                <?php the_excerpt(); ?>
            </div>
            <div class="blog-archive-meta mb-20">
                <h5>By <?php the_author() ?> on <?= get_the_date('d/m/Y'); ?> in <?= categories(); ?></h5>
            </div>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary" role="button">Read More</a>
        </div>
    </article>
<?php } ?>