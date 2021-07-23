<?php
/**
 * Slider Customizer Options
 *
 * @package chives
 */

// Add slider section
$wp_customize->add_section( 'chives_slider_section', array(
	'title'             => esc_html__( 'Slider Section','chives' ),
	'description'       => esc_html__( 'Slider Setting Options', 'chives' ),
	'panel'             => 'chives_theme_options_panel',
) );

// slider menu enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[enable_slider]', array(
	'default'           => chives_theme_option('enable_slider'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'chives' ),
	'section'           => 'chives_slider_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// slider social menu enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[slider_entire_site]', array(
	'default'           => chives_theme_option('slider_entire_site'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[slider_entire_site]', array(
	'label'             => esc_html__( 'Show Entire Site', 'chives' ),
	'section'           => 'chives_slider_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// slider arrow control enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[slider_arrow]', array(
	'default'           => chives_theme_option('slider_arrow'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[slider_arrow]', array(
	'label'             => esc_html__( 'Show Arrow Controller', 'chives' ),
	'section'           => 'chives_slider_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

for ( $i = 1; $i <= 5; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'chives_theme_options[slider_content_page_' . $i . ']', array(
		'sanitize_callback' => 'chives_sanitize_page_post',
	) );

	$wp_customize->add_control( new Chives_Dropdown_Chosen_Control( $wp_customize, 'chives_theme_options[slider_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'chives' ), $i ),
		'section'           => 'chives_slider_section',
		'choices'			=> chives_page_choices(),
	) ) );
endfor;