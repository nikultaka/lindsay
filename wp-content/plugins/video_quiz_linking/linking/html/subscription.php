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




  <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Username</th>
        <th>Subscription ID</th>
      </tr>
    </thead>
    <tbody>
     <?php if(!empty($membershipData)) { 
      foreach($membershipData as $key => $value) {
        ?>
        <tr>
          <td><?php echo $value->display_name; ?></td>
          <td><?php echo $value->subscription_id; ?></td>
        </tr>  
      <?php } } else { ?>  


      <?php } ?>  
    </tbody>
    <tfoot>
      <tr>
        <th>Username</th>
        <th>Subscription ID</th>
      </tr>
    </tfoot>
  </table>   

  <script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>