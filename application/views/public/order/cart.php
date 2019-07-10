<style type="text/css">
	    .order-price{background: none;
    border: none;
    color: white;
}
</style>
<div class="container-fluid pt-5">
	<form id="order-data">
		<div class="row">
			<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12"></div>
			<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 pt50">
				<h1 class="text-center text-white">YOUR ORDER</h1>
				<?php 
					$order_price = 0;

					$orders = $this->session->userdata("order_cart"); //get orders session array

					foreach ($orders as $key => $value) { ?>
					<hr class="hr-white">
					<div class="row">
					<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
						<h2 class="text-white"><?php if($value['order_category'] == "drinks"){ echo $value['order_category']; }else { echo category_parent($value['order_category']); } ?></h2> 
					</div>
					<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
						<h5 class="text-white"><?php echo $value['order_name']; ?></h5>
						<h6 class="text-white">
							<?php
							$qty = $value['qty'];
							if($value['order_category'] == "drinks"){
								echo $value['order_items'];
								
							}else{
							 $decode = json_decode($value['order_items']);

				
							 foreach ($decode as $key1 => $value1) {
							 	if($key1 == "top"){
							 		$INDEX = "TOPPINGS";
							 	}

							 	if($key1 == "pre"){
							 		$INDEX = "PREMIUMS";
							 	}

							 	if($key1 == "base"){
							 		$INDEX = "BASES";
							 	}

							 	if($key1 == "dress"){
							 		$INDEX = "DRESSINGS";
							 	}
							 	echo "<b>".$INDEX.": </b>";
							 	 $count = count($value1); 
							 	foreach ($value1 as $k => $v) {
							 		$product = ingredients_price($v->product);
							 		if($key1 == "dress"){

							 			$serving = !empty($v->serving)?$v->serving:'Side';
							 			$quant = !empty($v->quantity)?$v->quantity:'1';
							 			$size = !empty($v->size)?$v->size:'M';

							 				echo $product->cat_pro_name." (".$size.")" . "(Serving: ".$serving.")". "(Qty: ".$quant.")";
							 			
							 			
							 		}else{
							 			echo $product->cat_pro_name ."(Qty: ".$v->quantity.")";
							 		}
							 	
							 		
							 		if($count != $k+1)
							 		{
							 			echo ", ";
							 		}
							 		else
							 		{
							 			echo ".<br>";
							 		}
							 	}
							 }
							}
							$odr_pr = $value['order_price'];
							if($value['order_category'] == "drinks"){
								$odr_pr = $value['order_price']/$qty;
							}
							 ?>
						</h6> 
						<span style="color: #fff">
						<?php if($value['custom'] == 0){ echo "This Product Is Non Editable."; } ?></span>
					</div>
					<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
						<div class="leftsidecontentmiddle">
							<?php if($value['custom'] == 1){ ?>
								<?php if($value['order_category'] == "drinks"){ ?>
								<a  href="<?php echo base_url('order/edit_drink/').$value['slug']."/".$key; ?>" class="btn btn-default btn-w btn-blocka">EDIT</a>
							<?php } else { ?> 
							<a  href="<?php echo base_url('order/edit/').$value['slug']."/".$key; ?>" class="btn btn-default btn-w btn-blocka">EDIT</a>
						<?php } ?>
						<?php } ?>
							<a  href="<?php echo base_url('order/deleteItem/').$key; ?>" class="btn btn-default btn-w btn-blocka">DELETE</a>
						</div>
					</div>
					<div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 leftsidecontentmiddle" style="text-align: center; vertical-align: middle;">
						<div class="row ">
								
							<input type="hidden" id="qty<?php echo $key; ?>" name="qty[]" value = "<?=$qty?>">

							<button class="glyp-ico" data-price = "<?php echo $odr_pr; ?>" data-class= "<?php echo $key; ?>" onclick="minus(this,<?php echo $key; ?>);" > <i class="fa fa-minus-circle"></i></button>
							<input type="text" readonly id="<?php echo $key; ?>" value="<?=$qty?>" min="1" style="width: 30px; background: transparent; border: none;color: #fff; font-size: 18px;" />
							<button class="glyp-ico" data-price = "<?php echo $odr_pr; ?>" data-class= "<?php echo $key; ?>"  onclick="plus(this,<?php echo $key; ?>);"> <i class="fa fa-plus-circle"></i></button>

						</div>
						<div class="row"> 
						
					<input type="text" class="order-price price<?php echo $key; ?>"  value="$ <?php echo $value['order_price']; ?>">
						</div>
					</div>
				</div>
				<hr class="hr-white">

				<?php 
				
				if($value['order_category'] == "drinks"){
					$order_price += $value['order_price'];	
				}else{
					$order_price += $value['order_price'];	
				}

				}	
				?>
			</div>
					<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 mt-5 ">
						<hr class="hr-white">
						<div style="display: grid;">
							<table class="text-center">
								<tr>
									<th>Subtotal: </th>
									<td>$ <input type="text" readonly class="order-price total-amount" value="<?php echo $order_price; ?>"></td>
								</tr>
								<tr>
									<th>Total: </th>
									<td>$ <input type="text" name="total_price" readonly class="order-price total-amount" value="<?php echo $order_price; ?>"></td>
								</tr>
							</table>
						</div>
						<div class="row leftsidecontentmiddle">
							<a href="<?php echo base_url('order/checkout'); ?>" class="btn btn-block btn-default btn-w"><i class="fas fa-left-arrow"></i>CHECKOUT</a>
							<a href="<?php echo base_url('order/'); ?>" class="btn btn-block btn-default btn-w">ADD MORE </a>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

function plus(ele,id){

    var count =   $(ele).parents(".row").find("#"+id).val();
    var updatedCount = parseInt(count)+parseInt(1);
    $(ele).parents(".row").find("#"+id).val(updatedCount);
    $("#qty"+id).val(updatedCount);
    var price = $(ele).attr('data-price')*updatedCount;
    $(".price"+id).val("$"+price);
    var totalamount = $(".total-amount").val();
    var totalprice = parseFloat(totalamount)+parseFloat($(ele).attr('data-price'));
    $(".total-amount").val(totalprice);

  }

  function minus(ele,id){

  	var count =   $(ele).parents(".row").find("#"+id).val();
  	if(count<=1){
  		return false;
  	}else{
  		var updatedCount = parseInt(count)-parseInt(1);
  		$(ele).parents(".row").find("#"+id).val(updatedCount);
  		var price = $(ele).attr('data-price')*updatedCount;
  		$(".price"+id).val("$"+price);
  		var totalamount = $(".total-amount").val();
  		var totalprice = parseFloat(totalamount)-parseFloat($(ele).attr('data-price'));
  		$(".total-amount").val(totalprice);
  	}

  }

$(document).ready(function() {
	var click = 1;

  $('#order-data').on('submit',function(e)
  {
    e.preventDefault();
    $.ajax({
        method:'post',
       url:'<?php echo base_url('order/combine_data');?>',
        data:new FormData(this),
        dataType:'json',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,
        success:function(data)
        {
            

        },


      });
   
});



});
</script>