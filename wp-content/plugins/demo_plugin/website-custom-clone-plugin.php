<?php

/**
 * Plugin Name: Demo Plugin
 * Plugin URI: 
 * Description: Demo Plugin
 * Version: 1.0.0
 * Author: Nikul Panchal
 * Author URI: 
 * License: GPL2
 */ 

define('WCP_QUIZ_LINKING_PLUGIN_VERSION', '1.0.0');
define('WCP_QUIZ_LINKING_PLUGIN_DOMAIN', 'demo-plugin');
define('WCP_QUIZ_LINKING_PLUGIN_URL', WP_PLUGIN_URL . '/Demo-Plugin');

include_once(dirname(__FILE__) . "/linking/Controller.php");
register_activation_hook(__FILE__, 'demoCreateTable');  

function demoCreateTable() {
    global $wpdb;  
    global $db_table_name;
    $db_table_name = $wpdb->prefix . 'demo_plugin';

    $sql = "CREATE TABLE `$db_table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `video_name` varchar(255) NOT NULL,
        `amount` decimal(5,2) NOT NULL,
        `status` tinyint(1) NOT NULL,
        `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$db_table_name'") != $db_table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }    


}
