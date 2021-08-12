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
        'Subscription List', // page title
        'Subscription List', // menu title
        'manage_options', // capability
        'user-subscription', // slug
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
    $table_name = $wpdb->prefix . "user_membership";
    $table_user = $wpdb->prefix . "users";    

    $query = "SELECT  ".$table_user.".display_name,".$table_name.".subscription_id 
    from  ".$table_name." 
    left join ".$table_user." on ".$table_user.".ID = ".$table_name.".user_id ";
    $membershipData = $wpdb->get_results($query);

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

    $query = "SELECT ql.id,ql.video_name,ql.amount,aq.title,tuq.status,u.user_nicename,tuq.is_paid
    from " . $table_users . " as u
    inner join " . $table_user_quiz . " as tuq on tuq.user_id = u.ID
    inner join " . $table_quiz_linking . " as ql on ql.id = tuq.video_id
    inner join " . $table_name . " as aq on aq.id = ql.quiz_id";
    $tableData = $wpdb->get_results($query);

    include(dirname(__FILE__) . "/html/payout.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}

function videoDashboard(){
    if (!is_user_logged_in()) {
        wp_redirect(site_url());
        exit;
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

    $userquizSql =    "SELECT  " . $table_quiz_linking . ".video_name, " . $table_user_quiz . ".user_id, " . $usersTable . ".user_nicename,
    ". $table_user_quiz . ".video_id, " . $table_user_quiz . ".is_paid, " . $table_user_quiz . ".status, " . $table_user_quiz . ".created_at FROM " . $table_user_quiz . " 
    left JOIN " . $usersTable . " ON " . $usersTable . ".ID = " . $table_user_quiz . ".user_id 
    LEFT JOIN " . $table_quiz_linking . " ON " . $table_quiz_linking . ".id = " . $table_user_quiz . ".video_id
    WHERE $usersTable.ID = $loginUserID";
    
    $userquizSqlData = $wpdb->get_results($userquizSql);

    $query = "SELECT * from " . $table_name;
    $quizesData = $wpdb->get_results($query);
    $query = "SELECT ql.* from " . $table_quiz_linking . " as ql 
    left join " . $table_name . " as aq on aq.id = ql.quiz_id order by id ASC";
    $tableData = $wpdb->get_results($query);

    $query = "SELECT * from " . $table_user_quiz . " where user_id = " . get_current_user_id();
    $userQuizData = $wpdb->get_results($query);

    $completedVideo = array();
    if (!empty($userQuizData)) {
        foreach ($userQuizData as $key => $value) {
            $completedVideo[] = $value->video_id;
        }
    }

    $frontendQuizData = array();
    session_start();
    if (!empty($tableData)) {
        foreach ($tableData as $key => $value) {
            $videoID = $value->id;
            if (!in_array($videoID, $completedVideo)) {
                $postData = get_post($value->video_url);
                $videoURL = $postData->guid;
                $value->link = $videoURL;
                $frontendQuizData = $value;
                $_SESSION['latestVideoID'] = $value->id;
                break;
            }
        }
    }

    $paypalEmail = get_user_meta($loginUserID,'userpaypalEmail',true);

    include(dirname(__FILE__) . "/html/dashboard.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}
add_shortcode('dashboard', 'videoDashboard');

function pricing(){
    if (!is_user_logged_in()) {
        wp_redirect(site_url());
        exit;
    } 
    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css');
    wp_enqueue_style('googleapis', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,200');
    wp_enqueue_script('validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));
        
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

        $sql = "select wuq.user_id,tum.meta_value from  ".$table_user_quiz." as wuq 
        inner join ".$table_users." as tu on tu.ID = wuq.user_id
        inner join ".$table_users_meta." as tum on tum.meta_key = 'userpaypalEmail' and tum.user_id = tu.ID
        ";   
        $usersData = $wpdb->get_results($sql);

        $userID = array();
        $email = array();
        if(!empty($usersData)) {
            foreach($usersData as $key => $value) {
                $email[] = $value->meta_value;
                $userID[] = $value->user_id; 
            }
            for ($i = 0; $i < count($email); $i++) {
                $masspayItem = new MassPayRequestItemType();
                $masspayItem->Amount = new BasicAmountType('USD', 2);
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
        $wpdb->insert($table_user_quiz,array('user_id'=>$loginUserID,'video_id'=>$_SESSION['latestVideoID'],'is_paid'=>0,'status'=>1,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")));
        echo json_encode(array('status' => 1,'data'=>array()));
        exit();
    }
}

$videoLinkingController = new VideoLinkingController();
add_action('wp_ajax_VideoLinkingController::insert_video', array($videoLinkingController, 'insert_video'));
add_action('wp_ajax_VideoLinkingController::get_data', array($videoLinkingController, 'get_data'));
add_action('wp_ajax_VideoLinkingController::delete_record', array($videoLinkingController, 'delete_record'));
add_action('wp_ajax_VideoLinkingController::insert_paypalEmail', array($videoLinkingController, 'insert_paypalEmail'));

add_action('wp_ajax_VideoLinkingController::mass_payment', array($videoLinkingController, 'mass_payment'));
add_action('wp_ajax_VideoLinkingController::video_completed', array($videoLinkingController, 'video_completed'));


function disable_plugin_updates( $value ) {
    if ( isset($value) && is_object($value) ) {
        if ( isset( $value->response['quiz-maker/quiz-maker.php'] ) ) {
          unset( $value->response['quiz-maker/quiz-maker.php'] );
      }     
  }
  return $value;
}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );