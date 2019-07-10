
<div class="app-content content">
  <div class="content-wrapper">
    <!-- Breadcrum -->
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Category</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a> </li>
              <li class="breadcrumb-item"><a href="javascript:;">Category</a> </li>
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
              <h4 class="card-title" id="bordered-layout-basic-form">Category Info</h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
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
                <form class="form-horizontal form-bordered" novalidate action="<?php echo base_url('admin/category/manage'); ?>" method="POST" >
                  <div class="form-body">
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="name">Category Name</label>
                      <div class="col-md-9">
                        <input type="text" id="name" class="form-control" placeholder="Category Name" name="name" value="<?php if(isset($category)){ echo $category->name;} ?>" required data-validation-required-message="This field is required"> </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="parent">Parent Category</label>
                      <div class="col-md-9">
                        <select id="parent" name="parent" class="form-control select2" required data-validation-required-message="This field is required" >
                          <option value="none" selected="" disabled="">Parent Category</option>
                          <?php
                            foreach ($categories as $key => $value) { ?>

                              <option value="<?php echo $value->cat_id; ?>" <?php if(isset($category)){ echo ($value->cat_id == $category->parent)?"selected":"" ;} ?>><?php echo $value->name; ?></option>
                              
                          <?php } ?>
                          
                        </select>
                      </div>
                    </div>

                    <div class="custom_made">
                      <div class="form-group row">
                      <label class="col-md-3 label-control" for="basePrice">Base Price</label>
                      <div class="col-md-9">
                        <input type="text" id="basePrice" class="form-control" placeholder="Category Base Price" name="basePrice" value="<?php if(isset($category)){ echo $category->basePrice;} ?>"> </div>
                    </div>
                     <div class="form-group row skin skin-flat">
                      <label class="col-md-3 label-control" for="custom_made">Create Your Own</label>
                      <div class="col-md-9">
                        <input type="checkbox" name="custom_made" id="custom_made" value="1" <?php if(isset($category) && !empty($category->custom_made)){ echo "checked";} ?>>
                       </div>
                    </div>
                    </div>


                    <div class="maxMin">
                      <div class="form-group row">
                      <label class="col-md-3 label-control" for="minQty">Minimun Quantity</label>
                      <div class="col-md-9">
                        <input type="number" id="minQty" class="form-control" placeholder="Minimun Quantity" name="minQty" value="<?php if(isset($category)){ echo $category->minQty;} ?>"> </div>
                    </div>

                      <div class="form-group row">
                      <label class="col-md-3 label-control" for="maxQty">Maximum Quantity</label>
                      <div class="col-md-9">
                        <input type="number" id="maxQty" class="form-control" placeholder="Maximum Quantity" name="maxQty" value="<?php if(isset($category)){ echo $category->maxQty;} ?>"> </div>
                    </div>
                    </div>

                  
                    
                  </div>
                  <?php if(isset($category)){ ?>
                  <input type="hidden" name="cat_id" value="<?php echo $category->cat_id; ?>">
                  <?php } ?>
                  <div class="form-actions">
                    <button type="button" class="btn btn-warning mr-1"> <i class="ft-x"></i> Cancel </button>
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Save"> <i class="fa fa-check-square-o"></i> Save </button>
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


<script type="text/javascript">
  $(document).ready(function() {

    $(".maxMin").hide();

   <?php if(isset($category)) { 
       if(!empty($category->parent)){ ?>
        $(".maxMin").show();
         $(".custom_made").hide();
      <?php
    }
  }
     ?>

   
    $("#parent").on("change",function(){
      if($("#parent").val() != "")
      {
        $(".custom_made").hide();
        $(".maxMin").show();
      }else{
        $(".custom_made").show();
        $(".maxMin").hide();
       

      }
    })
  })
</script>