<?php
use PayPal\IPN\PPIPNMessage;
/**
 * This is a sample implementation of an IPN listener
 * that uses the SDK's PPIPNMessage class to process IPNs
 * 
 * This sample simply validates the incoming IPN message
 * and logs IPN variables. In a real application, you will
 * validate the IPN and initiate some action based on the 
 * incoming IPN variables.
 */
$plugin_dir = ABSPATH . 'wp-content/plugins/video_quiz_linking/';
require_once($plugin_dir.'merchant-sdk-php/PPBootStrap.php');
// first param takes ipn data to be validated. if null, raw POST data is read from input stream
$ipnMessage = new PPIPNMessage(null, Configuration::getConfig());
file_put_contents($plugin_dir.'callback.test.txt', print_r($ipnMessage, true)); 
foreach($ipnMessage->getRawData() as $key => $value) {
	error_log("IPN: $key => $value");
}

if($ipnMessage->validate()) {
	error_log("Success: Got valid IPN data");		
} else {
	error_log("Error: Got invalid IPN data");	
}   