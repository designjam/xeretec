<?php
    $logo = get_field('fld_theme_logo', 'option');
?>

<footer class="footer" id="footer-new">
    <div class="container">
        <!-- Top Section: Newsletter Signup + Logo -->
        <div class="footer__row footer__row--top">
            <div class="footer__newsletter">
                <h3 class="footer__newsletter-title">Sign up for our newsletter</h3>
                <!-- <form class="footer__newsletter-form" method="post" action="">
                    <div class="footer__newsletter-input-group">
                        <input type="email" name="newsletter_email" id="newsletter_email" class="footer__newsletter-input" placeholder="Enter your email" required>
                        <button type="submit" class="footer__newsletter-button">
                            Sign up →
                        </button>
                    </div>
                    <p class="footer__newsletter-disclaimer">
                        By clicking Sign Up you're confirming that you agree with our <strong>Terms and Conditions</strong>.
                    </p>
                </form> -->
                <!--script src="https://js-eu1.hsforms.net/forms/embed/139694148.js" defer></script-->
                <!--div class="hs-form-frame" data-region="eu1" data-form-id="e663fb1d-78d7-4382-a2dc-c84fef13096b" data-portal-id="139694148"></div-->
                
<div class="hs-form-wrap hs-form-wrap--newsletter">
<script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/embed/v2.js"></script>
<script>
  hbspt.forms.create({
    portalId: "139694148",
    formId: "8927a1a9-0fba-4465-8201-7ad2e247c54b",
    region: "eu1"
  });
</script>
</div>
				
				<p class="footer__newsletter-disclaimer">
                        By clicking Sign Up you're confirming that you agree with our <a href="/terms/"><strong>Terms and Conditions</strong></a>.
                    </p>
            </div>
            <div class="footer__brand-wrapper">
                <a class="footer__brand" aria-label="Footer link to the homepage" href="<?= esc_url(home_url('/')); ?>">
                    <span class="visually-hidden"><?php _e('Link to the homepage', 'Rouge'); ?></span>
                    <?php if ( $logo ) : ?>
                        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="logo" />
                    <?php else: ?>
                        <img src="<?php bloginfo('template_url'); ?>/assets/images/180x48.png" alt="Placeholder logo" class="logo" />
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="footer__divider"></div>
        <?php if ( has_nav_menu( 'footer_navigation' ) ) : ?>
            <!-- Middle Section: Navigation Columns -->
            <div class="footer__row footer__row--nav">

                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'footer_navigation',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'footer__nav',
                                'menu_class'        => 'footer__nav-list',
                            )
                        );
                    ?>
            </div>

            <!-- Divider -->
            <div class="footer__divider"></div>
        <?php endif; ?>

        <!-- Bottom Section: Legal Links + Social Icons -->
        <div class="footer__row footer__row--bottom">
            <div class="copyright-legal-wrapper">
                <div class="pb-4 footer__legal copyright-legal-wrapper">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'legal_navigation',
                                'depth'             => 1,
                                'container'         => 'div',
                                'container_class'   => 'navbar-nav navbar--secondary',
                            )
                        );
                    ?>
                </div>
                <p class="footer__copyright">Copyright &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo( 'name' ); ?>, All rights reserved.</p>
            </div>
            <div class="pb-4 footer__social">
                <?php if( have_rows('rpt_theme_social_account', 'options') ): ?>
                    <div class="footer__social-icons">
                        <?php while( have_rows('rpt_theme_social_account', 'options') ): the_row(); 
                            $social_account = get_sub_field('fld_theme_social_account');
                            $social_link = get_sub_field('fld_theme_social_link');
                        ?>
                            <a href="<?php echo esc_url($social_link); ?>" target="_blank" name="Follow us on <?php echo esc_attr($social_account); ?>" class="footer__social-icon footer__social-icon--<?php echo esc_attr($social_account); ?>">
                                <span class="visually-hidden"><?php echo esc_html(ucfirst($social_account)); ?></span>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
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
  <button class="close mobile-close" role="button" aria-label="Close Menu"></button>                     
</footer>

<?php wp_footer(); ?>

<div class="scroll">
    <a href="#" class="scroll__top show" title="Scroll up"></a>
</div>

</body>
</html>