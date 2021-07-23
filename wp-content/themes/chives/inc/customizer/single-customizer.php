<?php
/**
 * Single Post Customizer Options
 *
 * @package chives
 */

// Add excerpt section
$wp_customize->add_section( 'chives_single_section', array(
	'title'             => esc_html__( 'Single Post Setting','chives' ),
	'description'       => esc_html__( 'Single Post Setting Options', 'chives' ),
	'panel'             => 'chives_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'chives_theme_options[sidebar_single_layout]', array(
	'sanitize_callback'   => 'chives_sanitize_select',
	'default'             => chives_theme_option('sidebar_single_layout'),
) );

$wp_customize->add_control(  new Chives_Radio_Image_Control ( $wp_customize, 'chives_theme_options[sidebar_single_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'chives' ),
	'section'             => 'chives_single_section',
	'choices'			  => chives_sidebar_position(),
) ) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_single_date]', array(
	'default'           => chives_theme_option( 'show_single_date' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_single_date]', array(
	'label'             => esc_html__( 'Show Date', 'chives' ),
	'section'           => 'chives_single_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_single_category]', array(
	'default'           => chives_theme_option( 'show_single_category' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_single_category]', array(
	'label'             => esc_html__( 'Show Category', 'chives' ),
	'section'           => 'chives_single_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_single_tags]', array(
	'default'           => chives_theme_option( 'show_single_tags' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_single_tags]', array(
	'label'             => esc_html__( 'Show Tags', 'chives' ),
	'section'           => 'chives_single_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_single_author]', array(
	'default'           => chives_theme_option( 'show_single_author' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_single_author]', array(
	'label'             => esc_html__( 'Show Author', 'chives' ),
	'section'           => 'chives_single_section',
	'on_off_label' 		=> chives_show_options(),
) ) );
