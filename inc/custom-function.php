<?php

// filter for phone
function filter_phone( $phone ) {
	$filter_phone = str_replace( array( ' ', '(', ')', '-' ), '', $phone );
	return $filter_phone;
}

// Add new attribute for wp_nav_menu
function add_menu_link_class( $atts, $item, $args ) {
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function change_nav_menu_objects($sorted_menu_items, $args) {
  if ( $args->theme_location === 'main' ) {
    $sorted_menu_items[count($sorted_menu_items)]->classes[] = 'last';
    $sorted_menu_items[count($sorted_menu_items)]->title .= '<svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path data-name="-e-arrow-white" d="M6.99 6a1.011 1.011 0 0 1-.29.706l-4.99 5A1 1 0 1 1 .3 10.294L4.58 6 .3 1.706A1 1 0 1 1 1.71.294l4.99 5A1.011 1.011 0 0 1 6.99 6z" fill="#fff" fill-rule="evenodd"/></svg>';
  }
  return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects', 'change_nav_menu_objects', 10, 2);
