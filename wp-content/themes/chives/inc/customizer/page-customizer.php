<?php
/**
 * Page Customizer Options
 *
 * @package chives
 */

// Add excerpt section
$wp_customize->add_section( 'chives_page_section', array(
	'title'             => esc_html__( 'Page Setting','chives' ),
	'description'       => esc_html__( 'Page Setting Options', 'chives' ),
	'panel'             => 'chives_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'chives_theme_options[sidebar_page_layout]', array(
	'sanitize_callback'   => 'chives_sanitize_select',
	'default'             => chives_theme_option('sidebar_page_layout'),
) );

$wp_customize->add_control(  new Chives_Radio_Image_Control ( $wp_customize, 'chives_theme_options[sidebar_page_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'chives' ),
	'section'             => 'chives_page_section',
	'choices'			  => chives_sidebar_position(),
) ) );
