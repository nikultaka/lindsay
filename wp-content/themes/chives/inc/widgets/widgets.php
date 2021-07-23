<?php
/**
 * Register Widgets
 *
 * @package chives
 */

/**
 * Load dynamic logic for the widgets.
 */
function chives_widget_js( $hook ) {
	if ( 'widgets.php' === $hook ) :
		wp_enqueue_script( 'media-upload' );
	   	wp_enqueue_media();
	   	
		// Choose from select jquery.
		wp_enqueue_style( 'jquery-chosen', get_template_directory_uri() . '/assets/css/chosen' . chives_min() . '.css' );
		wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen' . chives_min() . '.js', array( 'jquery' ), '1.4.2', true );

		// admin script
		wp_enqueue_style( 'chives-admin-css', get_template_directory_uri() . '/assets/css/admin' . chives_min() . '.css' );
		wp_enqueue_script( 'chives-admin-script', get_template_directory_uri() . '/assets/js/admin' . chives_min() . '.js', array( 'jquery', 'jquery-chosen' ), '1.0.0', true );
	endif;

}
add_action( 'admin_enqueue_scripts', 'chives_widget_js' );

/*
 * Add introduction widget
 */
require get_template_directory() . '/inc/widgets/introduction-widget.php';

/*
 * Add featured widget
 */
require get_template_directory() . '/inc/widgets/featured-widget.php';

/*
 * Add author widget
 */
require get_template_directory() . '/inc/widgets/author-widget.php';

/*
 * Add recent widget
 */
require get_template_directory() . '/inc/widgets/recent-widget.php';

/*
 * Add contact widget
 */
require get_template_directory() . '/inc/widgets/contact-widget.php';


/**
 * Register widgets
 */
function chives_register_widgets() {
	
	register_widget( 'Chives_Introduction_Widget' );
	
	register_widget( 'Chives_Featured_Widget' );

	register_widget( 'Chives_Author_Widget' );

	register_widget( 'Chives_Recent_Widget' );

	register_widget( 'Chives_Contact_Widget' );

}
add_action( 'widgets_init', 'chives_register_widgets' );