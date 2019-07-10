<style type="text/css">
	.newcircel {
	border-radius: 50%;
	border: #f88f26 2px solid;
}
.inbtn{
    position: fixed;

}
.counter{
  width: 10px;
  background: transparent;
  border: none;
}

.mybtn{
    background: transparent;
    border: #f88f26 solid;
    padding: 4px 7px !important;
}

.mybtn:hover{
  background: transparent;
    border: #f88f26 solid;
    padding: 4px 7px !important;
}


.d-1{
  position: fixed;
    top: 1%;
    left: 11%;
    width: 150px !important;
    height: 150px !important;
    line-height: 150px;

}

.circled-1 {  
      position: fixed;
    top: 6px;
    left: 98px;
    line-height: 150px;
    height: 170px !important;
    width: 170px !important;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;
}

.ib1{
  top: 131px;
    margin-left: 44px;
}


.d-2{
 position: fixed;
    top: 1%;
    left: 41%;
    width: 175px !important;
    height: 175px !important;
    line-height: 175px;
}

.circled-2 {  
     position: fixed;
    top: 6px;
    left: 391px;
    line-height: 150px;
    height: 195px;
    width: 195px;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;
}

.ib2{
        top: 155px;
    margin-left: 49px;
}


.d-3{
      position: fixed;
    top: 3%;
    left: 74%;
    width: 150px !important;
    height: 150px !important;
    line-height: 150px;
}


.circled-3 {  
position: fixed;
    top: 38px;
    left: 716px;
    line-height: 150px;
    height: 170px !important;
    width: 170px !important;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;
  
}

.ib3{
         top: 159px;
    margin-left: 36px;
}


.d-4{
     position: fixed;
    top: 55%;
    left: 10%;
    width: 150px !important;
    height: 150px !important;
    line-height: 150px;
}



.circled-4 {  
      position: fixed;
    top: 880px;
    left: 88px;
    line-height: 150px;
    height: 170px !important;
    width: 170px !important;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;
  
}
.ib4{
  top: 1002px;
    margin-left: 35px;
}

.d-5{
      position: fixed;
    top: 50%;
    left: 43%;
    width: 150px !important;
    height: 150px !important;
    line-height: 150px;
}

.circled-5 {  
     position: fixed;
    top: 800px;
    left: 411px;
    line-height: 150px;
    height: 170px !important;
    width: 170px !important;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;

}


.ib5{
   top: 930px;
    margin-left: 41px;
}


.d-6{
 position: fixed;
    top: 57%;
    left: 79%;
    width: 150px !important;
    height: 150px !important;
    line-height: 150px;
}


.circled-6{  
    position: fixed;
    top: 915px;
    left: 765px;
    line-height: 150px;
    height: 170px !important;
    width: 170px !important;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;

}


.ib6{
      top: 1033px;
    margin-left: 33px;
}

.grow {
  background-color: transparent;
  border-radius: 50%;
  display: inline-block;
  border: 5px solid #fff;

  
}


.grow:hover
{
  -webkit-transform: scale(1.3);
  -ms-transform: scale(1.3);
  transform: scale(1.3);
}

.selected{
  border-radius: 50%;
  border: 5px solid #f88f26 ;
}

.order{  
     position: fixed;
    top: 1350px;
    left: 390px;
    line-height: 220px;
    height: 220px !important;
    width: 220px !important;
    background-color: transparent;
    border-radius: 50%;
    display: inline-block;
    border: 5px solid #fff;
    border-style: dotted;
}




</style>




