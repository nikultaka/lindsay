<?php
/**
 * Default Theme Customizer Values
 *
 * @package chives
 */

function chives_get_default_theme_options() {
	$chives_default_options = array(
		// default options

		// Top Bar
		'show_topbar_menu'		=> false,
		'show_social_menu'		=> false,
		'show_top_search'		=> true,

		// Slider
		'enable_slider'			=> true,
		'slider_entire_site'	=> false,
		'slider_arrow'			=> true,

		// Footer
		'slide_to_top'			=> true,
		'copyright_text'		=> esc_html__( 'Copyright &copy; 2018 | All Rights Reserved', 'chives' ),

		// blog / archive
		'excerpt_count'			=> 25,
		'pagination_type'		=> 'numeric',
		'sidebar_layout'		=> 'right-sidebar',
		'column_type'			=> 'column-2',
		'show_date'				=> true,
		'show_category'			=> true,
		'show_author'			=> true,
		'show_comment'			=> true,

		// single post
		'sidebar_single_layout'	=> 'right-sidebar',
		'show_single_date'		=> true,
		'show_single_category'	=> true,
		'show_single_tags'		=> true,
		'show_single_author'	=> true,

		// page
		'sidebar_page_layout'	=> 'right-sidebar',

		// global
		'enable_loader'			=> true,
		'loader_type'			=> 'spinner-dots',
		'site_layout'			=> 'full',
	);

	$output = apply_filters( 'chives_default_theme_options', $chives_default_options );
	return $output;
}