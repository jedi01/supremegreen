<!DOCTYPE html>
<html>
<head>

  <title><?php echo $title; ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" href="css/animate.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/customScript.js"></script>


  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      $(".form").validate();


    });

  </script>
  <style type="text/css">
    .error{

      color: red;
    }

    .error:focus {
    border-color: red !important;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
    -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/toastr.css">
<script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
<script type="text/javascript">
        
      function toasterOptions() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "2000",
            "timeOut": "3000",
            "extendedTimeOut": "2000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
      };
      
      toasterOptions();
    </script>
</head>


<body >
  <?php if($this->session->flashdata('error')) { ?>
<script type="text/javascript">
  toastr.error('<?php echo $this->session->userdata("error"); ?>');
</script>

<?php } ?>


  <div class="container mt-4">
    <?php 
    $order = $this->session->userdata("order_cart");
    if(empty($order))
    {
      $redirect_url = base_url()."order";
      redirect($redirect_url);
    } 
    $sum = 0; 
    ?>
    <div class=" text-center">

      <h2 class="pb-5">Checkout form</h2>

    </div>
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>

          <span class="badge badge-secondary badge-pill"><?php echo sizeof($order); ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php 
          foreach ($order as $key => $value) {
            if(!empty($value['qty']))
            {  
              $qty = $value['qty']; 
            }
            else
            {
              $qty = 1; 
            }
            $odr_pr = $value['order_price'];
              if($value['order_category'] == "drinks"){
                $odr_pr = $value['order_price']/$qty;
              }
            ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $value['order_name']; ?></h6>
                <small class="text-muted">Qty <span class="badge badge-secondary badge-pill"><?php echo $qty; ?></span></small>
              </div>
              <span class="text-muted">$<?php echo $odr_pr*$qty; ?></span>
            </li>
            <?php 
            if($value['order_category'] == "drinks"){
                $sum += $odr_pr*$value['qty'];
            }else{
              $sum += $odr_pr; 
            }
        }
    
           ?>


            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$<?php if(empty($this->session->userdata("order_price"))){ echo $sum; }else{ echo $this->session->userdata("order_price"); } ?></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="form" method="POST" novalidate action="<?php echo base_url('Ingenico/methods'); ?>" >
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="<?php if(!empty($user->name)){ echo $user->name; } ?>" required>
                <div class="invalid-feedback">
                  Valid Name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="firstName">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php if(!empty($user->email)){ echo $user->email; } ?>" required>
                <div class="invalid-feedback">
                  Valid Email is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="firstName">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="" value="<?php if(!empty($user->phone)){ echo $user->phone; } ?>" required>
                <div class="invalid-feedback">
                  Valid Phone is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="" value="<?php if(!empty($user->city)){ echo $user->city; } ?>" required>
                <div class="invalid-feedback">
                  Valid City is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="state">State</label>
                <input type="text" class="form-control" name="state" id="state" placeholder="" value="<?php if(!empty($user->state)){ echo $user->state; } ?>" required>
                <div class="invalid-feedback">
                  Valid State is required.
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="countryCode">Country</label>
                <select class="form-control" name="countryCode" id="countryCode" required>
                   <option value="" selected="" disabled="">Select Country</option>
                  <?php foreach ($countries as $key => $value) 
                  { ?>
                    <option value="<?php echo  $value->iso; ?>" <?php if(isset($user->country)){ if($user->country == $value->iso){ echo "selected"; }  } ?>>
                      <?php echo  $value->name; ?>
                  </option>
                  <?php
                  } ?>
                  
                </select>
                <div class="invalid-feedback">
                  Valid Country is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="street">Street</label>
                <input type="text" class="form-control" name="street" id="street" placeholder="" value="<?php if(isset($user->street)){ echo $user->street; } ?>" required>
                <div class="invalid-feedback">
                  Valid Street is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="houseNumber">House Number</label>
                <input type="number" class="form-control" name="houseNumber" id="houseNumber" placeholder="<?php if(isset($user->houseno)){ echo $user->houseno; } ?>" value="<?php if(isset($user->houseno)){ echo $user->houseno; } ?>" required>
                <div class="invalid-feedback">
                  Valid House# is required.
                </div>
              </div>          

              <div class="col-md-6 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" id="zip" placeholder="" value="<?php if(isset($user->zip)){ echo $user->zip; } ?>" required>
                <div class="invalid-feedback">
                  Valid Zip is required.
                </div>
              </div>
            </div>

            <input type="hidden" name="total_price" value="<?php if(empty($this->session->userdata('order_price'))){ echo $sum; }else{ echo $this->session->userdata('order_price'); } ?>">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        </div>
      </div>
    </div>
  </body>
  </html>