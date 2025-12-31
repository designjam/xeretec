

<?php
    $logo = get_field('fld_theme_logo', 'option');
    $logodark = get_field('fld_theme_logo_dark', 'option');
?>

<header class="site-header<?php if (is_404() || is_search() || is_page_template('template-default-tv.php') || is_page_template('template-career.php') || is_page_template('sitemap.php')): echo " site-header--dark"; endif; ?>">
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
                        <?php if (is_404() || is_search() || is_page_template('template-default-tv.php') || is_page_template('template-career.php') || is_page_template('sitemap.php')):?>
                            <img src="<?php echo $logodark['url']; ?>" alt="<?php echo $logodark['alt']; ?>" class="logo" />
                        <?php else: ?>
                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="logo" />
                        <?php endif; ?>
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
                    </div>

                    <div class="site-search site-search--closed">
                        <button class="search-toggle" aria-label="Search the website"></button>
                        <div class="search-form-container">
                            <?php get_search_form();?>
                        </div>
                    </div>

                    <button id="primary-navigation-mobile-toggle" href="#primary-navigation-mobile" aria-label="Open the navigation" aria-controls="primary-navigation-mobile"><span class="primary-navigation-mobile-icon"></span></button>
                    <div class="collapse navbar-collapse justify-content-end" id="primary-navigation-mobile">
                        <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'primary_navigation',
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
