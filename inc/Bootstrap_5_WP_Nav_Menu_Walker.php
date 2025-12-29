<?php 
class Bootstrap_5_WP_Nav_Menu_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu dropdown-menu-light\">\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        $classes[] = 'nav-item';
        if ($has_children && $depth === 0) {
            $classes[] = 'dropdown';
        }

        $class_names = implode( ' ', $classes );
        $output .= $indent . '<li class="' . esc_attr($class_names) . '">';

        $atts           = '';
        $atts .= ' class="nav-link';

        if ($has_children && $depth === 0) {
            $atts .= ' dropdown-toggle"';
            $atts .= ' data-bs-toggle="dropdown"';
            $atts .= ' role="button"';
            $atts .= ' aria-expanded="false"';
        } else {
            $atts .= '"';
        }

        $atts .= ' href="' . esc_url($item->url) . '"';

        $item_output  = '<a' . $atts . '>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';

        $output .= $item_output;
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}
