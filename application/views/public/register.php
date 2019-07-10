
<style type="text/css">
.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);

}
.error{
    color: red;
}
</style>
<body style="display: grid;">
    <div class="container" style="display: grid;align-items: center; text-align: center;">

        <div class="row" style="justify-content: center;">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
              <form role="form" class="form-horizontal" id="register-form" action="<?php echo base_url('registration/manage'); ?>" method="POST">
                 <h2> Supreme Green </h2>
                 <hr class="colorgraph">
             <div class="form-group">
                <input type="text" name="name"  id="name" class="form-control input-lg" placeholder="Full Name" tabindex="3">
            </div>
            
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
               <div class="form-group">
                <input type="email" name="email"  id="email" class="form-control input-lg" placeholder="Email Address" tabindex="5">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
             <div class="form-group">
              <input type="tel" name="meta['phone']"  id="phone" class="form-control input-lg" placeholder="Phone" tabindex="6">
            </div>
            <input type="hidden" name="role" value="user">
          </div>
        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                   <div class="form-group">
                      <input type="password" name="password"  id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
               <div class="form-group">
                  <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
              </div>
              <input type="hidden" name="role" value="user">
          </div>
      </div>

      <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                   <div class="form-group">
                      <input type="text" name="meta[city]"  id="city" class="form-control input-lg" placeholder="City" tabindex="5">
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
               <div class="form-group">
                  <input type="text" name="meta[state]"  id="state" class="form-control input-lg" placeholder="State" tabindex="6">
              </div>
          </div>
      </div>

      <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                   <div class="form-group">
                      <input type="text" name="meta[street]"  id="street" class="form-control input-lg" placeholder="Street" tabindex="5">
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
               <div class="form-group">
                  <input type="text" name="meta[houseno]"  id="house" class="form-control input-lg" placeholder="House Number" tabindex="6">
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
         <div class="form-group">
          <select name="meta[country]" id="country" class="form-control input-lg"  tabindex="5">
            <option value="" disabled="" selected="">Select Country</option>
            <?php
              foreach ($countries as $key => $value) { ?>
                <option value="<?php echo $value->iso; ?>"><?php echo $value->name; ?></option>
              <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
       <div class="form-group">
        <input type="text" name="meta[zip]"  id="zip" class="form-control input-lg" placeholder="Zip Code" tabindex="6">
      </div>
    </div>
  </div>


      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-12"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
        <div class="col-xs-12 col-md-12">
          Already have account? <a href="<?php echo base_url('login/user'); ?>">Sign In</a>
        </div>
    </div>
</form>
</div>
</div>

</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#register-form').validate({
        rules: {
            name: "required",
            email: "required",
            password: "required",
            password_confirmation: {required:true, equalTo: "#password"},
            country:"required",
            zip:"required",
            house:"required",
            street:"required",
            state:"required",
            city:"required",
            phone:"required",

        },


    });
});

</script>
