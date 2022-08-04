<style>
form .error {
  color: #ff0000;
}               
   
.article-content-outer-sidebar {
  margin: 0px 0px 0px 0px !important;
  padding-top: 0px !important;
}
.article-wrapper-outer {
  background:#FCFCFF !important;
}
.navtabs {
  border-style: solid;
  padding: 6px 3px 5px 10px !important;
  color: black;
  border-color: lightgray;
  border-width: 1px;
}
.card_style {    
  border-style: solid;
  color: black;
  border-width: 1px;
  background: #e5f4fe; 
  margin-bottom: 4px;
  border-color: gray;
  border-radius: 7px;
}
.nav>li>.active{
  background:brown !important;
  color: white !important;
}
.nav>li>a:focus{
  background:brown !important;
  color: white !important;
}

.user_dashboard_details_container{
  display: flex;
  width: 100%;
  padding: 5px;
  border-radius: 5px;
  background-color: white;
  box-shadow: 1px 1px 5px #777;
  flex-direction: column;

}
.dashborad_detials_header{
  border-radius: 5px;
  border: 0.5px solid #777;
  padding: 5px;
  display: flex;
  width: 100%;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
}
.dashborad_detials_header button{
  padding: 5px 10px;
  font-size: 18px;
  display: flex;
  align-items: center;
  border-radius: 5px;
  justify-content: center;
  box-sizing: border-box;
  background-color: white;
  line-height: 100%;
  border: 2px solid black;

}
.dashborad_detials_content{
  width: 100%;
  display: flex;
  flex-direction: column;
  padding: 10px;

}
.dashboard_details_table{
  width: 100%;
  display: flex;
  flex-direction: column;
}
.dashboard_details_table_header{
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  background-color: gray;
  display: flex;
  width: 100%;
  padding: 10px;
}
.dashboard_details_table_header span{
  display: flex;
  width: 100%;
  color: white;
  font-size: 18px;
  font-weight: bold;
}
.dashboard_details_table_body{
  display: flex;
  flex-direction: column;
  width: 100%;

}
.dashboard_details_table_row{
  width: 100%;
  display: flex;
  flex-direction: row;
  align-items: center;
  border: 0.5px soluid lightgray;
}
.dashboard_details_table_row:nth-child(even){
  background-color: white;
}
.dashboard_details_table_row:nth-child(odd){
  background-color: lightgray;
}
.dashboard_details_table_row span{
  display: flex;
  padding: 5px 10px;
}
.dashboard_details_table_tab_first{
  font-weight: bold;
  font-size: 18px;
  color: #000;
  display: flex;
  width: 200px;
}
.dashboard_details_table_tab_second{
  display: flex;
  flex: 1;
  font-size: 18px;
  text-align: left;
  color: #777;
}
.dashboard_details_table_tab_third{
  display: flex;
  font-size: 18px;
  width: 150px;
  text-align: left;
  color: blue;
}
.dash_board_profile_row{
  width: 100%;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
}
.dash_board_profile_image{
  width: 200px;
  justify-content: center;
  align-items: center;
}
.dash_board_profile_image img{
  width: 100%;
  height: auto;
}
.dash_board_profile_content {
  display: flex;
  flex-direction: column;
  flex: 1;

}
.dash_board_profile_content span{
  font-size: 18px;
  color: #777;
  width: 100%;
  text-align: left;
  display: flex;
  flex: 1;
  margin: 5px 0px;
}
.dash_board_profile_content .nickname{
  font-size: 22px;
  color: #000;

}
.dash_board_profile_calender{
  display: flex;
  justify-content: center;
  align-items: center;
  width: 120px;

}
.calender_box{
  width: 90px;
  height: 100px;
  flex-direction: column;
  display: flex;
}
.calender_title{
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: center;
  text-align: center;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 3px 0px;
  font-size: 16px;
  color: white;
  background-color: gray;
}
.calender_body{
  background-color: lightgray;
  padding: 3px 0px;
  width: 100%;
  display: flex;
  flex-direction: column;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
}
.calender_body span{
  display: flex;
  width: 100%;
  padding: 2px;
  font-size: 14px;
  color: #000;
  text-align: center;
  justify-content: center;
  align-items: center;
}
.calender_body h1{
  display: flex;
  margin: 0px;
  width: 100%;
  margin-top: 3px;

  justify-content: center;
  align-items: center; 
  font-size: 20px;
  color: #000;
  text-align: center;
}
.show {
  opacity: 0.6;
}
.ays_cb_and_a {
  display: none !important;    
}
.ays_average {
  display: none !important;     
}          
</style>

<div id="loader" style="z-index:9999999999;"></div>


