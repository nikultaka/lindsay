<?php
/**
 * demo import
 *
 * @package chives
 */

/**
 * Imports predefine demos.
 * @return [type] [description]
 */
function chives_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Chives Theme.', 'chives' ),
    esc_url( 'https://drive.google.com/open?id=1H81crC8l8ZZjmuZYEf4Sh5Bsnu9JtOJU' ), esc_html__( 'Click here to download Demo Data', 'chives' ) );

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'chives_intro_text' );
