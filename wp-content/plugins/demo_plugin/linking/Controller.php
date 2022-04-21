<?php
   
add_action('admin_menu', 'demo_menu');
    
function demo_menu()
{ 
    add_menu_page('Demo Plugin', 'Demo Plugin', 'manage_options', 'demo-data', 'demo_plugin', 'dashicons-chart-area', 56);
}

function demo_plugin()
{
    ob_start();
    wp_enqueue_style('clone_style', plugins_url('../assets/css/style.css', __FILE__), false, '1.0.0', 'all');
    wp_enqueue_script('datatable-script', 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('sweetalert-script', '//cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'));
    wp_enqueue_script('script', plugins_url('../assets/js/script.js', __FILE__));

    global $wpdb;
    $table_quiz_linking = $wpdb->prefix . "demo_plugin";

    $query = "SELECT ql.id,ql.video_name,ql.amount,ql.status from " . $table_quiz_linking . " as ql";
    $tableData = $wpdb->get_results($query);

    include(dirname(__FILE__) . "/html/linking_quiz_form.php");
    $s = ob_get_contents();
    ob_end_clean();
    print $s;
}


class DemoController
{
    public function insert_video()
    {
        global $wpdb;
        $hiddenID = $_POST['hiddenID'];
        $videoName = $_POST['videoName'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];

        $table_quiz_linking = $wpdb->prefix . "demo_plugin";
        $data = array('video_name' => $videoName,'amount' => $amount, 'status' => $status);

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

    public function get_data()
    {
        global $wpdb;
        $hiddenID = $_POST['id'];
        $table_quiz_linking = $wpdb->prefix . "demo_plugin";

        $query = "SELECT * from " . $table_quiz_linking . " where id = " . $hiddenID;
        $quizesData = $wpdb->get_results($query);
        echo json_encode(array('status' => 1, 'data' => $quizesData[0]));
        die;
    } 

    public function delete_record()
    {
        global $wpdb;
        $hiddenID = $_POST['id'];
        $table_quiz_linking = $wpdb->prefix . "demo_plugin";
        $wpdb->delete($table_quiz_linking, array('id' => $hiddenID));
        echo json_encode(array('status' => 1));
        exit();
    }
 
}

$videoLinkingController = new DemoController();
add_action('wp_ajax_DemoController::insert_video', array($videoLinkingController, 'insert_video'));
add_action('wp_ajax_DemoController::get_data', array($videoLinkingController, 'get_data'));
add_action('wp_ajax_DemoController::delete_record', array($videoLinkingController, 'delete_record'));

