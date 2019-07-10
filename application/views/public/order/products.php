<style type="text/css">
	.active{
		border: #f88f26 2px solid!important;
		background: transparent;
	}
	.counter{
		width: 10px;
		background: transparent;
		border: none;
	}

	.qtybtn{
		position: absolute;
		top: 52px;
		left: 186px;
	}

</style>
<?php

$productItems = [];
$productSize = [];
if(isset($selected)){
	foreach ($selected as $key => $value) {
		foreach ($value as $key2 => $value2) {
			if($key == "dress"){
				$array =  array('product' => $value2['product'], 'size' =>$value2['size'], 'serving' => $value2['serving']);
				array_push($productSize,$array);
			}
				array_push($productItems,$value2['product']); //sort the selected items in array
			}
		}
	}


	?> 
	<!-- animated fadeInDown -->
	<div class="div2 text-center animated fadeInDown">
		<h1><?php echo $subcategories->name; ?></h1>
		<h3>CHOSE AS MANY AS YOU LIKE</h3>
		<div class="row fix-btn">
			<?php 

			$counter = 0;
			if(isset($productID))
			{
				$productIng = getProductIngredients($productID,$subcategories->cat_id);
				$counter = count($productIng);
			}

			if($flag == 1)
			{
				$counter = $ingsCount;
			}


			if($subcategories->name == "TOPPINGS"){
				$arrayIndex = "top";
			}

			if($subcategories->name == "PREMIUMS"){
				$arrayIndex = "pre";
			}

			if($subcategories->name == "BASES"){
				$arrayIndex = "base";
			}

			if($subcategories->name == "DRESSINGS"){
				$arrayIndex = "dress";
			}


			$category = categoryInfo($subcategories->parent);

			$allProducts = ingredients($subcategories->cat_id); 

			foreach ($allProducts as $key => $value) { 


				if($value->status == 1){ 

					?>
					<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 ci " style="cursor: not-allowed; opacity: 0.5;"> <img class="basemenuimage" src="<?php echo PRODUCT_IMAGE_UPLOAD.$value->cat_pro_image  ?>">
						<p class="menu_text">
							<?php echo $value->cat_pro_name ?>
						</p>
					</div>

				<?php }if($subcategories->name == "DRESSINGS"){ ?>
					<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 option">
						<div class="ci circle spin" onclick="encirecl(this);" data-name="<?php echo $value->cat_pro_name ?>" data-price = "<?=$value->cat_pro_price?>" data-id="<?php echo $value->cat_pro_id ?>" data-index= "<?=$arrayIndex?>">
							<img class="basemenuimage" src="<?php echo PRODUCT_IMAGE_UPLOAD.$value->cat_pro_image  ?>">
							<p class="menu_text">
								<?php echo $value->cat_pro_name ?>
							</p>
							<p class="menu_text inc"></p>
						</div>
						<div class="inbtn" style="display:none;">

							<button type="button" class="btn mybtn btn-circle" data-index= "<?=$arrayIndex?>" onclick="toppingSize(this,<?php echo $value->cat_pro_id; ?>,'S')">S</button>
							<button type="button" class="btn mybtn btn-circle" data-index= "<?=$arrayIndex?>" onclick="toppingSize(this,<?php echo $value->cat_pro_id; ?>,'M')">M</button>
							<button type="button" class="btn mybtn btn-circle" data-index= "<?=$arrayIndex?>" onclick="toppingSize(this,<?php echo $value->cat_pro_id; ?>,'L')">L</button>

							<input type="hidden" id="ingSize<?php echo $value->cat_pro_id; ?>" value = "">
						</div>

						<div class="sczrbtn" style="display: none;">


							<input type="hidden" id="ingServing<?php echo $value->cat_pro_id; ?>" value = "">

							<button type="button" class="btn mybtn btn-circle" data-index= "<?=$arrayIndex?>" onclick="serving(this,<?php echo $value->cat_pro_id; ?>,'Side')">Side</button>
							<button type="button" class="btn mybtn btn-circle" data-index= "<?=$arrayIndex?>" onclick="serving(this,<?php echo $value->cat_pro_id; ?>,'Mixed')">Mixed</button>

						</div>


						<div class="qtybtn" style="display: none";>
							<button type="button"  data-index= "<?=$arrayIndex?>"class="btn mybtn btn-circle" onclick="plus(this,<?=$value->cat_pro_id?>)"><i class="fa fa-plus"></i></button>
							<input class="counter" id="<?=$value->cat_pro_id?>" value="1">
							<input type="hidden" id="<?=$value->cat_pro_id?>Qty" value=''>
							<button type="button"  data-index= "<?=$arrayIndex?>" class="btn mybtn btn-circle" onclick="minus(this,<?=$value->cat_pro_id?>)"><i class="fa fa-minus"></i></button>

						</div>



					</div>

				<?php }else{ ?>


					<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 option">
						<div class="ci circle spin" onclick="encirecl(this);" data-name="<?php echo $value->cat_pro_name ?>" data-price = "<?=$value->cat_pro_price?>" data-id="<?php echo $value->cat_pro_id ?>" data-index= "<?=$arrayIndex?>">
							<img class="basemenuimage" src="<?php echo PRODUCT_IMAGE_UPLOAD.$value->cat_pro_image  ?>">
							<p class="menu_text">
								<?php echo $value->cat_pro_name ?>
							</p>
							<p class="menu_text inc"></p>
						</div>

						<div class="qtybtn" style="display: none;">
							<button type="button"  data-index= "<?=$arrayIndex?>"	 class="btn mybtn btn-circle" onclick="plus(this,<?=$value->cat_pro_id?>)"><i class="fa fa-plus"></i></button>
							<input class="counter" id="<?=$value->cat_pro_id?>" value="1">
							<button type="button"  data-index= "<?=$arrayIndex?>"	 class="btn mybtn btn-circle" onclick="minus(this,<?=$value->cat_pro_id?>)"><i class="fa fa-minus"></i></button>
							<input type="hidden" id="<?=$value->cat_pro_id?>Qty" value=''>
						</div>

					</div>


				<?php } }?>



				<input type="hidden" id="countervalue<?=$arrayIndex?>" value="0">
			</div>
			<div class="">
				<?php if ($perv_button === TRUE): ?>
					<button class="btn-grad-prev btn-n" onclick="change_page(<?php echo $skip-1 ?>);">Previous </button>
				<?php endif; ?>
				<?php if ($next_button === TRUE): ?>
					<button class=" btn-grad btn-n" onclick="change_page(<?php echo $skip+1 ?>);">Next </button>
				<?php endif; ?>
				<?php if ($done_button === TRUE): ?>
					<button class="btn-grad btn-n" onclick="order_now();">Done </button>
				<?php endif; ?>
				<input type="hidden" id="maxQty" value="<?=$subcategories->maxQty?>">
				<input type="hidden" id="minQty" value="<?=$subcategories->minQty?>">
				<input type="hidden" id="subCat" value="<?=$subcategories->cat_id?>">
				<input type="hidden" id="counter" value="<?=$counter?>">
			</div>
		</div>