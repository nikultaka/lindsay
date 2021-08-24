<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<style>
section.pricing {
    background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF);
}

.pricing .card {
    border: none;
    border-radius: 1rem;
    transition: all 0.2s;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
    margin: 1.5rem 0;
}

.pricing .card-title {
    margin: 0.5rem 0;
    font-size: 0.9rem;
    letter-spacing: .1rem;
    font-weight: bold;
}

.pricing .card-price {
    font-size: 3rem;
    margin: 0;
}

.pricing .card-price .period {
    font-size: 0.8rem;
}

.pricing ul li {
    margin-bottom: 1rem;
}

.pricing .text-muted {
    opacity: 0.7;
}

.pricing .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    opacity: 0.7;
    transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
    .pricing .card:hover {
        margin-top: -.25rem;
        margin-bottom: .25rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
    }

    .pricing .card:hover .btn {
        opacity: 1;
    }
}
.wpeppsub_paypalbuttonimage {
    background-color: white !important;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://www.paypal.com/sdk/js?client-id=AcS1rDqcqURwDJzNP0vnl_qMxqm5rixVvlf8PRdc_X4JCEgRIoy_FX25Si5ySQOlI_x_3OnIrcWsQ0Kz&vault=true&intent=subscription"></script> 


<div id="loader" style="z-index:9999999999;"></div>

<section class="pricing py-5">
  <div class="container">
    <div class="row">
      <!-- Free Tier -->
      <div class="col-lg-4" style="margin: auto;">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Subscription</h5>
            <h6 class="card-price text-center">$20<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Watch Video & Earn</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Payment Reports</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Statistics</li>
          </ul>
          <div class="d-grid" style="background-color:white !important;">
              <!-- <a href="#" class="btn btn-primary text-uppercase"> -->
                  <?php //echo do_shortcode('[wpeppsub id=15831]'); ?>  
                  <!-- </a> -->
                  <div id="paypal-button-container"></div>
              </div>
          </div>
      </div>
  </div>
  <!-- Plus Tier -->

  <!-- Pro Tier -->

</div>
</div>
</section>

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    paypal.Buttons({
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          'plan_id': '<?php echo $planID; ?>'
      });            
    },  
    onApprove: function(data, actions) {
        console.log(data);  
        //alert('You have successfully created subscription ' + data.subscriptionID);
        savePaypalID(data.subscriptionID);
    }
}).render('#paypal-button-container');
</script>  