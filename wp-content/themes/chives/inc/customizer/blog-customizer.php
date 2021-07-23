<?php
/**
 * Blog / Archive / Search Customizer Options
 *
 * @package chives
 */

// Add blog section
$wp_customize->add_section( 'chives_blog_section', array(
	'title'             => esc_html__( 'Blog/Archive Page Setting','chives' ),
	'description'       => esc_html__( 'Blog/Archive/Search Page Setting Options', 'chives' ),
	'panel'             => 'chives_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'chives_theme_options[sidebar_layout]', array(
	'sanitize_callback'   => 'chives_sanitize_select',
	'default'             => chives_theme_option('sidebar_layout'),
) );

$wp_customize->add_control(  new Chives_Radio_Image_Control ( $wp_customize, 'chives_theme_options[sidebar_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'chives' ),
	'section'             => 'chives_blog_section',
	'choices'			  => chives_sidebar_position(),
) ) );

// column control and setting
$wp_customize->add_setting( 'chives_theme_options[column_type]', array(
	'default'          	=> chives_theme_option('column_type'),
	'sanitize_callback' => 'chives_sanitize_select',
) );

$wp_customize->add_control( 'chives_theme_options[column_type]', array(
	'label'             => esc_html__( 'Column Layout', 'chives' ),
	'section'           => 'chives_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'chives' ),
		'column-2' 		=> esc_html__( 'Two Column', 'chives' ),
	),
) );

// excerpt count control and setting
$wp_customize->add_setting( 'chives_theme_options[excerpt_count]', array(
	'default'          	=> chives_theme_option('excerpt_count'),
	'sanitize_callback' => 'chives_sanitize_number_range',
	'validate_callback' => 'chives_validate_excerpt_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'chives_theme_options[excerpt_count]', array(
	'label'             => esc_html__( 'Excerpt Length', 'chives' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 50.', 'chives' ),
	'section'           => 'chives_blog_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 50,
		),
) );

// pagination control and setting
$wp_customize->add_setting( 'chives_theme_options[pagination_type]', array(
	'default'          	=> chives_theme_option('pagination_type'),
	'sanitize_callback' => 'chives_sanitize_select',
) );

$wp_customize->add_control( 'chives_theme_options[pagination_type]', array(
	'label'             => esc_html__( 'Pagination Type', 'chives' ),
	'section'           => 'chives_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'default' 		=> esc_html__( 'Default', 'chives' ),
		'numeric' 		=> esc_html__( 'Numeric', 'chives' ),
	),
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_date]', array(
	'default'           => chives_theme_option( 'show_date' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'chives' ),
	'section'           => 'chives_blog_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_category]', array(
	'default'           => chives_theme_option( 'show_category' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'chives' ),
	'section'           => 'chives_blog_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_author]', array(
	'default'           => chives_theme_option( 'show_author' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'chives' ),
	'section'           => 'chives_blog_section',
	'on_off_label' 		=> chives_show_options(),
) ) );

// Archive comment meta setting and control.
$wp_customize->add_setting( 'chives_theme_options[show_comment]', array(
	'default'           => chives_theme_option( 'show_comment' ),
	'sanitize_callback' => 'chives_sanitize_switch',
) );

$wp_customize->add_control( new Chives_Switch_Control( $wp_customize, 'chives_theme_options[show_comment]', array(
	'label'             => esc_html__( 'Show Comment', 'chives' ),
	'section'           => 'chives_blog_section',
	'on_off_label' 		=> chives_show_options(),
) ) );