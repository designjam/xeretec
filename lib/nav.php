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
			if (in_array("menu-item--level-0", $args->custom_menu_classes)) {
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
					$class_names .= ' dropdown';
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
					$atts['class']         = 'mega-dropdown-toggle';
					$atts['aria-haspopup'] = 'true';
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
			if (in_array("menu-item--level-0", $args->custom_menu_classes)) {
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
				$output .= '<div class="featured">';

				if (!empty($featured['image']['src'])) {
					$output .= '<div class="image"><img src="' . $featured['image']['src'] . '" alt="' . $featured['image']['alt'] . '" /></div>';
					// $output .= '<div class="image"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Test.svg/960px-Test.svg.png?20251228222034" alt="' . $featured['image']['alt'] . '" /></div>';
				}
				if (!empty($featured['title'])) {
					$output .= '<div class="title">' . $featured['title'] . '</div>';
				}
				if (!empty($featured['text'])) {
					$output .= '<div class="text">' . $featured['text'] . '</div>';
				}
				if (!empty($featured['link'])) {
					$output .= '<div class="link"><a href="' . $featured['link']['url'] . '">' . $featured['link']['title'] . '
						<svg width="13" height="13" style="margin-top:-5px" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
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


			$cb_args['custom_menu_classes'] = $element->classes;
			call_user_func_array(array($this, 'start_el'), array_values($cb_args));

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

				foreach ( $children_elements[ $id ] as $child ){

					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						$cb_args[2]->custom_menu_classes = $element->classes;
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

?>

<style>
html.site-header--open {
	padding-right: 0 !important;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu {
	width: 100%;
	background-color: #FBF7FF;
	border-radius: 20px;
	border: 0;
	margin: 0;
	padding: 9rem 0 18rem 0;
	z-index: -1;
	max-width: 90vw;
	margin-left: 5vw;
	max-height: 85vh;
	top: unset;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-1 > a,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-2 > a,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-3 > a {
	color: #000;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-2 {
	flex-direction: column;
	align-items: flex-start;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .nav-container {
	padding: 0 50px;
	margin: 0;
	margin-top: -85px;
	max-width: 100%;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu .dropdown-menu.v2-menu {
	left: 300px;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu.depth-1.show {
	margin-top: 35px;
	width: calc(100% - 423px);
	display: flex;
  flex-flow: column wrap;
  height: 84vh;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .nav-container {
	height: calc(85vh - 50px);
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-2 > a,
.featured .title p {
	font-size: 16px;
	color: #541388;
	font-weight: 700;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-1 > a.show {
	background: #EFF0F6;
	color: #541388;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-1 > a {
	font-size: 20px;
	color: #541388;
	font-weight: 700;
	padding: 14px;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-1 {
	margin-bottom: 7px;
	padding-bottom: 0;
}

.menu-item-children-toggle span {
	display: none !important;
}

.featured {
	position: absolute;
	right: 0;
	top: 0;
	max-width: 320px;
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
}

.featured .link a {
	color: #541388;
	font-size: 15px;
	font-weight: 600;
	text-decoration: none;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-1,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-2,
.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu.v2-menu .menu-item--level-3 {
	border: none;
}

.main-nav .navbar #primary-navigation .navbar--primary .menu-item .dropdown-menu .dropdown-menu.v2-menu .menu-item {
	width: auto;
}
</style>
