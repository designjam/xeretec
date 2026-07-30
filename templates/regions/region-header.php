

<?php
    $logo = get_field('fld_theme_logo', 'option');
    $logodark = get_field('fld_theme_logo_dark', 'option');
?>

<header class="site-header">
    <div id="skiplink-container">
        <div class="container">
            <a href="#content" class="skiplink">Skip to main content</a>
        </div>
    </div>
    <div class="main-nav">
        <div class="container">
            <div class="row align-items-center">
                <nav class="navbar navbar-expand-md">

                    <a class="navbar-brand" name="Link to the homepage" href="<?= esc_url(home_url('/')); ?>">
                        <span class="visually-hidden"><?php _e('Link to the homepage', 'Rouge'); ?></span>
                        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="logo" />
                    </a>

                    <div class="collapse navbar-collapse justify-content-center" id="primary-navigation">
                        <div class="backdrop"></div>
                        <div class="primary-navigation--outer">
                            <div class="container container--primary-navigation">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location'    => 'primary_navigation',
                                        'depth'             => 4,
                                        'menu_class'        => 'navbar-nav navbar--primary',
                                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'            => new WP_Bootstrap_Navwalker()
                                        )
                                    );
                                ?>
                            </div>
                        </div>

                        <div class="menu-buttons-wrapper">
                            <a href="/contact-us/" class="button-contact">
                              Contact us
                            </a>

                          <div class="site-search site-search--closed">
                            <button class="search-toggle" aria-label="Search the website"></button>
                            <div class="search-form-container">
                              <?php get_search_form();?>
                            </div>
                          </div>
                        </div>
                    </div>

                    <button id="primary-navigation-mobile-toggle" href="#primary-navigation-mobile" aria-label="Open the navigation" aria-controls="primary-navigation-mobile"><span class="primary-navigation-mobile-icon"></span></button>
                    <div class="collapse navbar-collapse justify-content-end" id="primary-navigation-mobile">
                        <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'primary_navigation_mobile',
                                'depth'             => 4,
                                'menu_class'        => 'navbar-nav navbar--primary',
                                'container_id'      => 'menu-location-primary_navigation_mobile'
                                )
                            );
                        ?>
                    </div>

                </nav>
            </div>
        </div>
    </div>
</header>

<script>
(function() {
    // Sticky Header Background - Add background after scrolling 100px
    var headerScrollTrigger = 100;
    var header = document.querySelector('.site-header');
    
    if (header) {
        var updateHeaderBackground = function() {
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > headerScrollTrigger) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        
        // Check on page load
        updateHeaderBackground();
        
        // Check on scroll
        window.addEventListener('scroll', updateHeaderBackground);
    }
})();
</script>

<?php get_template_part('templates/components/mobile-menu'); ?>

