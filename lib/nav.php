<?php
/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */
/**
 * Class Name: WP_Bootstrap_Navwalker
 * Plugin Name: WP Bootstrap Navwalker
 * Plugin URI:  https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Author: Edward McIntyre - @twittem, WP Bootstrap
 * Version: 2.0.5
 * Author URI: https://github.com/wp-bootstrap
 * GitHub Plugin URI: https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * GitHub Branch: master
 * License: GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 */
/* Check if Class Exists. */
if ( ! class_exists( 'WP_Bootstrap_Navwalker' ) ) {
	/**
	 * WP_Bootstrap_Navwalker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
		/**
		 * Start Level.
		 *
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @access public
		 * @param mixed $output Passed by reference. Used to append additional content.
		 * @param int   $depth (default: 0) Depth of page. Used for padding.
		 * @param array $args (default: array()) Arguments.
		 * @return void
		 */


		private $firstItem = true;

		private $featuredId;

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );

			$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu v2-menu depth-$depth\" >\n";

			// ROUGE MEGAMENU OPEN START
			// Only add mega menu markup if NOT a standard dropdown
			if (in_array("menu-item--level-0", $args->custom_menu_classes) && !isset($args->is_standard_dropdown)) {
				// $output .= '<li class="container close-container"><button class="close" role="button"></button></li>';
				$output .= '<li class="container nav-container"><ul class="row"><li class="nav-megamenu__menu"><ul>';
			}
			// ROUGE MEGAMENU OPEN END

			$this->firstItem = true;
		}

		/**
		 * Start El.
		 *
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @access public
		 * @param mixed $output Passed by reference. Used to append additional content.
		 * @param mixed $item Menu item data object.
		 * @param int   $depth (default: 0) Depth of menu item. Used for padding.
		 * @param array $args (default: array()) Arguments.
		 * @param int   $id (default: 0) Menu item ID.
		 * @return void
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			/**
			 * Dividers, Headers or Disabled
			 * =============================
			 * Determine whether the item is a Divider, Header, Disabled or regular
			 * menu item. To prevent errors we use the strcasecmp() function to so a
			 * comparison that is not case sensitive. The strcasecmp() function returns
			 * a 0 if the strings are equal.
			 */

			// Start off with a column wrapper
			if ($depth > 1 && $this->firstItem) {
				$output .= '<div class="col-wrap">';
			}

			if ( 0 === strcasecmp( $item->attr_title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->attr_title, 'dropdown-header' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} elseif ( 0 === strcasecmp( $item->attr_title, 'disabled' ) ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
				$value       = '';
				$class_names = $value;
				$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[]   = 'menu-item-' . $item->ID;
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
				if ( $args->has_children ) {
					// Check if this is a standard dropdown
					if ($depth === 0 && get_field('menu_standard_dropdown', $item)) {
						$class_names .= ' dropdown dropdown-standard';
						$class_names .= ' menu-item--standard-dropdown';
					} else {
						$class_names .= ' dropdown dropdown-mega';
					}
				}
				if ( in_array( 'current-menu-item', $classes, true ) ) {
					$class_names .= ' active';
				}

				if ($depth===2) {
					if ($this->firstItem) {
						$class_names .= " nav-megamenu__overview";
					} else {
						$class_names .= " nav-megamenu__column";
					}
				}

				// Open a new col-wrap column
				if (get_field('menu_new_column', $item)) {
					$output .= '</div><div class="col-wrap">';
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$id          = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id          = $id ? ' id="' . esc_attr( $id ) . '"' : '';
				$output     .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $value . $class_names . '>';
				$atts        = array();
				if ( empty( $item->attr_title ) ) {
					$atts['title'] = ! empty( $item->title ) ? strip_tags( $item->title ) : '';
				} else {
					$atts['title'] = $item->attr_title;
				}
				$atts['target'] = ! empty( $item->target ) ? $item->target : '';
				$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
				// If item has_children add atts to a.
				// COUNT FROM 0 (TOP LEVEL) 1 (SUB NAVIGATION) 2 (TAXONOMY)
				if ( $args->has_children  && $depth<1 ) {
				//if ( $args->has_children  ) {
					$atts['href']          = '#';
					$atts['data-toggle']   = 'dropdown';
					$atts['aria-haspopup'] = 'true';
					// Use different toggle class for standard dropdowns vs mega menus
					if ($depth === 0 && get_field('menu_standard_dropdown', $item)) {
						$atts['class'] = 'dropdown-toggle';
					} else {
						$atts['class'] = 'mega-dropdown-toggle';
					}
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}



				$atts       = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
				$item_output = $args->before;

				/*
				 * Glyphicons/Font-Awesome
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */
				if ( ! empty( $item->attr_title ) ) {
					$pos = strpos( esc_attr( $item->attr_title ), 'glyphicon' );
					if ( false !== $pos ) {
						$item_output .= '<a' . $attributes . '><span class="glyphicon' . esc_attr( $item->attr_title ) . '" aria-hidden="true"></span>&nbsp;';
					} else {
						$item_output .= '<a' . $attributes . '><i class="fa' . esc_attr( $item->attr_title ) . '" aria-hidden="true"></i>&nbsp;';
					}
				} else {
					$item_output .= '<a' . $attributes . '>';
				}
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
				$item_output .= $args->after;

				$output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

				// Add extra menu text
				if ($depth > 1 && get_field('menu_item_text', $item)) {
					$output .= $indent . '<div class="menu-info">' . get_field('menu_item_text', $item) . '</div>';
				}

				// Set the last parent for use in the featured block
				if ($depth > 1) {
					$this->featuredId = $item->menu_item_parent;
				}
			} // End if().

			$this->firstItem = false;
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			// ROUGE MEGAMENU CLOSE START
			// Only close mega menu markup if NOT a standard dropdown
			if (in_array("menu-item--level-0", $args->custom_menu_classes) && !isset($args->is_standard_dropdown)) {
				$output .= '</ul></li></ul></li>';

				// VARS
				// $email = get_field('fld_theme_email_us', 'options');
				// $store = get_field('fld_theme_store', 'options');

				// $html_email = '<div class="footer__icon"><span>Email Us</span><a href="mailto:' . $email . '" class="social social__email"><span class="screen-reader-text">Email Us</span></a></div>';
				// $html_store = '<div class="footer__icon"><span>Visit Supplies Store</span><a href="' . $store . '" class="social social__store"><span class="screen-reader-text">Visit Supplies Store</span></a></div>';

				// $social = '<li class="container social-container"></li>';
				//
				// $output .= $social;

				// $output .= $html_title . $html_description . $html_url;

			}
			// ROUGE MEGAMENU CLOSE END


			// Add right hand column
			$featured = get_field('featured_menu', $this->featuredId);

			if ($depth == 1 && $featured) {
				$output .= '</div><div class="featured">'; // Also closes the col-wrap div

				// if (!empty($featured['image']['src'])) {
				if (!empty($featured['title'])) {
					$output .= '<div class="image"><img src="' . $featured['image']['url'] . '" alt="' . $featured['image']['alt'] . '" /></div>';
					// $output .= '<div class="image"><img src="' . get_template_directory_uri() . '/assets/images/megamenu.png" alt="Test" /></div>';
				}
				if (!empty($featured['title'])) {
					$output .= '<div class="title">' . $featured['title'] . '</div>';
				}
				if (!empty($featured['text'])) {
					$output .= '<div class="text">' . $featured['text'] . '</div>';
				}
				if (!empty($featured['link'])) {
					$output .= '<div class="link"><a href="' . $featured['link']['url'] . '">' . $featured['link']['title'] . '
						<svg width="13" height="13" style="margin-top:-3px" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.77478 6.198H11.6213M11.6213 6.198L6.19803 0.77475M11.6213 6.198L6.19803 11.6213" stroke="#541388" stroke-width="1.5495" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a></div>';
				}
				$output .= '</div>';
			}


			$output .= "$indent</ul>{$n}";


		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @access public
		 * @param mixed $element Data object.
		 * @param mixed $children_elements List of elements to continue traversing.
		 * @param mixed $max_depth Max depth to traverse.
		 * @param mixed $depth Depth of current element.
		 * @param mixed $args Arguments.
		 * @param mixed $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */

		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }

			if ( ! $element ) {
				return;
			}

			$id_field = $this->db_fields['id'];
			$id       = $element->$id_field;

			//display this element
			$this->has_children = ! empty( $children_elements[ $id ] );
			if ( isset( $args[0] ) && is_array( $args[0] ) ) {
				$args[0]['has_children'] = $this->has_children; // Back-compat.
			}

			$cb_args = array_merge( array(&$output, $element, $depth), $args);

			// ROUGE CLASSES START
			$element->classes[] = 'menu-item--level-' . $depth;
			if ($element->menu_item_parent !== '0') {
				$element->classes[] = 'menu-item--parent-' . $element->menu_item_parent;
			}
			//var_dump($element);
			// ROUGE CLASSES END

			// Check if this element should be a standard dropdown
			$is_standard_dropdown = false;
			if ($depth === 0 && $this->has_children) {
				$is_standard_dropdown = get_field('menu_standard_dropdown', $element);
			}

			$cb_args['custom_menu_classes'] = $element->classes;
			if ($is_standard_dropdown) {
				$cb_args['is_standard_dropdown'] = true;
			}
			call_user_func_array(array($this, 'start_el'), array_values($cb_args));

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

				foreach ( $children_elements[ $id ] as $child ){

					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						$cb_args[2]->custom_menu_classes = $element->classes;
						if ($is_standard_dropdown) {
							$cb_args[2]->is_standard_dropdown = true;
						}
						// echo "test2";

						call_user_func_array(array($this, 'start_lvl'), array_values($cb_args));
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				}
				unset( $children_elements[ $id ] );
			}

			if ( isset($newlevel) && $newlevel ){
				//end the child delimiter
				$cb_args = array_merge( array(&$output, $depth), $args);
				$cb_args[2]->custom_menu_classes = $element->classes;
				if ($is_standard_dropdown) {
					$cb_args[2]->is_standard_dropdown = true;
				}
				// echo "test3";
				call_user_func_array(array($this, 'end_lvl'), array_values($cb_args));
			}

			//end this element
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			$cb_args['custom_menu_classes'] = $element->classes;
			// echo "test4";
			call_user_func_array(array($this, 'end_el'), array_values($cb_args));
		}
		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a menu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				/* Get Arguments. */
				$container       = $args['container'];
				$container_id    = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class      = $args['menu_class'];
				$menu_id         = $args['menu_id'];
				if ( $container ) {
					echo '<' . esc_attr( $container );
					if ( $container_id ) {
						echo ' id="' . esc_attr( $container_id ) . '"';
					}
					if ( $container_class ) {
						echo ' class="' . esc_attr( $container_class ) . '"'; }
					echo '>';
				}
				echo '<ul';
				if ( $menu_id ) {
					echo ' id="' . esc_attr( $menu_id ) . '"'; }
				if ( $menu_class ) {
					echo ' class="' . esc_attr( $menu_class ) . '"'; }
				echo '>';
				echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_attr( 'Add a menu', '' ) . '</a></li>';
				echo '</ul>';
				if ( $container ) {
					echo '</' . esc_attr( $container ) . '>'; }
			}
		}
	}
} // End if().

