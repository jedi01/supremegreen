<style type="text/css">
.qtybtn{
	    position: absolute;
    top: 52px;
    left: 186px;
}

	.active{
		border: #f88f26 2px solid!important;
		background: transparent;
	}
.counter{
  width: 10px;
  background: transparent;
  border: none;
}
	body{
		overflow: hidden;
	}
	.items{
		max-height: 630px;
    overflow-y: scroll;
	}
	.active{
		border: #f88f26 2px solid!important;
		background: transparent;
	}
	.hidden{
		display: none;
	}
	.animate{
		overflow-y: hidden;
	max-height: 500px; /* approximate max height */

	transition-property: all;
	transition-duration: .5s;
	transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
	}

	.hovicon_small{
		display: grid;
align-items: center;
text-align: center;
margin-right: 0px;
width: 150px;
height: 150px;
border-radius: 50%;
border: 4px solid #ffff;
align-items: center;
cursor: pointer;
position: relative;
	}
	.overly{
		position: absolute;
		background: rgba(0,0,0,0.7);
		height: 100%;
		width: 100%;
	}
	.overDiv{
		vertical-align: middle;

	}
	.dotted_hovicon{
		border: 4px dotted #fff;
	}
	.border_curve{
border-radius: 100%/149px 149px 0 0;
margin-top: 7px;

	}
	.btm-center{
		bottom: 0;
position: fixed;
	}
	.vl {
  border-left: 4px solid #fff;
  height: 35px;
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

$productItems = [];
$productSize = [];
$counter = 0;
$dress = [];
$top = [];
$premium = [];
$basees = [];
$top_name = [];
$pre_name = [];
$base_name = [];
$dress_name = [];
if(isset($items)){
	$itemsArray =  json_decode($items);
	foreach ($itemsArray as $k => $v) {
			foreach ($v as $k2 => $v2) {
				if($k == "dress"){
					$array =  array('product' => $v2->product, 'size' =>$v2->size,'serving'=>$v2->serving);
					array_push($productSize,$array);
					array_push($dress, $v2->product);
				}
				elseif($k == "pre"){
					
					array_push($premium, $v2->product);
				}
				elseif($k == "top"){
					
					array_push($top, $v2->product);
				}
				elseif($k == "base"){
					
					array_push($basees, $v2->product);
				}

				array_push($productItems,$v2->product); //sort the selected items in array
			}
		}
	}
	foreach ($top as $k3 => $v3) {
		$product = ingredients_price($v3);
		array_push($top_name, $product->cat_pro_name);
		
	}
	foreach ($premium as $k4 => $v4) {
		$product = ingredients_price($v4);
		array_push($pre_name, $product->cat_pro_name);

	}
	foreach ($basees as $k5 => $v5) {
		$product = ingredients_price($v5);
		array_push($base_name, $product->cat_pro_name);

	}
	foreach ($dress as $k6 => $v6) {
		$product = ingredients_price($v6);
		array_push($dress_name, $product->cat_pro_name);

	}

	$top = array_combine($top, $top_name);
	$premium = array_combine($premium, $pre_name);
	$dress = array_combine($dress, $dress_name);
	$basees = array_combine($basees, $base_name);

	
 ?> 

<section class="menu-section" style="align-items: end!important;">
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 " >	
		<h2 style="text-align: center; color: #fff;"><?=$order_data['order_name'];?></h2>
		<h3 id="price" style="text-align: center; color: #fff;">$<?php echo $price; ?></h3>
		<input id="price1" type="hidden" value="$<?php echo $price; ?>">
		<div class="" >	
			<div class="row center-div">
				<?php foreach ($categories as $key => $value) { 
				
					if($value->name == "TOPPINGS"){?>
						<a class="show_items top" data-id = "<?=$value->cat_id?>">
			    		<div class="round sidebar-margin dotted_hovicon effect-8 mr-2" style=" width:300px !important; height: 300px !important;">
			    			<span class="content marginy0" ><?=$value->name?></span>
			    			<p  class="items_div"  style="color: #fff; text-align: center;">
			    				
			    			</p> 
			    		</div>
			    	</a>
					<?php }else{ 
					if($value->name == "TOPPINGS"){
						$arrayIndex = "top";
					}

					if($value->name == "PREMIUMS"){
						$arrayIndex = "pre";
					}

					if($value->name == "BASES"){
						$arrayIndex = "base";
					}

					if($value->name == "DRESSINGS"){
						$arrayIndex = "dress";
					}
					?>
					<a class="show_items <?php echo $arrayIndex; ?>" data-id = "<?=$value->cat_id?>">
			    		<div class="round sidebar-margin hovicon effect-8 mr-2" style=" width:300px !important; height: 300px !important;">
			    			<span class="content marginy0"><?=$value->name?></span> 
			    			<p class="items_div" style="color: #fff; text-align: center;">
			    				
			    			</p> 
			    		</div>
			    	</a>
				<?php } } ?>
				
			</div>
		</div>
	</div>
	<div class=" btm-center done">
		<a href="">
			<div class="round sidebar-margin hovicon_small effect-8 mr-2">
				<span class="content marginy0">Looks Good</span>
			</div>
		</a>
	</div>
</section>	
<?php foreach ($categories as $key1 => $value1) { 


		if($value1->name == "TOPPINGS"){
			$arrayIndex = "top";
		}

		if($value1->name == "PREMIUMS"){
			$arrayIndex = "pre";
		}

		if($value1->name == "BASES"){
			$arrayIndex = "base";
		}

		if($value1->name == "DRESSINGS"){
			$arrayIndex = "dress";
		}?>
<div class="container-fluid bg-white animated slideInUp items border_curve hidden <?=$value1->cat_id?>" data-max = "<?=$value1->maxQty?>">
	<div class="container ">
		<section class=" ">
			<div class="row pt-5">
				<input type="hidden" id="maxQty" value="">
				<input type="hidden" id="minQty" value="<?=$value1->minQty?>">
				<input type="hidden" id="counter" value="<?=$counter?>">
				<?php 
				$ingredients = has_ingredeients($value1->cat_id); 
				foreach ($ingredients as $key2 => $value2) { 
		


					if($value1->name == "DRESSINGS"){ ?>
						<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 option">
				<div class="ci circle spin <?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'color '; } }?>" onclick="encirecl(this,<?=$value1->cat_id?>);" data-name="<?php echo $value2->cat_pro_name ?>" data-price = "<?=$value2->cat_pro_price?>" data-id="<?php echo $value2->cat_pro_id ?>" data-index= "<?=$arrayIndex?>">
					 <img class="basemenuimage" src="<?php echo PRODUCT_IMAGE_UPLOAD.$value2->cat_pro_image  ?>">
					 <p class="menu_text">
					<?php echo $value2->cat_pro_name ?>
				</p>
				</div>
				<div class="inbtn" style="display: <?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'block '; }else{echo "none";  } }?>;">
					
					<button type="button" class="btn mybtn btn-circle <?php foreach ($productSize as $k => $v) {
						if($v['product'] ==  $value2->cat_pro_id && $v['size'] == 'S'){
							echo 'active';
						}
					} ?>" data-index= "<?=$arrayIndex?>" onclick="toppingSize(this,<?php echo $value2->cat_pro_id; ?>,'S')">S</button>
					<button type="button" class="btn mybtn btn-circle <?php foreach ($productSize as $k => $v) {
						if($v['product'] ==  $value2->cat_pro_id && $v['size'] == 'M'){
							echo 'active';
						}
					} ?>" data-index= "<?=$arrayIndex?>" onclick="toppingSize(this,<?php echo $value2->cat_pro_id; ?>,'M')">M</button>
                    <button type="button" class="btn mybtn btn-circle <?php foreach ($productSize as $k => $v) {
						if($v['product'] ==  $value2->cat_pro_id && $v['size'] == 'L'){
							echo 'active';
						}
					} ?>" data-index= "<?=$arrayIndex?>" onclick="toppingSize(this,<?php echo $value2->cat_pro_id; ?>,'L')">L</button>
				</div>

				<div class="sczrbtn" style="display: <?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'block '; }else{echo "none";  } }?>;">

					<input type="hidden" id="ingSize<?php echo $value2->cat_pro_id; ?>" value = "<?php echo isset($v['size'])?$v['size']:'';  ?>">
					
					<button type="button" class="btn mybtn btn-circle <?php foreach ($productSize as $kx => $vx) {
						if($v['product'] ==  $value2->cat_pro_id && $vx['serving'] == 'Side'){
							echo 'active';
						}
					} ?>" data-index= "<?=$arrayIndex?>" onclick="serving(this,<?php echo $value2->cat_pro_id; ?>,'Side')">Side</button>
					<button type="button" class="btn mybtn btn-circle <?php foreach ($productSize as $kx => $vx) {
						if($v['product'] ==  $value2->cat_pro_id && $vx['serving'] == 'Mixed'){
							echo 'active';
						}
					} ?>" data-index= "<?=$arrayIndex?>" onclick="serving(this,<?php echo $value2->cat_pro_id; ?>,'Mixed')">Mixed</button>
                 
				</div>

				<div class="qtybtn" style="display: <?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'block '; }else{echo "none";  } }?>;">
					<button type="button"  data-index= "<?=$arrayIndex?>"	 class="btn mybtn btn-circle" onclick="plus(this,<?=$value2->cat_pro_id?>)"><i class="fa fa-plus"></i></button>
					<input class="counter" id="<?=$value2->cat_pro_id?>" value="1">
					<button type="button"  data-index= "<?=$arrayIndex?>"	 class="btn mybtn btn-circle" onclick="minus(this,<?=$value2->cat_pro_id?>)"><i class="fa fa-minus"></i></button>
				</div>
			</div>
					<?php }else{ ?>

			<div class="col-lg-3 col-sm-12 col-xs-12 col-md-3 option">
				<div class="ci circle spin <?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'color '; } }?>"  onclick="encirecl(this,<?=$value1->cat_id?>);" data-name="<?php echo $value2->cat_pro_name ?>" data-price = "<?=$value2->cat_pro_price?>" data-id="<?php echo $value2->cat_pro_id ?>" data-index= "<?=$arrayIndex?>">
					 <img class="basemenuimage" src="<?php echo PRODUCT_IMAGE_UPLOAD.$value2->cat_pro_image  ?>">
					 <p class="menu_text">
					<?php echo $value2->cat_pro_name ?>
				</p>
				<p class="menu_text inc"><?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'Included '; } }?></p>
				</div>
	
				<div class="qtybtn" style="display: <?php if(isset($productItems)){ if (in_array($value2->cat_pro_id, $productItems)){ echo 'block '; }else{echo "none";  } }?>;">
					<button type="button"  data-index= "<?=$arrayIndex?>"	 class="btn mybtn btn-circle" onclick="plus(this,<?=$value2->cat_pro_id?>)"><i class="fa fa-plus"></i></button>
					<input class="counter" id="<?=$value2->cat_pro_id?>" value="1">
					<button type="button"  data-index= "<?=$arrayIndex?>"	 class="btn mybtn btn-circle" onclick="minus(this,<?=$value2->cat_pro_id?>)"><i class="fa fa-minus"></i></button>
				</div>

			</div>
					
				<?php } } ?>

				<input type="hidden" id="countervalue<?=$arrayIndex?>" value="0">
				
			</div>
		</section>
	</div>

