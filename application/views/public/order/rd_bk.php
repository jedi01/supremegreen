
<style type="text/css">
	.center-text{
		text-align: center;
    justify-content: center;
    display: flex;
	}

  .btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}


</style>
<?php 
  $price = "<h3>Price : $0 </h3> ";
  if(isset($product)){
    $price = "<h3>Price : $".$product->product_price." </h3> ";

  }
  if(isset($itemsArray)){
    $price = "<h3>Price : $".$itemPrice." </h3> ";
  }
 ?>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-lg-1 col-md-2 col-sm-12 col-xs-12 bg-dark hide ">
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12  left_border_round" id="border-radius-left">
				<div class="center-text div1 tmgn50" id="products">
				
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="rightsidebar text-center d-none d-lg-block d-xl-block d-md-block">
					<h1 class="pt50"><?php echo $title; ?></h1>
					<h1>Fill your Bowl</h1>
          <div id="pricetag">
          <?php echo $price; ?>
          </div>
					<div id="myDIV" >
						<p class="ptext text-center"></p>
					</div>	
				</div>
			</div>


<?php


if(isset($product))
{

$names = [];
$array3 = array();

  $decode = json_decode($product->product_items);
  foreach ($decode as $key => $value) {
      
     $porduct_detail =  ingredients_price($value);
     array_push($names,$porduct_detail->cat_pro_name);
  }
  $array3 = array_combine($decode,$names);



}

if(isset($itemsArray)){

$names = array();
$itemsAr = json_decode($itemsArray);
foreach ($itemsAr as $key => $value) {
  
    $ing =  ingredients_price($value);
    array_push($names, $ing->cat_pro_name);
    
}
$namesArray = array_combine($itemsAr,$names);
}


?>
			
		</div>
	</div>


<!-- Modal -->
<div class="modal" id="bowlModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="exampleModalLabel">Fill Your Bowl</h5>


       
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="myDIV" >
        <p class="ptext text-center"></p>	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="bowlicon bowlround d-md-none d-lg-none d-xl-none">
    <a href="#"  data-toggle="modal" data-target="#bowlModal">
   <p class="mini_content">Bowl</p>

</a>
</div>

<?php
  $price = 0;
  if(isset($product)){
    $price = $product->product_price;
  }
 ?>

<input type="hidden" id="price" value="<?=$price?>">

</body>

<script type="text/javascript">

	var addclass = 'color';
	var removeclass = 'spin';
  var products = [];
  var newProducts = [];
  var c= 0;
  <?php 
    if(isset($product)){
      $encode_items = $product->product_items;
      echo "var selectedItems = ".$encode_items.";";
    } else if(isset($itemsArray)){
     echo "var selectedItems = ".$itemsArray.";";
    } else{
    echo "var selectedItems = [];";
    }  
  ?>
	
  var names = [];

  $(document).ready(function() {
 

  

  var category_id = <?php echo $category_id; ?>;
  var productId = "";
  var skip = 0;
  var flag = 0;
    <?php 
  if(isset($product))
  { ?>

    productId = "<?php echo $product->product_id; ?>";
    <?php
    echo "names = ".json_encode($array3).";";

     ?>

    $.each( names, function( key, value ) {
      $('.ptext').append("<div data-salad-id='" + key + "'>" + value + "</div>");
    });

<?php
}elseif(isset($itemsArray)){ ?>

  productId = "<?php echo $productid; ?>";
  flag = 1;
  <?php
   echo "names = ".json_encode($namesArray).";";

     ?>

    $.each( names, function( key, value ) {
      $('.ptext').append("<div data-salad-id='" + key + "'>" + value + "</div>");
    });

<?php }
 ?>
  $.ajax({
    method:'POST',
    url:"<?php echo base_url('order/get_products');?>",
    data:{id:category_id,selected:selectedItems,productId:productId,skip:skip,flag:flag},
    dataType:'text',

    success:function(res)
    {
      $("#products").html(res);
    },
 
  });

  $(".color").click(function() {
    $(".ptext").empty();
  });
});


var counter = 0;
var flag = 0;

function change_page(skip) 
{ 
     
 counter = 0;

  var productId = "";
  var category_id = <?php echo $category_id; ?>;
    <?php if(isset($product)){ ?>
        productId = "<?php echo $product->product_id; ?>";
    <?php
}elseif(isset($itemsArray)){ ?>

  productId = "<?php echo $productid; ?>";

  flag = 1;

<?php }
 ?>
  

  $.ajax({
    method:'POST',
    url:"<?php echo base_url('order/get_products');?>",
    data:{id:category_id,skip:skip,selected:selectedItems,productId:productId,flag:flag},
    dataType:'text',

    success:function(data)
    {
      $("#products").html(data);
      
    }
  }); 

}


