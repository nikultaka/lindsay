<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chives
 */

/**
 * chives_site_content_ends_action hook
 *
 * @hooked chives_site_content_ends -  10
 *
 */
do_action( 'chives_site_content_ends_action' );

/**
 * chives_footer_start_action hook
 *
 * @hooked chives_footer_start -  10
 *
 */
do_action( 'chives_footer_start_action' );

/**
 * chives_site_info_action hook
 *
 * @hooked chives_site_info -  10
 *
 */
do_action( 'chives_site_info_action' );

/**
 * chives_footer_ends_action hook
 *
 * @hooked chives_footer_ends -  10
 * @hooked chives_slide_to_top -  20
 *
 */
do_action( 'chives_footer_ends_action' );

/**
 * chives_page_ends_action hook
 *
 * @hooked chives_page_ends -  10
 *
 */
do_action( 'chives_page_ends_action' );

wp_footer();

/**
 * chives_body_html_ends_action hook
 *
 * @hooked chives_body_html_ends -  10
 *
 */
do_action( 'chives_body_html_ends_action' );
