<style type="text/css">
	.overly{
		position: absolute;
		background: rgba(0,0,0,0.7);
		height: 100%;
		width: 100%;
	}
	.overDiv{
		vertical-align: middle;

	}
	.abc{
		cursor: pointer;
	}
	.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
</style>

<?php 
$count = count($products);
if($count==0){
	?>

<div class="overly overDiv" style="display: grid">
	<div class="container" style="display: grid;align-items: center; text-align: center;">
		<div class="row">
		<div class="col-md-12">
		<h4 style="color: #fff; text-align: center;">No Product Available</h4>
			<hr class="colorgraph">
		<div class="col-xs-12 col-md-12">
			<a href="<?php echo base_url('order'); ?>" class="btn btn-success btn-lg">Go Back</a></div>
		</div>	
		</div>
	</div>
	
</div>
<style type="text/css">
	.deactive{
		 cursor: not-allowed;
    	opacity: 0.5;
	}
</style>
<?php } ?>
<section class="menu-section pt50">
	<div class="  col-xs-8 col-md-8 container ">
		<div class="row	center-div">
			<?php 
			$i = 0;
			foreach ($products as $key => $value) {
				if($value->product_status == 1){ ?>
				<a class="bigcircles effect-8 customlink" style="cursor: not-allowed; opacity: 0.5;">
					<div class=" col-lg-offset-4 ">
						<p class="content">
							<?php echo $value->product_name; ?>
								<br>$
								<?php echo $value->product_price; ?>
						</p>
					</div>
				</a>

				<?php }else{ ?>
				<a <?php if($value->product_custom == 1){ ?> href="<?php echo base_url('order/readymade/').$value->product_slug."/".$value->product_id; ?>" <?php } ?> data-category = "<?php echo $value->product_category; ?>" data-id = "<?php echo $value->product_id; ?>" data-slug ="<?=$value->product_slug?>" data-name="<?php echo $value->product_name; ?>" data-selected = "<?php echo $value->product_items; ?>" data-custom = "<?=$value->product_custom?>"  class="bigcircles effect-8 customlink <?php if($value->product_custom == 0){ echo 'abc'; } ?>">
					<div class=" col-lg-offset-4 ">
						<p class="content">
							<?php echo $value->product_name; ?>
								<br>$
								<?php echo $value->product_price; ?>
						</p>
					</div>
				</a>
			<?php } ?>
				<?php if($i == 0){ if(isset($create)){?>
					<a href="<?php echo base_url('order/product/').$value->product_slug; ?>" class="bigcircles effect-8 customlink">
						<div class="col-lg-offset-4 ">
							<p class="content">CREATE YOUR OWN 
						</div>
					</a>
					<?php 
				} }
			 	$i++; 
			 } 

		?>
		</div>
	</div>
</section>

<script type="text/javascript">

	$(document).ready(function(){
		$(".abc").click(function(){
			var category_id = $(this).attr('data-category');
			var name = $(this).attr('data-name');
			var product_id = $(this).attr('data-id');
			var slug = $(this).attr('data-slug');
			var custom = $(this).attr('data-custom');
			$.ajax({
				method:'POST',
				url:"<?php echo base_url('order/order_now');?>",
				data:{id:category_id,name:name,flag:1,productid:product_id,slug:slug,custom:custom},
				dataType:'json',

				success:function(res)
				{
					if(res.status){
						var url = "<?php echo base_url("order/add_more"); ?>";
						window.location = url;
						toastr.success(res.msg);
					}
					else
					{
						toasterOptions();
						toastr.error(res.msg);

					}
				}
			}); 

		});
	});

</script>