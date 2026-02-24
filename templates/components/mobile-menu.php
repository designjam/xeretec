<?php
/**
 * Mobile Menu Component
 * 
 * Standalone mobile menu that replaces mmenu.js
 * Only displays below 1101px breakpoint
 */

$logo = get_field('fld_theme_logo', 'option');
$logodark = get_field('fld_theme_logo_dark', 'option');
?>

<!-- Mobile Header Bar (always visible when menu is closed) -->
<div class="mobile-header-bar">
    <a class="mobile-header-bar__logo" href="<?= esc_url(home_url('/')); ?>" aria-label="Link to the homepage">
        <?php if (is_404() || is_search() || is_page_template('template-default-tv.php') || is_page_template('template-career.php') || is_page_template('sitemap.php')):?>
            <img src="<?php echo $logodark['url']; ?>" alt="<?php echo $logodark['alt']; ?>" class="mobile-header-bar__logo-img" />
        <?php else: ?>
            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="mobile-header-bar__logo-img" />
        <?php endif; ?>
    </a>
    
    <div class="mobile-header-bar__actions">
        <button class="mobile-header-bar__search-toggle" aria-label="Search the website">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-label="Open the navigation" aria-controls="mobile-menu">
            <span class="mobile-menu-toggle__icon"></span>
        </button>
    </div>
</div>

<!-- Mobile Search (initially hidden, appears when search icon clicked) -->
<div class="mobile-header-search mobile-header-search--closed">
    <div class="mobile-header-search__container">
        <?php get_search_form(); ?>
    </div>
</div>

<div id="mobile-menu" class="mobile-menu">
    <!-- Mobile Menu Header Bar -->
    <div class="mobile-menu__header">
        <a class="mobile-menu__logo" href="<?= esc_url(home_url('/')); ?>" aria-label="Link to the homepage">
            <?php if (is_404() || is_search() || is_page_template('template-default-tv.php') || is_page_template('template-career.php') || is_page_template('sitemap.php')):?>
                <img src="<?php echo $logodark['url']; ?>" alt="<?php echo $logodark['alt']; ?>" class="mobile-menu__logo-img" />
            <?php else: ?>
                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="mobile-menu__logo-img" />
            <?php endif; ?>
        </a>
        
        <div class="mobile-menu__header-actions">
            <button class="mobile-menu__search-toggle" aria-label="Search the website">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="mobile-menu__close" aria-label="Close the navigation">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Content -->
    <div class="mobile-menu__content">
        <!-- Search Form (initially hidden) -->
        <div class="mobile-menu__search mobile-menu__search--closed">
            <div class="mobile-menu__search-container">
                <?php get_search_form(); ?>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="mobile-menu__nav" role="navigation" aria-label="Mobile Navigation">
            <?php
            wp_nav_menu( array(
                'theme_location'    => 'primary_navigation_mobile',
                'depth'             => 3,
                'menu_class'        => 'mobile-menu__list',
                'container'         => false,
                'walker'            => new Mobile_Menu_Walker()
            ));
            ?>
        </nav>
    </div>
</div>
