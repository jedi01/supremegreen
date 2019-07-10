
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
  .sczrbtn{
        position: absolute;
    top: -33px;

  }

  .sczrbtn button{
    width: 100px;
    height:auto;
    display:inline-block;
  }


</style>

<?php
  
  $order = $this->session->userdata("order_cart");

  if(isset($product)){

  $pro_items = json_decode($product->product_items);
  $names = [];
  $proIds = [];

  foreach ($pro_items as $k2 => $v2) {
     foreach ($v2 as $k3 => $v3) {
      $pro = ingredients_price($v3->product);
       $newarr = $pro->cat_pro_name;
       array_push($names, $newarr);
     }
    }

    foreach ($pro_items as $k3 => $v2) {
     foreach ($v2 as $k3 => $v3) {
       $idArr = $v3->product;
       array_push($proIds, $idArr);
     }
    }

    $namesArray = array_combine($proIds,$names);
    
  }



?>


<?php 

$price = "<h3>Price : $0 </h3> ";
if(isset($product)){
  $price = "<h3>Price : $".$product->product_price." </h3> ";
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
?>

<input type="hidden" id="price" value="<?=$price?>">

</body>

<script type="text/javascript">

	var addclass = 'color';
	var removeclass = 'spin';
  var products = [];
  <?php 
if(isset($product)){
    echo "var newProducts =".$product->product_items; //json of db product items

}else{
  echo "var newProducts = {
  top: [],
  pre: [],
  dress: [],
  base: []
};"; //initialize newPorduct array
}
  

  ?>

  var names = [];

  $(document).ready(function() {

    var category_id = <?php echo $category_id; ?>;
    var productId = "";
    var skip = 0;
    var flag = 0;
    <?php 
    if(isset($product)){ ?>
      productId = "<?php echo $product->product_id; ?>";
      <?php echo "names = ".json_encode($namesArray).";"; ?>
      $.each( names, function( key, value ) {
        $('.ptext').append("<div data-salad-id='" + key + "'>" + value + "</div>"); //get array of product name and id only
      });
    <?php } ?>

    $.ajax({
      method:'POST',
      url:"<?php echo base_url('order/get_products');?>", //get products
      data:{id:category_id,selected:newProducts,productId:productId,skip:skip,flag:flag},
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

  function change_page(skip)  //get next products
  { 
    counter = 0;
    var category_id = <?php echo $category_id; ?>;

    $.ajax({
      method:'POST',
      url:"<?php echo base_url('order/get_products');?>", 
      data:{id:category_id,skip:skip,selected:newProducts,flag:flag},
      dataType:'text',
      success:function(data){
        $("#products").html(data);
      }
    }); 

 }



  function addToArray(name, value) { //add products to array
    newProducts[name].push(value);
    console.log(newProducts);
  }

  function encirecl(ele) 
  {
    var maxQty = $("#maxQty").val(); //get max quantity of category
    var addCounter = parseInt($("#counter").val())+parseInt(1);  //count added
    var minQty = $("#minQty").val(); //get min quantity of category
    var abc = $(ele).data("index"); // category index name
    var selectedCount = newProducts[abc].length; //selected items count
    var newCounter = parseInt(selectedCount)+parseInt(addCounter); //new counter set
    

    var totlco = $("#countervalue"+abc).val();
    if(newCounter>maxQty || totlco==maxQty) //max quantity reach return false
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
      $('.ptext').append("<div data-salad-id='" + $(ele).data('id') + "'>" + $(ele).data('name') + "</div>");
      $(ele).removeClass(removeclass); //remove class selected
      var addeddata = {'product':$(ele).data('id'),'quantity':1,'size':"",'serving':''}; //create object of product
      addToArray(abc,addeddata);
      $(ele).parent().find(".inbtn").fadeIn();
      $(ele).parent().find(".sczrbtn").fadeIn();
      $(ele).parent().find(".qtybtn").fadeIn();
      var prc = $(ele).data('price');
      $(ele).find(".inc").html('$'+prc);
      $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())+parseInt(1));
       
   
    } else {

      // remove form array
      counter--;
      $(ele).addClass(removeclass);
      var item = $(ele).data('id')
      var n = item.toString();
      $(".ptext").children("div[data-salad-id='" + $(ele).data('id') + "']").remove(); //remove form list
      $(ele).parent().find(".inbtn").fadeOut();
       $(ele).parent().find(".sczrbtn").fadeOut();
       $(ele).parent().find(".qtybtn").fadeOut();
      $(newProducts[abc]).each(function( index, element ) {
    
        if(element.product == item){
         newProducts[abc].splice(index, 1); //remove form array
         return false;
       }

      });
    $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())-parseInt(1));
      var prc = $(ele).data('price');
      $(ele).find(".inc").html('');
    }

    var category_id = <?php echo $category_id; ?>;
      $.ajax({ //get price if ingredients
        method:'POST',
        url:"<?php echo base_url('order/getPrice');?>",
        data:{id:category_id,selected:newProducts},
        dataType:'json',
        success:function(res)
        {
          $("#pricetag").html("<h3>Price : $"+res.price+" </h3>")

        }
      });   
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
    $(ele).parents(".qtybtn").find(".counter").val(updatedCount);
     $(ele).parents(".qtybtn").find("#counting"+id).val(updatedCount);
    $(newProducts[abc]).each(function( index, element ) {
        if(element.product == id){
         newProducts[abc].splice(index, 1); //remove form array
         return false;
       }

      });

    var size;
    var serving;
    if(typeof $("#ingSize"+id).val() === "undefined"){
       size = '';
    }else{
      size = $("#ingSize"+id).val();
    }

    if(typeof $("#ingServing"+id).val() === "undefined"){
      serving = '';
    }else{
      serving = $("#ingServing"+id).val();
    }

    $("#"+id+"Qty").val(updatedCount);
   var addeddata = {'product':id,'quantity':updatedCount,'size':size,'serving':serving}; //create object of product
    addToArray(abc,addeddata);
        var category_id = <?php echo $category_id; ?>;
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
     $(ele).parents(".qtybtn").find("#counting"+id).val(updatedCount);
      $(newProducts[abc]).each(function( index, element ) {
    
        if(element.product == id){
         newProducts[abc].splice(index, 1); //remove form array
         return false;
       }

      });

       $("#"+id+"Qty").val(updatedCount);
    var size;
    var serving;
    if(typeof $("#ingSize"+id).val() === "undefined"){
       size = '';
    }else{
      size = $("#ingSize"+id).val();
    }

    if(typeof $("#ingServing"+id).val() === "undefined"){
      serving = '';
    }else{
      serving = $("#ingServing"+id).val();
    }
      var countinput =  $(ele).parent().find(".qtybtn").find("input").val();
      $("#countervalue"+abc).val(parseInt($("#countervalue"+abc).val())-parseInt(1));
     var addeddata = {'product':id,'quantity':updatedCount,'size':size,'serving':serving}; //create object of product
      addToArray(abc,addeddata);
          var category_id = <?php echo $category_id; ?>;
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
      var qunty =  $("#"+id+"Qty").val();


      
    var serving;
    if(typeof $("#ingServing"+id).val() === "undefined"){
      serving = '';
    }else{
      serving = $("#ingServing"+id).val();
    }
      $(ele).addClass("active");
      var addeddata = {'product':id,'quantity':qunty,'size':size,'serving':serving};
      addToArray(abc,addeddata);
      $("#ingSize"+id).val(size);

    }

    function serving(ele,id,serve){ //serving side

      if($(ele).closest("div .sczrbtn").children().hasClass("active")){
        $(ele).closest("div .sczrbtn").children().removeClass("active");
      }


      $(ele).parents().find(".qtybtn").find("input").addClass("a");
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
       var qunty =    $("#"+id+"Qty").val();

      var addeddata = {'product':id,'quantity':qunty,'size':size,'serving':serve};
      addToArray(abc,addeddata);
      $("#ingServing"+id).val(serve);
     
       

    }

function order_now() { //order now
  var category_id = <?php echo $category_id; ?>;
  var name = "<?php echo $title; ?>";
  var slug = "<?php echo $slug; ?>";
  var price = $("#price").val(); 

  $.ajax({
    method:'POST',
    url:"<?php echo base_url('order/order_now');?>",
    data:{id:category_id,name:name,selected:newProducts,price:price,slug:slug},
    dataType:'json',

    success:function(data)
    {
      if(data.status){
        var url = "<?php echo base_url("order/add_more"); ?>";
        window.location = url;
      } else{
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

