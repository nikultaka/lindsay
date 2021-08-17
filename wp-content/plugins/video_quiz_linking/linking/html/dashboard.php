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
</style>

<div id="loader" style="z-index:9999999999;"></div>

<!--========================================================================================================= -->
<div class="container-fluid" style="margin: 20px;min-height: 700px;">
  <!-- Nav tabs -->
  <ul class="nav nav-pills nav-stacked col-md-3">
    <li><a href="#tab_f" data-toggle="pill" class="navtabs active"><i class="fas fa-camera-retro"></i> Global</a></li>    
    <li><a href="#tab_a" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> See video</a></li>
    <li><a href="#tab_b" data-toggle="pill" class="navtabs"><i class="fab fa-paypal"></i> Paypal Email</a></li>
    <li><a href="#tab_c" data-toggle="pill" class="navtabs"><i class="far fa-credit-card"></i> Payment Status</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
    <li><a href="#tab_d" data-toggle="pill" class="navtabs"><i class="fas fa-camera-retro"></i> Video Ads</a></li>
  </ul>
  <div class="tab-content col-md-9">

    <div class="tab-pane active" id="tab_f">
      <h3 style="margin-top: 0px; margin-left: 10px;">Watch More Earn More</h3>
        <div class="card card_style" style="min-height: 130px;">
            <div class="row no-gutters">
                <div class="col-sm-3">
                    <img class="card-img" src="<?php echo plugins_url('/video_quiz_linking/assets/images/user.png')?>" alt="" style="width:50%">
                </div>    
                <div class="col-sm-7">
                    <div class=""><?php echo $nicename; ?></div>
                    <div class="">Members Since : <?php echo date("F, d Y",strtotime($createdDate)); ?></div>
                    <div class="">Membership : Standard</div>
                </div>
            </div>
        </div>

        <div class="user_dashboard_details_container">
          <div class="dashborad_detials_header">
            <button><a href="<?php echo site_url('?page_id=15859'); ?>">User Details</a></button>
          </div>    
          <div class="dashborad_detials_content">
            <div class="dashboard_details_table">
                <div class="dashboard_details_table_header">
                  <span>Earning Balance Stats</span>
                </div>
                <div class="dashboard_details_table_body">
                  <div class="dashboard_details_table_row">
                    <span class="dashboard_details_table_tab_first">Balance</span>
                    <span class="dashboard_details_table_tab_second">$<?php echo $balance; ?></span>
                  </div>   
                  <div class="dashboard_details_table_row">
                    <span class="dashboard_details_table_tab_first">Payments Received</span>
                    <span class="dashboard_details_table_tab_second">$<?php echo $received; ?></span>
                  </div>
                  <div class="dashboard_details_table_row">
                    <span class="dashboard_details_table_tab_first">Pending Withdrawls</span>
                    <span class="dashboard_details_table_tab_second">$<?php echo $pending; ?></span>
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
                    <span class="dashboard_details_table_tab_second">$<?php echo $received; ?></span>
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
            <div class="row no-gutters">
                <div class="col-sm-5">
                    <img class="card-img" src="<?php echo plugins_url('/video_quiz_linking/assets/images/user.png')?>" alt="" style="width:50%">
                </div>
                <?php if(!empty($postData)) { ?>
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $postData->post_title; ?></h5>
                        <p class="card-text"><?php echo $postData->post_content; ?></p>
                        <!-- <a href="#" class="btn btn-primary float-right">View Profile</a> -->
                    </div>
                </div>
              <?php } ?>
            </div>
        </div>

        <div id="videoID_<?php echo $frontendQuizData->id; ?>">
          <video id="linkVid_<?php echo $frontendQuizData->id; ?>" data_id="<?php echo $frontendQuizData->id; ?>" class="linkVid" width="320" height="500" controls style="<?php echo $style; ?>">
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
            <th>User</th>
            <th>Video Title</th>
            <th>Paid Status</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($userquizSqlData)) {
            foreach ($userquizSqlData as $key => $value) {
              $status = 'Inactive';
              if ($value->status == '1') {
                $status = 'Active';
              }  
              $is_paid = 'No';
              if ($value->is_paid == '1') {
                $is_paid = 'Yes';
              }
              $newDate = date("F j, Y", strtotime($value->created_at));
          ?>
              <tr>
                <td><?php echo $value->user_nicename; ?></td>
                <td><?php echo ucfirst($value->video_name); ?></td>
                <td><?php echo $is_paid; ?></td>
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
  
</script>