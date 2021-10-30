<?php
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/


require_once '../../../../../wp-load.php';
global $wpdb;
$db_withdraw = $wpdb->prefix . 'withdraw';
$db_users = $wpdb->prefix . 'users';

$query = "SELECT w.*,u.display_name,u.user_email from ".$db_withdraw." as w 
         inner join " .$db_users. " as u on u.ID = w.user_id";

$tableData = $wpdb->get_results($query); 

$tableDataArray = array();
$csvDataArray = array();
foreach($tableData as $tableDataKey => $tableDataVal){
    $tableDataArray['user_email']     = $tableDataVal->user_email;
    $tableDataArray['display_name']     = $tableDataVal->display_name;
    $tableDataArray['amount']           = $tableDataVal->amount;
    $tableDataArray['currencyCode']     = 'USD';
    $tableDataArray['noteRecipient']    = 'Mass Payment';
    $tableDataArray['recipientWallet']  = 'PayPal';
    $csvDataArray[] = $tableDataArray;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.date("Y-m-d").'_mass_payment_details.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Email/Phone','name','Amount', 'Currency code', 'Note to recipient','Recipient wallet'));

if (count($csvDataArray) > 0) {
    foreach ($csvDataArray as $row) {
        fputcsv($output, $row);
    }
}
?>