<?php
//error_reporting(E_ALL & ~E_NOTICE);
//ini_set('display_errors', '1');

use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\PayPalAPI\MassPayReq;
use PayPal\PayPalAPI\MassPayRequestItemType;
use PayPal\PayPalAPI\MassPayRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
use PayPal\Auth\PPSignatureCredential;    
use PayPal\Auth\PPTokenAuthorization;

add_action('admin_menu', 'custom_quiz_linking_menu');

function custom_quiz_linking_menu()
{ 
    add_menu_page('Video Linking', 'Video Linking', 'manage_options', 'video-linking', 'display_video_linking', 'dashicons-chart-area', 56);
    add_submenu_page(
        'video-linking', // parent slug
        'Video Linking', // page title 
        'Video Linking', // menu title
        'manage_options', // capability
        'video-linking', // slug  
        'display_video_linking' // callback
    );

    add_submenu_page(
        'video-linking', // parent slug 
        'Paypal Payout', // page title
        'Paypal Payout', // menu title
        'manage_options', // capability
        'paypal-payout', // slug
        'payout' // callback 
    );

    add_submenu_page(
        'video-linking', // parent slug 
        'Settings', // page title
        'Settings', // menu title
        'manage_options', // capability
        'user-settings', // slug
        'subscription' // callback 
    );
}

