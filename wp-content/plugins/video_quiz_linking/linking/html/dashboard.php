<style>
  form .error {
    color: #ff0000;
  }

  .article-content-outer-sidebar {
    margin: 0px 0px 0px 0px !important;
    padding-top: 0px !important;
  }
  .article-wrapper-outer {
    background:#FCFCFC !important;
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
    border-color: lightgray;
    border-width: 1px;
    background: #BCC6CC;
    margin-bottom: 4px;
  }
  .nav>li>a:active{
    background:brown !important;
    color: white !important;
  }
  .nav>li>a:focus{
    background:brown !important;
    color: white !important;
  }
</style>

<!--========================================================================================================= -->
<div class="container-fluid" style="margin: 20px;">
  <!-- Nav tabs -->
  <ul class="nav nav-pills nav-stacked col-md-3">
    <li><a href="#tab_a" data-toggle="pill" class="active navtabs"><i class="fas fa-camera-retro"></i> See video</a></li>
    <li><a href="#tab_b" data-toggle="pill" class="navtabs"><i class="fab fa-paypal"></i> Paypal Email</a></li>
    <li><a href="#tab_c" data-toggle="pill" class="navtabs"><i class="far fa-credit-card"></i> Payment Status</a></li>
  </ul>
  <div class="tab-content col-md-9">
    <div class="tab-pane active" id="tab_a">
      <h3>Watch More Earn More</h3>
      <div class="card card_style" >
            <div class="row no-gutters">
                <div class="col-sm-5">
                    <img class="card-img" src="/images/defaultimg.png" alt="Suresh Dasari Card">
                </div>
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title">Suresh Dasari</h5>
                        <p class="card-text">Suresh Dasari is a founder and technical <br>lead developer in tutlane.</p>
                        <!-- <a href="#" class="btn btn-primary float-right">View Profile</a> -->
                    </div>
                </div>
            </div>
        </div>
      <?php if (!empty($frontendQuizData)) { ?>
        <div id="videoID_<?php echo $frontendQuizData->id; ?>">
          <video id="linkVid_<?php echo $frontendQuizData->id; ?>" data_id="<?php echo $frontendQuizData->id; ?>" class="linkVid" width="320" height="550" controls style="<?php echo $style; ?>">
            <source src="<?php echo $frontendQuizData->link; ?>">
            Your browser does not support the video tag.
          </video>
        </div>
        <div id="quizID_<?php echo $frontendQuizData->id; ?>" style="display: none;">
          <?php echo do_shortcode('[ays_quiz id="' . $frontendQuizData->quiz_id . '"]'); ?>
        </div>
      <?php } else { ?>
        <p>No video found</p>
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
              <input type="text" id="paypalEmail" class="form-control" name="paypalEmail" placeholder="Enter Paypal Email" value="<?php echo $paypalEmail; ?>">
            </div>
          </div>
          <button class="btn log-btn" style="color:#4f4047; background-color:#d8d1d1;" id="paypalEmail_btn">Submit</button>
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
            <!-- <th>Status</th> -->
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
              $is_paid = 'NO';
              if ($value->is_paid == '1') {
                $is_paid = 'YES';
              }
              $newDate = date("F j, Y", strtotime($value->created_at));
          ?>
              <tr>
                <td><?php echo $value->user_nicename; ?></td>
                <td><?php echo ucfirst($value->video_name); ?></td>
                <td><?php echo $is_paid; ?></td>
                <!-- <td><?php // echo $status; ?></td> -->
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