	<div id="mySidenav" class="sidenav leftsidecontentmiddle">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<div class=" ">
			<h2 style="color: #fff;     text-align: center;">CANCEL YOUR ENTIRE ORDER</h2>
			<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="content leftsidecontentmiddle">
			<a href="javascript:;" class="btn btn-default btn-block cancelOrder btn-w"><i class="fas fa-times"></i> CANCEL ORDER</a>
			<a href="<?php echo base_url('order'); ?>" class="btn btn-default btn-block btn-w"><i class="fas fa-long-arrow-alt-left"></i>
			RETURN TO ORDER</a>
	
			<a href="<?php echo base_url(); ?>" class="btn btn-default btn-block btn-w"><i class="fas fa-long-arrow-alt-left"></i>
			RETURN TO Home</a>
		</div>
  </div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function () {
		 $('.cancelOrder').on('click', function(){
          $.confirm({
          title: 'Cancel Order',
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
              url: base_url+"order/cancelOrder",
              dataType:'json',
              success:function(res){
              {

              	if (res.status) {
              		toasterOptions();
              		toastr.error(res.msg);
              		setTimeout(function() {
                    window.location.replace(base_url+"order");
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