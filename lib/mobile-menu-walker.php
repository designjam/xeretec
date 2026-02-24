<?php
/**
 * Mobile Menu Walker
 * 
 * Custom walker for mobile menu with collapsible items
 * Handles Level 3 ACF WYSIWYG field (mobile_link_items)
 */

if ( ! class_exists( 'Mobile_Menu_Walker' ) ) {
    class Mobile_Menu_Walker extends Walker_Nav_Menu {
        
        private $firstItem = true;
        
        public function start_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "\n$indent<ul class=\"mobile-menu__submenu mobile-menu__submenu--level-" . ($depth + 1) . "\">\n";
            $this->firstItem = true;
        }
        
        public function end_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "$indent</ul>\n";
        }
        
        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'mobile-menu__item mobile-menu__item--level-' . $depth;
            $classes[] = 'menu-item-' . $item->ID;
            
            // Check if item has ACF content (Level 1, Level 2, or Level 3)
            $has_acf_content = false;
            $mobile_link_items = '';
            if ( $depth === 1 || $depth === 2 ) {
                $mobile_link_items = get_field( 'mobile_link_items', $item );
                $has_acf_content = ! empty( $mobile_link_items );
            }
            
            // Mark as having children if it has actual children OR ACF content
            if ( $args->has_children || $has_acf_content ) {
                $classes[] = 'mobile-menu__item--has-children';
            }
            
            if ( in_array( 'current-menu-item', $classes, true ) ) {
                $classes[] = 'mobile-menu__item--active';
            }
            
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
            
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
            
            $output .= $indent . '<li' . $id . $class_names . '>';
            
            $item_output = $args->before;
            
            // For all levels (0, 1, 2), show the link
            $atts = array();
            $atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target ) ? $item->target : '';
            $atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
            
            // If item has children OR ACF content, make it a toggle button
            // Level 0, 1, and 2 can all have children or ACF content
            $should_toggle = ( $args->has_children || $has_acf_content ) && $depth < 3;
            
            if ( $should_toggle ) {
                $atts['href'] = '#';
                $atts['class'] = 'mobile-menu__link mobile-menu__link--toggle';
                $atts['aria-expanded'] = 'false';
            } else {
                $atts['href'] = ! empty( $item->url ) ? $item->url : '#';
                $atts['class'] = 'mobile-menu__link';
            }
            
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            
            // Add chevron icon for items with children OR ACF content (all levels)
            if ( $should_toggle ) {
                $item_output .= '<span class="mobile-menu__chevron">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>';
            }
            
            $item_output .= '</a>';
            
            // Add ACF WYSIWYG content (mobile_link_items) if populated - wrap in collapsible container
            // Level 1 (depth === 1) and Level 2 (depth === 2) can have ACF content
            if ( $has_acf_content && ( $depth === 1 || $depth === 2 ) ) {
                $item_output .= '<div class="mobile-menu__acf-wrapper mobile-menu__submenu">';
                $acf_class = $depth === 1 ? 'mobile-menu__acf-content--level-1' : 'mobile-menu__acf-content--level-2';
                $item_output .= '<div class="mobile-menu__acf-content ' . $acf_class . '">' . $mobile_link_items . '</div>';
                $item_output .= '</div>';
            }
            
            $item_output .= $args->after;
            
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            
            $this->firstItem = false;
        }
        
        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            $output .= "</li>\n";
        }
        
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element ) {
                return;
            }
            
            $id_field = $this->db_fields['id'];
            $id = $element->$id_field;
            
            // Display this element
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[ $id ] );
            }
            
            $this->has_children = ! empty( $children_elements[ $id ] );
            if ( isset( $args[0] ) && is_array( $args[0] ) ) {
                $args[0]['has_children'] = $this->has_children;
            }
            
            $cb_args = array_merge( array( &$output, $element, $depth ), $args );
            call_user_func_array( array( $this, 'start_el' ), $cb_args );
            
            // Descend only when the depth is right and there are children
            if ( ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[ $id ] ) ) {
                foreach ( $children_elements[ $id ] as $child ) {
                    if ( ! isset( $newlevel ) ) {
                        $newlevel = true;
                        $cb_args = array_merge( array( &$output, $depth ), $args );
                        call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
                    }
                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
                }
                unset( $children_elements[ $id ] );
            }
            
            if ( isset( $newlevel ) && $newlevel ) {
                $cb_args = array_merge( array( &$output, $depth ), $args );
                call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
            }
            
            $cb_args = array_merge( array( &$output, $element, $depth ), $args );
            call_user_func_array( array( $this, 'end_el' ), $cb_args );
        }
    }
}
