<?php

/* Enqueue Child Theme Styles */
function bourz_child_embed_resources() {

    wp_enqueue_style( 'bourz-parent', get_template_directory_uri() . '/style.css', array( 'normalize' ) );

}
add_action( 'wp_enqueue_scripts', 'bourz_child_embed_resources' );
/* */

/* ***************** */
/* DO NOT EDIT ABOVE */
/* ***************** */