add_action('wp_head', function() {
	?>
<script>
document.addEventListener("DOMContentLoaded", function() {
	// Only apply to mega menus (.dropdown-mega)
	jQuery('.menu-item.dropdown-mega .dropdown-menu.v2-menu a').on('mouseover', function() {
		menuHeight();
	});

	// Only apply click handler to mega menu toggles (.dropdown-mega)
	jQuery('a.mega-dropdown-toggle').on('click', function() {
		// Check if parent is a standard dropdown - if so, let Bootstrap handle it
		if (jQuery(this).closest('.dropdown-standard').length > 0) {
			return;
		}
		checkDropDown(this);
	});
});

// Listen for window resizing - only for mega menus
window.addEventListener('resize', function() {
	// Only run for mega menus
	if (jQuery('.menu-item.dropdown-mega .dropdown-menu.v2-menu.depth-0.show').length > 0) {
		menuHeight();
		checkDropDown();
	}
}, true);


// Update the menu height on hover - only for mega menus
function menuHeight() {
	setTimeout(function() {
		// Only target mega menus (.dropdown-mega)
		let megaMenuDepth1 = jQuery('.menu-item.dropdown-mega .dropdown-menu.v2-menu.depth-1.show');
		if (megaMenuDepth1.length === 0) {
			return;
		}
		
		// Get height of depth-1 menu
		let depth1Height = megaMenuDepth1.height() + 54;
		
		// Get height of nav-megamenu__menu
		let megaMenuMenu = jQuery('.menu-item.dropdown-mega .nav-megamenu__menu');
		let megaMenuMenuHeight = megaMenuMenu.length > 0 ? megaMenuMenu.height() + 54 : 0;
		
		// Use whichever is bigger
		let height = Math.max(depth1Height, megaMenuMenuHeight);
		console.log('depth1Height:', depth1Height, 'megaMenuMenuHeight:', megaMenuMenuHeight, 'final height:', height);
		jQuery('.menu-item.dropdown-mega .dropdown-menu.v2-menu.depth-0').css('height', height + 'px');
		jQuery('.menu-item.dropdown-mega .dropdown-menu.v2-menu.depth-0 .container.nav-container').css('min-height', height + 'px');
	}, 10);
}

// Do normal dropdowns for non-mega-menu items - only for mega menus
function checkDropDown(self = window.menuDropdownEl) {
	// Return early if self is undefined or null
	if (!self) {
		return;
	}
	
	// Check if this is a standard dropdown - if so, skip
	if (jQuery(self).closest('.dropdown-standard').length > 0) {
		return;
	}
	
	window.menuDropdownEl = self; // Set a global var with this to use on resizing the window

	let dropdown = jQuery(self).siblings('ul.dropdown-menu.v2-menu.depth-0');
	let subMenus = dropdown.find('.dropdown-menu.v2-menu.depth-1').length;

	if (subMenus === 0) {
		dropdown.css({
			width: 'auto',
			padding: '9rem 0 4rem',
		 	marginLeft: self.offsetLeft - 50 + 'px'
		});
	}

	// Set first tab
	if (dropdown.find('.dropdown-menu.v2-menu.depth-1.show').length === 0) {
		dropdown.find('.nav-megamenu__menu ul li a').first().addClass('show');
		dropdown.find('.dropdown-menu.v2-menu.depth-1').first().addClass('show');
	}

	// Reset menu height as well
	menuHeight();
}

// Add site-header--open when any dropdown opens
jQuery(document).on('show.bs.dropdown', '.dropdown-mega, .dropdown-standard', function() {
	jQuery('html').addClass("site-header--open");
});

// Remove site-header--open when dropdown closes - check both mega menus and standard dropdowns
jQuery(document).on('hidden.bs.dropdown', '.dropdown-mega, .dropdown-standard', function() {
	// Check if any mega menu or standard dropdown is still open
	var hasOpenMegaMenu = jQuery('.dropdown-mega .dropdown-menu.v2-menu.depth-0.show').length > 0;
	var hasOpenStandardDropdown = jQuery('.dropdown-standard .dropdown-menu.v2-menu.depth-0.show').length > 0;
	
	if (!hasOpenMegaMenu && !hasOpenStandardDropdown) {
		jQuery('html').removeClass("site-header--open");
	}
});
</script>

<style>
/* ============================================
   GENERAL / SHARED STYLES
   ============================================ */
html.site-header--open {
	padding-right: 0 !important;
}

.menu-item-children-toggle span {
	display: none !important;
}

#primary-navigation-mobile-toggle {
	height: 30px;
}

html.site-header--open .main-nav .navbar #primary-navigation .navbar--primary .menu-item.menu-item--level-0.show > a::after,
html.site-header .main-nav .navbar #primary-navigation .navbar--primary .menu-item.menu-item--level-0 > a::after {
	background: #541388;
	opacity: 1;
}