<section class="menu-section pt50" >
  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 " > 
    <div class="" > 
      <div class="row center-div">
        <div class="option">
          <div class="grow  abc d-1" onclick="encirecl(this);" data-drinks= "1">
            <span class="content marginy0"><?=$drink1->name."<br>$".$drink1->price?></span>
          </div>
          <div class="inbtn ib1" style="display: none;">
            <button type="button" class="btn mybtn btn-circle" onclick="plus(this,<?=$drink1->id?>)"><i class="fa fa-plus"></i></button>
            <input class="counter" id="<?=$drink1->id?>" value="1">
            <button type="button" class="btn mybtn btn-circle" onclick="minus(this,<?=$drink1->id?>)"><i class="fa fa-minus"></i></button>
          </div>
        </div>

         <div class="option" >
          <div class="grow abc d-2" onclick="encirecl(this);" data-drinks= "2">
            <span class="content marginy0"><?=$drink2->name."<br>$".$drink2->price?></span>
          </div>
          <div class="inbtn ib2" style="display: none;">
            <button type="button" class="btn mybtn btn-circle" onclick="plus(this,<?=$drink2->id?>)"><i class="fa fa-plus"></i></button>
            <input class="counter" id="<?=$drink2->id?>" value="1">
            <button type="button" class="btn mybtn btn-circle" onclick="minus(this,<?=$drink2->id?>)"><i class="fa fa-minus"></i></button>
          </div>
        </div>

         <div class="option">
          <div class="grow abc d-3" onclick="encirecl(this);" data-drinks= "3">
            <span class="content marginy0"><?=$drink3->name."<br>$".$drink3->price?></span>
          </div>
          <div class="inbtn ib3" style="display: none;">
            <button type="button" class="btn mybtn btn-circle" onclick="plus(this,<?=$drink3->id?>)"><i class="fa fa-plus"></i></button>
            <input class="counter" id="<?=$drink3->id?>" value="1">
            <button type="button" class="btn mybtn btn-circle" onclick="minus(this,<?=$drink3->id?>)"><i class="fa fa-minus"></i></button>
          </div>

        </div>


         <div class="option">
          <div class="grow abc d-4" onclick="encirecl(this);" data-drinks= "4">
            <span class="content marginy0"><?=$drink4->name."<br>$".$drink4->price?></span>
          </div>
          <div class="inbtn ib4" style="display: none;">
            <button type="button" class="btn mybtn btn-circle" onclick="plus(this,<?=$drink4->id?>)"><i class="fa fa-plus"></i></button>
            <input class="counter" id="<?=$drink4->id?>" value="1">
            <button type="button" class="btn mybtn btn-circle" onclick="minus(this,<?=$drink4->id?>)"><i class="fa fa-minus"></i></button>
          </div>
        </div>


         <div class="option">
          <div class="grow abc d-5" onclick="encirecl(this);" data-drinks= "5">
            <span class="content marginy0"><?=$drink5->name."<br>$".$drink5->price?></span>
          </div>
          <div class="inbtn ib5" style="display: none;">
            <button type="button" class="btn mybtn btn-circle" onclick="plus(this,<?=$drink5->id?>)"><i class="fa fa-plus"></i></button>
            <input class="counter" id="<?=$drink5->id?>" value="1">
            <button type="button" class="btn mybtn btn-circle" onclick="minus(this,<?=$drink5->id?>)"><i class="fa fa-minus"></i></button>
          </div>
        </div>


         <div class="option">
          <div class="grow abc d-6" onclick="encirecl(this);" data-drinks= "6">
            <span class="content marginy0"><?=$drink6->name."<br>$".$drink6->price?></span>
          </div>
          <div class="inbtn ib6" style="display: none;">
            <button type="button" class="btn mybtn btn-circle" onclick="plus(this,<?=$drink6->id?>)"><i class="fa fa-plus"></i></button>
            <input class="counter" id="<?=$drink6->id?>" value="1">
            <button type="button" class="btn mybtn btn-circle" onclick="minus(this,<?=$drink6->id?>)"><i class="fa fa-minus"></i></button>
          </div>
        </div>




          <div class="grow order" onclick="order_now();">
            <span class="content marginy0">Order Now</span>
          </div>
      

        
  
          
      </div>
    </div>
  </div>
</section>  



<script type="text/javascript">
	var addclass = 'selected';
	var removeclass = 'grow';
  var products = [];
  var newProducts = [];
  var c= 0;
	function encirecl(ele) {

    if ($(ele).hasClass('grow')) {
      $(ele).addClass(addclass);
      var drink = $(ele).attr("data-drinks");
      $(ele).closest("div .option").addClass('circled-'+drink);
      $(ele).next().fadeIn();
      $(ele).removeClass(removeclass);
     newProducts[c] = {'drink':drink,'quantity':1};
     console.log(newProducts);
     c++;
   
    } else {
      var drink = $(ele).attr("data-drinks");
      $(ele).closest("div .option").removeClass('circled-'+drink);
      $(ele).next().hide();
      $(ele).addClass(removeclass);
      $(ele).removeClass(addclass);
      $(newProducts).each(function( index, element ) {
      if(element.drink == drink){
       newProducts.splice(index, 1);
       return false;
     }
   });
      console.log(newProducts);
      c--;
 
	}
}

function plus(ele,id){

    var count =   $(ele).parents(".inbtn").find("input").val();
    var updatedCount = parseInt(count)+parseInt(1);
    $(ele).parents(".inbtn").find("input").val(updatedCount);
     $(newProducts).each(function( index, element ) {
      if(element.drink == id){
       newProducts.splice(index, 1);
       return false;
     }
   });
    var newarr = {"drink":id,"quantity":updatedCount};
    newProducts.push(newarr);
    console.log(newProducts);


  }

  function minus(ele,id){
      var count =   $(ele).parents(".inbtn").find("input").val();
     if(count<=1){
      return false;
     }else{
    var updatedCount = parseInt(count)-parseInt(1);
    $(ele).parents(".inbtn").find("input").val(updatedCount);
     $(newProducts).each(function( index, element ) {
      if(element.drink == id){
       newProducts.splice(index, 1);
       return false;
     }
   });
     var newarr = {"drink":id,"quantity":updatedCount};
      newProducts.push(newarr);
      console.log(newProducts);
     }
    
  }


  function order_now(){
    console.log(newProducts);

    $.ajax({
    method:'POST',
    url:"<?php echo base_url('order/order_drinks');?>",
    data:{drinks:newProducts,},
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



  $(document).ready(function() {
    $(document).on('click', '.abc ', function () {
      if($(this).hasClass("selected")){
        $(this).children().find(".inbtn").show();
      }else{
        $(this).find(".inbtn").hide();
      }
    });
  
});






</script>

