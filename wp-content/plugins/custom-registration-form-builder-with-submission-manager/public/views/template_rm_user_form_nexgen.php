<?php
if (!defined('WPINC')) {
    die('Closed');
}
if(defined('REGMAGIC_ADDON')) include_once(RM_ADDON_PUBLIC_DIR . 'views/template_rm_user_form_nexgen.php'); else {
//Front-end form template
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php

if(isset($data->banned) && $data->banned == true)
    echo "<div class=rm-notice-banned>".RM_UI_Strings::get('MSG_BANNED')."</div>";
else
    $data->fe_form->render(array('stat_id' => $data->stat_id, 'submission_id' => isset($data->submission_id)?$data->submission_id:null));
    
}