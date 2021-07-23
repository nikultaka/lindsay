<?php
/**
 * Global Customizer Options
 *
 * @package chives
 */

// Add Global section
$wp_customize->add_section( 'chives_global_section', array(
	'title'             => esc_html__( 'Global Setting','chives' ),
	'description'       => esc_html__( 'Global Setting Options', 'chives' ),
	'panel'             => 'chives_theme_options_panel',
) );

// site layout setting and control.
$wp_customize->add_setting( 'chives_theme_options[site_layout]', array(
	'sanitize_callback'   => 'chives_sanitize_select',
	'default'             => chives_theme_option('site_layout'),
) );

$wp_customize->add_control(  new Chives_Radio_Image_Control ( $wp_customize, 'chives_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'chives' ),
	'section'             => 'chives_global_section',
	'choices'			  => chives_site_layout(),
) ) );


// loader setting and control.
$wp_customize->add_setting( 'chives_theme_options[enable_loader]', array(
	'default'           => chives_theme_option( 'enable_loader' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[enable_loader]', array(
	'label'             => esc_html__( 'Enable Loader', 'chives' ),
	'section'           => 'chives_global_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// loader type control and setting
$wp_customize->add_setting( 'chives_theme_options[loader_type]', array(
	'default'          	=> chives_theme_option('loader_type'),
	'sanitize_callback' => 'chives_sanitize_select',
) );

$wp_customize->add_control( 'chives_theme_options[loader_type]', array(
	'label'             => esc_html__( 'Loader Type', 'chives' ),
	'section'           => 'chives_global_section',
	'type'				=> 'select',
	'choices'			=> chives_get_spinner_list(),
) );
