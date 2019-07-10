
<div class="app-content content">
  <div class="content-wrapper">
    <!-- Breadcrum -->
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Product</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a> </li>
              <li class="breadcrumb-item"><a href="javascript:;">Product</a> </li>
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
              <h4 class="card-title" id="bordered-layout-basic-form">Product Info</h4> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
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
                <form class="form form-horizontal form-bordered" novalidate enctype="multipart/form-data" action="<?php echo base_url('admin/products/manage'); ?>" method="POST" >
                  <div class="form-body">
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="product_name">Product Name</label>
                      <div class="col-md-9">
                        <input type="text" required  class="form-control" placeholder="Product Name" name="product_name" id="product_name" value="<?php if(isset($product)){ echo $product->product_name;} ?>" > </div>
                    </div>

 
                    <div class="form-group row">
                      <label class="col-md-3 label-control" for="product_category">Product Category</label>
                      <div class="col-md-9">
                        <select name="product_category" id="product_category"  required class="form-control select2">
                          <option value="none" selected="" disabled="">Product Category</option>
                         <?php
                            foreach ($categories as $key => $value) { ?>

                              <option value="<?php echo $value->cat_id; ?>" <?php if(isset($product)){ echo ($value->cat_id == $product->product_category)?"selected":"" ;} ?>><?php echo $value->name; ?></option>
                              
                          <?php } ?>                           
                        </select>
                      </div>
                    </div>
                    <div id="sub-categories"></div>

                  </div>
                 
                  <div class="form-actions">
                    <?php if(isset($product)){ ?>

                      <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                      <input type="hidden" name="product_slug" value="<?php echo $product->product_slug; ?>">

                    <?php } ?>
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

<script type="text/javascript">
  $(document).ready(function() {
     var category = $("[name='product_category']").val();
      $("[name='product_category']").on("change",function(){
        var category = $("[name='product_category']").val();
        if(category == "")
        { 
           $("#sub-categories").html("");
        }
        else
        {
          $.ajax({
          method:'POST',
          url:"<?php echo base_url('admin/products/subcategory');?>",
          
          data:{category:category},
          dataType:'text',

          success:function(data)
          {
            $("#sub-categories").html(data);
            $(".select2").select2();
              if (skin.hasClass('skin-flat')) {
          checkbox_default = 'icheckbox_flat';
          radio_default = 'iradio_flat';
          checkbox === undefined && (checkbox = 'icheckbox_flat-green', radio = 'iradio_flat-green');
        }
           
          }
          });

        }

      }); 

      <?php if(isset($product)){ ?>
      if(category != "")
      { 
        var product = '<?php echo (isset($product) && !empty($product) ? $product->product_id: "" ) ?>';
        $.ajax({
          method:'POST',
          url:"<?php echo base_url('admin/products/subcategory');?>",
          
          data:{category:category,product:product},
          dataType:'text',

          success:function(data)
          {
            $("#sub-categories").html(data);
            $(".select2").select2();
            
          }
        });
      }
    <?php } ?>






  })



  function getCategoryLimit(categoryID) {
    


    var items =  $("."+categoryID).val();

    $.ajax({
      method:'POST',
      url:"<?php echo base_url('admin/products/getCategoryLimit');?>",
      data:{category:categoryID},
      dataType:'json',
      success:function(res)
      {

        var maxQty = res['maxQty'];
        var itemsLenght = items.length;

        $(".select2").select2({
          maximumSelectionLength: maxQty,
          language: {
            maximumSelected: function (e) {
              toasterOptions();
              toastr.error('You Reached Maximun Limit');
              return 'You Reached Maximun Limit of Selection';
            }
          }
        }); 
      }
    });
  }

</script>