function small(ele,id){
  $(newProducts).each(function( index, element ) {
    if(element.product == id){
       newProducts.splice(index, 1);
       return false;
     }
   });
    var newarr = {"product":id,"quantity":1,"size":"S"};
    newProducts.push(newarr);
    console.log(newProducts);


  }

  function medium(ele,id){
    $(newProducts).each(function( index, element ) {
      if(element.product == id){
       newProducts.splice(index, 1);
       return false;
     }
   });
     var newarr = {"product":id,"quantity":1,"size":"M"};
      newProducts.push(newarr);
      console.log(newProducts);
     }
    

    function large(ele,id){
     
     $(newProducts).each(function( index, element ) {
      if(element.product == id){
       newProducts.splice(index, 1);
       return false;
     }
   });
     var newarr = {"product":id,"quantity":1,"size":"L"};
      newProducts.push(newarr);
      console.log(newProducts);
     }
    




  
  function encirecl(ele) 
  {

    var maxQty = $("#maxQty").val();
    var addCounter = parseInt($("#counter").val())+parseInt(1);
    var minQty = $("#minQty").val();
    var selectedCount = selectedItems.length;
    var newCounter = parseInt(counter)+parseInt(addCounter);
    if(newCounter>maxQty)
    { 

      if (!$(ele).hasClass('color')) {
       toasterOptions();
        toastr.error('You Reached Maximun Limit');
        return false;
        }
    }


    $(ele).toggleClass(addclass);

    if ($(ele).hasClass('color')) {
      counter++;
      products.push($(ele).data('id'));
      var item = $(ele).data('id')
      var n = item.toString();
      selectedItems.push(n);
      $('.ptext').append("<div data-salad-id='" + $(ele).data('id') + "'>" + $(ele).data('name') + "</div>");
      $(ele).removeClass(removeclass);
      newProducts[c] = {'product':$(ele).data('id'),'quantity':1};
      console.log(newProducts);
      $(ele).parent().find(".inbtn").fadeIn();
      c++;



    } else {

      counter--;
      $(ele).addClass(removeclass);
      var item = $(ele).data('id')
      var n = item.toString();
      var index = selectedItems.indexOf(n);
      selectedItems.splice(index, 1);
      $(".ptext").children("div[data-salad-id='" + $(ele).data('id') + "']").remove();
      $(ele).parent().find(".inbtn").fadeOut();
      $(newProducts).each(function( index, element ) {
      if(element.product == item){
       newProducts.splice(index, 1);
       return false;
     }
   });
      console.log(newProducts);
      c--;

    }

    var category_id = <?php echo $category_id; ?>;
      <?php if(isset($product)){ ?>
        productId = "<?php echo $product->product_id; ?>";
        <?php
      }elseif(isset($itemsArray)){ ?>

        productId = "<?php echo $productid; ?>";

        flag = 1;

      <?php }
      ?>

      $.ajax({
        method:'POST',
        url:"<?php echo base_url('order/getPrice');?>",
        data:{id:category_id,selected:selectedItems},
        dataType:'json',
        success:function(res)
        {
            $("#pricetag").html("<h3>Price : $"+res.price+" </h3>")
        
        }
      }); 

    
}

function order_now() {
  var category_id = <?php echo $category_id; ?>;
  <?php 
  if(isset($product))
  {
    ?>
     
      var name = "<?php echo $title; ?>";
     <?php
  }
  else
  {
     ?>
    var name = "<?php echo "Custom ".$title; ?>";
     <?php
  }  

  ?>
  var slug = "<?php echo $slug; ?>";
  var price = $("#price").val(); 
  var sessionKey = "<?=$sessionKey?>";

  $.ajax({
    method:'POST',
    url:"<?php echo base_url('order/order_now');?>",
    data:{id:category_id,name:name,selected:newProducts,price:price,slug:slug,sessionKey:sessionKey},
   dataType:'json',

    success:function(data)
    {
      if(data.status){
        var url = "<?php echo base_url("order/add_more"); ?>";
       window.location = url;
      }
      else
      {
        toasterOptions();
        toastr.error(data.msg);

      }
    }
  }); 
}


	$(document).ready(function () {
	  var height = $(window).height();
  $('.rightsidebar').css("height",height+"px");
	})
</script>

