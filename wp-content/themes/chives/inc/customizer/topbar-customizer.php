<?php
/**
 * Topbar Customizer Options
 *
 * @package chives
 */

// Add topbar section
$wp_customize->add_section( 'chives_topbar_section', array(
	'title'             => esc_html__( 'Top Bar Section','chives' ),
	'description'       => sprintf( '%1$s <a class="menu_locations" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show topbar menu.', 'chives' ), esc_html__( 'Click Here', 'chives' ), esc_html__( 'to create menu.', 'chives' ) ),
	'panel'             => 'chives_theme_options_panel',
) );

// topbar menu enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_topbar_menu]', array(
	'default'           => chives_theme_option('show_topbar_menu'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_topbar_menu]', array(
	'label'             => esc_html__( 'Show Top Bar Menu', 'chives' ),
	'section'           => 'chives_topbar_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// topbar social menu enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_social_menu]', array(
	'default'           => chives_theme_option('show_social_menu'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_social_menu]', array(
	'label'             => esc_html__( 'Show Social Menu', 'chives' ),
	'section'           => 'chives_topbar_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// topbar search enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_top_search]', array(
	'default'           => chives_theme_option('show_top_search'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_top_search]', array(
	'label'             => esc_html__( 'Show Search', 'chives' ),
	'section'           => 'chives_topbar_section',
	'on_off_label' 		=> chives_show_options(),
) ) );