<?php
/**
 * Footer Customizer Options
 *
 * @package chives
 */

// Add footer section
$wp_customize->add_section( 'chives_footer_section', array(
	'title'             => esc_html__( 'Footer Section','chives' ),
	'description'       => esc_html__( 'Footer Setting Options', 'chives' ),
	'panel'             => 'chives_theme_options_panel',
) );

// slide to top enable setting and control.
$wp_customize->add_setting( 'chives_theme_options[slide_to_top]', array(
	'default'           => chives_theme_option('slide_to_top'),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[slide_to_top]', array(
	'label'             => esc_html__( 'Show Slide to Top', 'chives' ),
	'section'           => 'chives_footer_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// copyright text
$wp_customize->add_setting( 'chives_theme_options[copyright_text]',
	array(
		'default'       		=> chives_theme_option('copyright_text'),
		'sanitize_callback'		=> 'chives_santize_allow_tags',
	)
);
$wp_customize->add_control( 'chives_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'chives' ),
		'section'    			=> 'chives_footer_section',
		'type'		 			=> 'textarea',
    )
);