<!--========================================================================================================= -->
<div class="container-fluid" style="margin: 20px;min-height: 700px;">
  <!-- Nav tabs -->
  <ul class="nav nav-pills nav-stacked col-md-3">
    <li><a href="#tab_f" data-toggle="pill" class="navtabs active"><i class="fas fa-camera-retro"></i> Dashboard</a></li>    
    <li><a href="#tab_a" id="tab_video" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Watch more earn more</a></li>
    <li><a href="#tab_b" data-toggle="pill" class="navtabs"><i class="fab fa-paypal"></i> Paypal Email</a></li>
    <li><a href="#tab_c" data-toggle="pill" class="navtabs"><i class="far fa-credit-card"></i> Video Status</a></li>
    <!-- <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li> -->
  </ul>
  <div class="tab-content col-md-9">
  

    <div class="tab-pane active" id="tab_f">
      <h3 style="margin-top: 0px; margin-left: 10px;">Watch More Earn More</h3>
      <div class="card card_style" style="min-height: 130px;">

        <div class="dash_board_profile_row">
          <div class="dash_board_profile_image">
            <img class="card-img" src="<?php echo plugins_url('/video_quiz_linking/assets/images/user.png')?>" alt="" style="width:50%">
          </div>
          <div class="dash_board_profile_content">
            <span class="nickname"><?php echo $nicename; ?></span>
            <span class="">Members Since : <?php echo date("F, d Y",strtotime($createdDate)); ?></span>
            <span class="">Membership : Standard</span>
          </div>
          <div class="dash_board_profile_calender">
            <div class="calender_box">
              <div class="calender_title">
                <?php echo date ('F'); ?>
              </div>
              <div class="calender_body">
                <span><?php echo date ('l'); ?></span>
                <h1><?php echo date ('d'); ?></h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="user_dashboard_details_container">
        <div class="dashborad_detials_header">
          <button><a href="javascript:void(0);<?php //echo site_url('?page_id=15846'); ?>">User Details</a></button>
        </div>    
        <div class="dashborad_detials_content">
          <div class="dashboard_details_table">
            <div class="dashboard_details_table_header">
              <span>Earning Balance Stats</span>
            </div>
            <div class="dashboard_details_table_body">
              <div class="dashboard_details_table_row">
                <span class="dashboard_details_table_tab_first">Balance</span>
                <?php  $balanceUsd = (($balance * USD_REWARD) / POINT_REWARD); ?>
                <!-- <span class="dashboard_details_table_tab_second"><?php echo $balance; ?> Points <?php echo number_format((float)$balanceUsd, 2, '.', '');?> $)</span> -->
                <span class="dashboard_details_table_tab_second"><?php echo $balance; ?> Points </span>
                <span style="float:right;color: blue;cursor: pointer;" onclick="withdraw();">
                  [Redeem] 
                </span>
              </div>   
              <div class="dashboard_details_table_row">
                <span class="dashboard_details_table_tab_first">Pending Withdrawls</span>
                <span class="dashboard_details_table_tab_second">
                <?php 
                  $withdrawalPending = array_sum($withDrawalPending); 
                  $withdrawalPendingUsd = array_sum($withDrawalPendingUsd); 
                  $withdrawalPending = number_format((float)$withdrawalPending, 2, '.', '');
                  echo $withdrawalPending;   
                // ?>
                 <!-- Points ( <?php echo number_format((float)$withdrawalPendingUsd, 2, '.', '') ?> $ )</span> -->
                 Points </span>
              </div>
              <div class="dashboard_details_table_row">
                <span class="dashboard_details_table_tab_first">Points Earned</span>
                <span class="dashboard_details_table_tab_second">
                  <?php 
                    $withDrawalAccepted = array_sum($withDrawalAccepted); 
                    $withDrawalAcceptedUsd = array_sum($withDrawalAcceptedUsd); 
                    $withDrawalAccepted = number_format((float)$withDrawalAccepted, 2, '.', '');
                    echo $withDrawalAccepted;
                  ?> Points
                  </span>
              </div>
            </div>
          </div>


          <div class="dashboard_details_table" style="margin-top:20px">
            <div class="dashboard_details_table_header">
              <span>Video Ads Stats</span>
            </div>
            <div class="dashboard_details_table_body">
              <div class="dashboard_details_table_row">
                <span class="dashboard_details_table_tab_first">Total Plays</span>
                <span class="dashboard_details_table_tab_second"><?php echo count($userquizSqlData); ?></span>
              </div>
              <div class="dashboard_details_table_row">
                <span class="dashboard_details_table_tab_first">Earned</span>
                <span class="dashboard_details_table_tab_second">
                  <?php 
                  $totalAmount = array_sum($totalAmount); 
                  $totalAmount = number_format((float)$totalAmount, 2, '.', '');
                  // $withDrawalAcceptedUSD = (($withDrawalAccepted * USD_REWARD) / POINT_REWARD);
                  //echo $totalAmount;  
                  echo $withDrawalAccepted;
                  // ?>  Points  </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane" id="tab_a">
      <?php if (!empty($frontendQuizData)) { ?>
        <h3 style="margin-top: 0px; margin-left: 10px;">Watch More Earn More</h3>
        <div class="card card_style" style="min-height: 130px;">
          <div class="dash_board_profile_row">
            <div class="dash_board_profile_image">
              <img class="card-img" src="<?php echo plugins_url('/video_quiz_linking/assets/images/user.png')?>" alt="" style="width:50%">
            </div>
            <div class="dash_board_profile_content">
              <span class="nickname"><?php echo $nicename; ?></span>
              <span class="">Members Since : <?php echo date("F, d Y",strtotime($createdDate)); ?></span>
              <span class="">Membership : Standard</span>
            </div>
            <div class="dash_board_profile_calender">
              <div class="calender_box">
                <div class="calender_title">
                  <?php echo date ('F'); ?>
                </div>
                <div class="calender_body">
                  <span><?php echo date ('l'); ?></span>
                  <h1><?php echo date ('d'); ?></h1>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="videoID_<?php echo $frontendQuizData->id; ?>">
          <video id="linkVid_<?php echo $frontendQuizData->id; ?>" data_id="<?php echo $frontendQuizData->id; ?>" class="linkVid" width="320" height="500" controlsList="nodownload noplaybackrate" disablePictureInPicture disablePlaybackRate noplaybackrate style="<?php echo $style; ?>" controls style="pointer-events: none;">                  
            <source src="<?php echo $frontendQuizData->link; ?>">     
              Your browser does not support the video tag.
            </video>     
          </div>
          <div id="quizID_<?php echo $frontendQuizData->id; ?>" style="display: none;">
            <?php echo do_shortcode('[ays_quiz id="' . $frontendQuizData->quiz_id . '"]'); ?>
          </div>
        <?php } else { ?>
          <h3>No video found</h3>
        <?php } ?>
      </div>

      <div class="tab-pane" id="tab_b">
        <div class="page-login-form box">
          <!-- <h3> Add Paypal Email </h3> -->
          <form onsubmit="return false" method="POST" name="paypalEmailForm" id="paypalEmailForm">
            <input type="hidden" name="action" value="VideoLinkingController::insert_paypalEmail">
            <div class="form-group">
              <div class="input-icon">
                <i class="lni-user"></i>
                <input type="text" id="paypalEmail" readonly="" class="form-control" name="paypalEmail" placeholder="Enter Paypal Email" value="<?php echo $paypalEmail; ?>">
              </div> 
            </div>
            <button class="btn log-btn" disabled="" style="color:#4f4047; background-color:#d8d1d1;" id="paypalEmail_btn">Submit</button>
          </form>
        </div>
      </div>
      <div class="tab-pane" id="tab_c">
        <table id="videoPaymentDataTable" class="table table-striped table-bordered" style="width:100% ; font-size:15px; color:black;">
          <thead>
            <tr>
              <!-- <th>User</th> -->
              <th>Title</th>
              <!-- <th>Paid Status</th> -->
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($userquizSqlData)) {
              foreach ($userquizSqlData as $key => $value) {
                $status = 'Rewards not earned';
                if ($value->status == '1') {
                  $status = 'Rewards earned';
                }  
                $is_paid = 'No';
                if ($value->is_paid == '1') {
                  $is_paid = 'Yes';
                }
                $newDate = date("d, F Y", strtotime($value->created_at));
                ?>
                <tr>
                  <!-- <td><?php echo $value->user_nicename; ?></td> -->
                  <td><?php echo ucfirst($value->video_name); ?></td>
                  <!-- <td><?php echo $is_paid; ?></td> -->
                  <td><?php  echo $status; ?></td> 
                  <td><?php echo $newDate; ?></td>
                </tr>
              <?php }
            } else { ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div><!-- tab content -->
  </div>

  <script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var siteurl = "<?php echo site_url('/dashboard?tab=2'); ?>";
    var is_video = 0;
    <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab'] == '2') { ?>
    var is_video = 1;
    <?php } ?>     
  </script>    



  <div class="modal" id="widthdrawMoney" role="dialog" style="opacity: 1.3;">  
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">      
          <div class="form-group">
            <label for="exampleInputEmail1">Amount($)</label>
            <input type="text" class="form-control" id="amountWidthDraw" placeholder="Enter amount" value="<?php echo $balance; ?>">
            <input type="hidden" class="form-control" id="amountWidthDrawUsd" value="<?php echo number_format((float)$balanceUsd, 2, '.', '');?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="submitAmount();">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
