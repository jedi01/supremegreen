    
<div class="app-content content">
	<div class="content-wrapper">
		<!-- Breadcrum -->
		<div class="content-header row">
			<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Orders</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a> </li>
							<li class="breadcrumb-item"><a href="javascript:;">Orders</a> </li>
						</ol>
					</div>
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
								<h4 class="card-title">Orders</h4>
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
												<th>Order By</th>
												<th>Name</th>
											
												<th>Qty</th>
												<th>Price</th>
												<th>Payment Status</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
					
											<?php 
											

											if(!empty($orders))
											{
												
											
												function isJson($string) {
														json_decode($string);
														return (json_last_error() == JSON_ERROR_NONE);
													}
											
											foreach ($orders as $key => $value)
												{	

													if($value->order_status == 0)
													{
														$status = '<div class="badge badge-primary completeOrder" data-id="'.$value->order_id.'" data-title="Complete">
														<span>Pending</span>
														<i class="fa fa-spinner font-medium-2"></i>
														</div>';
													}
													else
													{
														$status = '<div class="badge badge-success">
														<span>Complete</span>
														<i class="fa fa-check font-medium-2"></i>
														</div>';
													}

													if($value->statusCategory == "CREATED")
													{
														$paymentStatus = '<div class="badge badge-success">
														<span>Payment Created</span>
														<i class="fa fa-check font-medium-2"></i>
														</div>';
													}

													elseif($value->statusCategory == "UNSUCCESSFUL")
													{
														$paymentStatus = '<div class="badge badge-danger">
														<span>Unsuccessfull</span>
														<i class="fa fa-times font-medium-2"></i>
														</div>';
													}

													elseif($value->statusCategory == "PENDING_PAYMENT")
													{
														$paymentStatus = '<div class="badge badge-primary">
														<span>Payment Pending</span>
														<i class="fa fa-spinner font-medium-2"></i>
														</div>';
													}
													elseif($value->statusCategory == "COMPLETED")
													{
														$paymentStatus = '<div class="badge badge-success">
														<span>Payment Completed</span>
														<i class="fa fa-check font-medium-2"></i>
														</div>';
													}

													elseif($value->statusCategory == "REVERSED")
													{
														$paymentStatus = '<div class="badge badge-info">
														<span>Payment Reversed</span>
														<i class="fa fa-check font-medium-2"></i>
														</div>';
													}

													elseif($value->statusCategory == "REFUNDED")
													{
														$paymentStatus = '<div class="badge badge-info">
														<span>Payment refunded</span>
														<i class="fa fa-check font-medium-2"></i>
														</div>';
													}

													

												 ?>
												<tr>
													<td><?php echo $value->name ?></td>
													<td><?php echo $value->order_name ?></td>
													<td><?php echo $value->qty ?></td>
													<td>$<?php echo $value->per_order_price ?></td>
													<td><?php echo $paymentStatus ?></td>
													<td><?php echo $status ?></td>
													<td><a href="javascript:;" class="btn btn-info btn-secondary box-shadow-2 mr-1 mb-1"  data-toggle="modal" data-target="#default<?php echo $value->order_item_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="javascript:;" data-id="<?php echo $value->order_id; ?>" class="btn btn-danger orderDelete btn-secondary box-shadow-2 mr-1 mb-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
												</tr>

						
											<?php }
											} else { ?> 

												<div class="alert bg-danger alert-dismissible mb-2" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<strong>No Orders Found</strong> 
											</div>

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

<?php

foreach ($orders as $key5 => $value5)
	{
		?>

		<!-- Modal -->
		<div class="modal fade text-left" id="default<?php echo $value5->order_item_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel1">Order Detail</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table>
							<tr>
								<th>Order By:</th>
								<td><?php echo $value5->name; ?></td>
							</tr>
							<?php if($value5->name != "guest"){ ?>
							<tr>
								<th>Email:</th>
								<td><?php echo $value5->email; ?></td>
							</tr>
						<?php } ?>
							<tr>
								<th>Items:</th>
								<td><?php
								if(isJson($value5->order_items)){
									$decode = json_decode($value5->order_items);
									
									foreach ($decode as $key1 => $value1) {
										$count = count($value1);
										echo "<b>".$key1.": </b>";
										foreach ($value1 as $key2 => $value2) {
											//debug($value1);
											if($key1 == "top"){
												$product = ingredients_price($value2->product);
												echo $product->cat_pro_name." (".$value2->size.") ";
											}else{
												$product = ingredients_price($value2->product);
											echo $product->cat_pro_name;
											}
											

										if($count != $key2+1)
										{
											echo ", ";
										}
										else
										{
											echo ". <br>";
										}
										}
									}
									
								}else{
									echo $value5->order_items;
								}
								?></td>
							</tr>

							<tr>
								<th>Qty:</th>
								<td><?php echo $value5->qty; ?></td>
							</tr>

							<tr>
								<th>Total Amount:</th>
								<td><?php  echo "<b>$</b>".$value5->order_price; ?></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
						
					</div>
				</div>
			</div>
		</div>
	<?php } ?>


<script type="text/javascript">
	$(document).ready(function () {
		 $('.completeOrder').on('click', function(){
		 	 var id = $(this).attr('data-id');
		 	 var title = $(this).attr('data-title');
          $.confirm({
          title: title+" Order",
          content: 'Are You Sure ?',
          icon: 'fa fa-trash-o',
          theme: 'supervan',
          closeIcon: true,
          animation: 'scale',
          type: 'orange',
            buttons: {
            Complete: function () {
              $.ajax({
              type:"post",
              url: base_url+"admin/orders/complete",
              data:'id='+id,
              dataType:'json',
              success:function(res){
              {

              	if (res.status) {
              		toasterOptions();
              		toastr.success(res.msg);
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
              		}, 2000);
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


		 $('.orderDelete').on('click', function(){
		 	 var id = $(this).attr('data-id');
          $.confirm({
          title: "Delete Order",
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
              url: base_url+"admin/orders/delete",
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
              		}, 2000);
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