function subscription() {
    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_script('datatable-script', 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    global $wpdb;
    $db_settings = $wpdb->prefix . 'membership_settings';

    $query = "SELECT  * from ".$db_settings." ";
    $settingsData = $wpdb->get_results($query);

    $client_id = '';
    $secret_id = '';
    $business_id = '';
    $business_password = '';
    $business_signature = '';
    $amount = '';
    if(!empty($settingsData)) {
        $client_id = $settingsData[0]->client_id;
        $secret_id = $settingsData[0]->secret_id;
        $business_id = $settingsData[0]->business_id;
        $business_password = $settingsData[0]->business_password;
        $business_signature = $settingsData[0]->business_signature;
        $amount = $settingsData[0]->amount;
    }

    include(dirname(__FILE__) . "/html/subscription.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;    
}

function display_video_linking()
{
    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_script('datatable-script', 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    global $wpdb;
    $table_name = $wpdb->prefix . "aysquiz_quizes";
    $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";

    $query = "SELECT * from " . $table_name;
    $quizesData = $wpdb->get_results($query);

    $query = "SELECT ql.id,ql.video_name,ql.amount,aq.title,ql.status from " . $table_quiz_linking . " as ql left join " . $table_name . " as aq on aq.id = ql.quiz_id";
    $tableData = $wpdb->get_results($query);

    $args = array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => null, // any parent
        'post_mime_type' => 'video'
    );

    $attachments = get_posts($args);

    include(dirname(__FILE__) . "/html/linking_quiz_form.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}

function payout()
{
    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_script('datatable-script', 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    global $wpdb;
    $table_name = $wpdb->prefix . "aysquiz_quizes";
    $table_users = $wpdb->prefix . "users";
    $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";
    $table_user_quiz = $wpdb->prefix . "user_quiz";

    $query = "SELECT ql.id,ql.video_name,ql.amount,aq.title,tuq.status,u.display_name,tuq.is_paid
    from " . $table_users . " as u
    inner join " . $table_user_quiz . " as tuq on tuq.user_id = u.ID and tuq.status='1'
    inner join " . $table_quiz_linking . " as ql on ql.id = tuq.video_id
    inner join " . $table_name . " as aq on aq.id = ql.quiz_id";
    $tableData = $wpdb->get_results($query);        

    include(dirname(__FILE__) . "/html/payout.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}

function videoDashboard() {
    if (!is_user_logged_in()) {
        wp_redirect(site_url('?page_id=15607'));
        exit;
    } 

    global $wpdb;
    $loginUserID =  get_current_user_id();
    $usermetaTable = $wpdb->prefix . "usermeta";
    $userMetadata = $wpdb->get_results("SELECT * FROM $usermetaTable WHERE user_id = $loginUserID AND meta_key = 'userpaypalEmail' ");
    if(empty($userMetadata)) {
        wp_redirect(site_url('?page_id=15836'));
    }  

    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_style('dashboard', plugins_url('../assets/css/dashboard.css', __FILE__), false, '1.0.0', 'all');

    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css');
    wp_enqueue_style('googleapis', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,200');
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
    wp_enqueue_style('dataTables', 'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css');

    wp_enqueue_script('datatable-script', 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'));
    wp_enqueue_script('validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    global $wpdb;
    $table_name = $wpdb->prefix . "aysquiz_quizes";
    $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";
    $table_user_quiz = $wpdb->prefix . 'user_quiz';
    $usersTable = $wpdb->prefix . "users";
    $loginUserID =  get_current_user_id();

    $userquizSql =    "SELECT  " . $table_quiz_linking . ".amount," . $table_quiz_linking . ".video_name, " . $table_user_quiz . ".user_id, " . $usersTable . ".user_nicename,
    ". $table_user_quiz . ".video_id, " . $table_user_quiz . ".is_paid, " . $table_user_quiz . ".status, " . $table_user_quiz . ".created_at FROM " . $table_user_quiz . " 
    left JOIN " . $usersTable . " ON " . $usersTable . ".ID = " . $table_user_quiz . ".user_id 
    LEFT JOIN " . $table_quiz_linking . " ON " . $table_quiz_linking . ".id = " . $table_user_quiz . ".video_id
    WHERE $usersTable.ID = $loginUserID";
    
    $userquizSqlData = $wpdb->get_results($userquizSql);

    $received = array();
    $pending = array();
    if(!empty($userquizSqlData)) {
        foreach($userquizSqlData as $ukey => $uvalue) {
            $isPaid = $uvalue->is_paid;
            $status = $uvalue->status;
            $amount = $uvalue->amount;
            if($isPaid == '0' && $status == '1') {
                $pending[] = $amount;    
            } else if($isPaid == '1'  && $status == '1') {
                $received[] = $amount;
            }
        }    
    }
    
    $pending = array_sum($pending);
    $received = array_sum($received);
    $balance = $pending + $received;

    $query = "SELECT * from " . $table_user_quiz . " where user_id = " . get_current_user_id();
    $userQuizData = $wpdb->get_results($query);

    $completedVideo = array();
    if (!empty($userQuizData)) {
        foreach ($userQuizData as $key => $value) {
            $completedVideo[] = $value->video_id;
        }
    }

    $lastSeenVideoID = array_values(array_slice($completedVideo, -1))[0];

    $query = "SELECT * from " . $table_name;
    $quizesData = $wpdb->get_results($query);
    $query = "SELECT ql.* from " . $table_quiz_linking . " as ql 
    left join " . $table_name . " as aq on aq.id = ql.quiz_id 
    order by id asc";
    $tableData = $wpdb->get_results($query);

    //echo '<pre>'; print_r($tableData); exit;

    $frontendQuizData = array();
    session_start();
    $isPick = 0;    
    if (!empty($tableData)) {
        foreach ($tableData as $key => $value) {
            $videoID = $value->id;
            
            if ( $videoID == $lastSeenVideoID ) {
                $isPick = 1;
                continue;
            }
            if($isPick == 1) {
                $postData = get_post($value->video_url);
                $videoURL = $postData->guid;
                $value->link = $videoURL;
                $frontendQuizData = $value;
                $_SESSION['latestVideoID'] = $value->id;  
            }
            break;    
        }
        if($isPick == 0) {
            $postData = get_post($tableData[0]->video_url);
            $videoURL = $postData->guid;
            $tableData[0]->link = $videoURL;
            $frontendQuizData = $tableData[0];
            $_SESSION['latestVideoID'] = $tableData[0]->id;
        }    
    }


    $paypalEmail = get_user_meta($loginUserID,'userpaypalEmail',true);

    $currentUserData = wp_get_current_user();
    $nicename = $currentUserData->data->display_name;
    $createdDate = $currentUserData->data->user_registered;    

    include(dirname(__FILE__) . "/html/dashboard.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}
add_shortcode('dashboard', 'videoDashboard');

function pricing(){
    if (!is_user_logged_in()) {
        wp_redirect(site_url('?page_id=15607'));
        exit;
    }      
    global $wpdb;
    $loginUserID =  get_current_user_id();
    $usermetaTable = $wpdb->prefix . "usermeta";
    $userMetadata = $wpdb->get_results("SELECT * FROM $usermetaTable WHERE user_id = $loginUserID AND meta_key = 'userpaypalEmail' ");
    if(!empty($userMetadata)) {
        wp_redirect(site_url('?page_id=15814'));
    } 

    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css');
    wp_enqueue_style('googleapis', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,200');
    wp_enqueue_script('validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    $db_settings = $wpdb->prefix . 'membership_settings';
    $settingsData = $wpdb->get_results("select * from ".$db_settings);

    $planID = '';
    if(!empty($settingsData)) {
        $planID = $settingsData[0]->plan_id;    
    }        

    include(dirname(__FILE__) . "/html/pricing.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}
add_shortcode('pricing', 'pricing');

function thankyou(){
    if (!is_user_logged_in()) {
        wp_redirect(site_url());
        exit;
    } 
    global $wpdb;
    if(isset($_REQUEST) && !empty($_REQUEST)) {
        $data = $_REQUEST;
        $txID = $data['tx'];  
        $sig = $data['sig'];
        //echo '<pre>'; print_r($data); exit;


        $request = curl_init();
        curl_setopt_array($request, array
            (
              CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
              CURLOPT_POST => TRUE,
              CURLOPT_POSTFIELDS => http_build_query(array
                (
                  'cmd' => '_notify-synch',
                  'tx' => $txID,
                  'at' => $sig,
              )),
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_HEADER => FALSE
          ));
        $response = curl_exec($request);
        $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);
        curl_close($request);

        echo '<pre>'; print_r(json_decode($response)); exit;  
        
        $table_user_membership = $wpdb->prefix . "user_membership";
        $data = array('video_name' => $videoName, 'video_url' => $videoID, 'quiz_id' => $quizName, 'amount' => $amount, 'status' => $status);
        $wpdb->insert($table_user_membership,$data);
    }     
    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    include(dirname(__FILE__) . "/html/thankyou.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}
add_shortcode('thankyou', 'thankyou');

class VideoLinkingController
{
    public function insert_video()
    {
        global $wpdb;
        $hiddenID = $_POST['hiddenID'];
        $videoName = $_POST['videoName'];
        $videoID = $_POST['videoID'];
        $quizName = $_POST['quizName'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];

        $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";
        $data = array('video_name' => $videoName, 'video_url' => $videoID, 'quiz_id' => $quizName, 'amount' => $amount, 'status' => $status);

        if ($hiddenID == '') {
            $wpdb->insert($table_quiz_linking, $data);
            $data = array();
            $data['status'] = 1;
            $data['msg'] = "Video added successfully";
        } else {
            $wpdb->update($table_quiz_linking, $data, array('id' => $hiddenID));
            $data = array();
            $data['status'] = 1;
            $data['msg'] = "Video updated successfully";
        }
        echo json_encode($data);
        exit();
    }

    public function insert_paypalEmail()
    {
        global $wpdb;
        $paypalEmail = $_POST['paypalEmail'];   
        $loginUserID =  get_current_user_id();
        $data['status'] = 0;
        $data['msg'] = "Something went wrong please try again";
        $usermetaTable = $wpdb->prefix . "usermeta";
        $userMetadata = $wpdb->get_results("SELECT * FROM $usermetaTable WHERE user_id = $loginUserID AND meta_key = 'userpaypalEmail' ");

        if ($paypalEmail != '' && $paypalEmail != null) {
            if (empty($userMetadata)) {
                add_user_meta($loginUserID, 'userpaypalEmail', $paypalEmail);
                $data['status'] = 1;
                $data['msg'] = "Paypal Email add successfully";
            } else {
                update_user_meta($loginUserID, 'userpaypalEmail', $paypalEmail);
                $data['status'] = 1;
                $data['msg'] = "Paypal Email update successfully";
            }
        }
        echo json_encode($data);
        exit();
    }

    public function get_data()
    {
        global $wpdb;
        $hiddenID = $_POST['id'];
        $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";

        $query = "SELECT * from " . $table_quiz_linking . " where id = " . $hiddenID;
        $quizesData = $wpdb->get_results($query);
        echo json_encode(array('status' => 1, 'data' => $quizesData[0]));
        die;
    }

    public function delete_record()
    {
        global $wpdb;
        $hiddenID = $_POST['id'];
        $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";
        $wpdb->delete($table_quiz_linking, array('id' => $hiddenID));
        echo json_encode(array('status' => 1));
        exit();
    }



    public function mass_payment()
    {
        global $wpdb;
        //$videoID = $_POST['id'];
        $plugin_dir = ABSPATH . 'wp-content/plugins/video_quiz_linking/';
        if (file_exists($plugin_dir . 'merchant-sdk-php/vendor/autoload.php')) {
            require $plugin_dir . 'merchant-sdk-php/vendor/autoload.php';
            require $plugin_dir . 'merchant-sdk-php/samples/Configuration.php';
        }
        $massPayRequest = new MassPayRequestType();   
        $massPayRequest->MassPayItem = array();
        $table_user_quiz = $wpdb->prefix.'user_quiz';
        $table_users = $wpdb->prefix.'users';
        $table_users_meta = $wpdb->prefix.'usermeta';
        $table_quiz_linking = $wpdb->prefix . "video_quiz_linking";

        $sql = "select wuq.user_id,tum.meta_value,tql.amount 
        from  ".$table_user_quiz." as wuq 
        inner join ".$table_users." as tu on tu.ID = wuq.user_id
        inner join ".$table_quiz_linking." as tql on tql.id = wuq.video_id
        inner join ".$table_users_meta." as tum on tum.meta_key = 'userpaypalEmail' and tum.user_id = tu.ID
        where wuq.is_paid = '0' and wuq.status = '1'    
        ";   
        $usersData = $wpdb->get_results($sql);

        //echo '<pre>'; print_r($usersData); exit;

        $userID = array();
        $email = array();
        $amount = array();
        if(!empty($usersData)) {
            foreach($usersData as $key => $value) {
                $email[] = $value->meta_value;
                $userID[] = $value->user_id; 
                $amount[] = $value->amount;   
            }
            for ($i = 0; $i < count($email); $i++) {
                $masspayItem = new MassPayRequestItemType();
                $masspayItem->Amount = new BasicAmountType('USD', $amount[$i]);
                $masspayItem->ReceiverEmail = $email[$i];
                $massPayRequest->MassPayItem[] = $masspayItem;
            }
            $massPayReq = new MassPayReq();
            $massPayReq->MassPayRequest = $massPayRequest;
            $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
            $massPayResponse = $paypalService->MassPay($massPayReq);
            $userID = implode(",",$userID);
            $wpdb->query("update ".$table_user_quiz." set is_paid = 1,status=0 where user_id in (".$userID.") ");        
        }       

        echo json_encode(array('status' => 1, 'data' => $massPayResponse));   
        exit();   
    }

    public function video_completed() {
        global $wpdb;
        session_start();
        $table_user_quiz = $wpdb->prefix.'user_quiz';
        $loginUserID =  get_current_user_id();
        $status = $_POST['id'];
        $wpdb->insert($table_user_quiz,array('user_id'=>$loginUserID,'video_id'=>$_SESSION['latestVideoID'],'is_paid'=>0,'status'=>$status,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")));  
        echo json_encode(array('status' => 1,'data'=>array()));
        exit();
    }

    public static function get_subscription_detail($subscriptionID,$accessToken) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$subscriptionID,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$accessToken,
            'Content-Type: application/json'
        ),
      ));
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data;
    }

    public function save_paypal_id() {
        global $wpdb;    
        if(isset($_POST['id']) && $_POST['id']!='') {
            $subscriptionID = $_POST['id'];    
            $accessToken = base64_encode(PAYPAL_CLIENT_ID.':'.PAYPAL_SECRET_ID);
            $subscriptionData = self::get_subscription_detail($subscriptionID,$accessToken);

            if(!empty($subscriptionData)) {
                $paypalEmail = $subscriptionData->subscriber->email_address;
                $loginUserID =  get_current_user_id();
                $usermetaTable = $wpdb->prefix . "usermeta";
                $userMetadata = $wpdb->get_results("SELECT * FROM $usermetaTable WHERE user_id = $loginUserID AND meta_key = 'userpaypalEmail' ");

                if ($paypalEmail != '' && $paypalEmail != null) {
                    if (empty($userMetadata)) {
                        add_user_meta($loginUserID, 'userpaypalEmail', $paypalEmail);
                    } else {
                        update_user_meta($loginUserID, 'userpaypalEmail', $paypalEmail);
                    }
                }  
                echo json_encode(array('status'=>1));    
            } else {
                echo json_encode(array('status'=>0,'msg'=>'Something went wrong'));
            }
        } else {
            echo json_encode(array('status'=>0,'msg'=>'Something went wrong'));
        }
        exit();
    }

    public static function curlCall($url,$method,$postdata,$contentType,$accessToken) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/'.$url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_POSTFIELDS => $postdata,
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$accessToken,
            'Content-Type: '.$contentType
        ),
      ));  
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        return $response;     
    }

    public function save_settings() {
        global $wpdb;
        $client_id = $_POST['client_id'];
        $secret_id = $_POST['secret_id'];
        $business_id = $_POST['business_id'];
        $business_password = $_POST['business_password'];
        $business_signature = $_POST['business_signature'];
        $amount = $_POST['amount'];    
        $db_settings = $wpdb->prefix . 'membership_settings';
        $data =  array('client_id'=>$client_id,'secret_id'=>$secret_id,'business_id'=>$business_id,'business_password'=>$business_password,'business_signature'=>$business_signature,'amount'=>$amount);
        $settingsData = $wpdb->get_results("select * from ".$db_settings);

        if(!empty($settingsData)) {
            $wpdb->update($db_settings,$data,array('id'=>1));    
        } else {
            $wpdb->insert($db_settings,$data);    
        }
        if($settingsData[0]->amount != $amount) {
                $accessToken = base64_encode(PAYPAL_CLIENT_ID.':'.PAYPAL_SECRET_ID);
                $response = self::curlCall('oauth2/token','POST','grant_type=client_credentials','application/x-www-form-urlencoded','Basic '.$accessToken);
                if(!empty($response) && isset($response->access_token)) {
                    $postString = '{
                      "name": "Video Streaming Service",
                      "description": "Video streaming service",
                      "type": "SERVICE",
                      "category": "SOFTWARE",
                      "image_url": "https://example.com/streaming.jpg",
                      "home_url": "https://example.com/home"
                  }';
                  $accessToken = $response->access_token;
                  $response = self::curlCall('catalogs/products','POST',$postString,'application/json','Bearer '.$accessToken);
                  if(!empty($response) && isset($response->id)) {
                    $postString = '{
                      "product_id": "'.$response->id.'",
                      "name": "Basic Plan",
                      "description": "Basic plan",
                      "billing_cycles": [
                        {
                          "frequency": {
                            "interval_unit": "MONTH",
                            "interval_count": 1
                          },
                          "tenure_type": "REGULAR",
                          "sequence": 1,
                          "pricing_scheme": {
                            "fixed_price": {
                              "value": "'.$amount.'",
                              "currency_code": "USD"
                            }
                          }
                        }
                      ],
                      "payment_preferences": {
                        "auto_bill_outstanding": true,
                        "setup_fee_failure_action": "CONTINUE",
                        "payment_failure_threshold": 3
                      }
                    }';
                    $response = self::curlCall('billing/plans','POST',$postString,'application/json','Bearer '.$accessToken);
                    if(!empty($response) && isset($response->id)) {
                        $wpdb->update($db_settings,array('plan_id'=>$response->id),array('id'=>1));        
                    }
                }   
            }
        }
    echo json_encode(array('status'=>1));
    die;
}
}

$videoLinkingController = new VideoLinkingController();
add_action('wp_ajax_VideoLinkingController::insert_video', array($videoLinkingController, 'insert_video'));
add_action('wp_ajax_VideoLinkingController::get_data', array($videoLinkingController, 'get_data'));
add_action('wp_ajax_VideoLinkingController::delete_record', array($videoLinkingController, 'delete_record'));
add_action('wp_ajax_VideoLinkingController::insert_paypalEmail', array($videoLinkingController, 'insert_paypalEmail'));

add_action('wp_ajax_VideoLinkingController::mass_payment', array($videoLinkingController, 'mass_payment'));
add_action('wp_ajax_VideoLinkingController::video_completed', array($videoLinkingController, 'video_completed'));
add_action('wp_ajax_VideoLinkingController::save_paypal_id', array($videoLinkingController, 'save_paypal_id'));
add_action('wp_ajax_VideoLinkingController::save_settings', array($videoLinkingController, 'save_settings'));


function disable_plugin_updates( $value ) {
    if ( isset($value) && is_object($value) ) {
        if ( isset( $value->response['quiz-maker/quiz-maker.php'] ) ) {
          unset( $value->response['quiz-maker/quiz-maker.php'] );
      }     
  }
  return $value;
}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );