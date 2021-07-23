<?php
/**
 * Validation functions
 *
 * @package chives
 */

if ( ! function_exists( 'chives_validate_excerpt_count' ) ) :
	/**
	 * Check if the input value is valid integer.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return string Whether the value is valid to the current preview.
	 */
	function chives_validate_excerpt_count( $validity, $value ){
		$value = intval( $value );
		if ( empty( $value ) || ! is_numeric( $value ) ) {
			$validity->add( 'required', esc_html__( 'You must supply a valid number.', 'chives' ) );
		} elseif ( $value < 1 ) {
			$validity->add( 'min_slider', esc_html__( 'Minimum no of Excerpt Lenght is 1', 'chives' ) );
		} elseif ( $value > 50 ) {
			$validity->add( 'max_slider', esc_html__( 'Maximum no of Excerpt Lenght is 50', 'chives' ) );
		}
		return $validity;
	}
endif;
