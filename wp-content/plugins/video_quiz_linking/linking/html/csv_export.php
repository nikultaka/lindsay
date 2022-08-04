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
$db_settings = $wpdb->prefix . 'membership_settings';


$query = "SELECT w.*,u.display_name,u.user_email from ".$db_withdraw." as w 
         inner join " .$db_users. " as u on u.ID = w.user_id
         where w.is_paid = '0' ";     
$settingsData = $wpdb->get_results("select * from ".$db_settings);
$payout_by = isset($settingsData[0]->payout_by) && $settingsData[0]->payout_by !="" ? $settingsData[0]->payout_by : '';
$tableData = $wpdb->get_results($query); 

$tableDataArray = array();
$csvDataArray = array();
$updateID = array();
foreach($tableData as $tableDataKey => $tableDataVal){
    $tableDataArray['user_email']     = $tableDataVal->user_email;
    //$tableDataArray['display_name']     = $tableDataVal->display_name;
    $tableDataArray['amount']           = $tableDataVal->amount_usd;
    $tableDataArray['currencyCode']     = 'USD';
    $tableDataArray['noteRecipient']    = 'Mass Payment';
    $tableDataArray['recipientWallet']  = 'PayPal';
    $csvDataArray[] = $tableDataArray;
    $updateID[] = $tableDataVal->id;
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.date("Y-m-d").'_mass_payment_details.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Email/Phone','Amount', 'Currency code', 'Note to recipient','Recipient wallet'));

if (count($csvDataArray) > 0) {
    foreach ($csvDataArray as $row) {
        fputcsv($output, $row);
    }
}

if(!empty($updateID)) {
    
    $updateID = implode(",",$updateID);
    $wpdb->query("update ".$db_withdraw." set is_paid = '1',payout_by = '".$payout_by."' where id in (".$updateID.") ");    
}

header('Refresh: 0; url=http://localhost/aspirecanada/wp-admin/admin.php?page=witdrawal-request');

?>