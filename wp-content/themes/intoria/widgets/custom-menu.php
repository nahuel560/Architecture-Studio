<?php
extract( $args );
extract( $instance );

$output = '';

$atts['title'] = $title;
if ($nav_menu) {
	$term = get_term_by( 'slug', $nav_menu, 'nav_menu' );
	if ( !empty($term) ) {
		$atts['nav_menu'] = $term->term_id;
	}
}

$output = '<div class="apus_custom_menu '.esc_attr(!empty($style) ? $style : '').'">';
$type = 'WP_Nav_Menu_Widget';
$args = array();
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo wp_kses($output, 'intoria-html');
} else {
	echo wp_kses($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : widget custom_menu' ), 'intoria-html');
}