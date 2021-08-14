<?php

/**
 * Plugin Name: Video Quiz Linking
 * Plugin URI: 
 * Description: Video Quiz Linking
 * Version: 1.0.0
 * Author: Nikul Panchal
 * Author URI: 
 * License: GPL2
 */

define('WCP_QUIZ_LINKING_PLUGIN_VERSION', '1.0.0');
define('WCP_QUIZ_LINKING_PLUGIN_DOMAIN', 'website-custom-plugin');
define('WCP_QUIZ_LINKING_PLUGIN_URL', WP_PLUGIN_URL . '/Website-Custome-Plugin');

@define("WP_MEMORY_LIMIT","512M");       

include_once(dirname(__FILE__) . "/linking/Controller.php");
register_activation_hook(__FILE__, 'quizLinkingCreateTable');    

define('PAYPAL_CLIENT_ID','AcS1rDqcqURwDJzNP0vnl_qMxqm5rixVvlf8PRdc_X4JCEgRIoy_FX25Si5ySQOlI_x_3OnIrcWsQ0Kz');
define('PAYPAL_SECRET_ID','EKry33VGmrIC4gPUbcK1ZF3ZVDDt8_dhcpJL-Ad0FUN9kU6J9XanJpLL7zxQ3s_MrflkcbBNcLXiWdH_');
define('PAYPAL_BUSINESS_ID','sb-47ml47s7034863_api1.business.example.com');
define('PAYPAL_BUSINESS_PASSWORD','BAT7Y32ZE9V2A2L9');
define('PAYPAL_BUSINESS_SIGNATURE','AL5m86sF7KicMI3WPO55.7sX73mIA5i5PZRFhzfqzp.LqC3TId8OX4Ix');

function quizLinkingCreateTable() {
    global $wpdb;
    global $db_table_name;
    $charset_collate = $wpdb->get_charset_collate();
    $db_table_name = $wpdb->prefix . 'video_quiz_linking';
    $db_user_quiz = $wpdb->prefix . 'user_quiz';
    $db_user_membership = $wpdb->prefix . 'user_membership';

    $sql = "CREATE TABLE `$db_table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `video_name` varchar(255) NOT NULL,
        `video_url` varchar(255) NOT NULL,
        `quiz_id` int(11) NOT NULL,
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

    $sql = "CREATE TABLE `$db_user_quiz` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,    
        `video_id` int(11) NOT NULL,
        `is_paid` tinyint(1) NOT NULL,
        `status` tinyint(1) NOT NULL,    
        `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$db_user_quiz'") != $db_table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    $sql = "CREATE TABLE `$db_user_membership` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,   
        `subscription_id` varchar(255) NOT NULL,   
        `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$db_user_membership'") != $db_table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }    


}
