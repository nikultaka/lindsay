    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <style>
    form .error {
      color: #ff0000;
    }
    .has-error {
      border-color: red !important ;
    }
    .loading {
      position: relative;
      text-align: center;
      line-height: 140px;
      vertical-align: middle;
    }
  </style>
  <!-- Modal -->
  <div id="loader" style="z-index:9999999999;"></div>


  <div class="row">
    <div class="col-md-6">
      <h1>Settings</h1>
      <form id="formdata">
        <div class="form-group">
          <label">Client ID</label>
          <input type="text" class="form-control" name="client_id" id="client_id" value="<?php echo $client_id; ?>">
          <input type="hidden" name="action" value="VideoLinkingController::save_settings">
        </div>
        <div class="form-group">
          <label">Secret ID</label>
          <input type="text" class="form-control" name="secret_id" id="secret_id" value="<?php echo $secret_id; ?>">
        </div>
        <div class="form-group">
          <label">Business ID</label>
          <input type="text" class="form-control" name="business_id" id="business_id" value="<?php echo $business_id; ?>">
        </div>
        <div class="form-group">
          <label">Business Password</label>
          <input type="text" class="form-control" name="business_password" id="business_password" value="<?php echo $business_password; ?>">
        </div>
        <div class="form-group">
          <label">Business Signature</label>
          <input type="text" class="form-control" name="business_signature" id="business_signature" value="<?php echo $business_signature; ?>">
        </div>
        <div class="form-group">
          <label">Amount</label>
          <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $amount; ?>">  
        </div>
        <button type="button" class="btn btn-primary" onclick="saveSettings();">Submit</button>
      </form>
    </div>
  </div>





  <script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>