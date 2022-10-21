<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SBX_Starter_Theme
 */

?>

<footer id="colophon" class="footer">
    <!-- Add footer content here -->

    <!-- footer-top -->
    <div class="footer__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Footer logo -->
                    <div class="footer__logo mb-1">
                        <a href="<?php echo home_url(); ?>">

                            <?php $footer_logo = get_theme_mod('my_custom_footer_logo'); ?>

                            <?php if ($footer_logo) :  ?>

                                <div class="brand-image">
                                    <img src="<?= esc_url($footer_logo); ?>" alt=""/>
                                </div>

                            <?php else : ?>
                                <span><?= get_bloginfo('name'); ?></span>
                            <?php endif; ?>

                        </a>

                    </div>

                    <div class="coy-brief"><?= get_field('company_brief', 'options'); ?></div>

                    <div class="copyright"> <span class="copyright-text">Copyright &#169; <?= get_field('company_name_abbr', 'options') ?: get_field('company_name_full', 'options'); ?> <?= date('Y'); ?>. All rights reserved.</span></div>
                </div>

                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="row">
                        <div class="col-lg-10 col-md-12">
                            <h4 class="footer__h4">Quicklinks</h4>
                            <!-- footer-shop -->
                            <?php
                            wp_nav_menu(array(
                                'menu'              => 'footer-menu-1',
                                'menu_class'        => 'footer__menu'
                            ));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-1">

                    <h4 class="footer__h4">Contact Us</h4>

                    <!-- address -->
                    <div class="footer__contact">

                        <div class="footer__contact-list">
                            <p class="footer-address">
                                <?= get_field('address_line_1', 'option', false) ?> <br>
                                <?= get_field('address_line_2', 'option', false) ?> <br>
                            </p>
                        </div>

                    </div>

                    <!-- email -->
                    <?php if (have_rows('emails', 'option')) : ?>
                        <div class="footer__contact">

                            <div class="footer__contact-list">
                                <?php while (have_rows('emails', 'option')) : the_row(); ?>

                                    <a href="mailto:<?= get_sub_field('email', 'option'); ?>" class="d-block">
                                        <?= get_sub_field('email', 'option'); ?>
                                    </a>

                                <?php endwhile; ?>
                            </div>

                        </div>
                    <?php endif; ?>

                    <!-- phone -->
                    <?php if (have_rows('phones', 'option')) : ?>
                        <div class="footer__contact">

                            <div class="footer__contact-list">
                                <?php while (have_rows('phones', 'option')) : the_row(); ?>

                                    <a href="tel:<?= get_sub_field('phone', 'option'); ?>" class="d-block">
                                        <?= get_sub_field('phone', 'option'); ?>
                                    </a>

                                <?php endwhile; ?>
                            </div>

                        </div>
                    <?php endif; ?>

                    <div class="socials">
                        <?php get_template_part('template-parts/social', 'links'); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- end footer-top -->

    <!-- footer-bottom -->
    <div class="footer__bottom">
        <div class="container ">

            <div class="footer__summary">
                <!-- Copyright text -->
                <span class="copyright-text">Copyright &#169; <?= get_field('company_name_abbr', 'options') ?: get_field('company_name_full', 'options'); ?> <?= date('Y'); ?>. All rights reserved.</span>

                <!-- marketing -->
                <div class="marketing">
                    <span>Powered by <a target="_blank" href="mailto:etiboaghogho@gmail.com" class="btn-pseudo">Imperial Heights Digital</a></span>
                </div>

            </div>

        </div>
    </div>
    <!-- end footer-bottom -->

</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>