</div>
<?php } ?>



<script type="text/javascript">

var addclass = 'color';
var removeclass = 'spin';
 var products = [];
  <?php 
    echo "var newProducts =".$items.";";
  ?>

var names = [];	
var counter = 0;

$(document).ready(function(){
	var pre_selected = <?php echo json_encode($premium); ?>;
	var base_selected = <?php echo json_encode($basees); ?>;
	var dress_selected = <?php echo json_encode($dress); ?>;
	var top_selected  = <?php echo json_encode($top); ?>;
      $.each( pre_selected, function( key, value ) {
        $(".pre").find("p").append("<div data-salad-id='" + key + "'>" + value + "</div>"); //get array of product name and id only
      });
      $.each( base_selected, function( key, value ) {
        $(".base").find("p").append("<div data-salad-id='" + key + "'>" + value + "</div>"); //get array of product name and id only
      });
      $.each( dress_selected, function( key, value ) {
        $(".dress").find("p").append("<div data-salad-id='" + key + "'>" + value + "</div>"); //get array of product name and id only
      });
      $.each( top_selected, function( key, value ) {
        $(".top").find("p").append("<div data-salad-id='" + key + "'>" + value + "</div>"); //get array of product name and id only
      });
    
	
	$(".show_items").click(function(){

		var id = $(this).data("id");
		 if($("."+id).hasClass("hidden")){
		 	$(".items").addClass("hidden");
		 	$("."+id).removeClass("hidden");
		 }else{
		 	
		 	$("."+id).addClass("hidden");
		 }
		});


	$(".done").on("click",function() {
		var price = $("#price1").val();
		$.ajax({
    method:'POST',
    url:"<?php echo base_url('order/edit_order');?>",
    data:{selected:newProducts,key:<?php echo $skey; ?>,price:price},
    dataType:'json',

    success:function(data)
    {
      if(data.status){
        var url = "<?php echo base_url("order/view_cart"); ?>";
        window.location = url;
      } else{
        toasterOptions();
        toastr.error(data.msg);
      }
    }
  }); 
	})
});



  function addToArray(name, value) { //add products to array
    newProducts[name].push(value);
  }



    function plus(ele,id){
    var abc = $(ele).data("index");
    var count =   $(ele).parents(".qtybtn").find("input").val();
    var updatedCount = parseInt(count)+parseInt(1);
    var minQty = $("#minQty").val();
    var maxQty = $("#maxQty").val(); //get max quantity of category

  var totlco = $("#countervalue"+abc).val();

    if(count == maxQty || totlco == maxQty){
       toasterOptions();
         toastr.error('You Reached Maximun Limit');
        return false;
    }
    $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())+parseInt(1));
    $(ele).parents(".qtybtn").find("input").val(updatedCount);
    $(newProducts[abc]).each(function( index, element ) {
        if(element.product == id){
         newProducts[abc].splice(index, 1); //remove form array
         return false;
       }

      });
    var addeddata = {'product':id,'quantity':updatedCount,'size':"",'serving':''}; //create object of product
    addToArray(abc,addeddata);
        var category_id = <?php echo $order_category; ?>;
      $.ajax({ //get price if ingredients
        method:'POST',
        url:"<?php echo base_url('order/getPrice');?>",
        data:{id:category_id,selected:newProducts,qty:updatedCount},
        dataType:'json',
        success:function(res)
        {
          $("#pricetag").html("<h3>Price : $"+res.price+" </h3>")

        }
      }); 

    


  }

  function minus(ele,id){
     var abc = $(ele).data("index");
      var count =   $(ele).parents(".qtybtn").find("input").val();
     if(count<=1){
      return false;
     }else{
    var updatedCount = parseInt(count)-parseInt(1);
    $(ele).parents(".qtybtn").find("input").val(updatedCount);
      $(newProducts[abc]).each(function( index, element ) {
    
        if(element.product == id){
         newProducts[abc].splice(index, 1); //remove form array
         return false;
       }

      });

      var countinput =  $(ele).parent().find(".qtybtn").find("input").val();
      $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())-parseInt(1));
     var addeddata = {'product':id,'quantity':updatedCount,'size':"",'serving':''}; //create object of product
      addToArray(abc,addeddata);
          var category_id = <?php echo $order_category; ?>;
      $.ajax({ //get price if ingredients
        method:'POST',
        url:"<?php echo base_url('order/getPrice');?>",
         data:{id:category_id,selected:newProducts,qty:updatedCount},
        dataType:'json',
        success:function(res)
        {
          $("#pricetag").html("<h3>Price : $"+res.price+" </h3>")

        }
      }); 
    
     }
    
  }

  function encirecl(ele,cat_id) 
  {
  	var maxQty = $("."+cat_id).data("max");
    var addCounter = parseInt($("#counter").val())+parseInt(1);  //count added
    var minQty = $("#minQty").val(); //get min quantity of category
    var abc = $(ele).data("index"); // category index name
    var selectedCount = newProducts[abc].length; //selected items count
    var newCounter = parseInt(selectedCount)+parseInt(addCounter); //new counter set
    var totlco = $("#countervalue"+abc).val();

    if(newCounter>maxQty || totlco==maxQty)  //max quantity reach return false
    { 
      if (!$(ele).hasClass('color')) {
        toasterOptions();
        toastr.error('You Reached Maximun Limit');
        return false;
      }
    }


    $(ele).toggleClass(addclass);

    if ($(ele).hasClass('color')) { //if selected
      counter++;
      var item = $(ele).data('id'); //product id
      var n = item.toString();
     $("."+abc).find("p").append("<div data-salad-id='" + $(ele).data('id') + "'>" + $(ele).data('name') + "</div>");
      $(ele).removeClass(removeclass); //remove class selected
      var addeddata = {'product':$(ele).data('id'),'quantity':1,'size':""}; //create object of product
      addToArray(abc,addeddata);
      $(ele).parent().find(".inbtn").fadeIn();
      $(ele).parent().find(".sczrbtn").fadeIn();
      $(ele).parent().find(".qtybtn").fadeIn();
      $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())+parseInt(1));
   
    } else {

      // remove form array
      counter--;
      $(ele).addClass(removeclass);
      var item = $(ele).data('id')
      var n = item.toString();
     $("."+abc).find("p").children("div[data-salad-id='" + $(ele).data('id') + "']").remove(); //remove form list
      $(ele).parent().find(".inbtn").fadeOut();
      $(ele).parent().find(".sczrbtn").fadeOut();
      $(newProducts[abc]).each(function( index, element ) {
    
        if(element.product == item){
         newProducts[abc].splice(index, 1); //remove form array
         return false;
       }

      });
       $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())-parseInt(1));
    }

         $.ajax({ //get price if ingredients
        method:'POST',
        url:"<?php echo base_url('order/getPrice');?>",
        data:{id:<?php echo $order_category; ?>,selected:newProducts},
        dataType:'json',
        success:function(res)
        {
      
          $("#price1").val(res.price);
          $("#price").html("$"+res.price);

        }
      });  
  
    }


    function toppingSize(ele,id,size){ //topping size

      if($(ele).closest("div .inbtn").children().hasClass("active")){
        $(ele).closest("div .inbtn").children().removeClass("active");
      }
      var abc = $(ele).data("index");
       $(newProducts[abc]).each(function( index, element ) {
          if(element.product == id) {
            newProducts[abc].splice(index, 1);
            return false;
          }
        
      });
      $(ele).addClass("active");
      var addeddata = {'product':id,'quantity':1,'size':size};
      addToArray(abc,addeddata);

       $("#ingSize"+id).val(size);
    }

     function serving(ele,id,serve){ //serving side

      if($(ele).closest("div .sczrbtn").children().hasClass("active")){
        $(ele).closest("div .sczrbtn").children().removeClass("active");
      }

      var size = $("#ingSize"+id).val();
      if(size == ""){

        toasterOptions();
        toastr.error("Please select the size first");
        return false;

      }
      var abc = $(ele).data("index");
       $(newProducts[abc]).each(function( index, element ) {
          if(element.product == id) {
            newProducts[abc].splice(index, 1);
            return false;
          }
        
      });
      $(ele).addClass("active");
      var addeddata = {'product':id,'quantity':1,'size':size,'serving':serve};
      addToArray(abc,addeddata); 

    }

</script>

