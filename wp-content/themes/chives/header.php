<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chives
 */

/**
 * chives_doctype_action hook
 *
 * @hooked chives_doctype -  10
 *
 */
do_action( 'chives_doctype_action' );

/**
 * chives_head_action hook
 *
 * @hooked chives_head -  10
 *
 */
do_action( 'chives_head_action' );

/**
 * chives_body_start_action hook
 *
 * @hooked chives_body_start -  10
 *
 */
do_action( 'chives_body_start_action' );
 
/**
 * chives_page_start_action hook
 *
 * @hooked chives_page_start -  10
 * @hooked chives_loader -  20
 *
 */
do_action( 'chives_page_start_action' );

/**
 * chives_header_start_action hook
 *
 * @hooked chives_header_start -  10
 *
 */
do_action( 'chives_header_start_action' );

/**
 * chives_site_branding_action hook
 *
 * @hooked chives_site_branding -  10
 *
 */
do_action( 'chives_site_branding_action' );

/**
 * chives_primary_nav_action hook
 *
 * @hooked chives_primary_nav -  10
 *
 */
do_action( 'chives_primary_nav_action' );

/**
 * chives_header_ends_action hook
 *
 * @hooked chives_header_ends -  10
 *
 */
do_action( 'chives_header_ends_action' );

/**
 * chives_site_content_start_action hook
 *
 * @hooked chives_site_content_start -  10
 *
 */
do_action( 'chives_site_content_start_action' );

/**
 * chives_primary_content_action hook
 *
 * @hooked chives_add_slider_section -  10
 *
 */
do_action( 'chives_primary_content_action' );