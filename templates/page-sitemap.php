<section class="module-hero module-hero--small" role="region" aria-label="404 page">
	<div class="container">
		<div class="row module-hero__row"> 
			<div class="offset-lg-1 col-lg-11">
				<div class="inner inner-spacing">
					<h1 class="beta beta--extrabold beta--uppercase"><span><?php _e('Sitemap', 'Rouge'); ?></span></h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page-default" id="content" role="region" aria-label="Page content">
	<div class="container">
       	<div class="row">
			<div class="offset-xl-1 col-xl-10">
				<div class="inner inner-spacing">
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
			</div>
		</div>
	</div>
</section>