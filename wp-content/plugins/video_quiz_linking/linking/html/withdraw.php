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
    <div class="col-md-12">&nbsp;</div>
  </div>   
      
  <div class="row">   
    <div class="col-md-12">
      <h2>Withdraw Actions</h2>
    </div>         
  </div>

  <div class="row my-2">   
    <div class="col-md-12 pr-2">
      <!-- <button type="button" class="btn btn-primary pull-left" style="margin-right: 10px;" onclick="doMassPayment();">Mass Payment</button>     -->
      <button type="button" class="btn btn-success pull-left" onclick="exportCsv();">Export Csv</button>    
    </div>       
  </div>


  <table id="example" class="display table table-bordered" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th>Id</th>
        <th>User</th>
        <th>Amount</th>
        <th>Point</th>
        <th>Status</th>
        <th>Payout Type</th>
        <th>Created At</th>
        <!-- <th>Action</th> -->
      </tr>
    </thead>
    <tbody>
     <?php 
     $totalAmount = 0;
     if(!empty($tableData)) { 
      foreach($tableData as $key => $value) { 
        $status = 'Paid';
        if($value->is_paid == '0') {
          $status = 'Processing';
          $totalAmount+=$value->amount;    
        }     
        
        ?>
        <tr>
          <td><?php echo $value->id; ?></td>
          <td><?php echo $value->display_name; ?></td>
          <td><?php echo $value->amount_usd; ?> $</td>
          <td><?php echo $value->amount; ?></td>
          <td><?php echo $status; ?></td>      
          <td><?php echo isset($value->payout_by) && $value->payout_by != '' ? ucwords($value->payout_by) : '-'; ?></td>      
          <td><?php echo date("d F Y",strtotime($value->created_at)); ?></td>      
          <!-- <td>
            <?php if($status == 'Processing') { ?>
            <button type="button" class="btn btn-primary" onclick="doMassPayment(<?php echo $value->id; ?>);">Send Payment</button>
            <?php } ?>
          </td>            -->
        </tr>  
      <?php } } else { ?>  


      <?php } ?>  
    </tbody>
    <tfoot>
      <tr>
        <th>Id</th>
        <th>User</th>
        <th>Amount</th>
        <th>Point</th>
        <th>Status</th>
        <th>Payout Type</th>
        <th>Created At</th>
        <!-- <th>Action</th> -->
      </tr>          
    </tfoot>
  </table>   

  <script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var plugins_url = "<?php echo plugins_url('/video_quiz_linking/linking/html/csv_export.php') ?>";
    var totalAmount = "<?php echo $totalAmount; ?>";
    function exportCsv(){
      var conf = confirm("Export users to CSV?");
            if(conf == true)
            {
                window.open(plugins_url, '_blank');
                window.location.reload(true);
            }
    }
  </script>