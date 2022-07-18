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

global $wpdb;  
$db_settings = $wpdb->prefix . 'membership_settings';
$query = "SELECT  * from ".$db_settings." ";
$settingsData = $wpdb->get_results($query);


$client_id = '';
$secret_id = '';
$business_id = '';
$business_password = '';
$business_signature = '';
$point_reward = '';
$usd_reward = '';
if(!empty($settingsData)) {
    $client_id = $settingsData[0]->client_id;
    $secret_id = $settingsData[0]->secret_id;
    $business_id = $settingsData[0]->business_id;
    $payout_by = isset($settingsData[0]->payout_by) ? $settingsData[0]->payout_by : '';
    $business_password = $settingsData[0]->business_password;
    $business_signature = $settingsData[0]->business_signature;
    $point_reward = $settingsData[0]->point_reward;
    $usd_reward = $settingsData[0]->usd_reward;
}

define('PAYPAL_CLIENT_ID',$client_id);
define('PAYPAL_SECRET_ID',$secret_id);
define('PAYPAL_BUSINESS_ID',$business_id);
define('PAYPAL_BUSINESS_PASSWORD',$business_password);
define('PAYPAL_BUSINESS_SIGNATURE',$business_signature);
define('POINT_REWARD',$point_reward);
define('USD_REWARD',$usd_reward);
define('IS_SANDBOX',0);            

function quizLinkingCreateTable() {
    global $wpdb;  
    global $db_table_name;
    $db_table_name = $wpdb->prefix . 'video_quiz_linking';
    $db_user_quiz = $wpdb->prefix . 'user_quiz';
    $db_user_membership = $wpdb->prefix . 'user_membership';
    $db_settings = $wpdb->prefix . 'membership_settings';
    $db_withdraw = $wpdb->prefix . 'withdraw';

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

    $sql = "CREATE TABLE `$db_settings` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `client_id` varchar(255) NOT NULL,
        `secret_id` varchar(255) NOT NULL,
        `business_id` varchar(255) NOT NULL,
        `business_password` varchar(255) NOT NULL,
        `business_signature` varchar(255) NOT NULL,
        `amount` decimal(5,2) NOT NULL,
        `plan_id` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

    $wpdb->query("alter table  `$db_settings` add column payout_by varchar(255) null");
    $wpdb->query("alter table  `$db_settings` add column usd_reward INT null");
    $wpdb->query("alter table  `$db_settings` add column point_reward INT null");
    
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$db_settings'") != $db_settings) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }


    $sql = "CREATE TABLE `$db_withdraw` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `amount` decimal(5,2) NOT NULL,
        `is_paid` tinyint(11) NOT NULL,
        `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

    $wpdb->query("alter table  `$db_withdraw` add column payout_by varchar(255) null");
    $wpdb->query("alter table  `$db_withdraw` add column amount_usd decimal(5,2) null");
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$db_withdraw'") != $db_withdraw) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }      


}
