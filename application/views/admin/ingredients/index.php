    
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
			<div class="content-header-right col-md-6 col-12">
	            <div class="btn-group float-md-right">    
	      			<a href="<?php echo base_url('admin/ingredients/manage_view'); ?>" class="btn mr-1 mb-1 btn-secondary btn-sm box-shadow-2">Add Ingredients</a>
	          	</div>
			</div>
		</div>
		<!-- Breadcrum End -->
		<div class="content-body"><!-- HTML5 export buttons table -->
			<section id="html5">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Ingredients</h4>
								<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
								<div class="heading-elements">
									<ul class="list-inline mb-0">
										<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
										<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
										<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
										<li><a data-action="close"><i class="ft-x"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="card-content collapse show">
								<div class="card-body card-dashboard">
									<table class="table table-striped table-bordered dataex-html5-export">
										<thead>
											<tr>
												<th>Name</th>
												<th>Price</th>
												<th>Category</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($products as $key => $value) {

												$tooltitle = "Activate";
												$fontClass = "fa-eye-slash";
												$status = 0;

												if($value->status == 0)
												{
													$tooltitle = "Deactivate";
													$fontClass = "fa-eye";
													$status = 1;
												}

												?>
												<tr>
													<td><?php echo $value->cat_pro_name; ?></td>
													<td><?php echo $value->cat_pro_price; ?></td>
													<td><?php echo $value->name; ?></td>
													<td>
														<a href="javascript:;" class="btn btn-warning btn-secondary activateDeactivate box-shadow-2 mr-1 mb-1"  data-title="<?=$tooltitle?>" data-status="<?=$status?>" data-id=<?=$value->cat_pro_id?>><i class="fa <?=$fontClass?>" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltitle; ?> Ingredient"></i></a>

														<a href="<?php echo base_url('admin/ingredients/manage_view/').$value->cat_pro_id; ?>" class="btn btn-success btn-secondary box-shadow-2 mr-1 mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

														<a href="javascript:;" data-id="<?php echo $value->cat_pro_id; ?>" class="btn btn-danger deleteIngredients btn-secondary box-shadow-2 mr-1 mb-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
												</tr>
											<?php } ?>
											
											
											
											
										</tbody>
									</table>				
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		 $('.deleteIngredients').on('click', function(){
		 	 var id = $(this).attr('data-id');
          $.confirm({
          title: 'Delete Ingredients',
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
              url: base_url+"admin/ingredients/delete",
              data:'id='+id,
              dataType:'json',
              success:function(res){
              {

              	if (res.status) {
              		toasterOptions();
              		toastr.error(res.msg);
              		setTimeout(function() {
              			window.location.reload();
              		}, 3000);

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




		 $('.activateDeactivate').on('click', function(){
		 	 var status = $(this).attr('data-status');
		 	 var title = $(this).attr('data-title');
		 	  var id = $(this).attr('data-id');
          $.confirm({
          title: title+' Ingredients',
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
              url: base_url+"admin/ingredients/updateStatus",
              data:{id:id,status:status},
              dataType:'json',
              success:function(res){
              {

              	if (res.status) {
              		toasterOptions();
              		toastr.success(res.msg);
              		setTimeout(function() {
              			window.location.reload();
              		}, 3000);

              	}
              	else
              	{
              		toasterOptions();
              		toastr.success(res.msg);
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