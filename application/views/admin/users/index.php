    
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
							<li class="breadcrumb-item"><a href="javascript:;">Users</a> </li>
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
								<h4 class="card-title">Users</h4>
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
												<th>Email</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
					
											<?php 
											if(!empty($users))
											{
											foreach ($users as $key => $value){	?>	
												<tr>
													<td><?php echo $value->name ?></td>
													<td><?php echo $value->email ?></td>
													<td>
														<a href="<?php echo base_url('admin/users/manage_view/').$value->user_id; ?>" class="btn btn-success btn-secondary box-shadow-2 mr-1 mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
														<a href="javascript:;" data-id="<?php echo $value->user_id; ?>" class="btn btn-danger deleteUser btn-secondary box-shadow-2 mr-1 mb-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													</td>
												</tr>
											<?php }
										} else { ?> 

											<div class="alert bg-danger alert-dismissible mb-2" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<strong>No Users Found</strong> 
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
<script type="text/javascript">
	$(document).ready(function () {
		$('.deleteUser').on('click', function(){
			var id = $(this).attr('data-id');
			$.confirm({
				title: 'Delete User',
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
							url: base_url+"admin/users/delete",
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