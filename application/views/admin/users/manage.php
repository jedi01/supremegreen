
<div class="app-content content">
  <div class="content-wrapper">
    <!-- Breadcrum -->
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Users</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a> </li>
              <li class="breadcrumb-item"><a href="javascript:;">User</a> </li>
            </ol>
          </div>
        </div>
      </div>
      
    </div>
    <!-- Breadcrum End -->
    <section id="basic-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" id="bordered-layout-basic-form">User Info</h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collpase show">
              <div class="card-body">
                <div class="card-text">
                  <p></p>
                </div>
                <form class="form-horizontal form-bordered" novalidate enctype="multipart/form-data" action="<?php echo base_url('admin/users/manage'); ?>" method="POST" >
                  <div class="form-body">
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="name">User Name</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="User Name" name="name" id="name" value="<?php if(isset($user)){ echo $user->name;} ?>" > </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="email">User Email</label>
                      <div class="col-md-9">
                        <input type="email" required  class="form-control" placeholder="User Email" name="email" id="email" value="<?php if(isset($user)){ echo $user->email;} ?>" > </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="city">User City</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="User City" name="meta[city]" id="city" value="<?php if(isset($user) && !empty($user->city)){ echo $user->city;} ?>" > </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="state">User State</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="User State" name="meta[state]" id="state" value="<?php if(isset($user) && !empty($user->state)){ echo $user->state;} ?>" > </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="country">Country</label>
                      <div class="col-md-9">
                        <select name="meta[country]" id="country" required class="form-control select2">
                          <option value="none" selected="" disabled="">Country</option>
                         <?php
                            foreach ($countries as $key => $value) { ?>

                              <option value="<?php echo  $value->iso;  ?>"
                                <?php if(isset($user) && !empty($user->country)){ if($value->iso == $user->country){ echo "selected"; } } ?>>
                                <?php echo $value->name; ?>
                                  
                                </option>
                              
                          <?php } ?>                           
                        </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="street">User Street</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="User Street" name="meta[street]" id="street" value="<?php if(isset($user) && !empty($user->street)){ echo $user->street;} ?>" > </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="houseno">User House #</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="User House #" name="meta[houseno]" id="houseno" value="<?php if(isset($user) && !empty($user->houseno)){ echo $user->houseno;} ?>" > </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="zip">User Zip</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="User Zip" name="meta[zip]" id="zip" value="<?php if(isset($user) && !empty($user->zip)){ echo $user->zip;} ?>" > </div>
                    </div>

                  <?php if(isset($user)){?>
                    <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                  <?php } ?>

                
                  </div>
             
                  <div class="form-actions">
                    <button type="button" class="btn btn-warning mr-1"> <i class="ft-x"></i> Cancel </button>
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


