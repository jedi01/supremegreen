<style type="text/css">
.jqueryui-ele-container .ui-sortable {
  
  width: 100% !important;
}
.list-group-item {
 
  padding: 12px 0px 48px 0px !important;
  margin-bottom: 25px!important;
}
.list-group-item span {
  margin-left: 12px;
}
</style>

<div class="app-content content">
  <div class="content-wrapper">
    <!-- Breadcrum -->
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Sub Category</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a> </li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/category'); ?>">Category</a> </li>
              <li class="breadcrumb-item"><a href="javascript:;">Sub Category</a> </li>
            </ol>
          </div>
        </div>
      </div>

      <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right">    
          <a href="<?php echo base_url('admin/category/manage_view'); ?>" class="btn mr-1 mb-1 btn-secondary btn-sm box-shadow-2">Add Sub Category</a>
        </div>
      </div>
    </div>
    <!-- Breadcrum End -->
    <section id="basic-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" id="bordered-layout-basic-form"><?php echo "Categories of ".$sub_cat; ?></h4>
              <span style="color: red;">*drag Categories to set position</span> <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
              </div>
            </div>


            <div class="col-md-12 col-lg-12">
              <div class="jqueryui-ele-container ">
                <div class="sortable-placeholder list-group" id="sub-cats">
                  <?php 
                  $order = 0; 
                  foreach ($sub_categories as $key => $value) 
                  { 
                    $order++; ?>
                    <div id="<?php echo "item_".$value->cat_id; ?>" class="list-group-item">
                      <span><?php echo $value->name ?> </span>
                      <div style="float: right;">
                         <a href="<?php echo base_url('admin/category/subcatIngredients/').$value->cat_id; ?>" class="btn btn-info btn-secondary box-shadow-2 mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Set Display Position of ingredients of <?php echo  $value->name; ?> "><i class="fa fa-arrows-v" aria-hidden="true"></i>
                        </a>
                        <a href="<?php echo base_url('admin/category/manage_view/').$value->cat_id; ?>" class="btn btn-success btn-secondary box-shadow-2 mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit  <?php echo  $value->name; ?> "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:;" data-id="<?php echo $value->cat_id; ?>" class="btn btn-danger categoryDelete btn-secondary box-shadow-2 mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete <?php echo  $value->name; ?> "><i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                  <?php } ?>
                  
                  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function () {
   
    $("#sub-cats").sortable({
      update:function( event, ui ) {
        var postData  = $(this).sortable('serialize');
        
        var id = "<?php echo $cat_id; ?>";
        $.ajax({
          method:'post',
          url:'<?php echo base_url('admin/Category/updateList');?>',
          data:{list:postData,id:id},
          dataType: "json",
          
          success:function(res)
          {
            
            if(res.status)
            {
             toastr.success('Order Updated');
           }
           else
           {

           }
         }


       });
      }
    })

  })
</script>


<script type="text/javascript">
  $(document).ready(function () {
   $('.categoryDelete').on('click', function(){
     var id = $(this).attr('data-id');
     $.confirm({
      title: 'Delete Category',
      content: 'Are You Sure ?',
      icon: 'fa fa-trash-o',
      theme: 'supervan',
      closeIcon: true,
      animation: 'scale',
      type: 'orange',
      buttons: {
        Delete: function () {
          $.ajax({
            type:"post",
            url: base_url+"admin/category/delete",
            data:'id='+id,
            dataType:'json',
            success:function(res){
              {

                if (res.status) {
                  toasterOptions();
                  toastr.error(res.msg);
                  setTimeout(function() {
                    window.location.reload();
                  }, 2000);

                }
                else
                {
                  toasterOptions();
                  toastr.error(res.msg,res.alert);
                  setTimeout(function() {
                    window.location.reload();
                  }, 5000);
                }
              }
            }
          });
        },
        Cancel: function () {
          location.reload();
        }
      }
    });
   });
 })
</script>