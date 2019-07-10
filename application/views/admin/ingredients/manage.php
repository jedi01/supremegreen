
<div class="app-content content">
  <div class="content-wrapper">
    <!-- Breadcrum -->
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Ingredients</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a> </li>
              <li class="breadcrumb-item"><a href="javascript:;">Ingredients</a> </li>
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
              <h4 class="card-title" id="bordered-layout-basic-form">Ingredients Info</h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
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
                <form class="form-horizontal form-bordered" novalidate enctype="multipart/form-data" action="<?php echo base_url('admin/ingredients/manage'); ?>" method="POST" >
                  <div class="form-body">
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="cat_pro_name">Ingredients Name</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="Ingredients Name" name="cat_pro_name" id="cat_pro_name" value="<?php if(isset($product)){ echo $product->cat_pro_name;} ?>" > </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="cat_pro_price">Ingredients Price</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" pattern="^\d*(\.\d{0,2})?$"  placeholder="Ingredients Price" name="cat_pro_price" id="cat_pro_price" value="<?php if(isset($product)){ echo $product->cat_pro_price;} ?>" > </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="cat_pro_category">Ingredients Category</label>
                      <div class="col-md-9">
                        <select name="cat_pro_category" id="cat_pro_category" required class="form-control select2">
                          <option value="none" selected="" disabled="">Ingredients Category</option>
                         <?php
                            foreach ($categories as $key => $value) { ?>

                              <option value="<?php echo $value->cat_id; ?>" <?php if(isset($product)){ echo ($value->cat_id == $product->cat_pro_category)?"selected":"" ;} ?>><?php echo $value->name; ?></option>
                              
                          <?php } ?>                           
                        </select>
                      </div>
                    </div>

                    
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="cat_pro_image">Ingredients Image</label>
                      <div class="col-md-9">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" <?php if(!isset($product)){ echo "required" ;} ?> name="cat_pro_image" id="cat_pro_image">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                    if(isset($product)) { ?>
                      <input type="hidden" name="cat_pro_id" value="<?php echo $product->cat_pro_id ?>">
                      <input type="hidden" name="perv_image" value="<?php echo $product->cat_pro_image ?>">
                   <?php } ?>
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