.main-nav .navbar #primary-navigation {
	position: relative;
	margin-left: -180px;
}

.menu-buttons-wrapper {
	position: absolute;
  align-items: center;
	right: 0;
	display: flex;
  gap: 16px;
}

.contact-button a {
	display: flex;
	flex-direction: row;
	width: max-content;
	align-items: center;
	gap: 4px;
	color: #191D32;
	text-decoration: none;
	font-size: 13px;
	font-weight: 700;
	background: #fff;
	padding: 12px 24px;
	border-radius: 25px;
}

.site-header .menu-buttons-wrapper .site-search .search-toggle {
	background-position-y: 50%;
}

.col.social-icons {
	display: none;
}

/* ============================================
   MEGA MENU STYLES (.dropdown-mega)
   ============================================ */
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu {
	width: 100%;
	border-radius: 20px;
	border: 0;
	margin: 0;
	padding: 9rem 0 18rem 0;
	z-index: -1;
	max-height: 95vh;
	top: unset;
	height: auto;
	margin-top: -4px;

}
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega  .dropdown-menu.v2-menu {
  box-shadow: 0px 5px 12px 0px rgba(0,0,0,0.3);
  -webkit-box-shadow: 0px 5px 12px 0px rgba(0,0,0,0.3);
  -moz-box-shadow: 0px 5px 12px 0px rgba(0,0,0,0.3);
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu ul {
  box-shadow: none;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu.depth-0 {
	max-width: 100%;
	background: linear-gradient(360deg, #FBF7FF 0%, #FFFFFF 100%);
  margin-top:10px;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-1 > a,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-2 > a,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-3 > a {
	color: #000;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-2 {
	flex-direction: column;
	align-items: flex-start;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .nav-container {
	padding: 0 50px;
	margin: 0;
	margin-top: -55px;
	max-width: 100%;
	height: auto;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu .dropdown-menu.v2-menu {
	left: 290px;
	border-radius: 40px;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu.depth-1.show {
	margin-top: 25px;
	width: calc(100% - 315px);
	display: flex;
  flex-flow: row;
  height: auto;
	gap: 25px;
	z-index: 1;
	border-radius: 0;
	top: -15px;
	padding: 0;
	background: none;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-2 > a {
	font-size: 16px;
	color: #541388;
	font-weight: 700;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-1 > a.show {
	background: #EFF0F6;
	color: #541388;
	border-radius: 4px;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-1 > a {
	font-size: 20px;
	color: #541388;
	font-weight: 700;
	padding: 14px;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-1 {
	margin-bottom: 7px;
	padding-bottom: 0;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-1,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-2,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .menu-item--level-3 {
	border: none;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu .dropdown-menu.v2-menu .menu-item {
	width: auto;
	margin-bottom: 8px;
  padding-bottom: 0;
}

.dropdown-menu.v2-menu .col-wrap {
	display: flex;
	flex-flow: column;
	flex-grow: 1;
	flex-basis: 0;
}

.nav-megamenu__menu > ul {
	max-width: 240px;
}

/* Mega Menu Featured Block */
.featured {
	position: relative;
	right: 15px;
	top: 0;
	max-width: 280px;
	margin-left: auto;
	padding-bottom: 35px;
}

.featured .image img {
	max-width: 100%;
	border-radius: 20px;
	padding-bottom: 8px;
}

.menu-info p,
.featured .text p {
	color: #575757;
	font-size: 14px;
	font-weight: 400;
	margin-bottom: 18px;
}

.menu-info a,
.featured .text a {
	color: #541388;
	text-decoration: none;
}

.menu-info a:hover {
  text-decoration: underline;
}

.featured .text {
	margin-bottom: 24px;
}

.featured .title p {
	font-size: 16px;
	color: #541388;
	font-weight: 700;
}

.featured .link a {
	color: #541388;
	font-size: 15px;
	font-weight: 600;
	text-decoration: none;
	display: flex;
  flex-direction: row;
  align-items: center;
  gap: 4px;
}

@media (max-width: 1240px), (max-height: 550px) {
	.featured {
		display: none;
	}

	.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-mega .dropdown-menu.v2-menu .container.nav-container {
		overflow-y: hidden;
	}
}

/* ============================================
   STANDARD DROPDOWN STYLES (.dropdown-standard)
   ============================================ */
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard {
  position: relative;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard .dropdown-menu.v2-menu.depth-0 {
	width: auto;
	min-width: 200px;
  height: auto !important;
	padding: 1rem 0;
	background: #fff;
	border-radius: 8px;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	margin-top: -4px;
	position: absolute;
	top: 100%;
	left: 50%;
	transform: translateX(-50%);
  display: none;
  flex-direction: column !important;
	list-style: none;
	margin-left: 0;
}

/* Show dropdown when Bootstrap adds .show class (click toggle) */
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard.show > .dropdown-menu.v2-menu.depth-0,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard .dropdown-menu.v2-menu.depth-0.show {
  display: flex !important;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard .dropdown-menu.v2-menu.depth-0 > li {
	position: relative !important;
	display: block !important;
	width: 100% !important;
	float: none !important;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard .dropdown-menu.v2-menu.depth-0 .menu-item--level-1 {
	margin-bottom: 0;
	padding-bottom: 0;
	position: relative !important;
	display: block !important;
	width: 100% !important;
	float: none !important;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard .dropdown-menu.v2-menu.depth-0 .menu-item--level-1 > a {
	font-size: 14px;
	color: #000;
	font-weight: 600;
	padding: 10px 20px;
	display: block;
	border-radius: 0;
	width: 100%;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item.dropdown-standard .dropdown-menu.v2-menu.depth-0 .menu-item--level-1 > a:hover {
  background: #EFF0F6;
  color: #541388;
}

/*
.site-header .site-search .search-toggle {
	width: 100%;
	font-size: 13px;
	color: #191D32;
	font-weight: 700;
	padding: 12px 24px;
	background: #fff;
	border-radius: 25px;
	margin-top: -2px;
}

.site-header .site-search .search-toggle span {
	width: 100px;
	text-align: left;
}

.site-header .site-search .search-toggle img {
	filter: invert();
	margin-left: 6px;
}

@media (max-width: 1100px) {
	.menu-buttons-wrapper {
		display: none;
	}
} */
</style>

<?php
}, 999); // End wp_footer

?>
