<?php
    $logo = get_field('fld_theme_logo', 'option');
?>

<footer class="footer">
    <div class="container">
        <div class="row footer__row">

            <div class="col col-lg-10">
                <div class="row">
                    <div class="col-lg-3">
                        <a class="footer__brand" aria-label="Footer link to the homepage" href="<?= esc_url(home_url('/')); ?>">
                            <span class="visually-hidden"><?php _e('Link to the homepage', 'Rouge'); ?></span>
                            <?php if ( $logo ) : ?>
                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="logo" />
                            <?php else: ?>
                                <img src="<?php bloginfo('template_url'); ?>/assets/images/180x48.png" alt="Placeholder logo" class="logo" />
                            <?php endif; ?>
                        </a>
                    </div>

                    <div class="col social-icons">
                        <?php if ( get_field('fld_theme_email_us', 'options') ) : ?>
                            <div class="social-icons__icon">
                                <span><?php _e('Email Us', 'Rouge'); ?></span>
                                <a href="mailto:<?php echo get_field('fld_theme_email_us', 'options'); ?>" name="Email us" class="social social__email"><?php _e('Email us', 'Rouge'); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if ( get_field('fld_theme_store', 'options') ) : ?>
                            <div class="social-icons__icon">
                                <span><?php _e('Supplies Store', 'Rouge'); ?></span>
                                <a href="<?php echo get_field('fld_theme_store', 'options'); ?>" name="Visit our supplies store" class="social social__store" target="_blank"><?php _e('Visit our supplies store', 'Rouge'); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if( have_rows('rpt_theme_social_account', 'options') ): ?>
                            <div class="social-icons__icon">
                                <span><?php _e('Follow Us', 'Rouge'); ?></span>
                                <div>
                                    <?php while( have_rows('rpt_theme_social_account', 'options') ): the_row(); ?>
                                        <a href="<?php echo get_sub_field('fld_theme_social_link'); ?>" target="_blank" name="Follow us on <?php echo get_sub_field('fld_theme_social_account'); ?>" class="social social__<?php echo get_sub_field('fld_theme_social_account'); ?>">
                                            <?php echo get_sub_field('fld_theme_social_account'); ?>
                                        </a>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col col-lg-2">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location'    => 'footer_navigation',
                            'depth'             => 1,
                            'container'         => 'div',
                            'container_class'   => 'navbar-nav navbar--primary',
                        )
                    );
                ?>
            </div>

        </div>

        <div class="row footer__row">
            <div class="col footer__legal">
                <?php 
                    $year = date('Y');
                    $sitename = get_bloginfo( 'name' );

                    wp_nav_menu(
                        array(
                            'items_wrap'        => '<ul id="%1$s" class="%2$s"><li class="menu-item">Copyright &copy; ' . $year . ' ' . $sitename . '</li>%3$s</ul>',
                            'theme_location'    => 'legal_navigation',
                            'depth'             => 1,
                            'container'         => 'div',
                            'container_class'   => 'navbar-nav navbar--secondary',
                        )
                    );
                ?>
            </div>
            <div class="col-lg-2">
                <a href="https://www.rouge-media.com/" target="_blank" class="footer__rouge" rel="nofollow">Website by Rouge</a>
            </div>
        </div>

    </div>

    <?php if (is_front_page() && get_field('fld_hero_video_embed')):?>
        <!-- MODAL BUTTON - THIS CAN BE FOUND IN BLOCCK-HERO-VIDEO -->
        <div class="video video--modal">
            <div class="video__modal" data-video-modal-id="homepage">
                <!-- <div class="video__content"> -->
                    <div class="video__outer">
                        <div class="video__inner">
                            <!-- HARD CODED YOUTUBE VIDEO START -->
                            <?php echo get_field('fld_hero_video_embed'); ?>
                            <!-- HARD CODED YOUTUBE VIDEO END -->

                            <!-- HARD CODED VIMEO VIDEO START -->
                            <!-- <video controls id="homevideo">
                                <source src="https://player.vimeo.com/external/563635222.hd.mp4?s=b8cd7bc1e53e98edb52310c8f9173e109c6ba759&profile_id=175" type="video/mp4">
                            </video> -->
                            <!-- HARD CODED VIMEO VIDEO END -->
                        </div>
                    </div>
                <!-- </div> -->
                <button class="close-modal" name="Close the modal">
                    <span aria-hidden="true" role="presentation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg>
                    </span>
                    <div class="visually-hidden">Close button</div>
                </button>
            </div>
        </div>
    <?php endif; ?>

</footer>

<?php wp_footer(); ?>

<div class="scroll">
    <a href="#" class="scroll__top show" title="Scroll up"></a>
</div>

</body>
</html>